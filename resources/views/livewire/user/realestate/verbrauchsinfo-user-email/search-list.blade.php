<div class="w-full px-4 py-1 sm:px-6 lg:px-8 max-w-7xl ">
    <div class="font-bold text-lg sm:text-2xl mb-8 text-center hover:text-sky-700">
        hier können Sie eintragen an welche Emails die unterjährige Informationen versendet werden sollen            
    </div>    
    <div
            x-data="{open:true}"
            x-init="open=true"
        >
            <div class="flex items-center justify-center ">
                <button x-on:click="open = !open" class="font-bold hover:text-sky-700">Bearbeitungshinweise ansehen ...</button>
            </div>
            <div x-show="open" class="">
                <div class="block sm:flex sm:gap-3">
                <div class="block my-1 border border-b-2 border-gray-300 rounded-lg shadow-sm sm:basis-1/3 ">
                    <div class="items-center block m-2">
                        <div class="flex justify-start gap-3">
                            <x-icon.fonts.users-add class="fa-md sm:fa-2xl text-sky-700"></x-icon.fonts.users>
                            <span class="font-semibold text-gray-900 text-md">Neue Emailadresse hinzufügen</span>
                        </div>
                        <div class="text-xs text-gray-500 line-clamp-4 md:line-clamp-2">über diesen Button können Sie neue Email eintragen an welche die Verbraucherinformationen übermittelt werden</div>
                    </div>
                </div>
                <div class="block my-1 border border-b-2 border-gray-300 rounded-lg shadow-sm sm:basis-1/3 ">
                    <div class="items-center block m-2">
                        <div class="flex justify-start gap-3">
                            <x-icon.fonts.pencil class="fa-md sm:fa-2xl text-sky-700"></x-icon.fonts.users>
                            <span class="font-semibold text-gray-900 text-md">Emailadresse bearbeiten</span>
                        </div>
                        <div class="text-xs text-gray-500 line-clamp-4 md:line-clamp-2">über diesen Button können Sie vorhandene Email bearbeiten</div>
                    </div>
                </div>
                <div class="block my-1 border border-b-2 border-gray-300 rounded-lg shadow-sm sm:basis-1/3 ">
                    <div class="items-center block m-2">
                        <div class="flex justify-start gap-3">
                            <x-icon.fonts.trash class="fa-md sm:fa-2xl text-sky-700"></x-icon.fonts.trash>
                            <span class="font-semibold text-gray-900 text-md">Emailadresse löschen</span>
                        </div>
                        <div class="text-xs text-gray-500 line-clamp-4 md:line-clamp-2">über diesen Button können Sie vorhandene Email löschen</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex">
            <x-input.search wire:model.debounce.600ms="filter.search"></x-input.search>
        </div>
        @if ($occupants->count()!=0)
       
        @foreach ($occupants as $occupant)
            <div class="block my-1 border border-b-2 border-gray-300 rounded-lg shadow-sm ">
                    <div class="flex items-center py-3 md:justify-center">
                        {{-- pokazac ostatniego lokatora mieszkania --}}
                        <div class="text-sm">
                            <livewire:user.occupant.occupant-header :occupant='$occupant' key="{{ now() }}"/>
                        </div>
                    </div>

                    @forelse ($occupant->verbrauchsinfoUserEmails as $userEmail)
                        @if (!$userEmail->anonym)
                        <div>
                            <livewire:user.realestate.verbrauchsinfo-user-email.listitem  :userEmail='$userEmail' :wire:key="'verbrauchsinfo-user-email-listitem-'.$userEmail->id"  key="{{ now() }}"/>
                        </div>
                        @endif   
                    @endforeach
                        @if ($occupant->verbrauchsinfoUserEmails->where('anonym','=','0')->count() != 0)
                        <div class="flex items-center py-3 md:justify-center">
                            <x-button.verbrauchsinfo 
                            class="text-red-600"
                            wire:click='raise_CreateVerbrauchsinfoUserEmailModal({{$occupant}})'
                            >
                               weitere Emails hinzufügen   
                            </x-button.verbrauchsinfo>
                        </div>
                        @else
                        <div class="flex items-center py-3 md:justify-center">
                            <x-button.verbrauchsinfo 
                            class="text-red-600"
                            wire:click='raise_CreateVerbrauchsinfoUserEmailModal({{$occupant}})'
                            >
                                hinzufügen   
                            </x-button.verbrauchsinfo>
                        </div>
                    @endif
            </div>
        @endforeach

        @else
        {{-- pokazac komunikat 'brak wierszy' --}}
        @endif

        {{-- modyfikacja wiersza modal --}}
        <div class="xs:max-w-xs xs:w-xs">
            <!-- Save Modal -->
            <div>
                <livewire:user.realestate.verbrauchsinfo-user-email.detail :wire:key="'modal-realestate-verbrauchsinfo-user-email-detail'"/>
            </div>
            <div class="">
                <livewire:user.dialog.delete-modal :wire:key="'modal-realestate-verbrauchsinfo-user-email-delete'"/>
            </div>



        </div>
        {{-- <div class="mt-6 my-5">
            {{ $occupants->onEachSide(2)->links() }}
        </div> --}}
</div>
