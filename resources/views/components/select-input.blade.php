@props(['disabled' => false])

@php
$classes = 'block mt-1 w-full rounded-lg bg-inputBackground border border-border text-white focus:border-primary focus:ring-primary px-3 py-2 transition-colors';
@endphp

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $classes]) !!}>
    {{ $slot }}
</select>