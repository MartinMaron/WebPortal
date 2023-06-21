<div class="w-full px-4 py-1 mx-auto max-w-7xl sm:px-6 lg:px-8 ">
    <livewire:user.occupant.occupant-header  :occupant='$occupant'/>
    <x-input.search wire:model.debounce.2000="filter"/>

    @if ($nutzergruppen->count()!=0)

        <div class="mb-5 text-xl font-bold text-center border-b-2 md:text-2xl border-sky-400 w-max-md md:bloc">
            VERLAUF DER VERBRÄUCHE
        </div>
            @foreach ($nutzergruppen as $verbrauchsinfo)
            {{-- big screen website --}}

            <div class="justify-center hidden w-full px-4 py-1 mx-auto mt-8 md:flex max-w-7xl">
                <div class="mb-6">
                <span class="font-thin text-xl md:font-bold {{ $verbrauchsinfo->ww ? 'text-red-800 ' : 'text-green-600 ' }}">{{ $verbrauchsinfo->nutzergrup_name}}</span>
                </div>
                <div class="px-4">
                    <x-icon.fonts.ww_hk class="text-3xl" :hk='$verbrauchsinfo->hk' ></x-icon.fonts.ww_hk>
                </div>
            </div>

        <div class="hidden md:flex md:justify-around md:items-center ">
            <div class="flex mt-1 text-lg font-bold text-center border-2 rounded-t-lg md:flex-1 bg-sky-100 border-sky-100 basis-1/6">
                <div class="flex justify-center basis-1/4">
                    <div class="">Monat</div>
                    <div class="mt-1">
                    <x-table.heading class="items-center text-center text-md" sortable multi-column wire:click="sortBy('datum')" :direction="$sorts['datum'] ?? null">
                    </x-table.heading>
                    </div>
                </div>
                <div class="basis-1/4">
                    <span class="">Aktuell</span>
                </div>
                <div class="basis-1/4">
                    <span class="">Vorjahr</span>
                </div>
                <div class="basis-1/4">
                    <span class="">Einheit</span>
                </div>
            </div>
        </div>

            {{--end big screen website --}}


            <div class="flex justify-center sm:hidden">
                <div class="mb-1 text-lg md:text-xl font-bold {{ $verbrauchsinfo->ww ? 'text-red-800 ' : 'text-green-600 ' }}">
                {{ $verbrauchsinfo->nutzergrup_name}}
                </div>
                <div class="px-4">
                    <x-icon.fonts.ww_hk class="text-2xl" :hk='$verbrauchsinfo->hk' ></x-icon.fonts.ww_hk>
                </div>
            </div>
            
            <div class="md:border-2 md:rounded-b-lg md:border-sky-100 ">
            @forelse ($this->getVerbrauchsinfosByNutzergrupe($verbrauchsinfo->nutzergrup_id) as $singleVerbrauchsinfo)
                <div class="hidden md:flex pt-1 text-lg text-center {{ $singleVerbrauchsinfo->hk ? 'odd:bg-green-100 even:bg-green-50' :'even:bg-red-50 odd:bg-red-100'}} ">
                    <div class="basis-1/4">
                        {{ $singleVerbrauchsinfo->datum}}
                    </div>
                    <div class="basis-1/4">
                        {{ $singleVerbrauchsinfo->VerbrauchAktDisplay}}
                    </div>
                    <div class="basis-1/4">
                        {{ $singleVerbrauchsinfo->VerbrauchVorjDisplay}}
                    </div>
                    <div class="basis-1/4">
                        {{ $singleVerbrauchsinfo->einheit->shortname}}
                    </div>
                </div>    

            <div>
            </div>
                    <!--loyal websites small screens-->
                    <div class= "max-w-sm pb-4 m-1 sm:hidden">
                        <div class="text-sm font-bold text-center border-2 rounded-t-lg sm:flex-1 bg-sky-100 border-sky-100 basis-1/6">
                            <div class="flex justify-center basis-1/2">
                                <x-table.heading class="items-center text-sm text-center " sortable multi-column wire:click="sortBy('datum')" :direction="$sorts['datum'] ?? null">
                                    {{ $singleVerbrauchsinfo->zeitraum_akt }}
                                </x-table.heading>
                            </div>
                        </div>
                        <div class="text-sm border-2 rounded-b-lg border-sky-100">
                            <div class="flex justify-around mt-1 text-center">
                                <div class="basis-1/6">
                                    <span class="text-xs font-thin ">Aktuell</span>
                                </div>
                                <div class="basis-1/6">
                                    <span class="text-xs font-thin ">Vorjahr</span>
                                </div>
                            </div>

                            <div class="flex justify-around pb-1 mt-1">
                                <div class="flex text-lg font-bold text-center basis-1/6">
                                <span class="{{ $singleVerbrauchsinfo->ww ? 'text-red-800 ' : 'text-green-600 ' }}">
                                    {{ $singleVerbrauchsinfo->VerbrauchAktDisplay}}
                                </span>
                                <span class="{{ $singleVerbrauchsinfo->ww ? 'text-red-800 ' : 'text-green-600 ' }}">
                                        {{ $singleVerbrauchsinfo->einheit->shortname}}
                                    </span>
                                </div>
                            <div class="flex text-lg font-bold text-center basis-1/6">
                                <span class="{{ $singleVerbrauchsinfo->ww ? 'text-red-800 ' : 'text-green-600 ' }}">
                                    {{ $singleVerbrauchsinfo->VerbrauchVorjDisplay}}
                                </span>
                                <span class="{{ $singleVerbrauchsinfo->ww ? 'text-red-800 ' : 'text-green-600 ' }}">
                                    {{ $singleVerbrauchsinfo->einheit->shortname}}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end loyal websites small screens-->
                @endforeach
                </div>
            @endforeach
    @endif
    @if ($rows->count()==0)
        <div class="flex items-center justify-center space-x-2 bg-sky-100">
            <span class="py-8 text-xl font-medium text-cool-gray-400">nichts gefunden...</span>
        </div>
    @endif
</div>
