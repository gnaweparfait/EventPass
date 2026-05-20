@php
    $user = auth()->user();
    $layout = $user->isOrganizer() ? 'app-layout' : 'account-layout';
@endphp

<x-dynamic-component :component="$layout" page-title="Mon profil">
    <div class="mx-auto max-w-4xl">
        {{-- En-tête profil --}}
        <div class="ep-profile-hero mb-8">
            <div class="relative z-10 flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between">
                <div class="flex items-center gap-4">
                    @if ($user->avatarUrl())
                        <img src="{{ $user->avatarUrl() }}" alt="{{ $user->name }}" class="h-20 w-20 shrink-0 rounded-2xl object-cover shadow-ep-lg ring-4 ring-white">
                    @else
                        <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-600 text-2xl font-bold text-white shadow-ep-lg ring-4 ring-white">
                            {{ $user->initials() }}
                        </div>
                    @endif
                    <div class="min-w-0 pb-1">
                        <h1 class="truncate text-2xl font-bold text-slate-900 sm:text-3xl">{{ $user->name }}</h1>
                        <p class="truncate text-slate-600">{{ $user->email }}</p>
                        @if ($user->phone)
                            <p class="mt-0.5 flex items-center gap-1 text-sm text-slate-500">
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                {{ $user->phone }}
                            </p>
                        @endif
                        <span class="mt-2 inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-semibold {{ $user->isOrganizer() ? 'bg-indigo-100 text-indigo-800' : 'bg-emerald-100 text-emerald-800' }}">
                            @if ($user->isOrganizer())
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Organisateur
                            @else
                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                                Participant
                            @endif
                        </span>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2 sm:pb-1">
                    <a href="{{ url('/') }}" class="ep-btn-secondary !py-2.5 !px-4 text-sm">Découvrir les événements</a>
                    @if ($user->isOrganizer())
                        <a href="{{ route('dashboard') }}" class="ep-btn-primary !py-2.5 !px-4 text-sm">Tableau de bord</a>
                    @endif
                </div>
            </div>
        </div>

        @if ($user->isParticipant())
            <div class="ep-alert-info mb-8">
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white/80 text-indigo-600 shadow-sm">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
                <div>
                    <p class="font-semibold">Espace participant</p>
                    <p class="mt-1 text-indigo-800/90">
                        Parcourez les événements et achetez vos billets en ligne.
                        Pour créer et gérer des événements, inscrivez-vous avec le rôle <strong>Organisateur</strong>
                        ou demandez le changement de rôle au support.
                    </p>
                </div>
            </div>
        @endif

        <div class="space-y-6">
            <div class="ep-panel overflow-hidden">
                <div class="border-b border-slate-100 bg-slate-50/80 px-6 py-4 sm:px-8">
                    <h2 class="ep-section-title">Informations du profil</h2>
                    <p class="ep-section-desc">Photo, téléphone, nom et adresse e-mail.</p>
                </div>
                <div class="p-6 sm:p-8">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="ep-panel overflow-hidden">
                <div class="border-b border-slate-100 bg-slate-50/80 px-6 py-4 sm:px-8">
                    <h2 class="ep-section-title">Mot de passe</h2>
                    <p class="ep-section-desc">Utilisez un mot de passe long et unique pour sécuriser votre compte.</p>
                </div>
                <div class="p-6 sm:p-8">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="ep-panel overflow-hidden border-red-100">
                <div class="border-b border-red-100 bg-red-50/50 px-6 py-4 sm:px-8">
                    <h2 class="ep-section-title text-red-900">Zone de danger</h2>
                    <p class="ep-section-desc text-red-700/80">La suppression du compte est définitive et irréversible.</p>
                </div>
                <div class="p-6 sm:p-8">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}" class="mt-8 sm:hidden">
            @csrf
            <button type="submit" class="ep-btn-ghost w-full">Se déconnecter</button>
        </form>
    </div>
</x-dynamic-component>
