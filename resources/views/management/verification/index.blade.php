<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight block">
            {{ __('Verification Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Statistics Cards -->
            <div class="grid grid-cols-5 gap-4 mb-8">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4 border-l-4 border-purple-500">
                    <div class="text-xs font-medium text-gray-500 uppercase">Total Applications</div>
                    <div class="mt-1 text-2xl font-semibold text-gray-900">{{ $stats['total'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4 border-l-4 border-yellow-500">
                    <div class="text-xs font-medium text-gray-500 uppercase">In Progress</div>
                    <div class="mt-1 text-2xl font-semibold text-gray-900">{{ $stats['in_progress'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4 border-l-4 border-green-500">
                    <div class="text-xs font-medium text-gray-500 uppercase">Approved</div>
                    <div class="mt-1 text-2xl font-semibold text-gray-900">{{ $stats['approved'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4 border-l-4 border-red-500">
                    <div class="text-xs font-medium text-gray-500 uppercase">Rejected</div>
                    <div class="mt-1 text-2xl font-semibold text-gray-900">{{ $stats['rejected'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4 border-l-4 border-orange-500">
                    <div class="text-xs font-medium text-gray-500 uppercase">Late (>14 days)</div>
                    <div class="mt-1 text-2xl font-semibold text-gray-900">{{ $stats['late'] }}</div>
                </div>
            </div>

            <!-- Task Todo Section -->
            <div class="mb-4">
                <h3 class="text-lg font-medium text-gray-900">Task Todo (Pending Verification)</h3>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8 border border-yellow-200">
                <div class="p-0 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-yellow-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ref No</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Title</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Officer Recommendation</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date Submitted</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($tasksTodo as $app)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $app->reference_no }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 line-clamp-2">
                                            {{ $app->tajuk }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($app->review && $app->review->recommendation === 'SUPPORTED')
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Supported</span>
                                            @elseif($app->review && $app->review->recommendation === 'NOT_SUPPORTED')
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Not
                                                    Supported</span>
                                            @else
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Pending</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $app->review ? $app->review->submitted_at->format('d/m/Y H:i') : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('verification.show', $app->application_id) }}"
                                                class="text-white bg-blue-600 hover:bg-blue-700 font-semibold px-4 py-2 rounded shadow-sm inline-block transition">
                                                Review & Verify
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="px-6 py-8 whitespace-nowrap text-sm text-gray-500 text-center italic">
                                            No applications currently pending verification. Good job!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- All Applications Section -->
            <div class="mb-4 flex flex-col sm:flex-row justify-between items-center gap-4">
                <h3 class="text-lg font-medium text-gray-900">All Applications</h3>
                <form action="{{ route('verification.dashboard') }}" method="GET" class="flex w-full sm:w-auto">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search Ref, Title, Developer..."
                        class="rounded-l-md border-gray-300 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 w-full sm:w-64 text-sm" />
                    <button type="submit"
                        class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-r-md text-sm font-semibold transition">Search</button>
                    @if(request('search'))
                        <a href="{{ route('verification.dashboard') }}"
                            class="ml-2 text-gray-500 hover:text-gray-700 underline text-sm flex items-center">Clear</a>
                    @endif
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($applications as $app)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $app->reference_no ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 line-clamp-2">{{ $app->tajuk }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ optional($app->developer)->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ str_replace('_', ' ', $app->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('verification.show', $app->application_id) }}"
                                                class="text-indigo-600 hover:text-indigo-900 hover:underline">
                                                View Details
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No
                                            applications found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($applications->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $applications->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>