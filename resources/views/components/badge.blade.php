@props(['color' => 'primary'])

@php
    $colorClasses = match ($color) {
        'primary' => 'bg-primary-light text-white',
        'accent' => 'bg-accent text-white',
        'success' => 'bg-green-100 text-green-800',
        'danger' => 'bg-red-100 text-red-800',
        'gray' => 'bg-gray-100 text-gray-800',
        default => 'bg-primary-muted text-primary',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {$colorClasses} font-mono"]) }}>
    {{ $slot }}
</span>
