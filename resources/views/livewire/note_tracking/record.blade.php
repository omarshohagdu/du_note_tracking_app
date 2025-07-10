<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
    <h2 class="text-2xl font-bold text-red-600 mb-6 border-l-4 border-red-600 pl-2">My Created Notes</h2>
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg">
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg">
            {{ session('error') }}
        </div>
    @endif


    <!-- Card 1: In Transit -->
    @if(!empty($noteTrackingMeta))
        @foreach($noteTrackingMeta as $note)
            <div class="bg-white shadow-md rounded-2xl p-6 mb-6 border-l-4 border-orange-400">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{ $note['title'] }}</h3>
                        <p class="text-sm text-gray-500"><strong>Serial:</strong> {{ $note['reference_no']??NULL }}</p>
                        <p class="text-sm text-gray-500">Created: {{ $note['created_at'] }} | Type: {{ $note['type'] }}</p>
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
                    <button type="button" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg"
                            wire:click="showForwardModalFun('{{ $note['id'] }}')">Forward</button>
                    <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">Close</button>

                </div>
            </div>
        @endforeach
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
                    <div>
                        <label for="officeID" class="block text-sm font-medium text-gray-700 mb-1">
                            Office/Dept./Institute
                        </label>

                        <select
                                id="officeID"
                                wire:model="forwardToOfficeID"
                                onchange="changedBodyInfo()"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
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

                    {{-- Employee Selector --}}
                    <div>
                        <label for="forwardTo" class="block text-sm font-medium text-gray-700 mb-1">
                            Employee Information
                        </label>

                        <select
                                id="forwardTo"
                                wire:model="forwardToEmployee"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                aria-label="Select Person to Forward To"
                        >
                            <option value="">-- Choose a Person --</option>
                            @if(!empty($employeeList))
                                @foreach($employeeList as $employee)
                                    <option value="{{ $employee['employee_id'] }}">
                                        {{ $employee['emp_name'] }} ({{ $employee['emp_id'] }} - {{ $employee['designation_title'] }})
                                    </option>
                                @endforeach
                            @endif
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
    @endif

    <!-- Movement History Modal -->
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
                                            <div class="text-sm text-gray-500">{{ $item->created_at }}</div>
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

</div>

