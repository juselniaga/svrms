<x-app-layout>
    <x-slot name="header">
        Application Details
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 space-y-6">
        
        <!-- Header Actions & Status -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-display font-bold text-gray-900">{{ $application->tajuk }}</h2>
                <div class="mt-2 flex items-center space-x-3">
                    <span class="text-sm text-gray-500 font-mono">Ref: {{ $application->reference_no ?? 'Pending generation' }}</span>
                    <x-status-badge :status="$application->status" />
                </div>
            </div>
            <div class="flex space-x-3">
                @if($application->status === 'RECORDED')
                    <a href="{{ route('applications.edit', $application) }}">
                        <x-secondary-button>
                            Edit Application
                        </x-secondary-button>
                    </a>
                    
                    <!-- Form placeholder for State Transition to SITE_VISIT_IN_PROGRESS -->
                    <form action="#" method="POST">
                        @csrf
                        <x-primary-button>
                            Proceed to Site Visit
                        </x-primary-button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Application Info Card -->
        <x-card title="Application Information">
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-8">
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Tajuk</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $application->tajuk }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">No. Fail</dt>
                    <dd class="mt-1 font-mono text-sm text-gray-900">{{ $application->no_fail }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Lokasi</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $application->lokasi }}</dd>
                </div>
            </dl>
        </x-card>

        <!-- Developer Info Card -->
        <x-card title="Developer Information">
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-8">
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Name</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $application->developer->name }}</dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Contact</dt>
                    <dd class="mt-1 text-sm text-gray-900 font-mono">{{ $application->developer->tel }} <br> {{ $application->developer->email }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Address</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ $application->developer->address1 }}<br>
                        @if($application->developer->address2) {{ $application->developer->address2 }}<br> @endif
                        {{ $application->developer->poskod }} {{ $application->developer->city }}, {{ $application->developer->state }}
                    </dd>
                </div>
            </dl>
        </x-card>

        <!-- Audit Trail Card -->
        <x-card title="Audit Trail">
            <div class="flow-root mt-4">
                <ul role="list" class="-mb-8">
                    @forelse($application->auditLogs as $log)
                        <li>
                            <div class="relative pb-8">
                                @if(!$loop->last)
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                @endif
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span class="h-8 w-8 rounded-full bg-primary-light flex items-center justify-center ring-8 ring-surface text-white">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                        <div>
                                            <p class="text-sm text-gray-500">
                                                <span class="font-medium text-gray-900">{{ $log->action }}</span>
                                                <br>
                                                By {{ $log->user ? $log->user->name : 'System' }} 
                                            </p>
                                            @if($log->remarks)
                                                <p class="text-sm text-gray-600 mt-1 italic">"{{ $log->remarks }}"</p>
                                            @endif
                                            @if($log->new_status)
                                                <div class="mt-1">
                                                    <x-badge color="gray">{{ $log->previous_status ?? 'NONE' }}</x-badge> &rarr; <x-status-badge :status="$log->new_status" />
                                                </div>
                                            @endif
                                        </div>
                                        <div class="whitespace-nowrap text-right text-sm text-gray-500">
                                            <time datetime="{{ $log->timestamp }}">{{ \Carbon\Carbon::parse($log->timestamp)->diffForHumans() }}</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="pl-4 text-sm text-gray-500">No audit logs available for this application.</li>
                    @endforelse
                </ul>
            </div>
        </x-card>
    </div>
</x-app-layout>
