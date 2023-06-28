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
                <div class= "m-auto border-2 rounded-t-lg bg-sky-100 border-sky-100 md:w-5/6">
                    <div class="flex items-center justify-between mt-2 text-xs font-bold text-center md:text-lg">
                        <x-table.heading class="flex justify-center text-center basis-1/5" sortable multi-column wire:click="sortBy('datum')" :direction="$sorts['datum'] ?? null">
                            <div class="items-center">
                                Monat
                            </div>
                        </x-table.heading>
                        <div class="basis-1/5">
                            {{ 'Ende' }}
                        </div>
                        -
                        <div class="basis-1/5">
                            Anfang
                        </div>
                        x
                        <div class="basis-1/5">
                            Faktor
                        </div>
                        =
                        <div class="basis-1/5">
                            Verbrauch
                        </div>
                    </div>
                </div>
                <div class="m-auto border-2 rounded-b-lg border-sky-100 md:w-5/6">

                    @foreach ($rows as $counterMeter)
                    <div class= "{{ $rows->first()->hk ? 'even:bg-green-50 odd:bg-green-100' :'even:bg-red-50 odd:bg-red-100'}}  flex flex-row py-1 text-center justify-between text-xs md:text-lg">
                        <div class="basis-1/5">
                            {{ $counterMeter->zeitraum_akt }}
                        </div>
                        <div class="basis-1/5">
                            {{ $counterMeter->stand_anfang }}
                        </div>
                        <div class="basis-1/5">
                            {{ $counterMeter->stand_ende }}
                        </div>
                        <div class="basis-1/5">
                            {{ $counterMeter->faktor }}
                        </div>
                        <div class="basis-1/5">
                            {{ $counterMeter->VerbrauchAktDisplay }}
                        </div>
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
