<div class="border-b pb-4">
    <h3 class="text-lg font-semibold mb-4">Investigation Information</h3>
    <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
        <div>
            <label for="cbc_result" class="block text-lg font-large text-black-700 text-center">CBC Result</label>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div>
                    <label for="cbc_result" class="block text-sm font-medium text-gray-700">Hb%</label>
                    <input type="text" id="hb_per" placeholder="Hb%" wire:model.debounce.500ms="form.hb_per" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('form.hb_per') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="cbc_result" class="block text-sm font-medium text-gray-700">RBC</label>
                    <input type="text" placeholder="RBC" id="cbc_rbc" wire:model.debounce.500ms="form.cbc_rbc" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></input>
                    @error('form.cbc_rbc') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="cbc_result" class="block text-sm font-medium text-gray-700">WBC</label>
                    <input type="text" placeholder="WBC" id="cbc_wbc" wire:model.debounce.500ms="form.cbc_wbc" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></input>
                    @error('form.cbc_wbc') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="cbc_result" class="block text-sm font-medium text-gray-700">PLT</label>
                    <input type="text" placeholder="PLT" id="cbc_plt" wire:model.debounce.500ms="form.cbc_plt" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></input>
                    @error('form.cbc_plt') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="cbc_result" class="block text-sm font-medium text-gray-700">ESR</label>
                    <input type="text" placeholder="ESR" id="cbc_esr" wire:model.debounce.500ms="form.cbc_esr" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></input>
                    @error('form.cbc_esr') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>


            </div>
        </div>
        <div>
            <label for="cbc_result" class="block text-lg font-large text-black-700 text-center py-4">S. Electrolytes</label>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="cbc_result" class="block text-sm font-medium text-gray-700">Na+</label>
                    <input type="text" id="electrolytes_na" placeholder="Na+" wire:model.debounce.500ms="form.electrolytes_na" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('form.electrolytes_na') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="cbc_result" class="block text-sm font-medium text-gray-700">K+</label>
                    <input type="text" placeholder="K+" id="electrolytes_k" wire:model.debounce.500ms="form.electrolytes_k" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></input>
                    @error('form.electrolytes_k') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="cbc_result" class="block text-sm font-medium text-gray-700">Cl</label>
                    <input type="text" placeholder="WBC" id="electrolytes_cl" wire:model.debounce.500ms="form.electrolytes_cl" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></input>
                    @error('form.electrolytes_cl') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="cbc_result" class="block text-sm font-medium text-gray-700">HCO3</label>
                    <input type="text" placeholder="HCO3" id="electrolytes_hco3" wire:model.debounce.500ms="form.electrolytes_hco3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></input>
                    @error('form.electrolytes_hco3') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 py-6">
        <div>
            <label for="s_creatinine" class="block text-sm font-medium text-gray-700">S. Creatinine</label>
            <textarea placeholder="S. Creatinine" id="s_creatinine" wire:model.debounce.500ms="form.s_creatinine" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            @error('form.s_creatinine') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="s_urea" class="block text-sm font-medium text-gray-700">S. Urea</label>
            <textarea placeholder="S. Urea" id="s_urea" wire:model.debounce.500ms="form.s_urea" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            @error('form.s_urea') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-1 gap-4 py-4">
        <div>
            <label for="cbc_result" class="block text-lg font-large text-black-700 text-center">LFT</label>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div>
                    <label for="cbc_result" class="block text-sm font-medium text-gray-700">Bilirubin</label>
                    <input type="text" id="hb_per" placeholder="Bilirubin" wire:model.debounce.500ms="form.hb_per" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('form.hb_per') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="cbc_result" class="block text-sm font-medium text-gray-700">SGPT</label>
                    <input type="text" placeholder="SGPT" id="cbc_rbc" wire:model.debounce.500ms="form.cbc_rbc" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></input>
                    @error('form.cbc_rbc') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="cbc_result" class="block text-sm font-medium text-gray-700">SGOT</label>
                    <input type="text" placeholder="SGOT" id="cbc_wbc" wire:model.debounce.500ms="form.cbc_wbc" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></input>
                    @error('form.cbc_wbc') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="cbc_result" class="block text-sm font-medium text-gray-700">GGT</label>
                    <input type="text" placeholder="PLT" id="cbc_plt" wire:model.debounce.500ms="form.cbc_plt" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></input>
                    @error('form.cbc_plt') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="cbc_result" class="block text-sm font-medium text-gray-700">AST</label>
                    <input type="text" placeholder="AST" id="cbc_esr" wire:model.debounce.500ms="form.cbc_esr" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></input>
                    @error('form.cbc_esr') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 py-4">
        <div>
            <label for="s_albumin" class="block text-sm font-medium text-gray-700">S. Albumin</label>
            <textarea id="s_albumin" wire:model.debounce.500ms="form.s_albumin" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            @error('form.s_albumin') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="s_lipase" class="block text-sm font-medium text-gray-700">S. Lipase</label>
            <textarea id="s_lipase" wire:model.debounce.500ms="form.s_lipase" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            @error('form.s_lipase') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="s_amylase" class="block text-sm font-medium text-gray-700">S. Amylase</label>
            <textarea id="s_amylase" wire:model.debounce.500ms="form.s_amylase" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            @error('form.s_amylase') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
        <div>
            <label for="cbc_result" class="block text-lg font-large text-black-700 text-center">Blood Glucose</label>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="cbc_result" class="block text-sm font-medium text-gray-700">RBS</label>
                    <input type="text" id="hb_per" placeholder="RBS" wire:model.debounce.500ms="form.hb_per" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('form.hb_per') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="cbc_result" class="block text-sm font-medium text-gray-700">FBS</label>
                    <input type="text" placeholder="FBS" id="cbc_rbc" wire:model.debounce.500ms="form.cbc_rbc" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></input>
                    @error('form.cbc_rbc') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="cbc_result" class="block text-sm font-medium text-gray-700">2HABS</label>
                    <input type="text" placeholder="2HABS" id="cbc_wbc" wire:model.debounce.500ms="form.cbc_wbc" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></input>
                    @error('form.cbc_wbc') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 py-4">
        <div>
            <label for="x_ray" class="block text-sm font-medium text-gray-700">X-Ray</label>
            <textarea id="x_ray" placeholder="X-Ray" wire:model.debounce.500ms="form.x_ray" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            @error('form.x_ray') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="ecg" class="block text-sm font-medium text-gray-700">ECG</label>
            <textarea id="ecg" placeholder="ECG" wire:model.debounce.500ms="form.ecg" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            @error('form.ecg') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="usg" class="block text-sm font-medium text-gray-700">USG</label>
            <textarea id="usg" placeholder="USG" wire:model.debounce.500ms="form.usg" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            @error('form.usg') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="ct_scan" class="block text-sm font-medium text-gray-700">CT Scan</label>
            <textarea id="ct_scan" placeholder="CT Scan" wire:model.debounce.500ms="form.ct_scan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            @error('form.ct_scan') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="mri" class="block text-sm font-medium text-gray-700">MRI</label>
            <textarea id="mri" placeholder="MRI" wire:model.debounce.500ms="form.mri" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            @error('form.mri') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="mrcp" class="block text-sm font-medium text-gray-700">MRCP</label>
            <textarea id="mrcp" placeholder="MRCP" wire:model.debounce.500ms="form.mrcp" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            @error('form.mrcp') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="ercp" class="block text-sm font-medium text-gray-700">ERCP</label>
            <textarea id="ercp" placeholder="ERCP" wire:model.debounce.500ms="form.ercp" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            @error('form.ercp') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="endoscopy" class="block text-sm font-medium text-gray-700">Endoscopy</label>
            <textarea id="endoscopy" placeholder="Endoscopy" wire:model.debounce.500ms="form.endoscopy" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            @error('form.endoscopy') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="colonoscopy" class="block text-sm font-medium text-gray-700">Colonoscopy</label>
            <textarea id="colonoscopy"  placeholder="Colonoscopy" wire:model.debounce.500ms="form.colonoscopy" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            @error('form.colonoscopy') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="fnac" class="block text-sm font-medium text-gray-700">FNAC</label>
            <textarea id="fnac" placeholder="FNAC" wire:model.debounce.500ms="form.fnac" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            @error('form.fnac') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="histopathology" class="block text-sm font-medium text-gray-700">Histopathology</label>
            <textarea id="histopathology" placeholder="Histopathology" wire:model.debounce.500ms="form.histopathology" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            @error('form.histopathology') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="immuno_histochemistry" class="block text-sm font-medium text-gray-700">Immuno Histochemistry</label>
            <textarea id="immuno_histochemistry" placeholder="Immuno Histochemistry" wire:model.debounce.500ms="form.immuno_histochemistry" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            @error('form.immuno_histochemistry') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="genetic_analysis" class="block text-sm font-medium text-gray-700">Genetic Analysis</label>
            <textarea id="genetic_analysis" placeholder="Genetic Analysis" wire:model.debounce.500ms="form.genetic_analysis" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            @error('form.genetic_analysis') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="others" class="block text-sm font-medium text-gray-700">Others</label>
            <textarea id="others" placeholder="Others" wire:model.debounce.500ms="form.others" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            @error('form.others') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>
    </div>
    <!-- Submit and Cancel Buttons -->
    <div class="flex justify-end space-x-4 mt-6">
        <a href="{{ route('patient.list') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</a>
        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Submit</button>
    </div>
</div>
