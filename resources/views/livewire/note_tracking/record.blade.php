<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
    <h2 class="text-2xl font-bold text-red-600 mb-6 border-l-4 border-red-600 pl-2">My Created Notes</h2>

    <!-- Card 1: In Transit -->
    <div class="bg-white shadow-md rounded-2xl p-6 mb-6 border-l-4 border-orange-400">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Employee Handbook Update</h3>
                <p class="text-sm text-gray-500"><strong>Serial:</strong> NTE-2025-005</p>
                <p class="text-sm text-gray-500">Created: June 1, 2025 | Type: Online</p>
            </div>
            <span class="bg-orange-100 text-orange-600 text-xs font-semibold px-3 py-1 rounded-full shadow-sm">
        IN TRANSIT
      </span>
        </div>
        <p class="text-gray-700 mt-4">
            Updated employee handbook with new remote work policies and procedures for 2025.
        </p>
        <div class="mt-4 flex gap-4">
            <button class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg"
                    onclick="viewMovementHistory('NTE-2025-005')">
                Movement History
            </button>


            <button class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg" onclick="showForwardModal('NTE-2025-005')">Forward</button>

        </div>
    </div>

    <!-- Card 2: At Destination -->
    <div class="bg-white shadow-md rounded-2xl p-6 mb-6 border-l-4 border-green-400">
        <div class="flex justify-between items-start">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">IT Security Protocol</h3>
                <p class="text-sm text-gray-500"><strong>Serial:</strong> NTE-2025-006</p>
                <p class="text-sm text-gray-500">Created: May 28, 2025 | Type: Offline</p>
            </div>
            <span class="bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full shadow-sm">
        AT DESTINATION
      </span>
        </div>
        <p class="text-gray-700 mt-4">
            New IT security protocols for handling sensitive company data. Physical document created offline.
        </p>
        <div class="mt-4 flex gap-4">
            <button class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg">Movement History</button>
            <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">Close</button>
        </div>
    </div>

    <div id="forwardModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-full max-w-xl mx-auto p-6 rounded-xl shadow-lg relative">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Forward/Assign Notes</h2>

            <!-- Close Button -->
            <button onclick="closeForwardModal()" class="absolute top-2 right-3 text-gray-600 hover:text-black text-xl">&times;</button>

            <div class="mb-4">
                <label for="selectNote" class="block font-medium text-sm text-gray-700 mb-1">Select Note to Forward</label>
                <select id="selectNote" class="w-full border border-gray-300 rounded-lg p-2">
                    <option value="">Choose a note...</option>
                    <option value="NTE-2025-002">Budget Approval Request (NTE-2025-002)</option>
                    <option value="NTE-2025-005">Employee Handbook Update (NTE-2025-005)</option>
                    <option value="NTE-2025-006">IT Security Protocol (NTE-2025-006)</option>
                    <option value="NTE-2025-008">Budget Allocation Request (NTE-2025-008)</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="recipient" class="block font-medium text-sm text-gray-700 mb-1">Recipient</label>
                <select id="recipient" class="w-full border border-gray-300 rounded-lg p-2">
                    <option value="">Select recipient...</option>
                    <option value="jane.smith@company.com">Jane Smith - HR Manager</option>
                    <option value="mike.johnson@company.com">Mike Johnson - Finance Director</option>
                    <option value="sarah.davis@company.com">Sarah Davis - Operations Manager</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="forwardMessage" class="block font-medium text-sm text-gray-700 mb-1">Message (Optional)</label>
                <textarea id="forwardMessage" rows="3" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Add a message for the recipient..."></textarea>
            </div>

            <div class="flex justify-end gap-3">
                <button onclick="forwardSelectedNote()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Forward Note</button>
                <button onclick="assignSelectedNote()" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">Assign Note</button>
            </div>
        </div>
    </div>

    <!-- Movement History Modal -->
    <div id="MovementHistoryModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-full max-w-2xl mx-auto p-6 rounded-xl shadow-lg relative">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Note Movement History</h2>
                <span onclick="closeMovementModal()" class="text-2xl text-gray-600 cursor-pointer hover:text-black">&times;</span>
            </div>

            <!-- Modal Body -->
            <div id="MovementModalBody" class="text-gray-700 space-y-4">
                <!-- Movement data will be injected here -->
            </div>
        </div>
    </div>
</div>




<!-- Forward Modal -->
<script>
    function showForwardModal(noteId = '') {
        const modal = document.getElementById('forwardModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex'); // Tailwind "flex" to center modal

        // Preselect note in dropdown if available
        if (noteId) {
            const select = document.getElementById('selectNote');
            select.value = noteId;
        }
    }

    function closeForwardModal() {
        const modal = document.getElementById('forwardModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function forwardSelectedNote() {
        const note = document.getElementById('selectNote').value;
        const recipient = document.getElementById('recipient').value;
        const message = document.getElementById('forwardMessage').value;

        if (!note || !recipient) {
            alert("Please select a note and recipient.");
            return;
        }

        console.log("Forwarding Note:", note, "To:", recipient, "Message:", message);
        // TODO: Add your backend call here
        closeForwardModal();
    }

    function assignSelectedNote() {
        const note = document.getElementById('selectNote').value;
        const recipient = document.getElementById('recipient').value;
        const message = document.getElementById('forwardMessage').value;

        if (!note || !recipient) {
            alert("Please select a note and recipient.");
            return;
        }

        console.log("Assigning Note:", note, "To:", recipient, "Message:", message);
        // TODO: Add your backend call here
        closeForwardModal();
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



    function viewMovementHistory(serial) {
        const history = MovementHistoryData[serial];
        const modalBody = document.getElementById('MovementModalBody');

        if (!history || history.length === 0) {
            modalBody.innerHTML = `
            <p class="text-center text-gray-500 py-10">
                No movement history available for note <strong>${serial}</strong>.
            </p>
        `;
        } else {
            let timelineHTML = `
            <div class="mb-5">
                <h3 class="text-xl font-semibold text-gray-800">Note: ${serial}</h3>
                <p class="text-sm text-gray-500">Complete journey and status history</p>
            </div>
            <div class="relative border-l-2 border-gray-300 pl-6 space-y-6">
        `;

            history.forEach((item, index) => {
                timelineHTML += `
                <div class="relative">
                    <div class="absolute -left-3 top-1 w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm font-semibold shadow-md">
                        ${index + 1}
                    </div>
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm">
                        <div class="flex justify-between items-center mb-1">
                            <div class="font-medium text-gray-800">${item.action}</div>
                            <div class="text-sm text-gray-500">${item.date}</div>
                        </div>
                        <div class="text-sm text-gray-600">
                            <span class="font-medium text-gray-700">${item.person}</span> (${item.email})<br>
                            ${item.description}
                            ${item.forwardedTo ? `
                                <div class="mt-1 text-blue-700">
                                    <strong>→ Forwarded to:</strong> <span class="font-medium">${item.forwardedTo}</span> (${item.forwardedToEmail})
                                </div>` : ''}
                        </div>
                    </div>
                </div>
            `;
            });

            timelineHTML += '</div>';
            modalBody.innerHTML = timelineHTML;
        }

        const modal = document.getElementById('MovementHistoryModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeMovementModal() {
        const modal = document.getElementById('MovementHistoryModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>




