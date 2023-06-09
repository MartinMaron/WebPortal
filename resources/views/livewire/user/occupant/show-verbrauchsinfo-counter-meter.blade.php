<div class="max-w-7xl w-full mx-auto py-1 px-4 sm:px-6 lg:px-8">
    {{ $occupant->NutzerKennnummer. '  -  '. $jahr_monat }}
    <div>
        <x-input.search wire:model.debounce.2000="filter"/>
    </div>
    <div >
        <div class="mt-16">
            @if ($nutzergruppen->count()!=0)

            @foreach ($nutzergruppen as $counterMeter)
                <div class="my-6">
                    <div class="my-2">
                        {{ $counterMeter->nutzergrup_name }}
                    </div>
                    <div class= "flex flex-row  items-center ">
                        <div class="basis-1/6">
                            Nummer
                        </div>
                        <div class="basis-1/6">
                            Funknummer
                        </div>
                        <div class="basis-1/6">
                            mon. Verbrauch
                        </div>
                        <div class="basis-1/6">
                            Stand am Ende des Monats
                        </div>
                        <div class="basis-1/6">
                            Einheit
                        </div>
                        <div class="basis-1/6">

                        </div>
                    </div>    @forelse ($this->getCounterMetersByNutzergrupe($counterMeter->nutzergrup_id) as $singleCounterMeter)
                        <div class= "flex flex-row  items-center m-1">
                            <div class="basis-1/6">
                                {{ $singleCounterMeter->nr }}
                            </div>
                            <div class="basis-1/6">
                                {{ $singleCounterMeter->funkNr}}
                            </div>
                            <div class="basis-1/6">
                                {{ $singleCounterMeter->verbrauch_akt }}
                            </div>
                            <div class="basis-1/6">
                                {{ $singleCounterMeter->stand }}
                            </div>
                            <div class="basis-1/6">
                                {{ $singleCounterMeter->einheit }}
                            </div>
                            <div class="basis-1/6 border-2 rounded-md text-center">
                                <a href="{{route('user.occupantVerbrauchsinfoCounterMetersReading', ['occupant_id' => $occupant,'id' => $singleCounterMeter->nekoId])}}" class="relative items-center justify-center flex-1 w-0 text-sm font-medium text-gray-700 border border-transparent rounded-br-lg hover:text-gray-500">
                                    <span class="">Stände anzeigen</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endforeach
            @endif
        </div>
        @if ($rows->count()==0)
            <div class="flex justify-center items-center space-x-2 bg-sky-100">
                <span class="font-medium py-8 text-cool-gray-400 text-xl">nichts gefunden...</span>
            </div>
        @endif
    </div>
</div>
