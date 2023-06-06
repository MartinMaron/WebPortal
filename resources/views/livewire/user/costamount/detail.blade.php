



    <form wire:submit.prevent="closeCostAmountDetailModal(true)">
        <x-modal.dialog class="bg-sky-50" minWidth="640px" maxWidth="800px"
               wire:model="showCostAmountEditModal">
            <!-- Dialog Title -->
            <x-slot name="title">
                <div class="flex flex-row justify-between">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-sky-100">
                        {{-- <i class="text-sky-800 fa-solid fa-trash-can"></i> --}}
                        <x-icon.fonts.pencil class="text-xs text-sky-500 hover:text-sky-800  px-2 ">                                       
                        </x-icon.fonts.pencil>
                    </div>
                </div>
            </x-slot>
            <!-- Dialog Content -->
            <x-slot name="content">
                <div>
                   
                    <div
                    > 
                        <x-input.group class="border-0" for="costAmount-detailModal-datum" label="Datum">
                            <x-input.date
                                wire:model.lazy="costAmount.datum"
                                :error="$errors->first('costAmount.datum')"
                                id="costamount-detailmodal-datum"
                                class="bg-sky-50 sm:h-8"
                            >
                            </x-input.date>
                        </x-input.group>
                        <!-- Verbrauch -->
                        @if ($showConsumptionField)
                            <x-input.group class="border-0" for="costAmount.consumption_editing" label="Verbrauch" :error="$errors->first('costAmount.consumption_editing')">
                            <x-input.text class="bg-sky-50 sm:h-8" wire:model.lazy="costAmount.consumption_editing" id="costAmount.consumption_editing" placeholder="0,000" />
                            </x-input.group>
                        @endif
                        @if ($showNetto)
                            <!-- Netto -->
                            <x-input.group class="border-0" for="costAmount.netto" label="Nettobetrag" :error="$errors->first('costAmount.netto')">
                            <x-input.text class="bg-sky-50 sm:h-8" wire:model.lazy="costAmount.netto" id="costAmount.netto" placeholder="0,00" />
                            </x-input.group>
                        @else                        
                            <!-- Brutto -->
                            <x-input.group class="border-0" for="costAmount.brutto" label="Betrag" :error="$errors->first('costAmount.brutto')">
                            <x-input.text class="bg-sky-50 sm:h-8" wire:model.lazy="costAmount.brutto" id="costAmount.brutto" placeholder="0,00" />
                            </x-input.group>                        
                        @endif
                        @if ($showHaushaltsnahField)
                            <!-- Haushaltsnah -->
                            <x-input.group class="border-0" for="costAmount.haushaltsnah" label="Betrag nach §35a" :error="$errors->first('costAmount.haushaltsnah')">
                            <x-input.text class="bg-sky-50 sm:h-8" wire:model.lazy="costAmount.haushaltsnah" id="costAmount.haushaltsnah" placeholder="0,00" />
                        </x-input.group>
                        @endif
                        <!-- Bemerkung-->  
                        <div class="mt-4">
                        <x-input.group hohe="h-30" :bottom=false for="costAmount.bemerkung" label="Bemerkung für die Abrechnung" :error="$errors->first('costAmount.bemerkung')">
                            <x-input.textarea  wire:model.lazy="costAmount.bemerkung" id="costAmount.bemerkung" placeholder="..." />
                        </x-input.group>
                        </div>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-button.secondary wire:click="closeCostAmountDetailModal(false)">Abbrechen</x-button.secondary>
                <x-button.delete type="submit">Speichern</x-button.delete>
            </x-slot>
        </x-modal.dialog>
    </form>

















