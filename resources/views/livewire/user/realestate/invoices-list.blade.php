<div class="w-full px-4 py-1 mx-auto max-w-7xl sm:px-6 lg:px-8">


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

    <div class="py-5">
        <x-input.search wire:model.debounce.600ms="filters.search"></x-input.search>
    </div>

    @if($invoices->count()!=0)
        <div class="block mt-10 sm:hidden">
            @foreach ($invoices as $invoice)
                <div class="divide-gray-200 rounded-lg shadow-md max-w-1/4 bg-sky-50">
                    <div class="flex items-center justify-around w-full p-2 space-x-6 ">
                        <div class="flex-1 border-sky-100 ">
                            <div class="items-center ">
                                <div class="justify-start gap-2 m-auto text-md text-sky-700">
                                    <div class="">
                                        {{ $invoice->caption }}
                                    </div>
                                    <div class="flex justify-start">
                                        <div class="">
                                            Datum von:
                                        </div>
                                        <div class="text-gray-700">
                                            {{ $invoice->dateFrom}}
                                        </div>
                                    </div>
                                    <div class="flex justify-start">
                                        <div class="">
                                            Datum bis:
                                        </div>
                                        <div class="text-gray-700">
                                            {{ $invoice->dateTo }}
                                        </div>
                                    </div>
                                    <div class="flex justify-start">
                                        <div class="">
                                            brutto:
                                        </div>
                                        <div class="text-gray-700">
                                            {{ $invoice->netto }}
                                        </div>
                                    </div>
                                    <div class="flex justify-end px-10 -py-10">
                                        <a href="{{route('user.downloadspacesfile', 'i-'. $invoice->id )}}" class="flex items-center w-0 px-10 text-sm font-medium text-gray-700 border border-transparent rounded-br-lg hover:text-gray-500">
                                            <x-icon.fonts.file-download class="text-2xl sm:text-2xl text-sky-700 hover:text-sky-300"></x-icon.fonts.file-download>
                                        </a>
                                        <a target="_blank" href="{{route('user.showspacesfile', 'i-'. $invoice->id )}}" target="_blank" class="flex items-center w-0 text-sm font-medium text-gray-700 border border-transparent rounded-br-lg hover:text-gray-500">
                                            <x-icon.fonts.pdf-download class="text-2xl sm:text-2xl text-sky-700 hover:text-sky-300"></x-icon.fonts.pdf-download>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="hidden rounded sm:block">
            <div class="grid justify-around grid-cols-12 py-5 mt-1 font-bold text-center border-2 rounded-t-lg sm:text-xs bg-sky-100 border-sky-100">
                <div class="col-span-2">
                    Beschreibung
                </div>
                <div class="col-span-2">
                    Dateiname
                </div>
                <div class="col-span-1 ">
                    Erstellungsdatum
                </div>
                <div class="col-span-1">
                    Vertragsart
                </div>
                <div class="col-span-1">
                    bezahlt
                </div>
                <div class="col-span-1">
                    bezahlt am
                </div>
                <div class="col-span-1">
                    netto
                </div>
                <div class="col-span-1">
                    vat
                </div>
                <div class="col-span-1">
                    brutto
                </div>
            </div>

            @foreach ($invoices as $invoice)
                <div class="grid items-center grid-cols-12 pt-2 text-center sm:text-xs even:bg-sky-200 odd:bg-sky-300">
                    <div class="col-span-2">
                    {{ $invoice->caption }}
                    </div>
                    <div class="col-span-2">
                    {{ $invoice->fileName }}
                    </div>
                    <div class="col-span-1">
                    {{ $invoice->createDate }}
                    </div>
                    <div class="col-span-1">
                    {{ $invoice->vertragsart }}
                    </div>
                    <div class="col-span-1">
                    {{ $invoice->bezahlt }}
                    </div>
                    <div class="col-span-1">
                    {{ $invoice->bezahltAm }}
                    </div>
                    <div class="col-span-1">
                    {{ $invoice->netto }}
                    </div>
                    <div class="col-span-1">
                    {{ $invoice->vat }}
                    </div>
                    <div class="col-span-1">
                    {{ $invoice->brutto }}
                    </div>

                    <div class="grid grid-cols-2 col-span-1">
                            <a href="{{route('user.downloadspacesfile', 'i-'. $invoice->id )}}" class="flex items-center justify-center flex-1 w-0 text-sm font-medium text-gray-700 border border-transparent rounded-br-lg hover:text-gray-500">
                                <x-icon.fonts.file-download class="text-2xl sm:text-2xl text-sky-700 hover:text-sky-300"></x-icon.fonts.file-download>
                            </a>
                            <a target="_blank" href="{{route('user.showspacesfile', 'i-'. $invoice->id )}}" class="flex items-center justify-center flex-1 w-0 text-sm font-medium text-gray-700 border border-transparent rounded-br-lg hover:text-gray-500">
                                <x-icon.fonts.pdf-download class="text-2xl sm:text-2xl text-sky-700 hover:text-sky-300"></x-icon.fonts.pdf-download>
                            </a>
                    </div>
                </div>
            @endforeach
        </div>

    @else
        <div class="items-center justify-center mt-10">
            <span class="px-10">Rechnung nicht gefunden</span>
        </div>
    @endif

</div>
