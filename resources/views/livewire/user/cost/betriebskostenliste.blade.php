<div>
    <!-- Main -->
    <div class="max-w-7xl w-full mx-auto sm:px-1 lg:px-1">
        <div class="flex justify-end">
            <div wire:click="togleShowEditFields"
                class="w-45 relative mt-1 mr-3 pt-1 pb-2 align-middle select-none transition duration-200 ease-in">
                <input wire:model="showEditFields" type="checkbox" name="user-cost-lista-kosteneingabetoggle" id="user-cost-lista-kosteneingabetoggle" class="toggle-checkbox absolute my-1 block w-6 h-6 rounded-full bg-sky-100 border-1 appearance-none cursor-pointer"/>
                <label for="toggle" class="toggle-label pl-2 pr-8 block overflow-hidden h-8 rounded-full cursor-pointer">
                    <span class="text-md text-center pl-8 font-medium text-gray-900"> Kosteneigabe  </span>
                </label>
            </div>
        </div>
        <!-- Kostenliste -->
        <div class="flex flex-row items-center justify-start border-b-2 border-gray-800 font-normal text-lg ">
            <div class="basis-1/5 py-1">
                <div class="">
                    <div class="text-lg text-left px-2">
                        <span class="">Kostenposition</span>
                    </div>
                </div>
            </div>
            <div class="basis-4/5">
                <div class="flex bg-sky-100 justify-around gap-1 items-center text-lg text-center">
                    <div class="bg-red-300 basis-4/12">
                        <span class="">Hinweis</span>
                    </div>
                    <div class="{{ $showEditFields ? 'hidden' : 'block'}} basis-3/12">
                        <span class="">letzte Abrechnung</span>
                    </div>
                    <div class="flex {{ $showEditFields ? 'basis-4/12' : 'basis-3/12'}} gap-1 ">
                        <div class="basis-1/2">
                            @if ($this->hasHaushaltsnahByType('BEK'))
                             <div class="">
                                <span class="">Verbrauch</span>
                             </div>    
                             @endif
                         </div>
                         <div class="basis-1/2">
                            @if ($this->hasHaushaltsnahByType('BEK'))
                             <div class="">
                                <span class="">§ 35c EStG</span>
                             </div>
                             @endif
                         </div>
                     </div>
                    
                    <div class=" {{ $showEditFields ? 'block' : 'hidden'}} basis-2/12">
                            <span class="">Betrag</span>
                    </div>
                    <div class="basis-2/12 px-2 ">
                        <div class="{{ $showEditFields ? 'hidden' : 'block'}} ">
                            <span class="">Betrag</span>
                        </div>
                        <div class="{{ $showEditFields ? 'block' : 'hidden'}}">
                            <button wire:click="raise_AddCostModal()">
                                <i class="fa-regular fa-circle-plus text-2xl text-sky-600" ></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- liste der Kostearten -->
        @forelse ($filtered as $cost)
            <div class="flex flex-row items-center justify-start border-b border-gray-400 font-normal text-lg ">
                <div class="basis-1/5 py-1">
                    <div class="">
                        <button 
                            wire:click="raise_EditCostModal({{ $cost }})"
                            class="text-lg text-left px-2 flex rounded-md hover:bg-sky-300 ">
                            <span class="py-1 line-clamp-1">{{ $cost->caption }}</span>
                        </button>
                    </div>
                </div>
                @if ($showEditFields)   
                    <div class="basis-4/5 py-1">
                        <div class="">
                            <livewire:user.costamount.detail-input :cost='$cost' :netto='false' :inputWithDatum='false' :wire:key="'list-cost-costamountinput-'.$singleCost->id" key="{{ now() }}"/>
                        </div>
                    </div>
                @else 
                <div class="basis-4/5">
                    <div class="flex px-2 justify-around gap-1 items-center text-sm text-center">
                        <div class="bg-sky-100 rounded-md basis-4/12">
                            <span class="">{{$cost->noticeForUser }}</span>
                        </div>
                        <div class="px-4 bg-sky-100 rounded-md basis-3/12 flex justify-evenly gap-3">
                            <span class="text-right px-2 basis-1/2">{{ $cost->prevyear_amountgros_view. ' €'}}</span>
                            <span class="text-right px-2 basis-1/2">{{ $cost->prevyear_quantity_view. ' '. $cost->allocation_key->einheit->shortname   }}</span>
                            {{-- ['. $singleCost->fuelType->einheit->shortname.']' --}}
                        </div>
                        <div class="flex basis-3/12">
                        <div class="basis-1/2">
                                @if ($cost->consumption)
                                <div class="bg-sky-100 rounded-md">
                                    <span class="">{{ $cost->consumptionsum.  ' '. $cost->allocation_key->einheit->shortname }}</span>
                                </div>    
                                @endif
                            </div>
                            <div class="basis-1/2">
                                @if ($cost->haushaltsnah)
                                <div class="bg-sky-100 rounded-md">
                                    <span class="bg-sky-100 rounded-md">{{ $cost->haushaltsnah_sum }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="{{ $showEditFields ? 'block' : 'hidden'}} basis-2/12">
                            <span class="text-lg">{{ $cost->brutto }}</span>
                        </div>
                        <div class="basis-2/12 px-2 ">
                            <div class="{{ $showEditFields ? 'hidden' : 'block'}} ">
                                <span class="text-lg">{{ $cost->brutto }}</span>
                            </div>
                            <div class="{{ $showEditFields ? 'block' : 'hidden'}}">
                                <button wire:click="raise_AddCostModal()">
                                    <i class="fa-regular fa-circle-plus text-2xl text-sky-600" ></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @if ($showEditFields)
            <!-- Liste der einzelBeträge -->
            <div class=" {{ $cost->costAmounts->count() > 0  ? 'block bg-white' : 'invisible' }} items-center justify-start font-normal m-2 text-lg ">
                @foreach ($cost->costAmounts as $singleCostAmount)
                    <div class="flex flex-row">
                        <div class="basis-1/5 py-1 ">
                            
                        </div>
                        <div class="basis-4/5">
                            <div class="flex px-2 justify-around gap-1 items-center text-sm text-center">
                                <div class="basis-4/12">
                                    @if ($singleCostAmount->nekoId == 0)
                                    <div class="bg-sky-100 rounded-md ">
                                        {{ 'Eingabe am: '.  $singleCostAmount->created_at   }}
                                    </div> 
                                    @else
                                    <div class="text-left line-clamp-1">
                                        {{  $singleCostAmount->description   }}
                                    </div> 
                                    @endif
                                </div>
                                <div class="px-4 bg-sky-100 rounded-md basis-2/12 flex justify-evenly gap-3">
                                    @if ($cost->consumption)
                                    <div class="bg-sky-100 rounded-md">
                                        <span class="">{{ $singleCostAmount->consumption.  ' '. $cost->allocation_key->einheit->shortname }}</span>
                                    </div>    
                                    @endif
                                </div>
                                <div class="basis-2/12">
                                    @if ($cost->haushaltsnah)
                                    <div class="rounded-md">
                                        <span class="rounded-md">{{ $singleCostAmount->haushaltsnah }}</span>
                                    </div>
                                    @endif
                                </div>
                                <div class="{{ $showEditFields ? 'block' : 'hidden'}} basis-2/12">
                                    <span class="text-sm">{{ $singleCostAmount->brutto }}</span>
                                </div>
                                <div class="basis-2/12 px-2 ">
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Summenfeld -->
            <div class="  {{ $cost->costAmounts->count() > 0 && $showEditFields ? 'border-y-2 block bg-slate-200' : 'border-y-0 hidden' }}  border-gray-300  items-center justify-start font-normal md:text-lg mx-2">
                <div class="{{ $cost->costType_id == 'BRK' || $cost->costAmounts->count() > 1 ? 'flex flex-row' : 'hidden' }}">
                    <div class="basis-1/5 text-left font-bold">
                        <div class="ml-2">
                            
                        </div>    
                    </div>
                    <div class="basis-4/5 text-center">
                        <div class="flex justify-around gap-2">
                            <div class="text-left basis-4/12">
                                {{ 'Summe '. $cost->caption }}
                            </div>
                            <div class="basis-2/12">
                                @if ($cost->consumption)
                                    <div class="rounded-md">
                                        <span class="">{{ $cost->consumptionsum.  ' '. $cost->allocation_key->einheit->shortname }}</span>
                                    </div>    
                                @endif
                            </div>
                            <div class="basis-2/12">
                                @if ($cost->haushaltsnah)
                                <div class="rounded-md">
                                    <span class="">{{$cost->haushaltsnah_sum }}</span>
                                </div>
                                @endif
                            </div>
                            <div class="basis-2/12">
                                <span class="">{{$cost->brutto }}</span>
                            </div>
                            <div class="basis-2/12"></div>
                            
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
    <div class="xs:max-w-xs xs:w-xs">
        <!-- Save Cost Modal -->
        <div>
            <livewire:user.cost.detail :cost='$current' :netAmountInput='$nettoInputMode' :costInvoicingType="'HZ'" :wire:key="'modal-realestate-cost-detail'"/>
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




