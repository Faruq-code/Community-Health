@props(['variant' => 'default'])

@php
    $variants = [
        'default' => 'border-transparent bg-indigo-600 text-white hover:bg-indigo-500',
        'secondary' => 'border-transparent bg-white/10 text-white hover:bg-white/20',
        'destructive' => 'border-transparent bg-red-600 text-white hover:bg-red-500',
        'outline' => 'text-white border-white/10',
        'amber' => 'border-transparent bg-amber-600 text-white hover:bg-amber-500',
        'success' => 'border-transparent bg-green-600 text-white hover:bg-green-500',
    ];

    $classes = "inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 " . ($variants[$variant] ?? $variants['default']);
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
