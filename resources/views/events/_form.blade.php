@php
    use App\Enums\EventStatus;
    $event = $event ?? null;
@endphp

<div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
    <div class="lg:col-span-2">
        <label for="title" class="ep-label">Titre *</label>
        <input type="text" name="title" id="title" value="{{ old('title', $event?->title) }}" required class="ep-input">
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>

    <div class="lg:col-span-2">
        <label for="description" class="ep-label">Description</label>
        <textarea name="description" id="description" rows="5" class="ep-input">{{ old('description', $event?->description) }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div>
        <label for="location" class="ep-label">Lieu</label>
        <input type="text" name="location" id="location" value="{{ old('location', $event?->location) }}" class="ep-input">
        <x-input-error :messages="$errors->get('location')" class="mt-2" />
    </div>

    <div>
        <label for="city" class="ep-label">Ville</label>
        <input type="text" name="city" id="city" value="{{ old('city', $event?->city) }}" class="ep-input">
        <x-input-error :messages="$errors->get('city')" class="mt-2" />
    </div>

    <div>
        <label for="country" class="ep-label">Pays (code ISO)</label>
        <input type="text" name="country" id="country" value="{{ old('country', $event?->country ?? 'SN') }}" maxlength="2" class="ep-input">
        <x-input-error :messages="$errors->get('country')" class="mt-2" />
    </div>

    <div>
        <label for="capacity" class="ep-label">Capacité</label>
        <input type="number" name="capacity" id="capacity" min="1" value="{{ old('capacity', $event?->capacity) }}" class="ep-input">
        <x-input-error :messages="$errors->get('capacity')" class="mt-2" />
    </div>

    <div>
        <label for="starts_at" class="ep-label">Début *</label>
        <input type="datetime-local" name="starts_at" id="starts_at" value="{{ old('starts_at', $event?->starts_at?->format('Y-m-d\TH:i')) }}" required class="ep-input">
        <x-input-error :messages="$errors->get('starts_at')" class="mt-2" />
    </div>

    <div>
        <label for="ends_at" class="ep-label">Fin *</label>
        <input type="datetime-local" name="ends_at" id="ends_at" value="{{ old('ends_at', $event?->ends_at?->format('Y-m-d\TH:i')) }}" required class="ep-input">
        <x-input-error :messages="$errors->get('ends_at')" class="mt-2" />
    </div>

    <div>
        <label for="status" class="ep-label">Statut *</label>
        <select name="status" id="status" required class="ep-select">
            @foreach (EventStatus::cases() as $status)
                <option value="{{ $status->value }}" @selected(old('status', $event?->status?->value ?? EventStatus::Draft->value) === $status->value)>
                    {{ $status->label() }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('status')" class="mt-2" />
    </div>

    <div>
        <label for="image" class="ep-label">Image de couverture</label>
        <input type="file" name="image" id="image" accept="image/*"
               class="mt-1.5 block w-full cursor-pointer text-sm text-slate-600 file:mr-4 file:cursor-pointer file:rounded-xl file:border-0 file:bg-indigo-50 file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100">
        <x-input-error :messages="$errors->get('image')" class="mt-2" />
        @if ($event?->image_path)
            <img src="{{ asset('storage/'.$event->image_path) }}" alt="{{ $event->title }}" class="mt-3 h-36 w-full rounded-xl object-cover ring-1 ring-slate-200">
        @endif
    </div>

    <div class="flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50/80 px-4 py-3 lg:col-span-2">
        <input type="checkbox" name="is_featured" id="is_featured" value="1"
               @checked(old('is_featured', $event?->is_featured ?? false))
               class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
        <label for="is_featured" class="text-sm font-semibold text-slate-700">Mettre en avant sur la page d'accueil</label>
    </div>
</div>
