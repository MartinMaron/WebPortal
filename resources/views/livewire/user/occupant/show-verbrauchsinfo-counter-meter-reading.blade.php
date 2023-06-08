<div class="max-w-lg w-full mx-auto py-1 px-4 sm:px-6 lg:px-8">
    <div class="">
            {{ $occupant->NutzerKennnummer. '-'. $occupant->lage. ' - '. $occupant->nachname }}
    </div>
    @if ($rows->count()!=0) 
        <div class="">{{ $rows->first()->nr }} 
        </div>
    @endif

    <div >
        <div class="mt-16"> 
            @if ($rows->count()!=0)
            <div class= "flex flex-row  items-center ">
                <div class="basis-2/5">
                    Datum
                </div>
                <div class="basis-2/5">
                    Stand
                </div>
                <div class="basis-1/5">
                    Einheit
                </div>
            </div>
               
                @foreach ($rows as $counterMeter)
                <div class= "flex flex-row  items-center ">
                    <div class="basis-2/5">
                    {{ '01 '.$counterMeter->zeitraum_akt }}
                </div>
                <div class="basis-2/5">
                    {{ $counterMeter->stand }}
                </div>
                <div class="basis-1/5">
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
