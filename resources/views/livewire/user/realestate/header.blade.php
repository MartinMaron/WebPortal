
<div class="p-4 w-full text-lg text-right rounded-md sm:text-3xl bg-sky-100">
    <div class="flex items-center justify-between">
        <div class="flex items-center justify-between">
            <div x-data="{ tooltip: false }" class="relative z-30 inline-flex">
                <div x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="rounded-md px-1 py-2 cursor-pointer">
                    <div class="px-2 ">
                        <a href="{{route('user.realestate', $realestate)}}">
                            <i class=" text-sky-700 hover:text-sky-300 fad fa-home"></i>
                        </a>
                    </div>
                </div>
                <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                  <div class="absolute top-0 z-10 p-2 -mt-1 text-sm leading-tight text-white transform -translate-x-1/2 -translate-y-full bg-sky-500 rounded-lg shadow-lg">
                        Liegenschaftsübersicht
                  </div>
                  <svg class="absolute z-10 w-6 h-6 text-sky-500 transform -translate-x-12 -translate-y-3 fill-current stroke-current" width="8" height="8">
                    <rect x="12" y="-10" width="8" height="8" transform="rotate(45)" />
                  </svg>
                </div>
            </div>
            <div x-data="{ tooltip: false }" class="relative z-30 inline-flex">
                <div x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false" class="rounded-md px-3 py-2 cursor-pointer">
                    <div class="px-2 ">
                        <a href="{{route('user.realestateOccupantList', $realestate)}}">
                            <x-icon.fonts.users class="text-sky-700 hover:text-sky-300"></x-icon.fonts.users>
                        </a>
                    </div>
                </div>
                <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                  <div class="text-left absolute top-0 z-10 p-2 -mt-1 text-sm leading-tight text-white transform -translate-x-1/2 -translate-y-full bg-sky-500 rounded-lg shadow-lg">
                        <span class="">{{ 'Eingabe der Nutzerwechsel und Vorauszahlungen' }}</span>    
                  </div>
                  <svg class="absolute z-10 w-6 h-6 text-sky-500 transform -translate-x-12 -translate-y-3 fill-current stroke-current" width="8" height="8">
                    <rect x="12" y="-10" width="8" height="8" transform="rotate(45)" />
                  </svg>
                </div>
            </div>

            
           
            <div class="px-2 sm:px-4">
                <a href="{{route('user.costs', $realestate)}}">
                    <x-icon.fonts.file-signature class="text-sky-700 hover:text-sky-300"></x-icon.fonts.file-signature>
                </a>
            </div>
            <div class="px-2 sm:px-4">
                <a href="{{route('user.heizkostenliste', $realestate)}}">
                    <i class="fa-duotone fa-solid fa-file-signature text-sky-700 hover:text-sky-300"></i>
                </a>
            </div>
            @if ($realestate->betriebskosten)
                <div class="px-2 sm:px-4">
                    <a href="{{route('user.betriebskostenliste', $realestate)}}">
                        <i class="fa-regular fa-file-signature text-sky-700 hover:text-sky-300"></i>
                    </a>
                </div>
            @endif
            
            <div class="px-2 sm:px-4">
                <a href="{{route('user.realestateVerbrauchsinfoUserEmails', $realestate)}}">
                    <x-icon.fonts.poll-people class="text-sky-700 hover:text-sky-300"></x-icon.fonts.poll-people>
                </a>
            </div>
            <div class="px-2 sm:px-4">
                <a href="{{route('user.invoicesList', $realestate)}}">
                    <x-icon.fonts.pdf-download class="text-sky-700 hover:text-sky-300"></x-icon.fonts.pdf-download>
                </a>
            </div>
        </div>
        <div>
            <livewire:user.realestate.header-address :baseobject='$realestate' />
        </div>

    </div>
    <div class="xs:block sm:hidden">
        <div class="mt-3 text-left ">
            <x-input.select
            class="text-left h-10 border-b bg-sky-50 sm:h-8 focus:border-0 w-full" wire:model="realestate.abrechnungssetting_id" id="realestate-header-address-abrechnungssetting-id" value="">
                @foreach ($this->realestate->abrechnungssettings as $label)
                    <option class="h-10 text-left" value="{{ $label->id }}">
                        <span class="">{{ $label->period_from_editing. ' - '. $label->period_to_editing   }}</span>
                    </option>
                @endforeach
            </x-input.select>
        </div>
    </div>
</div>
