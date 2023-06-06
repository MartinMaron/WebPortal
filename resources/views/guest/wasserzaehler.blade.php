<x-guest-layout>
    <x-slot name="slot">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            
            <h2 class="font-semibold py-2 text-2xl text-gray-800 leading-tight">
                WASSERZÄHLER
            </h2>
            <img class="rounded-md py-2 w-full " src="img/home/Wasserzaehler_gross.jpg" alt="">
            <p class="pt-3">
                Einstrahl Aufputzwasserzähler für Kaltwasser oder Warmwasser (Kaltwasser bis 30°C / Warmwasser bis 90°C) sind in unterschiedlichen Nenngrößen, mit achtstelligem Rollenzählwerk oder in einer LCD-Version mit Mikrocomputer erhältlich.  
            </p>
            <p class="pt-3">
                Folgende Anwendungsmöglichkeiten bieten sich an:<br>
                Waschtischzähler (Eckventil) / Zapfhahnzähler / Rohrleitungszähler.
            </p>
        
            <p class="pt-4"><strong>Unterputz-Kapselzähler</strong></p>
            <p class="pt-1">Unterputzzähler eignen sich zur Wasser-Verbrauchsmessung von kleinen Durchflussmengen im Haustechnikbereich. Die Verbrauchsdaten werden meistens zur Abrechnung des Wasserverbrauches benötigt. Wasserzähler für die Unterputz-Montage sind optional auch mit Impulsausgang erhältlich. Eine Besonderheit beim Eichaustausch besteht darin, dass lediglich die Unterputz-Messkapsel getauscht wird und nicht der komplette Messkopf.</p>

            <p class="pt-4"><strong>Ventilzähler</strong></p>
            <p class="pt-1">Dieser Zähler eignet sich speziell für die Ausrüstung bestehender Liegenschaften. Wohneinheiten die über keinen Zähler bisher verfügen, können problemlos mit einem Ventilzähler für die Kalt- und Warmwasserzählung nachgerüstet werden.</p>


            <p class="pt-4"><strong>Mischbatteriezähler</strong></p>
            <p class="pt-1">Wasserzähler für die kostengünstige Erfassung des Wasserverbrauchs bei nachträglicher Montage an dem Wandanschluss und an der Armatur bei Badewannen, Duschen oder Spülen.</p>

            <p class="pt-4"><strong>Waschtischzähler/Zapfhahnzähler</strong></p>
            <p class="pt-1">Der Waschtischzähler wird auf die vorhandenen Eckventile unter dem Waschbecken aufgebaut. Für den Leitungsanschluss steht die entsprechende Verschraubung zur Verfügung.</p>


            <div class="flex">
                <p class="py-2">
                    <strong>weitere Informationen (PDF)</strong>
                </p>
                <a class="py-2 underline ml-3 flex bg-white" href="{{route('downloadpublicfile', 'Wasserzaehler.pdf')}}">
                    <span class = "text-md font-semibold text-sky-900 opacity-90 group-hover:opacity-100 transition duration-150 ease">
                        {{ __('download .pdf') }}
                    </span>                         
                </a>
                
                <a class="py-2 underline ml-3 flex bg-white" href="{{route('showpublicfile', 'Wasserzaehler.pdf')}}">
                    <span class = "text-md font-semibold text-sky-900 opacity-90 group-hover:opacity-100 transition duration-150 ease">
                        {{ __('ansehen .pdf') }}
                    </span>                         
                </a>
            </div>
            
        </div>    
    </x-slot>
</x-guest-layout>