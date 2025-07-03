<form wire:submit.prevent="submitTreatmentInfo" class="space-y-6">
    <div class="border-b pb-4">
        <h3 class="text-lg font-semibold mb-4">Surgical Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="name_of_surgeon" class="block text-sm font-medium text-gray-700">Name of Surgeon</label>
                <input type="text" id="name_of_surgeon" placeholder="Enter the Name of Surgeon " wire:model.debounce.500ms="form.name_of_surgeon" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('form.name_of_surgeon') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="name_of_surgeon_assistant" class="block text-sm font-medium text-gray-700">Name of Surgeon Assistant</label>
                <input type="text" placeholder="Name of Surgeon Assistant" id="name_of_surgeon_assistant" wire:model.debounce.500ms="form.name_of_surgeon_assistant" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('form.name_of_surgeon_assistant') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>

                <label for="name_of_operation" class="block text-sm font-medium text-gray-700">Name of Operation</label>
                <select id="name_of_operation" wire:model="form.name_of_operation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Select Name of Operation</option>
                    @foreach($nameOfOperations ?? [] as $key => $operationName)
                        <option value="{{ $key }}" > {{ $operationName }}</option>
                    @endforeach
                </select>
                @error('form.name_of_operation') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="date_of_operation" class="block text-sm font-medium text-gray-700">Date of Operation</label>
                <input type="date" id="date_of_operation" wire:model.debounce.500ms="form.date_of_operation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('form.date_of_operation') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="name_of_anesthesia" class="block text-sm font-medium text-gray-700">Name of Anesthesia</label>
                <input type="text" placeholder="Name of Anesthesia" id="name_of_anesthesia" wire:model.debounce.500ms="form.name_of_anesthesia" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('form.name_of_anesthesia') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="operative_findings" class="block text-sm font-medium text-gray-700">Operation Note</label>
                <textarea id="operative_findings" placeholder="Operation Note" wire:model.debounce.500ms="form.operative_findings" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                @error('form.operative_findings') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        <h3 class="text-lg font-semibold mb-4">Death Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="date_of_death" class="block text-sm font-medium text-gray-700">Date of Death</label>
                <input type="date" id="date_of_death" wire:model.debounce.500ms="form.date_of_death"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('form.date_of_death') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="causes_death" class="block text-sm font-medium text-gray-700">Causes of Death</label>
                <textarea id="causes_death" placeholder="Causes of Death" wire:model.debounce.500ms="form.causes_death" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                @error('form.causes_death') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        <!-- Submit and Cancel Buttons -->
        <div class="flex justify-end space-x-4 mt-6">

            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Update Treatment Info</button>
            <a href="{{ route('patient.list') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
        </div>
    </div>
</form>
