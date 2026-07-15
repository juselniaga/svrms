<x-app-layout>
    <x-slot name="header">
        Filing & Dossier: {{ $application->reference_no }}
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 space-y-6">
        
        <!-- Header Actions -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-display font-bold text-gray-900">Dossier: {{ $application->tajuk }}</h2>
                <div class="mt-2 flex items-center space-x-3">
                    <span class="text-sm font-medium text-gray-900">
                        Status: <x-status-badge :status="$application->status" />
                    </span>
                    <span class="text-sm text-gray-500">&bull;</span>
                    @php $directorDecision = $application->approvals->last(); @endphp
                    <span class="text-sm text-gray-700 font-semibold">Director Decision: {{ $directorDecision ? $directorDecision->decision : 'N/A' }}</span>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('filings.pdf.preview', $application) }}" target="_blank">
                    <x-secondary-button>
                        Preview PDF Dossier (HTML)
                    </x-secondary-button>
                </a>
                <a href="{{ route('filings.pdf.download', $application) }}">
                    <x-primary-button>
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Download Official PDF
                    </x-primary-button>
                </a>
            </div>
        </div>

        @if($application->status !== 'FILED')
            <x-card class="border-l-4 border-purple-500 bg-purple-50 mb-6">
                <div class="flex justify-between items-center px-4 py-2">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Finalize & File Application</h3>
                        <p class="text-sm text-gray-600 mt-1">Downloading the official Dossier will automatically mark this application as closed (FILED) in the system and lock it permanently.</p>
                    </div>
                    <button type="button" onclick="openPrintModal()" class="inline-flex items-center px-6 py-3 bg-purple-700 border border-transparent rounded-md font-bold text-xs text-white uppercase tracking-widest hover:bg-purple-800 focus:bg-purple-800 active:bg-purple-900 focus:outline-none shadow-md transition ease-in-out duration-150">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                        Print & File Application
                    </button>
                </div>

                <!-- Print & File Modal -->
                <div id="printModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 hidden flex items-center justify-center z-50" onclick="closePrintModal(event)">
                    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 p-6" onclick="event.stopPropagation()">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Print & File Documents</h3>

                        <form id="documentSelectionForm" method="POST" action="{{ route('filings.mark', $application) }}">
                            @csrf

                            <!-- Document Selection -->
                            <div class="space-y-4 mb-6">
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="include_laporan" id="include_laporan" value="1" checked class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500">
                                    <span class="ml-3 text-sm text-gray-700 font-medium">Laporan (Current Report)</span>
                                </label>

                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="include_surat_balas" id="include_surat_balas" value="1" @change="toggleSuratBalasFields()" class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500">
                                    <span class="ml-3 text-sm text-gray-700 font-medium">Surat Balas (Response Letter)</span>
                                </label>
                            </div>

                            <!-- Surat Balas Fields (Hidden by default) -->
                            <div id="suratBalasFields" class="space-y-4 mb-6 hidden p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <div>
                                    <label for="ruj_kami" class="block text-sm font-medium text-gray-700 mb-1">
                                        Ruj. Kami (Our Reference)
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="ruj_kami" id="ruj_kami" placeholder="e.g., SVRMS/2026/05/001" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                                </div>

                                <div>
                                    <label for="addressed_to" class="block text-sm font-medium text-gray-700 mb-1">
                                        Addressed To
                                        <span class="text-red-500">*</span>
                                    </label>
                                    <select name="addressed_to" id="addressed_to" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500">
                                        <option value="">-- Select --</option>
                                        <option value="YDP">YDP (Ketua Pengarah)</option>
                                        <option value="SU">SU (Setiausaha Utama)</option>
                                        <option value="PENGARAH">Pengarah</option>
                                    </select>
                                </div>
                            </div>

                            <div class="flex space-x-3 pt-4 border-t border-gray-200">
                                <button type="button" onclick="closePrintModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                                    Cancel
                                </button>
                                <button type="submit" class="flex-1 px-4 py-2 bg-purple-600 text-white rounded-md text-sm font-medium hover:bg-purple-700 focus:outline-none">
                                    Generate PDF
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <script>
                    function openPrintModal() {
                        document.getElementById('printModal').classList.remove('hidden');
                    }

                    function closePrintModal(event) {
                        if (event && event.target !== document.getElementById('printModal')) return;
                        document.getElementById('printModal').classList.add('hidden');
                    }

                    function toggleSuratBalasFields() {
                        const checkbox = document.getElementById('include_surat_balas');
                        const fields = document.getElementById('suratBalasFields');
                        if (checkbox.checked) {
                            fields.classList.remove('hidden');
                        } else {
                            fields.classList.add('hidden');
                        }
                    }

                    document.getElementById('documentSelectionForm').addEventListener('submit', function(e) {
                        e.preventDefault();

                        const includeLaporan = document.getElementById('include_laporan').checked;
                        const includeSuratBalas = document.getElementById('include_surat_balas').checked;

                        if (!includeLaporan && !includeSuratBalas) {
                            alert('Please select at least one document to print.');
                            return;
                        }

                        if (includeSuratBalas) {
                            const rujKami = document.getElementById('ruj_kami').value.trim();
                            const addressedTo = document.getElementById('addressed_to').value;

                            if (!rujKami || !addressedTo) {
                                alert('Please fill in all required fields for Surat Balas.');
                                return;
                            }
                        }

                        if (confirm('WARNING: Downloading the final report will mark this application as FILED. This action is permanent. Continue?')) {
                            // Submit form to server to handle PDF generation
                            this.submit();
                        }
                    });
                </script>
            </x-card>
        @else
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p class="font-bold">Application Filed</p>
                <p>This application is locked and officially filed. The dossier is archived.</p>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Summary Info -->
            <div class="space-y-6">
                <x-card title="Application Overview">
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Developer</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $application->developer->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Lokasi</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $application->lokasi }}</dd>
                        </div>
                    </dl>
                </x-card>
                
                <x-card title="Lifecycle Milestones">
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li><strong>Created:</strong> {{ $application->created_at->format('M d, Y H:i') }}</li>
                        @php $siteVisit = $application->siteVisits->last(); @endphp
                        @if($siteVisit)
                            <li><strong>Site Visited:</strong> {{ $siteVisit->visit_date->format('M d, Y') }} ({{ $siteVisit->officer->name }})</li>
                        @endif
                        @php $review = $application->reviews->firstWhere('is_submitted', true); @endphp
                        @if($review)
                            <li><strong>Reviewed:</strong> {{ $review->updated_at->format('M d, Y') }} (Rec: {{ $review->recommendation }})</li>
                        @endif
                        @php $verification = $application->verifications->last(); @endphp
                        @if($verification)
                            <li><strong>Verified:</strong> {{ $verification->created_at->format('M d, Y') }} ({{ $verification->status }})</li>
                        @endif
                        @php $approval = $application->approvals->last(); @endphp
                        @if($approval)
                            <li><strong>Final Decision:</strong> {{ $approval->created_at->format('M d, Y') }} ({{ $approval->decision }})</li>
                        @endif
                    </ul>
                </x-card>
            </div>

            <!-- Full Audit Log History -->
            <x-card title="Complete Audit History" class="md:h-96 overflow-y-auto">
                <div class="flow-root">
                    <ul role="list" class="-mb-8">
                        @foreach($application->auditLogs as $log)
                            <li>
                                <div class="relative pb-8">
                                    @if(!$loop->last)
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    @endif
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white bg-primary text-white">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            </span>
                                        </div>
                                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                            <div>
                                                <p class="text-sm text-gray-500">{{ $log->action }} <span class="font-medium text-gray-900">({{ $log->status_to }})</span></p>
                                                <p class="text-xs text-gray-500 mt-1 italic">{{ $log->remarks }}</p>
                                                <p class="text-xs text-gray-400 mt-1">By: {{ $log->user->name ?? 'System' }}</p>
                                            </div>
                                            <div class="whitespace-nowrap text-right text-xs text-gray-500">
                                                {{ $log->created_at->format('M d, Y H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </x-card>
        </div>

    </div>
</x-app-layout>
