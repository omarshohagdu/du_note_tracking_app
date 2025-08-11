<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

use App\Models\NoteTrackingMeta;
use App\Models\NoteTrackingContent;
use App\Models\NoteTrackingMovement;
use DB;

class NoteTracking extends Component
{
    public $bodyId,$accessToken,$url,$secretKey;

    public string $noteType = '';
    public $initiatedBy;
    public $noteTitle,$noteRefNo,$noteContent;
    public $employeeList = [];
    public $employeeInfoByID = [];

    public function mount()
    {
        // Assign session value here
        $this->bodyId       = session('user.body_id');
        $this->accessToken  = session('api_token');
        $this->url          = liveApiUrl();
        $this->secretKey    = secretKey();


        $employeeList = Http::withHeaders([
            'secret-key'        => $this->secretKey,
            'Authorization'     => 'Bearer ' . $this->accessToken,
        ])->post($this->url.'searchEmployee', [
            'dept_office_id'    => $this->bodyId,
        ]);

        if ($employeeList->failed()) {
            $this->employeeList  = collect([]);
        } else {
            $this->employeeList  = $employeeList->json();
        }


        $this->initiatedBy = session('user')['user_id'];

    }

    public function render()
    {
        if (!session('api_token')) {
            return redirect()->route('api.login');
        }
        $getAllBody = Http::withHeaders([
            'secret-key'        => $this->secretKey,
            'Authorization'     => 'Bearer ' . $this->accessToken,
        ])->get(
            $this->url.'getActiveBody');
        return view('livewire.note_tracking.create',['body'=>$getAllBody]);
    }

    public function submitNoteInfo()
    {
        if (!session('api_token')) {
            session()->flash('error', 'Session expired, please login again.');
            return redirect()->route('api.login');
        }


        $this->resetErrorBag(); // Optional: reset errors on re-submit
        $this->resetValidation();

        $this->validate([
            'noteType'          => 'required|string',
            'noteTitle'         => 'required|string|max:255',
            'noteRefNo'         => 'required|string|max:255',
            'noteContent'       => 'nullable|string|max:1000',
            'initiatedBy'       => 'required|numeric',
        ], [
            'noteType.required' => 'Note Type is required.',
            'noteTitle.required' => 'Note Title is required.',
            'noteRefNo.required' => 'The Note Reference Number is required.',
            'initiatedBy.required' => 'The Initiated by is required.',

            'noteContent.string' => 'The message must be a valid text.',
            'noteContent.max' => 'The message cannot exceed 1000 characters.',
        ]);

        DB::beginTransaction();

        try {
            $initiatedEmployeeInfo    = NoteTrackingMeta::fetchEmployeeById($this->initiatedBy);
            $meta = NoteTrackingMeta::create([
                'type'           => $this->noteType,
                'title'          => $this->noteTitle,
                'reference_no'   => $this->noteRefNo,
                'current_status' => 1,
                'is_active'      => 1,
                'created_by'     => $this->initiatedBy,
                'created_ip'     => request()->ip(),
            ]);

            NoteTrackingContent::create([
                'note_meta_id' => $meta->id,
                'note_body'    => $this->noteContent,
                'is_active'    => 1,
                'created_by'   => $this->initiatedBy,
                'created_ip'   => request()->ip(),
            ]);

            NoteTrackingMovement::create([
                'note_meta_id' => $meta->id,
                'note_action'  => 'Created',
                'from_user'    => NULL,
                'to_user'      => (!empty($initiatedEmployeeInfo) ? json_encode($initiatedEmployeeInfo) : NULL),
                'status'       => 'Created',
                'is_active'    => 1,
                'created_by'   => $this->initiatedBy,
                'created_ip'   => request()->ip(),
            ]);

            DB::commit();
            $this->reset(['noteType','noteTitle', 'noteRefNo', 'noteContent']);
            $this->dispatch('clear-note-fields');
          //  session()->flash('message', 'Note successfully created with movement log!');
            $this->dispatch('show-success-alert', message: 'Note successfully created with movement log!');


        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Something went wrong! ' . $e->getMessage());
        }
    }
    public function ToggleNoteType($type){
        $this->dispatch('clear-note-type-fields');
        $this->reset([ 'noteContent']);
        $this->noteType = $type;
    }

    public function resetCreateNoteForm(){
        $this->resetErrorBag(); // Optional: reset errors on re-submit
        $this->resetValidation();
        $this->reset(['noteType','noteTitle', 'noteRefNo', 'noteContent']);
        $this->dispatch('clear-note-fields');
    }


}
