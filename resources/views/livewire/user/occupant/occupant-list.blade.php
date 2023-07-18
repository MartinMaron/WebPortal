<div>
    <div class="max-w-7xl w-full mx-auto py-1 px-4 sm:px-6 lg:px-8">
        <!-- Suchfeld -->
        <x-input.search wire:model.debounce600="filter.search" />
    
        <!-- Realestates List -->
        <div class="mt-6 w-full grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($rows as $occupant)
                <div class="">
                    <livewire:user.occupant.occupant-header :occupant='$occupant' key="{{ now() }}" />
                </div>
            @endforeach
        </div>
    </div>
</div>
