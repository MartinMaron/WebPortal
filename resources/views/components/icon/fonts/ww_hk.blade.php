@props([
    'hk' => true,
])

@if ($hk)
    <x-icon.fonts.heizung {{ $attributes->merge(['class' => 'text-green-600']) }}></x-icon.fonts.heizung>
@else
    <x-icon.fonts.warmwasser {{ $attributes->merge(['class' => 'text-red-800']) }}></x-icon.fonts.warmwasser>
@endif
