<div class="w-full px-4 py-1 mx-auto max-w-7xl sm:px-6 lg:px-8">

    <livewire:user.occupant.occupant-header :occupant='$occupant'/>

    @if ($rows->count()!=0)
        <div class="md:text-center">{{ $rows->first()->nr }}
        </div>
    @endif

    <div class="mt-16">
        <div class="mb-5 text-xl font-bold text-center border-b-2 border-sky-400 md:text-2xl">
            Stände anzeigen {{ '['. $rows->first()->einheit->shortname. ']' }}
        </div>

            @if ($rows->count()!=0)
            
                <livewire:counter-meter-reading-headings/>

                    @foreach ($rows as $counterMeter)
                    <div class= "{{ $rows->first()->hk ? 'even:bg-green-50 odd:bg-green-100' :'even:bg-red-50 odd:bg-red-100'}}  
                    flex flex-row py-1 text-center justify-between text-xs md:text-lg">
                    <livewire:counter-meter-reading-data :counterMeter='$counterMeter'/>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    @if ($rows->count()==0)
        <livewire:message-nichts-gefunden />
    @endif
</div>
