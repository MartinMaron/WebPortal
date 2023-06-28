
<div class="p-4 text-xl text-right rounded-md xl bg-sky-100">
    <div class="flex items-center justify-between">
        <div class="flex items-center justify-between">
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
                <a href="{{route('user.realestateVerbrauchsinfoUserEmails', $realestate)}}">
                    <i class="fa-light fa-poll-people"></i>
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
