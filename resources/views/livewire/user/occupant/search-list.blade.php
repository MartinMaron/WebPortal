


 <div>
    <div class="max-w-7xl w-full mx-auto sm:px-6 lg:px-8">
        <!-- Top Bar -->
        <div class="">
            <div class="sm:w-full m-4 lg:m-0 lg:mt-8">
                <x-input.search wire:model="filter.search" />
            </div>
            <div>
                <x-button.link wire:click="toggleEditVorauszahlungen">@if ($editVorauszahlungen) Hide @endif Advanced Search...</x-button.link>
            </div>
            {{-- <div class="space-x-2 flex items-center">
                <x-input.group borderless paddingless for="perPage" label="Per Page">
                    <x-input.select wire:model="perPage" id="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </x-input.select>
                </x-input.group>

                <x-dropdown label="Bulk Actions">
                    <x-dropdown.item type="button" wire:click="exportSelected" class="flex items-center space-x-2">
                        <x-icon.download class="text-cool-gray-400"/> <span>Export</span>
                    </x-dropdown.item>

                    <x-dropdown.item type="button" wire:click="$toggle('showDeleteModal')" class="flex items-center space-x-2">
                        <x-icon.trash class="text-cool-gray-400"/> <span>Delete</span>
                    </x-dropdown.item>
                </x-dropdown>

                <livewire:import-transactions />

                <x-button.primary wire:click="create"><x-icon.plus/> New</x-button.primary>
            </div> --}}
        </div>
        <script>
            function getResolution() {
                alert("Your screen resolution is: " + screen.width + "x" + screen.height);
            }
            // getResolution()
            </script>

        <div class="max-w-7xl">
            <x-table class="occu-table">
                <x-slot name="head">
                    <x-table.thead class="">
                    @if ($filtered->count()!=0)
                        <x-table.tr class="">
                            <x-table.th class="text-left w-20 occu-thead-th">No.</x-table.th>
                            <x-table.th class="text-left w-30 occu-thead-th sm:visible">Lage</x-table.th>
                            <x-table.th class="text-left w-80 occu-thead-th">Nutzer</x-table.th>
                            <x-table.th class="text-center occu-thead-th">Zeitraum</x-table.th>
                            <x-table.th class="text-left w-30 occu-thead-th">MwSt.</x-table.th>
                            <x-table.th class="text-left w-30 occu-thead-th">UAW.</x-table.th>
                            <x-table.th class="text-left w-50 occu-thead-th">m²</x-table.th>
                            <x-table.th class="text-left w-50 occu-thead-th">pe</x-table.th>
                            <x-table.th class="text-left w-40 occu-thead-th">Vorausz.
                                <x-button.link wire:click="toggleEditVorauszahlungen" class="hover:bg-sky-700"><i class="fa-solid fa-pencil {{ $editVorauszahlungen ? 'text-red-500': 'text-green-400' }} "></i></x-button.link>
                            </x-table.th>
                        </x-table.tr>
                    @endif

                    </x-table.thead>
                </x-slot>
                <x-slot name="body" class="occu-tbl-container">
                    <x-table.tbody class="occu-tbody">
                        @forelse ($filtered as $occupant)
                        {{ $this->setCurrent($occupant)  }}
                        {{ $this->current->nachname }}

                        <x-table.tr wire:loading.class.delay="opacity-50" wire:key="row-{{ $occupant->id }}">
                            <x-table.th class="occu-th text-left w-20" style="display:table-cell !important;">{{ $occupant->NutzerKennnummer }}</x-table.th>
                            <x-table.th class="occu-th text-left w-30">{{ $occupant->lage }}</x-table.th>
                            <x-table.td wire:click="edit({{ $occupant->id }})" class="occu-td w-full hover:bg-sky-100" style="min-width: 20rem;">

                                <button class="w-full text-left" type="button">{{ $occupant->vorname . ' '. $occupant->nachname }}</button>
                                 </x-table.th>
                            <x-table.td class="occu-td text-center" style="min-width: 14rem; max-width: 14rem">
                                <div class="flex px-2">
                                    <span>{{ $occupant->dateFrom }}</span>
                                    <span class="w-4">-</span>
                                    @if ($occupant->dateTo)
                                        <span>{{ $occupant->dateTo }}</span>
                                    @else
                                       <button class="mgc-button w-40 " type="button" data-hover="Auszug" data-active="Los"><span class="w-40"><i class="text-sky-200 fa-solid fa-house-person-leave"></i></span></button>
                                    @endif
                                </div>
                            </x-table.td>
                            <x-table.td class="occu-td w-30 text-center">
                                <x-icon.fonts.checked :value='$occupant->vat'></x-icon.fonts.checked>
                            </x-table.td>
                            <x-table.td class="occu-td w-30 text-center">
                                <x-icon.fonts.checked :value='$occupant->uaw'></x-icon.fonts.checked>
                            </x-table.td>
                            <x-table.td class="occu-td w-30 text-center">
                                <span class="">{{ $occupant->qmkc }}</span>
                            </x-table.td>
                            <x-table.td class="occu-td w-30 text-center">
                                <x-table.cell.span>{{ $occupant->pe }}</x-table.cell.span>
                            </x-table.td>
                            <x-table.td class="occu-td w-40 p-0 text-center" style="min-width: 7rem; max-width: 7rem">
                                @if ($editVorauszahlungen)
                                    {{-- <input type="text" name="account-number" class="text-right focus:ring-indigo-500 p-1 px-2 m-0 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="00,00"> --}}

                                    <livewire:user.occupant.vinput :occupant='$occupant'/>


                                    @else
                                    <span class="">{{ $occupant->vorauszahlung }}</span>
                                @endif
                            </x-table.td>
                       </x-table.tr>
                        @empty
                        <x-table.tr>

                                <div class="flex justify-center items-center space-x-2 bg-sky-100">
                                     <span class="font-medium py-8 text-cool-gray-400 text-xl">nichts gefunden...</span>
                                </div>

                        </x-table.tr>
                        @endforelse
                    </x-table.tbody>

                  

                </x-slot>
            </x-table>
        </div>
        <div class="text-center">
            .{{-- ..prose-pink --}}
        </div>
        {{-- 'nekoId', 'realestate_id', 'unvid', 'budguid','nutzeinheitNo', 'dateFrom', 'dateTo', 'anrede', 'title', 'nachname', 'vorname', 'address',
        'vat', 'uaw', 'qmkc', 'qmww', 'pe', 'bemerkung', 'vorauszahlung', 'lokalart', 'customEinheitNo', 'lage', --}}
{{--
        <x-modal.dialog>
            <x-slot name="title">Edit</x-slot>
            <x-slot name="content">TExt</x-slot>
            <x-slot name="footer">
                <x-button.primary>Edit</x-button.primary>
            </x-slot>


        </x-modal.dialog> --}}

    </div>




    <!-- Save Transaction Modal -->
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model.defer="showEditModal">
            <x-slot name="title">
                @if ($editing->nachname)
                    Nutzer {{ $editing->nachname }}  bearbeiten
                @else
                    Neuer Nutzer
                @endif
            </x-slot>

            <x-slot name="content">


                {{-- <x-input.group for="title" label="Title" :error="$errors->first('editing.title')">
                    <x-input.text wire:model="editing.title" id="title" placeholder="Title" />
                </x-input.group>

                <x-input.group for="amount" label="Amount" :error="$errors->first('editing.amount')">
                    <x-input.money wire:model="editing.amount" id="amount" />
                </x-input.group>

                <x-input.group for="status" label="Status" :error="$errors->first('editing.status')">
                    <x-input.select wire:model="editing.status" id="status">
                        @foreach (App\Models\Transaction::STATUSES as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </x-input.select>
                </x-input.group> --}}

                {{-- <x-input.group for="date_for_editing" label="Date" :error="$errors->first('editing.date_for_editing')">
                    <x-input.date wire:model="editing.date_for_editing" id="date_for_editing" />
                </x-input.group> --}}
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit">Save</x-button.primary>
            </x-slot>
        </x-modal.dialog>
    </form>

</div>
