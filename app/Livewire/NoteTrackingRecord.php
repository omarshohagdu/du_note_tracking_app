<?php

namespace App\Livewire;

use App\Models\NoteTrackingContent;
use App\Models\NoteTrackingMeta;
use App\Models\NoteTrackingMovement;
use Illuminate\Support\Facades\Http;
use Livewire\Component;


class NoteTrackingRecord extends Component
{
    public $bodyId,$loginUserName,$loginOfficeName;
    protected string $url = 'https://ssl.du.ac.bd/api/';
    protected string $secretKey = '4a4cfb4a97000af785115cc9b53c313111e51d9a';
    public $accessToken;

    public $initiatedBy,$officeID;
    public $employeeList = [];
    public $bodyList = [];
    public function mount()
    {
        // Assign session value here
        $this->bodyId       = session('user.body_id');
        $this->accessToken  = session('api_token');



        $getAllBody = Http::withHeaders([
            'secret-key'        => $this->secretKey,
            'Authorization'     => 'Bearer ' . $this->accessToken,
        ])->get(
            $this->url.'getActiveBody');
        if ($getAllBody->failed()) {
            $this->bodyList  = collect([]);
        } else {
            $this->bodyList  = $getAllBody->json()['data'];
        }

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

        $this->initiatedBy      = session('user')['user_id'];
        $this->officeID         = session('user')['body_id'];

        // Set the login username and office name
        $this->loginUserName    = session('user')['emp_name'].", ".session('user')['body_name'];
        $this->loginOfficeName  = session('user')['bodyid'];

     //   dd(session('user')['user_id']);
        //45320
    }
    public function render()
    {
        $loggedInUserId = session('user')['user_id'];
        $noteTrackingMeta = NoteTrackingMeta::with([
            'content',
            'latestMovement' => function ($query) {
                $query->where('is_active', 1);
            }
        ])->where('note_tracking_metas.is_active', 1)
            ->where('note_tracking_metas.created_by', $loggedInUserId)
            ->orderBy('note_tracking_metas.created_at', 'desc')
            ->get()
            ->map(function ($meta) use ($loggedInUserId) {;
                $meta->initiated_by_name    = NoteTrackingMeta::fetchEmployeeById($meta->created_by);
                $meta->latest_movement      = $meta->latestMovement;
                if ($meta->latest_movement && !empty($meta->latest_movement->to_user)  && $meta->current_status!=4) {
                    $toUser = json_decode($meta->latest_movement->to_user, true);
                    $meta->is_assigned_to_me = ($toUser['employee_id'] ?? null) == $loggedInUserId ? "Yes" : "No";
                } else {
                    $meta->is_assigned_to_me = "No";
                }
                return $meta;
            });
       // dd($noteTrackingMeta);
        return view('livewire.note_tracking.record',['noteTrackingMeta'=>$noteTrackingMeta]);
    }
    public function getNoteInfo($id)
    {
        $noteTrackingMeta = NoteTrackingMeta::
        leftJoin('note_tracking_contents', 'note_tracking_metas.id', '=', 'note_tracking_contents.note_meta_id')
            ->leftJoin('note_tracking_movements', 'note_tracking_metas.id', '=', 'note_tracking_movements.note_meta_id')
            ->where('note_tracking_metas.is_active', 1)
            ->orderBy('note_tracking_metas.created_at', 'desc')
            ->where('note_tracking_metas.id', $id)
            ->first();
        return response()->json([
            'status'    => 'success',
            'data'      => $noteTrackingMeta
        ]);
    }
    public function getEmployeeListByBodyChange($bodyId)
    {
        if (empty($bodyId)) {
            return response()->json(['status' => 'error', 'message' => 'Body ID is required'], 400);
        }

        $url = rtrim($this->url, '/') . '/searchEmployee';

        $response = Http::withHeaders([
            'secret-key' => $this->secretKey,
            'Authorization' => 'Bearer ' . $this->accessToken,
        ])->post($url, [
            'dept_office_id' => $bodyId,
        ]);

        if ($response->failed()) {
            return response()->json(['status' => 'error', 'message' => 'API request failed'], 500);
        }

        return response()->json(['status' => 'success', 'data' => $response->json()]);
    }

