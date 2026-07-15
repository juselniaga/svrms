<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Daftar Tapak Cadangan Baru') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">{{ $application->reference_no }} - {{ $application->developer->name }}</p>
            </div>
            <a href="{{ route('officer.dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                &larr; Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('officer.site-registration.store', $application->application_id) }}"
                        method="POST">
                        @csrf

                        <!-- Introduction Section -->
                        <div class="mb-8 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <p class="text-sm text-gray-700">
                                <span class="font-semibold text-blue-900">📍 Site Information:</span><br>
                                Sila daftarkan butiran lokasi fizikal bagi cadangan tapak projek sebelum memulakan Penyiasatan Tapak
                            </p>
                        </div>

                        <!-- Section 1: Site Location -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-800 border-b-2 border-purple-500 pb-3 mb-6">
                                📍 Site Location
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block font-medium text-sm text-gray-700 mb-2">Mukim <span class="text-red-500">*</span></label>
                                    <select name="mukim" required
                                        class="block w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                                        <option value="">-- Pilih Mukim --</option>
                                        @foreach($mukims as $mukim)
                                            <option value="{{ $mukim->mukim_no }}" {{ old('mukim') == $mukim->mukim_no ? 'selected' : '' }}>
                                                {{ $mukim->mukim_no }} - {{ $mukim->mukim }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block font-medium text-sm text-gray-700 mb-2">Lot <span class="text-red-500">*</span></label>
                                    <input type="text" name="lot" value="{{ old('lot') }}" required
                                        class="block w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Block Perancangan -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-800 border-b-2 border-purple-500 pb-3 mb-6">
                                🏗️ Block Perancangan
                            </h3>
                            <fieldset class="border border-gray-300 rounded-lg p-5 bg-gray-50">
                                <div class="space-y-4">
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700 mb-2">Block Perancang (BP) <span class="text-red-500">*</span></label>
                                        <select id="bp_select" name="bp" onchange="filterBPK()" required
                                            class="block w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                                            <option value="">-- Pilih Block Perancang --</option>
                                            @foreach($bps as $bp)
                                                <option value="{{ $bp->id }}" {{ old('bp') == $bp->id ? 'selected' : '' }}>
                                                    {{ $bp->id }} - {{ $bp->bp_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block font-medium text-sm text-gray-700 mb-2">BPK (Blok Perancangan Kecil)</label>
                                        <select id="bpk_select" name="bpk"
                                            class="block w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                                            <option value="">-- Pilih BPK --</option>
                                            @foreach($bpks as $bpk)
                                                <option value="{{ $bpk->id }}" data-bp-id="{{ $bpk->bp_id }}" {{ old('bpk') == $bpk->id ? 'selected' : '' }}>
                                                    {{ $bpk->id }} - {{ $bpk->bpk_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <!-- Section 3: Land Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-800 border-b-2 border-purple-500 pb-3 mb-6">
                                📊 Land Information
                            </h3>
                            <div class="space-y-4 mb-6">
                                <div>
                                    <label class="block font-medium text-sm text-gray-700 mb-2">
                                        Luas Kawasan <span class="text-xs text-gray-400">(Hectares / Acres)</span> <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" step="0.0001" name="luas" value="{{ old('luas') }}" required
                                        class="block w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                                </div>
                            </div>

                            <fieldset class="border border-gray-300 rounded-lg p-5 bg-gray-50">
                                <legend class="text-sm font-semibold text-gray-700 px-2">Land Status Details</legend>
                                <div class="space-y-4 mt-4">
                                    <div>
                                        <label class="block font-medium text-sm text-gray-700 mb-2">Map Sheet (Lembaran)</label>
                                        <input type="text" name="lembaran" value="{{ old('lembaran') }}"
                                            class="block w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                                    </div>

                                    <div>
                                        <label class="block font-medium text-sm text-gray-700 mb-2">Land Category (Kategori Tanah)</label>
                                        <input type="text" name="kategori_tanah" value="{{ old('kategori_tanah') }}"
                                            class="block w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                                    </div>

                                    <div>
                                        <label class="block font-medium text-sm text-gray-700 mb-2">Land Status (Status Tanah)</label>
                                        <input type="text" name="status_tanah" value="{{ old('status_tanah') }}"
                                            class="block w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <!-- Section 4: Map Coordinates -->
                        <div class="mb-8">
                            <div class="flex justify-between items-center border-b-2 border-purple-500 pb-3 mb-6">
                                <h3 class="text-lg font-semibold text-gray-800">
                                    🗺️ Map Coordinates
                                </h3>
                                <a href="https://jupem2u.kul.jupem.gov.my/mylot/negeri.html" target="_blank"
                                    class="text-sm text-blue-600 hover:text-blue-800 font-semibold inline-flex items-center px-3 py-2 bg-blue-50 rounded-md border border-blue-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                        </path>
                                    </svg>
                                    Open JUPEM Map
                                </a>
                            </div>

                            <div class="bg-blue-50 p-5 rounded-lg border border-blue-200">
                                <div>
                                    <label class="block font-medium text-sm text-gray-700 mb-2">Latitude / Longitude</label>
                                    <input type="text" name="google_lat" id="google_lat" value="{{ old('google_lat') }}"
                                        class="block w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm bg-white"
                                        placeholder="e.g., 3.1390, 101.6869">
                                    <p class="text-xs text-gray-500 mt-2">Get coordinates from JUPEM Map link above</p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between mt-12 pt-8 border-t border-gray-200 space-x-4">
                            <a href="{{ route('officer.dashboard') }}"
                                class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-semibold text-sm hover:bg-gray-200 transition duration-150 border border-gray-300">
                                ← Back to Dashboard
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-6 py-3 bg-purple-600 text-white rounded-lg font-semibold text-sm hover:bg-purple-700 transition duration-150 shadow-md">
                                ✓ Save Site & Continue →
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        function filterBPK() {
            const bpSelect = document.getElementById('bp_select');
            const bpkSelect = document.getElementById('bpk_select');
            const selectedBpId = bpSelect.value;

            // Get all BPK options
            const allOptions = bpkSelect.querySelectorAll('option');

            // Show/hide options based on selected BP
            allOptions.forEach(option => {
                if (option.value === '') {
                    // Always show the placeholder option
                    option.style.display = 'block';
                } else {
                    const optionBpId = option.getAttribute('data-bp-id');
                    if (selectedBpId === '') {
                        // No BP selected, hide all BPK options
                        option.style.display = 'none';
                    } else if (optionBpId === selectedBpId) {
                        // Show BPKs that belong to selected BP
                        option.style.display = 'block';
                    } else {
                        // Hide BPKs that don't belong to selected BP
                        option.style.display = 'none';
                    }
                }
            });

            // Reset BPK selection if current selection doesn't match selected BP
            if (bpkSelect.value !== '') {
                const selectedOption = bpkSelect.querySelector('option:checked');
                if (selectedOption && selectedOption.getAttribute('data-bp-id') !== selectedBpId) {
                    bpkSelect.value = '';
                }
            }
        }

        // Run filter on page load to handle old() values
        document.addEventListener('DOMContentLoaded', function() {
            filterBPK();
        });
    </script>
</x-app-layout>