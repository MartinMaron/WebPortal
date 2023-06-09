<div>
    <div class="mt-6 w-full">
        @if ($rows->count()!=0)
            @foreach ($rows as $verbrauchsinfo)
            <div class="mt-6 {{ $verbrauchsinfo->ww ? 'border-y-2 border-red-600' : 'border-y-2 border-green-400' }} selection:items-center justify-between w-full p-2 ">
                <div class="flex-1 text-center font-semibold {{ $verbrauchsinfo->ww ? 'text-red-800 ' : 'text-green-600 ' }} ">
                    {{ $verbrauchsinfo->art. ' im '. $verbrauchsinfo->zeitraum_akt}}
                </div>    
                <div class="flex-1 py-3 text-center font-semibold  ">
                    Verbrauchswerte
                </div> 
                <div class="w-full grid gap-4 sx:grid-cols-3">
                    <div class="flex justify-between">
                        <div class="">
                            <div class="flex-1 text-sm text-gray-600 underline text-center"> {{ $verbrauchsinfo->zeitraum_akt}} </div>
                            <div class="flex-1 text-center"> {{ $verbrauchsinfo->verbrauch_akt_display}} </div>
                        </div> 
                        <div class="">
                            <div class="flex-1 text-sm text-gray-600 underline text-center"> {{ $verbrauchsinfo->zeitraum_mon}} </div>
                            <div class="flex-1 text-center"> {{ $verbrauchsinfo->verbrauch_mon_display}} </div>
                         </div> 
                        <div class="">
                            <div class="flex-1 text-sm text-gray-600 underline text-center"> {{ $verbrauchsinfo->zeitraum_vorj}} </div>
                            <div class="flex-1 text-center"> {{ $verbrauchsinfo->verbrauch_vorj_display}} </div>
                          </div>                
                    </div>
                </div>
                <div class="flex-1  pt-3 text-center font-semibold  ">
                    Gebäudedurchschnitt
                </div>
                <div class="flex-1 text-center">
                    {{ $verbrauchsinfo->durchschnitt_display }}           
                </div>
            </div>
            
            @endforeach
            <a href="{{route('user.occupantVerbrauchsinfoCounterMeters', ['occupant_id' => $occupant, 'jahr_monat' => '2023-6'])}}" class="relative inline-flex items-center justify-center flex-1 w-0 py-4 text-sm font-medium text-gray-700 border border-transparent rounded-br-lg hover:text-gray-500">
                <i class="text-lg fad fa-home"></i>
                <span class="ml-3">zähler anzeigen</span>
            </a>
        @endif  
    </div>
    @if ($rows->count()==0)
        <div class="flex justify-center items-center space-x-2 bg-sky-100">
            <span class="font-medium py-8 text-cool-gray-400 text-xl">nichts gefunden...</span>
        </div>
    @endif 
    
   

</div>
