<x-app-layout>
    <x-slot name="header">
        Verification Details
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 space-y-6">
        
        <!-- Header Actions -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-display font-bold text-gray-900">Verification: {{ $verification->application->tajuk }}</h2>
                <div class="mt-2 flex items-center space-x-3">
                    <span class="text-sm text-gray-500 font-mono">App Ref: {{ $verification->application->reference_no ?? 'Pending' }}</span>
                    <span class="text-sm text-gray-500">&bull;</span>
                    <span class="text-sm font-medium text-gray-900">
                        Status: 
                        @if($verification->status === 'VERIFIED')
                            <span class="text-green-600 font-semibold">Verified</span>
                        @else
                            <span class="text-red-600 font-semibold">Rejected</span>
                        @endif
                    </span>
                    <span class="text-sm text-gray-500">&bull;</span>
                    <span class="text-sm text-gray-500">Asst. Director: {{ $verification->assistantDirector->name }}</span>
                    <span class="text-sm text-gray-500">&bull;</span>
                    <span class="text-sm text-gray-500">Date: {{ $verification->created_at->format('M d, Y H:i A') }}</span>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('applications.show', $verification->application) }}">
                    <x-secondary-button>
                        Back to Application
                    </x-secondary-button>
                </a>
            </div>
        </div>

        <x-card>
            <div class="bg-gray-50 border-l-4 
                @if($verification->status === 'VERIFIED') border-green-500 text-green-800
                @else border-red-600 text-red-800
                @endif 
                p-4 rounded-r-md mb-6 inline-block w-full max-w-lg">
                
                <h3 class="text-lg font-bold flex items-center mb-2">
                    Decision: {{ ucfirst(strtolower($verification->status)) }}
                    
                    @if($verification->status === 'VERIFIED')
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    @else
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    @endif
                </h3>
            </div>

            <h4 class="text-md font-semibold text-gray-900 border-b pb-2 mb-4">Verification Remarks / Conditions Notes</h4>
            <div class="prose max-w-none text-gray-700 bg-white p-6 rounded border shadow-sm whitespace-pre-line">
                {{ $verification->remarks ?? 'No remarks provided.' }}
            </div>
        </x-card>

    </div>
</x-app-layout>
