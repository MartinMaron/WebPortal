        {{-- Duzy ekran --}}

<div class="hidden md:flex pt-1 text-lg text-center 
    {{ $singleCounterMeter->hk ? 'odd:bg-green-100 even:bg-green-50' :'even:bg-red-50 odd:bg-red-100'}} ">
    <div class="basis-1/5">
        <span class="">{{ $singleCounterMeter->nr }}</span>
    </div>
    <div class="basis-1/5">
        <span class="{{ $singleCounterMeter->nr == $singleCounterMeter->funkNr ? 'hidden' : 'visible' }} ">{{ $singleCounterMeter->funkNr }}</span>
    </div>
    <div class="basis-1/5">
        <span class="">{{ $singleCounterMeter->VerbrauchAktDisplay}}</span>
    </div>
    <div class="basis-1/5">
        <span class="">{{ $singleCounterMeter->einheit->shortname}}</span>
    </div>
    <div class="mb-1 basis-1/5">
        <a class="text-center border-2 rounded-md bg-sky-100" href="{{route('user.occupantVerbrauchsinfoCounterMetersReading', ['occupant_id' => $occupant,'id' => $singleCounterMeter->nekoId])}}" class="relative items-center justify-center flex-1 w-0 text-sm font-medium text-gray-700 border border-transparent rounded-br-lg hover:text-gray-500">
            {{-- <span class="">Stände</span>  --}}
            <i class="text-xl 
            {{ $singleCounterMeter->hk ? 'text-green-600': 'text-red-800' }} 
            fa-regular fa-chart-mixed"></i>
        </a>
    </div>
</div>    

<div>
</div>
{{-- maly ekran --}}
<div class= "items-center block m-1 sm:hidden">
    <div class="pb-4">
        <div class="mt-2 text-sm text-center border-2 rounded-t-lg bg-sky-100 border-sky-100">
            {{-- Nummer und Funknummer Header --}}
            <div class="flex justify-around my-1 ">
                <div class="flex justify-center">
                    <div class="inline-block align-bottom">
                        <span class="text-xs font-thin">Nr.: </span>
                    </div>
                    <div class="inline-block align-bottom">
                        <x-table.heading class="" 
                        sortable multi-column wire:click="sortBy('nr')" 
                        :direction="$sorts['nr'] ?? null">
                        <span class="text-sm font-bold">
                            {{ $singleCounterMeter->nr }}
                        </span>
                        </x-table.heading>
                    </div>
                </div>
                <div class="flex justify-center {{ $singleCounterMeter->nr == $singleCounterMeter->funkNr ? 'hidden' : 'visible' }}">
                    <div class="inline-block align-bottom">
                        <span class="text-xs font-thin">Funknr.: </span>
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
                <div class="justify-around mt-1 text-center">
                    {{-- <div class="basis-1/6">
                        <span class="text-xs font-thin ">mon. Verbrauch</span>
                    </div> --}}
                    <div class="text-lg font-bold text-center basis-1/6">
                        <span class='{{ $singleCounterMeter->ww ? 'text-red-800 ' : 'text-green-600 ' }}">'>
                            {{ $singleCounterMeter->VerbrauchAktDisplay. " ".  $singleCounterMeter->einheit->shortname}}
                        </span>
                    </div>
                </div>
                {{--  <div class="justify-around mt-1 text-center">
                    <div class="basis-1/6">
                        <span class="text-xs font-thin ">Stand am Monatende</span>

                    </div>
                    <div class="text-lg font-bold text-center basis-1/6">
                        <span class='{{ $counterMeter->einheit=='(m³)' ? 'text-red-800 ' : 'text-green-600 ' }}">'>
                            {{ $singleCounterMeter->StandDisplay. " ".  $singleCounterMeter->einheit}}
                        </span>
                    </div>
                </div> --}}
                <div class="m-auto mt-1 mb-1 text-center border-2 rounded-md min-w-min bg-sky-100">
                    <a href="{{route('user.occupantVerbrauchsinfoCounterMetersReading', ['occupant_id' => $occupant,'id' => $singleCounterMeter->nekoId])}}" class="relative items-center justify-center flex-1 w-0 text-sm font-medium text-gray-700 border border-transparent rounded-br-lg hover:text-gray-500">
                        {{-- <span class="">Stände</span>  --}}
                        <i class="text-xl 
                        {{ $singleCounterMeter->hk ? 'text-green-600': 'text-red-800' }} 
                        fa-regular fa-chart-mixed"></i>
                    </a>
                </div>
            </div>
            {{-- Button --}}

        </div>
    </div>
</div>
