@props([
    'name' => 'avatar',
    'currentUrl' => null,
    'initials' => '?',
    'showRemove' => false,
])

<div x-data="{
    preview: @js($currentUrl),
    initials: @js($initials),
    handleFile(e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = (ev) => { this.preview = ev.target.result; };
        reader.readAsDataURL(file);
    },
    clearPreview() {
        this.preview = null;
        $refs.fileInput.value = '';
        if ($refs.removeInput) $refs.removeInput.value = '1';
    }
}" class="flex flex-col items-center gap-4 sm:flex-row sm:items-start">
    <div class="relative shrink-0">
        <template x-if="preview">
            <img :src="preview" alt="Photo de profil" class="h-24 w-24 rounded-2xl object-cover ring-4 ring-white shadow-ep">
        </template>
        <template x-if="!preview">
            <div class="flex h-24 w-24 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-600 text-2xl font-bold text-white shadow-ep ring-4 ring-white" x-text="initials"></div>
        </template>
    </div>

    <div class="flex-1 text-center sm:text-left">
        <p class="text-sm font-semibold text-slate-700">Photo de profil</p>
        <p class="mt-0.5 text-xs text-slate-500">JPG, PNG ou WebP — max. 2 Mo</p>

        <div class="mt-3 flex flex-wrap items-center justify-center gap-2 sm:justify-start">
            <label class="ep-btn-secondary !py-2 !px-4 cursor-pointer text-sm">
                <input type="file" name="{{ $name }}" accept="image/jpeg,image/png,image/webp" class="sr-only" x-ref="fileInput" @change="handleFile($event); if ($refs.removeInput) $refs.removeInput.value = '0'">
                Choisir une photo
            </label>
            @if ($showRemove && $currentUrl)
                <button type="button" @click="clearPreview()" class="text-sm font-medium text-red-600 hover:text-red-700">
                    Supprimer
                </button>
                <input type="hidden" name="remove_avatar" value="0" x-ref="removeInput">
            @endif
        </div>
        <x-input-error :messages="$errors->get($name)" class="mt-2" />
    </div>
</div>
