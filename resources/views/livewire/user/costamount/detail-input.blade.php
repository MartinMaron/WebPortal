<div x-data = "
                {
                    focusAndSelectNekoElementById(id) 
                    { 
                        document.getElementById(id).focus()
                        document.getElementById(id).select()
                    }
                }
            "
     class="flex items-center px-4 justify-around gap-6">
    <!-- Verbrauch -->        
    <div class="basis-1/5" >
        <input type="text"  
            id="user-costamount-detailinput-consumption{{ $cost->id }}"
            inputmode="numeric"  
            wire:model.lazy="current.consumption_editing"
            style="-moz-appearance: textfield; margin: 0;"
            class="border {{ $cost->consumption ? 'block' : 'hidden' }} text-right {{ $errors->first('current.consumption') ? 'bg-red-50 focus:border-red-900 border-red-900' : 'focus:border-indigo-500 border-gray-300' }} md:text-md focus:ring-black p-1 px-2 m-0  w-full sm:text-sm  rounded-md"   
        >
        @if ($errors->first('current.consumption'))
            <div class="mt-1 text-red-500 text-sm">Verbrauch muss angegeben werden</div>
        @endif
    </div>
    <!-- haushaltsnah -->      
    @if (!($cost->costType_id == 'BRK'))
        <div class="basis-1/5" >
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
    @endif
    <!-- CO2-Abgabe -->            
    @if (($cost->costType_id == 'BRK'))
    <div class="basis-1/5" >   
        <input
            wire:model.lazy="current.co2TaxValue"
            id="user-costamount-detailinput-co2TaxValue{{ $cost->id }}"
            @keyup.down="focusAndSelectNekoElementById('{{ 'user-costamount-detailinput-co2TaxValue'. $cost->id + 1 }}')"
            @keyup.up="focusAndSelectNekoElementById('{{ 'user-costamount-detailinput-co2TaxValue'. $cost->id -1 }}')"
            type="text"
            inputmode="numeric" 
            style="-moz-appearance: textfield; margin: 0;"
            :error="$errors->first('current.co2TaxValue')"
            class="{{ $inputWithDate ? 'block' : 'hidden' }} bg-white border text-right md:text-md focus:ring-black p-1 px-2 m-0 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"   
            >
    </div>
    @endif
    <!-- Datum -->            
    <div class="basis-1/5" >   
        <x-input.date
            wire:model.lazy="current.datum"
            id="user-costamount-detailinput-datum{{ $cost->id }}"
            @keyup.down="focusAndSelectNekoElementById('{{ 'user-costamount-detailinput-datum'. $cost->id + 1 }}')"
            @keyup.up="focusAndSelectNekoElementById('{{ 'user-costamount-detailinput-datum'. $cost->id -1 }}')"
            type="text"
            :error="$errors->first('current.dateCostAmount')"
            class="{{ $inputWithDate ? 'block' : 'hidden' }} bg-white border text-right md:text-md focus:ring-black p-1 px-2 m-0 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"   
            >
        </x-input.date>
    </div>
    <!-- Betrag -->        
    <div class="basis-1/5" >
        <input type="text"    
            id="user-costamount-detailinput-betrag{{ $cost->id }}"
            @keyup.down="focusAndSelectNekoElementById('{{ 'user-costamount-detailinput-betrag'. $cost->id + 1 }}')"
            @keyup.up="focusAndSelectNekoElementById('{{ 'user-costamount-detailinput-betrag'. $cost->id -1 }}')"
            inputmode="numeric"  
            wire:model.lazy= {{ $netto ? 'current.netto' : 'current.brutto' }}
            style="-moz-appearance: textfield; margin: 0;"
            class="border text-right md:text-md focus:ring-black p-1 px-2 m-0 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"   
        >
    </div>
    <button 
        wire:click="save()"                                          
        x-on:click="focusAndSelectNekoElementById('{{ 'user-costamount-detailinput-'. $inputStartField. $cost->id }}')"
        class="basis-1/5 border text-justify bg-sky-300 md:text-md hover:bg-sky-500 focus:bg-sky-500 focus:ring-indigo-500 p-1 px-2 m-0 focus:border-indigo-500 block w-full sm:text-sm border-gray-900 rounded-md"   
    >
        <span class="md:text-md "><i class="text-left pr-1 fa-solid fa-layer-plus"></i></i></span>
        <span class="md:text-md text-right">hinzufügen</span>
    </button>
  </div>
