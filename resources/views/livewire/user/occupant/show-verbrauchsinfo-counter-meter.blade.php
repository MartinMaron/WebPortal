<div class="w-full px-4 py-1 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="flex-1 text-xl text-gray-900 truncate line-clamp-1 text- md:font-bold md:text-md">{{ $occupant->lage. '-'. $occupant->nachname. ' '}}</div>
    <div>{{ $occupant->street.',  '. $occupant->postcode. ' '. $occupant->city }}</div>
    <div>
        <x-input.search wire:model.debounce.2000="filter"/>
    </div>
    <div >
        <div>
            @if ($nutzergruppen->count()!=0)
   
            <div class="pb-4 mt-16">
                <div class="mb-5 text-xl font-bold text-center">
                    Zähler anzeigen
                </div>
            @foreach ($nutzergruppen as $counterMeter)
            <div class="flex justify-center">    
                <div class="text-sm font-bold">
                        {{ $counterMeter->nutzergrup_name }}
                        -
                    </div>  
                    <div class="mb-5 text-sm font-bold">
                        {{ $counterMeter->einheit }}
                    </div>
            
            </div>                    
                    </div>    @forelse ($this->getCounterMetersByNutzergrupe($counterMeter->nutzergrup_id) as $singleCounterMeter)
                        <div class= "items-center justify-between m-1 sm:hidden">
                            <div class="pb-4">
                             <div class="mt-2 text-sm font-bold text-center border-2 rounded-t-lg bg-sky-100 border-sky-100 basis-1/6">
                        <div class="justify-center">
                            <div class="mt-2 basis-1/6">
                                Nummer  (Funknummer)
                            </div>

                                </div>
                                
                                <div class="flex justify-center">
                            <div class="mt-2 basis-1/6">
                                {{ $singleCounterMeter->nr }}
                            </div>
                            <div class="mt-2 basis-1/6">
                                ({{$singleCounterMeter->funkNr}})
                            </div>
                                </div></div>
        
                                <div class="text-sm border-2 rounded-b-lg border-sky-100">
                            
                            <div class="flex justify-around">
                            <div class="mt-2 text-center">
                            <div class="font-bold basis-1/2">
                                mon. Verbrauch
                            </div>
                            <div class="mt-2 basis-1/6">
                                {{ $singleCounterMeter->verbrauch_akt }}
                            </div>
                            </div>

                            <div class="mt-2 text-center">
                                <div class="font-bold basis-1/2">
                                Stand am Ende des Monats
                            </div>
                            <div class="mt-2 basis-1/6">
                                {{ $singleCounterMeter->stand }}
                            </div>
                                </div></div>

                          <div class="mt-2 mb-4 ml-20 text-center border-2 rounded-md w-44 bg-sky-100">
                            <a href="{{route('user.occupantVerbrauchsinfoCounterMetersReading', ['occupant_id' => $occupant,'id' => $singleCounterMeter->nekoId])}}" class="relative items-center justify-center flex-1 w-0 text-sm font-medium text-gray-700 border border-transparent rounded-br-lg hover:text-gray-500">
                                <span class="">Stände anzeigen</span>
                            </a>
                        </div>

                        </div></div></div>

                        <div class="hidden md:visible text-md">
                            
                       <div class>     
                        dededededede
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
