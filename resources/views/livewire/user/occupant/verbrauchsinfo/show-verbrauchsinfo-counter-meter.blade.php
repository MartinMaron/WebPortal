<div class="w-full px-4 py-1 mx-auto max-w-7xl sm:px-6 lg:px-8 ">
    <livewire:user.occupant.occupant-header  :occupant='$occupant'/>
    <x-input.search wire:model.debounce.2000="filter"/>
        
    @if ($nutzergruppen->count()!=0)
    <div class="pb-4 mt-16">
        <div class="mb-5 text-lg font-bold text-center border-b-2 md:text-2xl border-sky-400 w-max-md md:block">
            Zählerverbräuche in {{ $rows->first()->zeitraum_akt }}
        </div>
    </div>
        
    @foreach ($nutzergruppen as $counterMeter)
        {{-- Duzy ekran --}}
        <livewire:counter-meter-large :counterMeter='$counterMeter'/>

            @forelse ($this->getCounterMetersByNutzergrupe($counterMeter->nutzergrup_id) as $singleCounterMeter)
                    {{-- Maly ekran --}}
                <livewire:counter-meter-small :singleCounterMeter='$singleCounterMeter' :occupant='$occupant'/>

            @endforeach
        </div>
            
    @endforeach
    @endif
    @if ($rows->count()==0)
        <livewire:message-nichts-gefunden />
    @endif
</div>

