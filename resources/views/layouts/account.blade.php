<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle ?? 'Mon compte' }} — EventPass</title>
    @include('layouts.partials.head-assets')
</head>
<body class="ep-app-bg min-h-screen font-sans text-slate-900 antialiased">
    <header class="ep-topbar">
        <div class="mx-auto flex h-[4.25rem] max-w-6xl items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
            <x-eventpass-logo size="sm" />
            <nav class="flex items-center gap-1 sm:gap-4">
                <a href="{{ url('/') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-indigo-600">
                    Événements
                </a>
                <a href="{{ route('profile.edit') }}" class="rounded-lg bg-indigo-50 px-3 py-2 text-sm font-semibold text-indigo-700">
                    Mon profil
                </a>
                <form method="POST" action="{{ route('logout') }}" class="hidden sm:block">
                    @csrf
                    <button type="submit" class="rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-red-600">
                        Déconnexion
                    </button>
                </form>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 sm:py-10 lg:px-8">
        @include('layouts.partials.flash')
        {{ $slot }}
    </main>
</body>
</html>
