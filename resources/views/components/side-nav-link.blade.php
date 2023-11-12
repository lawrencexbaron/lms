@props(['active'])

@php
$classes = ($active ?? false)
            ? 'py-3 px-4 cursor-pointer bg-blue-900 text-white transition'
            : 'py-3 px-4 cursor-pointer hover:bg-gray-50 transition hover:text-blue-900 ';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
