<div class="">
    {{-- small screen --}}
    <div class="hidden py-2 m-auto border-b-2 shadow-md sm:block sm:max-w-4xl">
        <div class="flex items-center justify-center">
            <div class="basis-1/4 py-1">
                {{ $userEmail->email }}
            </div>
            <div
                class="basis-1/4 py-1 {{ $userEmail->aktiv ? 'text-black' : 'text-gray-500' }} ">
                {{ $userEmail->Zeitraum }}
            </div>
            <x-icon.fonts.pencil
                class="px-4 py-1 text-sm border-2 rounded-lg cursor-pointer text-sky-700 border-sky-200 hover:text-sky-300"
                wire:click="emit_EditModal()"
                >
            </x-icon.fonts.pencil>
            <x-icon.fonts.trash
                class="px-4 py-1 text-sm text-red-800 border-2 rounded-lg cursor-pointer border-sky-200 hover:text-red-600"
                wire:click="emit_QuestionDeleteModal()"
                >
            </x-icon.fonts.trash>
        </div>
    </div>
    {{-- big screen --}}
    <div class="block py-2 border-b-2 shadow-sm sm:hidden ">
        <div class="flex justify-between">
            <div class="pl-1">
                <div class="text-sm">
                    {{ $userEmail->email }}
                </div>
                <div class="text-sm {{ $userEmail->aktiv ? 'text-black' : 'text-gray-500' }} ">
                    {{ $userEmail->Zeitraum }}
                </div>
            </div>
            <x-jet-dropdown align="right" class="align-middle">
                <x-slot name="trigger">
                    <button class="py-1 px-2 rounded-lg bg-sky-100 border-sky-100 duration-150 text-xl text-sky-700 opacity-90 group-hover:opacity-100 ease">&ctdot;</button>
                </x-slot>

                <x-slot name="content">

                    <x-jet-dropdown-link class="cursor-pointer"
                    wire:click="emit_EditModal()"
                    >
                    <x-icon.fonts.pencil></x-icon.fonts.pencil>{{ __('Bearbeiten') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link class="cursor-pointer"
                    wire:click="emit_QuestionDeleteModal()"
                    >
                    <x-icon.fonts.trash></x-icon.fonts.trash>{{ __('Löschen') }}
                    </x-jet-dropdown-link>

                </x-slot>
            </x-jet-dropdown>
        {{--<x-popup-menu class="">
                <ul class="bg-white border-1 border-gray-600 rounded-md shadow-md">
                    <li class="">
                        <x-icon.fonts.pencil
                            class="flex px-4 py-1 text-sm cursor-pointer text-sky-600 w-36 "
                            wire:click="emit_EditModal()">
                            <span class="font-mono">Bearbeiten</span>
                        </x-icon.fonts.pencil>
                    </li>
                    <li class="">
                        <x-icon.fonts.trash
                            class="flex px-4 py-1 text-sm cursor-pointer text-red-500  w-36 border-sky-200"
                            wire:click="emit_QuestionDeleteModal()">
                            <span class="font-mono">Löschen</span>
                        </x-icon.fonts.trash>
                    </li>
                </ul>
            </x-popup-menu>--}}
        </div>
    </div>
</div>
