<div>
    {{-- small screen --}}
    <div class="sm:hidden">
        <div class="flex">
            <x-icon.fonts.poeple class="inline-block pt-2 pr-2 align-text-bottom text-sky-900 fa-lg"></x-icon.fonts.poeple>
            <div class="flex-1 text-gray-900 truncate line-clamp-1 sm:font-bold sm:text-md">{{ $occupant->lage. '-'. $occupant->nachname. ' '}}</div>
        </div>
        <div>{{ $occupant->street.', '. $occupant->postcode. ' '. $occupant->city }}</div>
    </div>
    {{-- big screen --}}
    <div class="hidden md:block">
        <div class="flex items-baseline justify-center">
            <x-icon.fonts.poeple class="mt-10 mr-3 fa-2xl text-sky-900"></x-icon.fonts.poeple>
            <div class="px-2 text-gray-900 truncate line-clamp-1 md:font-bold md:text-xl">{{ $occupant->lage. '-'. $occupant->nachname. ' '}}</div>
            <div class="px-2 text-gray-900 truncate line-clamp-1 md:text-xl">{{ $occupant->street.', '. $occupant->postcode. ' '. $occupant->city }}</div>
        </div>
    </div>
</div>
