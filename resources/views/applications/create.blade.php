<x-app-layout>
    <x-slot name="header">
        Record New Application
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <x-card title="Application Details">
            <form method="POST" action="{{ route('applications.store') }}">
                @csrf

                <!-- Section: Developer Info -->
                <h4 class="text-md font-semibold text-primary mb-4 border-b pb-2">Developer Information</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <x-input-label for="dev_name" value="Developer Name" />
                        <x-text-input id="dev_name" class="block mt-1 w-full" type="text" name="developer[name]" :value="old('developer.name')" required autofocus />
                        <x-input-error :messages="$errors->get('developer.name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="dev_email" value="Email" />
                        <x-text-input id="dev_email" class="block mt-1 w-full" type="email" name="developer[email]" :value="old('developer.email')" required />
                        <x-input-error :messages="$errors->get('developer.email')" class="mt-2" />
                    </div>
                    <div class="md:col-span-2">
                        <x-input-label for="dev_addr1" value="Address Line 1" />
                        <x-text-input id="dev_addr1" class="block mt-1 w-full" type="text" name="developer[address1]" :value="old('developer.address1')" required />
                    </div>
                    <div class="md:col-span-2">
                        <x-input-label for="dev_addr2" value="Address Line 2 (Optional)" />
                        <x-text-input id="dev_addr2" class="block mt-1 w-full" type="text" name="developer[address2]" :value="old('developer.address2')" />
                    </div>
                    <div>
                        <x-input-label for="dev_city" value="City" />
                        <x-text-input id="dev_city" class="block mt-1 w-full" type="text" name="developer[city]" :value="old('developer.city')" required />
                    </div>
                    <div>
                        <x-input-label for="dev_state" value="State" />
                        <x-text-input id="dev_state" class="block mt-1 w-full" type="text" name="developer[state]" :value="old('developer.state')" required />
                    </div>
                    <div>
                        <x-input-label for="dev_poskod" value="Postcode" />
                        <x-text-input id="dev_poskod" class="block mt-1 w-full" type="text" name="developer[poskod]" :value="old('developer.poskod')" required />
                    </div>
                    <div>
                        <x-input-label for="dev_tel" value="Telephone" />
                        <x-text-input id="dev_tel" class="block mt-1 w-full" type="text" name="developer[tel]" :value="old('developer.tel')" required />
                    </div>
                </div>

                <!-- Section: Application Info -->
                <h4 class="text-md font-semibold text-primary mb-4 border-b pb-2 mt-8">Application Subject</h4>
                <div class="grid grid-cols-1 gap-6 mb-6">
                    <div>
                        <x-input-label for="app_tajuk" value="Tajuk (Title)" />
                        <x-text-input id="app_tajuk" class="block mt-1 w-full" type="text" name="application[tajuk]" :value="old('application.tajuk')" required />
                        <x-input-error :messages="$errors->get('application.tajuk')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="app_lokasi" value="Lokasi (Location)" />
                        <textarea id="app_lokasi" name="application[lokasi]" class="block mt-1 w-full bg-surface border-gray-300 focus:border-primary-light focus:ring-primary-light rounded-md shadow-sm" rows="3" required>{{ old('application.lokasi') }}</textarea>
                        <x-input-error :messages="$errors->get('application.lokasi')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="app_no_fail" value="No. Fail" />
                        <x-text-input id="app_no_fail" class="block mt-1 w-full" type="text" name="application[no_fail]" :value="old('application.no_fail')" required />
                        <x-input-error :messages="$errors->get('application.no_fail')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center justify-end mt-4 gap-4 border-t pt-4">
                    <a href="{{ route('applications.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                    <x-primary-button>
                        Record Application
                    </x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
