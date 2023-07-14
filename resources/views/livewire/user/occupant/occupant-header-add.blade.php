<div>
    {{-- small screen --}}
    <div class="sm:hidden">
        <div class="flex">
            <x-icon.fonts.poeple class="inline-block px-2 py-2 align-text-bottom text-sky-900 fa-lg"></x-icon.fonts.poeple>
            <x-icon.fonts.add
            wire:click="raise_CreateModal()"                                          
            class="pt-2 mr-3 -ml-2 cursor-pointer fa-md text-sky-900">
            </x-icon.fonts.add>
            <div class="flex-1 text-gray-900 truncate line-clamp-1 sm:font-bold sm:text-md">{{ $occupant->lage. '-'. $occupant->nachname. ' '}}</div>
        </div>
        <div>{{ $occupant->street.', '. $occupant->postcode. ' '. $occupant->city }}</div>
    </div>
    {{-- big screen --}}
    <div class="hidden md:block">
        <div class="flex">
            <x-icon.fonts.poeple class="pt-3 mr-3 fa-2xl text-sky-900">
            </x-icon.fonts.poeple>
            <x-icon.fonts.add
            wire:click="raise_CreateModal()"                                          
            class="pt-5 mr-3 -ml-3 cursor-pointer fa-xl text-sky-900 hover:text-sky-300">
            </x-icon.fonts.add>
            <div class="w-40 px-2 text-gray-900 truncate line-clamp-1 md:font-bold md:text-xl">{{ $occupant->lage. '-'. $occupant->nachname. ' '}}</div>
            <div class="px-2 text-gray-900 truncate line-clamp-1 md:text-xl">{{ $occupant->street.', '. $occupant->postcode. ' '. $occupant->city }}</div>
        </div>
    </div>
</div>

