@props([
    'placeholder' => null,
    'trailingAddOn' => null,    
])

<div class="flex w-full">
  <select {{ $attributes->merge(['class' => 'placeholder-gray-300 rounded-sm block w-full pl-1 py-1 font-semibold pr-10 sm:text-sm sm:border-b sm:border-sky-300 sm:text-sm lg:text-sm sm:leading-5' . ($trailingAddOn ? ' rounded-r-none' : '')]) }}
        style="border-width:0px; border-bottom-width:0px"
        position="absolute"
        >
        @if ($placeholder)
            <option class="" value="">{{ $placeholder }}</option>
        @endif
     
       {{ $slot }}
  </select>

  @if ($trailingAddOn)
    {{ $trailingAddOn }}
  @endif
</div>
