<div>
    <!-- Main -->
    <div class="max-w-7xl w-full mx-auto sm:px-6 lg:px-8">
        <div class="text-3xl pt-3 font-bold text-sky-800 text-center w-full">
            KOSTENLISTE - HEIZKOSTEN 
        </div>
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
                        <div class="flex">

                            <button
                                x-on:click="expanded = !expanded"
                                :aria-expanded="expanded"
                                class="flex items-end justify-items-end w-full font-bold text-2xl px-3 py-1"
                            >
                            <span x-show="!expanded" aria-hidden="true" class="mr-2 mb-1 text-xl"><i class="fa-solid fa-caret-right"></i></span>
                            <span x-show="expanded" aria-hidden="true" class="mr-2 mb-1 text-xl"><i class="fa-solid fa-caret-down"></i></span>
                            <div class="flex items-end content-end">
                                <div class="text-xl mb-1 pr-1">{{ $cost->costtype->caption . '  ('. number_format($this->getCostByType($cost->costtype_id)->pluck('gros')->sum(), 2, ',', '.') . ' €)' }}</div>
                                <div x-show="!expanded"  class ="flex-1 mb-1-2 text-gray-500 text-left text-sm line-clamp-1 italic font-extralight" >{{ '     ...  '. $this->getCostByType($cost->costtype_id)->pluck('caption')->implode(', ') }} </div>
                            </div>
                            </button>
                            <button wire:click="raise_AddCostModal({{ $cost }})">
                                <i class="fa-regular fa-circle-plus text-3xl m-3 text-sky-600" ></i>
                            </button>
                        </div>
                        
                        <!-- liste der Kostearten. Columnheader -->
                        <div x-show="expanded" class="">
                            @if ($showEditFields || $cost->costtype_id =='BRK')
                                <div class="h-10 flex flex-row items-center justify-start font-normal m-1 text-lg ">
                                <div class="basis-1/3 py-1">
                                    <div class="flex justify-start px-2 relative items-center border-b border-gray-400 ">
                                        <div class="text-sm absolute bottom-0 text-center">
                                            <span class="">Kostenposition</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="basis-2/3 py-1 ">
                                    <div class="flex px-2 justify-around gap-2 border-b border-gray-400 ">
                                        <div class="flex justify-around basis-1/6 px-2 relative items-center ">
                                            <div class="{{ $dateInputMode ? 'block' : 'hidden' }} text-sm absolute bottom-0 text-center ">
                                                <span class="">Datum</span>
                                            </div>
                                        </div>
                                        <div class="flex justify-around basis-1/6 px-2 relative items-center">
                                            <div class="{{ $this->hasConsumptionByType($cost->costtype_id) ? 'block' : 'hidden' }} text-sm absolute bottom-0 text-center">
                                                Verbrauch 
                                            </div>
                                        </div>
                                        @if ($cost->co2Tax)
                                            <div class="flex justify-around basis-1/6 px-2 relative items-center">
                                                <div class="text-sm absolute bottom-0 text-center">CO2-Abgabe [kg]</div>
                                            </div>
                                            <div class="flex justify-around basis-1/6 px-2 relative items-center">
                                                <div class="text-sm absolute bottom-0 text-center">CO2-Kosten</div>
                                            </div>
                                        @else
                                            <div class="flex justify-around basis-1/6 px-2 relative items-center">
                                            </div>
                                            <div class="flex justify-around basis-1/6 px-2 relative items-center">
                                                @if ($this->hasHaushaltsnahByType($cost->costtype_id))
                                                    <div class="text-sm absolute bottom-0 text-center">Haushaltnah</div>
                                                @endif
                                            </div>
                                        @endif
                                        <div class="flex {{ $showEditFields ? 'block' : 'hidden'}} justify-around basis-1/6 px-2 relative items-center">
                                            <div class="{{ $showEditFields ? 'block' : 'hidden'}} text-sm absolute bottom-0 text-center">Betrag</div>
                                        </div>
                                        <div class="flex justify-around basis-1/6 px-2 relative items-center">
                                            <div class="{{ $showEditFields ? 'hidden' : 'block'}} text-sm absolute bottom-0 text-center">Betrag</div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            @endif
                        </div>
                    </h2>

                    <div x-show="expanded"  >
                         
                        <!-- Kostenart -->
                        @forelse ($this->getCostByType($cost->costtype_id) as $singleCost)
                            <!-- Kosten-Eingabe Bereich -->
                            <div class="{{ $this->hasManyBrennstoffkosten && $singleCost->costtype_id=='BRK' ? 'border-2 border-sky-700 rounded-md m-2': ''}}">
                            <!-- Anfangsbestand -->
                            @if ($singleCost->fueltype_id !=null && $singleCost->fueltype->hasTank)
                                <div class="m-2 flex flex-row items-center justify-start font-normal text-lg h-10 border-b border-gray-400 ">
                                    <div class="basis-1/3 py-1">
                                        <div class="flex justify-start px-2 items-center ">
                                            <div class="text-lg text-center">
                                                <span class="">{{ 'Anfangsbestand '. $singleCost->caption. ' ['. $singleCost->fueltype->einheit->shortname.']'  }}</span>
                                             
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="basis-2/3 py-1 ">
                                        <div class="flex px-2 justify-around gap-2 ">
                                            <div class="flex justify-around basis-1/6 px-2 items-center ">
                                                <div class="{{ $dateInputMode ? 'block' : 'hidden' }} text-lg text-center ">
                                                    <span class=""></span>
                                                </div>
                                            </div>
                                            <div class="flex justify-around basis-1/6 px-2 items-center">
                                                <div class="{{ $this->hasConsumptionByType($cost->costtype_id) ? 'block' : 'hidden' }} text-center">
                                                    {{ $singleCost->startValueEditing }}
                                                </div>
                                            </div>
                                            
                                            {{--  @if ($cost->co2Tax)--}}
                                                <div class="flex justify-around basis-1/6 px-2 ">
                                                    <div class=""></div>
                                                </div>
                                                <div class="flex justify-around basis-1/6 px-2 ">
                                                    <div class=""></div>
                                                </div>
                                            {{-- @endif --}}
                                            <div class="flex {{ $showEditFields ? 'block' : 'hidden' }} justify-around basis-1/6 px-2 "> 
                                                <div class="">
                                                    {{$nettoInputMode ? $singleCost->start_value_amount_net_editing : $singleCost->start_value_amount_gros_editing }}
                                                </div>
                                            </div>
                                            <div class="flex justify-around basis-1/6 px-2 ">
                                                <div class="{{ $showEditFields ? 'hidden' : 'block' }}">
                                                    {{$nettoInputMode ? $singleCost->start_value_amount_net_editing : $singleCost->start_value_amount_gros_editing }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Kosten-Eingabe -->
                            <div class="flex flex-row {{ $singleCost->costAmounts->count() > 0 && $showEditFields ? 'border-b-2' : 'border-b-0' }} items-center justify-start font-normal m-2 text-lg ">
                                <div class="basis-1/3 py-1 ">
                                    <button wire:click="raise_EditCostModal({{ $singleCost }})"
                                            class="flex rounded-md hover:bg-sky-300 px-2 items-center justify-start ">
                                        <div class="text-lg">
                                            @if ($singleCost->fueltype_id !=null && $singleCost->fueltype->hasTank && $showEditFields)
                                                {{ $singleCost->caption. ' '. 'Eingabe' }}
                                            @else
                                                {{ $singleCost->caption }}
                                            @endif
                                        </div>
                                    </button>
                                </div>
                                @if ($showEditFields)
                                    <div class="basis-2/3 py-1">
                                        <livewire:user.costamount.detail-input :cost='$singleCost' :netto='$nettoInputMode' :inputWithDatum='$dateInputMode' :wire:key="'list-cost-costamountinput-'.$singleCost->id" key="{{ now() }}"/>
                                    </div>
                                @else
                                    <!-- Kosten-Ansicht -->
                                    <div class="flex basis-2/3 text-center text-lg items-center px-2 justify-around gap-2 bg-sky-200 p-1 rounded-lg">
                                        <div class="basis-1/6">
                                        </div>    
                                        <div class="basis-1/6 text-center text-lg py-1 px-6">
                                            @if ($singleCost->consumption)
                                                {{ $singleCost->consumptionsum. ' '. $singleCost->fueltype->einheit->shortname }}
                                            @endif
                                        </div>
                                        <div class="basis-1/6 text-center text-lg py-1 px-6">
                                            @if ($singleCost->co2Tax)
                                                <div>
                                                    {{ $singleCost->coconsumptionsum }}
                                                </div>
                                            @endif
                                        </div>  
                                        <div class="basis-1/6 text-center text-lg py-1 px-6">
                                            @if ($singleCost->co2Tax)
                                                <div>
                                                    @if ($singleCost->nettoInputMode)
                                                        {{ $singleCost->conettosum }}
                                                    @else
                                                        {{ $singleCost->cobruttosum }}
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                        <div class="{{ $showEditFields ? 'block' : 'hidden' }} basis-1/6 text-right text-lg py-1 px-6 ">
                                        </div>
                                        <div class="basis-1/6 text-center text-lg py-1 px-6">
                                            @if ($singleCost->nettoInputMode)
                                            {{ $singleCost->netto }}
                                        @else
                                            {{ $singleCost->brutto }}
                                        @endif
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @if ($showEditFields)
                                <!-- Liste der einzelBeträge -->
                                <div class=" {{ $singleCost->costAmounts->count() > 0  ? 'block bg-white' : 'invisible' }} items-center justify-start font-normal m-2 text-lg ">
                                    @foreach ($singleCost->costAmounts as $singleCostAmount)
                                        <div class="flex flex-row">
                                            <div class="basis-1/3 py-1 ">
                                                <div class="text-sm m-2">
                                                    @if ($singleCost->fueltype_id !=null && $singleCost->fueltype->hasTank)
                                                        {{ 'Zugang '.$singleCostAmount->datum  }}
                                                    @else
                                                        {{ $singleCostAmount->description }}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="basis-2/3 py-1 ">
                                                <div class="">
                                                    <div class="flex items-center px-2 py-1 justify-around gap-2 border-b-2 bg-slate-100 border-white text-center md:text-lg">
                                                        <div id="user-costamount-listitem-datum{{ $singleCostAmount->id }}"
                                                            style="-moz-appearance: textfield; margin: 0;"
                                                            class="basis-1/6 {{ $dateInputMode ? 'invisible' : '' }} ">
                                                                <span class="">{{ $singleCostAmount->datum }}</span>
                                                        </div>
                                                        <div id="user-costamount-listitem-consumption{{ $singleCostAmount->id }}"
                                                            style="-moz-appearance: textfield; margin: 0;"
                                                            class="basis-1/6 {{ $singleCost->consumption ? 'block' : 'invisible' }}">
                                                                <span class="">{{ $singleCostAmount->consumption_editing }}</span>
                                                        </div>
                                                        @if ($singleCost->co2Tax)
                                                            <div id="user-costamount-listitem-co2TaxValue{{ $singleCostAmount->id }}"
                                                                style="-moz-appearance: textfield; margin: 0;"
                                                                class="basis-1/6 "   >
                                                                    <span class="">{{ $singleCostAmount->coconsupmtion }}</span>
                                                            </div>
                                                            <div id="user-costamount-listitem-haushaltsnah{{ $singleCostAmount->id }}"
                                                                style="-moz-appearance: textfield; margin: 0;"
                                                                class="basis-1/6 "   >
                                                                @if($nettoInputMode)
                                                                    <span class="">{{ $singleCostAmount->conetto }}</span>
                                                                @else
                                                                    <span class="">{{ $singleCostAmount->cobrutto }}</span>
                                                                @endif
                                                            </div>
                                                        @else
                                                            <div class="basis-1/6">
                                                            </div>
                                                            <div id="user-costamount-listitem-haushaltsnah{{ $singleCostAmount->id }}"
                                                                style="-moz-appearance: textfield; margin: 0;"
                                                                class="{{ $singleCost->haushaltsnah ? 'block' : 'invisible' }} basis-1/6 "   >
                                                                    <span class="">{{ $singleCostAmount->haushaltsnah }}</span>
                                                            </div>
                                                        @endif
                                                        <div id="user-costamount-listitem-betrag{{ $singleCostAmount->id }}"
                                                            style="-moz-appearance: textfield; margin: 0;"
                                                            class="basis-1/6"
                                                            >
                                                            @if($nettoInputMode)
                                                                <span class="">{{ $singleCostAmount->netto }}</span>
                                                            @else
                                                            <span class="">{{ $singleCostAmount->brutto }}</span>
                                                            @endif
                                                        </div>

                                                        <div
                                                            class="basis-1/6 "
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
                                <div class="  {{ $cost->costAmounts->count() > 0 && $showEditFields ? 'border-y-2 block bg-slate-200' : 'hidden' }}  items-center justify-start font-normal md:text-lg">
                                    <div class="{{ $singleCost->costtype_id == 'BRK' || $singleCost->costAmounts->count() > 1 ? 'flex flex-row h-6' : 'hidden' }}">
                                        <div class="basis-1/3 text-left font-bold">
                                            @if ($singleCost->fueltype !=null && $singleCost->fueltype->hasTank)
                                            <div class="ml-2">
                                                Zugänge Gesamt
                                            </div>    
                                            @endif
                                        </div>
                                        <div class="basis-2/3 text-center">
                                            <div class="flex justify-around gap-2">
                                                <div class="basis-1/6"></div>
                                                <div class="basis-1/6 {{ $singleCost->consumption ? 'block' : 'invisible' }} "   >

                                                    <span class="font-bold py-1">{{ $singleCost->consumptionsum. ' . $singleCost->fueltype->einheit->shortname'  }}</span>
                                                </div>
                                                <div class="basis-2/6"></div>
                                                <div
                                                    class="basis-1/6"
                                                    >
                                                    @if($nettoInputMode)
                                                        <span class="font-bold">{{ $singleCost->netto }}</span>
                                                    @else
                                                    <span class="font-bold">{{ $singleCost->brutto }}</span>
                                                    @endif
                                                </div>

                                                <div
                                                    class="basis-1/6 invisible "
                                                >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endif

                            <!-- Endstand -->
                            @if ($singleCost->fueltype_id !=null && $singleCost->fueltype->hasTank)
                            <div class="border-b border-gray-400 m-2 gap-2 flex flex-row items-center justify-start font-normal text-lg h-10 ">
                                    <div class="basis-1/3 py-1 px-2 flex justify-start items-center text-lg text-center">
                                        <span class="">{{ 'Endbestand '. $singleCost->caption. ' ['. $singleCost->fueltype->einheit->shortname.']'  }}</span>
                                    </div>
                                    <div class="basis-2/3 py-1 ">
                                        <div class="flex justify-around gap-2 text-lg">
                                            <div class="flex justify-around basis-1/6 items-center ">
                                                <div class="{{ $dateInputMode ? 'block' : 'hidden' }} text-lg text-center ">
                                                    <span class=""></span>
                                                </div>
                                            </div>

                                            <div class="flex justify-around basis-1/6 items-center">
                                                <div class="{{ $this->hasConsumptionByType($singleCost->costtype_id) ? 'block' : 'hidden' }} w-full text-center">
                                                    @if ($showEditFields)
                                                        <div 
                                                            wire:click="raise_EditCostConsumptionModal({{ $singleCost }})"                                         
                                                            class=" {{ $showEditFields ? 'block' : 'hidden' }} w-full my-1 border flex justify-around {{ $singleCost->endValue <= 0 ? 'bg-red-300 md:text-md hover:bg-red-500 focus:bg-red-500' : 'hover:bg-sky-300' }} focus:ring-indigo-500 p-1 m-0 focus:border-indigo-500 block sm:text-sm border-gray-900 rounded-md"   
                                                        >
                                                            <span class="md:text-md "><i class="text-left pr-1 fa-solid fa-pencil"></i></i></span>
                                                            @if ($singleCost->endValue <= 0)
                                                                <span class="md:text-md text-right">Eingabe</span>
                                                            @else
                                                                <span class="md:text-md text-right">{{ $singleCost->end_value_editing }}</span>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <span class="">{{ $singleCost->end_value_editing }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            @if (!$showEditFields && $singleCost->endValue <= 0)
                                                <div class="flex justify-end basis-4/6 items-end text-right text-red-800">
                                                    noch kein Endstand eingegeben
                                                </div>
                                            @else
                                                <div class="flex justify-around basis-1/6 items-center "></div>
                                                <div class="flex justify-around basis-1/6 items-center "></div>
                                                <div class="flex {{ $showEditFields ? 'block' : 'hidden' }} justify-around basis-1/6 px-2 items-center "></div>
                                                <div class="flex justify-around basis-1/6 items-center "></div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div> 
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
            <livewire:user.cost.detail :cost='$current' :netAmountInput='$nettoInputMode' :costinvoicingtype="'HZ'" :wire:key="'modal-realestate-cost-detail'"/>
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



