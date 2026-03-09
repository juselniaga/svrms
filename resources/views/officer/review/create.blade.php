<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight block">
            {{ __('Review & Recommendation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-md">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Application Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Reference No: <span class="font-medium text-gray-900">{{ $application->reference_no }}</span></p>
                            <p class="text-sm text-gray-600">Project Title: <span class="font-medium text-gray-900">{{ $application->tajuk }}</span></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Developer: <span class="font-medium text-gray-900">{{ $application->developer->name ?? 'N/A' }}</span></p>
                            <p class="text-sm text-gray-600">Status: <span class="font-medium text-blue-600">{{ str_replace('_', ' ', $application->status) }}</span></p>
                        </div>
                    </div>
                </div>

                <!-- Accordion for Full Application Data Context -->
                <div x-data="{ open: false }" class="mb-8 border border-gray-200 rounded-md overflow-hidden">
                    <button @click="open = !open" type="button" class="w-full flex justify-between items-center bg-gray-100 px-4 py-3 text-left hover:bg-gray-200 focus:outline-none transition">
                        <span class="font-semibold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            View Full Application Data & Site Investigation Findings
                        </span>
                        <svg class="h-5 w-5 text-gray-500 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    
                    <div x-show="open" x-collapse class="p-4 bg-white border-t border-gray-200">
                        
                        <!-- Site & Location Information -->
                        @if($application->site)
                            <div class="mb-8 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4 border-b pb-2">Site / Land Registration Information</h4>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-sm">
                                    <div>
                                        <span class="block text-xs font-semibold text-gray-400 uppercase">Location Data</span>
                                        <div class="mt-1 space-y-1">
                                            <p><span class="text-gray-600 font-medium">Mukim:</span> {{ $application->site->mukim }}</p>
                                            <p><span class="text-gray-600 font-medium">Lot:</span> {{ $application->site->lot }}</p>
                                            <p><span class="text-gray-600 font-medium">BPK:</span> {{ $application->site->bpk ?: 'N/A' }}</p>
                                            <p><span class="text-gray-600 font-medium">Map Sheet:</span> {{ $application->site->lembaran ?: 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="block text-xs font-semibold text-gray-400 uppercase">Land Specs</span>
                                        <div class="mt-1 space-y-1">
                                            <p><span class="text-gray-600 font-medium">Area (Luas):</span> {{ number_format($application->site->luas, 4) }}</p>
                                            <p><span class="text-gray-600 font-medium">Category:</span> {{ $application->site->kategori_tanah ?: 'N/A' }}</p>
                                            <p><span class="text-gray-600 font-medium">Status:</span> {{ $application->site->status_tanah ?: 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 p-3 rounded border border-gray-200">
                                        <span class="block text-xs font-semibold text-gray-500 uppercase mb-2">GPS Coordinates</span>
                                        @if($application->site->google_lat && $application->site->google_long)
                                            <p class="font-mono text-gray-800 text-xs">Lat: {{ $application->site->google_lat }}</p>
                                            <p class="font-mono text-gray-800 text-xs">Lng: {{ $application->site->google_long }}</p>
                                            <a href="https://www.google.com/maps/search/?api=1&query={{ $application->site->google_lat }},{{ $application->site->google_long }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-xs block mt-2 underline">View on Google Maps</a>
                                        @else
                                            <p class="text-gray-500 italic text-sm">Not recorded</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Site Visit Investigation Findings -->
                        @if($application->siteVisits && $application->siteVisits->count() > 0)
                            <div>
                                <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4 border-b pb-2">Site Investigation Findings</h4>
                                
                                @foreach($application->siteVisits as $visit)
                                    <div class="mb-6 bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                                        <div class="bg-gray-50 px-4 py-3 border-b flex justify-between items-center">
                                            <div>
                                                <span class="font-semibold text-gray-800 text-sm">Visit Date: {{ $visit->visit_date->format('d/m/Y h:i A') }}</span>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $visit->status === 'COMPLETED' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }} ml-2">
                                                    {{ $visit->status }}
                                                </span>
                                            </div>
                                            <span class="text-purple-600 font-mono text-xs">{{ $visit->location_data ?? 'No GPS Data' }}</span>
                                        </div>
                                        
                                        <!-- Add new grouped data here -->
                                        <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-6 border-b border-gray-100">
                                            <!-- Site Conditions & Infra -->
                                            <div class="space-y-4">
                                                <div>
                                                    <strong class="text-xs text-gray-500 uppercase tracking-wider">Site Conditions</strong>
                                                    <p class="text-sm mt-1 border-b pb-1 border-dotted"><span class="text-gray-600">Activity:</span> {{ $visit->activity ?: '-' }}</p>
                                                    <p class="text-sm mt-1 border-b pb-1 border-dotted"><span class="text-gray-600">Facility:</span> {{ $visit->facility ?: '-' }}</p>
                                                </div>
                                                <div>
                                                    <strong class="text-xs text-gray-500 uppercase tracking-wider">Infrastructure</strong>
                                                    <div class="grid grid-cols-2 gap-2 mt-1">
                                                        <p class="text-sm"><span class="text-gray-600">Entrance:</span> {{ $visit->entrance_way ?: '-' }}</p>
                                                        <p class="text-sm"><span class="text-gray-600">Drainage:</span> {{ $visit->parit ?: '-' }}</p>
                                                        <p class="text-sm"><span class="text-gray-600">Trees:</span> {{ $visit->tree ?: '-' }}</p>
                                                        <p class="text-sm"><span class="text-gray-600">Topo:</span> {{ $visit->topography ?: '-' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Verify & Other -->
                                            <div class="space-y-4">
                                                <div>
                                                    <strong class="text-xs text-gray-500 uppercase tracking-wider">Verification</strong>
                                                    <p class="text-sm mt-1 border-b pb-1 border-dotted"><span class="text-gray-600">Land Use Zone:</span> {{ $visit->land_use_zone ?: '-' }}</p>
                                                    <p class="text-sm mt-1 border-b pb-1 border-dotted"><span class="text-gray-600">Density:</span> {{ $visit->density ?: '-' }}</p>
                                                    <p class="text-sm mt-1 border-b pb-1 border-dotted"><span class="text-gray-600">Recommend Road:</span> 
                                                        {!! $visit->recommend_road ? '<span class="text-green-600 font-bold">YES</span>' : '<span class="text-gray-500">NO</span>' !!}
                                                    </p>
                                                </div>
                                                <div class="grid grid-cols-2 gap-2">
                                                    <div>
                                                        <strong class="text-xs text-gray-500 uppercase tracking-wider">Anjakan</strong>
                                                        <p class="text-sm mt-1">{{ $visit->anjakan ?: '-' }}</p>
                                                    </div>
                                                    <div>
                                                        <strong class="text-xs text-gray-500 uppercase tracking-wider">Social Fac.</strong>
                                                        <p class="text-sm mt-1">{{ $visit->social_facility ?: '-' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <!-- Directions & Photos -->
                                            @foreach(['north' => ['finding_north', 'photos_north'], 'south' => ['findings_south', 'photos_south'], 'east' => ['findings_east', 'photo_east'], 'west' => ['finding_west', 'photo_west']] as $dir => $fields)
                                                <div class="bg-gray-50 rounded p-3 border border-gray-100">
                                                    <h5 class="text-xs font-bold uppercase text-gray-600 mb-2 border-b pb-1">{{ ucfirst($dir) }} Direction</h5>
                                                    <p class="text-sm text-gray-800 mb-3 whitespace-pre-line">{{ $visit->{$fields[0]} ?: 'No observations recorded.' }}</p>
                                                    
                                                    @if(is_array($visit->{$fields[1]}) && count($visit->{$fields[1]}) > 0)
                                                        <div class="grid grid-cols-2 gap-2">
                                                            @foreach($visit->{$fields[1]} as $photoPath)
                                                                <a href="{{ Storage::url($photoPath) }}" target="_blank" class="block">
                                                                    <img src="{{ Storage::url($photoPath) }}" alt="{{ ucfirst($dir) }} Photo" class="h-24 w-full object-cover rounded shadow-sm hover:opacity-75 transition">
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    </div>
                </div>

                <form method="POST" action="{{ route('officer.review.store', $application->application_id) }}" x-data="{
                    check1: false,
                    check2: false,
                    check3: false,
                    get allChecked() {
                        return this.check1 && this.check2 && this.check3;
                    }
                }">
                    @csrf

                    <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Review Details</h3>

                    <div class="mb-6">
                        <x-input-label for="review_content" :value="__('Officer Review & Observations *')" />
                        <textarea id="review_content"
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            name="review_content" rows="4" required>{{ old('review_content') }}</textarea>
                        <x-input-error :messages="$errors->get('review_content')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="recommendation" :value="__('Recommendation *')" />
                        <select id="recommendation" name="recommendation"
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            required>
                            <option value="" disabled selected>Select a recommendation...</option>
                            <option value="SUPPORTED" {{ old('recommendation') == 'SUPPORTED' ? 'selected' : '' }}>
                                Supported</option>
                            <option value="NOT_SUPPORTED" {{ old('recommendation') == 'NOT_SUPPORTED' ? 'selected' : '' }}>Not Supported</option>
                        </select>
                        <x-input-error :messages="$errors->get('recommendation')" class="mt-2" />
                    </div>

                    <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2 mt-8">Self-Check Checklist</h3>
                    <p class="text-sm text-gray-500 mb-4">Please verify the following before submitting your
                        recommendation:</p>

                    <div class="space-y-4 mb-8 bg-blue-50 p-4 rounded-md border border-blue-100">
                        <label class="flex items-start">
                            <input type="checkbox" name="self_check_1"
                                class="mt-1 rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                                x-model="check1" required>
                            <span class="ml-3 text-sm text-gray-700">I have reviewed all submitted documents and site
                                investigation photos.</span>
                        </label>
                        <label class="flex items-start">
                            <input type="checkbox" name="self_check_2"
                                class="mt-1 rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                                x-model="check2" required>
                            <span class="ml-3 text-sm text-gray-700">The project location matches the submitted
                                application coordinates.</span>
                        </label>
                        <label class="flex items-start">
                            <input type="checkbox" name="self_check_3"
                                class="mt-1 rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                                x-model="check3" required>
                            <span class="ml-3 text-sm text-gray-700">My recommendation is completely based on standard
                                operating procedures.</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4 pt-4 border-t">
                        <a href="{{ route('officer.dashboard') }}"
                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 mr-3">
                            Cancel
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-900 focus:bg-blue-900 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:bg-gray-400 disabled:cursor-not-allowed"
                            x-bind:disabled="!allChecked">
                            {{ __('Submit Recommendation') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>