    public $forwardMessage,$forwardToOfficeID,$forwardToEmployee;
    public $showForwardModal = false;
    public $note_meta_id,$noteLastMovementID;
    public $noteTitle;
    public $referenceNo;

    public function saveforward()
    {

        $this->validate([
            'forwardToOfficeID' => 'required|integer',
            'forwardToEmployee' => 'required|integer',
            'forwardMessage' => 'nullable|string|max:1000',
        ], [
            'forwardToOfficeID.required' => 'Please select an office.',
            'forwardToOfficeID.integer' => 'The office selection is invalid.',
            'forwardToEmployee.required' => 'Please select an employee.',
            'forwardToEmployee.integer' => 'The employee selection is invalid.',
            'forwardMessage.string' => 'The message must be a valid text.',
            'forwardMessage.max' => 'The message cannot exceed 1000 characters.',
        ]);

        try {
            // Existing logic
            $initiatedEmployeeInfo = NoteTrackingMeta::fetchEmployeeById($this->initiatedBy);
            $forwardedEmployeeInfo = NoteTrackingMeta::fetchEmployeeById($this->forwardToEmployee);

            NoteTrackingMeta::where('id', $this->note_meta_id)->update([
                'current_status' => 2,
                'updated_by' => $this->forwardToEmployee,
                'updated_ip' => request()->ip(),
            ]);

            NoteTrackingMovement::where(['id' => $this->noteLastMovementID, 'note_meta_id' => $this->note_meta_id])->update([
                'note_action' => 'On Transit',
                'receive_user' => $initiatedEmployeeInfo ? json_encode($initiatedEmployeeInfo) : null,
                'current_status' => 2,
                'status' => 'On Transit',
                'is_active' => 1,
                'updated_by' => $this->forwardToEmployee,
                'updated_ip' => request()->ip(),
            ]);

            NoteTrackingMovement::create([
                'note_meta_id' => $this->note_meta_id,
                'note_action' => 'forwarded',
                'from_user' => $initiatedEmployeeInfo ? json_encode($initiatedEmployeeInfo) : null,
                'to_user' => $forwardedEmployeeInfo ? json_encode($forwardedEmployeeInfo) : null,
                'current_status' => 1,
                'message' => $this->forwardMessage,
                'status' => 'forwarded',
                'is_active' => 1,
                'created_by' => $this->forwardToEmployee,
                'updated_ip' => request()->ip(),
            ]);

            // Trigger SweetAlert2
            $this->reset(['forwardMessage', 'forwardToOfficeID', 'forwardToEmployee', 'note_meta_id']);
            $this->showForwardModal = false;
            $this->dispatch('show-success-alert', message: 'Note forwarded successfully.');
        } catch (\Exception $e) {
//            session()->flash('error', 'Failed to forward note: ' . $e->getMessage());
            $this->dispatch('show-error-alert', message: 'Failed to forward note: ' . $e->getMessage());
        }

        /*
        try {
            $initiatedEmployeeInfo    = NoteTrackingMeta::fetchEmployeeById($this->initiatedBy);
            $forwardedEmployeeInfo    = NoteTrackingMeta::fetchEmployeeById($this->forwardToEmployee);
            // Save movement or forward logic
            NoteTrackingMovement::create([
                'note_meta_id' => $this->note_meta_id,
                'note_action'  => 'forwarded',
                'from_user'    => (!empty($initiatedEmployeeInfo) ? json_encode($initiatedEmployeeInfo) : NULL), // or $this->initiatedBy
                'to_user'      => (!empty($forwardedEmployeeInfo) ? json_encode($forwardedEmployeeInfo) : NULL),
                'current_status'=> 1, // forwarded but not Accepted yet
                'message'      => $this->forwardMessage,
                'status'       => 'forwarded',
                'is_active'    => 1,
                'created_by'   => $this->initiatedBy,
                'created_ip'   => request()->ip(),
            ]);

            session()->flash('message', 'Note forwarded successfully.');
            $this->showForwardModal = false;
            // Optional: Reset values and close modal via browser event
            $this->reset(['forwardMessage', 'forwardToOfficeID', 'forwardToEmployee','note_meta_id']);
           // $this->dispatchBrowserEvent('close-forward-modal');

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to forward note: ' . $e->getMessage());
        }
        */
    }



