<div class="">
    {{-- big screen --}}
    <div class="hidden py-2 m-auto border-b-2 sm:block sm:max-w-7xl">
        <div class="flex items-center justify-center">
            <div class="basis-1/4 py-1 text-center">
            </div>
            <div class="basis-1/2 py-1 text-center">
                {{ $userEmail->email }}
            </div>
            <div class="basis-1/4 py-1 text-center">
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
    </div>
    {{-- small screen --}}
    <div class="block py-2 border-b-2 shadow-sm sm:hidden ">
        <div class="flex justify-between items-baseline">
            <div class="pl-1 text-sm">
                {{ $userEmail->email }}
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
        
        </div>
    </div>
</div>
