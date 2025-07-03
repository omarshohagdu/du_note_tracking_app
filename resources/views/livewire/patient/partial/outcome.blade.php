<div class="border-b pb-4">
    <h3 class="text-lg font-semibold mb-4">Follow Up Information</h3>
    <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
        <div>
            <table class="table-auto w-full table-bordered border border-gray-300">
                <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Clinical Features</th>
                    <th class="border p-2">Investigation</th>
                    <th class="border p-2">Follow Up Description</th>
                    <th class="border p-2">Action</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($rows))
                    @foreach ($rows as $index => $row)
                        <tr>
                            <td class="border p-2">
                                <input type="hidden" wire:model.defer="rows.{{ $index }}.id" class="w-full border rounded p-1">
                                <input type="text" wire:model.defer="rows.{{ $index }}.clinical_features" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter Clinical Features ">
                            </td>
                            <td class="border p-2">
                                <textarea wire:model.defer="rows.{{ $index }}.investigation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter Investigation"></textarea>
                            </td>
                            <td class="border p-2">
                                <textarea wire:model.defer="rows.{{ $index }}.followup_description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 " placeholder="Follow Up Description"></textarea>
                            </td>
                            <td class="border p-2">
                                <button type="button"
                                         wire:click="removeFollowUpdRow({{ $index }})"
                                         class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded">
                                     Drop
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3" class="p-2">
                        <button type="button" wire:click="addRow" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                            + Add New
                        </button>
                    </td>
                </tr>
                </tfoot>
            </table>

            <div class="mt-4">
                @if (session()->has('success'))
                    <div class="text-green-600 mt-2">{{ session('success') }}</div>
                @endif
            </div>
            <div class="mt-4">
                <button wire:click="saveFollowUpRecords" class="bg-green-600 hover:bg-green-700 text-white font-bold py-4 px-8 rounded w-full">
                    Save Follow Up
                </button>
            </div>


        </div>
    </div>
</div>
