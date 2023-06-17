<div class="w-full px-4 py-1 mx-auto max-w-7xl sm:px-6 lg:px-8 ">
    <livewire:user.occupant.occupant-header  :occupant='$occupant'/>
    <x-input.search wire:model.debounce.2000="filter"/>
    <div>

            @if ($nutzergruppen->count()!=0)
            <div class="pb-4 mt-16">
                <div class="mb-5 text-lg font-bold text-center md:text-2xl border-b-2 border-sky-400 w-max-md md:bloc">
                    Zählerverbräuche in {{ $rows->first()->zeitraum_akt }}
                </div>
            </div>
                @foreach ($nutzergruppen as $counterMeter)
            {{-- big screen website --}}


            <div class="hidden md:flex justify-center w-full px-4 py-1 mx-auto max-w-7xl mt-8">
                <div class="mb-1 text-lg font-bold {{ $counterMeter->ww ? 'text-red-800 ' : 'text-green-600 ' }}">
                        {{ $counterMeter->nutzergrup_name }}
                    </div>
                    <div class="px-4">
                        <x-icon.fonts.ww_hk class="text-3xl" :hk='$counterMeter->hk' ></x-icon.fonts.ww_hk>
                    </div>
                </div>


                <div class="hidden md:flex mt-4">
                    <div class="grid grid-cols-5 text-md font-bold text-center border-2 rounded-t-lg md:flex-1 bg-sky-100 border-sky-100 basis-1/6">
                        <div class="basis-1/6">
                            <span class="">Nr.: </span>
                            <x-icon.fonts.sort class="text-gray-600 pl-2"></x-icon.fonts.sort>
                        </div>
                        <div class="flex justify-center">
                            <div class="inline-block align-bottom">
                                <span class="font-bold text-md">Funknr.: </span>
                            </div>
                        </div>
                        <div class="basis-1/6">
                            <span class="">mon. Verbrauch</span>
                        </div>
                        <div class="basis-1/6">
                            <span class="">Einheit</span>
                        </div>
                        <div class="basis-1/6">

                        </div>
                    </div>
                </div>

               {{--end big screen website --}}


                <div class="flex justify-center sm:hidden">
                    <div class="mb-1 text-lg font-bold {{ $counterMeter->ww ? 'text-red-800 ' : 'text-green-600 ' }}">
                        {{ $counterMeter->nutzergrup_name }}
                    </div>
                    <div class="px-4">
                        <x-icon.fonts.ww_hk class="text-2xl" :hk='$counterMeter->hk' ></x-icon.fonts.ww_hk>
                    </div>
                </div>

                @forelse ($this->getCounterMetersByNutzergrupe($counterMeter->nutzergrup_id) as $singleCounterMeter)


                    <div class="hidden md:block">
                        <div class="grid grid-cols-5 text-center text-md mb-2 mt-2 odd:bg-white even:bg-slate-50">
                            <div class="basis-1/6 ">
                                <span class="font-thin text-md ">{{ $singleCounterMeter->nr }}</span>
                            </div>
                            <div class="basis-1/6">
                                <span class="font-thin text-md {{ $counterMeter->nr == $counterMeter->funkNr ? 'hidden' : 'visible' }} ">{{ $singleCounterMeter->funkNr }}</span>
                            </div>
                            <div class="basis-1/6">
                                <span class="font-thin text-md ">{{ $singleCounterMeter->VerbrauchAktDisplay}}</span>
                            </div>
                            <div class="basis-1/6">
                                <span class="font-thin text-md ">{{ $singleCounterMeter->einheit->shortname}}</span>
                            </div>
                            <div class="mb-1 m-auto text-center border-2 rounded-md w-44 bg-sky-100">
                                <a href="{{route('user.occupantVerbrauchsinfoCounterMetersReading', ['occupant_id' => $occupant,'id' => $singleCounterMeter->nekoId])}}" class="relative items-center justify-center flex-1 w-0 text-sm font-medium text-gray-700 border border-transparent rounded-br-lg hover:text-gray-500">
                                    <span class="">Stände anzeigen</span>
                                </a>
                            </div>
                        </div>
                    </div>




                    <div class= "items-center justify-between m-1 sm:hidden">
                        <div class="pb-4">
                            <div class="mt-2 text-sm text-center border-2 rounded-t-lg bg-sky-100 border-sky-100">
                                {{-- Nummer und Funknummer Header --}}
                                <div class="flex justify-around x-12 my-1 ">
                                    <div class="flex justify-center">
                                        <div class="inline-block align-bottom">
                                            <span class="font-thin text-xs">Nr.: </span>
                                        </div>
                                        <div class="inline-block align-bottom">
                                            <x-table.heading class="" sortable multi-column wire:click="sortBy('nr')" :direction="$sorts['nr'] ?? null">
                                                <span class="font-bold text-sm">{{ $singleCounterMeter->nr }}</span>
                                            </x-table.heading>
                                        </div>
                                    </div>
                                    <div class="flex justify-center {{ $counterMeter->nr == $counterMeter->funkNr ? 'hidden' : 'visible' }}">
                                        <div class="inline-block align-bottom">
                                            <span class="font-thin text-xs">Funknr.: </span>
                                        </div>
                                        <div class="inline-block align-bottom">
                                            <x-table.heading class="" sortable multi-column wire:click="sortBy('funkNr')" :direction="$sorts['funkNr'] ?? null">
                                                <span class="text-sm">{{ $singleCounterMeter->funkNr }}</span>
                                            </x-table.heading>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-sm border-2 rounded-b-lg border-sky-100">
                                {{-- inhalt --}}
                                <div class="grid grid-cols-2">
                                    <div class="justify-around text-center mt-1">
                                        {{-- <div class="basis-1/6">
                                            <span class="font-thin text-xs ">mon. Verbrauch</span>
                                        </div> --}}
                                        <div class="text-center text-lg font-bold basis-1/6">
                                            <span class='{{ $counterMeter->ww ? 'text-red-800 ' : 'text-green-600 ' }}">'>
                                                {{ $singleCounterMeter->VerbrauchAktDisplay. " ".  $singleCounterMeter->einheit->shortname}}
                                            </span>
                                        </div>
                                    </div>
                                   {{--  <div class="justify-around text-center mt-1">
                                        <div class="basis-1/6">
                                            <span class="font-thin text-xs ">Stand am Monatende</span>

                                        </div>
                                        <div class="text-center text-lg font-bold basis-1/6">
                                            <span class='{{ $counterMeter->einheit=='(m³)' ? 'text-red-800 ' : 'text-green-600 ' }}">'>
                                                {{ $singleCounterMeter->StandDisplay. " ".  $singleCounterMeter->einheit}}
                                            </span>
                                        </div>
                                    </div> --}}
                                    <div class="mt-2 mb-1 min-w-min m-auto text-center border-2 rounded-md bg-sky-100">
                                        <a href="{{route('user.occupantVerbrauchsinfoCounterMetersReading', ['occupant_id' => $occupant,'id' => $singleCounterMeter->nekoId])}}" class="relative items-center justify-center flex-1 w-0 text-sm font-medium text-gray-700 border border-transparent rounded-br-lg hover:text-gray-500">
                                            {{-- <span class="">Stände</span>  --}}
                                            <i class="text-xl text-green-400 fa-regular fa-chart-mixed"></i>
                                        </a>
                                    </div>
                                </div>
                                {{-- Button --}}
                                
                            </div>
                        </div>
                    </div>
                    {{-- big screen website --}}

                    {{--end big screen website --}}
                    @endforeach
                </div>
                @endforeach
            @endif
        </div>
        @if ($rows->count()==0)
            <div class="flex items-center justify-center space-x-2 bg-sky-100">
                <span class="py-8 text-xl font-medium text-cool-gray-400">nichts gefunden...</span>
            </div>
        @endif
    </div>
</div>


