<div>
    <div class="max-w-7xl w-full mx-auto py-1 px-4 sm:px-6 lg:px-8">
        <div>
            <x-input.search wire:model.debounce.1000ms="filter" />
        </div>
        <div class="mt-6 w-full grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @if ($rows->count()!=0)
               @foreach ($rows as $occupant)
                <div>
                    <div x-data="{ open: false }" class="max-w-1/4 col-span-1 bg-sky-100 shadow-md divide-y divide-gray-200 rounded-lg">
                        <div class="flex items-center justify-between w-full p-2 space-x-6 ">
                            <div class="flex-1 truncate  border-sky-200 ">
                                <div x-on:click="open = ! open"  class="w-full">
                                    <div>
                                        <div class="flex items-center space-x-3 ">
                                            <h3 class="flex-1 text-center line-clamp-1 text-lg text-gray-900 truncate font-mdmedium text- md:font-bold md:text-md">{{ $occupant->lage. ' - '. $occupant->nachname. '' }}</h3>
                                        </div>
                                    </div>
                                    <p class="mt-1 flex-1 text-center text-gray-500 truncate text-md">{{ $occupant->street.', '. $occupant->postcode. ' '. $occupant->city }}</p>
                                </div>
                                <div x-show="open" x-transition>
                                    <div class="my-5">
                                        <livewire:user.occupant.verbrauchsinfo.occupant-view :pOccupant='$occupant'/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
        <x-button.transparent class="flex-row bg-sky-100 px-2 py-1 mt-3" :active="request()->routeIs('user.verbrauchsinfohistory')">

            <a href="{{route('user.verbrauchsinfohistory', $occupant)}}">

                <span class = "text-md font-semibold text-black opacity-90 group-hover:opacity-100 transition duration-150 ease">

                    {{ __('Verlaufsliste') }}

                </span>

            </a>

        </x-button.transparent>

        @if ($rows->count()==0)
            <div class="flex justify-center items-center space-x-2 bg-sky-100">
                <span class="font-medium py-8 text-cool-gray-400 text-xl">nichts gefunden...</span>
            </div>
        @endif
    </div>
</div>
