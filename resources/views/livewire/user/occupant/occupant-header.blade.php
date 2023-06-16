<div class="flex">
    <x-icon.fonts.poeple class="fa-2xl mt-6 mr-3 text-sky-900"></x-icon.fonts.poeple>
    <div>
        <div class="flex-1 text-xl text-gray-900 truncate line-clamp-1 text- md:font-bold md:text-md">{{ $occupant->lage. '-'. $occupant->nachname. ' '}}</div>
        <div>{{ $occupant->street.', '. $occupant->postcode. ' '. $occupant->city }}</div>
    </div>
</div>
