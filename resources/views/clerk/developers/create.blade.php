<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight block">
            {{ __('Daftar Pemaju Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('warning'))
                    <div class="mb-4 bg-yellow-50 border-l-4 border-yellow-400 p-4">
                        <p class="text-sm text-yellow-700 font-medium pb-2 relative">{{ session('warning') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('clerk.developers.store') }}" x-data="{
                    developerName: '{{ old('name', $name ?? '') }}',
                    developerEmail: '{{ old('email', $email ?? '') }}'
                }">
                    @csrf

                    <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Maklumat Pemaju</h3>
                    <p class="text-sm text-gray-500 mb-6">Daftar profil Pemaju baru untuk dikaitkan dengan permohonan yang akan datang.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <x-input-label for="name" :value="__('Nama Syarikat/Pemaju *')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text"
                                name="name" x-model="developerName" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            <p x-show="!developerName" class="text-sm text-red-500 mt-1" style="display: none;">Nama diperlukan.</p>
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Alamat E-mel *')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email"
                                name="email" x-model="developerEmail" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            <p class="text-xs text-gray-500 mt-1">Alamat e-mel mesti unik.</p>
                        </div>
                        <div>
                            <x-input-label for="tel" :value="__('Telefon *')" />
                            <x-text-input id="tel" class="block mt-1 w-full" type="text" name="tel"
                                :value="old('tel')" required />
                            <x-input-error :messages="$errors->get('tel')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="address1" :value="__('Address Line 1 *')" />
                            <x-text-input id="address1" class="block mt-1 w-full" type="text"
                                name="address1" :value="old('address1')" required />
                            <x-input-error :messages="$errors->get('address1')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="poskod" :value="__('Poskod *')" />
                            <x-text-input id="poskod" class="block mt-1 w-full" type="text"
                                name="poskod" :value="old('poskod')" required />
                            <x-input-error :messages="$errors->get('poskod')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="city" :value="__('Bandar *')" />
                            <x-text-input id="city" class="block mt-1 w-full" type="text"
                                name="city" :value="old('city')" required />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="state" :value="__('Negeri *')" />
                            <x-text-input id="state" class="block mt-1 w-full" type="text"
                                name="state" :value="old('state')" required />
                            <x-input-error :messages="$errors->get('state')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4 pt-4 border-t">
                        <a href="{{ route('clerk.applications.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 mr-3">
                            Kembali ke Carian
                        </a>
                        <x-primary-button>
                            {{ __('Simpan & Teruskan ke Permohonan') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
