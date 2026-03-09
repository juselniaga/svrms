<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Site Investigation Form') }} <span
                    class="text-gray-500 font-normal">({{ $application->reference_no }})</span>
            </h2>
            <a href="{{ route('officer.dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                &larr; Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <strong class="font-bold">Please fix the following errors:</strong>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                <!-- Application Summary Sidebar -->
                <div class="md:col-span-1 border-r border-gray-200 pr-0 md:pr-4">
                    <div class="bg-white p-5 rounded-lg shadow-sm mb-6 border-t-4 border-purple-500">
                        <h3 class="font-medium text-lg text-gray-900 mb-4 border-b pb-2">Application Info</h3>
                        <div class="space-y-3 text-sm">
                            <div>
                                <strong class="block text-gray-500 text-xs uppercase tracking-wider">Ref No</strong>
                                <span class="font-mono">{{ $application->reference_no ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <strong class="block text-gray-500 text-xs uppercase tracking-wider">Current
                                    Status</strong>
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 mt-1 whitespace-nowrap">
                                    {{ str_replace('_', ' ', $application->status) }}
                                </span>
                            </div>
                            @if($siteVisit->status === 'DRAFT')
                                <div>
                                    <strong class="block text-gray-500 text-xs uppercase tracking-wider">Form State</strong>
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 mt-1">DRAFT
                                        SAVED</span>
                                </div>
                            @endif
                            <div>
                                <strong class="block text-gray-500 text-xs uppercase tracking-wider">Project
                                    Title</strong>
                                <p class="text-gray-700 mt-1">{{ $application->tajuk ?? '-' }}</p>
                            </div>
                            <div>
                                <strong class="block text-gray-500 text-xs uppercase tracking-wider">Developer</strong>
                                <p class="text-gray-700 mt-1">{{ optional($application->developer)->name ?? '-' }}</p>
                            </div>
                            <div>
                                <strong class="block text-gray-500 text-xs uppercase tracking-wider">Location</strong>
                                <p class="text-gray-700 mt-1">{{ $application->lokasi ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    @if($application->site)
                        <div class="bg-white p-5 rounded-lg shadow-sm mb-6 border-t-4 border-blue-500">
                            <h3 class="font-medium text-lg text-gray-900 mb-4 border-b pb-2">Registered Site</h3>
                            <div class="space-y-3 text-sm">
                                <div>
                                    <strong class="block text-gray-500 text-xs uppercase tracking-wider">Mukim</strong>
                                    <p class="text-gray-700 mt-1">{{ $application->site->mukim ?? '-' }}</p>
                                </div>
                                <div>
                                    <strong class="block text-gray-500 text-xs uppercase tracking-wider">Lot</strong>
                                    <p class="text-gray-700 mt-1 font-mono">{{ $application->site->lot ?? '-' }}</p>
                                </div>
                                <div>
                                    <strong class="block text-gray-500 text-xs uppercase tracking-wider">Land Area
                                        (Luas)</strong>
                                    <p class="text-gray-700 mt-1">
                                        {{ $application->site->luas ? number_format($application->site->luas, 4) : '-' }}
                                    </p>
                                </div>
                                @if($application->site->google_lat && $application->site->google_long)
                                    <div class="pt-2">
                                        <a href="https://www.google.com/maps/search/?api=1&query={{ $application->site->google_lat }},{{ $application->site->google_long }}"
                                            target="_blank" class="text-xs text-blue-600 hover:text-blue-800 flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                </path>
                                            </svg>
                                            View on Map
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Site Investigation Form Area -->
                <div class="md:col-span-3">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">

                            <form action="{{ route('officer.site-visit.store', $application->application_id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Form Header -->
                                <div class="mb-4 flex justify-between items-center border-b pb-2">
                                    <h3 class="text-xl font-medium text-gray-900">
                                        Site Visit Details
                                    </h3>
                                    <!-- Date & Time -->
                                    <div class="w-1/3">
                                        <label for="visit_date"
                                            class="block font-medium text-xs text-gray-500 uppercase">Date of Visit
                                            <span class="text-red-500">*</span></label>
                                        <input type="datetime-local" name="visit_date" id="visit_date"
                                            value="{{ old('visit_date', $siteVisit->visit_date ? $siteVisit->visit_date->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}"
                                            class="mt-1 block w-full text-sm border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm"
                                            required>
                                        @error('visit_date') <span
                                        class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- GROUP 1: Site Conditions -->
                                <div class="mb-8 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                    <h4 class="font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">1. Site
                                        Conditions</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block font-medium text-sm text-gray-700">Activity</label>
                                            <input type="text" name="activity"
                                                value="{{ old('activity', $siteVisit->activity) }}"
                                                class="mt-1 block w-full text-sm border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                                        </div>
                                        <div>
                                            <label class="block font-medium text-sm text-gray-700">Facility</label>
                                            <input type="text" name="facility"
                                                value="{{ old('facility', $siteVisit->facility) }}"
                                                class="mt-1 block w-full text-sm border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                                        </div>
                                    </div>
                                </div>

                                <!-- GROUP 2: Infrastructure -->
                                <div class="mb-8 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                    <h4 class="font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">2.
                                        Infrastructure & Terrain</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block font-medium text-sm text-gray-700">Entrance Way (Laluan
                                                Keluar Masuk)</label>
                                            <input type="text" name="entrance_way"
                                                value="{{ old('entrance_way', $siteVisit->entrance_way) }}"
                                                class="mt-1 block w-full text-sm border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                                        </div>
                                        <div>
                                            <label class="block font-medium text-sm text-gray-700">Drainage
                                                (Parit)</label>
                                            <input type="text" name="parit"
                                                value="{{ old('parit', $siteVisit->parit) }}"
                                                class="mt-1 block w-full text-sm border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                                        </div>
                                        <div>
                                            <label class="block font-medium text-sm text-gray-700">Trees (Anggaran
                                                Pokok)</label>
                                            <input type="number" name="tree" value="{{ old('tree', $siteVisit->tree) }}"
                                                class="mt-1 block w-full text-sm border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm"
                                                placeholder="e.g. 5">
                                        </div>
                                        <div>
                                            <label class="block font-medium text-sm text-gray-700">Topography
                                                Description</label>
                                            <input type="text" name="topography"
                                                value="{{ old('topography', $siteVisit->topography) }}"
                                                class="mt-1 block w-full text-sm border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                                        </div>
                                    </div>
                                </div>

                                <!-- GROUP 3: Verify -->
                                <div class="mb-8 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                    <h4 class="font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">3.
                                        Verification Rules</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block font-medium text-sm text-gray-700">Land Use Zone</label>
                                            <input type="text" name="land_use_zone"
                                                value="{{ old('land_use_zone', $siteVisit->land_use_zone) }}"
                                                class="mt-1 block w-full text-sm border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                                        </div>
                                        <div>
                                            <label class="block font-medium text-sm text-gray-700">Density</label>
                                            <input type="text" name="density"
                                                value="{{ old('density', $siteVisit->density) }}"
                                                class="mt-1 block w-full text-sm border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                                        </div>
                                        <div class="md:col-span-2 flex items-center mt-2">
                                            <input type="checkbox" name="recommend_road" id="recommend_road" value="1"
                                                {{ old('recommend_road', $siteVisit->recommend_road) ? 'checked' : '' }}
                                                class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500">
                                            <label for="recommend_road"
                                                class="ml-2 block text-sm font-medium text-gray-900">
                                                Recommend Road Construction
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- GROUP 4: Other -->
                                <div class="mb-8 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                    <h4 class="font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">4. Other
                                        Attributes</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block font-medium text-sm text-gray-700">Anjakan
                                                (Setback)</label>
                                            <input type="text" name="anjakan"
                                                value="{{ old('anjakan', $siteVisit->anjakan) }}"
                                                class="mt-1 block w-full text-sm border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                                        </div>
                                        <div>
                                            <label class="block font-medium text-sm text-gray-700">Social
                                                Facility</label>
                                            <input type="text" name="social_facility"
                                                value="{{ old('social_facility', $siteVisit->social_facility) }}"
                                                class="mt-1 block w-full text-sm border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                                        </div>
                                    </div>
                                </div>


                                <!-- GROUP 5: Direction Findings & Photos -->
                                <div class="mb-8">
                                    <h4 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">5. Directional
                                        Findings & Photographs</h4>

                                    <div class="space-y-6">
                                        @foreach(['north' => ['finding_north', 'photos_north'], 'south' => ['findings_south', 'photos_south'], 'east' => ['findings_east', 'photo_east'], 'west' => ['finding_west', 'photo_west']] as $dir => $fields)
                                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 shadow-sm">
                                                <h4
                                                    class="font-medium text-gray-800 mb-3 flex items-center justify-between">
                                                    <span
                                                        class="bg-purple-100 text-purple-800 px-3 py-1 rounded text-xs font-bold uppercase">{{ ucfirst($dir) }}
                                                        Direction</span>

                                                    @if(is_array($siteVisit->{$fields[1]}) && count($siteVisit->{$fields[1]}) > 0)
                                                        <span class="text-xs text-green-600 font-medium whitespace-nowrap"><svg
                                                                class="w-3 h-3 inline pb-0.5" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                            </svg> {{ count($siteVisit->{$fields[1]}) }} Photos uploaded</span>
                                                    @endif
                                                </h4>

                                                <div class="grid grid-cols-1 gap-4">
                                                    <div>
                                                        <label
                                                            class="block font-medium text-sm text-gray-700 mb-1">Observation</label>
                                                        <textarea name="{{ $fields[0] }}" rows="2"
                                                            class="mt-1 block w-full text-sm border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm"
                                                            placeholder="Structures, boundaries, water courses...">{{ old($fields[0], $siteVisit->{$fields[0]}) }}</textarea>
                                                    </div>
                                                    <div>
                                                        <label class="block font-medium text-sm text-gray-700 mb-1">Upload
                                                            Additional Photos</label>
                                                        <input type="file" name="{{ $fields[1] }}[]" multiple
                                                            accept="image/*"
                                                            class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                                                        <p class="text-xs text-gray-500 mt-1">Uploading new photos will
                                                            overwrite the previously uploaded ones for this direction.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- GROUP 6: GPS Capture -->
                                <div class="mb-4 mt-8" x-data="{ 
                                    gpsStatus: '{{ old('location_data', $siteVisit->location_data) ? 'Coordinates Captured \u2713' : 'Click to capture location' }}', 
                                    coords: '{{ old('location_data', $siteVisit->location_data) }}',
                                    captureGPS() {
                                        this.gpsStatus = 'Locating...';
                                        if (navigator.geolocation) {
                                            navigator.geolocation.getCurrentPosition(
                                                (position) => {
                                                    const lat = position.coords.latitude.toFixed(8);
                                                    const lng = position.coords.longitude.toFixed(8);
                                                    this.coords = `${lat}, ${lng}`;
                                                    this.gpsStatus = 'Location Captured \u2713';
                                                    document.getElementById('location_data').value = this.coords;
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
                                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">6. GPS Verification
                                    </h3>

                                    <div class="bg-blue-50 p-5 rounded-lg border border-blue-200 mb-4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-4">
                                                <button type="button" @click="captureGPS()"
                                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                                                        </path>
                                                    </svg>
                                                    Capture Current Location
                                                </button>
                                                <span x-text="gpsStatus" class="text-sm font-medium"
                                                    :class="(coords !== '') ? 'text-green-600' : 'text-gray-500'"></span>
                                            </div>

                                            <div x-show="coords"
                                                class="font-mono text-sm bg-white border border-gray-200 px-3 py-1 rounded text-gray-700 hidden sm:block">
                                                <span x-text="coords"></span>
                                            </div>
                                        </div>
                                        <input type="hidden" name="location_data" id="location_data"
                                            value="{{ old('location_data', $siteVisit->location_data) }}">
                                        @error('location_data') <span
                                        class="text-red-600 text-sm mt-2 block">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- form Actions -->
                                <div class="flex items-center justify-end mt-8 border-t border-gray-200 pt-5 space-x-4">
                                    <button type="submit" name="submit_action" value="draft"
                                        class="inline-flex items-center px-6 py-3 bg-gray-50 border border-gray-300 rounded-md font-semibold text-sm text-gray-700 shadow-sm uppercase tracking-widest hover:bg-gray-100 focus:bg-gray-200 active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Save as Draft
                                    </button>

                                    <button type="submit" name="submit_action" value="submit"
                                        class="inline-flex items-center px-6 py-3 bg-purple-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                                        Submit Final Evaluation
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>