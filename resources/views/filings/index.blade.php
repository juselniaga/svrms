<x-app-layout>
    <x-slot name="header">
        Application Filing & Dossier Generation
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-display font-semibold text-gray-800">Applications Ready for Filing & Archiving</h2>
        </div>

        <x-card>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reference No.</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tajuk</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Current Status</th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-sm">
                        @forelse ($applications as $app)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap font-mono text-gray-900">
                                    {{ $app->reference_no ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-gray-700 max-w-md" title="{{ $app->tajuk }}">
                                    {{ Str::limit($app->tajuk, 80) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <x-status-badge :status="$app->status" />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right font-medium">
                                    <a href="{{ route('filings.show', $app) }}" class="text-primary hover:text-primary-light font-semibold">
                                        {{ $app->status === 'FILED' ? 'View Archive' : 'Prepare Filing' }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                    No applications currently require filing.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $applications->links() }}
            </div>
        </x-card>
    </div>
</x-app-layout>
