<x-button
    {{ $attributes->merge([
        'class' => 'border-sky-600'
        ])
    }}
>
    {{ $slot }}
</x-button>
