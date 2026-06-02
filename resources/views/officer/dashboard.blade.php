<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between flex-wrap gap-4 items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight block">
                {{ __('Dashboard Pegawai Siasatan') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Statistics Section Header -->
            <div class="mb-6 sm:mb-8">
                <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">📊 Statistik Permohonan</h3>
                <p class="text-sm sm:text-base text-gray-600">Ringkasan keseluruhan permohonan yang sedang diproses</p>
            </div>

            <!-- Statistics Cards (Responsive Grid) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 sm:gap-6 mb-8 sm:mb-12">
                <!-- Total Applications -->
                <button onclick="filterByStatus('all')" class="text-left bg-white overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-4 sm:p-6 border-l-4 border-indigo-500 cursor-pointer hover:bg-indigo-50">
                    <div class="text-xs sm:text-sm font-semibold text-indigo-600 uppercase tracking-wide mb-2">
                        Jumlah Permohonan</div>
                    <div class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $stats['total'] }}</div>
                    <div class="mt-3 h-1 bg-gradient-to-r from-indigo-500 to-indigo-300 rounded-full"></div>
                </button>

                <!-- Total Pending -->
                <button onclick="filterByStatus('PENDING_APPROVAL')" class="text-left bg-white overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-4 sm:p-6 border-l-4 border-blue-500 cursor-pointer hover:bg-blue-50">
                    <div class="text-xs sm:text-sm font-semibold text-blue-600 uppercase tracking-wide mb-2">
                        Jumlah Pending</div>
                    <div class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $stats['pending'] }}</div>
                    <div class="mt-3 h-1 bg-gradient-to-r from-blue-500 to-blue-300 rounded-full"></div>
                </button>

                <!-- Total Approved -->
                <button onclick="filterByStatus('APPROVED')" class="text-left bg-white overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-4 sm:p-6 border-l-4 border-emerald-500 cursor-pointer hover:bg-emerald-50">
                    <div class="text-xs sm:text-sm font-semibold text-emerald-600 uppercase tracking-wide mb-2">
                        Jumlah Diluluskan</div>
                    <div class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $stats['approved'] }}</div>
                    <div class="mt-3 h-1 bg-gradient-to-r from-emerald-500 to-emerald-300 rounded-full"></div>
                </button>

                <!-- Total Rejected -->
                <button onclick="filterByStatus('REJECTED')" class="text-left bg-white overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-4 sm:p-6 border-l-4 border-red-500 cursor-pointer hover:bg-red-50">
                    <div class="text-xs sm:text-sm font-semibold text-red-600 uppercase tracking-wide mb-2">
                        Jumlah Ditolak</div>
                    <div class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $stats['rejected'] }}</div>
                    <div class="mt-3 h-1 bg-gradient-to-r from-red-500 to-red-300 rounded-full"></div>
                </button>

                <!-- Late > 14 Days -->
                <button onclick="filterByStatus('late')" class="text-left bg-white overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-4 sm:p-6 border-l-4 border-amber-500 cursor-pointer hover:bg-amber-50">
                    <div class="text-xs sm:text-sm font-semibold text-amber-600 uppercase tracking-wide mb-2">
                        Lewat (>14 hari)</div>
                    <div class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $stats['late'] }}</div>
                    <div class="mt-3 h-1 bg-gradient-to-r from-amber-500 to-amber-300 rounded-full"></div>
                </button>
            </div>

            <!-- Actions Required Section Header -->
            <div class="mb-4 sm:mb-6">
                <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">⚡ Tindakan Diperlukan</h3>
                <p class="text-sm sm:text-base text-gray-600">Permohonan yang memerlukan tindakan segera dari anda</p>
            </div>

            <!-- Actions Required Table -->
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg mb-8 sm:mb-12 border-t-4 border-amber-500">
                <div class="p-4 sm:p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-amber-50 to-orange-50">
                                <tr>
                                    <th class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                        No Rujukan</th>
                                    <th class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                        Tajuk</th>
                                    <th class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                        Status</th>
                                    <th class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                        Tarikh</th>
                                    <th class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                        Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($applications as $app)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                            {{ $app->reference_no ?? 'N/A' }}
                                        </td>
                                        <td class="px-4 sm:px-6 py-3 sm:py-4 text-sm text-gray-700 line-clamp-2">
                                            {{ $app->tajuk }}</td>
                                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap">
                                            @php
                                                $statusColors = [
                                                    'APPROVED' => 'bg-blue-600 text-white',
                                                    'PENDING_APPROVAL' => 'bg-orange-500 text-white',
                                                    'SITE_VISIT_IN_PROGRESS' => 'bg-red-600 text-white',
                                                    'FILED' => 'bg-green-600 text-white',
                                                    'RECORDED' => 'bg-gray-500 text-white',
                                                ];
                                                $colorClass = $statusColors[$app->status] ?? 'bg-gray-100 text-gray-800';
                                            @endphp
                                            <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full {{ $colorClass }}">
                                                {{ str_replace('_', ' ', $app->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $app->created_at->format('d/m/Y') }}
                                        </td>
                                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-sm font-medium">
                                            @if($app->status === 'RECORDED')
                                                @if(!$app->site)
                                                    <a href="{{ route('officer.site-registration.create', $app->application_id) }}"
                                                        class="text-white bg-blue-600 hover:bg-blue-700 px-3 sm:px-4 py-1.5 sm:py-2 rounded font-semibold text-xs sm:text-sm shadow-sm hover:shadow-md transition-all duration-200 inline-block">
                                                        Daftar Tapak</a>
                                                @else
                                                    <a href="{{ route('officer.site-visit.create', $app->application_id) }}"
                                                        class="text-white bg-purple-600 hover:bg-purple-700 px-3 sm:px-4 py-1.5 sm:py-2 rounded font-semibold text-xs sm:text-sm shadow-sm hover:shadow-md transition-all duration-200 inline-block">
                                                        Lawatan Tapak</a>
                                                @endif
                                            @elseif($app->status === 'SITE_VISIT_IN_PROGRESS')
                                                <a href="{{ route('officer.review.create', $app->application_id) }}"
                                                    class="text-white bg-emerald-600 hover:bg-emerald-700 px-3 sm:px-4 py-1.5 sm:py-2 rounded font-semibold text-xs sm:text-sm shadow-sm hover:shadow-md transition-all duration-200 inline-block">
                                                    Teruskan Semakan</a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 sm:px-6 py-8 whitespace-nowrap text-sm text-gray-500 text-center italic">
                                            ✓ Tiada tugas ditemui. Semua permohonan sudah diproses!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- All Applications Section Header with Search -->
            <div class="mb-4 sm:mb-6 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                <div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-1">📋 Semua Permohonan</h3>
                    <p class="text-sm sm:text-base text-gray-600">Senarai lengkap semua permohonan anda</p>
                </div>
            </div>

            <!-- Search Bar (Integrated with table section) -->
            <div class="bg-white rounded-lg shadow-md mb-4 p-4 sm:p-6 border-l-4 border-purple-500">
                <form id="searchForm" method="GET" action="{{ route('officer.dashboard') }}" class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-1">
                        <label for="search" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-2">
                            🔍 Carian Permohonan
                        </label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            class="w-full px-3 sm:px-4 py-2 sm:py-2.5 border border-gray-300 rounded-lg focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-200 text-sm"
                            placeholder="Carian mengikut No. Rujukan atau Tajuk...">
                    </div>
                    <input type="hidden" name="status_filter" id="status_filter" value="{{ request('status_filter') }}">
                    <div class="flex items-end gap-2">
                        <x-primary-button type="submit" class="w-full sm:w-auto px-4 sm:px-6 py-2 sm:py-2.5 text-sm font-semibold">
                            Carian
                        </x-primary-button>
                        @if(request()->has('search') || request()->has('status_filter'))
                            <a href="{{ route('officer.dashboard') }}"
                                class="px-3 sm:px-4 py-2 sm:py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors duration-200 text-sm font-medium">
                                Kosongkan</a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- All Applications Table -->
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg border-t-4 border-purple-500">
                <div class="p-4 sm:p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-purple-50 to-indigo-50">
                                <tr>
                                    <th class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                        No Rujukan</th>
                                    <th class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                        Tajuk</th>
                                    <th class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                        Pembangun</th>
                                    <th class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                        Status</th>
                                    <th class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">
                                        Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($allApplications as $app)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                            {{ $app->reference_no ?? 'N/A' }}
                                        </td>
                                        <td class="px-4 sm:px-6 py-3 sm:py-4 text-sm text-gray-700 line-clamp-2">
                                            {{ Str::limit($app->tajuk, 50) }}</td>
                                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $app->developer->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap">
                                            @php
                                                $statusColors = [
                                                    'APPROVED' => 'bg-blue-600 text-white',
                                                    'PENDING_APPROVAL' => 'bg-orange-500 text-white',
                                                    'SITE_VISIT_IN_PROGRESS' => 'bg-red-600 text-white',
                                                    'FILED' => 'bg-green-600 text-white',
                                                    'RECORDED' => 'bg-gray-500 text-white',
                                                ];
                                                $colorClass = $statusColors[$app->status] ?? 'bg-gray-100 text-gray-800';
                                            @endphp
                                            <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full {{ $colorClass }}">
                                                {{ str_replace('_', ' ', $app->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('applications.show', $app) }}"
                                                class="text-indigo-600 hover:text-indigo-900 hover:underline font-semibold transition-colors duration-200">
                                                Lihat Butiran</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 sm:px-6 py-8 whitespace-nowrap text-sm text-gray-500 text-center italic">
                                            Tiada permohonan ditemui.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 sm:mt-6 border-t border-gray-200 pt-4">
                        {{ $allApplications->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function filterByStatus(status) {
            const statusFilterInput = document.getElementById('status_filter');
            const searchInput = document.getElementById('search');

            // Set the status filter value
            statusFilterInput.value = status;

            // Clear search input when filtering by status
            searchInput.value = '';

            // Submit the form
            document.getElementById('searchForm').submit();
        }
    </script>
</x-app-layout>