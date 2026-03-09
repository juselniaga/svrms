<x-app-layout>
    <x-slot name="header">
        Verify Application & Officer Review
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 space-y-6">
        
        <!-- Context Card -->
        <x-card title="Application Context">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-4">
                <div>
                    <span class="text-sm font-medium text-gray-500">Ref No:</span>
                    <span class="ml-2 text-sm text-gray-900 font-mono">{{ $application->reference_no }}</span>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-500">Tajuk:</span>
                    <span class="ml-2 text-sm text-gray-900">{{ $application->tajuk }}</span>
                </div>
                <div class="md:col-span-2">
                    <span class="text-sm font-medium text-gray-500">Review Recommendation:</span>
                    @php $latestReview = $application->reviews->firstWhere('is_submitted', true); @endphp
                    @if($latestReview)
                        <span class="ml-2 px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $latestReview->recommendation === 'SOKONG' ? 'bg-green-100 text-green-800' : 
                               ($latestReview->recommendation === 'BERSYARAT' ? 'bg-orange-100 text-orange-800' : 'bg-red-100 text-red-800') }}">
                            {{ str_replace('_', ' ', $latestReview->recommendation) }}
                        </span>
                        <div class="mt-2 text-sm text-gray-700 border-l-4 border-gray-200 pl-4 py-2 italic">
                            "{{ Str::limit($latestReview->review_content, 200) }}" 
                            <a href="{{ route('reviews.show', $latestReview) }}" target="_blank" class="text-primary hover:underline ml-1">Read Full Review &rarr;</a>
                        </div>
                    @else
                        <span class="ml-2 text-sm text-red-500">Warning: No submitted review found.</span>
                    @endif
                </div>
            </div>
        </x-card>

        <!-- Verification Form -->
        <form method="POST" action="{{ route('verifications.store') }}">
            @csrf
            <input type="hidden" name="application_id" value="{{ $application->application_id }}">

            <x-card title="Assistant Director Verification" class="mb-6 border-t-4 border-primary">
                
                <div class="w-full mb-6">
                    <x-input-label value="Verification Decision" class="mb-3" />
                    <div class="flex space-x-6">
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="status" value="VERIFIED" class="text-primary focus:ring-primary h-5 w-5 border-gray-300" {{ old('status') == 'VERIFIED' ? 'checked' : '' }} required>
                            <span class="ml-3 text-sm font-medium text-gray-900">Verify & Proceed to Approval (Pengesahan Sah)</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="status" value="REJECTED" class="text-red-600 focus:ring-red-500 h-5 w-5 border-gray-300" {{ old('status') == 'REJECTED' ? 'checked' : '' }} required>
                            <span class="ml-3 text-sm font-medium text-gray-900">Reject / Return to Officer (Tolak)</span>
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="remarks" value="Verification Remarks / Ulasan Pengesahan" />
                    <textarea id="remarks" name="remarks" class="block mt-1 w-full bg-surface border-gray-300 focus:border-primary-light focus:ring-primary-light rounded-md shadow-sm" rows="5" placeholder="Provide any necessary conditions or reasons for rejection...">{{ old('remarks') }}</textarea>
                    <x-input-error :messages="$errors->get('remarks')" class="mt-2" />
                </div>
                
            </x-card>

            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('verifications.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                <x-primary-button onclick="return confirm('Please confirm your verification decision. This action will log your decision and push the application to the Director or reject it. Continue?')">
                    Submit Verification
                </x-primary-button>
            </div>
        </form>

    </div>
</x-app-layout>
