

<div>
    <div  class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <!-- Top Bar -->
        <div class="">
            <div class="sm:w-full m-4 lg:m-0 lg:mt-8">
                <x-input.search wire:model.debounce.1000ms="filters.search" />
            </div>
        </div>

        <div class="max-w-7xl">
            <x-table class="occu-table">
                <x-slot name="head">
                    <x-table.thead class="">
                    @if ($rows->count()!=0)
                        <x-table.tr class="">
                            <x-table.th class="text-left w-20 occu-thead-th">No.</x-table.th>
                            <x-table.th class="text-left w-30 occu-thead-th">Int. No.</x-table.th>
                            <x-table.th class="text-left w-30 occu-thead-th sm:visible">Lage</x-table.th>
                            <x-table.th class="text-left w-80 occu-thead-th">Nutzer</x-table.th>
                            <x-table.th class="text-center occu-thead-th">Zeitraum</x-table.th>
                            <x-table.th class="text-left w-30 occu-thead-th">MwSt.</x-table.th>
                            <x-table.th class="text-left w-50 occu-thead-th">m²</x-table.th>
                            <x-table.th class="text-left w-50 occu-thead-th">pe</x-table.th>
                            <x-table.th class="text-right w-40 occu-thead-th">Vorausz.
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
                            <x-table.th class="occu-th text-left w-20" style="display:table-cell !important;">{{ $occupant->NutzerKennnummer }}</x-table.th>
                            <x-table.th class="occu-th text-left w-40" style="display:table-cell !important;">{{ $occupant->customEinheitNo }}</x-table.th>

                            <x-table.th class="occu-th text-left w-30">{{ $occupant->lage }}</x-table.th>
                            <x-table.td wire:click="edit({{ $occupant->id }})" class="occu-td w-full hover:bg-sky-100" style="min-width: 20rem;">
                                <button tabindex="-1" class="w-full text-left" type="button">{{ $occupant->vorname . ' '. $occupant->nachname }}</button>
                            </x-table.th>
                            <x-table.td class="occu-td text-center" style="min-width: 14rem; max-width: 14rem">
                                <div class="flex px-2">
                                    <span>{{ $occupant->date_from_editing }}</span>
                                    <span class="w-4">-</span>
                                    @if ($occupant->dateTo)
                                        <span>{{ $occupant->date_to_editing }}</span>
                                    @else
                                       <button tabindex="-1" class="mgc-button w-40 " type="button" data-hover="Auszug" data-active="Los"><span class="w-40"><i class="text-sky-200 fa-solid fa-house-person-leave"></i></span></button>
                                    @endif
                                </div>
                            </x-table.td>
                            <x-table.td class="occu-td w-30 text-center">
                                <x-icon.fonts.checked :value='$occupant->vat'></x-icon.fonts.checked>
                            </x-table.td>
                            <x-table.td class="occu-td w-30 text-center">
                                <span class="">{{number_format($occupant->qmkc,  2, ',', '.') }}</span>
                            </x-table.td>
                            <x-table.td class="occu-td w-30 text-center">
                                <x-table.cell.span>{{ $occupant->pe }}</x-table.cell.span>
                            </x-table.td>
                            <x-table.td class="occu-td w-40 p-0 text-right" style="min-width: 7rem; max-width: 7rem">
                                @if ($editVorauszahlungen)
                                    <livewire:user.occupant.vorauszahlung-edit :occupant='$occupant'/>
                                @else
                                    <span class=" pr-2">{{number_format($occupant->vorauszahlung,  2, ',', '.') }}</span>
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
    </div>



    <!-- Save Nutzer Modal -->
    <form wire:submit.prevent="save">
        <x-modal.dialog class=" bg-sky-50" minWidth="640px" maxWidth="800px" wire:model.defer="showEditModal">
        <div>

           <!-- Dialog Title -->
            <x-slot name="title">
                <div class="flex">
                    @if ($current->nachname)
                        <div class="text-lg font-bold text-sky-500">{{ $current->nachname }}</div> <x-icon.fonts.pen-line class="text-sky-500 pl-10 h-6 mt-1" ></x-icon.fonts.pen-line>
                    @else
                        <div class="text-lg font-bold text-sky-500">Neuer Nutzer</div> <x-icon.fonts.pen-line class="text-sky-500 pl-10 h-6 mt-1" ></x-icon.fonts.pen-line>
                    @endif
                </div>
            </x-slot>
            <!-- Dialog Content -->
            <x-slot name="content">
                <!-- Anrede -->
                <x-input.group
                        class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10" 
                        for="anrede" label="Anrede" :error="$errors->first('current.anrede')"
                        x-data
                        x-init="$refs.inputAnrede.focus()"
                        >
                    <x-input.select
                        x-ref="inputAnrede"
                        class="bg-sky-50 h-10 sm:h-8 border-b focus:border-0" wire:model.lazy="current.anrede" id="anrede" placeholder="Bitte auswählen" value="">
                        @foreach ($salutations as $label)
                        <div class="h-10">
                            <option value="{{ $label->bezeichnung }}">
                                {{ $label->bezeichnung }}
                            </option>
                        </div>
                        @endforeach
                    </x-input.select>
                </x-input.group>
                <!-- Zeitraum -->
                <x-input.group  
                    class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10" 
                      for="current.date_from_editing" label="Zeitraum">
                    <div class="flex justify-between items-end h-10 sm:h-8">
                        <x-input.date
                            wire:model.lazy="current.date_from_editing"
                            type="text"
                            :error="$errors->first('current.dateFrom')"
                            id="current.dateFrom" >
                        </x-input.date>
                        <div class="sm:mt-3 sm:pt-1">
                            <span class="">
                                -
                            </span>
                        </div>
                        {{-- <x-input.date-picker wire:model.lazy="current.dateTo" :error="$errors->first('current.dateTo')" fieldname="dateto" calendarOff="false" leadingIcon="false" type="text" id="dateTo"></x-input.date-picker> --}}
                        <x-input.date
                            wire:model.lazy="current.date_to_editing"
                            :error="$errors->first('current.dateTo')"
                            type="text"
                            id="current.dateTo">
                        </x-input.date>
                    </div>
                </x-input.group>

                 <!-- Vorname -->
                <x-input.group 
                    class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10" 
                    for="vorname" label="Vorname" :error="$errors->first('current.vorname')">
                    <x-input.text class="bg-sky-50 h-10 sm:h-8" wire:model.lazy="current.vorname" id="vorname" placeholder="..." />
                </x-input.group>
                <!-- Nachname -->
                <x-input.group 
                    class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10" 
                    for="nachname" label="Nachname" :error="$errors->first('current.nachname')">
                    <div x-data x-on:focus="$el.select()" >
                        <x-input.text class="bg-sky-50 h-10 sm:h-8" wire:model.lazy="current.nachname" id="nachname" placeholder="..." />
                    </div>
                </x-input.group>
                <!-- Street Hnr-->
                <x-input.group 
                    class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10" 
                    for="street" label="Strasse / Hnr">
                    <div class="flex flex-row h-10 sm:h-8">
                        <div class="basis-5/6 h-full">
                            <x-input.text class="bg-sky-50 h-10 sm:h-8" wire:model.lazy="current.street" id="street" placeholder="..." />
                         </div>
                        <div class="basis-1/6 h-full">
                            <x-input.text class="bg-sky-50 h-10 sm:h-8" wire:model.lazy="current.houseNr" id="houseNr" placeholder="..." />
                        </div>
                    </div>
                </x-input.group>
                <!-- PLZ Ort-->
                <x-input.group 
                    class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10" 
                    for="city" label="PLZ / Ort">
                    <div class="flex flex-row h-10 sm:h-8">
                        <div class="basis-1/5">
                            <x-input.text class="bg-sky-50 h-10 sm:h-8" wire:model.lazy="current.postcode" id="postcode" placeholder="..." />
                         </div>
                        <div class="basis-4/5">
                            <x-input.text class="bg-sky-50 h-10 sm:h-8" wire:model.lazy="current.city" id="city" placeholder="..." />
                        </div>
                    </div>
                </x-input.group>
                <!-- Adresse -->
                <div class="mt-1 mb-4 sm:mt-2">
                    <x-input.group 
                        hohe="h-30" 
                        hoheLabel="h-30 sm:h-full sm:pt-3"
                        bottom=true for="address" label="Adresse" :error="$errors->first('current.address')">
                        <x-input.textarea wire:model.lazy="current.address" id="address" placeholder="..." />
                    </x-input.group>
                </div>
                <!-- Umlageausfallwagnis-->
                <x-input.group 
                    class="my-2 " paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10" 
                    for="uaw" label="zusätzliche Belastungen" :error="$errors->first('current.uaw')">
                    <div class="flex justify-between items-center h-10 sm:h-8">
                        <div class="basis-2/5 pl-1">
                            <x-input.checkbox wire:model="current.vat">MwSt</x-input.checkbox>
                        </div>
                        <div class="basis-3/5">
                            <x-input.checkbox wire:model="current.uaw">Umlageausfallwag.</x-input.checkbox>
                        </div>
                    </div>
                </x-input.group>

                <!-- Fläche und Personen -->
                <x-input.group 
                    class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10" 
                    for="qmkc" label="Fläche / Personenzahl" :error="$errors->first('current.qmkc')">
                    <div class="flex flex-row h-10 sm:h-8">
                        <div class="basis-3/5">
                            <x-input.text class="bg-sky-50 h-10 sm:h-8 rounded" wire:model.lazy="current.qmkc_editing" id="qmkc" placeholder="Heizfläche in m²" />
                        </div>
                        <div class="basis-3/5">
                            <x-input.text class="bg-sky-50 h-10 sm:h-8 rounded" wire:model.lazy="current.pe" id="pe" placeholder="Personenanzahl" />
                        </div>
                    </div>
                </x-input.group>
                <!-- Lage u. Wohnungsart -->
                <x-input.group 
                    class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10" 
                    for="lage" label="Lage u. Lokalart">
                    <div class="flex justify-around items-center h-10 sm:h-8">
                        <x-input.autocomplete
                            wire:model.lazy="current.lage"
                            customPlaceholder="Lage"
                            customId="0"
                            fieldname="inpLage"
                            data="[
                                'EG.', 'EG. L.', 'EG. R.','EG. ML.','EG. MR.',
                                '1 OG.', '1 OG. L.', '1 OG. R.','1 OG. ML.','1 OG. MR.',
                                '2 OG.', '2 OG. L.', '2 OG. R.','2 OG. ML.','2 OG. MR.',
                                '3 OG.', '3 OG. L.', '3 OG. R.','3 OG. ML.','3 OG. MR.',
                                '4 OG.', '4 OG. L.', '4 OG. R.','4 OG. ML.','4 OG. MR.',
                                '5 OG.', '5 OG. L.', '5 OG. R.','5 OG. ML.','5 OG. MR.',
                                '6 OG.', '6 OG. L.', '6 OG. R.','6 OG. ML.','6 OG. MR.',
                                '7 OG.', '7 OG. L.', '7 OG. R.','7 OG. ML.','7 OG. MR.',
                                '8 OG.', '8 OG. L.', '8 OG. R.','8 OG. ML.','8 OG. MR.',
                                'DG.', 'DG. L.', 'DG. R.','DG. ML.','DG. MR.',
                                'SUT.', 'KELLER', 'Anbau','Hinterhof','sonstiges'
                            ]"
                            :error="$errors->first('current.lage')"
                        >
                        </x-input.autocomplete>
                        <x-input.autocomplete
                            wire:model.lazy="current.lokalart"
                            customPlaceholder="Lokalart"
                            customId="0"
                            fieldname="inpLokalart"
                            data="[
                            'Appartament', 'Allgemeine Räume','Atelier', 'Büro', 'Einzelhandel + Lager',
                            'Einzelhandel','Etage', 'Garage','Gaststätte', 'Gewerbe', 'Halle', 'Halle u. Büro', 'Keller',
                            'Laden', 'Lager', 'Logische Einheit', 'Praxis', 'Physiotherapie', 'Stellplatz', 'Tennishalle', 'Wohnung', 'Zimmer'
                            ]"
                        :error="$errors->first('current.lokalart')"
                        >
                        </x-input.autocomplete>
                    </div>
                </x-input.group>
                <!-- Vorauszahlung -->
                <x-input.group 
                    class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10" 
                    for="vorauszahlung" label="Vorauszahlung" :error="$errors->first('current.vorauszahlung_editing')">
                    <x-input.text class="bg-sky-50 h-10 sm:h-8" wire:model.lazy="current.vorauszahlung_editing" id="vorauszahlung" placeholder="0,00" />
                </x-input.group>
                <!-- eigene Wohnungsbezeichnung -->
                <x-input.group 
                    class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10" 
                    for="customEinheitNo" label="interne Wohnungnummer" :error="$errors->first('current.customEinheitNo')">
                    <x-input.text class="bg-sky-50 h-10 sm:h-8" wire:model="current.customEinheitNo" id="customEinheitNo" placeholder="interne Wohnungnummer" />
                </x-input.group>
                <div class="mt-1 mb-4 sm:mt-2">
                    <x-input.group 
                        hohe="h-30" 
                        hoheLabel="h-30 sm:h-full sm:pt-3"
                        bottom=false for="bemerkung" label="Bemerkung" :error="$errors->first('current.bemerkung')">
                        <x-input.textarea  wire:model="current.bemerkung" id="bemerkung" placeholder="..." />
                    </x-input.group>
                </div>
            
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Abbrechen</x-button.secondary>

                <x-button.primary type="submit">Speichern</x-button.primary>
            </x-slot>
        </div>
          
        </x-modal.dialog>
    </form>






</div>
