<div class="">
    {{-- small screen --}}
    <div class="hidden mt-2 mb-4 border-b-2 shadow-md sm:block sm:w-96 "> 
        <div class="flex items-center justify-center sm:grid-cols-5 sm:gap-2">
            <div class="py-1 sm:w-64">
                {{ $userEmail->email }}
            </div>
            <div 
                class="py-1 sm:w-64 {{ $userEmail->aktiv ? 'text-black' : 'text-gray-500' }} ">
                {{ $userEmail->Zeitraum }} 
            </div>
            <x-icon.fonts.email-active :value='$userEmail->aktiv' class="px-4 py-1 text-sm border-2 rounded-lg border-sky-200" ></x-icon.fonts.email-active>
            <x-icon.fonts.pencil 
                class="px-4 py-1 text-sm border-2 rounded-lg border-sky-200" 
                wire:click="emit_EditModal()"
                >
            </x-icon.fonts.pencil>
            <x-icon.fonts.trash 
                class="h-full px-4 py-1 text-sm border-2 rounded-lg border-sky-200" 
                wire:click="emit_QuestionDeleteModal()" 
                >
            </x-icon.fonts.trash>
        
        </div>
    </div>
    {{-- big screen --}}
    <div class="block mt-2 mb-4 border-b-2 shadow-sm sm:hidden ">
        <div class="flex">
            <div class="basis-2/3">
                <div class="">
                    {{ $userEmail->email }}
                </div>
                <div class="text-xs {{ $userEmail->aktiv ? 'text-black' : 'text-gray-500' }} ">
                    {{ $userEmail->Zeitraum }} 
                </div>
            </div>
            <div class="inline-block align-bottom basis-1/6">
                <x-icon.fonts.email-active :value='$userEmail->aktiv' class="px-4 py-1 text-sm border-2 rounded-lg border-sky-200" ></x-icon.fonts.email-active>
            </div>
            <div class="basis-1/6 ">
                <x-icon.fonts.pencil 
                class="px-4 py-1 text-sm border-2 rounded-lg border-sky-200 text-sky-800"
                wire:click="emit_EditModal()" 
                >
                </x-icon.fonts.pencil>
            </div>
            <div class="basis-1/6 ">
                <x-icon.fonts.trash 
                wire:click="emit_QuestionDeleteModal()" 
                class="px-4 py-1 text-sm border-2 rounded-lg border-sky-200" 
                >
            </x-icon.fonts.trash>
            </div>
        </div>
    </div>
</div>
