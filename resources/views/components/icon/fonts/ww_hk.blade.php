@props([
    'hk' => false,
])

@if ($hk)
    <x-icon.fonts.warmwasser></x-icon.fonts.warmwasser>
@else
    <x-icon.fonts.heizung></x-icon.fonts.heizung>
@endif
