<div class="w-full px-4 py-1 mx-auto max-w-7xl sm:px-6 lg:px-8 ">
    @if ($nutzeinheiten->count()!=0)
    @foreach ($nutzeinheiten as $nutzeinheit)

    <div class="">
        <livewire:user.occupant.occupant-header  :occupant='$this->lastOccupant($nutzeinheit->nutzeinheitNo)'/>
    </div>

    {{-- pokazac ostatniego lokatora mieszkania --}}
    @forelse ($this->getUserEmailsForNutzeinheitNo($nutzeinheit->nutzeinheitNo) as $userEmail)

    {{-- pokazac wiersze email-ow --}}
    <div class="">
        <div class="invisible sm:visible">
            duzy ekran
        </div>
        <div class="sm:invisible block ">
            <div class="flex">
                <div class="basis-2/3">
                    <div class="">
                        {{ $userEmail->email }}
                    </div>
                    <div class="text-xs {{ $userEmail->aktiv ? 'text-black' : 'text-gray-500' }} ">
                        {{ $userEmail->Zeitraum }} 
                    </div>
                </div>
                <div class="basis-1/6 inline-block align-bottom">
                    <x-icon.fonts.email-active :value='$userEmail->aktiv' class="py-1 px-4 border-2 text-sm" ></x-icon.fonts.email-active>
                </div>
                <div class="basis-1/6 ">
                    <x-icon.fonts.pencil class="py-1 px-4 border-2 border-sky-200 text-sm" ></x-icon.fonts.pencil>
                </div>
                <div class="basis-1/6 ">
                    <x-icon.fonts.trash class="py-1 px-4 border-2 border-sky-200 text-sm" ></x-icon.fonts.trash>
                </div>
            </div>
        </div>
    </div>

    @endforeach

    @endforeach
    
    @else
    {{-- pokazac komunikat 'brak wierszy' --}}
    @endif

    {{-- modyfikacja wiersza modal --}}
    



</div>
