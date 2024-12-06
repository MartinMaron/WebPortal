<div class="">
    {{-- big screen --}}
    <div class="hidden py-2 mx-1 border border-sky-300 rounded-md sm:block sm:max-w-7xl">
        <div class="flex items-center justify-between">
            <div class="basis-1/3 px-2 py-1 text-xl text-left">
                {{ $userEmail->email }}
            </div>
            <div class="basis-1/3 flex justify-between">

                <div class="py-1 p-1 text-left {{ $userEmail->infoPerPortal ? 'bg-green-200 rounded-md': 'bg-red-200 rounded-md'}}">
                    <span class="pr-2">Portal</span>
                    <span class=""><i class="{{ $userEmail->infoPerPortal ? 'fa-solid fa-check text-green-700 font-bold': 'fa-sharp fa-solid fa-ban text-red-700 font-bold'}} "></i></span>
                </div>
                <div class="py-1 p-1 text-left {{ $userEmail->infoPerEmail ? 'bg-green-200 rounded-md': 'bg-red-200 rounded-md'}}">
                    <span class="pr-3">Email</span>
                    <span class=""><i class="{{ $userEmail->infoPerEmail ? 'fa-solid fa-check text-green-700 font-bold': 'fa-sharp fa-solid fa-ban text-red-700 font-bold'}} "></i></span>
                </div>
                <div class="py-1 p-1 text-left {{ $userEmail->infoPerPost ? 'bg-green-200 rounded-md': 'bg-red-200 rounded-md'}}">
                    <span class="pr-3">Postbrief</span>
                    <span class=""><i class="{{ $userEmail->infoPerPost ? 'fa-solid fa-check text-green-700 font-bold': 'fa-sharp fa-solid fa-ban text-red-700 font-bold'}} "></i></span>
                </div>
            </div>
            <div class="basis-1/3 flex justify-end gap-5 py-1 text-center mx-1">
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
    <div class="block p-1 sm:py-2 shadow-sm sm:hidden">
        <div class="flex justify-between items-center rounded-lg border border-sky-500">
            <div class="block">
                <div class="pb-2 pl-1 text-lg">
                    {{ $userEmail->email }}
                </div>
                <div class="flex text-sm justify-start gap-3">
                    <div class="py-1 pl-1">UVI-Zustellung über</div>
                    <div class="{{ $userEmail->infoPerPortal ? 'bg-green-200 rounded-md': 'bg-red-200 rounded-md'}} py-1 px-2">Portal</div>
                    <div class="{{ $userEmail->infoPerEmail ? 'bg-green-200 rounded-md': 'bg-red-200 rounded-md'}} py-1 px-2">Email</div>
                    <div class="{{ $userEmail->infoPerPost ? 'bg-green-200 rounded-md': 'bg-red-200 rounded-md'}} py-1 px-2">Brief</div>
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
        </div>
        
    </div>
</div>
