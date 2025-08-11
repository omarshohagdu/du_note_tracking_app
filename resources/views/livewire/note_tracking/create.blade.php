<!-- resources/views/livewire/patient-info-form.blade.php -->
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-2">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class=" px-4 ">
                    <h2 class="text-2xl font-bold mb-6">Create Note Information</h2>
                </div>
                <div class="text-right">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded  inline-block">
                        {{ __(' Record') }}
                    </x-nav-link>
                </div>
            </div>
            <!-- Success Message -->
            @if (session()->has('message'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Inline Tabs Navigation -->
            <div id="create" class="tab-content p-6">
                <form wire:submit.prevent="submitNoteInfo" class="space-y-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Note Type</label>
                            <label class="mr-5 inline-flex items-center">
                                <input type="radio" wire:model.live="noteType" wire:click="ToggleNoteType('online')" value="online" id="online" class="noteTypeClass" >
                                <span class="ml-2">Online Note</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" wire:model.live="noteType" wire:click="ToggleNoteType('offline')" value="offline" id="offline" class="noteTypeClass">
                                <span class="ml-2">Offline Note</span>
                            </label>
                            <br/>
                            @error('noteType') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="initiatedBy" class="text-gray-700 font-medium mb-1">Initiated by</label>
                            <select id="initiatedBy" wire:model="initiatedBy" class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none">
                                <option value="">-- Choose a Person --</option>
                                @if(!empty($employeeList))
                                    @foreach($employeeList as $employee)
                                        <option value="{{ $employee['employee_id'] }}">
                                            {{ $employee['emp_name'] }} ({{ $employee['emp_id'] }} - {{ $employee['designation_title'] }})
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('initiatedBy') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="noteTitle" class="text-gray-700 font-medium mb-1">Note Title</label>
                            <input type="text" id="noteTitle" wire:model="noteTitle" class="w-full px-4 py-2 border rounded shadow-sm focus:ring-blue-500" placeholder="Enter note title">
                            @error('noteTitle') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="noteRefNo" class="text-gray-700 font-medium mb-1">Note Reference Number</label>
                            <input type="text" id="noteRefNo" wire:model="noteRefNo" class="w-full px-4 py-2 border rounded shadow-sm focus:ring-blue-500" placeholder="Enter Reference Number">
                            @error('noteRefNo') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Online Note --}}
                    <div class="{{ $noteType === 'online' ? '' : 'hidden' }}">
                        <label for="noteContent" class="text-gray-700 font-medium mb-1">Note Body (Online)</label>
                        <textarea id="noteContent" wire:model="noteContent" rows="5" class="w-full px-4 py-2 border rounded shadow-sm focus:ring-blue-500" placeholder="Enter note body here..."></textarea>
                        @error('noteContent') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>


                    <div class="flex gap-4 mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Create Note</button>
                        <button type="button" wire:click="resetCreateNoteForm" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">Reset</button>

                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
<script>
    Livewire.on('clear-note-fields', () => {
        const radios = document.getElementsByClassName('noteTypeClass');
        for (let i = 0; i < radios.length; i++) {
            radios[i].checked = false;
        }

        document.getElementById('noteTitle').value = '';
        document.getElementById('noteRefNo').value = '';
        document.getElementById('noteContent').value = '';
    });
    Livewire.on('clear-note-type-fields', () => {
        const radios = document.getElementsByClassName('noteTypeClass');

        for(let i = 0; i < radios.length; i++) {
            radios[i].addEventListener('click', function() {
                const clickedValue = this.value;

                for(let j = 0; j < radios.length; j++) {
                    if(radios[j].value !== clickedValue) {
                        radios[j].checked = false; // uncheck other radios
                    }
                }
            });
        }
        document.getElementById('noteContent').value = '';
    });

    window.addEventListener('show-success-alert', event => {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: event.detail.message,
            confirmButtonText: 'OK',
            customClass: {
                popup: 'bg-white dark:bg-gray-800 rounded-lg shadow-lg',
                title: 'text-gray-900 dark:text-white',
                content: 'text-gray-700 dark:text-gray-300',
                confirmButton: 'bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg',
            },
        });
    });

    window.addEventListener('show-error-alert', event => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: event.detail.message,
            confirmButtonText: 'OK',
            customClass: {
                popup: 'bg-white dark:bg-gray-800 rounded-lg shadow-lg',
                title: 'text-gray-900 dark:text-white',
                content: 'text-gray-700 dark:text-gray-300',
                confirmButton: 'bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg',
            },
        });
    });
</script>