<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Borang Siasatan Tapak') }} <span
                    class="text-indigo-600 font-normal">({{ $application->reference_no }})</span>
            </h2>
            <a href="{{ route('officer.dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                &larr; Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-lg relative shadow-md">
                    <strong class="font-bold block">✓ Berjaya!</strong>
                    <span class="block text-sm mt-1">{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg relative shadow-md">
                    <strong class="font-bold block">⚠️ Sila betulkan kesilapan berikut:</strong>
                    <ul class="mt-2 list-disc list-inside text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Application Info Card --}}
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 border-l-4 border-blue-500 rounded-lg p-6 mb-8 shadow">
                <h3 class="font-bold text-lg text-blue-900 mb-4 flex items-center gap-2">
                    <span class="w-2 h-8 bg-blue-500 rounded"></span>
                    Application Information
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
                    <div>
                        <strong class="block text-blue-600 text-xs uppercase tracking-wider">No Ruj</strong>
                        <span class="font-mono">{{ $application->reference_no ?? 'N/A' }}</span>
                    </div>
                    <div>
                        <strong class="block text-blue-600 text-xs uppercase tracking-wider">Status</strong>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 mt-1 whitespace-nowrap">
                            {{ str_replace('_', ' ', $application->status) }}
                        </span>
                    </div>
                    @if($siteVisit->status === 'DRAFT')
                        <div>
                            <strong class="block text-blue-600 text-xs uppercase tracking-wider">Form State</strong>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 mt-1">DRAFT SAVED</span>
                        </div>
                    @endif
                    <div>
                        <strong class="block text-blue-600 text-xs uppercase tracking-wider">Project</strong>
                        <p class="text-black-700 mt-1">{{ $application->tajuk ?? '-' }}</p>
                    </div>
                    <div>
                        <strong class="block text-blue-600 text-xs uppercase tracking-wider">Developer</strong>
                        <p class="text-black-700 mt-1">{{ optional($application->developer)->name ?? '-' }}</p>
                    </div>
                    <div>
                        <strong class="block text-blue-600 text-xs uppercase tracking-wider">Location</strong>
                        <p class="text-black-700 mt-1">{{ $application->lokasi ?? '-' }}</p>
                    </div>
                </div>
            </div>

            {{-- Site Info Card --}}
            @if($application->site)
                <div class="bg-gradient-to-br from-cyan-50 to-cyan-100 border-l-4 border-cyan-500 rounded-lg p-6 mb-8 shadow">
                    <h3 class="font-bold text-lg text-cyan-900 mb-4 flex items-center gap-2">
                        <span class="w-2 h-8 bg-cyan-500 rounded"></span>
                        Site Information
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-sm">
                        <div>
                            <strong class="block text-blue-600 text-xs uppercase tracking-wider">Mukim</strong>
                            <p class="text-gray-700 mt-1">
                                {{ $application->site->mukim ?? '-' }}
                                @if($application->site->mukim_relation)
                                    - {{ $application->site->mukim_relation->mukim }}
                                @endif
                            </p>
                        </div>
                        <div>
                            <strong class="block text-blue-600 text-xs uppercase tracking-wider">Lot</strong>
                            <p class="text-black-700 mt-1 font-mono">{{ $application->site->lot ?? '-' }}</p>
                        </div>
                        <div>
                            <strong class="block text-blue-600 text-xs uppercase tracking-wider">Luas</strong>
                            <p class="text-black-700 mt-1">
                                {{ $application->site->luas ? number_format($application->site->luas, 4) : '-' }}
                            </p>
                        </div>
                        @if($application->site->google_lat)
                            <div class="col-span-full">
                                <a href="https://www.google.com/maps/search/?api=1&query={{ $application->site->google_lat }}"
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

            {{-- Site Investigation Form --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-4 sm:p-6 text-gray-900">

                            <form action="{{ route('officer.site-visit.store', $application->application_id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                {{-- Form Header --}}
                                <div class="mb-10">
                                    <div class="flex items-center gap-3 mb-6">
                                        <div class="w-1 h-8 bg-gray-900 rounded"></div>
                                        <h2 class="text-2xl font-bold text-gray-900">Site Visit Details</h2>
                                    </div>
                    <div class="max-w-xs">
                        <label for="visit_date" class="block text-sm font-medium text-gray-700 mb-2">
                            Visit Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="visit_date" id="visit_date"
                            value="{{ old('visit_date', $siteVisit->visit_date ? $siteVisit->visit_date->format('Y-m-d') : now()->format('Y-m-d')) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-gray-400"
                            required>
                        @error('visit_date')
                            <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                                {{-- Site Conditions Section --}}
                                <div class="mb-8 p-6 bg-gradient-to-br from-blue-50 to-blue-100 border-l-4 border-blue-500 rounded-lg shadow">
                                    <h3 class="font-bold text-blue-900 mb-6 text-lg">Site Conditions</h3>
                                    <div class="grid grid-cols-1 gap-4 sm:gap-6">
                                        {{-- Activity Field --}}
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Aktiviti (Activity)
                                            </label>
                                            <input type="text"
                                                name="activity"
                                                value="{{ old('activity', $siteVisit->activity) }}"
                                                placeholder="e.g., Construction, Agriculture..."
                                                class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-gray-400 bg-white">
                                        </div>

                                        {{-- Facilities Field --}}
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Kemudahan (Facilities)
                                            </label>
                                            <input type="text"
                                                name="facility"
                                                value="{{ old('facility', $siteVisit->facility) }}"
                                                placeholder="e.g., Electricity, Water supply..."
                                                class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-gray-400 bg-white">
                                        </div>
                                    </div>
                                </div>

                                <!-- Infrastructure Section -->
                                <div class="mb-8 p-6 bg-gradient-to-br from-green-50 to-green-100 border-l-4 border-green-500 rounded-lg shadow">
                                    <h3 class="font-bold text-green-900 mb-6 text-lg">Infrastructure & Topography</h3>
                                    <div class="grid grid-cols-1 gap-4 sm:gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Jalan Masuk/saiz (Access Road/Size)</label>
                                            <input type="text" name="entrance_way"
                                                value="{{ old('entrance_way', $siteVisit->entrance_way) }}"
                                                placeholder="e.g., 8m wide, asphalted, good condition..."
                                                class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-gray-400 bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Perparitan/Saliran Dalaman (Internal Drainage)</label>
                                            <input type="text" name="parit"
                                                value="{{ old('parit', $siteVisit->parit) }}"
                                                placeholder="e.g., Open drains, closed pipes, adequate..."
                                                class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-gray-400 bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Pokok/Semak-samun (Trees & Vegetation)</label>
                                            <input type="text" name="tree"
                                                value="{{ old('tree', $siteVisit->tree) }}"
                                                placeholder="e.g., Dense vegetation, sparse, mature trees..."
                                                class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-gray-400 bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Topografi (Topography)</label>
                                            <input type="text" name="topography"
                                                value="{{ old('topography', $siteVisit->topography) }}"
                                                placeholder="e.g., Flat, sloping, hilly, undulating..."
                                                class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-gray-400 bg-white">
                                        </div>
                                    </div>
                                </div>

                                <!-- Verification Section -->
                                <div class="mb-8 p-6 bg-gradient-to-br from-orange-50 to-orange-100 border-l-4 border-orange-500 rounded-lg shadow">
                                    <h3 class="font-bold text-orange-900 mb-6 text-lg">Verification</h3>
                                    <div class="grid grid-cols-1 gap-4 sm:gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Zon Gunatanah (Land Use Zone)</label>
                                            <input type="text" name="land_use_zone"
                                                value="{{ old('land_use_zone', $siteVisit->land_use_zone) }}"
                                                placeholder="e.g., Residential, Commercial, Industrial..."
                                                class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-gray-400 bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Kepadatan (Density)</label>
                                            <input type="text" name="density"
                                                value="{{ old('density', $siteVisit->density) }}"
                                                placeholder="e.g., Low, Medium, High density..."
                                                class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-gray-400 bg-white">
                                        </div>
                                        <div class="md:col-span-2 flex items-center p-4 bg-white rounded-lg border-2 border-orange-200 hover:border-orange-300 transition">
                                            <input type="checkbox" name="recommend_road" id="recommend_road" value="1"
                                                {{ old('recommend_road', $siteVisit->recommend_road) ? 'checked' : '' }}
                                                class="w-5 h-5 rounded border-gray-300 text-orange-600 shadow-sm focus:ring-2 focus:ring-orange-500 cursor-pointer">
                                            <label for="recommend_road" class="ml-3 block text-sm font-semibold text-gray-800 cursor-pointer">
                                                🛣️ Jalan (Road Recommendation) - Check if road improvement is recommended
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Other Details Section -->
                                <div class="mb-8 p-6 bg-gradient-to-br from-pink-50 to-pink-100 border-l-4 border-pink-500 rounded-lg shadow">
                                    <h3 class="font-bold text-pink-900 mb-6 text-lg">Other Details</h3>
                                    <div class="grid grid-cols-1 gap-4 sm:gap-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Anjakan (Setback)</label>
                                            <input type="text" name="anjakan"
                                                value="{{ old('anjakan', $siteVisit->anjakan) }}"
                                                placeholder="e.g., 10m from road, compliant with regulations..."
                                                class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-gray-400 bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Kemudahan Sosial Sekitar (Surrounding Social Facilities)</label>
                                            <input type="text" name="social_facility"
                                                value="{{ old('social_facility', $siteVisit->social_facility) }}"
                                                placeholder="e.g., Schools, hospitals, markets nearby..."
                                                class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-gray-400 bg-white">
                                        </div>
                                    </div>
                                </div>


                                <!-- Directional Findings & Photos Section -->
                                <div class="mb-8">
                                    <div class="flex items-center gap-3 mb-6">
                                        <div class="w-1 h-8 bg-purple-500 rounded"></div>
                                        <h3 class="font-bold text-gray-900 text-lg">Directional Findings & Photos</h3>
                                    </div>

                                    <div class="space-y-4 sm:space-y-6">
                                        @php
                                            // Define direction labels for easy maintenance
                                            $directionLabels = [
                                                'location' => '📍 Lokasi (Location)',
                                                'jalan' => '🛣️ Jalan (Road)',
                                                'utara' => '🧭 Utara (North)',
                                                'selatan' => '🧭 Selatan (South)',
                                                'timur' => '🧭 Timur (East)',
                                                'barat' => '🧭 Barat (West)',
                                            ];

                                            // Define field mappings
                                            $directions = [
                                                'location' => ['finding_location', 'photos_location'],
                                                'jalan' => ['finding_jalan', 'photos_jalan'],
                                                'utara' => ['finding_north', 'photos_north'],
                                                'selatan' => ['findings_south', 'photos_south'],
                                                'timur' => ['findings_east', 'photo_east'],
                                                'barat' => ['finding_west', 'photo_west'],
                                            ];
                                        @endphp

                                        @foreach($directions as $dir => $fields)
                                            <div class="bg-white p-6 rounded-lg border-l-4 border-purple-400 shadow hover:shadow-lg transition">
                                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4 sm:mb-5 pb-3 border-b-2 border-purple-200">
                                                    <div class="flex items-center gap-3">
                                                        <span class="inline-block px-4 py-2 bg-gradient-to-r from-purple-500 to-indigo-600 text-white rounded-lg text-xs font-bold uppercase shadow-md">
                                                            {{ $directionLabels[$dir] }}
                                                        </span>
                                                    </div>

                                                    @if(is_array($siteVisit->{$fields[1]}) && count($siteVisit->{$fields[1]}) > 0)
                                                        <span class="text-xs text-green-600 font-bold whitespace-nowrap bg-green-100 px-3 py-1 rounded-full flex items-center gap-1">
                                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                            </svg>
                                                            {{ count($siteVisit->{$fields[1]}) }} Photos
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="space-y-5">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">📝 Penemuan (Findings)</label>
                                                        <textarea name="{{ $fields[0] }}" rows="3"
                                                            class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-gray-400 bg-white"
                                                            placeholder="Describe structures, boundaries, water courses, obstacles, conditions...">{{ old($fields[0], $siteVisit->{$fields[0]}) }}</textarea>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">📷 Upload Photos</label>
                                                        <div class="rounded-lg border-2 border-dashed border-purple-300 bg-purple-50 p-4">
                                                            <label class="block text-sm font-bold text-purple-900 mb-2" for="{{ $fields[1] }}_file">
                                                                Choose File / Gallery
                                                            </label>
                                                            <input type="file" id="{{ $fields[1] }}_file" name="{{ $fields[1] }}[]" multiple accept="image/*"
                                                                class="sr-only" onchange="handleFileSelect(this, '{{ $fields[1] }}')">
                                                            <label for="{{ $fields[1] }}_file"
                                                                class="inline-flex w-full items-center justify-center px-4 py-3 rounded-lg bg-purple-600 text-sm font-bold text-white cursor-pointer hover:bg-purple-700 transition">
                                                                Choose From Gallery
                                                            </label>
                                                            <p class="mt-2 text-xs text-purple-800">Select existing photos from your device.</p>
                                                        </div>

                                                        <!-- Image Preview Tiles -->
                                                        <div id="preview-{{ $fields[1] }}" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 mt-4"></div>

                                                        <p class="text-xs text-gray-500 mt-2 flex items-start gap-2">
                                                            <span class="text-yellow-600 font-bold">⚠️</span>
                                                            <span>Uploading new photos will replace previously uploaded ones for this section.</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- GPS Capture Section -->
                                <div class="mb-8" x-data="{
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
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-1 h-8 bg-cyan-500 rounded"></div>
                                        <h3 class="font-bold text-gray-900 text-lg">Map Verification</h3>
                                    </div>

                                    <div class="bg-gradient-to-br from-cyan-50 to-cyan-100 p-6 rounded-lg border-l-4 border-cyan-500 shadow">
                                        <div class="grid grid-cols-1 gap-4 sm:gap-6 mb-4 sm:mb-6">
                                            <div class="flex flex-col">
                                                <button type="button" @click="captureGPS()"
                                                    class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-cyan-600 to-blue-600 border border-transparent rounded-lg font-bold text-sm text-white uppercase tracking-widest hover:from-cyan-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md hover:shadow-lg">
                                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                    \ud83d\udccd Capture Current Location
                                                </button>
                                                <p class="text-xs text-gray-600 mt-2">Click to get your device's GPS coordinates</p>
                                            </div>

                                            <div class="flex flex-col justify-center">
                                                <div class="bg-white p-4 rounded-lg border-2 border-cyan-200">
                                                    <p class="text-xs font-semibold text-gray-600 uppercase mb-2">Status</p>
                                                    <span x-text="gpsStatus" class="text-sm font-bold block"
                                                        :class="(coords !== '') ? 'text-green-600' : 'text-amber-600'"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div x-show="coords" class="bg-white p-4 rounded-lg border-2 border-green-300">
                                            <p class="text-xs font-semibold text-gray-600 uppercase mb-2">\ud83d\udccc Captured Coordinates</p>
                                            <p class="font-mono text-sm text-gray-800 font-bold" x-text="coords"></p>
                                        </div>
                                        <input type="hidden" name="location_data" id="location_data"
                                            value="{{ old('location_data', $siteVisit->location_data) }}">
                                        @error('location_data') <span class="text-red-600 text-sm mt-3 block font-semibold">\u274c {{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-12 pt-8 border-t-2 border-gray-300">
                                    <a href="{{ route('officer.dashboard') }}"
                                        class="inline-flex items-center px-6 py-3 bg-white border-2 border-gray-300 rounded-lg font-bold text-sm text-gray-700 shadow-md hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition ease-in-out duration-150">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                        </svg>
                                        ← Back to Dashboard
                                    </a>

                                    <div class="flex items-center gap-4 w-full sm:w-auto">
                                        <button type="submit" name="submit_action" value="draft"
                                            class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-3 bg-gray-100 border-2 border-gray-300 rounded-lg font-bold text-sm text-gray-700 shadow-md hover:bg-gray-200 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition ease-in-out duration-150">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                            </svg>
                                            💾 Save as Draft
                                        </button>

                                        <button type="submit" name="submit_action" value="submit"
                                            class="flex-1 sm:flex-none inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 border-2 border-transparent rounded-lg font-bold text-sm text-white shadow-lg hover:from-purple-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                            ✓ Submit Final Evaluation
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script>
        /**
         * Image Preview Handler - Optimized for Performance
         * Displays selected images as preview tiles with loading indicator
         *
         * @param {HTMLInputElement} input - The file input element
         * @param {string} fieldId - The unique field identifier for grouping previews
         */
        function handleFileSelect(input, fieldId) {
            const previewContainer = document.getElementById(`preview-${fieldId}`);

            // Clear existing previews
            previewContainer.innerHTML = '';

            // Exit if no files selected
            if (input.files.length === 0) {
                return;
            }

            // Show loading indicator
            const loadingIndicator = document.createElement('div');
            loadingIndicator.className = 'col-span-full flex items-center justify-center py-4 text-gray-500';
            loadingIndicator.innerHTML = '<span>Loading images...</span>';
            previewContainer.appendChild(loadingIndicator);

            // Filter image files
            const imageFiles = Array.from(input.files).filter(isImageFile);

            // Process each image asynchronously
            processImagesSequentially(imageFiles, input, previewContainer, loadingIndicator);
        }

        /**
         * Process images one at a time to avoid UI freeze
         * Uses requestAnimationFrame for smooth performance
         */
        function processImagesSequentially(files, input, container, loadingIndicator, index = 0) {
            // Remove loading indicator when done
            if (index >= files.length) {
                if (loadingIndicator.parentNode) {
                    loadingIndicator.remove();
                }
                return;
            }

            // Process next image
            requestAnimationFrame(() => {
                const file = files[index];
                createImagePreview(file, input, container);
                processImagesSequentially(files, input, container, loadingIndicator, index + 1);
            });
        }

        /**
         * Check if file is an image with size limit
         * Skips files > 10MB to prevent memory issues
         */
        function isImageFile(file) {
            const maxSize = 10 * 1024 * 1024; // 10MB limit
            return file.type.startsWith('image/') && file.size <= maxSize;
        }

        /**
         * Create and display image preview tile with optimization
         * Uses blob URLs instead of data URLs for better performance
         */
        function createImagePreview(file, input, container) {
            // Use Blob URL for faster loading (avoids string encoding)
            const blobUrl = URL.createObjectURL(file);

            // Create a lighter preview instead of reading full data
            const previewTile = buildPreviewTile(blobUrl, input, container, file.name);
        }

        /**
         * Build the preview tile DOM element - optimized version
         * Uses blob URLs and simpler structure for better performance
         */
        function buildPreviewTile(imageUrl, input, container, fileName = '') {
            const tile = document.createElement('div');
            tile.className = 'relative bg-white rounded-lg border-2 border-gray-200 overflow-hidden shadow-md hover:shadow-lg transition group';

            // Create lightweight image element
            const img = document.createElement('img');
            img.src = imageUrl;
            img.className = 'w-full h-32 object-cover';
            img.alt = fileName || 'Preview';

            // Add loading placeholder
            img.style.backgroundColor = '#f0f0f0';

            // Create remove button
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'absolute top-1 right-1 bg-red-500 hover:bg-red-600 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition';
            removeBtn.innerHTML = '✕';
            removeBtn.title = 'Remove image';

            removeBtn.onclick = function(event) {
                event.preventDefault();
                // Cleanup blob URL to free memory
                URL.revokeObjectURL(imageUrl);
                tile.remove();

                // Reset input if no previews remain
                const allTiles = container.querySelectorAll('[class*="group"]').length;
                if (allTiles === 1) {
                    input.value = '';
                }
            };

            tile.appendChild(img);
            tile.appendChild(removeBtn);
            container.appendChild(tile);
        }
    </script>
</x-app-layout>
