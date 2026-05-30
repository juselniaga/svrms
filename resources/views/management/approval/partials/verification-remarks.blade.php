@php
    // Define helper function
    if (!function_exists('parseVerificationRemarks')) {
        function parseVerificationRemarks($verification) {
            $remarkHistoryData = $verification->getAttribute('remark_history');
            $oldRemarks = $verification->remarks;

            // Parse new format remarks
            $newRemarks = [];
            if ($remarkHistoryData) {
                // Convert JSON string to array if needed
                if (is_string($remarkHistoryData)) {
                    $data = json_decode($remarkHistoryData, true) ?? [];
                } else {
                    // If already an array, use it directly
                    $data = $remarkHistoryData;
                }

                foreach ($data as $remark) {
                    $newRemarks[] = [
                        'text' => $remark['text'] ?? '',
                        'userName' => $remark['user_name'] ?? 'System',
                        'createdAt' => $remark['created_at'] ?? '',
                    ];
                }
            }

            // Use new format if available, otherwise legacy
            if (count($newRemarks) > 0) {
                return ['isNew' => true, 'items' => $newRemarks];
            } elseif ($oldRemarks) {
                return ['isNew' => false, 'items' => [['text' => $oldRemarks]]];
            }

            return ['isNew' => false, 'items' => []];
        }
    }

    // Get remarks
    $remarks = parseVerificationRemarks($verification);
    $isNewFormat = $remarks['isNew'];
    $items = $remarks['items'];
@endphp

<div class="mb-5 bg-white p-4 rounded border border-yellow-200 shadow-sm">
    <h5 class="text-xs font-semibold text-gray-500 uppercase mb-3">Verification Remarks (Select to add to Director's remarks)</h5>

    @if(count($items) > 0)
        <div class="space-y-3" id="verificationRemarksContainer">
            @foreach($items as $index => $item)
                <label class="flex items-start bg-gray-50 p-3 rounded border {{ $isNewFormat ? 'border-gray-300' : 'border-blue-300' }} cursor-pointer hover:bg-gray-100 transition">
                    <input type="checkbox" class="verification-remark-checkbox mt-1 rounded border-gray-300 text-blue-600"
                        data-index="{{ $index }}" data-text="{{ json_encode($item['text']) }}"
                        value="{{ json_encode($item['text']) }}">
                    <div class="ml-3 flex-1">
                        @if($isNewFormat)
                            <!-- New Format: Individual Remarks -->
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <p class="font-semibold text-gray-800 text-xs">{{ $item['userName'] }}</p>
                                    <p class="text-xs text-gray-500">{{ $item['createdAt'] }}</p>
                                </div>
                                <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded font-medium">
                                    Remark {{ $index + 1 }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-800 whitespace-pre-wrap leading-relaxed">{{ $item['text'] }}</p>
                        @else
                            <!-- Legacy Format: Combined Remarks -->
                            <p class="text-xs text-blue-600 font-semibold mb-2">📋 Remarks from verification:</p>
                            <p class="text-sm text-gray-800 whitespace-pre-wrap leading-relaxed">{{ $item['text'] }}</p>
                        @endif
                    </div>
                </label>
            @endforeach
        </div>

        <!-- Add Selected Remarks Button -->
        <div class="mt-4 flex gap-2">
            <button type="button" onclick="VerificationRemarks.addSelectedToDirector()"
                class="px-4 py-2 bg-green-600 text-white rounded-md text-sm font-medium hover:bg-green-700 transition">
                ✓ Add Selected to Director's Remarks
            </button>
            <button type="button" onclick="VerificationRemarks.clearSelection()"
                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-400 transition">
                Clear Selection
            </button>
        </div>
    @else
        <p class="text-xs text-gray-500 italic">No remarks found in verification record.</p>
    @endif
</div>

<script>
    const VerificationRemarks = {
        addSelectedToDirector() {
            console.log('Button clicked - addSelectedToDirector called');
            const checkboxes = document.querySelectorAll('.verification-remark-checkbox:checked');
            console.log('Checked boxes:', checkboxes.length);

            if (checkboxes.length === 0) {
                alert('Please select at least one remark');
                return;
            }

            // Check if ApprovalRemarks exists
            if (typeof ApprovalRemarks === 'undefined') {
                alert('Error: ApprovalRemarks not loaded. Please refresh the page.');
                return;
            }

            // Parse JSON-encoded text from data attribute
            const remarkTexts = Array.from(checkboxes).map(cb => {
                try {
                    return JSON.parse(cb.dataset.text);
                } catch (e) {
                    return cb.dataset.text;
                }
            });

            console.log('Remarks to add:', remarkTexts);

            // Get current remarks from ApprovalRemarks
            const currentRemarks = ApprovalRemarks.get();

            // Add each selected remark directly to remarks list
            remarkTexts.forEach(text => {
                console.log('Adding remark:', text);
                // Only add if not already in the list
                if (!currentRemarks.includes(text)) {
                    currentRemarks.push(text);
                }
            });

            // Save all remarks at once
            const saved = ApprovalRemarks.save(currentRemarks);
            if (!saved) {
                alert('Error: Could not save remarks. The Director Action form may not be visible. Please scroll down to the "Final Director Action" section.');
                return;
            }
            ApprovalRemarks.render();

            // Clear selection after adding
            this.clearSelection();

            // Scroll to Director's remarks section
            setTimeout(() => {
                const remarksSection = document.getElementById('remarksList');
                if (remarksSection) {
                    remarksSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }, 100);

            alert('✓ ' + remarkTexts.length + ' remark(s) added to Director\'s remarks');
        },

        clearSelection() {
            document.querySelectorAll('.verification-remark-checkbox').forEach(cb => {
                cb.checked = false;
            });
        }
    };
</script>
