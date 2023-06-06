

<div class="sm:grid sm:grid-cols-6 sm:gap-2">
    <div class="block sm:col-span-3">
  <!-- eingabe netto-->
    
    <x-input.group for="einstellungen-eingabeCostNetto" labelDirection="text-left" hohe="h-10" label="Kosteneingabe Netto" :error="$errors->first('realestate.eingabeCostNetto')">
        <div class="flex justify-between items-center">
            <div>
                <x-input.toggle wire:model="realestate.eingabeCostNetto"  width=8 id="einstellungen-eingabeCostNetto" ></x-input.toggle>
            </div>
        </div>
    </x-input.group>

    <x-input.group hohe="h-8" for="einstellungen-eingabeCostOhneDatum" labelDirection="text-left" hohe="h-10" for="einstellungen-eingabeCostOhneDatum" label="Kosteneingabe ohne Datum" :error="$errors->first('realestate.eingabeCostOhneDatum')">
        <div class="flex justify-between items-center">
            <div>
                <x-input.toggle wire:model="realestate.eingabeCostOhneDatum"  width=8 id="einstellungen-eingabeCostOhneDatum" ></x-input.toggle>
            </div>
        </div>
    </x-input.group>

    <x-input.group for="einstellungen-stromkosten" labelDirection="text-left" label="Strom pauschal [%]" :error="$errors->first('realestate.stromkosten')">
        <x-input.text class=" sm:h-8" wire:model.lazy="einstellungen.stromkosten" />
    </x-input.group>

    </div>
    <div class="sm:col-span-3">
      
        <x-input.group for="einstellungen-nabi_nr" labelDirection="text-left" label="IBAN" :error="$errors->first('realestate.nabi_nr')">
            <x-input.text class=" sm:h-8" wire:model.lazy="einstellungen.nabi_nr" />
        </x-input.group>
        <x-input.group for="einstellungen-nabi_inhaber" labelDirection="text-left" label="Kontoinhaber" :error="$errors->first('realestate.nabi_inhaber')">
            <x-input.text class=" sm:h-8" wire:model.lazy="einstellungen.nabi_inhaber" />
        </x-input.group>
        
</div>
   
</div>

