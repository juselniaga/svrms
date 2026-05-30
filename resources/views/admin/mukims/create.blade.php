<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register New Mukim') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.mukims.store') }}" class="space-y-6">
                        @csrf

                        <!-- Mukim No -->
                        <div>
                            <label for="mukim_no" class="block text-sm font-medium text-gray-700">
                                Mukim Number <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="mukim_no" id="mukim_no"
                                value="{{ old('mukim_no') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="e.g., MK001" required>
                            <x-input-error :messages="$errors->get('mukim_no')" class="mt-2" />
                        </div>

                        <!-- Short Code -->
                        <div>
                            <label for="short_mukim" class="block text-sm font-medium text-gray-700">
                                Short Code <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="short_mukim" id="short_mukim"
                                value="{{ old('short_mukim') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="e.g., MK" maxlength="10" required>
                            <x-input-error :messages="$errors->get('short_mukim')" class="mt-2" />
                        </div>

                        <!-- Mukim Name -->
                        <div>
                            <label for="mukim" class="block text-sm font-medium text-gray-700">
                                Mukim Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="mukim" id="mukim"
                                value="{{ old('mukim') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Enter mukim name" required>
                            <x-input-error :messages="$errors->get('mukim')" class="mt-2" />
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">
                                Status
                            </label>
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="status" value="1"
                                        {{ old('status', true) ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-700">Active</span>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-3 pt-4 border-t">
                            <x-primary-button type="submit">
                                Register Mukim
                            </x-primary-button>
                            <a href="{{ route('admin.mukims.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
