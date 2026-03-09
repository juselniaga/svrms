<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Register Site Information') }} <span
                    class="text-gray-500 font-normal">({{ $application->reference_no }})</span>
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
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Site/Land Identification
                                (Maklumat Tanah)</h3>
                            <p class="text-sm text-gray-500 mb-6">Please register the physical location details of the
                                proposed project site before commencing the Site Investigation.</p>
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
                                <label class="block font-medium text-sm text-gray-700">Land Area (Luas) <span
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
                        <div class="mb-4 mt-8" x-data="{ 
                            gpsStatus: 'Click to capture map coordinates', 
                            lat: '',
                            lng: '',
                            captureGPS() {
                                this.gpsStatus = 'Locating...';
                                if (navigator.geolocation) {
                                    navigator.geolocation.getCurrentPosition(
                                        (position) => {
                                            this.lat = position.coords.latitude.toFixed(8);
                                            this.lng = position.coords.longitude.toFixed(8);
                                            this.gpsStatus = 'Coordinates Captured \u2713';
                                            document.getElementById('google_lat').value = this.lat;
                                            document.getElementById('google_long').value = this.lng;
                                        },
                                        (error) => {
                                            this.gpsStatus = 'Error: ' + error.message;
                                        }
                                    );
                                } else {
                                    this.gpsStatus = 'Geolocation not supported by browser.';
                                }
                            } 
                        }">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Initial Google Coordinates
                            </h3>

                            <div
                                class="bg-blue-50 p-5 rounded-lg border border-blue-200 mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="col-span-1 md:col-span-2 flex items-center space-x-4 mb-2">
                                    <button type="button" @click="captureGPS()"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Capture Current Coordinates
                                    </button>
                                    <span x-text="gpsStatus" class="text-sm font-medium"
                                        :class="(lat !== '') ? 'text-green-600' : 'text-gray-500'"></span>
                                </div>

                                <div>
                                    <label class="block font-medium text-sm text-gray-700">Latitude</label>
                                    <input type="text" name="google_lat" id="google_lat" value="{{ old('google_lat') }}"
                                        class="mt-1 block w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm bg-gray-100"
                                        readonly>
                                </div>
                                <div>
                                    <label class="block font-medium text-sm text-gray-700">Longitude</label>
                                    <input type="text" name="google_long" id="google_long"
                                        value="{{ old('google_long') }}"
                                        class="mt-1 block w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm bg-gray-100"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 border-t pt-5">
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