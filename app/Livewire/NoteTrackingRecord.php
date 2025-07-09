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



    }
    public function render()
    {

        $noteTrackingMeta = NoteTrackingMeta::
            leftJoin('note_tracking_contents', 'note_tracking_metas.id', '=', 'note_tracking_contents.note_meta_id')
            ->leftJoin('note_tracking_movements', 'note_tracking_metas.id', '=', 'note_tracking_movements.note_meta_id')
            ->where('note_tracking_metas.is_active', 1)
            ->orderBy('note_tracking_metas.created_at', 'desc')
            ->get();

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
    public $note_meta_id;
    public $noteTitle;
    public $referenceNo;

    public function saveforward()
    {

        // Validation
        $this->validate([
            'forwardToOfficeID'     => 'required|integer',
            'forwardToEmployee'     => 'required|integer',
            'forwardMessage'        => 'nullable|string|max:1000',
        ]);

        try {
            // Save movement or forward logic
            NoteTrackingMovement::create([
                'note_meta_id' => $this->note_meta_id,
                'note_action'  => 'forwarded',
                'from_user'    => $this->initiatedBy, // or $this->initiatedBy
                'to_user'      => $this->forwardToEmployee,
                'status'       => 'forwarded',
                'is_active'    => 1,
            ]);

            session()->flash('message', 'Note forwarded successfully.');
            $this->showForwardModal = false;
            // Optional: Reset values and close modal via browser event
            $this->reset(['forwardMessage', 'forwardToOfficeID', 'forwardToEmployee','note_meta_id']);
           // $this->dispatchBrowserEvent('close-forward-modal');

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to forward note: ' . $e->getMessage());
        }
    }



    public function showForwardModalFun($id)
    {
        $this->resetValidation(['forwardToOfficeID', 'forwardToEmployee']);


        $noteTrackingMeta = NoteTrackingMeta::
        leftJoin('note_tracking_contents', 'note_tracking_metas.id', '=', 'note_tracking_contents.note_meta_id')
            ->leftJoin('note_tracking_movements', 'note_tracking_metas.id', '=', 'note_tracking_movements.note_meta_id')
            ->where('note_tracking_metas.is_active', 1)
            ->orderBy('note_tracking_metas.created_at', 'desc')
            ->where('note_tracking_metas.id', $id)
            ->first();

        if ($noteTrackingMeta) {
            $this->note_meta_id = $noteTrackingMeta->id;
            $this->noteTitle = $noteTrackingMeta->title;
            $this->referenceNo = $noteTrackingMeta->reference_no;
            $this->forwardToOfficeID =  session('user')['body_id'];;
            $this->showForwardModal = true;
        }
        //dd($noteTrackingMeta);
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

        $noteMoveHistory = [
        [
            'action'      => 'Created',
            'person'      => 'John Doe',
            'email'       => 'john.doe@company.com',
            'date'        => 'May 20, 2025 11:00 AM',
            'description' => 'Quarterly sales report created',
            'status'      => 'created',
        ],
        [
            'action'            => 'Forwarded',
            'person'            => 'John Doe',
            'email'             => 'john.doe@company.com',
            'forwardedTo'       => 'Sarah Davis',
            'forwardedToEmail'  => 'sarah.davis@company.com',
            'date'              => 'May 20, 2025 11:30 AM',
            'description'       => 'Sent to Sarah Davis for analysis',
            'status'            => 'forwarded',
        ],
        [
            'action'      => 'Received',
            'person'      => 'Sarah Davis',
            'email'       => 'sarah.davis@company.com',
            'date'        => 'May 20, 2025 02:15 PM',
            'description' => 'Note received and reviewed',
            'status'      => 'received',
        ],
        [
            'action'            => 'Assigned',
            'person'            => 'Sarah Davis',
            'email'             => 'sarah.davis@company.com',
            'forwardedTo'       => 'Tom Wilson',
            'forwardedToEmail'  => 'tom.wilson@company.com',
            'date'              => 'May 21, 2025 09:00 AM',
            'description'       => 'Assigned to Tom Wilson for final review',
            'status'            => 'forwarded',
        ],
        [
            'action'      => 'Received',
            'person'      => 'Tom Wilson',
            'email'       => 'tom.wilson@company.com',
            'date'        => 'May 21, 2025 10:30 AM',
            'description' => 'Final review completed',
            'status'      => 'received',
        ],
        [
            'action'      => 'Closed',
            'person'      => 'Tom Wilson',
            'email'       => 'tom.wilson@company.com',
            'date'        => 'May 22, 2025 04:00 PM',
            'description' => 'Report approved and archived',
            'status'      => 'closed',
        ],
    ];
        $this->movementHistory=$noteMoveHistory;

    }
    public  function closeMovementModalFun()
    {

        $this->showViewMovementHistorydModal = false;
    }

}
