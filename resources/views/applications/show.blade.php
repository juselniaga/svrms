<x-app-layout>
    <x-slot name="header">
        Application Details
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">

        <!-- Header with Status -->
        
           
       
            <div class="mt-2 grid grid-cols-1 sm:grid-cols-3 gap-2 mb-6">
                <div class="bg-blue-500 backdrop-blur-sm px-2 py-2 rounded-lg border border-white border-opacity-20">
                    <span class="text-xs text-blue-100 uppercase font-semibold tracking-wide block">Reference No.</span>
                    <p class="font-mono font-bold text-xl text-white mt-2">{{ $application->reference_no ?? 'Pending generation' }}</p>
                </div>
                
                <div class="bg-blue-500 backdrop-blur-sm px-4 py-4 rounded-lg border border-white border-opacity-20">
                    <span class="text-xs text-blue-100 uppercase font-semibold tracking-wide block">Submitted Date</span>
                    <p class="font-bold text-xl text-white mt-2">{{ $application->created_at->format('d M Y') }}</p>
                </div>
                <div class="bg-blue-500 backdrop-blur-sm px-4 py-4 rounded-lg border border-white border-opacity-20">
                    <span class="text-xs text-blue-100 uppercase font-semibold tracking-wide block mb-2">Status</span>
                    <div class="mt-2">
                        <x-status-badge :status="$application->status" />
                    </div>
                </div>
            </div>
        

        <div class="space-y-8">
            <!-- Application Information Section -->
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-1 h-8 bg-blue-500 rounded"></div>
                    <h2 class="text-xl font-bold text-gray-900">Application Information</h2>
                </div>

                <div class="bg-gradient-to-br from-blue-50 to-blue-100 border-l-4 border-blue-500 rounded-lg p-6 shadow space-y-4">
                    <!-- Title Row -->
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <p class="text-xs text-gray-600 uppercase font-semibold tracking-wide mb-3">Title</p>
                        <p class="text-base text-gray-900 font-semibold leading-relaxed">{{ $application->tajuk }}</p>
                    </div>

                    <!-- Location, Lot Number, Status Row -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <p class="text-xs text-gray-600 uppercase font-semibold tracking-wide mb-3">Location</p>
                            <p class="text-base text-gray-900 leading-relaxed">{{ $application->lokasi }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <p class="text-xs text-gray-600 uppercase font-semibold tracking-wide mb-3">Lot Number</p>
                            <p class="text-lg text-gray-900 font-mono font-bold">{{ $application->no_fail }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <p class="text-xs text-gray-600 uppercase font-semibold tracking-wide mb-3">Status</p>
                            <p class="text-base text-gray-900 font-semibold">{{ str_replace('_', ' ', $application->status) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Developer Information Section -->
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-1 h-8 bg-green-500 rounded"></div>
                    <h2 class="text-xl font-bold text-gray-900">Developer Information</h2>
                </div>

                <div class="bg-gradient-to-br from-green-50 to-green-100 border-l-4 border-green-500 rounded-lg p-6 shadow">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Developer Details -->
                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <p class="text-xs text-gray-600 uppercase font-semibold tracking-wide mb-3">Name</p>
                            <p class="text-lg font-bold text-gray-900">{{ $application->developer->name }}</p>
                        </div>

                        <!-- Contact Info -->
                        <div class="bg-white p-4 rounded-lg shadow-sm">
                            <p class="text-xs text-gray-600 uppercase font-semibold tracking-wide mb-3">Contact</p>
                            <div class="space-y-2">
                                <p class="text-sm text-gray-900"><span class="font-semibold">Phone:</span> {{ $application->developer->tel }}</p>
                                <p class="text-sm text-gray-900"><span class="font-semibold">Email:</span> {{ $application->developer->email }}</p>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="bg-white p-4 rounded-lg shadow-sm lg:col-span-2">
                            <p class="text-xs text-gray-600 uppercase font-semibold tracking-wide mb-3">Address</p>
                            <div class="text-sm text-gray-900 space-y-1 leading-relaxed">
                                <p>{{ $application->developer->address1 }}</p>
                                @if($application->developer->address2)
                                    <p>{{ $application->developer->address2 }}</p>
                                @endif
                                <p>{{ $application->developer->poskod }} {{ $application->developer->city }}, {{ $application->developer->state }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Audit Trail Section -->
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-1 h-8 bg-purple-500 rounded"></div>
                    <h2 class="text-xl font-bold text-gray-900">Activity Timeline</h2>
                </div>

                <div class="bg-white border border-gray-200 rounded-lg shadow p-6">
                    <div class="flow-root">
                        <ul role="list" class="-mb-8">
                            @forelse($application->auditLogs as $log)
                                <li>
                                    <div class="relative pb-8">
                                        @if(!$loop->last)
                                            <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gradient-to-b from-blue-400 to-transparent" aria-hidden="true"></span>
                                        @endif
                                        <div class="relative flex space-x-4">
                                            <div>
                                                <span class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center ring-4 ring-white text-white shadow">
                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="flex min-w-0 flex-1 flex-col pt-1">
                                                <div>
                                                    <p class="font-semibold text-base text-blue-700">{{ $log->action }}</p>
                                                    <p class="text-sm text-gray-600 mt-1">By <span class="font-semibold">{{ $log->user ? $log->user->name : 'System' }}</span></p>
                                                    @if($log->remarks)
                                                        <p class="text-sm text-gray-900 mt-2 p-3 bg-gray-50 rounded italic border-l-2 border-gray-300">"{{ $log->remarks }}"</p>
                                                    @endif
                                                    @if($log->new_status)
                                                        <div class="mt-3 flex items-center gap-2">
                                                            <span class="inline-block px-3 py-1 bg-gray-200 text-gray-800 text-xs font-semibold rounded">{{ $log->previous_status ?? 'NEW' }}</span>
                                                            <span class="text-gray-400 font-semibold">→</span>
                                                            <x-status-badge :status="$log->new_status" />
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="mt-3 text-xs text-gray-500 font-semibold">
                                                    <time datetime="{{ $log->timestamp }}">{{ \Carbon\Carbon::parse($log->timestamp)->format('d M Y H:i') }} ({{ \Carbon\Carbon::parse($log->timestamp)->diffForHumans() }})</time>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="text-center py-8">
                                    <p class="text-base text-gray-500">No activity log available for this application.</p>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
