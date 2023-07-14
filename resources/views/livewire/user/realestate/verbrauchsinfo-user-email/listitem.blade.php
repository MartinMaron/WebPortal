<div class="">
    {{-- small screen --}}
    <div class="hidden py-2 pb-4 m-auto border-b-2 shadow-md sm:block sm:max-w-4xl"> 
        <div class="flex items-center justify-center sm:grid-cols-5 sm:gap-2">
            <div class="py-1 sm:w-64">
                {{ $userEmail->email }}
            </div>
            <div 
                class="py-1 sm:w-64 {{ $userEmail->aktiv ? 'text-black' : 'text-gray-500' }} ">
                {{ $userEmail->Zeitraum }} 
            </div>
            <x-icon.fonts.pencil 
                class="px-4 py-1 text-sm border-2 rounded-lg cursor-pointer text-sky-800 border-sky-200 hover:text-sky-300" 
                wire:click="emit_EditModal()"
                >
            </x-icon.fonts.pencil>
            <x-icon.fonts.trash 
                class="h-full px-4 py-1 text-sm text-red-800 border-2 rounded-lg cursor-pointer border-sky-200 hover:text-red-600" 
                wire:click="emit_QuestionDeleteModal()" 
                >
            </x-icon.fonts.trash>
        </div>
    </div>
    {{-- big screen --}}
    <div class="block pt-2 pb-4 border-b-2 shadow-sm sm:hidden ">
        <div class="grid grid-cols-3">
            <div>
                <div class="text-sm">
                    {{ $userEmail->email }}
                </div>
                <div class="text-sm {{ $userEmail->aktiv ? 'text-black' : 'text-gray-500' }} ">
                    {{ $userEmail->Zeitraum }} 
                </div>
            </div>
            <div class="">
            </div>
            <div class="items-center ml-auto">
                <x-popup-menu>
                    <li class="pt-8">
                        <x-icon.fonts.pencil 
                        class="flex px-4 py-1 text-sm bg-white border-2 rounded-lg cursor-pointer text-sky-600 w-36 border-sky-200"
                        wire:click="emit_EditModal()">
                        <span class="font-mono">Bearbeiten</span>  
                        </x-icon.fonts.pencil>
                    </li>
                    <li class="">
                        <li class="">
                            <x-icon.fonts.trash 
                            class="flex px-4 py-1 mt-1 text-sm text-red-500 bg-white border-2 rounded-lg cursor-pointer w-36 border-sky-200"
                            wire:click="emit_QuestionDeleteModal()">
                            <span class="font-mono">Löschen</span>
                            </x-icon.fonts.trash>
                        </li>
                    </x-popup-menu>
                </div>
            </div>
        </div>
    </div>