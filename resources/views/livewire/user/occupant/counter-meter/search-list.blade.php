<div class="w-full px-4 py-1 mx-auto max-w-7xl sm:px-6 lg:px-8 ">

    <div
    x-data="{open:true}"
    x-init="open=true"

    >
        <div class="flex items-center justify-center ">
            <button x-on:click="open = !open" class="font-bold hover:text-sky-700">Bearbeitungshinweise ansehen ...</button>
        </div>
        <div x-show="open" class="">
            <div class="block sm:flex sm:gap-3">
                <div class="block mx-auto my-1 border border-b-2 border-gray-300 rounded-lg shadow-sm sm:basis-1/3 ">
                    <div class="items-center block m-2">
                        <div class="flex justify-start gap-3">
                            <x-icon.fonts.meters-reading class="fa-md text-sky-700"></x-icon.fonts.meters-reading>
                            <span class="font-semibold text-gray-900 text-md">Stände anzeigen</span>
                        </div>
                        <div class="text-xs text-gray-500 line-clamp-4 md:line-clamp-2">über diesen Button können Sie um den Status des Zählers zu überprüfen </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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



