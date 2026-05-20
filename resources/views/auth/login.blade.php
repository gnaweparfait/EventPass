<x-guest-layout title="Bon retour !" subtitle="Connectez-vous à votre espace EventPass.">
    <x-auth-session-status class="mb-4 rounded-xl bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <x-auth-input label="Adresse e-mail" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
        <x-auth-input label="Mot de passe" name="password" type="password" required autocomplete="current-password" />

        <div class="flex flex-wrap items-center justify-between gap-3">
            <label for="remember_me" class="inline-flex cursor-pointer items-center gap-2">
                <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                <span class="text-sm text-slate-600">Se souvenir de moi</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">Mot de passe oublié ?</a>
            @endif
        </div>

        <button type="submit" class="ep-btn-primary w-full !py-3.5">
            Se connecter
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </button>
    </form>

    <p class="mt-6 hidden text-center text-sm text-slate-600 sm:block">
        Pas encore de compte ?
        <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-700">Créer un compte</a>
    </p>
</x-guest-layout>
