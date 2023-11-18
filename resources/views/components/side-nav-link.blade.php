@props(['active'])

@php
$classes = ($active ?? false)
            ? 'py-2 px-4 rounded-md cursor-pointer bg-blue-900 text-white transition flex items-center gap-2'
            : 'py-2 px-4 rounded-md cursor-pointer hover:bg-blue-100 transition hover:text-blue-900 flex items-center gap-2';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
