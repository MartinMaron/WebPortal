<x-app-layout>
    <x-slot name="header">
        <livewire:user.realestate.header :baseobject='$realestate'/>
    </x-slot>
    <x-slot name="slot">
        <livewire:user.occupant.occupant-list :baseobject='$realestate'/>
    </x-slot>
</x-app-layout>
