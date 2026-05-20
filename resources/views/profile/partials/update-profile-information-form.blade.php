<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('patch')

    <x-avatar-upload
        name="avatar"
        :current-url="$user->avatarUrl()"
        :initials="$user->initials()"
        :show-remove="(bool) $user->avatar_path"
    />

    <div class="grid gap-5 sm:grid-cols-2">
        <div class="sm:col-span-2">
            <label for="name" class="ep-label">Nom complet</label>
            <input id="name" name="name" type="text" class="ep-input" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="phone" class="ep-label">Numéro de téléphone</label>
            <input id="phone" name="phone" type="tel" class="ep-input" value="{{ old('phone', $user->phone) }}" required autocomplete="tel" placeholder="+221 77 000 00 00">
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <label for="email" class="ep-label">Adresse e-mail</label>
            <input id="email" name="email" type="email" class="ep-input" value="{{ old('email', $user->email) }}" required autocomplete="username">
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>
    </div>

    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <div class="rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-900">
            <p>Votre adresse e-mail n'est pas vérifiée.</p>
            <button form="send-verification" type="submit" class="mt-2 font-semibold text-indigo-600 hover:text-indigo-700">
                Renvoyer l'e-mail de vérification →
            </button>
            @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-emerald-700">Un nouveau lien a été envoyé.</p>
            @endif
        </div>
    @endif

    <div class="flex flex-wrap items-center gap-3 border-t border-slate-100 pt-5">
        <button type="submit" class="ep-btn-primary">Enregistrer</button>
        @if (session('status') === 'profile-updated')
            <span x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                  class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-50 px-3 py-1.5 text-sm font-medium text-emerald-700">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Enregistré
            </span>
        @endif
    </div>
</form>
