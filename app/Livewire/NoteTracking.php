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

    public $noteType = 'online';
    public $initiatedBy;
    public $noteTitle;
    public $noteRefNo;
    public $noteContent;
    public $employeeList = [];

    public function mount()
    {
        // Assign session value here
        $this->bodyId       = session('user.body_id');
        $this->accessToken  = session('api_token');
        $this->url          = 'https://ssl.du.ac.bd/api/';
        $this->secretKey    = '4a4cfb4a97000af785115cc9b53c313111e51d9a';


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
        $this->validate([
            'noteTitle' => 'required|string|max:255',
            'noteRefNo' => 'required|string|max:255',
            'noteContent' => 'required|string',
            'initiatedBy' => 'required|numeric',
        ]);

        DB::beginTransaction();

        try {
            $meta = NoteTrackingMeta::create([
                'title'        => $this->noteTitle,
                'reference_no' => $this->noteRefNo,
                'current_status' => 1,
                'is_active'    => 1,
                'created_by'   => $this->initiatedBy,
                'created_ip'   => request()->ip(),
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
                'to_user'      => $this->initiatedBy,
                'status'       => 'Created',
                'is_active'    => 1,
                'created_by'   => $this->initiatedBy,
                'created_ip'   => request()->ip(),
            ]);

            DB::commit();

            session()->flash('message', 'Note successfully created with movement log!');
            $this->reset(['noteTitle', 'noteRefNo', 'noteContent']);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Something went wrong! ' . $e->getMessage());
        }
    }

}
