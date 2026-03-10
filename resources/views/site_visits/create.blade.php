<x-app-layout>
    <x-slot name="header">
        Record Site Visit Report
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8 space-y-6">

        <x-card title="Application Reference">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <span class="text-sm font-medium text-gray-500">Ref No:</span>
                    <span class="ml-2 text-sm text-gray-900 font-mono">{{ $application->reference_no }}</span>
                </div>
                <div>
                    <span class="text-sm font-medium text-gray-500">Tajuk:</span>
                    <span class="ml-2 text-sm text-gray-900">{{ $application->tajuk }}</span>
                </div>
            </div>
        </x-card>

        <form method="POST" action="{{ route('site-visits.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="application_id" value="{{ $application->application_id }}">

            <x-card title="Visit Details" class="mb-6">
                <div class="w-full sm:w-1/3">
                    <x-input-label for="visit_date" value="Date of Visit" />
                    <x-text-input id="visit_date" class="block mt-1 w-full" type="date" name="visit_date"
                        :value="old('visit_date', \Carbon\Carbon::now()->format('Y-m-d'))" required />
                    <x-input-error :messages="$errors->get('visit_date')" class="mt-2" />
                </div>
            </x-card>

            <x-card title="Site Findings & Photos" class="mb-6">
                <div class="space-y-8">
                    <!-- North -->
                    <div class="border-b pb-6">
                        <h4 class="text-md font-semibold text-primary mb-3">North Boundary (Utara)</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="finding_north" value="Findings / Observations" />
                                <textarea id="finding_north" name="finding_north"
                                    class="block mt-1 w-full bg-surface border-gray-300 focus:border-primary-light focus:ring-primary-light rounded-md shadow-sm"
                                    rows="3">{{ old('finding_north') }}</textarea>
                            </div>
                            <div>
                                <x-input-label for="photos_north" value="Upload Photos (Multiple)" />
                                <input type="file" id="photos_north" name="photos_north[]" multiple accept="image/*"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary-muted file:text-primary hover:file:bg-primary-light hover:file:text-white mt-1 border border-gray-300 rounded-md shadow-sm bg-white" />
                                <p class="text-xs text-gray-500 mt-1">JPEG, PNG up to 2MB each.</p>
                            </div>
                        </div>
                    </div>

                    <!-- South -->
                    <div class="border-b pb-6">
                        <h4 class="text-md font-semibold text-primary mb-3">South Boundary (Selatan)</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="finding_south" value="Findings / Observations" />
                                <textarea id="finding_south" name="finding_south"
                                    class="block mt-1 w-full bg-surface border-gray-300 focus:border-primary-light focus:ring-primary-light rounded-md shadow-sm"
                                    rows="3">{{ old('finding_south') }}</textarea>
                            </div>
                            <div>
                                <x-input-label for="photos_south" value="Upload Photos (Multiple)" />
                                <input type="file" id="photos_south" name="photos_south[]" multiple accept="image/*"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary-muted file:text-primary hover:file:bg-primary-light hover:file:text-white mt-1 border border-gray-300 rounded-md shadow-sm bg-white" />
                            </div>
                        </div>
                    </div>

                    <!-- East -->
                    <div class="border-b pb-6">
                        <h4 class="text-md font-semibold text-primary mb-3">East Boundary (Timur)</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="finding_east" value="Findings / Observations" />
                                <textarea id="finding_east" name="finding_east"
                                    class="block mt-1 w-full bg-surface border-gray-300 focus:border-primary-light focus:ring-primary-light rounded-md shadow-sm"
                                    rows="3">{{ old('finding_east') }}</textarea>
                            </div>
                            <div>
                                <x-input-label for="photos_east" value="Upload Photos (Multiple)" />
                                <input type="file" id="photos_east" name="photos_east[]" multiple accept="image/*"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary-muted file:text-primary hover:file:bg-primary-light hover:file:text-white mt-1 border border-gray-300 rounded-md shadow-sm bg-white" />
                            </div>
                        </div>
                    </div>

                    <!-- West -->
                    <div>
                        <h4 class="text-md font-semibold text-primary mb-3">West Boundary (Barat)</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="finding_west" value="Findings / Observations" />
                                <textarea id="finding_west" name="finding_west"
                                    class="block mt-1 w-full bg-surface border-gray-300 focus:border-primary-light focus:ring-primary-light rounded-md shadow-sm"
                                    rows="3">{{ old('finding_west') }}</textarea>
                            </div>
                            <div>
                                <x-input-label for="photos_west" value="Upload Photos (Multiple)" />
                                <input type="file" id="photos_west" name="photos_west[]" multiple accept="image/*"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary-muted file:text-primary hover:file:bg-primary-light hover:file:text-white mt-1 border border-gray-300 rounded-md shadow-sm bg-white" />
                            </div>
                        </div>
                    </div>
                </div>
            </x-card>

            <x-card title="Site Conditions & Parameters" class="mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <x-input-label for="activity" value="Earthworks / Activity" />
                        <x-text-input id="activity" class="block mt-1 w-full" type="text" name="activity"
                            :value="old('activity')" />
                    </div>
                    <div>
                        <x-input-label for="land_use_zone" value="Land Use Zone" />
                        <x-text-input id="land_use_zone" class="block mt-1 w-full" type="text" name="land_use_zone"
                            :value="old('land_use_zone')" />
                    </div>
                    <div>
                        <x-input-label for="density" value="Density / Plot Ratio" />
                        <x-text-input id="density" class="block mt-1 w-full" type="text" name="density"
                            :value="old('density')" />
                    </div>
                    <div>
                        <x-input-label for="entrance_way" value="Entrance Access" />
                        <x-text-input id="entrance_way" class="block mt-1 w-full" type="text" name="entrance_way"
                            :value="old('entrance_way')" />
                    </div>
                    <div>
                        <x-input-label for="parit" value="Drainage / Parit" />
                        <x-text-input id="parit" class="block mt-1 w-full" type="text" name="parit"
                            :value="old('parit')" />
                    </div>
                    <div>
                        <x-input-label for="tree" value="Est. Trees Impacted" />
                        <x-text-input id="tree" class="block mt-1 w-full" type="text" name="tree"
                            :value="old('tree')" />
                    </div>
                </div>

                <div class="mt-6 border-t pt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="attachments" value="Additional Attachments (PDF, Images)" />
                        <input type="file" id="attachments" name="attachments[]" multiple
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 mt-1 border border-gray-300 rounded-md shadow-sm bg-white" />
                    </div>
                    <div>
                        <x-input-label for="location_data" value="General Remarks / Summary" />
                        <textarea id="location_data" name="location_data"
                            class="block mt-1 w-full bg-surface border-gray-300 focus:border-primary-light focus:ring-primary-light rounded-md shadow-sm"
                            rows="3">{{ old('location_data') }}</textarea>
                    </div>
                </div>
            </x-card>

            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('applications.show', $application) }}"
                    class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                <x-primary-button>
                    Submit Site Visit Report
                </x-primary-button>
            </div>
        </form>

    </div>
</x-app-layout>