 
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
                <x-input.group for="Bezeichnung" label="Bezeichnung" :error="$errors->first('cost.nazwa')">
                    <div>
                        <x-input.text class="bg-sky-50 sm:h-8" wire:model="cost.nazwa" id="nazwa" placeholder="..." />
                    </div>
                </x-input.group>
                  <!-- Haushaltsnah-->
                <x-input.group hohe="h-10" for="Haushaltsnahe Dienstleistungen ausweisen" label="Haushaltsnahe Dienstleistungen ausweisen" :error="$errors->first('cost.haushaltsnah')">
                    <div class="flex justify-between items-center">
                        <div>
                            <x-input.checkbox wire:model="cost.haushaltsnah"></x-input.checkbox>
                        </div>
                    </div>
                </x-input.group>
                <!-- Haushaltsnah-->  
                <div class="mt-4">
                    <x-input.group hohe="h-30" :bottom=false for="noticeForNeko" label="Bemerkung für die Abrechnung" :error="$errors->first('current.bemerkung')">
                        <x-input.textarea  wire:model="cost.noticeForNeko" id="noticeForNeko" placeholder="..." />
                    </x-input.group>
                </div>
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




    

