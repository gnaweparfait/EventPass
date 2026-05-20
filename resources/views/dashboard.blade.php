<x-app-layout page-title="Tableau de bord">
    <div class="ep-page-header mb-8">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-indigo-600">Bienvenue</p>
                <h2>Bonjour, {{ Auth::user()->name }} 👋</h2>
                <p>Gérez vos événements et suivez vos performances en temps réel.</p>
            </div>
            <a href="{{ route('events.create') }}" class="ep-btn-primary shrink-0">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Nouvel événement
            </a>
        </div>
    </div>

    <div class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="ep-stat-card">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-500">Total événements</p>
                    <p class="ep-stat-value">{{ $stats['total_events'] }}</p>
                </div>
                <span class="ep-icon-box-indigo">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </span>
            </div>
        </div>

        <div class="ep-stat-card">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-500">Publiés</p>
                    <p class="ep-stat-value">{{ $stats['published_events'] }}</p>
                    <p class="mt-1 text-xs font-medium text-slate-400">{{ $stats['draft_events'] }} brouillon(s)</p>
                </div>
                <span class="ep-icon-box-emerald">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
            </div>
        </div>

        <div class="ep-stat-card">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-semibold text-slate-500">Commandes payées</p>
                    <p class="ep-stat-value">{{ $stats['paid_orders'] }}<span class="text-lg font-semibold text-slate-400"> / {{ $stats['total_orders'] }}</span></p>
                </div>
                <span class="ep-icon-box-amber">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </span>
            </div>
        </div>

        <div class="ep-stat-card bg-gradient-to-br from-indigo-600 to-violet-700 !border-0 text-white shadow-ep-lg">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-semibold text-indigo-100">Revenus totaux</p>
                    <p class="mt-3 text-2xl font-extrabold tracking-tight sm:text-3xl">{{ number_format($stats['revenue'], 0, ',', ' ') }} <span class="text-base font-semibold text-indigo-200">XOF</span></p>
                </div>
                <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/15 text-white">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
            </div>
        </div>
    </div>

    <div class="ep-panel">
        <div class="ep-panel-header">
            <h3 class="ep-panel-title">Événements récents</h3>
            <a href="{{ route('events.index') }}" class="text-sm font-semibold text-indigo-600 transition hover:text-indigo-700">Voir tout →</a>
        </div>

        <div class="overflow-x-auto">
            <table class="ep-table min-w-full">
                <thead>
                    <tr>
                        <th>Événement</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Billets</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentEvents as $event)
                        <tr>
                            <td>
                                <p class="font-semibold text-slate-900">{{ $event->title }}</p>
                                <p class="text-slate-500">{{ $event->city ?? '—' }}</p>
                            </td>
                            <td class="whitespace-nowrap text-slate-600">{{ $event->starts_at->format('d/m/Y H:i') }}</td>
                            <td><x-ep.status-badge :status="$event->status" /></td>
                            <td class="font-medium text-slate-700">{{ $event->tickets_count }}</td>
                            <td class="text-right">
                                <a href="{{ route('events.show', $event) }}" class="inline-flex items-center gap-1 rounded-lg px-3 py-1.5 text-sm font-semibold text-indigo-600 transition hover:bg-indigo-50">Détails →</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="!py-0">
                                <div class="ep-empty m-6">
                                    <span class="ep-icon-box-indigo !h-14 !w-14">
                                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </span>
                                    <p class="mt-4 font-semibold text-slate-900">Aucun événement pour le moment</p>
                                    <p class="mt-1 text-sm text-slate-500">Créez votre premier événement et commencez à vendre des billets.</p>
                                    <a href="{{ route('events.create') }}" class="ep-btn-primary mt-6">Créer un événement</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
