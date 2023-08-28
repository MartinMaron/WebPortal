
<div>
    <!-- Save Nutzer Bearbeiten -->
    <form wire:submit.prevent="closeModal(true)">
    <x-modal.dialog class=" bg-sky-50" minWidth="680px" maxWidth="800px" wire:model.defer="showEditModal">
            <x-slot name="title">
                <div class="flex">
                    @if ($this->current->nachname)
                        <div class="text-lg font-bold text-sky-500">{{ $this->current->nachname.' '.$current->vorname}}</div> <x-icon.fonts.pen-line class="h-6 pl-10 mt-1 text-sky-500" ></x-icon.fonts.pen-line>
                    @else
                        <div class="text-lg font-bold text-sky-500">Neuer Nutzer</div> <x-icon.fonts.pen-line class="h-6 pl-10 mt-1 text-sky-500" ></x-icon.fonts.pen-line>
                    @endif
                </div>
            </x-slot>
            <!-- Dialog Content -->
            <x-slot name="content">
                <div class="container max-w-3xl px-4 mx-auto sm:px-8">
                    <div class="flex flex-col mb-8 text-base text-gray-800 divide-y main-question">
                        <div class="px-1 py-1 item" x-data="{isOpen : false}">
                        <a href="#" class="flex items-center justify-between" @click.prevent="isOpen = true">
                            <h4 :class="{'text-blue-600 font-bold text-lg' : isOpen == true}">Nutzer info</h4>
                            <svg
                                class="w-5 h-5 text-lg text-gray-500"
                                fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </a>
                        <div x-show="isOpen" @click.away="isOpen = false" class="mt-3" :class="{'text-gray-600 text-sm' : isOpen == true}">
                            <div>
                                <!-- Anrede -->
                                <x-input.group
                                        class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10"
                                        for="anrede" label="Anrede" :error="$errors->first('current.anrede')"
                                        x-data
                                        x-init="$refs.inputAnrede.focus()"
                                        >
                                    <x-input.select
                                        x-ref="inputAnrede"
                                        class="h-10 border-b bg-sky-50 sm:h-8 focus:border-0" wire:model.lazy="current.anrede" id="anrede" placeholder="Bitte auswählen" value="">
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
                                    <div class="flex items-end justify-between h-10 sm:h-8">
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
                                    <x-input.text class="h-10 bg-sky-50 sm:h-8" wire:model.lazy="current.vorname" id="vorname" placeholder="..." />
                                </x-input.group>
                                <!-- Nachname -->
                                <x-input.group
                                    class="my-1" paddingLabel="" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10"
                                    for="nachname" label="Nachname" :error="$errors->first('current.nachname')">
                                    <div x-data x-on:focus="$el.select()" >
                                        <x-input.text class="h-10 bg-sky-50 sm:h-8" wire:model.lazy="current.nachname" id="nachname" placeholder="..." />
                                    </div>
                                </x-input.group>
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
                                <div class="mt-1 mb-4 sm:mt-2">
                                    <x-input.group
                                        hohe="h-30"
                                        hoheLabel="h-30 sm:h-full sm:pt-3"
                                        bottom=true for="address" label="Adresse" :error="$errors->first('current.address')">
                                        <x-input.textarea wire:model.lazy="current.address" id="address" placeholder="..." />
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-1 py-1 item" x-data="{isOpen : false}">
                    <a href="#" class="flex items-center justify-between" @click.prevent="isOpen = true">
                        <h4 :class="{'text-blue-600 font-bold text-lg' : isOpen == true}">Wohnung info</h4>
                        <svg
                            class="w-5 h-5 text-lg text-gray-500"
                            fill="none" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    <div x-show="isOpen" @click.away="isOpen = false" class="mt-3" :class="{'text-gray-600 text-sm' : isOpen == true}">
                        <div>
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
                                        <x-input.text class="h-10 rounded bg-sky-50 sm:h-8" wire:model.lazy="current.qmkc_editing" id="qmkc" placeholder="Heizfläche in m²" />
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
                            <div class="mt-1 mb-4 sm:mt-2">
                                <x-input.group
                                    hohe="h-30"
                                    hoheLabel="h-30 sm:h-full sm:pt-3"
                                    bottom=false for="bemerkung" label="Bemerkung" :error="$errors->first('current.bemerkung')">
                                    <x-input.textarea  wire:model="current.bemerkung" id="bemerkung" placeholder="..." />
                                </x-input.group>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-1 py-1 item" x-data="{isOpen : false}">
                    <a href="#" class="flex items-center justify-between" @click.prevent="isOpen = true">
                        <h4 :class="{'text-blue-600 font-bold text-lg' : isOpen == true}">Zähler</h4>
                        <svg
                            class="w-5 h-5 text-lg text-gray-500"
                            fill="none" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    <div x-show="isOpen" @click.away="isOpen = false" class="mt-3" :class="{'text-gray-600 text-sm' : isOpen == true}">
                        <div>
                        </div>
                    </div>
                </div>
                <div class="px-1 py-1 item" x-data="{isOpen : false}">
                    <a href="#" class="flex items-center justify-between" @click.prevent="isOpen = true">
                        <h4 :class="{'text-blue-600 font-bold text-lg' : isOpen == true}">Verbrauchsinfo</h4>
                        <svg
                            class="w-5 h-5 text-lg text-gray-500"
                            fill="none" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </a>
                    <div x-show="isOpen" @click.away="isOpen = false" class="mt-3" :class="{'text-gray-600 text-sm' : isOpen == true}">
                        <div>
                            <div>
                                <x-input.group class="pb-2 border-0"
                                    :error="$errors->first('userEmail.seit')"
                                    for="costAmount-detailModal-dateFrom" label="seit" hoheLabel="h-6 sm:h-8 sm:pt-1 sm:pb-2" hohe="h-20 sm:h-10">
                                    <x-input.date
                                        wire:model.lazy="userEmail.seit"
                                        hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10"
                                        id="verbrauchsinfoUserEmail-detailmodal-date_from_editing"
                                        class="bg-sky-50 sm:h-8"
                                    >
                                    </x-input.date>
                                </x-input.group>
                                <x-input.group class="border-0"
                                    for="costAmount-detailModal-dateTo" label="bis" hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10"
                                    :error="$errors->first('userEmail.bis')">
                                    <x-input.date
                                        wire:model.lazy="userEmail.bis"
                                        hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10"
                                        id="verbrauchsinfoUserEmail-detailmodal-dateTo"
                                        class="bg-sky-50 sm:h-8"
                                    >
                                    </x-input.date>
                                </x-input.group>
                                <x-input.group
                                    class="border-0" for="userEmail.firstinitUsername" label="Username für Webaccount" :error="$errors->first('userEmail.firstinitUsername')"
                                    hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10">
                                    <x-input.text class="bg-sky-50 sm:h-8" wire:model.lazy="userEmail.firstinitUsername" id="userEmail.firstinitUsername" />
                                </x-input.group>
                                <x-input.group
                                    class="border-0" for="userEmail.email" label="Email" :error="$errors->first('userEmail.email')"
                                    hoheLabel="h-6 sm:h-8 sm:pt-1" hohe="h-20 sm:h-10">
                                    <x-input.text class="bg-sky-50 sm:h-8" wire:model.lazy="userEmail.email" id="userEmail.email" />
                                </x-input.group>
                            </div>
                        </div>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showEditModal', false)">Abbrechen</x-button.secondary>

                <x-button.primary type="submit">Speichern</x-button.primary>
            </x-slot>
    </x-modal.dialog>
    </form>
</div>


