<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Tapak Cadangan Baru') }} <span
                    class="text-blue-900 font-normal">({{ $application->reference_no }})</span>
            </h2>
            <a href="{{ route('officer.dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                &larr; Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('officer.site-registration.store', $application->application_id) }}"
                        method="POST">
                        @csrf

                        <div class="mb-4">
                            <h3 class="text-lg font-medium text-indigo-600 border-b pb-2 mb-4">Site Information
                                (Maklumat Tapak)</h3>
                            <p class="text-sm text-gray-500 mb-6">Sila daftarkan butiran lokasi fizikal bagi
                                cadangan tapak projek sebelum memulakan Penyiasatan Tapak</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Mukim <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="mukim" value="{{ old('mukim') }}" required
                                    class="mt-1 block w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Lot <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="lot" value="{{ old('lot') }}" required
                                    class="mt-1 block w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700">Luas Kawasan <span
                                        class="text-xs text-gray-400">e.g., in Hectares / Acres</span> <span
                                        class="text-red-500">*</span></label>
                                <input type="number" step="0.0001" name="luas" value="{{ old('luas') }}" required
                                    class="mt-1 block w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">BPK (Blok Perancangan
                                    Kecil)</label>
                                <input type="text" name="bpk" value="{{ old('bpk') }}"
                                    class="mt-1 block w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700">Map Sheet (Lembaran)</label>
                                <input type="text" name="lembaran" value="{{ old('lembaran') }}"
                                    class="mt-1 block w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Land Category (Kategori
                                    Tanah)</label>
                                <input type="text" name="kategori_tanah" value="{{ old('kategori_tanah') }}"
                                    class="mt-1 block w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700">Land Status (Status
                                    Tanah)</label>
                                <input type="text" name="status_tanah" value="{{ old('status_tanah') }}"
                                    class="mt-1 block w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                            </div>
                        </div>

                        <!-- Initial Coordinates Capture -->
                        <div class="mb-4 mt-8">

                            <div class="flex justify-between items-center border-b pb-2 mb-4">
                                <h3 class="text-lg font-medium text-indigo-600">Map Coordinates</h3>
                                <a href="https://jupem2u.kul.jupem.gov.my/mylot/negeri.html" target="_blank"
                                    class="text-sm text-blue-600 hover:text-blue-800 underline inline-flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                        </path>
                                    </svg>
                                    Open JUPEM Map
                                </a>
                            </div>

                            <div
                                class="bg-blue-50 p-5 rounded-lg border border-blue-200 mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">


                                <div>
                                    <label class="block font-medium text-sm text-gray-700">Locations</label>
                                    <input type="text" name="google_lat" id="google_lat" value="{{ old('google_lat') }}"
                                        class="mt-1 w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm bg-gray-100">
                                </div>

                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 border-t pt-5 space-x-4">
                            <a href="{{ route('officer.dashboard') }}"
                                class="inline-flex items-center px-6 py-3 bg-gray-200 border border-transparent rounded-md font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Back to Dashboard
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-6 py-3 bg-purple-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Save Site & Continue to Site Visit &rarr;
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>