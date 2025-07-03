<form wire:submit.prevent="submitPatientDiseases" class="space-y-6">
    <div class="border-b pb-4">
        <h3 class="text-lg font-semibold mb-4">Patient Disease Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="diagnosis" class="block text-sm font-medium text-gray-700">Chief Complaints</label>
                <select id="chief_complaints"  wire:model="form.chief_complaints" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Select Chief Complaints</option>
                    @foreach($cfRecords ?? [] as $key => $cf)
                        <option value="{{ $key }}" > {{ $cf }}</option>
                    @endforeach
                </select>

                @error('form.chief_complaints') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="present_illness" class="block text-sm font-medium text-gray-700">H/O Present illness:</label>
                <input type="text" placeholder="H/O Present illness" id="present_illness" wire:model.debounce.500ms="form.present_illness" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('form.present_illness') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="past_illness" class="block text-sm font-medium text-gray-700">H/O Past Illness</label>
                <input type="text" placeholder="H/O Past Illness" id="past_illness" wire:model.debounce.500ms="form.past_illness" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('form.past_illness') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="comorbidities" class="block text-sm font-medium text-gray-700">Comorbidities</label>
                <input type="text" placeholder="Comorbidities" id="comorbidities" wire:model.debounce.500ms="form.comorbidities" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('form.comorbidities') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="family_history" class="block text-sm font-medium text-gray-700">Family History</label>
                <textarea id="family_history" placeholder="Family History" wire:model.debounce.500ms="form.family_history" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                @error('form.family_history') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="drug_history" class="block text-sm font-medium text-gray-700">Drug History</label>
                <textarea id="drug_history" placeholder="Drug History" wire:model.debounce.500ms="form.drug_history" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                @error('form.drug_history') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="previous_treatment_history" class="block text-sm font-medium text-gray-700">Previous Treatment History</label>
                <textarea id="previous_treatment_history" placeholder="Previous Treatment History" wire:model.debounce.500ms="form.previous_treatment_history" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                @error('form.previous_treatment_history') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="clinical_findings" class="block text-sm font-medium text-gray-700">Clinical Findings</label>
                <textarea id="clinical_findings" placeholder="Clinical Findings" wire:model.debounce.500ms="form.clinical_findings" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                @error('form.clinical_findings') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        <!-- Submit and Cancel Buttons -->
        <div class="flex justify-end space-x-4 mt-6">

            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Save Disease </button>
            <button type="button" wire:click="switchTab('diagnostic')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Next</button>
        </div>
    </div>
</form>
