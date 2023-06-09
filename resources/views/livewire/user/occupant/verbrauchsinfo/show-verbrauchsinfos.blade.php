<div class="max-w-7xl w-full mx-auto py-1 px-4 sm:px-6 lg:px-8">
    <h3 class="flex-1 line-clamp-1 text-gray-900 truncate text-xl  text- md:font-bold md:text-md">{{ $occupant->lage. '-'. $occupant->nachname. ' '}}</h3>
    <p>{{ $occupant->street.',  '. $occupant->postcode. ' '. $occupant->city }}</p>
    <div>
        <x-input.search wire:model.debounce.2000="filter"/>
    </div>
   <div >
       <div class="mt-16">
           @if ($nutzergruppen->count()!=0)

           @foreach ($nutzergruppen as $verbrauchsinfo)
           <div class="my-6 max-w-1/4  bg-white shadow-md  divide-gray-200 rounded-lg">
            <div class=" md:font-bold text-center text-xl mb-5">
                       {{ $verbrauchsinfo->nutzergrup_name }}
                   </div>
                   <div class= "flex flex-row justify-between items-center ">
                    <div class="basis-1/6 text-center  md:font-bold">
                        Monat
                       </div>
                       <div class="basis-1/6 text-center md:font-bold">
                        verbrauch aktuell
                       </div>
                       <div class="basis-1/6 text-center md:font-bold">
                        verbrauch Vorjahr
                       </div>
                       <div class="basis-1/6 text-center md:font-bold">
                        einheit
                       </div>
                   </div>    @forelse ($this->getVerbrauchsinfosByNutzergrupe($verbrauchsinfo->nutzergrup_id) as $singleVerbrauchsinfo)
                       <div class= "flex flex-row justify-between items-center m-1">
                        <div class="basis-1/6  text-center mt-2">
                            {{ $singleVerbrauchsinfo->zeitraum_akt}}
                           </div>
                           <div class="basis-1/6  text-center mt-2">
                            {{ $singleVerbrauchsinfo->verbrauch_akt}}
                           </div>
                           <div class="basis-1/6  text-center mt-2">
                            {{ $singleVerbrauchsinfo->verbrauch_vorj}}
                           </div>
                           <div class="basis-1/6  text-center mt-2">
                            {{ $singleVerbrauchsinfo->einheit}}
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
