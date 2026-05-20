@php use App\Enums\EventStatus; @endphp

<x-app-layout page-title="Mes événements">
    <div class="ep-page-header mb-8">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-indigo-600">Gestion</p>
                <h2>Mes événements</h2>
                <p>Créez, modifiez et publiez vos événements.</p>
            </div>
            <a href="{{ route('events.create') }}" class="ep-btn-primary shrink-0">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Nouvel événement
            </a>
        </div>
    </div>

    <form method="GET" action="{{ route('events.index') }}" class="ep-panel mb-8 p-4 sm:p-5">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            <div class="relative flex-1">
                <svg class="pointer-events-none absolute left-3.5 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un événement..."
                       class="ep-input !mt-0 !pl-11">
            </div>
            <select name="status" class="ep-select sm:w-48">
                <option value="">Tous les statuts</option>
                @foreach (EventStatus::cases() as $status)
                    <option value="{{ $status->value }}" @selected(request('status') === $status->value)>{{ $status->label() }}</option>
                @endforeach
            </select>
            <button type="submit" class="ep-btn-primary !py-2.5 shrink-0">Filtrer</button>
        </div>
    </form>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($events as $event)
            <article class="ep-event-card">
                @if ($event->image_path)
                    <div class="aspect-[16/10] overflow-hidden bg-slate-100">
                        <img src="{{ asset('storage/'.$event->image_path) }}" alt="{{ $event->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    </div>
                @else
                    <div class="flex aspect-[16/10] items-center justify-center bg-gradient-to-br from-indigo-500 via-indigo-600 to-violet-600">
                        <span class="text-5xl font-black text-white/25">{{ strtoupper(substr($event->title, 0, 1)) }}</span>
                    </div>
                @endif

                <div class="p-5">
                    <div class="mb-3 flex items-start justify-between gap-2">
                        <h3 class="font-bold text-slate-900 line-clamp-2 group-hover:text-indigo-600">{{ $event->title }}</h3>
                        <x-ep.status-badge :status="$event->status" class="shrink-0" />
                    </div>

                    <div class="space-y-1 text-sm text-slate-500">
                        <p class="flex items-center gap-1.5">
                            <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $event->starts_at->format('d M Y · H:i') }}
                        </p>
                        @if ($event->city)
                            <p class="flex items-center gap-1.5">
                                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                                {{ $event->city }}
                            </p>
                        @endif
                    </div>

                    <div class="mt-4 flex gap-3 border-t border-slate-100 pt-4 text-xs font-medium text-slate-500">
                        <span>{{ $event->tickets_count }} billet(s)</span>
                        <span>·</span>
                        <span>{{ $event->orders_count }} commande(s)</span>
                    </div>

                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('events.show', $event) }}" class="ep-btn-ghost flex-1 !py-2">Voir</a>
                        <a href="{{ route('events.edit', $event) }}" class="ep-btn-primary flex-1 !py-2">Modifier</a>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full ep-empty">
                <span class="ep-icon-box-indigo !h-14 !w-14">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </span>
                <p class="mt-4 font-semibold text-slate-900">Aucun événement trouvé</p>
                <p class="mt-1 text-sm text-slate-500">Modifiez vos filtres ou créez un nouvel événement.</p>
                <a href="{{ route('events.create') }}" class="ep-btn-primary mt-6">Créer un événement</a>
            </div>
        @endforelse
    </div>

    @if ($events->hasPages())
        <div class="mt-8 ep-panel px-4 py-3">
            {{ $events->links() }}
        </div>
    @endif
</x-app-layout>
