<x-app-layout>
    <x-slot name="header">
        Final Approval Details
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 space-y-6">
        
        <!-- Header Actions -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-display font-bold text-gray-900">Decision: {{ $approval->application->tajuk }}</h2>
                <div class="mt-2 flex items-center space-x-3">
                    <span class="text-sm text-gray-500 font-mono">App Ref: {{ $approval->application->reference_no ?? 'Pending' }}</span>
                    <span class="text-sm text-gray-500">&bull;</span>
                    <span class="text-sm font-medium text-gray-900">
                        Status: 
                        @if($approval->decision === 'APPROVED')
                            <span class="text-green-600 font-bold uppercase tracking-wider">Approved</span>
                        @else
                            <span class="text-red-600 font-bold uppercase tracking-wider">Rejected</span>
                        @endif
                    </span>
                    <span class="text-sm text-gray-500">&bull;</span>
                    <span class="text-sm text-gray-500">Director: {{ $approval->director->name }}</span>
                    <span class="text-sm text-gray-500">&bull;</span>
                    <span class="text-sm text-gray-500">Date: {{ $approval->created_at->format('M d, Y H:i A') }}</span>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('applications.show', $approval->application) }}">
                    <x-secondary-button>
                        Back to Application
                    </x-secondary-button>
                </a>
            </div>
        </div>

        <x-card>
            <div class="bg-gray-50 border-l-4 
                @if($approval->decision === 'APPROVED') border-primary text-primary-dark cursor-default
                @else border-red-600 text-red-800
                @endif 
                p-4 rounded-r-md mb-6 inline-block w-full max-w-2xl shadow-sm">
                
                <h3 class="text-xl font-bold flex items-center mb-2">
                    Final Decision: {{ ucfirst(strtolower($approval->decision)) }}
                    
                    @if($approval->decision === 'APPROVED')
                        <svg class="w-6 h-6 ml-2 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    @else
                        <svg class="w-6 h-6 ml-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    @endif
                </h3>
            </div>

            @if($approval->conditions)
                <h4 class="text-md font-semibold text-gray-900 border-b pb-2 mb-4">Conditions of Approval</h4>
                <div class="prose max-w-none text-gray-800 bg-orange-50 p-6 rounded border border-orange-200 shadow-sm whitespace-pre-line mb-6">
                    {{ $approval->conditions }}
                </div>
            @endif

            <h4 class="text-md font-semibold text-gray-900 border-b pb-2 mb-4">General Remarks / Notes</h4>
            <div class="prose max-w-none text-gray-700 bg-white p-6 rounded border shadow-sm whitespace-pre-line">
                {{ $approval->remarks ?? 'No additional remarks provided.' }}
            </div>
        </x-card>

    </div>
</x-app-layout>
