<div>
    {{-- small screen --}}
    <div class="sm:hidden">
        <div class="flex">
            @if ($showStandardIcon)
                <x-icon.fonts.poeple class="inline-block pt-2 pr-2 align-text-bottom text-sky-700 fa-lg"></x-icon.fonts.poeple>
            @endif
            @if ($addAction)
                <x-icon.fonts.users-add wire:click='raise_CreateVerbrauchsinfoUserEmailModal' class="inline-block pt-2 pr-2 align-text-bottom text-sky-700 fa-lg "></x-icon.fonts.users-add>
            @endif
            <div class="flex-1 text-gray-900 truncate line-clamp-1 sm:font-bold sm:text-md">{{ $occupant->lage. '-'. $occupant->nachname. ' '}}</div>
        </div>
        <div>{{ $occupant->street.', '. $occupant->postcode. ' '. $occupant->city }}</div>
    </div>
    {{-- big screen --}}
    <div class="hidden sm:block">
        <div class="flex items-baseline justify-center">
            @if ($showStandardIcon)
                <x-icon.fonts.poeple class="mt-10 mr-3 fa-2xl text-sky-700"></x-icon.fonts.poeple>
            @endif
            @if ($addAction)
                <x-icon.fonts.users-add wire:click='raise_CreateVerbrauchsinfoUserEmailModal' class="mt-10 mr-3 fa-2xl text-sky-700 hover:text-sky-300"></x-icon.fonts.users-add>
            @endif
            <div class="px-2 text-gray-900 truncate line-clamp-1 font-bold text-xl">{{ $occupant->lage. '-'. $occupant->nachname. ' '}}</div>
            <div class="px-2 text-gray-900 truncate line-clamp-1 text-xl">{{ $occupant->street.', '. $occupant->postcode. ' '. $occupant->city }}</div>
        </div>
    </div>
</div>
