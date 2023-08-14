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

    <div class="flex items-center">
        <div class="flex justify-start mx-2">



        </div>
    </div>

</div>
