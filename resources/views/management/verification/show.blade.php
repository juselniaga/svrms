<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight block">
                {{ __('Semakan Permohonan') }}
            </h2>
            <span
                class="px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-semibold rounded-full border border-yellow-200">
                Verifikasi Pen.Pengarah
            </span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Back Link -->
            <div>
                <a href="{{ route('verification.dashboard') }}"
                    class="text-sm text-indigo-600 hover:text-indigo-900 font-medium">
                    &larr; Back to Dashboard
                </a>
            </div>

            <!-- Full Report Component -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-bold border-b pb-2 mb-6 text-indigo-600 border-gray-200">Maklumat Laporan
                        Penuh</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <!-- Application Info -->
                        <div>
                            <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Butiran
                                Permohonan</h4>
                            <dl class="space-y-2 text-sm">
                                <div class="flex justify-between border-b border-gray-100 pb-1">
                                    <dt class="text-gray-600">No Rujukan:</dt>
                                    <dd class="font-medium text-gray-900">{{ $application->reference_no }}</dd>
                                </div>
                                <div class="flex flex-col border-b border-gray-100 pb-1 pt-1">
                                    <dt class="text-gray-600">Tajuk Projek:</dt>
                                    <dd class="font-medium text-gray-900 mt-1">{{ $application->tajuk }}</dd>
                                </div>
                                <div class="flex flex-col border-b border-gray-100 pb-1 pt-1">
                                    <dt class="text-gray-600">Lokasi Projek:</dt>
                                    <dd class="font-medium text-gray-900 mt-1">{{ $application->lokasi }}</dd>
                                </div>
                                <div class="flex justify-between border-b border-gray-100 pb-1 pt-1">
                                    <dt class="text-gray-600">Status Semasa:</dt>
                                    <dd class="font-bold text-blue-700">
                                        {{ str_replace('_', ' ', $application->status) }}
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Developer Info -->
                        <div>
                            <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Butiran
                                Pemaju</h4>
                            <dl class="space-y-2 text-sm">
                                <div class="flex justify-between border-b border-gray-100 pb-1">
                                    <dt class="text-gray-600">Nama Syarikat:</dt>
                                    <dd class="font-medium text-gray-900">
                                        {{ optional($application->developer)->name ?? 'N/A' }}
                                    </dd>
                                </div>
                                <div class="flex justify-between border-b border-gray-100 pb-1 pt-1">
                                    <dt class="text-gray-600">Email:</dt>
                                    <dd class="font-medium text-gray-900">{{ optional($application->developer)->email }}
                                    </dd>
                                </div>
                                <div class="flex justify-between border-b border-gray-100 pb-1 pt-1">
                                    <dt class="text-gray-600">Telefon:</dt>
                                    <dd class="font-medium text-gray-900">{{ optional($application->developer)->tel }}
                                    </dd>
                                </div>
                                <div class="flex flex-col border-b border-gray-100 pb-1 pt-1">
                                    <dt class="text-gray-600">Alamat Berdaftar:</dt>
                                    <dd class="font-medium text-gray-900 mt-1">
                                        {{ optional($application->developer)->address1 }}<br>
                                        {{ optional($application->developer)->poskod }}
                                        {{ optional($application->developer)->city }},<br>
                                        {{ optional($application->developer)->state }}
                                    </dd>
                                </div>
                        </div>
                    </div>

                    <!-- Site & Location Information -->
                    @if($application->site)
                        <div class="mt-8">
                            <h4 class="text-sm font-semibold text-indigo-600 uppercase tracking-wider mb-4 border-b pb-2">
                                Maklumat Tapak / Pendaftaran Tanah</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-sm">
                                <div>
                                    <span class="block text-xs font-semibold text-gray-400 uppercase">Data Lokasi</span>
                                    <div class="mt-1 space-y-1">
                                        <p><span class="text-gray-600 font-medium">Mukim:</span>
                                            {{ $application->site->mukim }}</p>
                                        <p><span class="text-gray-600 font-medium">Lot:</span> {{ $application->site->lot }}
                                        </p>
                                        <p><span class="text-gray-600 font-medium">BPK:</span>
                                            {{ $application->site->bpk ?: 'N/A' }}</p>
                                        <p><span class="text-gray-600 font-medium">Map Sheet:</span>
                                            {{ $application->site->lembaran ?: 'N/A' }}</p>
                                    </div>
                                </div>
                                <div>
                                    <span class="block text-xs font-semibold text-gray-400 uppercase">Spesifikasi
                                        Tanah</span>
                                    <div class="mt-1 space-y-1">
                                        <p><span class="text-gray-600 font-medium">Luas:</span>
                                            {{ number_format($application->site->luas, 4) }}</p>
                                        <p><span class="text-gray-600 font-medium">Kategori:</span>
                                            {{ $application->site->kategori_tanah ?: 'N/A' }}</p>
                                        <p><span class="text-gray-600 font-medium">Status:</span>
                                            {{ $application->site->status_tanah ?: 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="bg-gray-50 p-3 rounded border border-gray-200">
                                    <span class="block text-xs font-semibold text-gray-500 uppercase mb-2">Koordinat GPS</span>

                                    @php
                                        // google_lat stores combined "lat,lng" e.g. "2.386041,102.532776"
                                        $coords     = $application->site->google_lat ?? null;
                                        $coordParts = $coords ? array_map('trim', explode(',', $coords)) : [];
                                        $lat        = $coordParts[0] ?? null;
                                        $lng        = $coordParts[1] ?? null;
                                        $hasCoords  = $lat && $lng;
                                    @endphp

                                    @if($hasCoords)
                                        <div class="space-y-1 mb-3">
                                            <p class="font-mono text-gray-800 text-xs">
                                                <span class="text-gray-500 font-sans">Lat:</span> {{ $lat }}
                                            </p>
                                            <p class="font-mono text-gray-800 text-xs">
                                                <span class="text-gray-500 font-sans">Lng:</span> {{ $lng }}
                                            </p>
                                        </div>

                                        <div class="flex flex-col gap-1.5">
                                            {{-- Google Maps — direct pin on coordinates --}}
                                            <a href="https://maps.google.com/?q={{ $lat }},{{ $lng }}"
                                               target="_blank"
                                               class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-800 text-xs font-medium underline">
                                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                Lihat di Google Maps
                                            </a>

                                            {{-- Native Maps app (mobile geo: URI) --}}
                                            <a href="geo:{{ $lat }},{{ $lng }}?q={{ urlencode($lat . ',' . $lng) }}"
                                               class="inline-flex items-center gap-1.5 text-green-600 hover:text-green-800 text-xs font-medium underline">
                                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                Buka Aplikasi Peta
                                            </a>
                                        </div>
                                    @else
                                        <p class="text-gray-400 italic text-sm">Koordinat tidak direkod.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Site Visit Investigation Findings -->
                    @if($application->siteVisits && $application->siteVisits->count() > 0)
                        <div class="mt-8">
                            <h4 class="text-sm font-semibold text-indigo-600 uppercase tracking-wider mb-4 border-b pb-2">
                                Penemuan Siasatan Tapak</h4>

                            @foreach($application->siteVisits as $visit)
                                <div class="mb-6 bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                                    <div class="bg-gray-50 px-4 py-3 border-b flex justify-between items-center">
                                        <div>
                                            <span class="font-semibold text-gray-800 text-sm">Visit Date:
                                                {{ $visit->visit_date->format('d/m/Y') }}</span>
                                            <span class="text-gray-500 text-xs ml-2">by
                                                {{ optional($visit->officer)->name ?? 'Officer' }}</span>
                                        </div>
                                        <span
                                            class="text-purple-600 font-mono text-xs">{{ $visit->location_data ?? 'No GPS Data' }}</span>
                                    </div>
                                    <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Directions & Photos -->
                                        @foreach(['north' => ['finding_north', 'photos_north'], 'south' => ['findings_south', 'photos_south'], 'east' => ['findings_east', 'photo_east'], 'west' => ['finding_west', 'photo_west'], 'jalan' => ['finding_jalan', 'photos_jalan'], 'location' => ['finding_location', 'photos_location']] as $dir => $fields)
                                            <div class="bg-gray-50 rounded p-3 border border-gray-100">
                                                <h5 class="text-xs font-bold uppercase text-gray-600 mb-2 border-b pb-1">
                                                    {{ $dir === 'jalan' ? 'Jalan (Road)' : ($dir === 'location' ? 'Lokasi (Location)' : ucfirst($dir) . ' Direction') }}
                                                </h5>
                                                <p class="text-sm text-gray-800 mb-3 whitespace-pre-line">
                                                    {{ $visit->{$fields[0]} ?: 'No observations recorded.' }}
                                                </p>

                                                @if(is_array($visit->{$fields[1]}) && count($visit->{$fields[1]}) > 0)
                                                    <div class="grid grid-cols-2 gap-2">
                                                        @foreach($visit->{$fields[1]} as $photoPath)
                                                            <a href="{{ Storage::url($photoPath) }}" target="_blank" class="block">
                                                                <img src="{{ Storage::url($photoPath) }}" alt="{{ ucfirst($dir) }} Photo"
                                                                    class="h-24 w-full object-cover rounded shadow-sm hover:opacity-75 transition">
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Officer Review Section -->
                    @if($application->review)
                        <div class="mt-8 bg-gray-50 border border-gray-200 rounded-lg p-5">
                            <h4
                                class="text-sm font-semibold text-indigo-600 uppercase tracking-wider mb-4 border-b border-gray-200 pb-2">
                                Officer's Review & Recommendation</h4>

                            <div class="mb-4">
                                <span class="text-gray-600 text-sm font-semibold">Reviewing Officer:</span>
                                <span
                                    class="text-gray-900 text-sm">{{ $application->review->officer->name ?? 'Unknown Officer' }}</span>
                                <span
                                    class="text-gray-400 text-xs ml-2">({{ $application->review->submitted_at->format('d/m/Y H:i A') }})</span>
                            </div>

                            <div class="mb-5 bg-white p-4 rounded border border-gray-200 shadow-sm">
                                <h5 class="text-xs font-semibold text-gray-500 uppercase mb-2">Review Notes / Observations
                                </h5>
                                <p class="text-gray-800 whitespace-pre-line text-sm">
                                    {{ $application->review->review_content }}
                                </p>
                            </div>

                            <div class="flex items-center space-x-3 bg-white p-4 rounded border border-gray-200 shadow-sm">
                                <span class="text-gray-600 text-sm font-semibold">Official Recommendation:</span>
                                @if($application->review->recommendation === 'SUPPORTED')
                                    <span
                                        class="px-3 py-1 inline-flex text-sm leading-5 font-bold rounded-full bg-green-100 text-green-800 border border-green-200">
                                        SUPPORTED
                                    </span>
                                @else
                                    <span
                                        class="px-3 py-1 inline-flex text-sm leading-5 font-bold rounded-full bg-red-100 text-red-800 border border-red-200">
                                        NOT SUPPORTED
                                    </span>
                                @endif
                            </div>
                        </div>
                    @else
                        <div
                            class="mt-8 p-4 bg-yellow-50 text-yellow-800 border border-yellow-200 rounded text-sm text-center">
                            This application has not been reviewed by an Officer yet.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Existing Verifications List -->
                    @if($application->verifications && $application->verifications->count() > 0)
                        <div class="mt-8">
                            <h4 class="text-sm font-semibold text-indigo-600 uppercase tracking-wider mb-4 border-b pb-2">
                                Verification Records</h4>

                            <div class="space-y-4">
                                @foreach($application->verifications as $verification)
                                    <div class="bg-white border border-gray-200 rounded-lg p-5">
                                        <div class="flex justify-between items-start mb-4">
                                            <div>
                                                <div class="flex items-center space-x-3 mb-2">
                                                    <span class="text-sm font-semibold text-gray-800">
                                                        {{ $verification->assistantDirector->name ?? 'Unknown' }}
                                                    </span>
                                                    @if($verification->verification_status === 'VERIFIED')
                                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded">
                                                            VERIFIED
                                                        </span>
                                                    @elseif($verification->verification_status === 'RETURNED')
                                                        <span class="px-2 py-1 bg-orange-100 text-orange-800 text-xs font-semibold rounded">
                                                            RETURNED
                                                        </span>
                                                    @elseif($verification->verification_status === 'REJECTED')
                                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded">
                                                            REJECTED
                                                        </span>
                                                    @endif
                                                </div>
                                                <p class="text-xs text-gray-500">
                                                    {{ $verification->verified_at->format('d M Y, H:i A') }}
                                                </p>
                                            </div>
                                            <div class="flex space-x-2">
                                                <button type="button" onclick="editVerification({{ $verification->verify_id }})"
                                                    class="px-3 py-1 text-xs font-medium text-blue-600 hover:bg-blue-50 rounded border border-blue-300">
                                                    Edit
                                                </button>
                                                <form method="POST" action="{{ route('verification.destroy', $verification->verify_id) }}" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Delete this verification?')"
                                                        class="px-3 py-1 text-xs font-medium text-red-600 hover:bg-red-50 rounded border border-red-300">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Remarks List -->
                                        <div class="mt-4 space-y-2">
                                            <div class="flex items-center justify-between mb-2">
                                                <p class="font-semibold text-gray-600 text-sm">Remarks:</p>
                                                <button type="button" onclick="openAddRemarkModal({{ $verification->verify_id }})"
                                                    class="px-2 py-1 text-xs font-medium text-blue-600 hover:bg-blue-50 rounded border border-blue-300">
                                                    + Add Remark
                                                </button>
                                            </div>
                                            @php
                                                $remarks = $verification->remark_history ?? [];
                                            @endphp

                                            @if(count($remarks) > 0)
                                                <div class="space-y-2">
                                                    @foreach($remarks as $index => $remark)
                                                        @php
                                                            $isObject = is_object($remark) || (is_array($remark) && isset($remark['text']));
                                                            $remarkText = $isObject ? ($remark['text'] ?? $remark->text ?? '') : $remark;
                                                            $remarkUser = $isObject ? ($remark['user_name'] ?? $remark->user_name ?? 'System') : 'System';
                                                            $remarkDate = $isObject ? ($remark['created_at'] ?? $remark->created_at ?? '') : '';
                                                            $canEdit = auth()->id() == ($remark['user_id'] ?? $remark->user_id ?? null) || auth()->user()->role == 'Admin';
                                                        @endphp
                                                        <div class="bg-gray-50 p-3 rounded text-sm text-gray-700">
                                                            <div class="flex justify-between items-start mb-2">
                                                                <div>
                                                                    <p class="font-medium text-gray-800 text-xs">{{ $remarkUser }}</p>
                                                                    @if($remarkDate)
                                                                        <p class="text-xs text-gray-500">{{ $remarkDate }}</p>
                                                                    @endif
                                                                </div>
                                                                <div class="flex space-x-1">
                                                                    @if($canEdit)
                                                                        <button type="button" onclick="editRemark({{ $verification->verify_id }}, {{ $index }})"
                                                                            class="px-2 py-1 text-xs text-blue-600 hover:bg-blue-50 rounded border border-blue-200">
                                                                            Edit
                                                                        </button>
                                                                        <button type="button" onclick="deleteRemark({{ $verification->verify_id }}, {{ $index }})"
                                                                            class="px-2 py-1 text-xs text-red-600 hover:bg-red-50 rounded border border-red-200">
                                                                            Delete
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <p class="whitespace-pre-line">{{ $remarkText }}</p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <p class="text-xs text-gray-500 italic">No remarks added yet.</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Submit to Approval Button -->
                            @php
                                $latestVerification = $application->verifications()->latest()->first();
                                $canSubmitToApproval = $latestVerification && $latestVerification->verification_status === 'VERIFIED' && !in_array($application->status, ['APPROVED', 'FILED', 'RECORDED']);
                            @endphp

                            @if($canSubmitToApproval)
                                <div class="mt-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                                    <p class="text-sm text-gray-700 mb-4">
                                        All verifications are complete. The application is ready to be submitted to the Director for final approval.
                                    </p>
                                    <form method="POST" action="{{ route('verification.submit-to-approval', $application->application_id) }}">
                                        @csrf
                                        <button type="submit" onclick="return confirm('Submit this application to the Director for approval?')"
                                            class="px-6 py-2 bg-green-600 text-white rounded-md text-sm font-medium hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            Submit to Director for Approval
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Remark Modal -->
                    <div id="remarkModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 hidden flex items-center justify-center z-50" onclick="closeRemarkModal(event)">
                        <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 p-6" onclick="event.stopPropagation()">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4" id="remarkModalTitle">Add Remark</h3>

                            <form id="remarkForm" method="POST">
                                @csrf
                                <input type="hidden" name="verification_id" id="remarkVerificationId">
                                <input type="hidden" name="remark_index" id="remarkIndex" value="">
                                <input type="hidden" name="_method" id="remarkMethod" value="POST">

                                <div class="mb-4">
                                    <label for="remarkText" class="block text-sm font-medium text-gray-700 mb-2">
                                        Remark Text
                                    </label>
                                    <textarea id="remarkText" name="remark_text" rows="4"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500"
                                        placeholder="Enter your remark here..."></textarea>
                                </div>

                                <div class="flex space-x-3 pt-4 border-t border-gray-200">
                                    <button type="button" onclick="closeRemarkModal()"
                                        class="flex-1 px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        class="flex-1 px-4 py-2 bg-purple-600 text-white rounded-md text-sm font-medium hover:bg-purple-700">
                                        <span id="submitButtonText">Save Remark</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

            <!-- Add/Update Verification Panel -->
            @if($application->status === 'PENDING_VERIFICATION')
                <div class="bg-white overflow-hidden shadow-lg border border-purple-200 sm:rounded-lg mt-8"
                    x-data="{ action: '', editingId: null, formRemarks: [], editingRemarkIndex: null }"
                    data-verify-edit-url="{{ route('verification.edit', 'ID') }}"
                    data-verify-update-url="{{ route('verification.update', 'ID') }}"
                    data-remark-add-url="{{ route('verification.add-remark', 'ID') }}"
                    data-remark-get-url="{{ route('verification.get-remark', ['ID', 'INDEX']) }}"
                    data-remark-update-url="{{ route('verification.update-remark', 'ID') }}"
                    data-remark-delete-url="{{ route('verification.delete-remark', 'ID') }}">
                    <div class="p-6">
                        <h3 class="text-lg font-bold border-b pb-2 mb-4 text-purple-900 border-purple-100">
                            <span x-show="!editingId">Add New Verification</span>
                            <span x-show="editingId">Edit Verification</span>
                        </h3>

                        <form method="POST" id="verificationForm" action="{{ route('verification.store', $application->application_id) }}">
                            @csrf
                            <input type="hidden" name="_method" value="POST" id="methodField">

                            <div class="mb-6">
                                <p class="text-xs font-bold text-gray-700 mb-3">Sila pilih keputusan semakan anda:
                                </p>
                                <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                                    <label
                                        class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none transition-all"
                                        :class="action === 'VERIFIED' ? 'border-green-500 ring-2 ring-green-500 bg-green-50' : 'border-gray-300 hover:bg-gray-50'">
                                        <input type="radio" name="action" value="VERIFIED" class="sr-only" x-model="action"
                                            required>
                                        <span class="flex flex-1">
                                            <span class="flex flex-col">
                                                <span class="block text-sm font-medium text-gray-900">Verify &
                                                    Proceed</span>
                                                <span class="mt-1 flex items-center text-xs text-gray-500">Send to Director
                                                    for Approval</span>
                                            </span>
                                        </span>
                                    </label>

                                    <label
                                        class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none transition-all"
                                        :class="action === 'RETURNED' ? 'border-orange-500 ring-2 ring-orange-500 bg-orange-50' : 'border-gray-300 hover:bg-gray-50'">
                                        <input type="radio" name="action" value="RETURNED" class="sr-only" x-model="action"
                                            required>
                                        <span class="flex flex-1">
                                            <span class="flex flex-col">
                                                <span class="block text-sm font-medium text-gray-900">Return for
                                                    Amendment</span>
                                                <span class="mt-1 flex items-center text-xs text-gray-500">Send back to
                                                    Officer</span>
                                            </span>
                                        </span>
                                    </label>

                                    <label
                                        class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none transition-all"
                                        :class="action === 'REJECTED' ? 'border-red-500 ring-2 ring-red-500 bg-red-50' : 'border-gray-300 hover:bg-gray-50'">
                                        <input type="radio" name="action" value="REJECTED" class="sr-only" x-model="action"
                                            required>
                                        <span class="flex flex-1">
                                            <span class="flex flex-col">
                                                <span class="block text-sm font-medium text-gray-900">Outright Reject</span>
                                                <span class="mt-1 flex items-center text-xs text-gray-500">Terminate
                                                    Application</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('action')" class="mt-2" />
                            </div>

                            <!-- Dynamic Remarks Field with List -->
                            <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200 transition-all duration-300"
                                x-show="action !== ''" x-transition>
                                <label class="block text-sm font-medium text-gray-700 mb-3">
                                    Remarks / Notes <span x-show="action === 'RETURNED' || action === 'REJECTED'"
                                        class="text-red-500">* (Required)</span>
                                </label>

                                <!-- Remarks List -->
                                <div id="remarksList" class="mb-4 space-y-2">
                                    <!-- Remarks will be added here dynamically -->
                                </div>

                                <!-- Add Remark Input -->
                                <div class="flex gap-2">
                                    <textarea id="remarkInput" rows="2"
                                        class="flex-1 block border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm sm:text-sm"
                                        placeholder="Type your remark here..."></textarea>
                                    <button type="button" onclick="addRemarkToForm()"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 whitespace-nowrap">
                                        + Add Remark
                                    </button>
                                </div>

                                <input type="hidden" name="remarks_json" id="remarksJson" value="[]">
                                <x-input-error :messages="$errors->get('remarks')" class="mt-2" />
                                <p class="mt-2 text-xs text-gray-500">Add all remarks you want to include. They will be recorded in the official audit trail.</p>
                            </div>

                            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                                <button type="button" x-show="editingId" @click="resetForm()"
                                    class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-50">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 disabled:bg-gray-400 disabled:cursor-not-allowed"
                                    x-bind:disabled="!action">
                                    <span x-show="!editingId">Add Verification</span>
                                    <span x-show="editingId">Update Verification</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <script>
                    function resetForm() {
                        const formContainer = document.querySelector('[x-data]');
                        const form = document.getElementById('verificationForm');
                        const storeUrl = '{{ route('verification.store', $application->application_id) }}';

                        formContainer.__x.$data.action = '';
                        formContainer.__x.$data.editingId = null;
                        document.getElementById('remarks').value = '';
                        document.getElementById('methodField').value = 'POST';
                        form.action = storeUrl;
                    }

                    function editVerification(verifyId) {
                        const formContainer = document.querySelector('[x-data]');
                        const editUrl = formContainer.getAttribute('data-verify-edit-url').replace('ID', verifyId);

                        // Fetch verification details and populate form
                        fetch(editUrl)
                            .then(response => response.json())
                            .then(data => {
                                const form = document.getElementById('verificationForm');
                                const updateUrl = formContainer.getAttribute('data-verify-update-url').replace('ID', verifyId);

                                // Update Alpine data
                                formContainer.__x.$data.action = data.verification_status;
                                formContainer.__x.$data.editingId = verifyId;

                                // Update form
                                document.getElementById('remarks').value = data.remarks || '';
                                document.getElementById('methodField').value = 'PUT';
                                form.action = updateUrl;

                                // Scroll to form
                                window.scrollTo({ top: formContainer.offsetTop - 100, behavior: 'smooth' });
                            })
                            .catch(error => {
                                console.error('Error loading verification:', error);
                                alert('Failed to load verification details');
                            });
                    }

                    // Remark Modal Functions
                    function getDataAttribute(attr) {
                        return document.querySelector('[x-data]').getAttribute(attr);
                    }

                    function openAddRemarkModal(verifyId) {
                        const modal = document.getElementById('remarkModal');
                        const form = document.getElementById('remarkForm');
                        const baseUrl = getDataAttribute('data-remark-add-url');
                        const addUrl = baseUrl.replace('ID', verifyId);

                        document.getElementById('remarkModalTitle').textContent = 'Add Remark';
                        document.getElementById('remarkVerificationId').value = verifyId;
                        document.getElementById('remarkIndex').value = '';
                        document.getElementById('remarkText').value = '';
                        document.getElementById('remarkMethod').value = 'POST';
                        document.getElementById('submitButtonText').textContent = 'Save Remark';
                        form.action = addUrl;
                        modal.classList.remove('hidden');
                    }

                    function editRemark(verifyId, index) {
                        const modal = document.getElementById('remarkModal');
                        const form = document.getElementById('remarkForm');
                        const baseGetUrl = getDataAttribute('data-remark-get-url');
                        const getUrl = baseGetUrl.replace('ID', verifyId).replace('INDEX', index);

                        // Fetch remark details
                        fetch(getUrl)
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    const baseUpdateUrl = getDataAttribute('data-remark-update-url');
                                    const updateUrl = baseUpdateUrl.replace('ID', verifyId);

                                    document.getElementById('remarkModalTitle').textContent = 'Edit Remark';
                                    document.getElementById('remarkVerificationId').value = verifyId;
                                    document.getElementById('remarkIndex').value = index;
                                    document.getElementById('remarkText').value = data.remark.text || data.remark;
                                    document.getElementById('remarkMethod').value = 'PUT';
                                    document.getElementById('submitButtonText').textContent = 'Update Remark';
                                    form.action = updateUrl;
                                    modal.classList.remove('hidden');
                                } else {
                                    alert('Error loading remark');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Failed to load remark');
                            });
                    }

                    function deleteRemark(verifyId, index) {
                        if (confirm('Are you sure you want to delete this remark?')) {
                            const baseUrl = getDataAttribute('data-remark-delete-url');
                            const deleteUrl = baseUrl.replace('ID', verifyId);

                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = deleteUrl;

                            const csrfToken = document.createElement('input');
                            csrfToken.type = 'hidden';
                            csrfToken.name = '_token';
                            csrfToken.value = '{{ csrf_token() }}';

                            const methodField = document.createElement('input');
                            methodField.type = 'hidden';
                            methodField.name = '_method';
                            methodField.value = 'DELETE';

                            const indexField = document.createElement('input');
                            indexField.type = 'hidden';
                            indexField.name = 'remark_index';
                            indexField.value = index;

                            form.appendChild(csrfToken);
                            form.appendChild(methodField);
                            form.appendChild(indexField);
                            document.body.appendChild(form);
                            form.submit();
                        }
                    }

                    function closeRemarkModal(event) {
                        if (event && event.target.id !== 'remarkModal') return;
                        document.getElementById('remarkModal').classList.add('hidden');
                    }

                    // Handle Remark Form Submission
                    document.getElementById('remarkForm').addEventListener('submit', function(e) {
                        e.preventDefault();
                        const verifyId = document.getElementById('remarkVerificationId').value;
                        const remarkText = document.getElementById('remarkText').value.trim();

                        if (!remarkText) {
                            alert('Please enter a remark');
                            return;
                        }

                        const form = new FormData();
                        form.append('_token', '{{ csrf_token() }}');
                        form.append('remark_text', remarkText);

                        fetch(this.action, {
                            method: 'POST',
                            body: form
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                closeRemarkModal();
                                location.reload();
                            } else {
                                alert('Error: ' + (data.message || 'Failed to save remark'));
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Failed to save remark');
                        });
                    });

                    // Form Remarks Functions - Using direct DOM manipulation
                    let editingRemarkIndex = null;

                    function getRemarksArray() {
                        const remarksJson = document.getElementById('remarksJson');
                        try {
                            return JSON.parse(remarksJson.value) || [];
                        } catch (e) {
                            return [];
                        }
                    }

                    function saveRemarksArray(remarks) {
                        document.getElementById('remarksJson').value = JSON.stringify(remarks);
                    }

                    function renderFormRemarks() {
                        const container = document.getElementById('remarksList');
                        const remarks = getRemarksArray();

                        container.innerHTML = '';

                        if (remarks.length === 0) {
                            container.innerHTML = '<p class="text-xs text-gray-500 italic">No remarks added yet.</p>';
                            return;
                        }

                        remarks.forEach((remark, index) => {
                            const div = document.createElement('div');
                            div.className = 'bg-white p-3 rounded border border-gray-300 flex justify-between items-start';
                            div.innerHTML = `
                                <div class="flex-1">
                                    <p class="text-sm text-gray-800 whitespace-pre-wrap">${escapeHtml(remark)}</p>
                                </div>
                                <div class="ml-2 flex space-x-1">
                                    <button type="button" onclick="editFormRemark(${index})"
                                        class="px-2 py-1 text-xs text-blue-600 hover:bg-blue-50 rounded border border-blue-200">
                                        Edit
                                    </button>
                                    <button type="button" onclick="deleteFormRemark(${index})"
                                        class="px-2 py-1 text-xs text-red-600 hover:bg-red-50 rounded border border-red-200">
                                        Delete
                                    </button>
                                </div>
                            `;
                            container.appendChild(div);
                        });
                    }

                    function addRemarkToForm() {
                        const input = document.getElementById('remarkInput');
                        const remarkText = input.value.trim();

                        if (!remarkText) {
                            alert('Please enter a remark');
                            return;
                        }

                        const remarks = getRemarksArray();

                        if (editingRemarkIndex !== null) {
                            // Update existing remark
                            remarks[editingRemarkIndex] = remarkText;
                            editingRemarkIndex = null;
                        } else {
                            // Add new remark
                            remarks.push(remarkText);
                        }

                        saveRemarksArray(remarks);
                        input.value = '';
                        renderFormRemarks();

                        // Reset button text
                        const btn = document.querySelector('button[onclick="addRemarkToForm()"]');
                        btn.textContent = '+ Add Remark';
                    }

                    function editFormRemark(index) {
                        const remarks = getRemarksArray();
                        const input = document.getElementById('remarkInput');

                        input.value = remarks[index];
                        editingRemarkIndex = index;

                        // Scroll to input
                        input.focus();
                        input.scrollIntoView({ behavior: 'smooth' });

                        // Change button text
                        const btn = document.querySelector('button[onclick="addRemarkToForm()"]');
                        btn.textContent = '✓ Update Remark';
                    }

                    function deleteFormRemark(index) {
                        const remarks = getRemarksArray();
                        remarks.splice(index, 1);
                        saveRemarksArray(remarks);
                        editingRemarkIndex = null;
                        renderFormRemarks();

                        // Reset button text if was editing
                        const btn = document.querySelector('button[onclick="addRemarkToForm()"]');
                        btn.textContent = '+ Add Remark';
                    }

                    function escapeHtml(text) {
                        const div = document.createElement('div');
                        div.textContent = text;
                        return div.innerHTML;
                    }
                </script>
            @endif

        </div>
    </div>
</x-app-layout>