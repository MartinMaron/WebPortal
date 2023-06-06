<x-guest-layout>
    <x-slot name="slot">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            
            <h2 class="font-semibold py-2 text-2xl text-gray-800 leading-tight">
                HEIZKOSTENVERTEILER
            </h2>
            <img class="rounded-md py-2 w-full " src="img/home/heizkostenverteiler.jpg" alt="">
            <p class="pt-3">
                Der Sontex EHKV steht für Sontex-Präzision mit maximalen Messkomfort und garantiert eine hohe Messauflösung der Verbrauchswerte. Dank der intelligenten Erfassung unterscheidet der Heizkostenverteiler die Sommer und Wintermonate eindeutig.  
            </p>            
            <p class="pt-3 pb-6">
                Im Vergleich zu herkömmlichen Funksystemen, entstehen keine Belastungen durch permanente Funksignale, denn das bidirektionale Funksystem sendet nur, wenn es tatsächlich abgefragt wird. Dank der Möglichkeit der mobilen oder fixen Datenerfassung passt sich das System sämtlichen Kundenbedürfnissen an.           </p>            
            <p class="py-3">
                <strong>Sontex 566, 868</strong>
            </p>
            <ul>
                <x-listitem.guest-standard>Wireless M-Bus Funkverbindung (Sontex 868)</x-listitem.guest-standard>
                <x-listitem.guest-standard>automatische Inbetriebnahme bei Schienenmontage</x-listitem.guest-standard>
                <x-listitem.guest-standard>Fernfühler anschliessbar an jedes Modell</x-listitem.guest-standard>
                <x-listitem.guest-standard>Passwortgeschützte Parametrierung</x-listitem.guest-standard>
                <x-listitem.guest-standard>AES-128-Verschlüsselung für sichere Auslesung</x-listitem.guest-standard>
                <x-listitem.guest-standard>Gesamtzahl der Manipulationsfälle</x-listitem.guest-standard>
                <x-listitem.guest-standard>bis zu 15 am LCD anzeigbare Werte</x-listitem.guest-standard>
                <x-listitem.guest-standard>bis zu 144 Monatswerte und 18 Halbmonatswerte gespeichert</x-listitem.guest-standard>
                <x-listitem.guest-standard>18 Monatswerte der Höchsttemperatur des Heizkörpers gespeichert</x-listitem.guest-standard>
                <x-listitem.guest-standard>Einfühler- oder Zweifühler-Messverfahren</x-listitem.guest-standard>
                <x-listitem.guest-standard>Einheits- oder Produktskala, je nach Abrechnungsmethode festzulegen</x-listitem.guest-standard>
                <x-listitem.guest-standard>erfüllt die Anforderungen der Norm EN 834:2013</x-listitem.guest-standard>
                <x-listitem.guest-standard>Benutzerfreundliches Bedienkonzept dank Bedientaste</x-listitem.guest-standard>
                <x-listitem.guest-standard>optische Schnittstelle für Auslesung von Verbrauchswerten und zur Parametrierung</x-listitem.guest-standard>
                <x-listitem.guest-standard>Hergestellt in der Schweiz</x-listitem.guest-standard>
            </ul>

            <div class="flex">
                <p class="py-2">
                    <strong>weitere informationen zu Sontex 566 u. 868 als pdf</strong>
                </p>
                
                    <a class="py-2 underline ml-3 flex bg-white" href="{{route('downloadpublicfile', 'Sontex_565_566_868_DE.pdf')}}">
                        <span class = "text-md font-semibold text-sky-900 opacity-90 group-hover:opacity-100 transition duration-150 ease">
                            {{ __('download .pdf') }}
                        </span>                         
                    </a>
                
                     <a class="py-2 underline ml-3 flex bg-white" href="{{route('showpublicfile', 'Sontex_565_566_868_DE.pdf')}}">
                        <span class = "text-md font-semibold text-sky-900 opacity-90 group-hover:opacity-100 transition duration-150 ease">
                            {{ __('ansehen .pdf') }}
                        </span>                         
            
                    </a>
            </div>
            
        </div>    
    </x-slot>
</x-guest-layout>
