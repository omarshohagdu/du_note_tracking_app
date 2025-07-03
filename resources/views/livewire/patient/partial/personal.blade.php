<form wire:submit.prevent="submitPersonalInfo" class="space-y-6">
    <div class="border-b pb-4">
        <h3 class="text-lg font-semibold mb-4">Personal Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" wire:model.debounce.500ms="form.name" placeholder="Enter Patient Name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('form.name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                <input type="text" id="age" wire:model.debounce.500ms="form.age" placeholder="Enter Age Exp 20" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @error('form.age') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                <select id="gender" wire:model="form.gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Select Gender</option>
                    <option value="1" >Male</option>
                    <option value="2" >Female</option>
                    <option value="3" >Other</option>
                </select>
                @error('form.gender') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="religion" class="block text-sm font-medium text-gray-700">Religion</label>
                <select id="religion" wire:model="form.religion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Select Religion</option>
                    @foreach($religions ?? [] as $key => $religion)
                        <option value="{{ $key }}" >{{ $religion }}</option>
                    @endforeach
                </select>
                @error('form.religion') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="occupation" class="block text-sm font-medium text-gray-700">Occupation</label>
                <select id="occupation" wire:model="form.occupation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Select Occupation</option>
                    @foreach($occupations ?? [] as $key => $occupation)
                        <option value="{{ $key }}" >{{ $occupation }}</option>
                    @endforeach
                </select>
                @error('form.occupation') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>


            <div>
                <label for="education_status" class="block text-sm font-medium text-gray-700">Education Status</label>
                <select id="education_status" wire:model="form.education_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Select Education Status</option>
                    @foreach($educations ?? [] as $key => $education)
                        <option value="{{ $key }}">{{ $education }}</option>
                    @endforeach
                </select>

                @error('form.education_status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="monthly_income" class="block text-sm font-medium text-gray-700">Monthly Income</label>
                <select id="monthly_income" wire:model="form.monthly_income" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Select Monthly Income</option>
                    @foreach($monthlyIncomes ?? [] as $key => $monthlyIncome)
                        <option value="{{ $key }}" > {{ $monthlyIncome }}</option>
                    @endforeach
                </select>
                @error('form.monthly_income') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="district_id" class="block text-sm font-medium text-gray-700">District </label>
                <select id="district_id" wire:model="form.district_id" class="select2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Select District</option>
                    @foreach($districts ?? [] as $key => $district)
                        <option value="{{ $key }}" >{{ $district }}</option>
                    @endforeach
                </select>
                @error('form.district_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 my-4">
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <textarea id="address" wire:model.debounce.500ms="form.address" placeholder="Enter Address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                @error('form.address') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="contact_number" class="block text-sm font-medium text-gray-700">Contact Number</label>
                <input type="text" id="contact_number" placeholder="Enter Conact Number" wire:model.debounce.500ms="form.contact_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" >
                @error('form.contact_number') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="blood_group" class="block text-sm font-medium text-gray-700">Blood Group</label>
                <select id="blood_group" wire:model="form.blood_group" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Select Blood Group</option>
                    @foreach($bloodGroups ?? [] as $key => $bloodGroup)
                        <option value="{{ $key }}" >{{ $bloodGroup }}</option>
                    @endforeach
                </select>

                @error('form.blood_group') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        <!-- Submit and Cancel Buttons -->
        <div class="flex justify-end space-x-4 mt-6">

            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Submit (Personal)</button>
            <a href="{{ route('patient.list') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
        </div>
    </div>
</form>
