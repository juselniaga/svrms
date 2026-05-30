<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register New Block Perancang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.bps.store') }}" class="space-y-6">
                        @csrf

                        <!-- Block Perancang ID -->
                        <div>
                            <label for="id" class="block text-sm font-medium text-gray-700">
                                Block Perancang ID <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="id" id="id"
                                value="{{ old('id') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="e.g., BP001" required>
                            <x-input-error :messages="$errors->get('id')" class="mt-2" />
                        </div>

                        <!-- Short Code -->
                        <div>
                            <label for="bp_short" class="block text-sm font-medium text-gray-700">
                                Short Code <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="bp_short" id="bp_short"
                                value="{{ old('bp_short') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="e.g., BP" maxlength="10" required>
                            <x-input-error :messages="$errors->get('bp_short')" class="mt-2" />
                        </div>

                        <!-- Block Perancang Name -->
                        <div>
                            <label for="bp_name" class="block text-sm font-medium text-gray-700">
                                Block Perancang Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="bp_name" id="bp_name"
                                value="{{ old('bp_name') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Enter block perancang name" required>
                            <x-input-error :messages="$errors->get('bp_name')" class="mt-2" />
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
                                Register Block Perancang
                            </x-primary-button>
                            <a href="{{ route('admin.bps.index') }}"
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
