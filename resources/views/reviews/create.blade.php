<x-app-layout>
    <x-slot name="header">
        Provide Recommendation & Review
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 space-y-6">
        
        <x-card title="Application & Site Details">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <span class="text-sm font-medium text-gray-500">Ref No:</span>
                    <span class="ml-2 text-sm text-gray-900 font-mono">{{ $application->reference_no }}</span>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-500">Tajuk:</span>
                    <span class="ml-2 text-sm text-gray-900">{{ $application->tajuk }}</span>
                </div>
                <div class="md:col-span-2">
                    <span class="text-sm font-medium text-gray-500">Developer:</span>
                    <span class="ml-2 text-sm text-gray-900">{{ $application->developer->name }}</span>
                </div>
                
                @if($application->siteVisits->count() > 0)
                    <div class="md:col-span-2 mt-4 pt-4 border-t">
                        <span class="text-sm font-medium text-gray-500 block mb-2">Recent Site Visits:</span>
                        <ul class="space-y-2">
                            @foreach($application->siteVisits as $visit)
                                <li class="text-sm">
                                    <a href="{{ route('site-visits.show', $visit) }}" target="_blank" class="text-primary hover:text-primary-light flex items-center">
                                        <svg class="w-4 h-4 mr-1 border border-primary rounded" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        Visit on {{ $visit->visit_date->format('M d, Y') }} - View Report
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </x-card>

        <form method="POST" action="{{ route('reviews.store') }}">
            @csrf
            <input type="hidden" name="application_id" value="{{ $application->application_id }}">

            <x-card title="Officer's Review" class="mb-6">
                <!-- Rich Text Review Placeholder -->
                <div class="mb-6">
                    <x-input-label for="review_content" value="Detailed Review / Considerations" />
                    <p class="text-xs text-gray-500 mb-2">Provide a comprehensive analysis based on the site visit report, compliance with local plans, and relevant policies.</p>
                    <textarea id="review_content" name="review_content" class="block mt-1 w-full bg-surface border-gray-300 focus:border-primary-light focus:ring-primary-light rounded-md shadow-sm" rows="8" required>{{ old('review_content') }}</textarea>
                    <x-input-error :messages="$errors->get('review_content')" class="mt-2" />
                </div>

                <!-- Recommendation Enum -->
                <div class="border-t pt-6">
                    <x-input-label value="Recommendation Decision" class="mb-3" />
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        
                        <label class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none">
                            <input type="radio" name="recommendation" value="SOKONG" class="sr-only" {{ old('recommendation') == 'SOKONG' ? 'checked' : '' }} required>
                            <span class="flex flex-1">
                                <span class="flex flex-col">
                                    <span id="project-type-0-label" class="block text-sm font-medium text-gray-900">Sokong (Support)</span>
                                    <span id="project-type-0-description-0" class="mt-1 flex items-center text-sm text-gray-500">Fully meets guidelines.</span>
                                </span>
                            </span>
                            <svg class="h-5 w-5 text-primary {{ old('recommendation') == 'SOKONG' ? 'block' : 'hidden' }} recommendation-icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
                            <span class="pointer-events-none absolute -inset-px rounded-lg border-2 border-transparent {{ old('recommendation') == 'SOKONG' ? 'border-primary' : '' }} recommendation-border" aria-hidden="true"></span>
                        </label>

                        <label class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none">
                            <input type="radio" name="recommendation" value="BERSYARAT" class="sr-only" {{ old('recommendation') == 'BERSYARAT' ? 'checked' : '' }} required>
                            <span class="flex flex-1">
                                <span class="flex flex-col">
                                    <span id="project-type-1-label" class="block text-sm font-medium text-gray-900">Bersyarat (Conditional)</span>
                                    <span id="project-type-1-description-0" class="mt-1 flex items-center text-sm text-gray-500">Supported with imposed conditions.</span>
                                </span>
                            </span>
                            <svg class="h-5 w-5 text-accent {{ old('recommendation') == 'BERSYARAT' ? 'block' : 'hidden' }} recommendation-icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
                            <span class="pointer-events-none absolute -inset-px rounded-lg border-2 border-transparent {{ old('recommendation') == 'BERSYARAT' ? 'border-accent' : '' }} recommendation-border" aria-hidden="true"></span>
                        </label>

                        <label class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none">
                            <input type="radio" name="recommendation" value="TIDAK_SOKONG" class="sr-only" {{ old('recommendation') == 'TIDAK_SOKONG' ? 'checked' : '' }} required>
                            <span class="flex flex-1">
                                <span class="flex flex-col">
                                    <span id="project-type-2-label" class="block text-sm font-medium text-gray-900">Tidak Sokong (Reject)</span>
                                    <span id="project-type-2-description-0" class="mt-1 flex items-center text-sm text-gray-500">Fails critical requirements.</span>
                                </span>
                            </span>
                            <svg class="h-5 w-5 text-red-600 {{ old('recommendation') == 'TIDAK_SOKONG' ? 'block' : 'hidden' }} recommendation-icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
                            <span class="pointer-events-none absolute -inset-px rounded-lg border-2 border-transparent {{ old('recommendation') == 'TIDAK_SOKONG' ? 'border-red-600' : '' }} recommendation-border" aria-hidden="true"></span>
                        </label>

                    </div>
                    <x-input-error :messages="$errors->get('recommendation')" class="mt-2" />
                </div>
            </x-card>

            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('applications.show', $application) }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                
                <button type="submit" name="save_draft" value="1" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    Save Draft
                </button>
                
                <button type="submit" name="submit_review" value="1" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-light focus:bg-primary-light active:bg-primary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150" onclick="return confirm('Ensure your review is accurate. Submitting will pass this to the Assistant Director for Verification. Continue?')">
                    Submit Recommendation
                </button>
            </div>
        </form>

    </div>

    <!-- Quick JS for active states on the radio buttons -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rads = document.querySelectorAll('input[name="recommendation"]');
            
            function resetVisuals() {
                document.querySelectorAll('.recommendation-icon').forEach(el => el.classList.add('hidden'));
                document.querySelectorAll('.recommendation-border').forEach(el => {
                    el.classList.remove('border-primary', 'border-accent', 'border-red-600');
                    el.classList.add('border-transparent');
                });
            }

            rads.forEach(rad => {
                rad.addEventListener('change', function() {
                    resetVisuals();
                    const container = this.closest('label');
                    const icon = container.querySelector('.recommendation-icon');
                    const border = container.querySelector('.recommendation-border');
                    
                    icon.classList.remove('hidden');
                    border.classList.remove('border-transparent');
                    
                    if(this.value === 'SOKONG') border.classList.add('border-primary');
                    if(this.value === 'BERSYARAT') border.classList.add('border-accent');
                    if(this.value === 'TIDAK_SOKONG') border.classList.add('border-red-600');
                });
            });
        });
    </script>
</x-app-layout>
