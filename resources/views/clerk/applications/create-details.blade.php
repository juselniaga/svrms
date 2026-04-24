<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight block">
                {{ __('Daftar Permohonan Baru') }}
            </h2>
            <span class="text-sm text-gray-500"> Langkah 2 dari 2</span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 bg-green-50 border-l-4 border-green-400 p-4">
                        <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                <div class="mb-8 p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <h3 class="font-medium text-gray-900 mb-2">Pemaju Dipilih</h3>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div><span class="text-gray-500">Nama:</span> <span
                                class="font-semibold">{{ $developer->name }}</span></div>
                        <div><span class="text-gray-500">Email:</span> <span>{{ $developer->email }}</span></div>
                        <div><span class="text-gray-500">Phone:</span> <span>{{ $developer->tel }}</span></div>
                        <div><span class="text-gray-500">Lokasi:</span> <span>{{ $developer->city }},
                                {{ $developer->state }}</span></div>
                    </div>
                </div>

                <form method="POST" action="{{ route('clerk.applications.store', $developer->developer_id) }}" x-data="{
                    tajuk: '{{ old('application.tajuk') }}',
                    lokasi: '{{ old('application.lokasi') }}'
                }">
                    @csrf

                    <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Maklumat Permohonan</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="md:col-span-2">
                            <x-input-label for="application_tajuk" :value="__('Tajuk Projek *')" />
                            <x-text-input id="application_tajuk" class="block mt-1 w-full" type="text"
                                name="application[tajuk]" x-model="tajuk" required autofocus />
                            <x-input-error :messages="$errors->get('application.tajuk')" class="mt-2" />
                            <p x-show="!tajuk" class="text-sm text-red-500 mt-1" style="display: none;">Tajuk Projek
                                diperlukan.</p>
                        </div>
                        <div class="md:col-span-2">
                            <x-input-label for="application_lokasi" :value="__('Lokasi Projek *')" />
                            <textarea id="application_lokasi"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                name="application[lokasi]" rows="3" x-model="lokasi" required></textarea>
                            <x-input-error :messages="$errors->get('application.lokasi')" class="mt-2" />
                            <p x-show="!lokasi" class="text-sm text-red-500 mt-1" style="display: none;">Lokasi Projek
                                diperlukan.</p>
                        </div>
                        <div>
                            <x-input-label for="application_no_fail" :value="__('No Rujukan Fail *')" />
                            <x-text-input id="application_no_fail" class="block mt-1 w-full" type="text"
                                name="application[no_fail]" :value="old('application.no_fail')" required />
                            <x-input-error :messages="$errors->get('application.no_fail')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="application_officer_id" :value="__('Pegawai Lawatan Tapak *')" />
                            <select id="application_officer_id" name="application[officer_id]" required
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Pilih Pegawai --</option>
                                @foreach($officers as $officer)
                                    <option value="{{ $officer->user_id }}" {{ old('application.officer_id') == $officer->user_id ? 'selected' : '' }}>
                                        {{ $officer->name }} ({{ $officer->department ?? 'General' }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('application.officer_id')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-4 pt-4 border-t">
                        <a href="{{ route('clerk.applications.create') }}"
                            class="text-sm text-gray-600 hover:text-gray-900 underline">&larr; Tukar Pemaju</a>

                        <div class="flex">
                            <a href="{{ route('clerk.dashboard') }}"
                                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 mr-3">
                                Batal
                            </a>
                            <x-primary-button>
                                {{ __('Complete Registration') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>