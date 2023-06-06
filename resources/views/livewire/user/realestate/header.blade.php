

<div class="text-xl text-right xl p-4 bg-sky-100 rounded-md">
    <div class="flex justify-between items-center">
        <div class="flex justify-between items-center">
            <div class="px-4">
                <a href="{{route('user.occupants', $realestate)}}">
                    <x-icon.fonts.users class="h-30 text-sky-700 hover:text-sky-300"></x-icon.fonts.users>
                </a>
            </div>
            <div class="px-4">
                <a href="{{route('user.costs', $realestate)}}">
                    <x-icon.fonts.file-signature class="h-30 text-sky-700"></x-icon.fonts.file-signature>
                </a>
            </div>

            <div class="px-4">
                <a href="{{route('labor')}}">
                    <x-icon.fonts.vials class="h-30 text-sky-700"></x-icon.fonts.vials>
                </a>
            </div>
        </div>
        <span>
            {{ $this->realestate->address }}
        </span>
    </div>
</div>
