<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight block">
            {{ __('Review & Recommendation') }}
        </h2>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4 sm:p-6">

                <div class="mb-6 sm:mb-8 p-4 sm:p-6 bg-gradient-to-r from-indigo-50 to-blue-50 border-2 border-indigo-300 rounded-lg sm:rounded-xl shadow-md">
                    <h3 class="text-base sm:text-lg font-bold text-indigo-800 uppercase tracking-wider mb-4 sm:mb-5 pb-3 border-b-2 border-indigo-300 flex items-center">
                        <span class="text-xl sm:text-2xl mr-2 sm:mr-3">📋</span> <span class="text-sm sm:text-base">Detail Permohonan</span>
                    </h3>
                    <div class="grid grid-cols-1 gap-4 sm:gap-6">
                        <div class="space-y-3">
                            <p class="text-sm">
                                <span class="font-bold text-indigo-700 block uppercase text-xs tracking-wider mb-1">No Rujukan Fail</span>
                                <span class="font-mono font-bold text-lg text-gray-900">{{ $application->reference_no }}</span>
                            </p>
                            <p class="text-sm">
                                <span class="font-bold text-indigo-700 block uppercase text-xs tracking-wider mb-1">Tajuk Projek</span>
                                <span class="font-medium text-gray-900">{{ $application->tajuk }}</span>
                            </p>
                        </div>
                        <div class="space-y-3">
                            <p class="text-sm">
                                <span class="font-bold text-indigo-700 block uppercase text-xs tracking-wider mb-1">Pemohon</span>
                                <span class="font-medium text-gray-900">{{ $application->developer->name ?? 'N/A' }}</span>
                            </p>
                            <p class="text-sm">
                                <span class="font-bold text-indigo-700 block uppercase text-xs tracking-wider mb-1">Status</span>
                                <span class="inline-block px-4 py-1 bg-blue-500 text-white text-xs font-bold rounded-full">{{ str_replace('_', ' ', $application->status) }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Accordion for Full Application Data Context - Mobile Responsive -->
                <div x-data="{ open: false }" class="mb-8 sm:mb-10 border-2 border-gray-300 rounded-lg sm:rounded-xl overflow-hidden shadow-md hover:shadow-lg transition">
                    <button @click="open = !open" type="button" class="w-full flex justify-between items-center bg-gradient-to-r from-gray-100 to-gray-50 px-4 sm:px-6 py-3 sm:py-4 text-left hover:from-gray-200 hover:to-gray-100 focus:outline-none transition">
                        <span class="font-bold text-sm sm:text-lg text-gray-800 flex items-center gap-2 sm:gap-3">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                            <span class="hidden sm:inline">👁️</span> <span class="text-xs sm:text-base">Informasi Lengkap & Penemuan</span>
                        </span>
                        <svg class="h-5 w-5 sm:h-6 sm:w-6 text-gray-600 transform transition-transform duration-300 flex-shrink-0" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    
                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="p-3 sm:p-6 bg-white border-t border-gray-200">
                        
                        <!-- Site & Location Information -->
                        @if($application->site)
                            <div class="mb-8 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                <h4 class="text-sm font-semibold text-indigo-600 uppercase tracking-wider mb-4 border-b pb-2">Site / Land Registration Information</h4>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-sm">
                                    <div>
                                        <span class="block text-xs font-semibold text-gray-400 uppercase">Location Data</span>
                                        <div class="mt-1 space-y-1">
                                            <p><span class="text-gray-600 font-medium">Mukim:</span>
                                                {{ $application->site->mukim }}
                                                @if($application->site->mukim_relation)
                                                    - {{ $application->site->mukim_relation->mukim }}
                                                @endif
                                            </p>
                                            <p><span class="text-gray-600 font-medium">Lot:</span> {{ $application->site->lot }}</p>
                                            <p><span class="text-gray-600 font-medium">BP:</span>
                                                @if($application->site->bp)
                                                    {{ $application->site->bp }}
                                                    @if($application->site->bp_relation)
                                                        - {{ $application->site->bp_relation->bp_name }}
                                                    @endif
                                                @else
                                                    N/A
                                                @endif
                                            </p>
                                            <p><span class="text-gray-600 font-medium">BPK:</span>
                                                @if($application->site->bpk)
                                                    {{ $application->site->bpk }}
                                                    @if($application->site->bpk_relation)
                                                        - {{ $application->site->bpk_relation->bpk_name }}
                                                    @endif
                                                @else
                                                    N/A
                                                @endif
                                            </p>
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
                                        @if($application->site->google_lat)
                                            <p class="font-mono text-gray-800 text-xs">Lat: {{ $application->site->google_lat }}</p>
                                           
                                            <a href="https://www.google.com/maps/search/?api=1&query={{ $application->site->google_lat }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-xs block mt-2 underline">View on Google Maps</a>
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
                                <h4 class="text-sm font-semibold text-indigo-600 uppercase tracking-wider mb-4 border-b pb-2">Site Investigation Findings</h4>
                                
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
                                            @foreach(['location' => ['finding_location', 'photos_location'], 'jalan' => ['finding_jalan', 'photos_jalan'], 'north' => ['finding_north', 'photos_north'], 'south' => ['findings_south', 'photos_south'], 'east' => ['findings_east', 'photo_east'], 'west' => ['finding_west', 'photo_west']] as $dir => $fields)
                                                <div class="bg-gray-50 rounded p-3 border border-gray-100">
                                                    <h5 class="text-xs font-bold uppercase text-gray-600 mb-2 border-b pb-1">
                                                        @if($dir === 'location')
                                                            Lokasi (Location)
                                                        @elseif($dir === 'jalan')
                                                            Jalan (Road)
                                                        @else
                                                            {{ ucfirst($dir) }} Direction
                                                        @endif
                                                    </h5>
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

                    <h3 class="text-lg sm:text-2xl font-bold text-gray-800 mb-4 sm:mb-6 pb-3 sm:pb-4 border-b-2 border-purple-400 flex items-center">
                        <span class="text-xl sm:text-2xl mr-2 sm:mr-3">✍️</span> <span class="text-sm sm:text-base">Review Details</span>
                    </h3>

                    <div class="mb-6 sm:mb-8">
                        <label for="review_content" class="block font-bold text-xs sm:text-sm text-gray-700 mb-2 sm:mb-3 uppercase tracking-wider">📝 Officer Review & Observations <span class="text-red-600">*</span></label>
                        <textarea id="review_content"
                            class="block w-full px-3 sm:px-4 py-2.5 sm:py-3 text-sm border-2 border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 rounded-lg shadow-sm transition bg-white"
                            name="review_content" rows="4" placeholder="Provide detailed observations and analysis..." required>{{ old('review_content') }}</textarea>
                        <x-input-error :messages="$errors->get('review_content')" class="mt-2 text-xs" />
                    </div>

                    <div class="mb-8 sm:mb-10">
                        <label for="recommendation" class="block font-bold text-xs sm:text-sm text-gray-700 mb-2 sm:mb-3 uppercase tracking-wider">🎯 Recommendation <span class="text-red-600">*</span></label>
                        <select id="recommendation" name="recommendation"
                            class="block w-full px-3 sm:px-4 py-2.5 sm:py-3 text-sm border-2 border-gray-300 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 rounded-lg shadow-sm transition bg-white"
                            required>
                            <option value="" disabled selected>Select your recommendation...</option>
                            <option value="SUPPORTED" {{ old('recommendation') == 'SUPPORTED' ? 'selected' : '' }}>
                                ✓ SUPPORTED - Application is suitable to proceed
                            </option>
                            <option value="NOT_SUPPORTED" {{ old('recommendation') == 'NOT_SUPPORTED' ? 'selected' : '' }}>
                                ✗ NOT SUPPORTED - Application does not meet requirements
                            </option>
                        </select>
                        <x-input-error :messages="$errors->get('recommendation')" class="mt-2 text-xs" />
                    </div>

                    <h3 class="text-lg sm:text-2xl font-bold text-gray-800 mb-4 sm:mb-6 pb-3 sm:pb-4 border-b-2 border-green-400 flex items-center">
                        <span class="text-xl sm:text-2xl mr-2 sm:mr-3">☑️</span> <span class="text-sm sm:text-base">Self-Check Checklist</span>
                    </h3>
                    <p class="text-xs sm:text-sm text-gray-600 mb-4 sm:mb-6 bg-green-50 p-3 sm:p-4 rounded-lg border-l-4 border-green-500">
                        ✓ Please verify the following before submitting your recommendation
                    </p>

                    <div class="space-y-3 sm:space-y-4 mb-8 sm:mb-10 p-4 sm:p-6 bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg sm:rounded-xl border-2 border-green-300">
                        <label class="flex items-start p-4 bg-white rounded-lg border-2 border-green-200 hover:border-green-300 hover:shadow-md transition cursor-pointer">
                            <input type="checkbox" name="self_check_1"
                                class="mt-1 w-5 h-5 rounded border-green-300 text-green-600 shadow-sm focus:ring-2 focus:ring-green-500 cursor-pointer"
                                x-model="check1" required>
                            <span class="ml-4 text-sm font-medium text-gray-800">I have reviewed all submitted documents and site investigation photos.</span>
                        </label>
                        <label class="flex items-start p-4 bg-white rounded-lg border-2 border-green-200 hover:border-green-300 hover:shadow-md transition cursor-pointer">
                            <input type="checkbox" name="self_check_2"
                                class="mt-1 w-5 h-5 rounded border-green-300 text-green-600 shadow-sm focus:ring-2 focus:ring-green-500 cursor-pointer"
                                x-model="check2" required>
                            <span class="ml-4 text-sm font-medium text-gray-800">The project location matches the submitted application coordinates and field observations.</span>
                        </label>
                        <label class="flex items-start p-4 bg-white rounded-lg border-2 border-green-200 hover:border-green-300 hover:shadow-md transition cursor-pointer">
                            <input type="checkbox" name="self_check_3"
                                class="mt-1 w-5 h-5 rounded border-green-300 text-green-600 shadow-sm focus:ring-2 focus:ring-green-500 cursor-pointer"
                                x-model="check3" required>
                            <span class="ml-4 text-sm font-medium text-gray-800">My recommendation is completely based on standard operating procedures and objective findings.</span>
                        </label>
                    </div>

                    <div class="flex flex-col gap-3 mt-8 sm:mt-10 pt-6 sm:pt-8 border-t-2 border-gray-300">
                        <a href="{{ route('officer.dashboard') }}"
                            class="w-full sm:w-auto inline-flex items-center justify-center px-4 sm:px-6 py-2.5 sm:py-3 bg-white border-2 border-gray-300 rounded-lg font-bold text-xs sm:text-sm text-gray-700 shadow-md hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1 sm:mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            <span class="text-xs sm:text-sm">← Back</span>
                        </a>
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center px-4 sm:px-8 py-2.5 sm:py-3 bg-gradient-to-r from-blue-700 to-indigo-700 border-2 border-transparent rounded-lg font-bold text-xs sm:text-sm text-white shadow-lg hover:from-blue-800 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:from-gray-400 disabled:to-gray-500 disabled:cursor-not-allowed"
                            x-bind:disabled="!allChecked">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1 sm:mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-xs sm:text-sm">✓ Submit</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>