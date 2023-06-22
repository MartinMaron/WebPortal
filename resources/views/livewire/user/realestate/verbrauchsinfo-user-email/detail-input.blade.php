<div class="">
    {{-- small screen --}}
    <div class="hidden sm:block">
        <div class="flex items-center justify-center sm:grid-cols-5 sm:gap-2">
            duzy ekran
            <button 
                wire:click="raise_CreateModal()"                                          
                class="basis-1/5 border text-justify bg-sky-300 md:text-md hover:bg-sky-500 focus:bg-sky-500 focus:ring-indigo-500 p-1 px-2 m-0 focus:border-indigo-500 block w-full sm:text-sm border-gray-900 rounded-md"   
                >
                <span class="md:text-md "><i class="text-left pr-2 fa-solid fa-layer-plus"></i></i></span>
                <span class="md:text-md text-right">hinzufügen</span>
            </button>
        </div>
    </div>
    {{-- big screen --}}
    <div class="sm:hidden block ">
        maly ekran
        <button 
        wire:click="raise_CreateModal()"                                          
        class="basis-1/5 border text-justify bg-sky-300 md:text-md hover:bg-sky-500 focus:bg-sky-500 focus:ring-indigo-500 p-1 px-2 m-0 focus:border-indigo-500 block w-full sm:text-sm border-gray-900 rounded-md"   
        >
        <span class="md:text-md "><i class="text-left pr-2 fa-solid fa-layer-plus"></i></i></span>
        <span class="md:text-md text-right">hinzufügen</span>
    </button>
    </div>
</div>


