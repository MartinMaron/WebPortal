<x-app-layout>
    <x-slot name="slot">
      <div>
            <livewire:user.occupant.show-verbrauchsinfo-counter-meter-reading :occupant='$occupant' :neko_id='$id'>
        </div>
    </x-slot>
</x-app-layout>