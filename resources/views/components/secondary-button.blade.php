@props(['size' => 'md', 'icon' => null])

@php
$sizes = [
    'sm' => 'px-3 py-2 text-xs',
    'md' => 'px-4 py-3 text-sm',
    'lg' => 'px-8 py-4 text-base',
];

$sizeClass = $sizes[$size] ?? $sizes['md'];
@endphp

<button {{ $attributes->merge(['type' => 'button', 'class' => "inline-flex items-center justify-center gap-2 {$sizeClass} bg-border hover:bg-border/80 text-white font-bold rounded-xl border-2 border-textMuted/20 hover:border-textMuted/40 transform hover:scale-105 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100"]) }}>
    @if($icon)
        {!! $icon !!}
    @endif
    {{ $slot }}
</button>
