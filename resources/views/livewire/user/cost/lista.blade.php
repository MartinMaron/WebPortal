

<div>
    <!-- Main -->
    <div class="max-w-7xl w-full mx-auto sm:px-6 lg:px-8">
        <!-- Einstellungen -->
        <div class="mt-4 py-3 border border-black rounded-md shadow">
            <div  x-data="{ open: false }">
                <div class="flex justify-between">
                    <button x-on:click="open = ! open"
                        class="flex items-end justify-items-end w-full font-bold text-2xl px-3 py-1"
                        >
                            <span x-show="!open" aria-hidden="true" class="mr-2 mb-1 text-xl"><i class="fa-solid fa-caret-right"></i></span>
                            <span x-show="open" aria-hidden="true" class="mr-2 mb-1 text-xl"><i class="fa-solid fa-caret-down"></i></span>
                            <div class="flex items-end content-end">
                                <h2 class="text-xl mb-1 pr-1">Einstellungen</h2>
                                <div x-show="!open"  class ="flex-1 mb-1-2 text-gray-500 text-left text-sm line-clamp-1 italic font-extralight" >Kosteneingabe, Bankverbindung, Heizstromberechnung etc. </div>
                            </div>
                    </button>
                    <div wire:click="togleShowEditFields"
                         class="relative inline-block mt-1 mr-6 pt-1 pb-2 w-40  align-middle select-none transition duration-200 ease-in">
                        <input wire:model="showEditFields" type="checkbox" name="user-cost-lista-kosteneingabetoggle" id="user-cost-lista-kosteneingabetoggle" class="toggle-checkbox absolute my-1 block w-6 h-6 rounded-full bg-sky-100 border-1 appearance-none cursor-pointer"/>
                        <label for="toggle" class="toggle-label pl-8 block overflow-hidden h-8 rounded-full cursor-pointer">
                            <span class="text-md font-medium text-gray-900"> Kosteneigabe  </span>
                        </label>
                    </div>
                </div>

                <div x-show="open">
                   <div class="mx-2">
                        <livewire:user.realestate.abrechnung.einstellungen :baseobject='$realestate' :wire:key="'modal-realestate-abrechnung-settings-'.$realestate->id"/>
                   </div>
                </div>
            </div>

        </div>
        <!-- Kostenliste -->
        <div x-data="{ active: 1 }" class="space-y-4 mt-4">
            <!-- liste der Kostearten -->
            @forelse ($filtered as $cost)
                <div x-data="{
                    id: {{ $cost->CostTypeSort }} ,
                    get expanded() {
                        return this.active === this.id
                    },
                    set expanded(value) {
                        this.active = value ? this.id : null
                    }, }"
                    role="region" class="border border-black rounded-md shadow">
                	<!-- liste der Kostearten. Eingabeüberschriften -->
                    <h2>
                        <button
                            x-on:click="expanded = !expanded"
                            :aria-expanded="expanded"
                            class="flex items-end justify-items-end w-full font-bold text-2xl px-3 py-1"
                        >
                        <span x-show="!expanded" aria-hidden="true" class="mr-2 mb-1 text-xl"><i class="fa-solid fa-caret-right"></i></span>
                        <span x-show="expanded" aria-hidden="true" class="mr-2 mb-1 text-xl"><i class="fa-solid fa-caret-down"></i></span>
                        <div class="flex items-end content-end">
                            <div class="text-xl mb-1 pr-1">{{ $cost->costType. '  ' }}</div>
                            <div x-show="!expanded"  class ="flex-1 mb-1-2 text-gray-500 text-left text-sm line-clamp-1 italic font-extralight" >{{ '     ...  '. $this->getCostByType($cost->costType_id)->pluck('nazwa')->implode(', ') }} </div>
                        </div>

                    </button>
                    <div x-show="expanded" class="mx-2 flex flex-row items-center justify-start font-normal m-2 text-lg ">
                        @if ($showEditFields)
                            <div class="text-xs align-text-bottom bottom border-b border-gray-400 basis-1/3 ">
                                        Kostenposition
                            </div>
                            <div class="basis-2/3 ">
                                <div class="flex px-4 flex-row items-center justify-around gap-6">
                                    <div class="basis-1/5">
                                        <div class="text-xs {{ $this->hasConsumptionByType($cost->costType_id) ? 'block' : 'hidden' }} align-text-bottom border-b border-gray-400 text-center">Verbrauch in kWh.</div>
                                    </div>
                                    @if (!($cost->costType_id == 'BRK'))
                                    <div class="basis-1/5">
                                        <div class="text-xs {{ $this->hasHaushaltsnahByType($cost->costType_id) ? 'block' : 'hidden' }} align-text-bottom border-b border-gray-400 basis-1/5 text-center">Haushaltsnah</div>
                                    </div>
                                    @endif
                                    @if (($cost->costType_id == 'BRK'))
                                    <div class="basis-1/5">
                                        <div class="text-xs align-text-bottom border-b border-gray-400 basis-1/5 text-center">CO2-Abgabe</div>
                                    </div>
                                    @endif
                                    <div class="basis-1/5">
                                        <div class="{{ $dateInputMode ? 'block' : 'hidden' }} text-xs align-text-bottom border-b border-gray-400 basis-1/5 text-center">Datum</div>
                                    </div>
                                    <div class="basis-1/5">
                                        <div class="text-xs align-text-bottom border-b border-gray-400 basis-1/5 text-center">Betrag</div>
                                    </div>
                                    <div class="basis-1/5">
                                        <div class="text-xs align-text-bottom  basis-1/5 text-center"></div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    </h2>

                    <div x-show="expanded" >
                        <!-- Kostenart -->
                        @forelse ($this->getCostByType($cost->costType_id) as $singleCost)
                            <!-- Kosten-Eingabe Bereich -->
                            <div class="flex flex-row {{ $singleCost->costAmounts->count() > 0 && $showEditFields ? 'border-b-2' : 'border-b-0' }} items-center justify-start font-normal m-2 text-lg ">
                                <div class="basis-1/3 py-1 ">
                                    <button wire:click="raise_EditCostModal({{ $singleCost }})"
                                            class="flex rounded-md hover:bg-sky-300 hover:px-2 items-center justify-start ">
                                        <div class="text-lg">
                                            {{ $singleCost->nazwa }}
                                        </div>
                                    </button>
                                </div>
                                @if ($showEditFields)
                                    <div class="basis-2/3 py-1 bg-orange-800">
                                        <livewire:user.costamount.detail-input :cost='$singleCost' :netto='$nettoInputMode' :inputWithDatum='$dateInputMode' :wire:key="'list-cost-costamountinput-'.$singleCost->id"/>
                                    </div>
                                @else
                                    <div class="basis-1/3 text-right text-lg py-1 px-6">
                                        @if ($singleCost->consumption)
                                            {{ $singleCost->Consumptionsum. ' '. $singleCost->fuelTypeUnitName }}
                                        @endif
                                    </div>
                                    <div class="basis-1/3 text-right text-lg py-1 px-6 ">
                                        @if ($singleCost->nettoInputMode)
                                            {{ $singleCost->Netto }}
                                        @else
                                            {{ $singleCost->Brutto }}
                                        @endif
                                    </div>

                                @endif
                            </div>

                            @if ($showEditFields)

                                <!-- Liste der einzelBeträge -->
                                <div class=" {{ $singleCost->costAmounts->count() > 0  ? 'block bg-white' : 'invisible' }} items-center justify-start font-normal m-2 text-lg ">
                                    @foreach ($singleCost->costAmounts as $singleCostAmount)

                                        <div class="flex flex-row">
                                            <div class="basis-1/3 py-1 ">
                                                <div class="text-sm">
                                                    {{ $singleCostAmount->description }}
                                                </div>
                                            </div>
                                            <div class="basis-2/3 py-1 ">
                                                <div class="">
                                                    <div class="flex items-center px-4 py-1 justify-around gap-6 border-b-2 bg-slate-100 border-white">

                                                        <div id="user-costamount-listitem-consumption{{ $singleCostAmount->id }}"
                                                            style="-moz-appearance: textfield; margin: 0;"
                                                            class="{{ $singleCost->consumption ? 'block' : 'invisible' }} basis-1/5 md:text-md text-right "   >

                                                                <span class="text-right mr-2">{{ $singleCostAmount->consumption }}</span>
                                                        </div>
                                                        <div id="user-costamount-listitem-haushaltsnah{{ $singleCostAmount->id }}"
                                                            style="-moz-appearance: textfield; margin: 0;"
                                                            class="{{ $singleCost->haushaltsnah ? 'block' : 'invisible' }} basis-1/5 md:text-md text-right "   >

                                                                <span class="text-right mr-2">{{ $singleCostAmount->haushaltsnah }}</span>
                                                        </div>
                                                        <div id="user-costamount-listitem-datum{{ $singleCostAmount->id }}"
                                                            style="-moz-appearance: textfield; margin: 0;"
                                                            class="basis-1/5 md:text-md text-right {{ $dateInputMode ? 'invisible' : '' }} "   >
                                                                <span class="text-right mr-2">{{ $singleCostAmount->datum }}</span>
                                                        </div>
                                                        <div id="user-costamount-listitem-betrag{{ $singleCostAmount->id }}"
                                                            style="-moz-appearance: textfield; margin: 0;"
                                                            class="basis-1/5 md:text-md text-right "
                                                            >
                                                            @if($nettoInputMode)
                                                                <span class="text-right mr-2">{{ $singleCostAmount->netto }}</span>
                                                            @else
                                                            <span class="text-right mr-2">{{ $singleCostAmount->brutto }}</span>
                                                            @endif
                                                        </div>

                                                        <div
                                                            class="basis-1/5 "
                                                        >
                                                            <div
                                                                class="flex">
                                                                <div
                                                                    x-data = "
                                                                    {
                                                                        focusAndSelectNekoElementById(id)
                                                                        {
                                                                            document.getElementById(id).focus();
                                                                            document.getElementById(id).select();
                                                                        }
                                                                    }
                                                                    "
                                                                    x-on:click="
                                                                       setTimeout(() => focusAndSelectNekoElementById('costamount-detailmodal-datum'), 1000)
                                                                    "
                                                                    wire:click="editCostAmountModal({{ $singleCostAmount }})"
                                                                    class="border text-center bg-sky-300 md:text-md hover:bg-sky-500 focus:bg-sky-500 focus:ring-indigo-500 py-1 mr-2 m-0 focus:border-indigo-500 w-full sm:text-sm border-sky-600 rounded-md ">
                                                                    <x-icon.fonts.pencil class="text-xs ">
                                                                    </x-icon.fonts.pencil>
                                                                </div>
                                                                <div
                                                                    wire:click="questionDeleteCostAmount({{ $singleCostAmount }})"
                                                                    class="border text-center bg-red-300 md:text-md hover:bg-red-500 focus:bg-sky-500 focus:ring-indigo-500 py-1 ml-2 m-0 focus:border-indigo-500 w-full sm:text-sm border-red-600 rounded-md ">
                                                                    <x-icon.fonts.trash class="text-blue-800 "></x-icon.fonts.trash>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Summenfeld -->
                                <div class="  {{ $singleCost->costAmounts->count() > 0 && $showEditFields ? 'border-y-2 block bg-slate-200' : 'border-y-0 hidden' }}  border-gray-300  items-center justify-start font-normal m-2 text-lg">
                                    <div class="{{ $singleCost->costType_id == 'BRK' || $singleCost->costAmounts->count() > 1 ? 'flex flex-row' : 'hidden' }}">
                                        <div class="basis-1/3 py-1 ">
                                        </div>
                                        <div class="basis-2/3 ">
                                            <div class="flex items-center px-4 justify-around gap-6">

                                                <div
                                                    style="-moz-appearance: textfield; margin: 0;"
                                                    class="{{ $singleCost->consumption ? 'block' : 'invisible' }} basis-1/5 md:text-md text-right "   >

                                                        <span class="text-right font-bold py-1 mr-3">{{ $singleCost->consumptionsum. ' '. $singleCost->fuelTypeUnitName  }}</span>
                                                </div>


                                                <div
                                                    style="-moz-appearance: textfield; margin: 0;"
                                                    class="basis-3/5 md:text-md text-right "
                                                    >
                                                    @if($nettoInputMode)
                                                        <span class="text-right font-bold">{{ 'Gesamt: '. $singleCost->netto. ' €' }}</span>
                                                    @else
                                                    <span class="text-right font-bold">{{ 'Gesamt: '. $singleCost->brutto. ' €' }}</span>
                                                    @endif
                                                </div>

                                                <div
                                                    class="basis-1/5 invisible "
                                                >
                                                    {{-- <div class="flex">
                                                        <div class="border text-center bg-sky-300 md:text-md hover:bg-sky-500 focus:bg-sky-500 focus:ring-indigo-500 py-1 mr-2 m-0 focus:border-indigo-500 w-full sm:text-sm border-sky-600 rounded-md ">
                                                            <x-icon.fonts.pencil class="text-xs ">
                                                            </x-icon.fonts.pencil>
                                                        </div>
                                                        <div class="border text-center bg-red-300 md:text-md hover:bg-red-500 focus:bg-sky-500 focus:ring-indigo-500 py-1 ml-2 m-0 focus:border-indigo-500 w-full sm:text-sm border-red-600 rounded-md ">
                                                            <i class="text-red-800 fa-solid fa-trash-can"></i>
                                                        </div>
                                                    </div> --}}

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endif
                            @empty
                            <div class="flex justify-center items-center space-x-2 bg-sky-100">
                                <span class="font-medium py-8 text-cool-gray-400 text-xl">nichts gefunden...</span>
                            </div>
                        @endforelse
                    </div>
                </div>
            @empty
                <div class="flex justify-center items-center space-x-2 bg-sky-100">
                    <span class="font-medium py-8 text-cool-gray-400 text-xl">nichts gefunden...</span>
                </div>
            @endforelse

        </div>
    </div>
    <div class="xs:max-w-xs xs:w-xs">
        <!-- Save Cost Modal -->
        <div>
            <livewire:user.cost.detail :wire:key="'modal-realestate-cost-detail'"/>
        </div>
        <div>
            <livewire:user.costamount.detail :wire:key="'modal-realestate-costamount-detail'"/>
        </div>
        <!-- Delete CostAmount Modal -->
        <div class="{{ $showDeleteCostAmountModal ? 'visible' : 'invisible' }}">
            <form wire:submit.prevent="deleteCostAmountModal({{ $current }})">
                <x-modal.dialog class="bg-sky-50" minWidth="640px" maxWidth="800px" wire:model.defer="showDeleteCostAmountModal">
                    <!-- Dialog Title -->
                    <x-slot name="title">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                            <i class="text-red-800 fa-solid fa-trash-can"></i>
                        </div>
                    </x-slot>
                    <!-- Dialog Content -->
                    <x-slot name="content">
                        <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Eintrag wirklich löschen</h3>
                        </div>
                    </x-slot>
                    <x-slot name="footer">
                        <x-button.secondary wire:click="$set('showDeleteCostAmountModal', false)">Abbrechen</x-button.secondary>
                        <x-button.delete type="submit">Löschen</x-button.delete>
                    </x-slot>
                </x-modal.dialog>
            </form>
        </div>
    </div>
</div>



