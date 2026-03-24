@props(['active', 'variant' => 'default'])

@php
$base = 'inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out';

$classes = match($variant) {
    'button' => $base . ' border border-gray-600 rounded-lg px-4 py-1 text-gray-700 hover:bg-gray-100',
    'pill'   => $base . ' px-3 py-1 rounded-full bg-gray-100 text-gray-700 hover:bg-gray-200',
    default  => ($active ?? false)
        ? $base . ' border-b-2 border-indigo-400 text-gray-900 focus:border-indigo-700'
        : $base . ' border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
};
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
