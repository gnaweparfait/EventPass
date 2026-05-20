<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'EventPass' }} — Billetterie en ligne</title>
    @include('layouts.partials.head-assets')
</head>
<body class="min-h-screen bg-slate-100 font-sans text-slate-900 antialiased">
    <div class="min-h-screen lg:grid lg:grid-cols-2">
        {{-- Panneau branding (desktop) --}}
        <div class="ep-hero relative hidden flex-col justify-between overflow-hidden p-10 xl:p-14 lg:flex">
            <div class="absolute -left-24 top-16 h-80 w-80 rounded-full bg-indigo-400/25 blur-3xl"></div>
            <div class="absolute -right-16 bottom-10 h-96 w-96 rounded-full bg-violet-400/20 blur-3xl"></div>

            <div class="relative">
                <x-eventpass-logo size="lg" class="[&_span:last-child]:text-white [&_span:last-child_span]:!text-indigo-300" />
            </div>

            <div class="relative max-w-md">
                <h2 class="text-3xl font-extrabold leading-tight tracking-tight text-white xl:text-4xl">
                    La billetterie qui fait grandir vos événements
                </h2>
                <p class="mt-4 text-base leading-relaxed text-indigo-100">
                    Créez, vendez et contrôlez l'accès avec des QR codes. Paiements locaux bientôt disponibles.
                </p>
                <ul class="mt-8 space-y-3">
                    @foreach (['Billetterie 100% en ligne', 'QR Code par billet', 'Dashboard organisateur'] as $item)
                        <li class="flex items-center gap-3 text-sm text-indigo-50">
                            <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-white/15">
                                <svg class="h-3.5 w-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            {{ $item }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <p class="relative text-xs text-indigo-200/70">© {{ date('Y') }} EventPass</p>
        </div>

        {{-- Mobile header gradient --}}
        <div class="ep-hero relative px-6 py-8 lg:hidden">
            <x-eventpass-logo size="md" class="[&_span:last-child]:text-white [&_span:last-child_span]:!text-indigo-300" />
            <p class="mt-3 max-w-xs text-sm text-indigo-100">Billetterie professionnelle pour l'Afrique</p>
        </div>

        {{-- Formulaire --}}
        <div class="flex flex-col bg-slate-50 lg:min-h-screen">
            <header class="hidden items-center justify-end px-8 py-6 lg:flex">
                @if (Route::has('login') && ! request()->routeIs('login'))
                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-indigo-600">Connexion</a>
                @elseif (Route::has('register') && ! request()->routeIs('register'))
                    <a href="{{ route('register') }}" class="ep-btn-primary !py-2 !px-4">S'inscrire</a>
                @endif
            </header>

            <main class="flex flex-1 flex-col justify-center px-5 py-8 sm:px-10 lg:px-16 xl:px-20">
                <div class="mx-auto w-full max-w-[420px]">
                    @if ($title)
                        <div class="mb-6 text-center lg:text-left">
                            <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">{{ $title }}</h1>
                            @if ($subtitle)
                                <p class="mt-2 text-slate-600">{{ $subtitle }}</p>
                            @endif
                        </div>
                    @endif

                    <div class="ep-card p-6 sm:p-8">
                        {{ $slot }}
                    </div>

                    <p class="mt-6 text-center text-xs text-slate-500 lg:hidden">
                        @if (request()->routeIs('login'))
                            <a href="{{ route('register') }}" class="font-medium text-indigo-600">Créer un compte</a>
                        @else
                            <a href="{{ route('login') }}" class="font-medium text-indigo-600">Se connecter</a>
                        @endif
                    </p>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
