@props(['size' => 'md'])

@php
    $sizes = [
        'sm' => ['box' => 'h-9 w-9 text-sm', 'text' => 'text-lg'],
        'md' => ['box' => 'h-10 w-10 text-base', 'text' => 'text-xl'],
        'lg' => ['box' => 'h-11 w-11 text-lg', 'text' => 'text-2xl'],
    ];
    $s = $sizes[$size] ?? $sizes['md'];
@endphp

<a {{ $attributes->merge(['href' => '/', 'class' => 'inline-flex items-center gap-2.5']) }}>
    <span class="flex {{ $s['box'] }} shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 font-bold text-white shadow-md shadow-indigo-600/30">
        E
    </span>
    <span class="{{ $s['text'] }} font-extrabold tracking-tight">
        <span class="text-inherit">Event</span><span class="text-indigo-600">Pass</span>
    </span>
</a>
