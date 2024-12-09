<div class="">    
    <div class="flex justify-around items-center text-lg text-center gap-1 bg-sky-50">
        <div class="basis-2/3 flex items-center">
            <button 
                class="basis-2/3 text-lg text-left px-2 flex rounded-md hover:bg-sky-300 "
                wire:click="raise_EditCostModal({{ $cost }})"
                tabindex="-1">
                <span class="py-1 line-clamp-1">{{ $cost->caption }}</span>
            </button>
            <div class="basis-1/3 text-sm rounded-md  text-center">
                <span class="line-clamp-1">{{$cost->noticeForUser }}</span>
            </div>            
        </div>
        <div class="basis-1/3 flex gap-2">
            <div class="basis-1/3">
                {{-- @if ($cost->consumption) --}}
                <input type="text"  
                    id="user-costamount-detailinput-consumption{{ $cost->id }}"
                    inputmode="numeric"  
                    placeholder="0,0"
                    wire:model.lazy="current.consumption_editing"
                    style="-moz-appearance: textfield; margin: 0;"
                    class="border {{ $cost->consumption ? 'block' : 'hidden' }} text-center {{ $errors->first('current.consumption_editing') ? 'bg-red-50 focus:border-red-900 border-red-900' : 'focus:border-indigo-500 border-gray-300' }} md:text-md focus:ring-black p-1 px-2 m-0  w-full sm:text-sm  rounded-md"   
                >   
                {{-- @endif --}}
            </div>
            <div class="basis-1/3">
                {{-- @if ($cost->haushaltsnah) --}}
                <input type="text"  
                    id="user-costamount_bk-detailinput-haushaltsnah{{ $cost->id }}"
                    inputmode="numeric"  
                    placeholder="1"
                    wire:model.lazy="current.haushaltsnah"
                    style="-moz-appearance: textfield; margin: 0;"
                    class="{{ $cost->haushaltsnah ? 'block' : 'hidden' }} text-center border md:text-md focus:ring-black p-1 px-2 m-0 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"   
                    > 
                    @if ($errors->first('current.haushaltsnah'))
                    <div class="mt-1 text-red-500 text-sm">{{ $errors->first('current.haushaltsnah') }}</div>
                    @endif
                {{-- @endif --}}
            </div>
            <div class="basis-1/3">
                <input type="text"    
                id="user-costamount-bk-detailinput-betrag{{ $cost->id }}"
                @keyup.down="focusAndSelectNekoElementById('{{ 'user-costamount-bk-detailinput-betrag'. $cost->id + 1 }}')"
                @keyup.up="focusAndSelectNekoElementById('{{ 'user-costamount-bk-detailinput-betrag'. $cost->id -1 }}')"
                @keyup.enter="focusAndSelectNekoElementById('{{ 'user-costamount-bk-detailinput-betrag'. $cost->id}}')"
                inputmode="numeric"  
                wire:model.lazy= {{ $netto ? 'current.netto' : 'current.brutto' }}
                style="-moz-appearance: textfield; margin: 0;"
                class="border text-center md:text-md focus:ring-black p-1 px-2 m-0 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"   
                >
            </div>
        </div>
    </div>
    @if ($errors->isNotEmpty())
        <div class="block text-sm bg-red-100 border border-red-400 text-red-700 px-1 py-1 rounded relative mb-2" role="alert">
            <span class="block sm:block"><strong class="font-bold">Uups! Einige Informationen fehlen oder sind nicht korrekt. </strong>
                @foreach ($errors->all() as $error)
                        <span class="block sm:block">- {{ $error  }}</span>
                @endforeach
            </span>
        </div>
    @endif
</div>