<div>
    <div class="max-w-7xl w-full mx-auto py-1 px-4 sm:px-6 lg:px-8">
        <!-- Suchfeld -->
        <x-input.search wire:model.debounce.600ms="filter.search"></x-input.search>

        <!-- Realestates List -->
        <div class="mt-6 w-full grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($filtered as $realestate)

                <div class="max-w-1/4 col-span-1 bg-sky-50 shadow-md divide-y divide-gray-200 rounded-lg">
                    <div class="flex items-center justify-between w-full p-2 space-x-6 ">
                        <div class="flex-1 truncate  border-sky-100 ">
                        <div class="w-full">
                            <div>
                                <div class="flex items-center space-x-3 ">
                                    <h3 class="line-clamp-1 text-lg text-gray-900 truncate font-mdmedium text- md:font-bold md:text-md">{{ $realestate->street }}</h3>
                                </div>
                            </div>
                        <p class="mt-1 text-gray-500 truncate text-md">{{ $realestate->postCode.' '. $realestate->city }}</p>
                        </div>
                        <div>
                            @if ($realestate->heizkosten)
                                <span class="flex-shrink-0 inline-block px-2 py-0.5 text-green-800 text-xs font-medium bg-green-100 rounded-full">Heizkosten</span>
                            @endif
                            @if ($realestate->miete)
                                <span class="flex-shrink-0 inline-block px-2 py-0.5 text-green-800 text-xs font-medium bg-green-100 rounded-full">Wärmedienst Gerätemiete</span>
                            @endif
                            @if ($realestate->rauchmelder)

                                <span class="flex-shrink-0 inline-block px-2 py-0.5 text-green-800 text-xs font-medium bg-green-100 rounded-full">Rauchmelder</span>
                            @endif
                        </div>
                        <div>
                            <span class="flex-shrink-0 inline-block px-2 py-0.5 text-green-800 text-xs font-medium bg-blue-200 rounded-full">Nutzereinheiten: 8</span>
                            <span class="flex-shrink-0 inline-block px-2 py-0.5 text-green-800 text-xs font-medium bg-blue-200 rounded-full">Fernwärme</span>
                        </div>
                        </div>
                    </div>

                    <div>
                        <!-- <div class="flex -mt-px divide-x divide-gray-200"> -->
                        <div class="flex h-8">
                            <div class="flex flex-1 w-0">
                                <a href="mailto:info@e-neko.de" class="relative inline-flex items-center justify-center flex-1 w-0 py-4 -mr-px text-sm font-medium text-gray-700 border border-transparent rounded-bl-lg hover:text-gray-500">
                                <i class="text-lg fa-duotone fa-envelope"></i>
                                <span class="ml-3">Email</span>
                            </a>
                        </div>
                        <div class="flex flex-1 w-0 -ml-px">
                            <a href="{{route('user.occupants', $realestate)}}" class="relative inline-flex items-center justify-center flex-1 w-0 py-4 text-sm font-medium text-gray-700 border border-transparent rounded-br-lg hover:text-gray-500">
                                <i class="text-lg fad fa-home"></i>
                                <span class="ml-3">Bearbeiten</span>
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-6 my-5">
            {{ $filtered->onEachSide(2)->links() }}
        </div>
    </div>
</div>


