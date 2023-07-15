<div class="w-full px-4 py-1 mx-auto max-w-7xl sm:px-6 lg:px-8 ">
    @if ($nutzeinheiten->count()!=0)
        @foreach ($nutzeinheiten as $nutzeinheit)

        <div class="flex items-center py-3 md:justify-center sm:px-5">
            {{-- pokazac ostatniego lokatora mieszkania --}}
            <div class="text-sm ">
                <livewire:user.occupant.header :occupant='$this->lastOccupant($nutzeinheit->nutzeinheitNo)' key="{{ now() }}"/>
            </div>
            <div class="">
        {{--    <livewire:user.realestate.verbrauchsinfo-user-email.detail-input :occupant='$this->lastOccupant($nutzeinheit->nutzeinheitNo)' key="{{ now() }}"/>--}}
            </div>
        </div>
        
        
        @forelse ($this->getUserEmailsForNutzeinheitNo($nutzeinheit->nutzeinheitNo) as $userEmail)
        {{-- pokazac wiersze email-ow --}}
        <div>
            <livewire:user.realestate.verbrauchsinfo-user-email.listitem  :userEmail='$userEmail' :wire:key="'verbrauchsinfo-user-email-listitem-'.$userEmail->id"  key="{{ now() }}"/>
        </div>

        @endforeach
       

        @endforeach

    @else
    {{-- pokazac komunikat 'brak wierszy' --}}
    @endif

    {{-- modyfikacja wiersza modal --}}
    <div class="xs:max-w-xs xs:w-xs">
        <!-- Save Cost Modal -->
        <div>
            <livewire:user.realestate.verbrauchsinfo-user-email.detail :wire:key="'modal-realestate-verbrauchsinfo-user-email-detail'"/>
        </div>
        <div class="">
            <livewire:user.dialog.delete-modal :wire:key="'modal-realestate-verbrauchsinfo-user-email-delete'"/>            
        </div>


        <!-- Delete CostAmount Modal -->
       {{--  <div class="{{ $showDeleteCostAmountModal ? 'visible' : 'invisible' }}">
            <form wire:submit.prevent="deleteCostAmountModal({{ $current }})">
                <x-modal.dialog class="bg-sky-50" minWidth="640px" maxWidth="800px" wire:model.defer="showDeleteCostAmountModal">
                    <!-- Dialog Title -->
                    <x-slot name="title">
                        <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full">
                            <i class="text-red-800 fa-solid fa-trash-can"></i>
                        </div>
                    </x-slot>
                    <!-- Dialog Content -->
                    <x-slot name="content">
                        <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Eintrag wirklich löschen</h3>
                        </div>
                    </x-slot>
                    <x-slot name="footer">
                        <x-button.secondary wire:click="$set('showDeleteCostAmountModal', false)">Abbrechen</x-button.secondary>
                        <x-button.delete type="submit">Löschen</x-button.delete>
                    </x-slot>
                </x-modal.dialog>
            </form>
        </div> --}}
    </div>



</div>
