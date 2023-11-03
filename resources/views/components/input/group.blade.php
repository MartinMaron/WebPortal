

@props([
    'label',
    'for',
    'error' => false,
    'helpText' => false,
    'paddingless' => false,
    'borderless' => false,
    'bottom' => true,
    'labelless' => '',
    'hohe' => 'h-10',
    'hoheOnError' => 'h-12',
    'hoheLabel' => 'h-auto',
    'hoheContent' => 'h-auto',
    'hoheContentOnError' => 'h-auto',
    'labelDirection' => 'text-right',
    'errorDirection' => 'text-right',
    'paddingLabel' => 'pt-3',
    'alignLabel' => 'align-bottom'
])
    <div
        class="block sm:flex {{ $error ? $hoheOnError : $hohe }} {{ $error ? 'mb-2 sm:mb-1' : '' }} sm:mt-1 sm:grid sm:grid-cols-6 sm:gap-2 {{ $bottom ? 'sm:items-end' : 'sm:items-start' }}">
        <div class="sm:col-span-2
            {{ $alignLabel }}
            {{ $hoheLabel }}
            {{ $bottom ? '' : 'pt-2' }}
            {{ $error ? 'pb-2' : '' }}
            {{ $labelless ? 'hidden' : '' }}
            sm:{{ $labelDirection }}
            px-2 border-b-2 border-l-2 sm:border-r-2 sm:border-l-0 rounded border-sky-800/50 block sm:text-sm font-medium leading-5 text-gray-400">
            <label for="{{ $for }}"
                class="{{ $alignLabel }}
                       {{ $paddingLabel }}
                       {{ $hoheLabel }}">
                {{ $label }}
            </label>
        </div>
        <div class="
            {{ $error ? $hoheContentOnError : $hoheContent }}
            {{ $borderless ? '' : 'border-b-2 border-l-2 sm:border-r-0 border-solid rounded border-sky-800/50' }}
            {{ $labelless ? 'sm:col-span-6' : 'sm:col-span-4' }}
            ">
            {{ $slot }}
            @if ($error)
            <div class=" mt-1 {{ $errorDirection }} text-red-500 text-sm">{{ $error }}</div>
            @endif
        </div>
        
    </div>

