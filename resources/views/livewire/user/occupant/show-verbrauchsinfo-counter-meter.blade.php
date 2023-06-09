<div class="max-w-7xl w-full mx-auto py-1 px-4 sm:px-6 lg:px-8">
    <h3 class="flex-1 line-clamp-1 text-gray-900 truncate text-xl  text- md:font-bold md:text-md">{{ $occupant->lage. '-'. $occupant->nachname. ' '}}</h3>
    <p>{{ $occupant->street.',  '. $occupant->postcode. ' '. $occupant->city }}</p>
    <div>
        <x-input.search wire:model.debounce.2000="filter"/>
    </div>
    <div >
        <div>
            @if ($nutzergruppen->count()!=0)

            @foreach ($nutzergruppen as $counterMeter)
                <div class="my-6 max-w-1/4  bg-white shadow-md  divide-gray-200 rounded-lg">
                    <div class=" md:font-bold text-center text-xl mb-5">
                        {{ $counterMeter->nutzergrup_name }}
                    </div>
                    <div class= "flex flex-row justify-between items-center ">
                        <div class="basis-1/6 text-center  md:font-bold">
                            Nummer
                        </div>
                        <div class="basis-1/6 text-center  md:font-bold">
                            Funknummer
                        </div>
                        <div class="basis-1/6 text-center  md:font-bold">
                            mon. Verbrauch
                        </div>
                        <div class="basis-1/6 text-center  md:font-bold">
                            Stand am Ende des Monats
                        </div>
                        <div class="basis-1/6 text-center  md:font-bold">
                            Einheit
                        </div>
                        <div class="basis-1/6">

                        </div>
                    </div>    @forelse ($this->getCounterMetersByNutzergrupe($counterMeter->nutzergrup_id) as $singleCounterMeter)
                        <div class= "flex flex-row  items-center">
                            <div class="basis-1/6  text-center mt-2">
                                {{ $singleCounterMeter->nr }}
                            </div>
                            <div class="basis-1/6  text-center mt-2">
                                {{ $singleCounterMeter->funkNr}}
                            </div>
                            <div class="basis-1/6 text-center mt-2">
                                {{ $singleCounterMeter->verbrauch_akt }}
                            </div>
                            <div class="basis-1/6 text-center mt-2">
                                {{ $singleCounterMeter->stand }}
                            </div>
                            <div class="basis-1/6 text-center mt-2">
                                {{ $singleCounterMeter->einheit }}
                            </div>
                            <div class="basis-1/6 border-2 rounded-md text-center bg-sky-100 ml-5">
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
