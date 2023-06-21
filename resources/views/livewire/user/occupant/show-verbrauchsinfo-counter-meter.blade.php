<div class="w-full px-4 py-1 mx-auto max-w-7xl sm:px-6 lg:px-8 sm:hidden">
    <livewire:occupants-show :occupant='$occupant'/>
        <x-input.search wire:model.debounce.2000="filter"/>
    </div>
    <div >
        <div>
            @if ($nutzergruppen->count()!=0)
<<<<<<< Updated upstream

            <div class="pb-4 mt-16 sm:hidden max-w-sm">
                <div class="mb-5 text-xl font-bold text-center border-b-2 border-sky-400">
=======
   
            <div class="pb-4 mt-16 sm:hidden">
                <div class="mb-5 text-xl font-bold text-center">
>>>>>>> Stashed changes
                    Zähler anzeigen
                </div>
            @foreach ($nutzergruppen as $counterMeter)
            <div class="flex justify-center max-w-sm">
                <div class="mb-1 text-lg font-bold {{ $counterMeter->einheit=='(m³)' ? 'text-red-800 ' : 'text-green-600 ' }}">
                    {{ $counterMeter->nutzergrup_name }}
                        -
                    </div>
                    <span wire:click="sortBy(funkNr)" class="ml-2">
                        <i class="fa-solid fa-sort fa-sm mt-3 {{ $sortColumnName === 'name' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                    </span>
            </div>
                    </div>    @forelse ($this->getCounterMetersByNutzergrupe($counterMeter->nutzergrup_id) as $singleCounterMeter)
                        <div class= "items-center m-1 sm:hidden max-w-sm">
                            <div class="pb-4">
                             <div class="mt-2 text-sm font-bold text-center border-2 rounded-t-lg bg-sky-100 border-sky-100 basis-1/6">
                        <div class="justify-center">
                            <div class="mt-2 basis-1/6">
                                Nummer  (Funknummer)
                            </div>
                        </div>
                        <div class="flex justify-center pb-2">
                            <div class="mt-2 basis-1/6">
                                {{ $singleCounterMeter->nr }}
                            </div>
                        <div class="mt-2 basis-1/6">
                                ({{$singleCounterMeter->funkNr}})
                            </div>
                                </div></div>

                        <div class="text-sm border-2 rounded-b-lg border-sky-100">

                        <div class="grid grid-cols-2 justify-center">
                            <div class="mt-1 mr-4">
                                <div class="text-center basis-1/6">
                                    <span class="font-thin text-xs ">mon. Verbrauch</span>
                                </div>
                                <div class="text-center text-lg font-bold basis-1/6">
                                    <span class="{{ $counterMeter->einheit=='(m³)' ? 'text-red-800 ' : 'text-green-600 ' }}">
                                {{ $singleCounterMeter->verbrauch_akt }}
                                    </span>
                                    <span class="{{ $counterMeter->einheit=='(m³)' ? 'text-red-600 ' : 'text-green-400 ' }}">
                                {{ $singleCounterMeter->einheit}}
                                    </span>
                                </div>
                            </div>

                            <div class="mt-1 mr-5">
                                <div class="text-center basis-1/6">
                                    <span class="font-thin text-xs ">Stand am Ende des Monats</span>
                                </div>
                                <div class="text-center text-lg font-bold basis-1/6"">
                                    <span class="{{ $counterMeter->einheit=='(m³)' ? 'text-red-800 ' : 'text-green-600 ' }}">
                                {{ $singleCounterMeter->stand }}
                                    </span>
                                    <span class="{{ $counterMeter->einheit=='(m³)' ? 'text-red-600 ' : 'text-green-400 ' }}">
                                {{ $singleCounterMeter->einheit}}
                                    </span>
                                </div>
                            </div>

                        </div>
                          <div class="flex-row justify-center mt-2 mb-4 ml-24 text-center border-2 rounded-md w-44 bg-sky-100">
                            <a href="{{route('user.occupantVerbrauchsinfoCounterMetersReading', ['occupant_id' => $occupant,'id' => $singleCounterMeter->nekoId])}}" class="relative items-center justify-center flex-1 w-0 text-sm font-medium text-gray-700 border border-transparent rounded-br-lg hover:text-gray-500">
                                <span class="">Stände anzeigen</span>
                            </a>
                        </div>

                        </div>
                            </div>
                        </div>

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
