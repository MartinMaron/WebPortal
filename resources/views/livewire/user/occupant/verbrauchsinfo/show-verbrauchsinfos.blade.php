<div class="max-w-7xl w-full mx-auto py-1 px-4 sm:px-6 lg:px-8">
   {{ $occupant->NutzerKennnummer }}
   <div>
       <x-input.search wire:model.debounce.2000="filter"/>
   </div>
   <div >
       <div class="mt-16">
           @if ($nutzergruppen->count()!=0)

           @foreach ($nutzergruppen as $verbrauchsinfo)
               <div class="my-6">
                   <div class="my-2">
                       {{ $verbrauchsinfo->nutzergrup_name }}
                   </div>
                   <div class= "flex flex-row justify-between items-center ">
                       <div class="">
                           Monat
                       </div>
                       <div class="">
                           verbrauch aktuell
                       </div>
                       <div class="">
                           verbrauch Vorjahr
                       </div>
                       <div class="">
                           einheit
                       </div>
                   </div>    @forelse ($this->getVerbrauchsinfosByNutzergrupe($verbrauchsinfo->nutzergrup_id) as $singleVerbrauchsinfo)
                       <div class= "flex flex-row justify-between items-center m-1">
                           <div>
                               {{ $singleVerbrauchsinfo->zeitraum_akt}}
                           </div>
                           <div >
                               {{ $singleVerbrauchsinfo->verbrauch_akt}}
                           </div>
                           <div >
                               {{ $singleVerbrauchsinfo->verbrauch_vorj}}
                           </div>
                           <div>
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
