
<div class="p-4 w-full text-lg text-right rounded-md sm:text-3xl bg-sky-100">
    <div class="flex items-center justify-between">
        <div class="flex items-center justify-between">
            <div class="px-2 sm:px-4">
                <a href="{{route('user.realestate', $realestate)}}">
                <i class=" text-sky-700 hover:text-sky-300 fad fa-home"></i>
            </a>
            </div>
            <div class="px-2 sm:px-4">
                <a href="{{route('user.realestateOccupantList', $realestate)}}">
                    <x-icon.fonts.users class="text-sky-700 hover:text-sky-300"></x-icon.fonts.users>
                </a>
            </div>
            <div class="px-2 sm:px-4">
                <a href="{{route('user.costs', $realestate)}}">
                    <x-icon.fonts.file-signature class="text-sky-700 hover:text-sky-300"></x-icon.fonts.file-signature>
                </a>
            </div>
            @if ($realestate->betriebskosten)
                <div class="px-2 sm:px-4">
                    <a href="{{route('user.betriebskostenliste', $realestate)}}">
                        <i class="fa-regular fa-file-signature text-sky-700 hover:text-sky-300""></i>
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
    <div class="xs:block sm:invisible">
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
