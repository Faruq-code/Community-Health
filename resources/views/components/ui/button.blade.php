@props([
    'variant' => 'default',
    'size' => 'default',
    'type' => 'submit',
])

@php
    $variants = [
        'default' => 'bg-indigo-600 text-white hover:bg-indigo-500 shadow hover:shadow-indigo-500/20',
        'outline' => 'border border-white/10 bg-transparent hover:bg-white/5 text-white',
        'secondary' => 'bg-white/10 text-white hover:bg-white/15',
        'ghost' => 'hover:bg-white/5 text-gray-400 hover:text-white',
        'link' => 'text-indigo-400 underline-offset-4 hover:underline p-0 h-auto',
        'destructive' => 'bg-red-600 text-white hover:bg-red-500 shadow-sm hover:shadow-red-500/20',
        'amber' => 'bg-amber-600 text-white hover:bg-amber-500 shadow hover:shadow-amber-500/20',
    ];

    $sizes = [
        'default' => 'h-10 px-4 py-2',
        'sm' => 'h-8 px-3 text-xs',
        'lg' => 'h-12 px-8 text-lg',
        'icon' => 'h-10 w-10',
    ];

    $classes = "inline-flex items-center justify-center rounded-md text-sm font-medium transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 disabled:pointer-events-none disabled:opacity-50 active:scale-95 " . ($variants[$variant] ?? $variants['default']) . " " . ($sizes[$size] ?? $sizes['default']);
@endphp

@if($attributes->has('href'))
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => $type, 'class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
