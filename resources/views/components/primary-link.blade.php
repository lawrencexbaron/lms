@props(['route' => null, 'params' => [], 'href' => null])

@php
    $attributes = $attributes->class([
        'cursor-pointer inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150',
    ])->merge([
        'href' => $href ?? ($route ? route($route, $params) : '#'),
    ]);
@endphp

<a {{ $attributes }}>
    {{ $slot }}
</a>