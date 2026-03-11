<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between flex-wrap gap-4 items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight block">
                {{ __('Officer Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Statistics Cards (One Row) -->
            <div class="grid grid-cols-5 gap-2 sm:gap-4 mb-6">
                <!-- Total Applications -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-3 sm:p-5 border-l-4 border-purple-500">
                    <div
                        class="text-xs sm:text-sm font-medium text-gray-500 line-clamp-2 leading-tight h-8 sm:h-auto sm:truncate">
                        Total Applications</div>
                    <div class="mt-1 text-xl sm:text-3xl font-semibold text-gray-900">{{ $stats['total'] }}</div>
                </div>
                <!-- Total Pending -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-3 sm:p-5 border-l-4 border-blue-500">
                    <div
                        class="text-xs sm:text-sm font-medium text-gray-500 line-clamp-2 leading-tight h-8 sm:h-auto sm:truncate">
                        Total Pending</div>
                    <div class="mt-1 text-xl sm:text-3xl font-semibold text-gray-900">{{ $stats['pending'] }}</div>
                </div>
                <!-- Total Approved -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-3 sm:p-5 border-l-4 border-green-500">
                    <div
                        class="text-xs sm:text-sm font-medium text-gray-500 line-clamp-2 leading-tight h-8 sm:h-auto sm:truncate">
                        Total Approved</div>
                    <div class="mt-1 text-xl sm:text-3xl font-semibold text-gray-900">{{ $stats['approved'] }}</div>
                </div>
                <!-- Total Rejected -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-3 sm:p-5 border-l-4 border-red-500">
                    <div
                        class="text-xs sm:text-sm font-medium text-gray-500 line-clamp-2 leading-tight h-8 sm:h-auto sm:truncate">
                        Total Rejected</div>
                    <div class="mt-1 text-xl sm:text-3xl font-semibold text-gray-900">{{ $stats['rejected'] }}</div>
                </div>
                <!-- Late > 14 Days -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-3 sm:p-5 border-l-4 border-yellow-500">
                    <div
                        class="text-xs sm:text-sm font-medium text-gray-500 line-clamp-2 leading-tight h-8 sm:h-auto sm:truncate">
                        Late (>14 days)</div>
                    <div class="mt-1 text-xl sm:text-3xl font-semibold text-gray-900">{{ $stats['late'] }}</div>
                </div>
            </div>

            <div class="mb-4">
                <h3 class="text-lg font-medium text-gray-900">Task Todo</h3>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
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
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($applications as $app)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $app->reference_no ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $app->tajuk }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($app->status === 'RECORDED')
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-200 text-blue-800">
                                                    {{ str_replace('_', ' ', $app->status) }}
                                                </span>
                                            @elseif($app->status === 'SITE_VISIT_IN_PROGRESS')
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ str_replace('_', ' ', $app->status) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $app->created_at->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if($app->status === 'RECORDED')
                                                @if(!$app->site)
                                                    <a href="{{ route('officer.site-registration.create', $app->application_id) }}"
                                                        class="button text-white bg-blue-600 hover:bg-blue-700 font-semibold px-4 py-2 rounded shadow-sm inline-block transition">
                                                        Register Site</a>
                                                @else
                                                    <a href="{{ route('officer.site-visit.create', $app->application_id) }}"
                                                        class="button text-white bg-purple-700 hover:bg-purple-600 font-semibold px-4 py-2 rounded shadow-sm inline-block transition">
                                                        Site Visit</a>
                                                @endif
                                            @elseif($app->status === 'SITE_VISIT_IN_PROGRESS')
                                                <a href="{{ route('officer.review.create', $app->application_id) }}"
                                                    class="button text-white bg-green-700 hover:bg-green-600 font-semibold px-4 py-2 rounded shadow-sm inline-block transition">Resume
                                                    Review</a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            No tasks found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="mt-12 bg-white p-6 shadow-sm rounded-lg border-t-4 border-purple-500">
                <form method="GET" action="{{ route('officer.dashboard') }}" class="flex flex-col sm:flex-row gap-4 mb-2">
                    <div class="flex-1">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search Applications</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" 
                               class="w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm" 
                               placeholder="Search by Ref No or Title...">
                    </div>
                    <div class="flex items-end">
                        <x-primary-button type="submit" class="w-full sm:w-auto mt-1">
                            Search
                        </x-primary-button>
                        @if(request()->has('search'))
                            <a href="{{ route('officer.dashboard') }}" class="ml-2 text-sm text-gray-600 hover:underline">Clear</a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- All My Applications Table -->
            <div class="mt-6 mb-4">
                <h3 class="text-lg font-medium text-gray-900">All My Assigned Applications</h3>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ref No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Developer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($allApplications as $app)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $app->reference_no ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($app->tajuk, 50) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $app->developer->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                {{ str_replace('_', ' ', $app->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('applications.show', $app) }}" class="text-gray-500 hover:text-gray-700">View Details</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            No applications found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $allApplications->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>