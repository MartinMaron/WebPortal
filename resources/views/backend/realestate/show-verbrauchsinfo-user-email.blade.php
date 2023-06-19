<x-app-layout>
    <x-slot name="slot">
        <x-slot name="header">
            <livewire:user.realestate.header :baseobject='$realestate'/>
        </x-slot>
        <div class="max-w-7xl w-full mx-auto">
            <livewire:user.realestate.verbrauchsinfo-user-email.search-list :realestate='' :realestate='$realestate'/>
        </div>
    </x-slot>
</x-app-layout>
