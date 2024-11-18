
@props([
     'readonly' => false,
])

<div class="flex rounded-md  ">
    <input  
        placeholder="TT.MM.JJJJ"
        x-mask="99.99.9999"
        {{ $attributes->merge(['class' => 'border-0 py-1  flex-1 pl-1 block w-full transition duration-150 ease-in-out focus:outline-none focus:border focus:border-blue-500 rounded text-sm lg:text-sm sm:leading-5 border-gray-300']) }}/>
</div>  


