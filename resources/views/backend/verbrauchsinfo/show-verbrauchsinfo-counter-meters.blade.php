<x-app-layout>
    <x-slot name="slot">
        <div class="max-w-7xl w-full mx-auto">
            <livewire:user.occupant.show-verbrauchsinfo-counter-meter :jahr_monat='$jahr_monat' :occupant='$occupant'/>
        </div>
    </x-slot>
</x-app-layout>