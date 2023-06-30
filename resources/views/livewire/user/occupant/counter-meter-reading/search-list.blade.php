<div class="w-full px-4 py-1 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div>
        <livewire:user.occupant.occupant-header :occupant='$occupant'/>
    </div>
    @if ($rows->count()!=0)
        <div class="md:text-center">{{ $rows->first()->nr }}
        </div>
    @endif

    <div class="mt-16">
        <div class="mb-5 text-xl font-bold text-center border-b-2 border-sky-400 md:text-2xl">
            Stände anzeigen {{ '['. $rows->first()->einheit->shortname. ']' }}
        </div>

        @if ($rows->count()!=0)
            
            <div class="">
                <livewire:user.occupant.counter-meter-reading.header :sorts='$sorts' :wire:key="'counter-meter-reading-listitem-header'.$counterMeter->id" key="{{ now() }}"/>
            </div>

                @foreach ($rows as $counterMeter)

                <div class= "{{ $rows->first()->hk ? 'even:bg-green-50 odd:bg-green-100' :'even:bg-red-50 odd:bg-red-100'}}  
                    py-1 m-auto text-center  text-xs md:text-lg border-2 border-sky-100 rounded-b-lg md:w-5/6">
                    <livewire:user.occupant.counter-meter-reading.listitem :counterMeter='$counterMeter' :wire:key="'counter-meter-reading-listitem-'.$counterMeter->id"  key="{{ now() }}"/>
                </div>
                
                @endforeach
        
        @else 
            <livewire:not-found />
        @endif
    </div>
</div>
