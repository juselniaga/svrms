<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight block">
                {{ __('Final Approval Interface') }}
            </h2>
            <span
                class="px-3 py-1 bg-green-100 text-green-800 text-sm font-semibold rounded-full border border-green-200">
                Approval Stage
            </span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Back Link -->
            <div>
                <a href="{{ route('approval.dashboard') }}"
                    class="text-sm text-gray-600 hover:text-gray-900 font-medium">
                    &larr; Back to Dashboard
                </a>
            </div>

            <!-- Full Report Component -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-bold border-b pb-2 mb-6 text-gray-900 border-gray-200">Full Application
                        Report</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <!-- Application Info -->
                        <div>
                            <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Application
                                Details</h4>
                            <dl class="space-y-2 text-sm">
                                <div class="flex justify-between border-b border-gray-100 pb-1">
                                    <dt class="text-gray-600">Reference No:</dt>
                                    <dd class="font-medium text-gray-900">{{ $application->reference_no }}</dd>
                                </div>
                                <div class="flex flex-col border-b border-gray-100 pb-1 pt-1">
                                    <dt class="text-gray-600">Project Title:</dt>
                                    <dd class="font-medium text-gray-900 mt-1">{{ $application->tajuk }}</dd>
                                </div>
                                <div class="flex flex-col border-b border-gray-100 pb-1 pt-1">
                                    <dt class="text-gray-600">Project Location:</dt>
                                    <dd class="font-medium text-gray-900 mt-1">{{ $application->lokasi }}</dd>
                                </div>
                                <div class="flex justify-between border-b border-gray-100 pb-1 pt-1">
                                    <dt class="text-gray-600">Current Status:</dt>
                                    <dd class="font-bold text-blue-700">
                                        {{ str_replace('_', ' ', $application->status) }}</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Developer Info -->
                        <div>
                            <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Developer
                                Information</h4>
                            <dl class="space-y-2 text-sm">
                                <div class="flex justify-between border-b border-gray-100 pb-1">
                                    <dt class="text-gray-600">Company Name:</dt>
                                    <dd class="font-medium text-gray-900">
                                        {{ optional($application->developer)->name ?? 'N/A' }}</dd>
                                </div>
                                <div class="flex justify-between border-b border-gray-100 pb-1 pt-1">
                                    <dt class="text-gray-600">Email:</dt>
                                    <dd class="font-medium text-gray-900">{{ optional($application->developer)->email }}
                                    </dd>
                                </div>
                                <div class="flex justify-between border-b border-gray-100 pb-1 pt-1">
                                    <dt class="text-gray-600">Telephone:</dt>
                                    <dd class="font-medium text-gray-900">{{ optional($application->developer)->tel }}
                                    </dd>
                                </div>
                                <div class="flex flex-col border-b border-gray-100 pb-1 pt-1">
                                    <dt class="text-gray-600">Registered Address:</dt>
                                    <dd class="font-medium text-gray-900 mt-1">
                                        {{ optional($application->developer)->address1 }}<br>
                                        {{ optional($application->developer)->poskod }}
                                        {{ optional($application->developer)->city }},<br>
                                        {{ optional($application->developer)->state }}
                                    </dd>
                                </div>
                        </div>
                    </div>

                    <!-- Site & Location Information -->
                    @if($application->site)
                        <div class="mt-8">
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
                        <div class="mt-8">
                            <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4 border-b pb-2">Site Investigation Findings</h4>
                            
                            @foreach($application->siteVisits as $visit)
                                <div class="mb-6 bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                                    <div class="bg-gray-50 px-4 py-3 border-b flex justify-between items-center">
                                        <div>
                                            <span class="font-semibold text-gray-800 text-sm">Visit Date: {{ $visit->visit_date->format('d/m/Y') }}</span>
                                            <span class="text-gray-500 text-xs ml-2">by {{ optional($visit->officer)->name ?? 'Officer' }}</span>
                                        </div>
                                        <span class="text-purple-600 font-mono text-xs">{{ $visit->location_data ?? 'No GPS Data' }}</span>
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

                    <!-- Officer Review Section -->
                    @if($application->review)
                        <div class="mt-8 bg-gray-50 border border-gray-200 rounded-lg p-5">
                            <h4
                                class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4 border-b border-gray-200 pb-2">
                                Officer's Review & Recommendation</h4>

                            <div class="mb-4">
                                <span class="text-gray-600 text-sm font-semibold">Reviewing Officer:</span>
                                <span
                                    class="text-gray-900 text-sm">{{ $application->review->officer->name ?? 'Unknown Officer' }}</span>
                                <span
                                    class="text-gray-400 text-xs ml-2">({{ $application->review->submitted_at->format('d/m/Y H:i A') }})</span>
                            </div>

                            <div class="mb-5 bg-white p-4 rounded border border-gray-200 shadow-sm">
                                <h5 class="text-xs font-semibold text-gray-500 uppercase mb-2">Review Notes / Observations
                                </h5>
                                <p class="text-gray-800 whitespace-pre-line text-sm">
                                    {{ $application->review->review_content }}</p>
                            </div>

                            <div class="flex items-center space-x-3 bg-white p-4 rounded border border-gray-200 shadow-sm">
                                <span class="text-gray-600 text-sm font-semibold">Official Recommendation:</span>
                                @if($application->review->recommendation === 'SUPPORTED')
                                    <span
                                        class="px-3 py-1 inline-flex text-sm leading-5 font-bold rounded-full bg-green-100 text-green-800 border border-green-200">
                                        SUPPORTED
                                    </span>
                                @else
                                    <span
                                        class="px-3 py-1 inline-flex text-sm leading-5 font-bold rounded-full bg-red-100 text-red-800 border border-red-200">
                                        NOT SUPPORTED
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Assistant Director Verification Section -->
                    @if($application->verification)
                        <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-5">
                            <h4
                                class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4 border-b border-yellow-200 pb-2">
                                Assistant Director Verification</h4>

                            <div class="mb-4">
                                <span class="text-gray-600 text-sm font-semibold">Verified By:</span>
                                <span
                                    class="text-gray-900 text-sm">{{ $application->verification->assistantDirector->name ?? 'Unknown AD' }}</span>
                                <span
                                    class="text-gray-400 text-xs ml-2">({{ $application->verification->verified_at->format('d/m/Y H:i A') }})</span>
                            </div>

                            <div class="mb-5 bg-white p-4 rounded border border-yellow-200 shadow-sm">
                                <h5 class="text-xs font-semibold text-gray-500 uppercase mb-2">Verification Remarks</h5>
                                <p class="text-gray-800 whitespace-pre-line text-sm">
                                    {{ $application->verification->remarks ?? 'None' }}</p>
                            </div>

                            <div
                                class="flex items-center space-x-3 bg-white p-4 rounded border border-yellow-200 shadow-sm">
                                <span class="text-gray-600 text-sm font-semibold">Recommended Decision:</span>
                                @if($application->verification->verification_status === 'VERIFIED')
                                    <span
                                        class="px-3 py-1 inline-flex text-sm leading-5 font-bold rounded-full bg-green-100 text-green-800 border border-green-200">
                                        VERIFIED (Recommend Approval)
                                    </span>
                                @elseif($application->verification->verification_status === 'REJECTED')
                                    <span
                                        class="px-3 py-1 inline-flex text-sm leading-5 font-bold rounded-full bg-red-100 text-red-800 border border-red-200">
                                        REJECTED (Recommend Rejection)
                                    </span>
                                @else
                                    <span
                                        class="px-3 py-1 inline-flex text-sm leading-5 font-bold rounded-full bg-gray-100 text-gray-800 border border-gray-200">
                                        {{ $application->verification->verification_status }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Approval Action Panel -->
            @if($application->status === 'VERIFIED')
                <div class="bg-white overflow-hidden shadow-lg border border-green-200 sm:rounded-lg"
                    x-data="{ action: '' }">
                    <div class="p-6">
                        <h3 class="text-lg font-bold border-b pb-2 mb-4 text-green-900 border-green-100">Final Director
                            Action</h3>

                        <form method="POST" action="{{ route('approval.update', $application->application_id) }}">
                            @csrf

                            <div class="mb-6">
                                <p class="text-sm font-medium text-gray-700 mb-3">Please select your final approval
                                    decision:</p>
                                <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                                    <label
                                        class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none transition-all"
                                        :class="action === 'APPROVED' ? 'border-green-500 ring-2 ring-green-500 bg-green-50' : 'border-gray-300 hover:bg-gray-50'">
                                        <input type="radio" name="action" value="APPROVED" class="sr-only" x-model="action"
                                            required>
                                        <span class="flex flex-1">
                                            <span class="flex flex-col">
                                                <span class="block text-sm font-medium text-gray-900">Final Approve</span>
                                                <span class="mt-1 flex items-center text-xs text-gray-500">Approve
                                                    application & finalize</span>
                                            </span>
                                        </span>
                                    </label>

                                    <label
                                        class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none transition-all"
                                        :class="action === 'RETURNED' ? 'border-orange-500 ring-2 ring-orange-500 bg-orange-50' : 'border-gray-300 hover:bg-gray-50'">
                                        <input type="radio" name="action" value="RETURNED" class="sr-only" x-model="action"
                                            required>
                                        <span class="flex flex-1">
                                            <span class="flex flex-col">
                                                <span class="block text-sm font-medium text-gray-900">Return for
                                                    Amendment</span>
                                                <span class="mt-1 flex items-center text-xs text-gray-500">Send back to
                                                    Officer</span>
                                            </span>
                                        </span>
                                    </label>

                                    <label
                                        class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none transition-all"
                                        :class="action === 'REJECTED' ? 'border-red-500 ring-2 ring-red-500 bg-red-50' : 'border-gray-300 hover:bg-gray-50'">
                                        <input type="radio" name="action" value="REJECTED" class="sr-only" x-model="action"
                                            required>
                                        <span class="flex flex-1">
                                            <span class="flex flex-col">
                                                <span class="block text-sm font-medium text-gray-900">Outright Reject</span>
                                                <span class="mt-1 flex items-center text-xs text-gray-500">Terminate
                                                    Application</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('action')" class="mt-2" />
                            </div>

                            <!-- Dynamic Remarks Field -->
                            <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200 transition-all duration-300"
                                x-show="action !== ''" x-transition>
                                <label for="remarks" class="block text-sm font-medium text-gray-700 mb-2">
                                    Director's Remarks <span x-show="action === 'RETURNED' || action === 'REJECTED'"
                                        class="text-red-500">* (Required)</span>
                                </label>
                                <textarea id="remarks" name="remarks" rows="3"
                                    class="block w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm sm:text-sm"
                                    :required="action === 'RETURNED' || action === 'REJECTED'"
                                    placeholder="Enter justification for your decision here..."></textarea>
                                <x-input-error :messages="$errors->get('remarks')" class="mt-2" />
                                <p class="mt-2 text-xs text-gray-500">These remarks will be recorded in the official audit
                                    trail.</p>
                            </div>

                            <div class="flex justify-end pt-4 border-t border-gray-200">
                                <button type="submit"
                                    class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:bg-gray-400 disabled:cursor-not-allowed"
                                    x-bind:disabled="!action">
                                    Submit Final Decision
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>