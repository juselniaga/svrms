@props(['status'])

@php
    $badgeProps = match ($status) {
        'RECORDED' => ['color' => 'primary', 'label' => 'RECORDED'],
        'SITE_VISIT_IN_PROGRESS' => ['color' => 'accent', 'label' => 'SITE VISIT IN PROGRESS'],
        'REVIEW_COMPLETED' => ['color' => 'accent', 'label' => 'REVIEW COMPLETED'],
        'PENDING_VERIFICATION' => ['color' => 'primary', 'label' => 'PENDING VERIFICATION'],
        'VERIFIED' => ['color' => 'primary', 'label' => 'VERIFIED'],
        'PENDING_APPROVAL' => ['color' => 'primary', 'label' => 'PENDING APPROVAL'],
        'APPROVED' => ['color' => 'success', 'label' => 'APPROVED'],
        'REJECTED' => ['color' => 'danger', 'label' => 'REJECTED'],
        'FILED' => ['color' => 'gray', 'label' => 'FILED'],
        default => ['color' => 'gray', 'label' => $status],
    };

    // Override the generic badge colors specifically for status badges as per spec:
    $colorClasses = match ($badgeProps['color']) {
        'primary' => 'bg-primary-light text-white', // Purple
        'accent' => 'bg-accent text-white',         // Orange
        'success' => 'bg-[#2E7D32] text-white',     // Green
        'danger' => 'bg-[#C62828] text-white',      // Red
        'gray' => 'bg-[#1F5C99] text-white',        // Blue for Filed
        default => 'bg-gray-100 text-gray-800'
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {$colorClasses} font-mono uppercase tracking-wider"]) }}>
    {{ $badgeProps['label'] }}
</span>
