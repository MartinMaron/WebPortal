
<div class="p-4 text-lg text-right rounded-md sm:text-3xl bg-sky-100">
    <div class="flex items-center justify-between">
        <div class="flex items-center justify-between">
            <div class="px-2 sm:px-4">
                <a href="{{route('user.realestate', $realestate)}}">
                <i class=" text-sky-700 hover:text-sky-300 fad fa-home"></i>
            </a>
            </div>
            <div class="px-2 sm:px-4">
                <a href="{{route('user.occupants', $realestate)}}">
                    <x-icon.fonts.users class="text-sky-700 hover:text-sky-300"></x-icon.fonts.users>
                </a>
            </div>
            <div class="px-2 sm:px-4">
                <a href="{{route('user.costs', $realestate)}}">
                    <x-icon.fonts.file-signature class="text-sky-700 hover:text-sky-300"></x-icon.fonts.file-signature>
                </a>
            </div>
            <div class="px-2 sm:px-4">
                <a href="{{route('user.realestateVerbrauchsinfoUserEmails', $realestate)}}">
                    <x-icon.fonts.poll-people class="text-sky-700 hover:text-sky-300"></x-icon.fonts.poll-people>
                </a>
            </div>
        </div>
        <div>
            <livewire:user.realestate.header-address :baseobject='$realestate' />        
        </div>
    
    </div>
</div>