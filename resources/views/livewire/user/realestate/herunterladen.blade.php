<div class="w-full px-4 py-1 sm:px-6 lg:px-8 max-w-7xl ">


    <div
        x-data="{open:true}"
        x-init="open=true"

    >
        <div class="flex items-center justify-center ">
            <button x-on:click="open = !open" class="font-bold hover:text-sky-700">Bearbeitungshinweise ansehen ...</button>
        </div>
        <div x-show="open" class="">
            <div class="justify-center block sm:flex sm:gap-3">
                <div class="block my-1 border border-b-2 border-gray-300 rounded-lg shadow-sm sm:basis-1/3 ">
                    <div class="items-center block m-2">
                        <div class="flex justify-start gap-3">
                            <x-icon.fonts.file-download class="fa-md sm:fa-2xl text-sky-700"></x-icon.fonts.file-download>
                            <span class="font-semibold text-gray-900 text-md">Laden Sie Ihre Rechnung herunter</span>
                        </div>
                        <div class="text-xs text-gray-500 line-clamp-4 md:line-clamp-2">über diesen Button können Sie die Rechnung im PDF-Format auf die Festplatte Ihres Computers herunterladen</div>
                    </div>
                </div>
                <div class="block my-1 border border-b-2 border-gray-300 rounded-lg shadow-sm sm:basis-1/3 ">
                    <div class="items-center block m-2">
                        <div class="flex justify-start gap-3">
                            <x-icon.fonts.pdf-download class="fa-md sm:fa-2xl text-sky-700"></x-icon.fonts.pdf-download>
                            <span class="font-semibold text-gray-900 text-md">Rechnungsvorschau</span>
                        </div>
                        <div class="text-xs text-gray-500 line-clamp-4 md:line-clamp-2">über diesen Button können Sie Rechnungsvorschau</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="items-center py-10">
        <div class="flex mt-1 font-bold text-center border-2 rounded-t-lg sm:text-md md:flex-1 bg-sky-100 border-sky-100">
            <div class="basis-1/4">
                Beschreibung
            </div>
            <div class="basis-1/4">
                Dateiname
            </div>
            <div class="basis-1/4">
                Erstellungsdatum
            </div>
            <div class="basis-1/4">
            </div>
        </div>
        @foreach ($invoices as $invoice)

        <div class="flex justify-around pt-2 mx-2 text-sm text-center even:bg-sky-500 odd:bg-sky-600">
                <div class="basis-1/4">
                {{ $invoice->description }}
                </div>
                <div class="basis-1/4">
                {{ $invoice->fileName }}
                </div>
                <div class="basis-1/4">
                {{ $invoice->createDate }}
                </div>
                <div class="flex items-center basis-1/4">
                    <div class="basis-1/5">
                        <a href="{{route('downloadspacesfile', ['app/rechnung', 'id' => $invoice->nekoId, 'file_name' => $invoice->fileName ])}}" class="flex items-center justify-center flex-1 w-0 text-sm font-medium text-gray-700 border border-transparent rounded-br-lg hover:text-gray-500">
                            <x-icon.fonts.file-download class="text-2xl sm:text-2xl text-sky-700 hover:text-sky-300"></x-icon.fonts.file-download>
                        </a>
                    </div>
                    <div class="basis-1/5">
                        <a href="{{route('showspacesfile', ['app/rechnung', 'id' => $invoice->nekoId, 'file_name' => $invoice->fileName ])}}" class="flex items-center justify-center flex-1 w-0 text-sm font-medium text-gray-700 border border-transparent rounded-br-lg hover:text-gray-500">
                            <x-icon.fonts.pdf-download class="text-2xl sm:text-2xl text-sky-700 hover:text-sky-300"></x-icon.fonts.pdf-download>
                        </a>
                    </div>
                </div>
        </div>

        @endforeach
    </div>

</div>
