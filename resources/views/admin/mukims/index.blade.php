<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Mukim Management') }}
            </h2>
            <a href="{{ route('admin.mukims.create') }}"
                class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                + Register New Mukim
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Admin Navigation Tabs -->
            <div class="flex gap-4 border-b border-gray-200 overflow-x-auto">
                <a href="{{ route('admin.users.index') }}"
                    class="{{ request()->routeIs('admin.users.*') ? 'border-b-2 border-purple-600 text-purple-600 pb-2' : 'text-gray-600 hover:text-gray-900 pb-2' }} font-semibold text-sm whitespace-nowrap">
                    Staff Management
                </a>
                <a href="{{ route('admin.mukims.index') }}"
                    class="{{ request()->routeIs('admin.mukims.*') ? 'border-b-2 border-purple-600 text-purple-600 pb-2' : 'text-gray-600 hover:text-gray-900 pb-2' }} font-semibold text-sm whitespace-nowrap">
                    Mukim Management
                </a>
                <a href="{{ route('admin.bps.index') }}"
                    class="{{ request()->routeIs('admin.bps.*') ? 'border-b-2 border-purple-600 text-purple-600 pb-2' : 'text-gray-600 hover:text-gray-900 pb-2' }} font-semibold text-sm whitespace-nowrap">
                    Block Perancang
                </a>
                <a href="{{ route('admin.bpks.index') }}"
                    class="{{ request()->routeIs('admin.bpks.*') ? 'border-b-2 border-purple-600 text-purple-600 pb-2' : 'text-gray-600 hover:text-gray-900 pb-2' }} font-semibold text-sm whitespace-nowrap">
                    Block Perancang Kecil
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Search Area -->
            <div class="bg-white p-6 shadow-sm rounded-lg border-t-4 border-purple-500">
                <form method="GET" action="{{ route('admin.mukims.index') }}" class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search Mukim</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            class="w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm"
                            placeholder="Search by mukim number, name, or code...">
                    </div>
                    <div class="w-full sm:w-1/4">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Filter by Status</label>
                        <select name="status" id="status"
                            class="w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                            <option value="">All Status</option>
                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <x-primary-button type="submit" class="w-full sm:w-auto mt-1">
                            Filter
                        </x-primary-button>
                        @if(request()->hasAny(['search', 'status']))
                            <a href="{{ route('admin.mukims.index') }}"
                                class="ml-2 text-sm text-gray-600 hover:underline">Clear</a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Mukims Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mukim No</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Short Code</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mukim Name</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($mukims as $mukim)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $mukim->mukim_no }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ $mukim->short_mukim }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $mukim->mukim }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($mukim->status)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                        @else
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('admin.mukims.edit', $mukim) }}"
                                            class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>

                                        <form action="{{ route('admin.mukims.destroy', $mukim) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Are you sure you want to delete this mukim? This cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        No mukims found matching the criteria.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $mukims->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
