
<div class="p-4 w-full text-lg text-right rounded-md sm:text-3xl bg-sky-100 dark:bg-slate-500 ">
    <div class="flex items-center justify-between">
        <div class="realestateheader flex items-center justify-between">
            <div class="px-2 sm:px-4">
                <a class="tooltip" href="{{route('user.realestate', $realestate)}}">
                    <i class="_icon fad fa-home"></i>
                    <span class="tooltiptext text-left">
                        <span style="white-space: nowrap">Liegenschaftsübersicht:</span>
                    </span>
                </a>
            </div>
            @if ($realestate->nutzerlisteactive)
                <div class="px-2 sm:px-4">
                    <a class="tooltip" href="{{route('user.realestateOccupantList', $realestate)}}">
                        @if ($realestate->abrechnungssetting->nutzerlisteDone)
                            <i class="fa-kit fa-solid-users-circle-check text-green-500 dark:text-green-800"></i>
                        @else
                            <x-icon.fonts.users class="_icon">
                            </x-icon.fonts.users>
                        @endif
                        <span class="tooltiptext text-left">
                            <span style="white-space: nowrap">Nutzerliste:</span>
                            <span style="white-space: nowrap">Nutzerwechsel, </span>
                            <span style="white-space: nowrap">Eingabe der Vorauszahlungen</span>
                        </span>
                    </a>
                </div>
            @endif
            @if ($realestate->kosteneingabe)
                <div class="px-2 sm:px-4">
                    <a class="tooltip" href="{{route('user.costs', $realestate)}}">
                        @if ($realestate->abrechnungssetting->brennstofflisteDone)
                        <i class="fa-kit fa-solid-file-signature-circle-check text-green-500 dark:text-green-800"></i>
                        @else
                            <x-icon.fonts.file-signature class="_icon">
                            </x-icon.fonts.file-signature>
                        @endif    
                        <span class="tooltiptext">
                            <span style="white-space: nowrap">Eingabe der Brennstoffkosten</span>
                        </span>
                    </a>
                </div>
                <div class="tooltip px-2 sm:px-4">
                    <a href="{{route('user.heizkostenliste', $realestate)}}">
                        @if ($realestate->abrechnungssetting->heizkostenlisteDone)
                            <i class="fa-kit fa-solid-file-pen-circle-check text-green-500 dark:text-green-800"></i>
                        @else
                            <i class="fa-duotone fa-solid fa-file-pen _icon"></i>
                        @endif    
                        <span class="tooltiptext">
                            <span style="white-space: nowrap">Eingabe der weiteren Heizkosten</span>
                        </span>
                    </a>
                </div>
                @if ($realestate->betriebskosten)
                    <div class="tooltip px-2 sm:px-4">
                        <a href="{{route('user.betriebskostenliste', $realestate)}}">
                            @if ($realestate->abrechnungssetting->betreibskostenDone)
                                <i class="fa-kit fa-solid-file-pen-circle-check text-green-500 dark:text-green-800"></i>
                            @else
                                <i class="fa-regular fa-file-signature _icon"></i>
                            @endif   
                        </a>
                        <span class="tooltiptext">
                            <span style="white-space: nowrap">Eingabe der Betriebskosten</span>
                        </span>
                    </div>
                @endif
            @endif
            @if ($realestate->uviactive)
            <div class="tooltip px-2 sm:px-4">
                <a href="{{route('user.realestateVerbrauchsinfoUserEmails', $realestate)}}">
                    <x-icon.fonts.poll-people class="_icon"></x-icon.fonts.poll-people>
                </a>
                <span class="tooltiptext">
                    <span style="white-space: nowrap">Ändern der Empfänger für Verbrauchserinformationen </span>
                </span>
            </div>
            @endif
            <div class="tooltip px-2 sm:px-4">
                <a href="{{route('user.invoicesList', $realestate)}}">
                    <x-icon.fonts.pdf-download class="_icon"></x-icon.fonts.pdf-download>
                </a>
                <span class="tooltiptext">
                    <span style="white-space: nowrap">Rechnungsübersicht</span>
                </span>
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
