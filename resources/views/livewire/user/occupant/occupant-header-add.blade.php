<div>
    {{--small screen --}}
    <div class="sm:hidden">
        <div class="flex">
            <x-icon.fonts.ww_add
            displayicon='$occupant->displayicon'
            wire:click="raise_CreateModal()"                                          
            class="px-1 cursor-pointer fa-md text-sky-900">
            </x-icon.fonts.ww_add>
            <div class="flex-1 text-gray-900 truncate line-clamp-1 sm:font-bold sm:text-md">{{ $occupant->lage. '-'. $occupant->nachname. ' '}}</div>
        </div>
        <div>{{ $occupant->street.', '. $occupant->postcode. ' '. $occupant->city }}</div>
    </div>
    {{-- big screen --}}
    <div class="hidden md:block">
        <div class="flex">
            <x-icon.fonts.ww_add
            wire:click="raise_CreateModal()"                                          
            class="py-3 cursor-pointer fa-xl text-sky-900 hover:text-sky-300">
            </x-icon.fonts.ww_add>
            <div class="w-40 px-2 text-gray-900 truncate line-clamp-1 md:font-bold md:text-xl">{{ $occupant->lage. '-'. $occupant->nachname. ' '}}</div>
            <div class="px-2 text-gray-900 truncate line-clamp-1 md:text-xl">{{ $occupant->street.', '. $occupant->postcode. ' '. $occupant->city }}</div>
        </div>
    </div>
</div>

