<x-app-layout>
    <x-slot name="header">
        Review & Recommendation Details
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 space-y-6">
        
        <!-- Header Actions -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-display font-bold text-gray-900">Review: {{ $review->application->tajuk }}</h2>
                <div class="mt-2 flex items-center space-x-3">
                    <span class="text-sm text-gray-500 font-mono">App Ref: {{ $review->application->reference_no ?? 'Pending' }}</span>
                    <span class="text-sm text-gray-500">&bull;</span>
                    <span class="text-sm font-medium text-gray-900">
                        Status: 
                        @if($review->is_submitted)
                            <span class="text-green-600 font-semibold">Submitted</span>
                        @else
                            <span class="text-orange-500 font-semibold">Draft</span>
                        @endif
                    </span>
                    <span class="text-sm text-gray-500">&bull;</span>
                    <span class="text-sm text-gray-500">Officer: {{ $review->officer->name }}</span>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('applications.show', $review->application) }}">
                    <x-secondary-button>
                        Back to Application
                    </x-secondary-button>
                </a>
            </div>
        </div>

        <!-- The Review Card -->
        <x-card>
            <div class="bg-gray-50 border-l-4 
                @if($review->recommendation === 'SOKONG') border-primary text-primary-dark
                @elseif($review->recommendation === 'BERSYARAT') border-accent text-accent-dark
                @else border-red-600 text-red-800
                @endif 
                p-4 rounded-r-md mb-6 inline-block">
                
                <h3 class="text-lg font-bold flex items-center">
                    Recommendation: {{ str_replace('_', ' ', $review->recommendation) }}
                    
                    @if($review->recommendation === 'SOKONG')
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    @elseif($review->recommendation === 'BERSYARAT')
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    @else
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    @endif
                </h3>
            </div>

            <h4 class="text-md font-semibold text-gray-900 border-b pb-2 mb-4">Detailed Analysis & Content</h4>
            <div class="prose max-w-none text-gray-700 bg-white p-6 rounded border shadow-sm whitespace-pre-line">
                {{ $review->review_content }}
            </div>
            
            <div class="mt-6 text-sm text-gray-500">
                Created: {{ $review->created_at->format('M d, Y H:i') }} <br>
                Last Updated: {{ $review->updated_at->format('M d, Y H:i') }}
            </div>
        </x-card>

    </div>
</x-app-layout>
