<div class="">
    {{-- small screen --}}
    <div class="hidden m-auto mt-2 mb-4 border-b-2 shadow-md sm:block sm:max-w-4xl"> 
        <div class="flex items-center justify-center sm:grid-cols-5 sm:gap-2">
            <div class="py-1 sm:w-64">
                {{ $userEmail->email }}
            </div>
            <div 
                class="py-1 sm:w-64 {{ $userEmail->aktiv ? 'text-black' : 'text-gray-500' }} ">
                {{ $userEmail->Zeitraum }} 
            </div>
            <x-icon.fonts.pencil 
                class="px-4 py-1 text-sm border-2 rounded-lg cursor-pointer border-sky-200 hover:bg-sky-400" 
                wire:click="emit_EditModal()"
                >
            </x-icon.fonts.pencil>
            <x-icon.fonts.trash 
                class="h-full px-4 py-1 text-sm border-2 rounded-lg cursor-pointer border-sky-200 hover:bg-sky-400" 
                wire:click="emit_QuestionDeleteModal()" 
                >
            </x-icon.fonts.trash>
        </div>
    </div>
    {{-- big screen --}}
    <div class="block mt-2 mb-4 border-b-2 shadow-sm sm:hidden ">
        <div class="grid grid-cols-3">
            <div>
                <div class="">
                    {{ $userEmail->email }}
                </div>
                <div class="text-xs {{ $userEmail->aktiv ? 'text-black' : 'text-gray-500' }} ">
                    {{ $userEmail->Zeitraum }} 
                </div>
            </div>
            <div class="">
            </div>
            <div class="items-center ml-auto">
                <x-popup-menu>
                    <li>
                        <x-icon.fonts.pencil 
                        class="flex px-4 py-1 mr-40 text-sm bg-white border-2 rounded-lg cursor-pointer w-36 border-sky-200 hover:bg-sky-400"
                        wire:click="emit_EditModal()">
                        <span class="font-mono">Bearbeiten</span>  
                        </x-icon.fonts.pencil>
                    </li>
                    <li>
                        <x-icon.fonts.trash 
                        class="flex px-4 py-1 mt-1 mr-40 text-sm bg-white border-2 rounded-lg cursor-pointer w-36 border-sky-200 hover:bg-sky-400"
                        wire:click="emit_QuestionDeleteModal()">
                        <span class="font-mono">Löschen</span>
                        </x-icon.fonts.trash>
                    </li>
                </x-popup-menu>
            </div>
        </div>
    </div>
</div>

