 
<form wire:submit.prevent="closeModal(true)">
 <x-modal.dialog class="bg-sky-50" minWidth="340px" maxWidth="2xl" wire:model.defer="showEditModal">
        <!-- Dialog Title -->
        <x-slot name="title">
            <div class="flex">
                @if ($cost)
                    <div class="text-lg font-bold text-sky-500">{{ $cost->nazwa }}</div> <x-icon.fonts.pen-line class="text-sky-500 pl-10 h-6 mt-1" ></x-icon.fonts.pen-line>
                @else
                    <div class="text-lg font-bold text-sky-500">Neu</div> <x-icon.fonts.pen-line class="text-sky-500 pl-10 h-6 mt-1" ></x-icon.fonts.pen-line>
                @endif
            </div>
        </x-slot>
        <!-- Dialog Content -->
        <x-slot name="content">
            <div> 
                <x-input.group
                class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10"
                for="cost.caption" label="Bezeichnung" :error="$errors->first('cost.caption')"
                >
                    <x-input.text class="h-10 bg-sky-50 sm:h-8" wire:model.lazy="cost.caption" id="cost-detail-cost.caption" placeholder="0" />
                </x-input.group>
                {{-- <!-- Bemerkung-->  
                <x-input.group
                hohe="h-30"
                hoheLabel="h-30 sm:h-full sm:pt-3"
                bottom=false for="bemerkung" label="weitere Beschreibung" :error="$errors->first('cost.description')">
                    <x-input.textarea  wire:model="cost.description" id="cost-detail-cost.description" placeholder="..." />
                </x-input.group> --}}
                <!-- Kostenart-->  
                <x-input.group
                        class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10"
                        for="costType" label="Kostenart" :error="$errors->first('cost.costType_id')"
                        x-data
                        x-init="$refs.inputKostenart.focus()"
                        >
                        <x-input.select
                        x-ref="inputKostenart"
                        class="h-10 border-b bg-sky-50 sm:h-8 focus:border-0 w-full" wire:model="cost.costType_id" id="cost-detail-cost.costType_id" placeholder="Bitte auswählen" value="">
                        @foreach ($this->costTypes as $label)
                        <div class="h-10">
                            <option value="{{ $label->type_id }}">
                                {{ $label->caption }}
                            </option>
                        </div>
                        @endforeach
                        </x-input.select>
                </x-input.group>
                <!-- Brennstoffart-->  
                <x-input.group
                    class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10"
                    for="fuelType" label="Brennstoff" :error="$errors->first('cost.fuelType_id')"
                    x-data
                    x-init="$refs.inputBrennstoffart.focus()"
                    >
                    <x-input.select
                    x-ref="inputBrennstoffart"
                    class="h-10 border-b bg-sky-50 sm:h-8 focus:border-0 w-full" wire:model="cost.fuelType_id" id="cost-detail-cost.costType_id" placeholder="Bitte auswählen" value="">
                    @foreach ($this->fuelTypes as $label)
                    <div class="h-10">
                        <option value="{{ $label->type_id }}">
                            <div class="flex">
                                <div class="">
                                    {{ $label->caption. ' ('. $label->Einheit->shortname. ')'   }}
                                </div>
                            </div>
                        </option>
                    </div>
                    @endforeach
                    </x-input.select>
                </x-input.group>
                <!-- Anfangsstand-->  
                <x-input.group
                class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10"
                for="cost.start_value_editing" label="Anfangsstand" :error="$errors->first('cost.start_value_editing')"
                >
                    <x-input.text class="h-10 bg-sky-50 sm:h-8" wire:model.lazy="cost.start_value_editing" id="cost-detail-cost.start_value_editing" placeholder="0" />
                </x-input.group>
                <!-- Anfangsstand Betrag-->  
                <x-input.group
                class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10"
                for="cost.start_value_amount_gros_editing" label="Anfangsstand Betrag" :error="$errors->first('cost.start_value_amount_gros_editing')"
                >
                    <x-input.text class="h-10 bg-sky-50 sm:h-8" wire:model.lazy="{{ $netAmountInput ? 'cost.start_value_amount_net_editing' : 'cost.start_value_amount_gros_editing'}}" id="cost-detail-cost.start_value_amount_editing" placeholder="0" />
                </x-input.group>  
            </div>
            <div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button.secondary wire:click="closeModal(false)">Abbrechen</x-button.secondary>

            <x-button.primary type="submit">Speichern</x-button.primary>
        </x-slot>
    </x-modal.dialog>
</form>




    

