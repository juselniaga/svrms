<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register New Block Perancang Kecil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.bpks.store') }}" class="space-y-6">
                        @csrf

                        <!-- Block Perancang Selection -->
                        <div>
                            <label for="bp_id" class="block text-sm font-medium text-gray-700">
                                Block Perancang <span class="text-red-500">*</span>
                            </label>
                            <select name="bp_id" id="bp_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                                <option value="">-- Select Block Perancang --</option>
                                @foreach($bps as $bp)
                                    <option value="{{ $bp->id }}" {{ old('bp_id') == $bp->id ? 'selected' : '' }}>
                                        {{ $bp->id }} - {{ $bp->bp_name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('bp_id')" class="mt-2" />
                        </div>

                        <!-- BPK ID -->
                        <div>
                            <label for="id" class="block text-sm font-medium text-gray-700">
                                BPK ID <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="id" id="id"
                                value="{{ old('id') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="e.g., BPK001" required>
                            <x-input-error :messages="$errors->get('id')" class="mt-2" />
                        </div>

                        <!-- Short Code -->
                        <div>
                            <label for="bpk_short" class="block text-sm font-medium text-gray-700">
                                Short Code <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="bpk_short" id="bpk_short"
                                value="{{ old('bpk_short') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="e.g., BPK" maxlength="10" required>
                            <x-input-error :messages="$errors->get('bpk_short')" class="mt-2" />
                        </div>

                        <!-- BPK Name -->
                        <div>
                            <label for="bpk_name" class="block text-sm font-medium text-gray-700">
                                BPK Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="bpk_name" id="bpk_name"
                                value="{{ old('bpk_name') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Enter BPK name" required>
                            <x-input-error :messages="$errors->get('bpk_name')" class="mt-2" />
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
                                Register BPK
                            </x-primary-button>
                            <a href="{{ route('admin.bpks.index') }}"
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
