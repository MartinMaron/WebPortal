{{--! Wyswietlanie naglowki --}}

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
