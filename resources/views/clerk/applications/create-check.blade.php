<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight block">
            {{ __('Semak Pemohon') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('warning'))
                    <div class="mb-4 bg-yellow-50 border-l-4 border-yellow-400 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    {{ session('warning') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                @if(isset($developers) && $developers->isNotEmpty())
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Search Results for "{{ $query }}"</h3>
                    <p class="text-sm text-gray-500 mb-6">We found {{ $developers->count() }} matching developer(s). Please
                        pilih developer yang betul atau daftar developer baru.</p>

                    <div class="space-y-4 mb-6">
                        @foreach($developers as $dev)
                            <div
                                class="border border-gray-200 rounded-lg p-4 hover:bg-purple-50 transition flex justify-between items-center bg-white shadow-sm">
                                <div>
                                    <h4 class="font-semibold text-gray-900">{{ $dev->name }}</h4>
                                    <p class="text-sm text-gray-500">{{ $dev->email }} | {{ $dev->tel }}</p>
                                    <p class="text-xs text-gray-400 mt-1">{{ $dev->city }}, {{ $dev->state }}</p>
                                </div>
                                <a href="{{ route('clerk.applications.create-details', $dev->developer_id) }}"
                                    class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm ml-4 whitespace-nowrap">
                                    Pilih & Teruskan
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex items-center justify-between border-t pt-4">
                        <a href="{{ route('clerk.applications.create') }}"
                            class="text-sm text-purple-600 hover:text-purple-900 underline">
                            &larr; Search Again
                        </a>
                        <form action="{{ route('clerk.developers.create') }}" method="GET" class="inline">
                            @if(filter_var($query, FILTER_VALIDATE_EMAIL))
                                <input type="hidden" name="email" value="{{ $query }}">
                            @else
                                <input type="hidden" name="name" value="{{ $query }}">
                            @endif
                            <button
                                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                Tiada dalam senarai? Daftar Developer Baru
                            </button>
                        </form>
                    </div>
                @else
                    <form method="POST" action="{{ route('clerk.applications.check-developer') }}">
                        @csrf

                        <h3 class="text-lg font-medium text-gray-900 mb-2">Langkah 1: Kenalpasti Pemohon</h3>
                        <p class="text-sm text-gray-500 mb-6">Sila masukkan nama atau alamat e-mel Pemohon yang berdaftar
                            untuk memeriksa jika mereka sudah wujud dalam sistem.</p>

                        <div>
                            <x-input-label for="developer_query" :value="__('Nama atau E-mel Pemohon *')" />
                            <x-text-input id="developer_query" class="block mt-1 w-full" type="text" name="developer_query"
                                :value="old('developer_query')" required autofocus
                                placeholder="e.g. contact@developer.com or Acme Corp" />
                            <x-input-error :messages="$errors->get('developer_query')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6 pt-4 border-t">
                            <a href="{{ route('clerk.dashboard') }}"
                                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 mr-3">
                                Cancel
                            </a>
                            <x-primary-button>
                                {{ __('Semak Pemohon') }}
                            </x-primary-button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>