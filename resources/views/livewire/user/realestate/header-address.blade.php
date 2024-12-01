<div>
    <div class="hidden sm:block">
        <span class="flex w-32 text-center md:w-auto md:text-xl">
            {{ $this->realestate->address }}
        </span>
        <x-input.select
        class="text-left h-10 border-b bg-sky-50 sm:h-8 focus:border-0 w-full" wire:model="realestate.abrechnungssetting_id" id="realestate-header-address-abrechnungssetting-id" value="">
        <div class="h-10">
            @foreach ($this->realestate->abrechnungssettings as $label)
            <option value="{{ $label->id }}">
                <div class="flex justify-end">
                    <div class="text-left">
                        {{ $label->period_from_editing. ' - '. $label->period_to_editing   }}
                    </div>
                </div>
            </option>
            @endforeach
        </div>
        </x-input.select>
    </div>

    <div class="block sm:hidden">
        <span class="flex text-sm text-center sm:w-auto sm:text-sm">
            {{ $this->realestate->street }}
        </span>
        <span class="flex text-sm text-center sm:w-auto sm:text-sm">
            {{ $this->realestate->postCode }}
            {{ $this->realestate->city }}
        </span>
        
    </div>
</div>