<div class="w-full px-4 py-1 mx-auto max-w-7xl sm:px-6 lg:px-8 ">
    <div class="">
        <livewire:user.occupant.occupant-header :occupant='$occupant'/>
    </div>
    <x-input.search wire:model.debounce.2000="filter"/>
        
    @if ($nutzergruppen->count()!=0)
    <div class="pb-4 mt-16">
        <div class="mb-5 text-lg font-bold text-center border-b-2 md:text-2xl border-sky-400 w-max-md md:block">
            Zählerverbräuche in {{ $rows->first()->zeitraum_akt }}
        </div>
    
        
        @foreach ($nutzergruppen as $counterMeter)

            <div class="">       
                <livewire:user.occupant.counter-meter.header :counterMeter='$counterMeter' :sorts='$sorts' :wire:key="'counter-meter-listitem-header'.$counterMeter->id" key="{{ now() }}"/>
            </div>

            <div class="md:border-2 md:rounded-b-lg md:border-sky-100">
                @forelse ($this->getCounterMetersByNutzergrupe($counterMeter->nutzergrup_id) as $singleCounterMeter)
                <livewire:user.occupant.counter-meter.listitem :singleCounterMeter='$singleCounterMeter' :wire:key="'counter-meter-listitem-'.$counterMeter->id"  key="{{ now() }}"/>
                
                @endforeach 
            </div>

        @endforeach

    @else 
        <livewire:not-found />
    @endif
    </div>
</div>



