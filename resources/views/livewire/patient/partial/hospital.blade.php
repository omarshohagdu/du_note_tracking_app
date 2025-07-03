<form wire:submit.prevent="submitHospital" class="space-y-6">
    <div class="border-b pb-4">
        <h3 class="text-lg font-semibold mb-4">Hospital Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="hospital_reg_no" class="block text-sm font-medium text-gray-700">Hospital Registration No</label>
                <input type="text" placeholder="Enter Hospital Registration No" id="hospital_reg_no" wire:model.debounce.500ms="form.hospital_reg_no" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('form.hospital_reg_no') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="diagnosis" class="block text-sm font-medium text-gray-700">Diagnosis</label>
                <select id="diagnosis"  wire:model="form.diagnosis" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Select Diagnosis</option>
                    @foreach($ptDiagonsises ?? [] as $key => $ptDiagonsis)
                        <option value="{{ $key }}" > {{ $ptDiagonsis }}</option>
                    @endforeach
                </select>

                @error('form.diagnosis') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="ward_no" class="block text-sm font-medium text-gray-700">Ward No</label>
                <input type="text" id="ward_no" placeholder="Enter Ward No" wire:model.debounce.500ms="form.ward_no" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('form.ward_no') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="bed_no" class="block text-sm font-medium text-gray-700">Bed No</label>
                <input type="text" id="bed_no" placeholder="Enter Bed No" wire:model.debounce.500ms="form.bed_no" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('form.bed_no') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="admission_date" class="block text-sm font-medium text-gray-700">Admission Date</label>
                <input type="date" id="admission_date"  wire:model="form.admission_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" >
                @error('form.admission_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="discharge_date" class="block text-sm font-medium text-gray-700">Discharge Date</label>
                <input type="date"  id="discharge_date" wire:model="form.discharge_date"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('form.discharge_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        <!-- Submit and Cancel Buttons -->
        <div class="flex justify-end space-x-4 mt-6">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Save Hospital Info.</button>
            <a href="{{ route('patient.list') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
        </div>
    </div>
</form>
