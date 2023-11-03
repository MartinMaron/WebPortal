
<div>
    
    <!-- Save Nutzer Bearbeiten -->
    <form wire:submit.prevent="closeModal(true)">
    <x-modal.dialog class=" bg-sky-50" minWidth="680px" maxWidth="800px" wire:model="showEditModal">
            <x-slot name="title">
                <div class="">
                    <div class="flex">
                        @if ($current->nachname)
                            <div class="text-lg font-bold text-sky-500">{{$current->nachname.' '.$current->vorname}}</div> <x-icon.fonts.pen-line class="h-6 pl-10 mt-1 text-sky-500" ></x-icon.fonts.pen-line>
                        @else
                            <div class="text-lg font-bold text-sky-500">Neuer Nutzer</div> <x-icon.fonts.pen-line class="h-6 pl-10 mt-1 text-sky-500" ></x-icon.fonts.pen-line>
                        @endif
                    </div>

                    <div class="px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">{{ $pages[$currentPage]['heading'] }}</h3>
                        <p class="mt-1 text-sm text-gray-600">{{ $pages[$currentPage]['subheading'] }}</p>
                    </div>
                </div>
            </x-slot>
            <!-- Dialog Content -->
            <x-slot name="content">
                <div class="{{ $dialogMode == 'change' ? 'occu-h-600 sm:occu-h-350' : 'occu-h-500 sm:occu-h-300' }} ">

                @if ($errors->isNotEmpty())
                    <div class="flex text-sm bg-red-100 border border-red-400 text-red-700 px-1 py-1 rounded relative mb-2" role="alert">
                        <span class="block sm:inline"><strong class="font-bold">Oops! </strong>einige Informationen fehlen oder sind nicht korrekt.</span>
                    </div>
                @endif


                @if ($currentPage === 1)
                    @if ($dialogMode == 'change')
                        <div class="block p-2 mb-4 text-sm sm:flex sm:justify-between sm:items-center bg-sky-100 border-2 rounded border-sky-600">
                            <div class="">
                                <div class="">Leerstand</div>
                                <x-input.checkbox wire:model="hasLeerstand"></x-input.checkbox>
                            </div>

                            
                            <div class="">
                                <div class="">{{ $hasLeerstand ? 'Leerstand seit:' : 'neuer Nutzer seit:' }}</div>
                                <x-input.date class="w-28"
                                wire:model.lazy="dateFromNewOccupant"
                                type="text"
                                :error="$errors->first('dateFromNewOccupant')"
                                id="" >
                                </x-input.date>
                            </div>

                            @if ($hasLeerstand)
                                <div class="sm:px-2">
                                    <div class="">Nutzer nach Leerstand seit:</div>
                                    <x-input.date class="w-28"
                                    wire:model.lazy="dateFromNewOccupantLeerstand"
                                    :error="$errors->first('dateFromNewOccupantLeerstand')"
                                    type="text"
                                    id="">
                                    </x-input.date>
                                </div>
                            @endif
                        </div>
                    @else
                        <!-- Zeitraum -->
                        <x-input.group
                        class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10"
                        for="current.date_from_editing" label="Zeitraum">
                            <div class="flex items-end justify-between h-10 sm:h-8">
                                <x-input.date
                                    wire:model.lazy="current.dateFrom"
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
                    @endif

                    <!-- Anrede -->
                    <x-input.group
                            class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10"
                            for="anrede" label="Anrede" :error="$errors->first('current.anrede')"
                            x-data
                            x-init="$refs.inputAnrede.focus()"
                            >
                        <x-input.select
                            x-ref="inputAnrede"
                            class="h-10 border-b bg-sky-50 sm:h-8 focus:border-0" wire:model="current.anrede" id="anrede" placeholder="Bitte auswählen" value="">
                            @foreach ($this->salutations as $label)
                            <div class="h-10">
                                <option value="{{ $label->bezeichnung }}">
                                    {{ $label->bezeichnung }}
                                </option>
                            </div>
                            @endforeach
                        </x-input.select>
                    </x-input.group>
                    <!-- Vorname -->
                    <x-input.group
                    class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10"
                    for="vorname" label="Vorname" :error="$errors->first('current.vorname')">
                        <x-input.text class="h-10 bg-sky-50 sm:h-8" wire:model.lazy="current.vorname" id="vorname" placeholder="..." />
                    </x-input.group>
                    <!-- Nachname -->
                    <x-input.group
                    class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10" hoheOnError="h-26 sm:h-13" 
                    for="nachname" label="Nachname" :error="$errors->first('current.nachname')">
                        <div x-data x-on:focus="$el.select()" >
                            <x-input.text class="h-10 bg-sky-50 sm:h-8" wire:model.lazy="current.nachname" id="nachname" placeholder="..." />
                        </div>
                    </x-input.group>
                    <!-- E-mail -->
                    <x-input.group
                        class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10"
                        for="email" label="E-mail" :error="$errors->first('current.email')">
                        <x-input.text class="h-10 bg-sky-50 sm:h-8" wire:model.lazy="current.email" id="email" placeholder="..." />
                    </x-input.group>
                    <!-- Telefonnummer -->
                    <x-input.group
                        class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10"
                        for="telephone_number" label="Telefonnummer" :error="$errors->first('current.telephone_number')">
                        <x-input.text class="h-10 bg-sky-50 sm:h-8" wire:model.lazy="current.telephone_number" id="telephone_number" placeholder="..." />
                    </x-input.group>
                
                     
                @elseif ($currentPage === 2)
                    <!-- Street Hnr-->
                    <x-input.group
                    class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10"
                    for="street" label="Strasse / Hnr">
                        <div class="flex flex-row h-10 sm:h-8">
                            <div class="h-full basis-5/6">
                                <x-input.text class="h-10 bg-sky-50 sm:h-8" wire:model.lazy="current.street" id="street" placeholder="..." />
                            </div>
                            <div class="h-full basis-1/6">
                                <x-input.text class="h-10 bg-sky-50 sm:h-8" wire:model.lazy="current.houseNr" id="houseNr" placeholder="..." />
                            </div>
                        </div>
                    </x-input.group>
                    <!-- PLZ Ort-->
                    <x-input.group
                    class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10"
                    for="city" label="PLZ / Ort">
                        <div class="flex flex-row h-10 sm:h-8">
                            <div class="basis-1/5">
                                <x-input.text class="h-10 bg-sky-50 sm:h-8" wire:model.lazy="current.postcode" id="postcode" placeholder="..." />
                            </div>
                            <div class="basis-4/5">
                                <x-input.text class="h-10 bg-sky-50 sm:h-8" wire:model.lazy="current.city" id="city" placeholder="..." />
                            </div>
                        </div>
                    </x-input.group>
                    <!-- Adresse -->
                    <x-input.group
                        hohe="h-30"
                        hoheLabel="h-30 sm:h-full sm:pt-3"
                        bottom=true for="address" label="Adresse" :error="$errors->first('current.address')">
                        <x-input.textarea wire:model.lazy="current.address" id="address" placeholder="..." />
                    </x-input.group>                
                @elseif ($currentPage === 3)
                    <!-- Wohnungsdaten-->
                    <div class="mt-3">
                    <!-- Umlageausfallwagnis-->
                        <x-input.group
                        class="my-2 " paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10"
                        for="uaw" label="zusätzliche Belastungen" :error="$errors->first('current.uaw')">

                            <div class="flex items-center justify-between h-10 sm:h-8">
                                <div class="pl-1 basis-2/5">
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
                                    <x-input.text class="h-10 rounded bg-sky-50 sm:h-8" wire:model.lazy="current.qmkc" id="qmkc" placeholder="Heizfläche in m²" />
                                </div>
                                <div class="basis-3/5">
                                    <x-input.text class="h-10 rounded bg-sky-50 sm:h-8" wire:model.lazy="current.pe" id="pe" placeholder="Personenanzahl" />
                                </div>
                            </div>
                        </x-input.group>
                        <!-- Lage u. Wohnungsart -->
                        <x-input.group
                        class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10"
                        for="lage" label="Lage u. Lokalart">
                            <div class="flex items-center justify-around h-10 sm:h-8">
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
                            <x-input.text class="h-10 bg-sky-50 sm:h-8" wire:model.lazy="current.vorauszahlung_editing" id="vorauszahlung" placeholder="0,00" />
                        </x-input.group>
                        <!-- eigene Wohnungsbezeichnung -->
                        <x-input.group
                        class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10"
                        for="customEinheitNo" label="interne Wohnungnummer" :error="$errors->first('current.customEinheitNo')">
                            <x-input.text class="h-10 bg-sky-50 sm:h-8" wire:model="current.customEinheitNo" id="customEinheitNo" placeholder="interne Wohnungnummer" />
                        </x-input.group>
                        
                    </div>


                @elseif ($currentPage === 4)
                    <div class="mt-1 mb-4 sm:mt-2">
                        <x-input.group
                            hohe="h-30"
                            hoheLabel="h-30 sm:h-full sm:pt-3"
                            bottom=false for="bemerkung" label="Bemerkung" :error="$errors->first('current.bemerkung')">
                            <x-input.textarea  wire:model="current.bemerkung" id="bemerkung" placeholder="..." />
                        </x-input.group>
                    </div>
                @endif
                </div>
                      
            </x-slot>

            <x-slot name="footer">
                    @if ($currentPage === 1)
                        <div></div>
                    @else
                        <x-button.secondary wire:click="goToPreviousPage">Zurück</x-button.secondary>
                    @endif

                    @if ($currentPage === count($pages))
                        <x-button.primary type="submit">Speichern</x-button.primary> 
                    @else
                        <x-button.primary wire:click="goToNextPage">weiter</x-button.secondary>
                    @endif
                



               {{--  <x-button.secondary wire:click="$set('showEditModal', false)">Abbrechen</x-button.secondary>

                <x-button.primary type="submit">Speichern</x-button.primary> --}}
            </x-slot>
    </x-modal.dialog>
    </form>
</div>
