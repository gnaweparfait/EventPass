<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EventPass — Billetterie en ligne</title>
    <meta name="description" content="Créez, vendez et gérez vos billets. EventPass, la billetterie type Eventbrite pour l'Afrique.">
    @include('layouts.partials.head-assets')
</head>
<body class="font-sans text-slate-900 antialiased">

    {{-- Navbar --}}
    <header class="fixed inset-x-0 top-0 z-50 border-b border-white/10 bg-slate-900/90 backdrop-blur-md">
        <nav class="mx-auto flex h-16 max-w-7xl items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
            <x-eventpass-logo size="sm" class="shrink-0 [&_span:last-child]:text-white [&_span:last-child_span]:!text-indigo-300" />

            <div class="hidden items-center gap-8 md:flex">
                <a href="#evenements" class="text-sm font-medium text-slate-300 transition hover:text-white">Événements</a>
                <a href="#fonctionnalites" class="text-sm font-medium text-slate-300 transition hover:text-white">Fonctionnalités</a>
                <a href="#organisateurs" class="text-sm font-medium text-slate-300 transition hover:text-white">Organisateurs</a>
            </div>

            <div class="flex shrink-0 items-center gap-2 sm:gap-3">
                @auth
                    <a href="{{ auth()->user()->isOrganizer() ? route('dashboard') : route('profile.edit') }}" class="ep-btn-white !px-4 !py-2 text-sm">
                        Mon espace
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hidden rounded-lg px-3 py-2 text-sm font-medium text-slate-300 transition hover:bg-white/10 hover:text-white sm:inline">Connexion</a>
                    <a href="{{ route('register') }}" class="rounded-lg bg-indigo-500 px-4 py-2 text-sm font-semibold text-white shadow-ep transition hover:bg-indigo-400">
                        S'inscrire
                    </a>
                @endauth
            </div>
        </nav>
    </header>

    {{-- Hero --}}
    <section class="ep-hero relative overflow-hidden pt-16">
        <div class="absolute -left-32 top-0 h-[28rem] w-[28rem] rounded-full bg-indigo-500/30 blur-3xl"></div>
        <div class="absolute -right-20 bottom-0 h-80 w-80 rounded-full bg-violet-500/25 blur-3xl"></div>

        <div class="relative mx-auto max-w-7xl px-4 pb-24 pt-16 sm:px-6 sm:pb-32 sm:pt-24 lg:px-8 lg:pt-28">
            <div class="mx-auto max-w-4xl text-center">
                <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-1.5 text-sm font-medium text-indigo-100 backdrop-blur-sm">
                    <span class="relative flex h-2 w-2">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-400"></span>
                    </span>
                    Billetterie nouvelle génération
                </div>

                <h1 class="text-4xl font-extrabold leading-[1.1] tracking-tight text-white sm:text-5xl lg:text-6xl">
                    Vos événements.<br>
                    <span class="ep-gradient-text">Vos billets. En un clic.</span>
                </h1>

                <p class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-indigo-100 sm:text-xl">
                    EventPass simplifie la création d'événements, la vente de billets et le contrôle d'accès par QR — pensé pour le Sénégal et l'Afrique.
                </p>

                <div class="mt-10 flex flex-col items-stretch justify-center gap-4 sm:flex-row sm:items-center">
                    <a href="{{ route('register') }}" class="ep-btn-white w-full sm:w-auto">
                        Commencer gratuitement
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="#evenements" class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-white/25 bg-white/10 px-6 py-3 text-sm font-semibold text-white backdrop-blur-sm transition hover:bg-white/20 sm:w-auto">
                        Voir les événements
                    </a>
                </div>

                <div class="mx-auto mt-14 grid max-w-lg grid-cols-3 gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur-sm sm:gap-6 sm:p-6">
                    <div class="text-center">
                        <p class="text-2xl font-bold text-white sm:text-3xl">100%</p>
                        <p class="mt-1 text-xs text-indigo-200 sm:text-sm">En ligne</p>
                    </div>
                    <div class="border-x border-white/10 text-center">
                        <p class="text-2xl font-bold text-white sm:text-3xl">QR</p>
                        <p class="mt-1 text-xs text-indigo-200 sm:text-sm">Sécurisés</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-white sm:text-3xl">XOF</p>
                        <p class="mt-1 text-xs text-indigo-200 sm:text-sm">Paiements locaux</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Transition douce (pas de SVG noir) --}}
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-b from-transparent to-slate-50"></div>
    </section>

    {{-- Événements --}}
    <section id="evenements" class="bg-slate-50 py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                <div>
                    <span class="text-sm font-semibold uppercase tracking-wider text-indigo-600">À ne pas manquer</span>
                    <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Événements à venir</h2>
                    <p class="mt-2 text-lg text-slate-600">Réservez votre place dès maintenant</p>
                </div>
                @auth
                    @if (auth()->user()->isOrganizer())
                        <a href="{{ route('events.create') }}" class="ep-btn-secondary shrink-0">+ Créer un événement</a>
                    @endif
                @endauth
            </div>

            @if ($featuredEvents->isNotEmpty())
                <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($featuredEvents as $event)
                        <article class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-ep-lg">
                            @if ($event->image_path)
                                <div class="aspect-[5/3] overflow-hidden bg-slate-100">
                                    <img src="{{ asset('storage/'.$event->image_path) }}" alt="{{ $event->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                                </div>
                            @else
                                <div class="flex aspect-[5/3] items-center justify-center bg-gradient-to-br from-indigo-500 to-violet-600">
                                    <span class="text-5xl font-black text-white/25">{{ strtoupper(substr($event->title, 0, 1)) }}</span>
                                </div>
                            @endif
                            <div class="p-5">
                                <div class="flex items-start justify-between gap-2">
                                    <h3 class="font-bold text-slate-900 line-clamp-2 group-hover:text-indigo-600">{{ $event->title }}</h3>
                                    @if ($event->is_featured)
                                        <span class="shrink-0 rounded-full bg-amber-100 px-2.5 py-0.5 text-xs font-semibold text-amber-800">★</span>
                                    @endif
                                </div>
                                <p class="mt-2 text-sm text-slate-500">{{ $event->starts_at->format('d M Y · H:i') }}</p>
                                @if ($event->city)
                                    <p class="text-sm text-slate-500">{{ $event->city }}</p>
                                @endif
                                <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-4">
                                    <span class="text-xs font-medium text-slate-400">{{ $event->tickets_count }} billet(s)</span>
                                    <span class="text-sm font-semibold text-indigo-600">Détails →</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="mt-12 overflow-hidden rounded-3xl border border-slate-200 bg-white text-center shadow-sm">
                    <div class="bg-gradient-to-r from-indigo-50 to-violet-50 px-6 py-12 sm:py-16">
                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-2xl bg-white shadow-ep">
                            <svg class="h-10 w-10 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-slate-900">Aucun événement publié</h3>
                        <p class="mx-auto mt-2 max-w-md text-slate-600">Soyez le premier à lancer un événement sur EventPass et vendez vos billets en ligne.</p>
                        <a href="{{ route('register') }}" class="ep-btn-primary mt-8">Devenir organisateur</a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- Fonctionnalités --}}
    <section id="fonctionnalites" class="bg-white py-20 sm:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <span class="text-sm font-semibold uppercase tracking-wider text-indigo-600">Fonctionnalités</span>
                <h2 class="mt-2 text-3xl font-bold text-slate-900 sm:text-4xl">Tout ce dont vous avez besoin</h2>
                <p class="mt-4 text-lg text-slate-600">Une plateforme complète pour organisateurs et participants</p>
            </div>

            <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ([
                    ['t' => 'Gestion d\'événements', 'd' => 'Créez et publiez depuis un dashboard intuitif.', 'p' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                    ['t' => 'Billetterie flexible', 'd' => 'Plusieurs tarifs, quantités et devises (XOF).', 'p' => 'M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z'],
                    ['t' => 'QR Code unique', 'd' => 'Contrôle d\'accès rapide à l\'entrée.', 'p' => 'M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z'],
                    ['t' => 'Paiements locaux', 'd' => 'Wave & PayDunya — bientôt disponible.', 'p' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['t' => 'Stats en direct', 'd' => 'Ventes, revenus et commandes en temps réel.', 'p' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                    ['t' => '100% responsive', 'd' => 'Parfait sur mobile, tablette et desktop.', 'p' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z'],
                ] as $f)
                    <div class="rounded-2xl border border-slate-100 bg-slate-50/80 p-6 transition hover:border-indigo-100 hover:bg-white hover:shadow-ep">
                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 text-white">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $f['p'] }}"/></svg>
                        </div>
                        <h3 class="mt-4 font-bold text-slate-900">{{ $f['t'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $f['d'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section id="organisateurs" class="ep-hero relative overflow-hidden py-20 sm:py-28">
        <div class="absolute -right-16 top-1/2 h-64 w-64 -translate-y-1/2 rounded-full bg-white/10 blur-3xl"></div>
        <div class="relative mx-auto max-w-3xl px-4 text-center sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-white sm:text-4xl">Vous organisez des événements ?</h2>
            <p class="mt-4 text-lg text-indigo-100">Lancez votre premier événement en moins de 5 minutes.</p>
            <div class="mt-10 flex flex-col gap-4 sm:flex-row sm:justify-center">
                <a href="{{ route('register') }}" class="ep-btn-white">Créer un compte organisateur</a>
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-xl border border-white/30 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
                    J'ai déjà un compte
                </a>
            </div>
        </div>
    </section>

    <footer class="border-t border-slate-200 bg-white py-10">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-6 px-4 sm:flex-row sm:px-6 lg:px-8">
            <x-eventpass-logo size="sm" />
            <p class="text-sm text-slate-500">© {{ date('Y') }} EventPass</p>
            <div class="flex gap-6 text-sm font-medium text-slate-600">
                <a href="{{ route('login') }}" class="hover:text-indigo-600">Connexion</a>
                <a href="{{ route('register') }}" class="hover:text-indigo-600">Inscription</a>
            </div>
        </div>
    </footer>
</body>
</html>
