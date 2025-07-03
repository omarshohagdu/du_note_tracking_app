<?php

namespace App\Livewire;

use App\Models\AllSetting;
use App\Models\District;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Patient;
use Livewire\WithPagination;
class PatientInfo extends Component
{
    use WithPagination;

    public $patientIdToDelete;

    protected $listeners = [
        'confirmDelete' => 'delete',
    ];

    public function     initiateDelete($id)
    {
        if ($id) {
           // $patient->delete();
            patient::find($id)->delete();
            session()->flash('message', 'Patient deleted successfully!');
        } else {
            session()->flash('error', 'Patient not found.');
        }

        //$this->patientIdToDelete = $id;
        $this->dispatch('showDeleteConfirmation');
    }

    public function delete()
    {
        $patient = Patient::find($this->patientIdToDelete);

        if ($patient) {
            $patient->delete();
            session()->flash('message', 'Patient deleted successfully!');
        } else {
            session()->flash('error', 'Patient not found.');
        }
        $this->patientIdToDelete = null;
    }

    public function editPatient($id)
    {
        //session()->flash('message', 'Edit functionality not implemented yet.'.$id);
          return redirect()->route('patient.edit', $id);
    }

    public function viewPatient($id)
    {
        return redirect()->route('patient.view', $id);
    }

    public function render()
    {
        return view('livewire.patient-info', [
            'patients' => Patient::paginate(10),
        ])->layout('layouts.app');
    }


}
