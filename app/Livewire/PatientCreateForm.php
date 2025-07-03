<?php

namespace App\Livewire;

use App\Models\AllSetting;
use App\Models\District;
use Livewire\Component;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;

class PatientCreateForm extends Component
{
    public $currentTab = 'personal'; // Default tab
    public function switchTab($tab)
    {
        $this->currentTab = $tab;
    }
    public $form = [
        'name' => '',
        'age' => '',
        'gender' => '',
        'district_id' => '',
        'address' => '',
        'religion' => '',
        'occupation' => '',
        'education_status' => '',
        'monthly_income' => '',
        'pt_contact_number' => '',
        'blood_group' => '',
        'hospital_reg_no' => '',
        'unit' => '',
        'ward_no' => '',
        'bed_no' => '',
        'admission_date' => '',
        'discharge_date' => '',
        'diagnosis' => '',
        'chief_complaints' => '',
        'present_illness' => '',
        'past_illness' => '',
        'comorbidities' => '',
        'family_history' => '',
        'drug_history' => '',
        'previous_drug_history' => '',
        'previous_treatment_history' => '',
        'clinical_findings' => '',
        'cbc_result' => '',
        's_electrolytes' => '',
        's_creatinine' => '',
        's_urea' => '',
        'lft' => '',
        's_bilirubin' => '',
        'sgpt' => '',
        'sgot' => '',
        'ggt' => '',
        'ast' => '',
        's_albumin' => '',
        's_lipase' => '',
        's_amylase' => '',
        'blood_glucose' => '',
        'x_ray' => '',
        'ecg' => '',
        'usg' => '',
        'ct_scan' => '',
        'mri' => '',
        'mrcp' => '',
        'ercp' => '',
        'endoscopy' => '',
        'colonoscopy' => '',
        'fnac' => '',
        'histopathology' => '',
        'immuno_histochemistry' => '',
        'genetic_analysis' => '',
        'others' => '',

        'name_of_surgeon' => '',
        'name_of_surgeon_assistant' => '',
        'name_of_operation' => '',
        'date_of_operation' => '',
        'name_of_anesthesia' => '',
        'operative_findings' => '',
        'date_of_death' => '',
        'causes_death' => '',
    ];


    public function render()
    {
        $religions          =   AllSetting::where(['type'=>1,'is_active'=>1])->pluck('title','id');
        $occupations        =   AllSetting::where(['type'=>2,'is_active'=>1])->pluck('title','id');
        $educations         =   AllSetting::where(['type'=>3,'is_active'=>1])->pluck('title','id');
        $monthlyIncomes     =   AllSetting::where(['type'=>4,'is_active'=>1])->pluck('title','id');
        $bloodGroups        =   AllSetting::where(['type'=>5,'is_active'=>1])->pluck('title','id');
        $districts           =  District::where('is_active',1) ->orderBy('name')->pluck('name','id');

        return view('livewire.patient.create',
            [   'religions'     =>  $religions,
                'occupations'   =>  $occupations,
                'educations'    =>  $educations,
                'monthlyIncomes'=>  $monthlyIncomes,
                'bloodGroups'   =>  $bloodGroups,
                'districts'     =>  $districts
            ]);
    }
    public function submitPersonalInfo(){

        $validated = $this->validate([
            'form.name'         => 'required|string|max:300',
            'form.age'          => 'required|string|max:255',
            'form.gender'       => 'required|integer',
            'form.religion'     => 'required|integer',
            'form.occupation'   => 'required|integer',
            'form.education_status' => 'required|integer',
            'form.monthly_income'   => 'required|integer',
            'form.district_id'      => 'required|integer',
            'form.address'          => 'nullable|string|max:1000',
            'form.contact_number'   => 'required|string',
            'form.blood_group'      => 'nullable|integer',
        ], [
            'form.name.required'            => 'Patient name is required.',
            'form.age.required'             => 'Age is required.',
            'form.gender.required'          => 'Please select a gender.',
            'form.religion.required'        => 'Please select a religion.',
            'form.occupation.required'      => 'Please select an occupation.',
            'form.education_status.required'=> 'Please select an education status.',
            'form.monthly_income.required'  => 'Monthly income must be selected.',
            'form.district_id.required'     => 'District is required.',
            'form.contact_number.required'  => 'Contact number is required.',
            'form.blood_group.required'     => 'Contact Blood Group is required.',
        ]);

        DB::beginTransaction();

        try {
            $totalCount = Patient::count();
            $totalCount = $totalCount > 0 ? $totalCount + 1 : 1;

            $patient = Patient::create([
                'patient_id'            => date('ym') . rand(10,99) . str_pad($totalCount, 4, '0', STR_PAD_LEFT),
                'name'                  => $validated['form']['name'],
                'age'                   => $validated['form']['age'],
                'gender'                => $validated['form']['gender'],
                'religion'              => $validated['form']['religion'],
                'occupation'            => $validated['form']['occupation'],
                'education_status'      => $validated['form']['education_status'],
                'monthly_income'        => $validated['form']['monthly_income'],
                'district_id'           => $validated['form']['district_id'],
                'address'               => $validated['form']['address'] ?? null,
                'pt_contact_number'     => $validated['form']['contact_number'],
                'blood_group'           => $validated['form']['blood_group'] ?? null,
                'created_ip'            => request()->ip(),
                'created_by'            => auth()->id(),
            ]);
            DB::commit();
            session()->flash('success', 'Personal information saved successfully!');
            return redirect()->route('patient.edit', ['id' => $patient->id, 'tab' => 'hospital']);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Something went wrong while saving the patient data.');
            return back()->withInput();
        }



    }
}
