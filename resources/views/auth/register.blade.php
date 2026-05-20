<x-guest-layout title="Créer un compte" subtitle="Rejoignez EventPass — gratuit pour commencer.">
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-5">
        @csrf

        @php $registerInitials = strtoupper(substr(trim(old('name', '')), 0, 1)) ?: '?'; @endphp
        <x-avatar-upload name="avatar" :initials="$registerInitials" />

        <x-auth-input label="Nom complet" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name" />
        <x-auth-input label="Adresse e-mail" name="email" type="email" value="{{ old('email') }}" required autocomplete="username" />
        <x-auth-input label="Numéro de téléphone" name="phone" type="tel" value="{{ old('phone') }}" required autocomplete="tel" placeholder="+221 77 000 00 00" />
        <x-auth-input label="Mot de passe" name="password" type="password" required autocomplete="new-password" />

        <div>
            <span class="block text-sm font-semibold text-slate-700">Je suis</span>
            <div class="mt-2.5 grid grid-cols-1 gap-3 sm:grid-cols-2">
                <label class="ep-role-card block">
                    <input type="radio" name="role" value="participant" class="sr-only" @checked(old('role', 'participant') === 'participant')>
                    <svg class="mx-auto h-7 w-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                    <span class="mt-2 block text-sm font-bold text-slate-900">Participant</span>
                    <span class="mt-0.5 block text-xs text-slate-500">Acheter des billets</span>
                </label>
                <label class="ep-role-card block">
                    <input type="radio" name="role" value="organisateur" class="sr-only" @checked(old('role') === 'organisateur')>
                    <svg class="mx-auto h-7 w-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="mt-2 block text-sm font-bold text-slate-900">Organisateur</span>
                    <span class="mt-0.5 block text-xs text-slate-500">Créer des événements</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <x-auth-input label="Confirmer le mot de passe" name="password_confirmation" type="password" required autocomplete="new-password" />

        <button type="submit" class="ep-btn-primary w-full !py-3.5">
            Créer mon compte
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </button>
    </form>

    <p class="mt-6 hidden text-center text-sm text-slate-600 sm:block">
        Déjà inscrit ?
        <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-700">Se connecter</a>
    </p>
</x-guest-layout>
