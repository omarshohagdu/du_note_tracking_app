<?php

namespace App\Livewire;

use App\Models\NoteTrackingMeta;
use App\Models\NoteTrackingMovement;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
class Dashboard extends Component
{
    public $bodyId,$loginUserName,$loginOfficeName;
    public $bodyList = [];
    public $employeeList = [];
    public function mount()
    {
        // Assign session value here
        $this->bodyId       = session('user.body_id');
        $this->accessToken  = session('api_token');



        $getAllBody = Http::withHeaders([
            'secret-key'        => secretKey(),
            'Authorization'     => 'Bearer ' . $this->accessToken,
        ])->get(
            liveApiUrl().'getActiveBody');
        if ($getAllBody->failed()) {
            $this->bodyList  = collect([]);
        } else {
            $this->bodyList  = $getAllBody->json()['data'];
        }
//
        $employeeList = Http::withHeaders([
            'secret-key'        => secretKey(),
            'Authorization'     => 'Bearer ' . $this->accessToken,
        ])->post(liveApiUrl().'searchEmployee', [
            'dept_office_id'    => $this->bodyId,
        ]);

        if ($employeeList->failed()) {
            $this->employeeList  = collect([]);
        } else {
            $this->employeeList  = $employeeList->json();
        }
//
//        $this->initiatedBy      = session('user')['user_id'];
//        $this->officeID         = session('user')['body_id'];

        // Set the login username and office name
        $this->loginUserName    = session('user')['emp_name'].", ".session('user')['body_name'];
        $this->loginOfficeName  = session('user')['bodyid'];

        //   dd(session('user')['user_id']);
        //45320
    }
    public function render()
    {
        $myCreatedNotes         =   0;
        $forwardsNotesToMe      =   0;
        $loggedInUserId         = session('user')['user_id'];
        $noteTrackingMeta = NoteTrackingMeta::with([
            'content',
            'movementHistory' => function ($query) {
                $query->where('is_active', 1);
            },
            'latestMovement' => function ($query) {
                $query->where('is_active', 1);
            }
        ])
            ->where('note_tracking_metas.is_active', 1)
            ->where('note_tracking_metas.current_status', "!=",4)
            ->whereHas('latestMovement', function ($query) {
                $query->where('is_active', 1)
                    ->whereRaw('JSON_EXTRACT(to_user, "$.employee_id") = ?', [session('user')['user_id']]);
            })
            ->orderBy('note_tracking_metas.created_at', 'desc')
            ->get()
            ->map(function ($meta) use ($loggedInUserId) {
                $meta->created_by_name    = NoteTrackingMeta::fetchEmployeeById($meta->created_by);
                $meta->latest_movement      = $meta->latestMovement;
                if ($meta->latest_movement && !empty($meta->latest_movement->to_user)  && $meta->current_status!=4) {
                    $toUser = json_decode($meta->latest_movement->to_user, true);
                    $meta->toUser               = $toUser;
                    $meta->is_forward_to_me    = ($toUser['employee_id'] ?? null) == $loggedInUserId ? "Yes" : "No";
                } else {
                    $meta->is_forward_to_me = "No";
                }
                if ($meta->movementHistory ) {
                    $meta->movementHistory = $meta->movementHistory->map(function ($movement) use ($loggedInUserId) {
                        $toUser = json_decode($movement->to_user, true);
                        $movement->is_forward_to_me = (is_array($toUser) && isset($toUser['employee_id']) && $toUser['employee_id'] == $loggedInUserId) ? "Yes" : "No";

                        return $movement;
                    });
                    $meta->movementHistory = $meta->movementHistory;
                } else {
                    $meta->movementHistory = "No";
                }
                return $meta;
            });
      //  dd($noteTrackingMeta);
        return view('dashboard',['myCreatedNotes'=>$myCreatedNotes,'forwardsNotesToMe'=>$forwardsNotesToMe,'noteTrackingMeta'=>$noteTrackingMeta]);
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
        $closedEmployeeInfo    = NoteTrackingMeta::fetchEmployeeById(initiatedBy());
        if ($meta) {
            $meta->update([
                'current_status' => 4,
                'is_active'      => 1,
                'updated_by'     => initiatedBy(),
                'updated_ip'     => request()->ip(),
            ]);
            NoteTrackingMovement::create([
                'note_meta_id' => $id,
                'note_action'  => 'closed',
                'to_user'      => (!empty($closedEmployeeInfo) ? json_encode($closedEmployeeInfo) : NULL),
                'status'       => 'closed',
                'is_active'    => 1,
                'updated_by'   => initiatedBy(),
                'updated_ip'   => request()->ip(),
            ]);

            session()->flash('message', 'Note  successfully closed.');
        }
        else {
            session()->flash('error', 'Note not found.');
        }
    }

    public $forwardMessage,$forwardToOfficeID,$forwardToEmployee;
    public $showForwardModal = false;
    public $note_meta_id;
    public $noteTitle;
    public $referenceNo;
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
            $createdBy=NoteTrackingMeta::fetchEmployeeById($noteTrackingMeta->created_by);
            $this->loginUserName =
                ($createdBy['emp_name'] ?? NULL) .
                " (" . ($createdBy['designation_en'] ?? NULL) .
                "), " . ($createdBy['dept_office_name'] ?? NULL);
            $this->note_meta_id         =   $noteTrackingMeta->id;
            $this->noteTitle            =   $noteTrackingMeta->title;
            $this->referenceNo          =   $noteTrackingMeta->reference_no;
            $this->forwardToOfficeID    =   session('user')['body_id'];;
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
}
