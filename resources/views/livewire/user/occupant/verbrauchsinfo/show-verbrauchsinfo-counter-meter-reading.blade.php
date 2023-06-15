<div class="w-full px-4 py-1 mx-auto max-w-7xl sm:px-6 lg:px-8">

    <livewire:user.occupant.occupant-header :occupant='$occupant'/>

    @if ($rows->count()!=0)
        <div class="">{{ $rows->first()->nr }}
        </div>
    @endif

    <div class="mt-16 sm:hidden">
        <div class="mb-5 text-xl font-bold text-center border-b-2 border-sky-400">
            Stände anzeigen
        </div>

            @if ($rows->count()!=0)
            <div class= "border-2 rounded-t-lg bg-sky-100 border-sky-100 ">
               <div class="flex justify-around mt-2">
               <div class="flex">
                <div class="font-bold text-center basis-1/6">
                    Datum
               </div>
               <div class="ml-1">
               <i class="fa-solid fa-sort fa-sm mt-3"></i>
               </div>
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
                <div class= "flex">
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
