<div class="">
    <div class="hidden sm:block">
        <div class="flex items-center justify-center sm:grid-cols-5 sm:gap-2">
            <div class="py-1 sm:w-64 bg-orange-400">
                {{ $userEmail->email }}
            </div>
            <div 
                class="py-1 sm:w-64 bg-orange-800 {{ $userEmail->aktiv ? 'text-black' : 'text-gray-500' }} ">
                {{ $userEmail->Zeitraum }} 
            </div>
            <x-icon.fonts.email-active :value='$userEmail->aktiv' class="py-1 px-4 border-2 border-sky-200 text-sm" ></x-icon.fonts.email-active>
            <x-icon.fonts.pencil 
                class="py-1 px-4 border-2 border-sky-200 text-sm" 
                wire:click="raise_EditModal()"
                >
            </x-icon.fonts.pencil>
            <x-icon.fonts.trash class="h-full py-1 px-4 border-2 border-sky-200 text-sm" ></x-icon.fonts.trash>
        
        </div>
    </div>
    <div class="sm:hidden block ">
        <div class="flex">
            <div class="basis-2/3">
                <div class="">
                    {{ $userEmail->email }}
                </div>
                <div class="text-xs {{ $userEmail->aktiv ? 'text-black' : 'text-gray-500' }} ">
                    {{ $userEmail->Zeitraum }} 
                </div>
            </div>
            <div class="basis-1/6 inline-block align-bottom">
                <x-icon.fonts.email-active :value='$userEmail->aktiv' class="py-1 px-4 border-2 text-sm" ></x-icon.fonts.email-active>
            </div>
            <div class="basis-1/6 ">
                <x-icon.fonts.pencil 
                class="py-1 px-4 border-2 text-sky-800 text-sm"
                wire:click="raise_EditModal()" 
                >
                </x-icon.fonts.pencil>
            </div>
            <div class="basis-1/6 ">
                <x-icon.fonts.trash class="py-1 px-4 border-2 border-sky-200 text-sm" ></x-icon.fonts.trash>
            </div>
        </div>
    </div>
</div>
