<div class="w-full px-4 py-1 mx-auto max-w-7xl sm:px-6 lg:px-8 ">
    <livewire:user.occupant.occupant-header  :occupant='$occupant'/>
    <x-input.search wire:model.debounce.2000="filter"/>
   
    @if ($nutzergruppen->count()!=0)

        <div class="pb-4 mt-16 sm:hidden max-w-sm">
            <div class="mb-5 text-xl font-bold text-center border-b-2 border-sky-400">Verbrauchsverlauf</div>
            @foreach ($nutzergruppen as $verbrauchsinfo)
                <div class="flex justify-center max-w-sm">
                    <div class="mb-1 text-lg font-bold {{ $verbrauchsinfo->ww ? 'text-red-800 ' : 'text-green-600 ' }}">
                        {{ $verbrauchsinfo->nutzergrup_name}}
                    </div>
                    <div class="px-4">
                        <x-icon.fonts.ww_hk class="text-2xl" :hk='$verbrauchsinfo->hk' ></x-icon.fonts.ww_hk>
                    </div>
                </div>

                @forelse ($this->getVerbrauchsinfosByNutzergrupe($verbrauchsinfo->nutzergrup_id) as $singleVerbrauchsinfo)
                    <div class="hidden md:block pl-10 pr-10">
                        <div class="grid grid-cols-4 text-center text-md mb-2 mt-2">
                            <div class="basis-1/6 ">
                                <span class="font-thin text-md ">{{ $singleVerbrauchsinfo->datum}}</span>
                            </div>
                            <div class="basis-1/6">
                                <span class="font-thin text-md ">{{ $singleVerbrauchsinfo->VerbrauchAktDisplay}}</span>
                            </div>
                            <div class="basis-1/6">
                                <span class="font-thin text-md ">{{ $singleVerbrauchsinfo->VerbrauchVorjDisplay}}</span>
                            </div>
                            <div class="basis-1/6">
                                <span class="font-thin text-md ">{{ $singleVerbrauchsinfo->einheit->shortname}}</span>
                            </div>
                        </div>
                    </div>
                    <!--loyal websites small screens-->
                    <div class= "pb-4 m-1 sm:hidden max-w-sm">
                        <div class="text-sm font-bold text-center border-2 rounded-t-lg sm:flex-1 bg-sky-100 border-sky-100 basis-1/6">
                            <div class="flex justify-center basis-1/2">
                                <x-table.heading class=" items-center text-center text-sm" sortable multi-column wire:click="sortBy('datum')" :direction="$sorts['datum'] ?? null">
                                    {{ $singleVerbrauchsinfo->zeitraum_akt }}
                                </x-table.heading>
                            </div>
                        </div>
                        <div class="text-sm border-2 rounded-b-lg border-sky-100">
                            <div class="flex justify-around mt-1 text-center">
                                <div class="basis-1/6">
                                    <span class="font-thin text-xs ">Aktuell</span>
                                </div>
                                <div class="basis-1/6">
                                    <span class="font-thin text-xs ">Vorjahr</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 pb-1 mt-1">
                                <div class="text-center text-lg font-bold basis-1/6">
                                <span class="{{ $singleVerbrauchsinfo->ww ? 'text-red-800 ' : 'text-green-600 ' }}">
                                    {{ $singleVerbrauchsinfo->VerbrauchAktDisplay}}
                                </span>
                                <span class="{{ $singleVerbrauchsinfo->ww ? 'text-red-800 ' : 'text-green-600 ' }}">
                                        {{ $singleVerbrauchsinfo->einheit->shortname}}
                                    </span>
                                </div>
                            <div class="text-center text-lg font-bold basis-1/6">
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
            @endforeach
    @endif
    @if ($rows->count()==0)
        <div class="flex items-center justify-center space-x-2 bg-sky-100">
            <span class="py-8 text-xl font-medium text-cool-gray-400">nichts gefunden...</span>
        </div>
    @endif
</div>
