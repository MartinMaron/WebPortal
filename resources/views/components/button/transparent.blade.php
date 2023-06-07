<x-button
    {{ $attributes->merge([
        'class' => 'border-sky-100 bg-sky-100 hover:bg-sky-200'
        ])
    }}
>
    {{ $slot }}
</x-button>
