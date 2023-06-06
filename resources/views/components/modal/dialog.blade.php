@props([
    'id' => null,
    'maxWidth' => null,
    'minWidth' => null,
    ])

<x-modal :id="$id" :maxWidth="$maxWidth" :minWidth="$minWidth" {{ $attributes }}>
     <div class="bg-sky-50 px-2 sm:px-6 py-2 sm:py-4">
        <div class="text-lg">
            {{ $title }}
        </div>

        <div class="mt-4">
            {{ $content }}
        </div>
    </div>

    <div class="px-6 py-4 bg-sky-100 text-right">
        {{ $footer }}
    </div>
</x-modal>
