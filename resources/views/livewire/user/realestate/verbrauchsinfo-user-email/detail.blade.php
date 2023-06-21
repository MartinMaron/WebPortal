
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
                <x-input.group class="border-0" for="costAmount-detailModal-dateFrom" label="seit" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10">
                    <x-input.date
                        wire:model.lazy="userEmail.dateFrom"
                        :error="$errors->first('userEmail.date_from_editing')"
                        hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10"
                        id="verbrauchsinfoUserEmail-detailmodal-date_from_editing"
                        class="bg-sky-50 sm:h-8"
                    >
                    </x-input.date>
                </x-input.group>
                <x-input.group class="border-0" for="costAmount-detailModal-dateTo" label="bis" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10">
                    <x-input.date
                        wire:model.lazy="userEmail.dateTo"
                        :error="$errors->first('userEmail.dateTo')"
                        hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10"
                        id="verbrauchsinfoUserEmail-detailmodal-dateTo"
                        class="bg-sky-50 sm:h-8"
                    >
                    </x-input.date>
                </x-input.group>
                <x-input.group 
                    class="my-2 " paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10" 
                    for="aktiv" label="aktiv" :error="$errors->first('userEmail.aktiv')">
                    <div class="flex justify-between items-center h-10 sm:h-8">
                        <div class="basis-2/5 pl-1">
                            <x-input.checkbox wire:model="userEmail.aktiv">
                            </x-input.checkbox>
                        </div>
                    </div>
                </x-input.group>
                <x-input.group 
                    class="border-0" for="userEmail.firstinitUsername" label="Username für Webaccount" :error="$errors->first('userEmail.firstinitUsername')"
                    hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10">
                    <x-input.text class="bg-sky-50 sm:h-8" wire:model.lazy="userEmail.firstinitUsername" id="userEmail.firstinitUsername" />
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


















