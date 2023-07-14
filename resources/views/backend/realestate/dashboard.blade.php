<x-app-layout>
    <x-slot name="header">
        <livewire:user.realestate.header :baseobject='$realestate'/>
    </x-slot>
    <x-slot name="slot">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="relative flex items-center px-6 py-5 space-x-3 bg-white border border-gray-300 rounded-lg shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                <div class="flex-shrink-0">
                    <x-icon.fonts.users class="text-2xl sm:text-4xl text-sky-700 hover:text-sky-300"></x-icon.fonts.users>
                </div>
                <div class="flex-1 min-w-0">
                    <a href="{{route('user.occupants', $realestate)}}" class="focus:outline-none">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        <p class="font-medium text-gray-900 text-md">Nutzerliste</p>
                        <p class="text-gray-500 text-md line-clamp-4 md:line-clamp-2">Hier können Sie den Nutzerwechsel durchführen, Vorauszahlungen eintragen, Personenzahl oder Flächen ändern</p>
                    </a>
                </div>
            </div>
            <div class="relative flex items-center px-6 py-5 space-x-3 bg-white border border-gray-300 rounded-lg shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                <div class="flex-shrink-0">
                    <x-icon.fonts.file-signature class="text-2xl sm:text-4xl text-sky-700 hover:text-sky-300"></x-icon.fonts.file-signature>
                </div>
                <div class="flex-1 min-w-0">
                    <a href="{{route('user.costs', $realestate)}}" class="focus:outline-none">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        <p class="font-medium text-gray-900 text-md">Kostenliste</p>
                        <p class="text-gray-500 text-md line-clamp-4 md:line-clamp-2">Hier können Sie die Kosten eintragen und diese Bearbeiten</p>
                    </a>
                </div>
            </div>
            <div class="relative flex items-center px-6 py-5 space-x-3 bg-white border border-gray-300 rounded-lg shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                <div class="flex-shrink-0">
                    <x-icon.fonts.poll-people class="text-2xl sm:text-4xl text-sky-700 hover:text-sky-300"></x-icon.fonts.poll-people>
                </div>
                <div class="flex-1 min-w-0">
                    <a href="{{route('user.realestateVerbrauchsinfoUserEmails', $realestate)}}" class="focus:outline-none">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        <p class="font-medium text-gray-900 text-md">Emailadressen für den Versand der Verbraucherinformationen</p>
                        <p class="text-gray-500 text-md line-clamp-4 md:line-clamp-2">Hier bestimmen Sie wer die Verbraucherinformationen einsehen kann</p>
                    </a>
                </div>
            </div>
           
        </div>
    
    </x-slot>
</x-app-layout>