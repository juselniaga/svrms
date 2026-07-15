@props(['title' => null])

<div {{ $attributes->merge(['class' => 'bg-surface border-l-4 border-l-primary-light shadow-sm sm:rounded-lg overflow-hidden']) }}>
    @if ($title)
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-primary font-display">{{ $title }}</h3>
        </div>
    @endif
    <div class="p-6 text-gray-900">
        {{ $slot }}
    </div>
</div>
