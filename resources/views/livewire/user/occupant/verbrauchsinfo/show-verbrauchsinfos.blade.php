<div class="w-full px-4 py-1 mx-auto max-w-7xl sm:px-6 lg:px-8 ">
    <livewire:user.occupant.occupant-header :occupant='$occupant'/>
    <x-input.search wire:model.debounce.2000="filter"/>

    @if ($nutzergruppen->count()!=0)

        <div class="mb-5 text-xl font-bold text-center border-b-2 md:text-2xl border-sky-400 w-max-md md:bloc">
            VERLAUF DER VERBRÄUCHE
        </div>
            @foreach ($nutzergruppen as $verbrauchsinfo)
            {{-- Duzy ekran --}}
            
                <livewire:vebrauchsinfo-large-screen :verbrauchsinfo='$verbrauchsinfo'/>

            @forelse ($this->getVerbrauchsinfosByNutzergrupe($verbrauchsinfo->nutzergrup_id) as $singleVerbrauchsinfo)
            
            {{-- Maly ekran --}}

                <livewire:vebrauchsinfo-small-screen :singleVerbrauchsinfo='$singleVerbrauchsinfo'/>

                @endforeach
                </div>
            @endforeach
    @endif
    @if ($rows->count()==0)
        <livewire:message-nichts-gefunden />
    @endif
</div>
