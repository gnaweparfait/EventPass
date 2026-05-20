@props(['label', 'name', 'type' => 'text'])

<div>
    <label for="{{ $name }}" class="block text-sm font-semibold text-slate-700">{{ $label }}</label>
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        {{ $attributes->merge(['class' => 'ep-input']) }}
    />
    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>