    public function showForwardModalFun($id)
    {
        $this->resetValidation(['forwardToOfficeID', 'forwardToEmployee']);

        $noteTrackingMeta = NoteTrackingMeta::with([
            'content',
            'latestMovement' => function ($query) {
                $query->where('is_active', 1);
            }
        ])
            ->where('note_tracking_metas.is_active', 1)
            ->orderBy('note_tracking_metas.created_at', 'desc')
            ->where('note_tracking_metas.id', $id)
            ->first();


        if ($noteTrackingMeta) {
            $toUser = !empty($noteTrackingMeta->latestMovement->to_user)? json_decode($noteTrackingMeta->latestMovement->to_user, true):null;
            $this->loginUserName =
                ($toUser['emp_name'] ?? NULL) .
                " (" . ($toUser['designation_en'] ?? NULL) .
                "), " . ($toUser['dept_office_name'] ?? NULL);
            $this->note_meta_id         =   $noteTrackingMeta->id;
            $this->noteTitle            =   $noteTrackingMeta->title;
            $this->referenceNo          =   $noteTrackingMeta->reference_no;
            $this->noteLastMovementID   =   $noteTrackingMeta->latestMovement->id;
            $this->forwardToOfficeID    =   session('user')['body_id'];
            $this->showForwardModal = true;
        }
        else {
            session()->flash('error', 'Note not found.');
        }
    }

    public  function closeForwardModalFun()
    {
        $this->reset(['forwardMessage', 'forwardToOfficeID', 'forwardToEmployee','note_meta_id']);
        $this->showForwardModal = false;
    }



    public $showViewMovementHistorydModal = false;
    public $movementHistory;
    public function viewMovementHistoryFun($noteID='')
    {
        $this->showViewMovementHistorydModal=true;

        $noteTrackingMeta = NoteTrackingMeta::
        with([
            'content',
            'movementHistory'
        ])
            ->where('note_tracking_metas.is_active', 1)
            ->where('note_tracking_metas.id', $noteID)
            ->orderBy('note_tracking_metas.created_at', 'desc')
            ->groupBy('note_tracking_metas.id')
            ->first();

        $this->movementHistory=$noteTrackingMeta;
    }
    public  function closeMovementModalFun()
    {

        $this->showViewMovementHistorydModal = false;
    }

    public function closeNoteModalFun($id)
    {
        $meta = NoteTrackingMeta::find($id); // Replace $noteId with the actual ID
        $closedEmployeeInfo    = NoteTrackingMeta::fetchEmployeeById($this->initiatedBy);
        if ($meta) {
            $meta->update([
                'current_status' => 4,
                'is_active'      => 1,
                'updated_by'     => $this->initiatedBy,
                'updated_ip'     => request()->ip(),
            ]);
            NoteTrackingMovement::create([
                'note_meta_id' => $id,
                'note_action'  => 'closed',
                'to_user'      => (!empty($closedEmployeeInfo) ? json_encode($closedEmployeeInfo) : NULL),
                'status'       => 'closed',
                'is_active'    => 1,
                'updated_by'   => $this->initiatedBy,
                'updated_ip'   => request()->ip(),
            ]);

            session()->flash('message', 'Note  successfully closed.');
        }
        else {
            session()->flash('error', 'Note not found.');
        }
    }

}
