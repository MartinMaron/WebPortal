<div>
    <!-- Main -->
    <div class="max-w-7xl w-full sm:px-1 lg:px-1 mb-40 mx-auto kostenliste">
        <div class="flex items-center mt-3">
            <div class="basis-1/4"></div>
            <div class="basis-2/4 page-title">
                <div class="">WEITERE HEIZKOSTEN</div>
                @if ($this->realestate->abrechnungssetting->heizkostenlisteDone)
                    <div class="text-sm">Daten für ausgewählten Abrechnungszeitraum bereits an neko versendet !</div>
                @endif
            </div>
            <div class="basis-1/4 flex justify-end" wire:click="toggle('heizkostenlisteDone')">
                @if (! $this->realestate->abrechnungssetting->heizkostenlisteDone)
                    <x-button.complete-abr></x-button.complete-abr>
                @endif
            </div>
        </div>
        <div class="space-y-1 mt-4 columnheader pb-12 mb-28">
            <!-- Überschrift -->
            <div class="flex flex-row items-center">
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
            <div class="flex justify-between columnheader">
                <div class="flex justify-start items-center">
                    <button wire:click="raise_AddCostModal({{ $costtype }})"
                        tabindex="-1" 
                        class="fa-regular fa-circle-plus text-3xl m-3 mr-5" >
                    </button>
                    <div class="text-xl pr-1 font-extrabold tracking-widest items-end">
                        {{ $costtype->costtype->caption. ' ('. number_format($this->getCostByType($costtype->costtype_id)->pluck('gros')->sum(), 2, ',', '.') . ' €)'  }}
                    </div>
                </div>
            </div>
                @forelse ($this->getCostByType($costtype->costtype_id) as $cost)
                    <div class="px-1">
                        <livewire:user.costamount.detail-input :cost='$cost' :netto='false' :inputWithDatum='false' :wire:key="'list-cost-costamountinput-'.$cost->id" key="{{ now() }}"/>
                    </div>
                @empty
                    <div class="flex justify-center items-center space-x-2 bg-sky-100">
                        <span class="font-medium py-8 text-xl">nichts gefunden...</span>
                    </div>
                @endforelse
            @empty
                <div class="flex justify-center items-center space-x-2 bg-sky-100">
                    <span class="font-medium py-8 text-cool-gray-400 text-xl">nichts gefunden...</span>
                </div>
            @endforelse
        </div>
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





