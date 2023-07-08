<x-app-layout>
    <x-slot name="header">
        <livewire:user.realestate.header :baseobject='$realestate'/>
    </x-slot>
    <x-slot name="slot">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                <div class="flex-shrink-0">
                    <x-icon.fonts.users class="text-2xl sm:text-4xl text-sky-700 hover:text-sky-300"></x-icon.fonts.users>
                </div>
                <div class="min-w-0 flex-1">
                    <a href="{{route('user.occupants', $realestate)}}" class="focus:outline-none">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        <p class="text-md font-medium text-gray-900">Nutzerliste</p>
                        <p class="text-md text-gray-500 line-clamp-4 md:line-clamp-2">Hier können Sie den Nutzerwechsel durchführen, Vorauszahlungen eintragen, Personenzahl oder Flächen ändern</p>
                    </a>
                </div>
            </div>
            <div class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                <div class="flex-shrink-0">
                    <x-icon.fonts.file-signature class="text-2xl sm:text-4xl text-sky-700 hover:text-sky-300"></x-icon.fonts.file-signature>
                </div>
                <div class="min-w-0 flex-1">
                    <a href="{{route('user.costs', $realestate)}}" class="focus:outline-none">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        <p class="text-md font-medium text-gray-900">Kostenliste</p>
                        <p class="text-md text-gray-500 line-clamp-4 md:line-clamp-2">Hier können Sie die Kosten eintragen und diese Bearbeiten</p>
                    </a>
                </div>
            </div>
            <div class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                <div class="flex-shrink-0">
                    <x-icon.fonts.poll-people class="text-2xl sm:text-4xl text-sky-700 hover:text-sky-300"></x-icon.fonts.poll-people>
                </div>
                <div class="min-w-0 flex-1">
                    <a href="{{route('user.realestateVerbrauchsinfoUserEmails', $realestate)}}" class="focus:outline-none">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        <p class="text-md font-medium text-gray-900">Emailadressen für den Versand der Verbraucherinformationen</p>
                        <p class="line-clamp-2 text-md text-gray-500 line-clamp-4 md:line-clamp-2">Hier bestimmen Sie an wer die Verbraucherinformationen einsehen kann</p>
                    </a>
                </div>
            </div>
           
        </div>
    
    </x-slot>
</x-app-layout>