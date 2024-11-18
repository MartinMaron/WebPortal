@props([
    'leadingAddOn' => false,
    'readonly' => false,
])

<div class="flex rounded-md w-full">
    @if ($leadingAddOn)
        <span class="inline-flex items-center px-3 rounded-l-md  border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
            {{ $leadingAddOn }}
        </span>
    @endif

    <input  {{ $readonly ? 'disabled ' : '' }}   {{ $attributes->merge(['class' => ' sm:pt-0 placeholder-gray-300 flex-1 pl-1 form-input  block w-full transition duration-150 ease-in-out focus:outline-none focus:border focus:border-blue-500 sm:rounded sm:text-sm lg:text-sm sm:leading-5' . ($leadingAddOn ? ' rounded-none rounded-r-md' : '')]) }}/>

</div>
