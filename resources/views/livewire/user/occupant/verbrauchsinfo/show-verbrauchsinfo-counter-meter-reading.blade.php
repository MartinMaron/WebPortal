<div class="w-full px-4 py-1 mx-auto max-w-7xl sm:px-6 lg:px-8">

    <livewire:user.occupant.occupant-header :occupant='$occupant'/>

    @if ($rows->count()!=0)
        <div class="">{{ $rows->first()->nr }}
        </div>
    @endif

    <div class="mt-16 sm:hidden">
        <div class="mb-5 text-xl font-bold text-center border-b-2 border-sky-400">
            Stände anzeigen {{ $rows->first()->einh->caption }}
        </div>

            @if ($rows->count()!=0)
                <div class= "border-2 rounded-t-lg bg-sky-100 border-sky-100 ">
                    <div class="flex flex-row justify-between mt-2 text-xs font-semibold items-center text-center ">
                        <div class="basis-1/5">
                            Monat 
                        </div>
                        <div class="basis-1/5">
                            {{ 'Ende' }} 
                        </div>
                        -
                        <div class="basis-1/5">
                            Anfang 
                        </div>
                        x
                        <div class="basis-1/5">
                            Faktor 
                        </div>
                        =
                        <div class="basis-1/5">
                            Verbrauch 
                        </div>
                    </div>
                </div>
                <div class="border-2 rounded-b-lg border-sky-100">

                    @foreach ($rows as $counterMeter)
                    <div class= "flex flex-row mt-2 text-center justify-between text-xs">
                        <div class="basis-1/5">
                            {{ $counterMeter->zeitraum_akt }}
                        </div>
                        <div class="basis-1/5">
                            {{ $counterMeter->stand_anfang }}
                        </div>
                        <div class="basis-1/5">
                            {{ $counterMeter->stand_ende }}
                        </div>
                        <div class="basis-1/5">
                            {{ $counterMeter->faktor }}
                        </div>
                        <div class="basis-1/5">
                            {{ $counterMeter->VerbrauchAktDisplay }}
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    @if ($rows->count()==0)
        <div class="flex items-center justify-center space-x-2 bg-sky-100">
            <span class="py-8 text-xl font-medium text-cool-gray-400">nichts gefunden...</span>
        </div>
    @endif  
</div>
