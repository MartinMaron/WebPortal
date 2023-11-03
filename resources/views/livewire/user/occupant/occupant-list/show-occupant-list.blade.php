

<div key="{{ now() }}">
    <div class="w-full px-4 py-1 mx-auto max-w-7xl sm:px-6 lg:px-8" key="{{ now() }}">
        <!-- Suchfeld -->
        <x-input.search wire:model.debounce.600ms="filters.search"></x-input.search>

        <!-- Big screen TABELLA -->
        <div class="hidden sm:block md:max-w-7xl" key="{{ now() }}">
            <x-table class="occu-table" key="{{ now() }}">
                <x-slot name="head">
                    <x-table.thead class="">
                    @if ($rows->count()!=0)
                        <x-table.tr class="">
                            <x-table.th class="w-20 text-left occu-thead-th">No.</x-table.th>
                            <x-table.th class="text-left w-30 occu-thead-th">Int. No.</x-table.th>
                            <x-table.th class="text-left w-30 occu-thead-th sm:visible">Lage</x-table.th>
                            <x-table.th class="text-left w-80 occu-thead-th">Nutzer</x-table.th>
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
                            <x-table.th class="w-20 text-left occu-th" style="display:table-cell !important;">{{ $occupant->NutzerKennnummer }}</x-table.th>
                            <x-table.th class="w-40 text-left occu-th" style="display:table-cell !important;">{{ $occupant->customEinheitNo }}</x-table.th>

                            <x-table.th class="text-left occu-th w-30">{{ $occupant->lage }}</x-table.th>
                            <x-table.td wire:click="edit({{ $occupant->id }})" class="w-full occu-td hover:bg-sky-100" style="min-width: 20rem;">
                                <button tabindex="-1" class="w-full text-left" type="button">{{ $occupant->vorname . ' '. $occupant->nachname }}</button>
                            </x-table.th>
                            <x-table.td class="text-center occu-td" style="min-width: 14rem; max-width: 14rem">
                                <div class="flex px-2">
                                    <span>{{ $occupant->date_from_editing }}</span>
                                    <span class="w-4">-</span>
                                    @if ($occupant->dateTo)
                                        <span>{{ $occupant->date_to_editing }}</span>
                                    @else
                                       <button wire:click='change({{$occupant}})' tabindex="-1" class="w-40 mgc-button " type="button" data-hover="Auszug" data-active="Los"><span class="w-40"><i class="text-sky-200 fa-solid fa-house-person-leave"></i></span></button>
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
                                <x-table.cell.span>{{ $occupant->pe }}</x-table.cell.span>
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
                <div class="justify-between" key="{{ now() }}">
                    @if ($hasAnyCustomEinheitNo)
                    <div wire:click="togleshowCustomEinheitNo" class="relative inline-block w-40 pt-1 pb-2 mt-1 align-middle transition duration-200 ease-in select-none" key="{{ now() }}">
                        <input wire:model="showCustomEinheitNo" type="checkbox" name="" id="" class="absolute block w-6 h-6 my-1 rounded-full appearance-none cursor-pointer toggle-checkbox bg-sky-100 border-1"/>
                        <label for="toggle" class="block h-8 pl-8 overflow-hidden rounded-full cursor-pointer toggle-label">
                            @if ($showCustomEinheitNo)
                            <span class="font-medium text-gray-900 text-md">Neko-nr.</span>
                            @else
                            <span class="font-medium text-gray-900 text-md">Ihr Nr.</span>
                            @endif
                        </label>
                    </div>
                    @endif
                    @if ($hasAnyEigentumer)
                    <div wire:click="togleshowEigentumer" class="relative inline-block w-40 pt-1 pb-2 mt-1 align-middle transition duration-200 ease-in select-none">
                        <input wire:model="showEigentumer" type="checkbox" name="" id="" class="absolute block w-6 h-6 my-1 rounded-full appearance-none cursor-pointer toggle-checkbox bg-sky-100 border-1"/>
                        <label for="toggle" class="block h-8 pl-8 overflow-hidden rounded-full cursor-pointer toggle-label">
                            @if ($showEigentumer)
                            <span class="font-medium text-gray-900 text-md">Nachname</span>
                            @else
                            <span class="font-medium text-gray-900 text-md">Eigentümer</span>
                            @endif
                        </label>
                    </div>
                    @endif
                </div>
                @foreach ($rows as $occupant)
                    <div wire:key="flex row-{{ $occupant->id }}" class="divide-gray-200 rounded-lg shadow-md max-w-1/4 bg-sky-50" key="{{ now() }}" >
                        <div class="flex items-center justify-between w-full p-2 space-x-6 ">
                            <div class="flex-1 border-sky-100 ">
                                <div class="w-full text-gray-700">
                                    <div class="items-center ">
                                        <div class="">

                                            <div class="flex justify-between gap-2 m-auto text-lg text-sky-700">
                                                @if ($showCustomEinheitNo)
                                                <div>
                                                    {{ $occupant->nutzerMitLage }}
                                                </div>
                                                @else
                                                <div>
                                                    {{ $occupant->customEinheitNoMitLage }}
                                                </div>
                                                @endif
                                                <div class="">
                                                    {{ $occupant->qmkcEditing }} m²
                                                </div>
                                            </div>

                                            <div class="flex justify-between text-lg font-semibold text-sky-700">
                                                @if ($showEigentumer)
                                                <div class="">
                                                    {{ $occupant->nachname}}
                                                </div>
                                                @else
                                                <div>
                                                    {{ $occupant->eigentumer}}
                                                </div>
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

    </div>
</div>

