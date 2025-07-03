<!-- resources/views/livewire/patient-info-form.blade.php -->
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-2">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h2 class="text-2xl font-bold mb-6">View Patient Information </h2>
                </div>
                <div class="text-right">
                    <x-nav-link :href="route('patient.list')" :active="request()->routeIs('patient.list')"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded  inline-block">
                        {{ __('Patient Record') }}
                    </x-nav-link>
                </div>
            </div>
            <!-- Success Message -->
            @if (session()->has('message'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('message') }}
                </div>
            @endif

            <div class="mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div >
                        <h3 class="text-lg font-semibold mb-4">Personal Information</h3>
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full table-bordered border border-gray-300">
                                <tbody class="bg-white divide-y divide-gray-200">
                                @if(isset($patient))
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Name</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Age</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->age ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Gender</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">
                                            @if($patient->gender == '1')
                                                Male
                                            @elseif($patient->gender == '2')
                                                Female
                                            @elseif($patient->gender == '3')
                                                Other
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Religion</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $religions[$patient->religion] ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Occupation</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $occupations[$patient->occupation] ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Education Status</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $educations[$patient->education_status] ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Monthly Income</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $monthlyIncomes[$patient->monthly_income] ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">District</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $districts[$patient->district_id] ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Address</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->address ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Contact Number</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->contact_number ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Blood Group</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $bloodGroups[$patient->blood_group] ?? 'N/A' }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="2" class="px-2 py-2 text-center text-sm text-gray-500">No patient data available.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div >
                        <h3 class="text-lg font-semibold mb-4">Hospital Information</h3>
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full table-bordered border border-gray-300">
                                <tbody class="bg-white divide-y divide-gray-200">
                                @if(isset($patient))
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Hospital Registration No</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->hospital_reg_no ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Diagnosis</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->diagnosis ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Ward No</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->ward_no ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Bed No</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->bed_no ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Admission Date</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->admission_date ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Discharge Date</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->discharge_date ?? 'N/A' }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="2" class="px-2 py-2 text-center text-sm text-gray-500">No hospital data available.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>


                    </div>
                    <div >
                        <h3 class="text-lg font-semibold mb-4">Patient Diseases Information</h3>
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full table-bordered border border-gray-300">
                                <tbody class="bg-white divide-y divide-gray-200">
                                @if(isset($patient))
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Chief Complaints</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->chief_complaints ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">H/O Present Illness</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->present_illness ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">H/O Past Illness</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->past_illness ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Comorbidities</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->comorbidities ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Family History</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->family_history ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Drug History</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->drug_history ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Previous Treatment History</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->previous_treatment_history ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Clinical Findings</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->clinical_findings ?? 'N/A' }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="2" class="px-2 py-2 text-center text-sm text-gray-500">No disease data available.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="pb-4 py-6">
                            <h3 class="text-lg font-semibold mb-4">Surgical and Death Information</h3>
                            <table class="table-auto w-full table-bordered border border-gray-300">
                                <tbody class="bg-white divide-y divide-gray-200">
                                @if(isset($patient))
                                    <!-- Surgical Information -->
                                    <tr>
                                        <td colspan="2" class="px-2 py-2 text-lg font-medium text-black-700 text-center">Surgical Information</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Name of Surgeon</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->name_of_surgeon ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Name of Surgeon Assistant</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->name_of_surgeon_assistant ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Name of Operation</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->name_of_operation ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Date of Operation</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->date_of_operation ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Name of Anesthesia</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->name_of_anesthesia ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Operative Findings</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->operative_findings ?? 'N/A' }}</td>
                                    </tr>
                                    <!-- Death Information -->
                                    <tr>
                                        <td colspan="2" class="px-2 py-2 text-lg font-medium text-black-700 text-center">Death Information</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Date of Death</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->date_of_death ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Causes of Death</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->causes_death ?? 'N/A' }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="2" class="px-2 py-2 text-center text-sm text-gray-500">No surgical or death data available.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="pb-4 py-6">
                            <h3 class="text-lg font-semibold mb-4">Follow Up Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                                <div>
                                    <table class="min-w-full divide-y divide-gray-200 border-1 border-gray-200">
                                        <thead class="bg-gray-100">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border border-gray-300">Clinical Features</th>

                                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border border-gray-300">Investigation</th>
                                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 border border-gray-300">Follow Up Description</th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        @if(!empty($folloupRows))
                                            @foreach ($folloupRows as $index => $row)
                                                <tr>
                                                    <td class="px-6 py-4 text-sm text-gray-900 border border-gray-300">{{ $row->clinical_features ?? 'N/A' }}</td>
                                                    <td class="px-6 py-4 text-sm text-gray-900 border border-gray-300">{{ $row->investigation ?? 'N/A' }}</td>
                                                    <td class="px-6 py-4 text-sm text-gray-900 border border-gray-300">{{ $row->followup_description ?? 'N/A' }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 border border-gray-300">No follow-up data available.</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="border-b pb-4">
                            <h3 class="text-lg font-semibold mb-4">Investigation Information</h3>
                            <table class="table-auto w-full table-bordered border border-gray-300">
                                <tbody class="bg-white divide-y divide-gray-200">
                                @if(isset($patient))
                                    <!-- CBC Result -->
                                    <tr>
                                        <td colspan="2" class="px-2 py-2 text-lg font-medium text-black-700 text-center">CBC Result</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Hb%</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->hb_per ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">RBC</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->cbc_rbc ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">WBC</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->cbc_wbc ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">PLT</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->cbc_plt ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">ESR</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->cbc_esr ?? 'N/A' }}</td>
                                    </tr>
                                    <!-- S. Electrolytes -->
                                    <tr>
                                        <td colspan="2" class="px-2 py-2 text-lg font-medium text-black-700 text-center">S. Electrolytes</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Na+</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->electrolytes_na ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">K+</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->electrolytes_k ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Cl</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->electrolytes_cl ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">HCO3</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->electrolytes_hco3 ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="px-2 py-2 text-lg font-medium text-black-700 text-center py-4"></td>
                                    </tr>
                                    <!-- S. Creatinine -->
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">S. Creatinine</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->s_creatinine ?? 'N/A' }}</td>
                                    </tr>
                                    <!-- S. Urea -->
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">S. Urea</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->s_urea ?? 'N/A' }}</td>
                                    </tr>
                                    <!-- LFT -->
                                    <tr>
                                        <td colspan="2" class="px-2 py-2 text-lg font-medium text-black-700 text-center">LFT</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Bilirubin</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->lft_bilirubin ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">SGPT</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->lft_sgpt ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">SGOT</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->lft_sgot ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">GGT</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->lft_ggt ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">AST</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->lft_ast ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">ALP</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->lft_alp ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table-auto w-full table-bordered border border-gray-300 my-4">
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <!-- S. Albumin -->
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">S. Albumin</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->s_albumin ?? 'N/A' }}</td>
                                    </tr>
                                    <!-- S. Lipase -->
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">S. Lipase</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->s_lipase ?? 'N/A' }}</td>
                                    </tr>
                                    <!-- S. Amylase -->
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">S. Amylase</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->s_amylase ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table-auto w-full table-bordered border border-gray-300 my-4">
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <!-- Blood Glucose -->
                                    <tr>
                                        <td colspan="2" class="px-2 py-2 text-lg font-medium text-black-700 text-center">Blood Glucose</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">RBS</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->blood_glucose_rbs ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">FBS</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->blood_glucose_fbs ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">2HABS</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->blood_glucose_2habs ?? 'N/A' }}</td>
                                    </tr>
                                    <!-- Imaging and Other Tests -->
                                </tbody>
                            </table>
                            <table class="table-auto w-full table-bordered border border-gray-300 my-4">
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">X-Ray</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->x_ray ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">ECG</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->ecg ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">USG</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->usg ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">CT Scan</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->ct_scan ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">MRI</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->mri ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">MRCP</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->mrcp ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">ERCP</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->ercp ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Endoscopy</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->endoscopy ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Colonoscopy</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->colonoscopy ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">FNAC</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->fnac ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Histopathology</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->histopathology ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Immuno Histochemistry</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->immuno_histochemistry ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Genetic Analysis</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->genetic_analysis ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-2 text-sm font-medium text-gray-700">Others</td>
                                        <td class="px-2 py-2 text-sm text-gray-900">{{ $patient->others ?? 'N/A' }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="2" class="px-2 py-2 text-center text-sm text-gray-500">No investigation data available.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>



                </div>
            </div>

        </div>
    </div>
</div>
