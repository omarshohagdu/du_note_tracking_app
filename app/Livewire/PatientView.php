<?php

namespace App\Livewire;

use App\Models\AllSetting;
use App\Models\District;
use App\Models\Patient;
use App\Models\PatientFollowHistory;
use Livewire\Component;

class PatientView extends Component
{
    public function mount($id = null)
    {
        if ($id === null) {
            abort(404); // or some fallback
        }
        $this->id           = $id;
    }
    public function render()
    {
        $patient            = !empty($this->id)? Patient::find($this->id) :'';

        $religions          =   AllSetting::where(['type'=>1,'is_active'=>1])->pluck('title','id');
        $occupations        =   AllSetting::where(['type'=>2,'is_active'=>1])->pluck('title','id');
        $educations         =   AllSetting::where(['type'=>3,'is_active'=>1])->pluck('title','id');
        $monthlyIncomes     =   AllSetting::where(['type'=>4,'is_active'=>1])->pluck('title','id');
        $bloodGroups        =   AllSetting::where(['type'=>5,'is_active'=>1])->pluck('title','id');
        $districts          =   District::where('is_active',1) ->orderBy('name')->pluck('name','id');

        $patientFollowUp = PatientFollowHistory::where('patient_id', $this->id)
            ->get();


        return view('livewire.patient.view',[
            'patient'           =>  $patient,
            'religions'         =>  $religions,
            'occupations'       =>  $occupations,
            'educations'        =>  $educations,
            'monthlyIncomes'    =>  $monthlyIncomes,
            'bloodGroups'       =>  $bloodGroups,
            'districts'         =>  $districts,
            'folloupRows'       =>  $patientFollowUp,
        ]);

        //return view('livewire.patient-view');
    }
}
