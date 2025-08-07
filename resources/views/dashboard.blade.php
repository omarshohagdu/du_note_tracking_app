<div>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome :myCreatedNotes="$myCreatedNotes" :forwardsNotesToMe="$forwardsNotesToMe" :waitingAcceptedByme="$waitingAcceptedByme" />
                @if(!empty($noteTrackingMeta))
                    @foreach($noteTrackingMeta as $note)
                        <div class="bg-white shadow-md rounded-2xl p-6 mb-6 border-l-4 border-orange-400 m-3">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $note['title'] }}</h3>
                                    <p class="text-sm text-gray-500"><strong>Serial:</strong> {{ $note['reference_no']??NULL }}</p>
                                    <p class="text-sm text-gray-500">Created: {{ formatDate($note['created_at']) }} | Type: {{ $note['type'] }}</p>
                                </div>
                                <span class="bg-orange-100 text-orange-600 text-xs font-semibold px-3 py-1 rounded-full shadow-sm">
                                    {{ $note->latestMovement->status??NULL }}
                                </span>
                            </div>
                            <p class="text-gray-700 mt-4">
                                {{ $note['description'] }}
                            </p>
                            <div class="mt-4 flex gap-4">
                                <button type="button" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg"
                                        wire:click="viewMovementHistoryFun('{{ $note['id'] }}')">
                                    Movement History
                                </button>

                                @if(!empty($note['is_accept_req_to_me']) && $note['is_accept_req_to_me'] == 'Yes')
                                    <div x-data="{ showConfirm: false }" class="inline-block">
                                        <button type="button"
                                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg"
                                                @click="showConfirm = true">
                                            Accept
                                        </button>
                                        <div x-show="showConfirm" x-cloak
                                             class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                                            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm space-y-4">
                                                <h2 class="text-lg font-semibold">Are you sure?</h2>
                                                <p>Do you want to accept this note?</p>
                                                <div class="flex justify-end gap-2">
                                                    <button @click="showConfirm = false"
                                                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                                                    <button @click="$wire.acceptNote('{{ $note['id'] }}','{{ $note->latest_movement->id }}'); showConfirm = false"
                                                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Yes, Accept</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
{{--                                {{ dd($note) }}--}}
                                @if(!empty($note['is_forward_to_me']) && $note['is_forward_to_me'] == 'Yes')
                                    <button type="button" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg"
                                            wire:click="showForwardModalFun('{{ $note['id'] }}')">Forward</button>

                                    <div x-data="{ confirmClose: false, noteId: null }">
                                        <!-- Close Button -->
                                        <button
                                                type="button"
                                                @click="confirmClose = true; noteId = '{{ $note['id'] }}'"
                                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                                            Close
                                        </button>

                                        <!-- Confirmation Modal -->
                                        <div x-show="confirmClose" x-cloak
                                             class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                                            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm space-y-4">
                                                <h2 class="text-lg font-semibold">Are you sure?</h2>
                                                <p>This action cannot be changed.</p>
                                                <div class="flex justify-end gap-2">
                                                    <button @click="confirmClose = false"
                                                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                                                    <button @click="$wire.closeNoteModalFun(noteId); confirmClose = false"
                                                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Yes, Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    @if($showViewMovementHistorydModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white w-full max-w-2xl mx-auto p-6 rounded-xl shadow-lg relative">
                <!-- Modal Header -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Note Movement History</h2>
                    <span wire:click="closeMovementModalFun()" class="text-2xl text-gray-600 cursor-pointer hover:text-black">&times;</span>
                </div>

                <!-- Modal Body -->
                <div id="MovementModalBody" class="text-gray-700 space-y-4">
                    @if (!empty($movementHistory))
                        <div class="mb-5">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $movementHistory->reference_no??NULL }}</h3>
                            <p class="text-sm text-gray-500">{{ $movementHistory->title??NULL }}</p>
                        </div>
                        <div class="relative border-l-2 border-gray-300 pl-6 space-y-6">
                            @foreach ($movementHistory->movementHistory as $index => $item)
                                    <?php
                                    $fromUserData       = !empty($item->from_user)? json_decode($item->from_user, true) : [];
                                    $toUserData         = !empty($item->to_user)? json_decode($item->to_user, true) : [];
                                    ?>
                                <div class="relative">
                                    <div class="absolute -left-3 top-1 w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm font-semibold shadow-md">
                                        {{ $index + 1 }}
                                    </div>
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm">
                                        <div class="flex justify-between items-center mb-1">
                                            <div class="font-medium text-gray-800">{{ $item->status }}</div>
                                            <div class="text-sm text-gray-500">{{ formatDate($item->created_at) }}</div>
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            @if (!empty($fromUserData))
                                                <span class="font-medium text-gray-700"> {{ $fromUserData['emp_name'] ?? '' }} ({{ $fromUserData['email'] ?? '' }}) </span> ({{ $fromUserData['designation_en']??NULL }})<br>
                                            @endif
                                            {{ $item['message']??NULL }}
                                            @if (!empty($toUserData))
                                                <div class="mt-1 text-blue-700">
                                                    @if (empty($fromUserData))
                                                        <strong>→ Created By: </strong> <span class="font-medium">
                                                    @else
                                                                <strong>→ Forwarded to: </strong> <span class="font-medium">
                                                    @endif
                                                                    {{ $toUserData['emp_name'] }}</span> ({{ $toUserData['email'] }})
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-500 py-10">No movement history available for this note.</p>
                    @endif
                </div>

            </div>
        </div>
    @endif

    @if ($showForwardModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white w-full max-w-xl mx-auto p-6 rounded-xl shadow-lg relative">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Forward Notes ({{ $referenceNo }})</h2>

                <!-- Close Button -->
                <button  type="button" wire:click="closeForwardModalFun()" class="absolute top-2 right-3 text-gray-600 hover:text-black text-xl">&times;</button>

                <div class="mb-4">
                    <label for="noteTitle" class="block text-lg font-semibold text-gray-700 mb-2 text-left">Note Title</label>
                    {{ $noteTitle??NULL }}
                    <input type="hidden" wire:model.defer="note_meta_id" id="note_meta_id">
                </div>

                <div class="mb-4">

                    <label for="forwardTo" class="block text-lg font-semibold text-gray-700 mb-2 text-left">
                        Current Owner
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-5">
                        <div>
                            {{ $loginUserName }}
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="forwardTo" class="block text-lg font-semibold text-gray-700 mb-4 text-center">
                        Forward To
                    </label>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        {{-- Office Selector --}}
                        <div
                                x-data="{ value: $wire.entangle('forwardToOfficeID') }"
                                x-init="
                                    let select = $el.querySelector('select');
                                    $(select).select2().on('change', () => value = $(select).val());
                                    $watch('value', val => $(select).val(val).trigger('change.select2'));
                                "
                                wire:ignore
                        >
                            <label for="officeID" class="block text-sm font-medium text-gray-700 mb-1">
                                Office/Dept./Institute
                            </label>
                            <select
                                    id="officeID"
                                    wire:model.defer="forwardToOfficeID"
                                    onchange="changedBodyInfo()"
                                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 Select2"
                                    aria-label="Select Office"
                            >
                                <option value="">-- Choose an Office --</option>
                                @foreach($bodyList as $key => $body)
                                    <option value="{{ $key }}">{{ $body }}</option>
                                @endforeach
                            </select>
                            @error('forwardToOfficeID')
                                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Employee Selector -->
                        <div
                                x-data="{ value: $wire.entangle('forwardToEmployee') }"
                                x-init="
                                        let select = $el.querySelector('select');
                                        $(select).select2().on('change', () => value = $(select).val());
                                        $watch('value', val => $(select).val(val).trigger('change.select2'));
                                    "
                                wire:ignore
                        >
                            <label for="forwardTo" class="block text-sm font-medium text-gray-700 mb-1">
                                Employee Information
                            </label>
                            <select id="forwardTo" class="Select2 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm">
                                <option value="">-- Choose a Person --</option>
                                @foreach($employeeList as $employee)
                                    <option value="{{ $employee['employee_id'] }}">
                                        {{ $employee['emp_name'] }} ({{ $employee['emp_id'] }} - {{ $employee['designation_title'] }})
                                    </option>
                                @endforeach
                            </select>
                            @error('forwardToEmployee')
                                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>





                <div class="mb-4">
                    <label for="forwardMessage" class="block font-medium text-sm text-gray-700 mb-1">Message (Optional)</label>
                    <textarea id="forwardMessage" wire:model="forwardMessage" rows="3" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Add a message for the recipient..."></textarea>
                    @error('forwardMessage')
                        <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>





                <div class="flex justify-end gap-3">
                    <button
                            type="button"
                            wire:click="saveforward()"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md transition duration-200 ease-in-out"
                    >
                        Forward Note
                    </button>

                    <button  type="button" wire:click="closeForwardModalFun()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">Close</button>
                </div>
            </div>
        </div>
        @script
            <script>
                $(document).ready(function() {
                    $('.Select2').select2();
                });
            </script>
        @endscript
    @endif

</div>

<script>
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
    function changedBodyInfo() {
        const officeID = document.getElementById('officeID').value;
        const forwardTo = document.getElementById('forwardTo');

        if (!officeID) {
            forwardTo.innerHTML = '<option value="">-- Choose a Person --</option>';
            return;
        }else{
            forwardTo.innerHTML = '<option value="">Loading employees...</option>';
        }

        fetch(`/get-employees/${officeID}`)
            .then(response => response.json())
            .then(result => {
                if (result.status === 'success' && Array.isArray(result.data)) {
                    let options = '<option value="">-- Choose a Person --</option>';
                    result.data.forEach(emp => {
                        options += `<option value="${emp.employee_id}">${emp.emp_name} (${emp.emp_id} - ${emp.designation_title})</option>`;
                    });
                    forwardTo.innerHTML = options;
                } else {
                    forwardTo.innerHTML = '<option value="">No employees found</option>';
                }
            })
            .catch(error => {

                forwardTo.innerHTML = '<option value="">Error loading employees</option>';
            });
    }
</script>



