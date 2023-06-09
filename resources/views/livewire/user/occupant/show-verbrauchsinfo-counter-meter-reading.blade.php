<div class="max-w-7xl w-full mx-auto py-1 px-4 sm:px-6 lg:px-8">
    <h3 class="flex-1 line-clamp-1 text-gray-900 truncate text-xl  text- md:font-bold md:text-md">{{ $occupant->lage. '-'. $occupant->nachname. ' '}}</h3>
    <p>{{ $occupant->street.',  '. $occupant->postcode. ' '. $occupant->city }}</p>

    @if ($rows->count()!=0)
        <div class="">{{ $rows->first()->nr }}
        </div>
    @endif

    <div >
        <div class="my-6 max-w-1/4  bg-white shadow-md  divide-gray-200 rounded-lg">
            @if ($rows->count()!=0)
            <div class= "flex flex-row  items-center ">
                <div class="basis-1/6 text-center  md:font-bold">
                    Datum
                </div>
                <div class="basis-1/6 text-center  md:font-bold">
                    Stand
                </div>
                <div class="basis-1/6 text-center  md:font-bold">
                    Einheit
                </div>
            </div>

                @foreach ($rows as $counterMeter)
                <div class= "flex flex-row  items-center ">
                    <div class="basis-1/6  text-center mt-2">
                        {{ '01 '.$counterMeter->zeitraum_akt }}
                </div>
                <div class="basis-1/6  text-center mt-2">
                    {{ $counterMeter->stand }}
                </div>
                <div class="basis-1/6  text-center mt-2">
                    {{ $counterMeter->einheit }}
                </div>

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
