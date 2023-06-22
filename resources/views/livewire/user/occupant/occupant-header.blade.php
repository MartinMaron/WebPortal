<div>
    {{-- small screen --}}
    <div class="sm:hidden">
        <div class="flex">
            <x-icon.fonts.poeple class="fa-2xl mt-6 mr-3 text-sky-900"></x-icon.fonts.poeple>
            <div>
                <div class="flex-1 text-xl text-gray-900 truncate line-clamp-1 text- md:font-bold md:text-md">{{ $occupant->lage. '-'. $occupant->nachname. ' '}}</div>
                <div>{{ $occupant->street.', '. $occupant->postcode. ' '. $occupant->city }}</div>
            </div>
        </div>
    </div>
    {{-- big screen --}}
    <div class="hidden md:block">
        <div class="flex justify-center items-baseline">
            <x-icon.fonts.poeple class="pr-2  text-sky-900 inline-block align-text-bottom"></x-icon.fonts.poeple>
            <div class="px-2 text-xl text-gray-900 truncate line-clamp-1 text- md:font-bold md:text-md">{{ $occupant->lage. '-'. $occupant->nachname. ' '}}</div>
            <div class="px-2 text-xl text-gray-900 truncate line-clamp-1 text- md:font-bold md:text-md">{{ $occupant->street.', '. $occupant->postcode. ' '. $occupant->city }}</div>
        </div>
    </div>
</div>
