<div class="">
    @if ($errors->isNotEmpty())
        <div class="block text-sm bg-red-100 border border-red-400 text-red-700 px-1 py-1 rounded relative mb-2" role="alert">
            <span class="block sm:block"><strong class="font-bold">Uups! Einige Informationen fehlen oder sind nicht korrekt. </strong>
                @foreach ($errors->all() as $error)
                        <span class="block sm:block">- {{ $error  }}</span>
                @endforeach
            </span>
        </div>
    @endif
 
    <div class="{{ $cost->costtype->costinvoicingtype->id == 'HZ' ? 'block' : 'hidden' }}">
        <div x-data = " {
                            
                            focusAndSelectNekoElementById(id) 
                            { 
                                document.getElementById(id).focus()
                                document.getElementById(id).select()
                                
                            },
                            editedindex: $wire.entangle('editedindex')
                        }
                    "
            class="flex items-center px-2 ustify-around gap-2 bg-sky-200 bg-opacity-50 p-1 rounded-lg">
            
            <div class="">
            </div>
            <!-- Datum -->            
            <div class="basis-1/6" >   
                <x-input.date
                    wire:model.lazy="current.datum"
                    id="user-costamount-detailinput-datum{{ $cost->id }}"
                    @keyup.down="focusAndSelectNekoElementById('{{ 'user-costamount-detailinput-datum'. $cost->id + 1 }}')"
                    @keyup.up="focusAndSelectNekoElementById('{{ 'user-costamount-detailinput-datum'. $cost->id -1 }}')"
                    type="text"
                    :error="$errors->first('current.datum')"
                    class="{{ $inputWithDate || ($cost->fueltype_id !=null && $cost->fueltype->hasTank) ? 'block' : 'hidden' }} 
                                bg-white text-center md:text-lg border 
                                {{ $errors->first('current.datum') ? 'bg-red-50 focus:border-red-900 border-red-900' : 'focus:border-indigo-500 border-gray-300' }}"
                    >
                </x-input.date>
            </div>
            <!-- Verbrauch -->        
            <div class="basis-1/6" >
                <input type="text"  
                    id="user-costamount-detailinput-consumption{{ $cost->id }}"
                    inputmode="numeric"  
                    placeholder="0"
                    wire:model.lazy="current.consumption_editing"
                    style="-moz-appearance: textfield; margin: 0;"
                    class="border {{ $cost->consumption ? 'block' : 'hidden' }} text-center {{ $errors->first('current.consumption') ? 'bg-red-50 focus:border-red-900 border-red-900' : 'focus:border-indigo-500 border-gray-300' }} md:text-md focus:ring-black p-1 px-2 m-0  w-full sm:text-sm  rounded-md"   
                >
            </div>
            <!-- haushaltsnah -->      
            @if (!($cost->costtype_id == 'BRK'))
                <div class="basis-1/6">
                </div> 
                <div class="basis-1/6" >
                    <input type="text"  
                        id="user-costamount-detailinput-haushaltsnah{{ $cost->id }}"
                        inputmode="numeric"  
                        placeholder="1"
                        wire:model.lazy="current.haushaltsnah"
                        style="-moz-appearance: textfield; margin: 0;"
                        class="{{ $cost->haushaltsnah ? 'block' : 'hidden' }} border text-right md:text-md focus:ring-black p-1 px-2 m-0 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"   
                    > 
                    @if ($errors->first('current.haushaltsnah'))
                        <div class="mt-1 text-red-500 text-sm">{{ $errors->first('current.haushaltsnah') }}</div>
                    @endif
                </div> 
            @else          
            <!-- CO2-Abgabe -->            
            <div class="basis-1/6" >   
                <input
                    wire:model.lazy="current.coconsupmtion"
                    id="user-costamount-detailinput-coconsupmtion{{ $cost->id }}"
                    @keyup.down="focusAndSelectNekoElementById('{{ 'user-costamount-detailinput-coconsupmtion'. $cost->id + 1 }}')"
                    @keyup.up="focusAndSelectNekoElementById('{{ 'user-costamount-detailinput-coconsupmtion'. $cost->id -1 }}')"
                    type="text"
                    inputmode="numeric" 
                    style="-moz-appearance: textfield; margin: 0;"
                    class="{{ $cost->co2Tax ? 'block' : 'hidden' }} bg-white border text-center md:text-md focus:ring-black p-1 px-2 m-0 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"   
                    >
                    @if ($errors->first('current.coconsupmtion'))
                        <div class="mt-1 text-red-500 text-sm">{{ $errors->first('current.haushaltsnah') }}</div>
                    @endif
            </div>
            <!-- CO2 Betrag -->        
            <div class="basis-1/6" >
                <input type="text"    
                    id="user-costamount-detailinput-co2betrag{{ $cost->id }}"
                    @keyup.down="focusAndSelectNekoElementById('{{ 'user-costamount-detailinput-co2betrag'. $cost->id + 1 }}')"
                    @keyup.up="focusAndSelectNekoElementById('{{ 'user-costamount-detailinput-co2betrag'. $cost->id -1 }}')"
                    @keyup.enter="focusAndSelectNekoElementById('{{ 'user-costamount-detailinput-co2betrag'. $cost->id}}')"
                    wire:keyup.enter="save"
                    inputmode="numeric"  
                    wire:model.lazy= {{ $netto ? 'current.conetto' : 'current.cobrutto' }}
                    style="-moz-appearance: textfield; margin: 0;"
                    class="{{ $cost->co2Tax ? 'block' : 'hidden' }} border text-center md:text-md focus:ring-black p-1 px-2 m-0 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"   
                >
            </div>
            @endif
            <!-- Betrag -->        
            <div class="basis-1/6" >
                <input type="text"    
                    id="user-costamount-detailinput-betrag-{{ $index }}"
                    @keyup.down="focusAndSelectNekoElementById('{{ 'user-costamount-detailinput-betrag-'. $index + 1 }}')"
                    @keyup.up="focusAndSelectNekoElementById('{{ 'user-costamount-detailinput-betrag-'. $index -1 }}')"
                    @keyup.enter="focusAndSelectNekoElementById('{{ 'user-costamount-detailinput-betrag-'. $index }}')"
                    wire:keyup.enter="save({{ $index }})"
                    inputmode="numeric"  
                    x-ref="inputbetrag-". {{ $index }}
                    wire:model.lazy= {{ $netto ? 'current.netto' : 'current.brutto' }}
                    style="-moz-appearance: textfield; margin: 0;"
                    class="border text-center md:text-md focus:ring-black p-1 px-2 m-0 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"   
                >
            </div>
            <button 
                wire:click="save({{ $index }})"   
                x-on:click="focusAndSelectNekoElementById('{{ 'user-costamount-detailinput-betrag-'. $index }}')"
                class="basis-1/6 border text-justify bg-sky-300 md:text-md hover:bg-sky-500 focus:bg-sky-500 focus:ring-indigo-500 p-1 px-2 m-0 focus:border-indigo-500 block sm:text-sm border-gray-900 rounded-md"   
                >
                <span class="md:text-md "><i class="text-left pr-1 fa-solid fa-layer-plus"></i></i></span>
                <span class="md:text-md text-right">Einfg</span>
            </button>
        </div>
    </div>
</div>