<x-app-layout>
    <x-slot name="header">
        Site Visit Report Details
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 space-y-6">
        
        <!-- Header Actions -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-display font-bold text-gray-900">Report for: {{ $siteVisit->application->tajuk }}</h2>
                <div class="mt-2 flex items-center space-x-3">
                    <span class="text-sm text-gray-500 font-mono">App Ref: {{ $siteVisit->application->reference_no ?? 'Pending' }}</span>
                    <span class="text-sm text-gray-500">&bull;</span>
                    <span class="text-sm text-gray-500">Visited: {{ $siteVisit->visit_date->format('M d, Y') }}</span>
                    <span class="text-sm text-gray-500">&bull;</span>
                    <span class="text-sm text-gray-500">Officer: {{ $siteVisit->officer->name }}</span>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('applications.show', $siteVisit->application) }}">
                    <x-secondary-button>
                        Back to Application
                    </x-secondary-button>
                </a>
                @if($siteVisit->application->status === 'SITE_VISIT_IN_PROGRESS')
                    <a href="{{ route('site-visits.edit', $siteVisit) }}">
                        <x-primary-button>
                            Edit Report
                        </x-primary-button>
                    </a>
                @endif
            </div>
        </div>

        <!-- Four Boundaries Findings & Photos -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <!-- North -->
            <x-card title="North Boundary">
                <p class="text-sm text-gray-700 mb-4">{{ $siteVisit->finding_north ?? 'No findings recorded.' }}</p>
                @if(!empty($siteVisit->photos_north))
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                        @foreach($siteVisit->photos_north as $photo)
                            <a href="{{ Storage::url($photo) }}" target="_blank" class="block overflow-hidden rounded-md border border-gray-200 hover:opacity-75">
                                <img src="{{ Storage::url($photo) }}" alt="North Photo {{ $loop->iteration }}" class="object-cover h-24 w-full">
                            </a>
                        @endforeach
                    </div>
                @endif
            </x-card>

            <!-- South -->
            <x-card title="South Boundary">
                <p class="text-sm text-gray-700 mb-4">{{ $siteVisit->finding_south ?? 'No findings recorded.' }}</p>
                @if(!empty($siteVisit->photos_south))
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                        @foreach($siteVisit->photos_south as $photo)
                            <a href="{{ Storage::url($photo) }}" target="_blank" class="block overflow-hidden rounded-md border border-gray-200 hover:opacity-75">
                                <img src="{{ Storage::url($photo) }}" alt="South Photo {{ $loop->iteration }}" class="object-cover h-24 w-full">
                            </a>
                        @endforeach
                    </div>
                @endif
            </x-card>

            <!-- East -->
            <x-card title="East Boundary">
                <p class="text-sm text-gray-700 mb-4">{{ $siteVisit->finding_east ?? 'No findings recorded.' }}</p>
                @if(!empty($siteVisit->photo_east))
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                        @foreach($siteVisit->photo_east as $photo)
                            <a href="{{ Storage::url($photo) }}" target="_blank" class="block overflow-hidden rounded-md border border-gray-200 hover:opacity-75">
                                <img src="{{ Storage::url($photo) }}" alt="East Photo {{ $loop->iteration }}" class="object-cover h-24 w-full">
                            </a>
                        @endforeach
                    </div>
                @endif
            </x-card>

            <!-- West -->
            <x-card title="West Boundary">
                <p class="text-sm text-gray-700 mb-4">{{ $siteVisit->finding_west ?? 'No findings recorded.' }}</p>
                @if(!empty($siteVisit->photo_west))
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                        @foreach($siteVisit->photo_west as $photo)
                            <a href="{{ Storage::url($photo) }}" target="_blank" class="block overflow-hidden rounded-md border border-gray-200 hover:opacity-75">
                                <img src="{{ Storage::url($photo) }}" alt="West Photo {{ $loop->iteration }}" class="object-cover h-24 w-full">
                            </a>
                        @endforeach
                    </div>
                @endif
            </x-card>

        </div>

        <!-- Site Conditions Summary Matrix -->
        <x-card title="Site Parameters Matrix">
            <dl class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Activity</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $siteVisit->activity ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Facility</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $siteVisit->facility ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Land Use Zone</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $siteVisit->land_use_zone ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Density</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $siteVisit->density ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Entrance Access</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $siteVisit->entrance_way ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Drainage (Parit)</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $siteVisit->parit ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Est. Trees</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $siteVisit->tree ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Recommend Road</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        @if(!is_null($siteVisit->recommend_road))
                            <x-badge :color="$siteVisit->recommend_road ? 'success' : 'danger'">
                                {{ $siteVisit->recommend_road ? 'Yes' : 'No' }}
                            </x-badge>
                        @else
                            -
                        @endif
                    </dd>
                </div>
            </dl>

            @if($siteVisit->location_data)
                <div class="mt-6 pt-6 border-t border-gray-100">
                    <dt class="text-sm font-medium text-gray-500 mb-2">General Remarks</dt>
                    <dd class="text-sm text-gray-900 whitespace-pre-line bg-gray-50 p-4 rounded-md">{{ $siteVisit->location_data }}</dd>
                </div>
            @endif

            <!-- Attachments -->
            @if(!empty($siteVisit->attachments))
                <div class="mt-6 pt-6 border-t border-gray-100">
                    <dt class="text-sm font-medium text-gray-500 mb-3">Additional Attachments</dt>
                    <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                        @foreach($siteVisit->attachments as $file)
                            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                <div class="w-0 flex-1 flex items-center">
                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-2 flex-1 w-0 truncate">
                                        Attachment {{ $loop->iteration }}
                                    </span>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <a href="{{ Storage::url($file) }}" target="_blank" class="font-medium text-primary hover:text-primary-light">
                                        Download / View
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </x-card>

    </div>
</x-app-layout>
