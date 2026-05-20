<x-guest-layout title="Mot de passe oublié" subtitle="Nous vous enverrons un lien de réinitialisation.">
    <p class="mb-5 text-sm text-slate-600">Indiquez votre e-mail associé à votre compte EventPass.</p>

    <x-auth-session-status class="mb-4 rounded-xl bg-emerald-50 px-4 py-3 text-sm text-emerald-800" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf
        <x-auth-input label="Adresse e-mail" name="email" type="email" value="{{ old('email') }}" required autofocus />
        <button type="submit" class="ep-btn-primary w-full">Envoyer le lien</button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-600">
        <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-700">← Retour à la connexion</a>
    </p>
</x-guest-layout>
