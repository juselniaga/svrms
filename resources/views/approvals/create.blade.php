<x-app-layout>
    <x-slot name="header">
        Provide Final Approval Decision
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 space-y-6">
        
        <!-- Context Card combining Review & Verification -->
        <x-card title="Application Executive Summary">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">
                <div>
                    <span class="text-sm font-medium text-gray-500">Ref No:</span>
                    <span class="ml-2 text-sm text-gray-900 font-mono">{{ $application->reference_no }}</span>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-500">Tajuk:</span>
                    <span class="ml-2 text-sm text-gray-900">{{ $application->tajuk }}</span>
                </div>
                
                <!-- Assistant Director Verification -->
                @php $verification = $application->verifications->last(); @endphp
                @if($verification)
                    <div class="md:col-span-2 mt-2 pt-4 border-t">
                        <span class="text-sm font-medium text-gray-500 block mb-2">Asst. Director Verification ({{ $verification->assistantDirector->name ?? 'System' }}):</span>
                        <div class="flex items-center space-x-2">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                {{ $verification->status }}
                            </span>
                            <span class="text-sm text-gray-600 block italic">"{{ $verification->remarks ?? 'No additional remarks provided.' }}"</span>
                        </div>
                    </div>
                @endif

                <!-- Officer Recommendation -->
                @php $latestReview = $application->reviews->firstWhere('is_submitted', true); @endphp
                @if($latestReview)
                    <div class="md:col-span-2">
                        <span class="text-sm font-medium text-gray-500 block mb-2">Officer Recommendation ({{ $latestReview->officer->name ?? 'System' }}):</span>
                        <div class="flex items-center space-x-2">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                            {{ $latestReview->recommendation === 'SOKONG' ? 'bg-green-100 text-green-800' : 
                               ($latestReview->recommendation === 'BERSYARAT' ? 'bg-orange-100 text-orange-800' : 'bg-red-100 text-red-800') }}">
                                {{ str_replace('_', ' ', $latestReview->recommendation) }}
                            </span>
                            <a href="{{ route('reviews.show', $latestReview) }}" target="_blank" class="text-primary text-sm hover:underline ml-2">Read Full Officer Review &rarr;</a>
                        </div>
                    </div>
                @endif
                
            </div>
        </x-card>

        <!-- Final Decision Form -->
        <form method="POST" action="{{ route('approvals.store') }}">
            @csrf
            <input type="hidden" name="application_id" value="{{ $application->application_id }}">

            <x-card title="Director's Final Decision" class="mb-6 border-t-4 border-accent">
                
                <div class="w-full mb-6">
                    <x-input-label value="Official Decision" class="mb-3" />
                    <div class="flex space-x-6">
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="decision" value="APPROVED" class="text-primary focus:ring-primary h-5 w-5 border-gray-300" {{ old('decision') == 'APPROVED' ? 'checked' : '' }} required>
                            <span class="ml-3 text-sm font-medium text-gray-900">Approve Application (Lulus)</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="decision" value="REJECTED" class="text-red-600 focus:ring-red-500 h-5 w-5 border-gray-300" {{ old('decision') == 'REJECTED' ? 'checked' : '' }} required>
                            <span class="ml-3 text-sm font-medium text-gray-900">Reject Application (Gagal/Tolak)</span>
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('decision')" class="mt-2" />
                </div>

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <x-input-label for="conditions" value="Conditions of Approval (Syarat-Syarat Kelulusan)" />
                        <p class="text-xs text-gray-500 mb-1">Only required if approving with specific constraints.</p>
                        <textarea id="conditions" name="conditions" class="block mt-1 w-full bg-surface border-gray-300 focus:border-primary-light focus:ring-primary-light rounded-md shadow-sm" rows="4" placeholder="If approved, list any conditions...">{{ old('conditions') }}</textarea>
                    </div>
                    
                    <div>
                        <x-input-label for="remarks" value="General Remarks / Catatan" />
                        <textarea id="remarks" name="remarks" class="block mt-1 w-full bg-surface border-gray-300 focus:border-primary-light focus:ring-primary-light rounded-md shadow-sm" rows="3" placeholder="Provide any additional notes...">{{ old('remarks') }}</textarea>
                    </div>
                </div>
                
            </x-card>

            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('approvals.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                <x-primary-button onclick="return confirm('Please confirm your final decision. This cannot be undone easily. Continue?')">
                    Record Final Decision
                </x-primary-button>
            </div>
        </form>

    </div>
</x-app-layout>
