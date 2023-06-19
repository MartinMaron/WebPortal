
<form wire:submit.prevent="closeModal(true)">
    <x-modal.dialog class="bg-sky-50" minWidth="640px" maxWidth="800px"
           wire:model="showEditModal">
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
                <x-input.group class="border-0" for="costAmount-detailModal-datum" label="seit">
                    <x-input.date
                        wire:model.lazy="userEmail.dateFrom"
                        :error="$errors->first('userEmail.userEmail')"
                        hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10"
                        id="verbrauchsinfoUserEmail-detailmodal-dateFrom"
                        class="bg-sky-50 sm:h-8"
                    >
                </x-input.date>
                </x-input.group>
                        <x-input.group 
                            class="border-0" for="userEmail.email" label="Email" :error="$errors->first('userEmail.email')"
                            hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10">
                        <x-input.text class="bg-sky-50 sm:h-8" wire:model.lazy="userEmail.email" id="userEmail.email" />
                </x-input.group>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button.secondary wire:click="closeModal(false)">Abbrechen</x-button.secondary>
            <x-button.delete type="submit">Speichern</x-button.delete>
        </x-slot>
    </x-modal.dialog>
</form>


















