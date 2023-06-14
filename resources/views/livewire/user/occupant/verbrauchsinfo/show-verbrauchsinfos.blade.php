<div class="w-full px-4 py-1 mx-auto max-w-7xl sm:px-6 lg:px-8 sm:hidden">
    <livewire:user.occupant.occupant-header  :occupant='$occupant'/>
        <x-input.search wire:model.debounce.2000="filter"/>
    </div>

    @if ($nutzergruppen->count()!=0)

    <div class="pb-4 mt-16 sm:hidden">
            <div class="mb-5 text-xl font-bold text-center border-b-2 border-sky-400">
            VERLAUF DER VERBRÄUCHE
            </div>
            @foreach ($nutzergruppen as $verbrauchsinfo)
            <div class="flex justify-center">
                <div class="mb-1 text-lg font-bold {{ $verbrauchsinfo->ww ? 'text-red-800 ' : 'text-green-600 ' }}">
                {{ $verbrauchsinfo->nutzergrup_name}}
                -
                </div>
                
            </div>

                @forelse ($this->getVerbrauchsinfosByNutzergrupe($verbrauchsinfo->nutzergrup_id) as $singleVerbrauchsinfo)

                <!--loyal websites small screens-->

                <div class= "pb-4 m-1 sm:hidden">

                    <div class="text-sm font-bold text-center border-2 rounded-t-lg sm:flex-1 bg-sky-100 border-sky-100 basis-1/6">
                        <div class="basis-1/2">
                            {{ $singleVerbrauchsinfo->zeitraum_akt}}
                            <div class="inline-block align-bottom">
                                <x-icon.fonts.sort class="text-gray-600 pl-2"></x-icon.fonts.sort>
                            </div>
                        </div>
                    </div>

                    <div class="text-sm border-2 rounded-b-lg border-sky-100">
                        <div class="flex justify-around mt-1 text-center">
                            <div class="basis-1/6">
                                <span class="font-thin text-xs ">Aktuell</span>
                            </div>
                            <div class="basis-1/6">
                                <span class="font-thin text-xs ">Vorjahr</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 pb-1 mt-1">
                            <div class="text-center text-lg font-bold basis-1/6">
                               <span class="{{ $singleVerbrauchsinfo->ww ? 'text-red-800 ' : 'text-green-600 ' }}">
                                   {{ $singleVerbrauchsinfo->VerbrauchAktDisplay}}
                               </span>
                               <span class="{{ $singleVerbrauchsinfo->ww ? 'text-red-800 ' : 'text-green-600 ' }}">
                                    {{ $singleVerbrauchsinfo->einheit->shortname}}
                                </span>
                            </div>
                        <div class="text-center text-lg font-bold basis-1/6">
                            <span class="{{ $singleVerbrauchsinfo->ww ? 'text-red-800 ' : 'text-green-600 ' }}">
                                {{ $singleVerbrauchsinfo->VerbrauchVorjDisplay}}
                            </span>
                            <span class="{{ $singleVerbrauchsinfo->ww ? 'text-red-800 ' : 'text-green-600 ' }}">
                                 {{ $singleVerbrauchsinfo->einheit->shortname}}
                             </span>
                        </div>
                        </div>
                    </div>
                </div>

                <!--end loyal websites small screens-->

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


















