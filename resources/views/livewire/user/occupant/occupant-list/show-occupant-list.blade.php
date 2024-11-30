

<div key="{{ now() }}">
    <div class="block w-full mx-auto max-w-7xl" key="{{ now() }}">
        <div class="text-3xl pt-3 font-bold text-sky-800 text-center w-full">
            NUTZERLISTE  
        </div>
        <div class="">
            <!-- Suchfeld -->
            <x-input.search wire:model.debounce.600ms="filters.search"></x-input.search>
        </div>
        <div class="flex-row w-full">
            <div class="flex w-full px-5 sm:px-1 gap-2 justify-between sm:justify-start">

                @if ($hasAnyCustomEinheitNo)
                <div wire:click="toggle('nummer')" class="relative inline-block w-40 pt-1 pb-2 mt-1 align-middle transition duration-200 ease-in select-none" key="{{ now() }}">
                    <input wire:model="showCustomEinheitNo" type="checkbox" name="" id="" class="absolute block w-6 h-6 my-1 rounded-full appearance-none cursor-pointer toggle-checkbox bg-sky-100 border-1"/>
                    <label for="toggle" class="block h-8 pl-8 overflow-hidden rounded-full cursor-pointer toggle-label">
                        @if ($showCustomEinheitNo)
                        <span class="font-medium text-gray-900 text-md">Ihre Nummer.</span>
                        @else
                        <span class="font-medium text-gray-900 text-md">eneko Nr.</span>
                        @endif
                    </label>
                </div>
                @endif
                @if ($hasAnyEigentumer)
                <div wire:click="toggle('eigentumer')" class="relative inline-block w-40 pt-1 pb-2 mt-1 align-middle transition duration-200 ease-in select-none">
                    <input wire:model="showEigentumer" type="checkbox" name="" id="" class="absolute block w-6 h-6 my-1 rounded-full appearance-none cursor-pointer toggle-checkbox bg-sky-100 border-1"/>
                    <label for="toggle" class="block h-8 pl-8 overflow-hidden rounded-full cursor-pointer toggle-label">
                        @if ($showEigentumer)
                        <span class="font-medium text-gray-900 text-md">Eigentümer</span>
                        @else
                        <span class="font-medium text-gray-900 text-md">Nutzer</span>
                        @endif
                    </label>
                </div>
                @endif
            </div>
        </div>            

        <!-- Big screen TABELLA -->
        <div class="hidden sm:block md:max-w-7xl" key="{{ now() }}">
            <x-table class="occu-table" key="{{ now() }}">
                <x-slot name="head">
                    <x-table.thead class="">
                    @if ($rows->count()!=0)
                        <x-table.tr class="">
                            <x-table.th class="w-20 text-left occu-thead-th">
                                Nummer
                            </x-table.th>
                            <x-table.th class="text-left w-30 occu-thead-th sm:visible">Lage</x-table.th>
                            <x-table.th class="text-left w-80 occu-thead-th">
                                @if ($showEigentumer)
                                    Eigentümer
                                @else
                                    Nutzer
                                @endif
                            </x-table.th>
                            <x-table.th class="text-center occu-thead-th">Zeitraum</x-table.th>
                            <x-table.th class="text-left w-30 occu-thead-th">MwSt.</x-table.th>
                            <x-table.th class="text-left w-50 occu-thead-th">m²</x-table.th>
                            <x-table.th class="text-left w-50 occu-thead-th">pe</x-table.th>
                            <x-table.th class="w-40 text-right occu-thead-th">Vorausz.
                                <x-button.link wire:click="toggle('vorauszahlung')">
                                    <x-icon.fonts.editable-pencil class="hover:text-amber-200" value={{$editVorauszahlungen}}> Vorausz.
                                    </x-icon.fonts.editable-pencil>
                                 </x-button.link>
                            </x-table.th>
                        </x-table.tr>
                    @endif

                    </x-table.thead>
                </x-slot>
                <x-slot name="body" class="occu-tbl-container">
                    <x-table.tbody class="occu-tbody">
                        @forelse ($rows as $occupant)
                        <x-table.tr wire:loading.class.delay="opacity-50" wire:key="row-{{ $occupant->id }}">
                            <x-table.th class="w-20 text-left occu-th" style="display:table-cell !important;">
                                @if ($showCustomEinheitNo)
                                    <span class="{{ $occupant->customEinheitNo ? 'font-bold' : 'font-thin text-opacity-50' }}">
                                        {{ $occupant->display_einheit }}
                                    </span>
                                @else
                                    {{ $occupant->NutzerKennnummer }}
                                @endif
                            </x-table.th>
                            <x-table.th class="text-left occu-th w-30">{{ $occupant->lage }}</x-table.th>
                            <x-table.td wire:click="edit({{ $occupant->id }})" class="w-full occu-td hover:bg-sky-100" style="min-width: 20rem;">
                                <button tabindex="-1" class="w-full text-left" type="button">
                                    @if ($showEigentumer)
                                        <span class="{{ $occupant->eigentumer ? 'font-bold' : 'font-thin text-opacity-50' }}">
                                            {{ $occupant->display_eigentumer_name }}
                                        </span>
                                    @else
                                        {{ $occupant->vorname . ' '. $occupant->nachname }}
                                    @endif
                                </button>
                            </x-table.th>
                            <x-table.td class="text-center occu-td" style="min-width: 14rem; max-width: 14rem">
                                <div class="flex px-2">
                                    <span>{{ $occupant->date_from_editing }}</span>
                                    <span class="w-6">-</span>
                                    @if ($occupant->dateTo)
                                        <span>{{ $occupant->date_to_editing }}</span>
                                    @else
                                        <div class="w-40 px-auto gap-2 {{ $occupant->canDelete ? 'flex justify-between' : 'flex justify-center' }} items-center mx-1">
                                            <button class="w-18 px-auto border-2"
                                                style="min-width: 3rem; max-width: 3rem"
                                                wire:click='change({{$occupant}})'>
                                                <x-icon.fonts.user-move 
                                                class="text-sky-700 hover:text-sky-300 fa-solid fa-house-person-leave">
                                                </x-icon.fonts.user-move>
                                            </button>
                                            @if ($occupant->canDelete)
                                                <button class="w-18 px-auto border-2"
                                                wire:click='emit_QuestionDeleteModal({{$occupant}})'
                                                style="min-width: 3rem; max-width: 3rem"
                                                >
                                                <span >
                                                    <x-icon.fonts.trash class="text-red-700 hover:text-red-300 fa-solid "></x-icon.fonts.trash>
                                                </span>
                                                </button>
                                            @endif
                                        </div>    
                                    @endif
                                </div>
                            </x-table.td>
                            <x-table.td class="text-center occu-td w-30">
                                <x-icon.fonts.checked :value='$occupant->vat'></x-icon.fonts.checked>
                            </x-table.td>
                            <x-table.td class="text-center occu-td w-30">
                                <span class="">{{number_format($occupant->qmkc,  2, ',', '.') }}</span>
                            </x-table.td>
                            <x-table.td class="text-center occu-td w-30">
                                <x-table.cell.span>{{number_format($occupant->pe,  1, ',', '.')}}</x-table.cell.span>
                            </x-table.td>
                            <x-table.td class="w-40 p-0 text-right occu-td" style="min-width: 7rem; max-width: 7rem">
                                @if ($editVorauszahlungen)
                                    <livewire:user.occupant.vorauszahlung-edit :occupant='$occupant'/>
                                @else
                                    <span class="pr-2 ">{{number_format($occupant->vorauszahlung,  2, ',', '.') }}</span>
                                @endif
                            </x-table.td>
                       </x-table.tr>
                        @empty
                        <x-table.tr>
                            <div class="flex items-center justify-center space-x-2 bg-sky-100">
                                    <span class="py-8 text-xl font-medium text-cool-gray-400">nichts gefunden...</span>
                            </div>
                        </x-table.tr>
                        @endforelse
                    </x-table.tbody>
                </x-slot>
            </x-table>
        </div>

        <!-- Occupants List -->
        <div class="block sm:hidden" key="{{ now() }}">
            <div class="grid w-full grid-cols-1 gap-4 mt-6 sm:grid-cols-2 lg:grid-cols-3" key="{{ now() }}">
                    
                @foreach ($rows as $occupant)
                    <div wire:key="flex row-{{ $occupant->id }}" class="divide-gray-200 rounded-lg shadow-md max-w-1/4 bg-sky-50" key="{{ now() }}" >
                        <div class="flex items-center justify-between w-full p-2 space-x-6 ">
                            <div class="flex-1 border-sky-100 ">
                                <div class="w-full text-gray-700">
                                    <div class="items-center ">
                                        <div class="">

                                            <div class="flex justify-between gap-2 m-auto text-lg text-sky-700">
                                                @if ($showCustomEinheitNo)
                                                <span class="{{ $occupant->customEinheitNo ? 'font-bold' : 'font-thin text-opacity-50' }}">
                                                    {{ $occupant->display_einheit }}
                                                </span>
                                                @else
                                                    {{ $occupant->NutzerKennnummer }}
                                                @endif
                                                <div class="">
                                                    {{ $occupant->qmkcEditing }} m²
                                                </div>
                                            </div>

                                            <div class="flex justify-between text-lg font-semibold text-sky-700">
                                                @if ($showEigentumer)
                                                <span class="{{ $occupant->eigentumer ? 'font-bold' : 'font-thin text-opacity-50' }}">
                                                    {{ $occupant->display_eigentumer_name }}
                                                </span>
                                                @else
                                                    {{ $occupant->vorname . ' '. $occupant->nachname }}
                                                @endif
                                                <div class="">
                                                    <x-jet-dropdown align="right" class="w-40">
                                                        <x-slot name="trigger">
                                                            <button class="px-2 py-1 duration-150 rounded-lg bg-sky-100 border-sky-100 text-md text-sky-700 opacity-90 group-hover:opacity-100 ease">&ctdot;</button>
                                                        </x-slot>
                                                        <x-slot name="content" class="">
                                                            <x-jet-dropdown-link 
                                                                class="cursor-pointer"
                                                                wire:click='edit({{$occupant}})'
                                                                >
                                                                <x-icon.fonts.editable-pencil class="text-sm cursor-pointer text-sky-700 hover:text-sky-300"></x-icon.fonts.editable-pencil>
                                                                {{ __('Bearbeiten') }}
                                                            </x-jet-dropdown-link>
                                                            
                                                            <x-jet-dropdown-link 
                                                                class="cursor-pointer"
                                                                wire:click='change({{$occupant}})'
                                                                >
                                                                <x-icon.fonts.user-move class="cursor-pointer text-sky-700 hover:text-sky-300 fa-solid fa-house-person-leave"></x-icon.fonts.user-move>
                                                                {{ __('Nutzerwechsel') }}
                                                            </x-jet-dropdown-link>
                                                            @if ($occupant->canDelete)

                                                                <x-jet-dropdown-link 
                                                                    class="cursor-pointer"
                                                                    wire:click='emit_QuestionDeleteModal({{$occupant}})'
                                                                    >
                                                                    <x-icon.fonts.trash class="cursor-pointer text-red-700 hover:text-sky-300 fa-solid "></x-icon.fonts.trash>
                                                                    {{ __('Löschen') }}
                                                                </x-jet-dropdown-link>
                                                            @endif
                                                        </x-slot>
                                                    </x-jet-dropdown>
                                                </div>
                                            </div>

                                            <div class="flex justify-between text-sm">
                                                <div class="">
                                                    {{ $occupant->zeitraumText }}
                                                </div>
                                                <div class="">
                                                    {{-- <span class="ml-3">Nutzerwechsel</span> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="">
           {{-- 
            <livewire:user.occupant.occupant-list.dialog :realestate='$realestate'/>
         --}}
         
            <livewire:user.occupant.detail.dialog :realestate='$realestate' key="{{ now() }}"/>
        
        </div>
        <div class="">
            <livewire:user.dialog.delete-modal :wire:key="'modal-occupant-list-delete'"/>
        </div>
    </div>
</div>

