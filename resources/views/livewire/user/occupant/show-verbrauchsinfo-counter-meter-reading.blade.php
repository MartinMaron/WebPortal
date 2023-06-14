<div class="w-full px-4 py-1 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <h3 class="flex-1 text-xl text-gray-900 truncate line-clamp-1 text- md:font-bold md:text-md">{{ $occupant->lage. '-'. $occupant->nachname. ' '}}</h3>
    <p>{{ $occupant->street.',  '. $occupant->postcode. ' '. $occupant->city }}</p>

    @if ($rows->count()!=0)
        <div class="">{{ $rows->first()->nr }}
        </div>
    @endif

    <div class="mt-16 sm:hidden">
        <div class="mb-5 text-xl font-bold text-center">
            Stände anzeigen
        </div>

            @if ($rows->count()!=0)
            <div class= "border-2 rounded-t-lg bg-sky-100 border-sky-100 ">
               <div class="flex justify-around mt-2">
                <div class="font-bold text-center basis-1/6">
                    Datum
                </div>
                <div class="font-bold text-center basis-1/6">
                    Stand
                </div>
                <div class="font-bold text-center basis-1/6">
                    Einheit
                </div>
               </div>
            </div>
            <div class="border-2 rounded-b-lg border-sky-100">

                @foreach ($rows as $counterMeter)
                <div class= "flex justify-around">
                    <div class="mt-2 text-center basis-1/2">
                        {{ '01 '.$counterMeter->zeitraum_akt }}
                </div>
                <div class="mt-2 text-center basis-1/2">
                    {{ $counterMeter->stand }}
                </div>
                <div class="mt-2 text-center basis-1/2">
                    {{ $counterMeter->einheit }}
                </div>

            </div>
                @endforeach
            @endif
        </div></div>
        @if ($rows->count()==0)
            <div class="flex items-center justify-center space-x-2 bg-sky-100">
                <span class="py-8 text-xl font-medium text-cool-gray-400">nichts gefunden...</span>
            </div>
        @endif
    </div>
</div>
