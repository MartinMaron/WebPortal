<div class="w-full px-4 py-1 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="flex-1 text-xl text-gray-900 truncate line-clamp-1 text- md:font-bold md:text-md">{{ $occupant->lage. '-'. $occupant->nachname. ' '}}</div>
    <div>{{ $occupant->street.',  '. $occupant->postcode. ' '. $occupant->city }}</div>
    <div>
        <x-input.search wire:model.debounce.2000="filter"/>
    </div>
 
    @if ($nutzergruppen->count()!=0)
    
    <div class="pb-4 mt-16">
            <div class="mb-5 text-xl font-bold text-center">
            Verbräuche
            </div>
            @foreach ($nutzergruppen as $verbrauchsinfo)
            <div class="flex justify-center">    
                <div class="mb-5 text-sm font-bold">
                {{ $verbrauchsinfo->nutzergrup_name}}
                -
                </div>
                <div class="mb-5 text-sm font-bold">
                    {{ $verbrauchsinfo->einheit }}
                </div>
            </div>
            
                 @forelse ($this->getVerbrauchsinfosByNutzergrupe($verbrauchsinfo->nutzergrup_id) as $singleVerbrauchsinfo)
                <div class= "pb-4 m-1 sm:hidden">
                       
                    <div class="mt-2 text-sm font-bold text-center border-2 rounded-t-lg sm:flex-1 bg-sky-100 border-sky-100 basis-1/6">
                        <div class="mt-2 basis-1/2"> 
                            {{ $singleVerbrauchsinfo->zeitraum_akt}}
                        </div>
                    </div>   

                    <div class="text-sm border-2 rounded-b-lg border-sky-100">
                        <div class="flex justify-around mt-2 text-center">
                            <div class="font-bold basis-1/6">
                            Aktuell:
                            </div>
                            <div class="font-bold basis-1/6">
                            Vorjahr:
                            </div> 
                        </div>
                           
                        <div class="grid grid-cols-2 pb-2 mt-2">
                            <div class="text-center">
                            {{ $singleVerbrauchsinfo->verbrauch_akt}}
                            </div>
                            <div class="text-center">
                            {{ $singleVerbrauchsinfo->verbrauch_vorj}}
                            </div>
                        </div>
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
