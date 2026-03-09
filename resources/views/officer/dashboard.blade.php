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
        </div>
    </div>
</x-app-layout>