@props([
    'displayicon' => true,
])

@if ($displayicon)
    <x-icon.fonts.poeple {{ $attributes->merge(['class' => '']) }}></x-icon.fonts.poeple>
@else
    <x-icon.fonts.add {{ $attributes->merge(['class' => '']) }}></x-icon.fonts.add>
@endif
