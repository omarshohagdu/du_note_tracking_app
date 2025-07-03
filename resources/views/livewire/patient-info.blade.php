<!-- resources/views/livewire/patient-info.blade.php -->
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-2">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h2 class="text-2xl font-bold mb-6">Patient List</h2>
                </div>
                <div class="text-right">
                    <x-nav-link :href="route('patient.create')" :active="request()->routeIs('patient.create')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded  inline-block">
                        {{ __('New Patient') }}
                    </x-nav-link>
                </div>
            </div>
            <!-- Success/Error Message -->
            @if (session()->has('message'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('message') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Patient Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact Number</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        $i=1;
                    @endphp
                    @foreach ($patients as $row)
                        <tr>
                            <td class="border px-4 py-2">{{ $i++ }}</td>
                            <td class="border px-4 py-2">{{ $row->patient_id }}</td>
                            <td class="border px-4 py-2">{{ $row->name }}</td>
                            <td class="border px-4 py-2">{{ $row->pt_contact_number }}</td>
                            <td class="border px-4 py-2">
                                <button wire:click="editPatient({{ $row->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                <button wire:click="viewPatient({{ $row->id }})" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">View</button>

                                <button wire:click="initiateDelete({{ $row->id }})" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                        wire:click="removeRow({{ $row->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $patients->links() }}
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 Script -->
@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('showDeleteConfirmation', () => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.Livewire.dispatch('confirmDelete');
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'The patient record has been deleted.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                });
            });
        });
    </script>
@endpush
