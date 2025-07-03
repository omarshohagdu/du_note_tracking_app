<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold mb-6">Patient Information Form</h2>
                <x-nav-link :href="route('patient.list')" :active="request()->routeIs('patient.create')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">
                    {{ __(' Patient Record') }}
                </x-nav-link>
                @if (session()->has('message'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                        {{ session('message') }}
                    </div>
                @endif

                <form wire:submit.prevent="submit" class="space-y-6">
                    <!-- Personal Information -->
                    <div class="border-b pb-4">
                        <h3 class="text-lg font-semibold mb-4">Personal Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="patient_id" class="block text-sm font-medium text-gray-700">Patient ID</label>
                                <input type="number" id="patient_id" wire:model.debounce.500ms="form.patient_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.patient_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" id="name" wire:model.debounce.500ms="form.name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                                <input type="number" id="age" wire:model.debounce.500ms="form.age" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.age') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                                <select id="gender" wire:model="form.gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Select Gender</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                    <option value="3">Other</option>
                                </select>
                                @error('form.gender') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="district_id" class="block text-sm font-medium text-gray-700">District ID</label>
                                <input type="number" id="district_id" wire:model.debounce.500ms="form.district_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.district_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                <textarea id="address" wire:model.debounce.500ms="form.address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                @error('form.address') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="religion" class="block text-sm font-medium text-gray-700">Religion</label>
                                <input type="number" id="religion" wire:model.debounce.500ms="form.religion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.religion') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="occupation" class="block text-sm font-medium text-gray-700">Occupation</label>
                                <input type="number" id="occupation" wire:model.debounce.500ms="form.occupation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.occupation') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="education_status" class="block text-sm font-medium text-gray-700">Education Status</label>
                                <input type="number" id="education_status" wire:model.debounce.500ms="form.education_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.education_status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="monthly_income" class="block text-sm font-medium text-gray-700">Monthly Income</label>
                                <input type="number" id="monthly_income" wire:model.debounce.500ms="form.monthly_income" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.monthly_income') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Contact Details -->
                    <div class="border-b pb-4">
                        <h3 class="text-lg font-semibold mb-4">Contact Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="contact_number" class="block text-sm font-medium text-gray-700">Contact Number</label>
                                <input type="text" id="contact_number" wire:model.debounce.500ms="form.contact_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.contact_number') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="blood_group" class="block text-sm font-medium text-gray-700">Blood Group</label>
                                <input type="text" id="blood_group" wire:model.debounce.500ms="form.blood_group" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.blood_group') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Hospital Information -->
                    <div class="border-b pb-4">
                        <h3 class="text-lg font-semibold mb-4">Hospital Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="hospital_reg_no" class="block text-sm font-medium text-gray-700">Hospital Registration No</label>
                                <input type="text" id="hospital_reg_no" wire:model.debounce.500ms="form.hospital_reg_no" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.hospital_reg_no') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="unit" class="block text-sm font-medium text-gray-700">Unit</label>
                                <input type="number" id="unit" wire:model.debounce.500ms="form.unit" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.unit') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="ward_no" class="block text-sm font-medium text-gray-700">Ward No</label>
                                <input type="text" id="ward_no" wire:model.debounce.500ms="form.ward_no" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.ward_no') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="bed_no" class="block text-sm font-medium text-gray-700">Bed No</label>
                                <input type="text" id="bed_no" wire:model.debounce.500ms="form.bed_no" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.bed_no') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="admission_date" class="block text-sm font-medium text-gray-700">Admission Date</label>
                                <input type="date" id="admission_date" wire:model.debounce.500ms="form.admission_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.admission_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="discharge_date" class="block text-sm font-medium text-gray-700">Discharge Date</label>
                                <input type="date" id="discharge_date" wire:model.debounce.500ms="form.discharge_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.discharge_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Medical History -->
                    <div class="border-b pb-4">
                        <h3 class="text-lg font-semibold mb-4">Medical History</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="diagnosis" class="block text-sm font-medium text-gray-700">Diagnosis</label>
                                <input type="number" id="diagnosis" wire:model.debounce.500ms="form.diagnosis" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.diagnosis') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="present_illness" class="block text-sm font-medium text-gray-700">Present Illness</label>
                                <input type="text" id="present_illness" wire:model.debounce.500ms="form.present_illness" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.present_illness') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="past_illness" class="block text-sm font-medium text-gray-700">Past Illness</label>
                                <input type="text" id="past_illness" wire:model.debounce.500ms="form.past_illness" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.past_illness') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="comorbidities" class="block text-sm font-medium text-gray-700">Comorbidities</label>
                                <input type="text" id="comorbidities" wire:model.debounce.500ms="form.comorbidities" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.comorbidities') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="family_history" class="block text-sm font-medium text-gray-700">Family History</label>
                                <textarea id="family_history" wire:model.debounce.500ms="form.family_history" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                @error('form.family_history') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="drug_history" class="block text-sm font-medium text-gray-700">Drug History</label>
                                <textarea id="drug_history" wire:model.debounce.500ms="form.drug_history" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                @error('form.drug_history') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="previous_drug_history" class="block text-sm font-medium text-gray-700">Previous Drug History</label>
                                <textarea id="previous_drug_history" wire:model.debounce.500ms="form.previous_drug_history" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                @error('form.previous_drug_history') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="clinical_findings" class="block text-sm font-medium text-gray-700">Clinical Findings</label>
                                <textarea id="clinical_findings" wire:model.debounce.500ms="form.clinical_findings" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                @error('form.clinical_findings') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Diagnostic Tests -->
                    <div class="border-b pb-4">
                        <h3 class="text-lg font-semibold mb-4">Diagnostic Tests</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="cbc_result" class="block text-sm font-medium text-gray-700">CBC Result</label>
                                <textarea id="cbc_result" wire:model.debounce.500ms="form.cbc_result" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                @error('form.cbc_result') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="s_electrolytes" class="block text-sm font-medium text-gray-700">S. Electrolytes</label>
                                <textarea id="s_electrolytes" wire:model.debounce.500ms="form.s_electrolytes" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                @error('form.s_electrolytes') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <!-- Add similar fields for s_creatinine, s_urea, lft, s_bilirubin, sgpt, sgot, ggt, ast, s_albumin, s_lipase, s_amylase, blood_glucose, x_ray, ecg, usg, ct_scan, mri, mrcp, ercp, endoscopy, colonoscopy, fnac, histopathology, immuno_histochemistry, genetic_analysis, others -->
                        </div>
                    </div>

                    <!-- Surgical Information -->
                    <div class="border-b pb-4">
                        <h3 class="text-lg font-semibold mb-4">Surgical Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name_of_surgeon" class="block text-sm font-medium text-gray-700">Name of Surgeon</label>
                                <input type="text" id="name_of_surgeon" wire:model.debounce.500ms="form.name_of_surgeon" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.name_of_surgeon') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="name_of_surgeon_assistant" class="block text-sm font-medium text-gray-700">Name of Surgeon Assistant</label>
                                <input type="text" id="name_of_surgeon_assistant" wire:model.debounce.500ms="form.name_of_surgeon_assistant" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.name_of_surgeon_assistant') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="name_of_operation" class="block text-sm font-medium text-gray-700">Name of Operation</label>
                                <input type="text" id="name_of_operation" wire:model.debounce.500ms="form.name_of_operation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.name_of_operation') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="date_of_operation" class="block text-sm font-medium text-gray-700">Date of Operation</label>
                                <input type="date" id="date_of_operation" wire:model.debounce.500ms="form.date_of_operation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.date_of_operation') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="name_of_anesthesia" class="block text-sm font-medium text-gray-700">Name of Anesthesia</label>
                                <input type="text" id="name_of_anesthesia" wire:model.debounce.500ms="form.name_of_anesthesia" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.name_of_anesthesia') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="operative_findings" class="block text-sm font-medium text-gray-700">Operative Findings</label>
                                <textarea id="operative_findings" wire:model.debounce.500ms="form.operative_findings" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                @error('form.operative_findings') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Outcome -->
                    <div class="border-b pb-4">
                        <h3 class="text-lg font-semibold mb-4">Outcome</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="date_of_death" class="block text-sm font-medium text-gray-700">Date of Death</label>
                                <input type="date" id="date_of_death" wire:model.debounce.500ms="form.date_of_death" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @error('form.date_of_death') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="causes_death" class="block text-sm font-medium text-gray-700">Causes of Death</label>
                                <textarea id="causes_death" wire:model.debounce.500ms="form.causes_death" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                @error('form.causes_death') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
