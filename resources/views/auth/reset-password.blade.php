<x-guest-layout title="Nouveau mot de passe" subtitle="Choisissez un mot de passe sécurisé.">
    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <x-auth-input label="Adresse e-mail" name="email" type="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" />
        <x-auth-input label="Nouveau mot de passe" name="password" type="password" required autocomplete="new-password" />
        <x-auth-input label="Confirmer le mot de passe" name="password_confirmation" type="password" required autocomplete="new-password" />
        <button type="submit" class="ep-btn-primary w-full">Réinitialiser</button>
    </form>
</x-guest-layout>