<script>
    function changedBodyInfo() {
        const officeID = document.getElementById('officeID').value;
        const forwardTo = document.getElementById('forwardTo');

        if (!officeID) {
            forwardTo.innerHTML = '<option value="">-- Choose a Person --</option>';
            return;
        }

        fetch(`/get-employees/${officeID}`)
            .then(response => response.json())
            .then(result => {
                console.log(result);
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


    let noteCounter = 9;

    // Movement history data with "forwarded to" information
    const MovementHistoryData = {
        'NTE-2025-001': [
            {
                action: 'Created',
                person: 'Sarah Davis',
                email: 'sarah.davis@company.com',
                date: 'May 25, 2025 09:30 AM',
                description: 'Note created and saved to system',
                status: 'created'
            },
            {
                action: 'Forwarded',
                person: 'Sarah Davis',
                email: 'sarah.davis@company.com',
                forwardedTo: 'John Doe',
                forwardedToEmail: 'john.doe@company.com',
                date: 'May 25, 2025 10:15 AM',
                description: 'Forwarded to John Doe for review',
                status: 'forwarded'
            },
            {
                action: 'In Transit',
                person: 'System',
                email: 'system@company.com',
                date: 'May 25, 2025 10:16 AM',
                description: 'Note marked as in transit to John Doe',
                status: 'forwarded'
            }
        ],
        'NTE-2025-002': [
            {
                action: 'Created',
                person: 'Mike Johnson',
                email: 'mike.johnson@company.com',
                date: 'May 20, 2025 08:00 AM',
                description: 'Budget approval request created',
                status: 'created'
            },
            {
                action: 'Forwarded',
                person: 'Mike Johnson',
                email: 'mike.johnson@company.com',
                forwardedTo: 'John Doe',
                forwardedToEmail: 'john.doe@company.com',
                date: 'May 20, 2025 08:30 AM',
                description: 'Sent to John Doe for approval',
                status: 'forwarded'
            },
            {
                action: 'Received',
                person: 'John Doe',
                email: 'john.doe@company.com',
                date: 'May 20, 2025 11:00 AM',
                description: 'Note accepted and under review',
                status: 'received'
            }
        ],
        'NTE-2025-003': [
            {
                action: 'Created',
                person: 'John Doe',
                email: 'john.doe@company.com',
                date: 'May 15, 2025 03:00 PM',
                description: 'Board meeting minutes created',
                status: 'created'
            },
            {
                action: 'Forwarded',
                person: 'John Doe',
                email: 'john.doe@company.com',
                forwardedTo: 'All Board Members',
                forwardedToEmail: 'board@company.com',
                date: 'May 15, 2025 03:30 PM',
                description: 'Sent to all board members for review',
                status: 'forwarded'
            },
            {
                action: 'Received',
                person: 'Jane Smith',
                email: 'jane.smith@company.com',
                date: 'May 16, 2025 09:00 AM',
                description: 'Reviewed and approved by HR',
                status: 'received'
            },
            {
                action: 'Closed',
                person: 'Jane Smith',
                email: 'jane.smith@company.com',
                date: 'May 16, 2025 04:00 PM',
                description: 'Minutes approved and archived',
                status: 'closed'
            }
        ],
        'NTE-2025-005': [
            {
                action: 'Created',
                person: 'John Doe',
                email: 'john.doe@company.com',
                date: 'June 1, 2025 09:30 AM',
                description: 'Employee handbook update created',
                status: 'created'
            },
            {
                action: 'Forwarded',
                person: 'John Doe',
                email: 'john.doe@company.com',
                forwardedTo: 'Jane Smith',
                forwardedToEmail: 'jane.smith@company.com',
                date: 'June 1, 2025 10:15 AM',
                description: 'Forwarded to Jane Smith for HR review',
                status: 'forwarded'
            },
            {
                action: 'In Transit',
                person: 'System',
                email: 'system@company.com',
                date: 'June 1, 2025 10:16 AM',
                description: 'Note marked as in transit to Jane Smith',
                status: 'forwarded'
            }
        ],
        'NTE-2025-006': [
            {
                action: 'Created',
                person: 'John Doe',
                email: 'john.doe@company.com',
                date: 'May 28, 2025 02:45 PM',
                description: 'Offline note registered in system',
                status: 'created'
            },
            {
                action: 'Forwarded',
                person: 'John Doe',
                email: 'john.doe@company.com',
                forwardedTo: 'Mike Johnson',
                forwardedToEmail: 'mike.johnson@company.com',
                date: 'May 28, 2025 03:00 PM',
                description: 'Physical document handed to Mike Johnson',
                status: 'forwarded'
            },
            {
                action: 'Received',
                person: 'Mike Johnson',
                email: 'mike.johnson@company.com',
                date: 'May 28, 2025 03:05 PM',
                description: 'Note accepted and confirmed receipt',
                status: 'received'
            }
        ],
        'NTE-2025-007': [
            {
                action: 'Created',
                person: 'John Doe',
                email: 'john.doe@company.com',
                date: 'May 20, 2025 11:00 AM',
                description: 'Quarterly sales report created',
                status: 'created'
            },
            {
                action: 'Forwarded',
                person: 'John Doe',
                email: 'john.doe@company.com',
                forwardedTo: 'Sarah Davis',
                forwardedToEmail: 'sarah.davis@company.com',
                date: 'May 20, 2025 11:30 AM',
                description: 'Sent to Sarah Davis for analysis',
                status: 'forwarded'
            },
            {
                action: 'Received',
                person: 'Sarah Davis',
                email: 'sarah.davis@company.com',
                date: 'May 20, 2025 02:15 PM',
                description: 'Note received and reviewed',
                status: 'received'
            },
            {
                action: 'Assigned',
                person: 'Sarah Davis',
                email: 'sarah.davis@company.com',
                forwardedTo: 'Tom Wilson',
                forwardedToEmail: 'tom.wilson@company.com',
                date: 'May 21, 2025 09:00 AM',
                description: 'Assigned to Tom Wilson for final review',
                status: 'forwarded'
            },
            {
                action: 'Received',
                person: 'Tom Wilson',
                email: 'tom.wilson@company.com',
                date: 'May 21, 2025 10:30 AM',
                description: 'Final review completed',
                status: 'received'
            },
            {
                action: 'Closed',
                person: 'Tom Wilson',
                email: 'tom.wilson@company.com',
                date: 'May 22, 2025 04:00 PM',
                description: 'Report approved and archived',
                status: 'closed'
            }
        ],
        'NTE-2025-008': [
            {
                action: 'Created',
                person: 'John Doe',
                email: 'john.doe@company.com',
                date: 'May 15, 2025 08:00 AM',
                description: 'Budget allocation request submitted',
                status: 'created'
            },
            {
                action: 'Forwarded',
                person: 'John Doe',
                email: 'john.doe@company.com',
                forwardedTo: 'Finance Department',
                forwardedToEmail: 'finance@company.com',
                date: 'May 15, 2025 08:30 AM',
                description: 'Sent to Finance Department for approval',
                status: 'forwarded'
            }
        ]
    };



    // function viewMovementHistory(serial) {
    //     const history = MovementHistoryData[serial];
    //     const modalBody = document.getElementById('MovementModalBody');
    //
    //     if (!history || history.length === 0) {
    //         modalBody.innerHTML = `
    //         <p class="text-center text-gray-500 py-10">
    //             No movement history available for note <strong>${serial}</strong>.
    //         </p>
    //     `;
    //     } else {
    //         let timelineHTML = `
    //         <div class="mb-5">
    //             <h3 class="text-xl font-semibold text-gray-800">Note: ${serial}</h3>
    //             <p class="text-sm text-gray-500">Complete journey and status history</p>
    //         </div>
    //         <div class="relative border-l-2 border-gray-300 pl-6 space-y-6">
    //     `;
    //
    //         history.forEach((item, index) => {
    //             timelineHTML += `
    //             <div class="relative">
    //                 <div class="absolute -left-3 top-1 w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm font-semibold shadow-md">
    //                     ${index + 1}
    //                 </div>
    //                 <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm">
    //                     <div class="flex justify-between items-center mb-1">
    //                         <div class="font-medium text-gray-800">${item.action}</div>
    //                         <div class="text-sm text-gray-500">${item.date}</div>
    //                     </div>
    //                     <div class="text-sm text-gray-600">
    //                         <span class="font-medium text-gray-700">${item.person}</span> (${item.email})<br>
    //                         ${item.description}
    //                         ${item.forwardedTo ? `
    //                             <div class="mt-1 text-blue-700">
    //                                 <strong>→ Forwarded to:</strong> <span class="font-medium">${item.forwardedTo}</span> (${item.forwardedToEmail})
    //                             </div>` : ''}
    //                     </div>
    //                 </div>
    //             </div>
    //         `;
    //         });
    //
    //         timelineHTML += '</div>';
    //         modalBody.innerHTML = timelineHTML;
    //     }
    //
    //     const modal = document.getElementById('MovementHistoryModal');
    //     modal.classList.remove('hidden');
    //     modal.classList.add('flex');
    // }

    function closeMovementModal() {
        const modal = document.getElementById('MovementHistoryModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>




