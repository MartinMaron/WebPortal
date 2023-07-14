
  <div class="">
    <div class="hidden sm:block">
        <div class="flex pt-7 ml-28">
            <div class="">
                <x-icon.fonts.poeple class="inline-block pr-2 align-text-bottom fa-xl text-sky-900"></x-icon.fonts.poeple>
            </div>
            <div class="pt-2 -ml-2">
                <x-icon.fonts.add 
                wire:click="raise_CreateModal()"                                          
                class="cursor-pointer fa-xl text-sky-900"   
                >
                </x-icon.fonts.add>
            </div>
        </div>
    </div>
    <div class="block sm:hidden">
        <x-icon.fonts.poeple class="inline-block pr-2 align-text-bottom fa-lg text-sky-900"></x-icon.fonts.poeple>
        <x-icon.fonts.add 
        wire:click="raise_CreateModal()"                                          
        class="ml-5 cursor-pointer fa-md text-sky-900"   
        >
    </x-icon.fonts.add>
    </div>
</div> 

{{--
<div class="">
    <div class="hidden sm:block">
        <div class="flex sm:grid-cols-5 sm:gap-2">
            <button 
                wire:click="raise_CreateModal()"                                          
                class="block w-56 p-1 px-2 m-0 mb-2 text-justify border rounded-md hover:bg-sky-400 bg-sky-200 md:text-md focus:bg-sky-500 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"   
                >
                <span class="md:text-md "><i class="pr-2 text-left fa-solid fa-layer-plus"></i></i></span>
                <span class="text-right md:text-md">hinzufügen</span>
            </button>
        </div>
    </div>
    <div class="block sm:hidden">
        <button 
        wire:click="raise_CreateModal()"                                          
        class="block p-1 px-2 m-0 mb-2 text-justify border rounded-md border-sky-100 bg-sky-200 md:text-md hover:bg-sky-500 focus:bg-sky-500 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"   
        >
        <span class="md:text-md "><i class="pr-2 text-left fa-solid fa-layer-plus"></i></i></span>
        <span class="text-right md:text-md">hinzufügen</span>
    </button>
    </div>
</div> --}}


