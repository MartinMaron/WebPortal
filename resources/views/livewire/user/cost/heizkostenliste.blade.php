<div>
    <!-- Main -->
    <div class="max-w-7xl w-full mx-auto sm:px-1 lg:px-1 m-0 mb-48">
        <div class="text-3xl pt-3 font-extrabold text-sky-800 text-center w-full flex m-8">
            <div class="basis-2/12"></div>
            <div class="basis-8/12">WEITERE - HEIZKOSTEN</div>
            <div class="basis-2/12 text-right mr-10">
                <button wire:click="raise_AddCostModal({{ $current }})"
                tabindex="-1">
                <i class="fa-regular fa-circle-plus text-3xl text-sky-600" ></i>
            </button>
            </div>
        </div>
        <!-- Überschrift -->
        <div class="flex flex-row items-center justify-start border-b-2 border-gray-800 bg-sky-50  font-semibold">
            <div class="basis-2/3 flex text-center items-center">
                <div 
                    class="basis-2/3 text-left px-2 flex rounded-md "
                    tabindex="-1">
                    <span class="py-1 text-right line-clamp-1">Kostenbezeichnung</span>
                </div>

                <div class="basis-1/3 rounded-md">
                    <span class="line-clamp-1">Bearbeitungshinweis</span>
                </div>
           </div>
            <div class="basis-1/3 flex gap-2 text-center">
                <div class="basis-1/3">
                    @if ($this->hasConsumptionByType('BEK'))
                       <span class="">Verbrauch</span>
                    @endif
                </div>
                <div class="basis-1/3">
                    @if ($this->hasHaushaltsnahByType('BEK'))
                        <div class="">
                        <span class="">§ 35c EStG</span>
                        </div>
                    @endif
                </div>
                <div class="basis-1/3">
                    @if ($this->realestate->eingabeCostNetto)
                        <span class="">Nettobetrag</span>
                    @else
                        <span class="">Betrag</span>
                    @endif
                </div>
            </div>
        </div>
        <!-- liste der Kosten -->
        @forelse ($costtypes as $costtype)
            <div class="">
                {{ $costtype->costtype_id}}
            </div> 
            @forelse ($this->getCostByType($costtype->costtype_id) as $cost)
                <div class="">
                    <livewire:user.costamount.detail-input :cost='$cost' :netto='false' :inputWithDatum='false' :wire:key="'list-cost-costamountinput-'.$cost->id" key="{{ now() }}"/>
                </div>
            @empty
                <div class="flex justify-center items-center space-x-2 bg-sky-100">
                    <span class="font-medium py-8 text-cool-gray-400 text-xl">nichts gefunden...</span>
                </div>
            @endforelse
        @empty
            <div class="flex justify-center items-center space-x-2 bg-sky-100">
                <span class="font-medium py-8 text-cool-gray-400 text-xl">nichts gefunden...</span>
            </div>
        @endforelse
    </div>
    <div class="xs:max-w-xs xs:w-xs">
        <!-- Save Cost Modal -->
        <div>
            <livewire:user.cost.detail :cost='$current' :netAmountInput='$nettoInputMode' :costinvoicingtype="'HZ'" :wire:key="'modal-realestate-cost-detail'"/>
        </div>
        <div>
            <livewire:user.costamount.detail :wire:key="'modal-realestate-costamount-detail'"/>
        </div>
        <!-- Delete CostAmount Modal -->
        <div class="{{ $showDeleteCostAmountModal ? 'visible' : 'invisible' }}">
            <form wire:submit.prevent="deleteCostAmountModal({{ $current }})">
                <x-modal.dialog class="bg-sky-50" minWidth="640px" maxWidth="800px" wire:model.defer="showDeleteCostAmountModal">
                    <!-- Dialog Title -->
                    <x-slot name="title">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                            <i class="text-red-800 fa-solid fa-trash-can"></i>
                        </div>
                    </x-slot>
                    <!-- Dialog Content -->
                    <x-slot name="content">
                        <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Eintrag wirklich löschen</h3>
                        </div>
                    </x-slot>
                    <x-slot name="footer">
                        <x-button.secondary wire:click="$set('showDeleteCostAmountModal', false)">Abbrechen</x-button.secondary>
                        <x-button.delete type="submit">Löschen</x-button.delete>
                    </x-slot>
                </x-modal.dialog>
            </form>
        </div>
    </div>
</div>





