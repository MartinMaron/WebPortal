<div class="">
    {{-- small screen --}}
    <div class="hidden sm:block">
        <div class="flex sm:grid-cols-5 sm:gap-2">
        {{-- duzy ekran --}}
            <button 
                wire:click="raise_CreateModal()"                                          
                class="block w-64 p-1 px-2 m-0 mb-2 text-justify border rounded-md hover:bg-sky-400 bg-sky-200 md:text-md focus:bg-sky-500 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"   
                >
                <span class="md:text-md "><i class="pr-2 text-left fa-solid fa-layer-plus"></i></i></span>
                <span class="text-right md:text-md">hinzufügen</span>
            </button>
        </div>
    </div>
    {{-- big screen --}}
    <div class="block sm:hidden">
        {{-- maly ekran --}}
        <button 
        wire:click="raise_CreateModal()"                                          
        class="block p-1 px-2 m-0 mb-2 text-justify border rounded-md border-sky-100 bg-sky-200 md:text-md hover:bg-sky-500 focus:bg-sky-500 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"   
        >
        <span class="md:text-md "><i class="pr-2 text-left fa-solid fa-layer-plus"></i></i></span>
        <span class="text-right md:text-md">hinzufügen</span>
    </button>
    </div>
</div>


