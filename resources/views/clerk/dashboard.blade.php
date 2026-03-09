<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between flex-wrap gap-4 items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight block">
                {{ __('Clerk Dashboard') }}
            </h2>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4">
                <a href="{{ route('clerk.applications.create') }}"
                    class="inline-flex justify-end items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                    + Register New Application
                </a>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-4 gap-2 sm:gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4 sm:p-6 border-l-4 border-purple-500">
                    <div
                        class="text-xs sm:text-sm font-medium text-gray-500 line-clamp-2 leading-tight h-8 sm:h-auto sm:truncate">
                        Total Applications</div>
                    <div class="mt-1 text-xl sm:text-3xl font-semibold text-gray-900">{{ $stats['total'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4 sm:p-6 border-l-4 border-blue-500">
                    <div
                        class="text-xs sm:text-sm font-medium text-gray-500 line-clamp-2 leading-tight h-8 sm:h-auto sm:truncate">
                        Recorded</div>
                    <div class="mt-1 text-xl sm:text-3xl font-semibold text-gray-900">{{ $stats['recorded'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4 sm:p-6 border-l-4 border-yellow-500">
                    <div
                        class="text-xs sm:text-sm font-medium text-gray-500 line-clamp-2 leading-tight h-8 sm:h-auto sm:truncate">
                        In Progress</div>
                    <div class="mt-1 text-xl sm:text-3xl font-semibold text-gray-900">{{ $stats['in_progress'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4 sm:p-6 border-l-4 border-red-500">
                    <div
                        class="text-xs sm:text-sm font-medium text-gray-500 line-clamp-2 leading-tight h-8 sm:h-auto sm:truncate">
                        Late (>14 days)</div>
                    <div class="mt-1 text-xl sm:text-3xl font-semibold text-gray-900">{{ $stats['late'] }}</div>
                </div>
            </div>

            <!-- TODO SECTION: Pending Filing/Closeout Actions -->
            <div class="mb-4">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                        </path>
                    </svg>
                    Action Required: Pending Filing
                </h3>
                <p class="text-sm text-gray-500 mb-2">Applications that have received a final Director decision and need
                    to be printed and filed.</p>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8 border border-purple-100">
                <div class="p-0 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-purple-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-purple-800 uppercase tracking-wider">
                                        Ref No</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-purple-800 uppercase tracking-wider">
                                        Title</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-purple-800 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-purple-800 uppercase tracking-wider">
                                        Decision Date</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-purple-800 uppercase tracking-wider">
                                        Decision Date</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-medium text-purple-800 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 border-b border-gray-200">
                                @forelse($tasksTodo as $task)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                            {{ $task->reference_no ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700 font-medium">{{ $task->tajuk }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $task->status === 'APPROVED' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $task->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $task->updated_at->format('d/m/Y h:i A') }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('filings.show', $task) }}"
                                                class="inline-flex items-center px-3 py-1 bg-purple-100 text-purple-700 hover:bg-purple-200 rounded text-xs font-semibold transition">
                                                Process Filing &rarr;
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="px-6 py-8 whitespace-nowrap text-sm text-gray-500 text-center bg-gray-50">
                                            <svg class="mx-auto h-8 w-8 text-gray-400 mb-2" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            No pending applications to file. Great job!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ALL APPLICATIONS SECTION -->
            <div
                class="mb-4 flex flex-col sm:flex-row justify-between items-center gap-4 mt-8 pt-6 border-t border-gray-200">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">All Registered Applications</h3>
                    <p class="text-sm text-gray-500">Complete historical record of applications.</p>
                </div>
                <form action="{{ route('clerk.dashboard') }}" method="GET" class="flex w-full sm:w-auto">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search Ref, Title, Developer..."
                        class="rounded-l-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 w-full sm:w-64 text-sm" />
                    <button type="submit"
                        class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-r-md text-sm font-semibold transition">Search</button>
                    @if(request('search'))
                        <a href="{{ route('clerk.dashboard') }}"
                            class="ml-2 text-gray-500 hover:text-gray-700 underline text-sm flex items-center">Clear</a>
                    @endif
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border border-gray-200">
                <div class="p-0 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ref No</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Title</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Developer</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Assigned Officer</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($applications as $app)
                                    <tr class="hover:bg-gray-50 transition cursor-pointer"
                                        onclick="window.location='{{ route('applications.show', $app->application_id) }}'">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-purple-700">
                                            {{ $app->reference_no ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700 font-medium">{{ $app->tajuk }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ optional($app->developer)->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ optional($app->officer)->name ?? 'Unassigned' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <x-status-badge :status="$app->status" />
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $app->created_at->format('d/m/Y') }}
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="px-6 py-8 whitespace-nowrap text-sm text-gray-500 text-center">
                                            No applications found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pagination Links -->
            <div class="mb-4">
                {{ $applications->withQueryString()->links() }}
            </div>
        </div>
    </div>
    </div>
</x-app-layout>