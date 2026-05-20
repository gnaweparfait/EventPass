<x-app-layout :page-title="$event->title">
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <a href="{{ route('events.index') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-indigo-600 hover:text-indigo-700">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Mes événements
            </a>
            <h2 class="mt-3 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">{{ $event->title }}</h2>
            <p class="mt-1 font-mono text-xs text-slate-400">/{{ $event->slug }}</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('events.edit', $event) }}" class="ep-btn-ghost">Modifier</a>
            <form method="POST" action="{{ route('events.destroy', $event) }}" onsubmit="return confirm('Supprimer cet événement ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="ep-btn-danger">Supprimer</button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="space-y-6 lg:col-span-2">
            @if ($event->image_path)
                <div class="overflow-hidden rounded-2xl ring-1 ring-slate-200">
                    <img src="{{ asset('storage/'.$event->image_path) }}" alt="{{ $event->title }}" class="max-h-80 w-full object-cover">
                </div>
            @else
                <div class="flex aspect-[21/9] items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-600">
                    <span class="text-7xl font-black text-white/20">{{ strtoupper(substr($event->title, 0, 1)) }}</span>
                </div>
            @endif

            <div class="ep-panel p-6 sm:p-8">
                <h3 class="text-lg font-bold text-slate-900">Description</h3>
                <p class="mt-4 whitespace-pre-line leading-relaxed text-slate-600">{{ $event->description ?? 'Aucune description fournie.' }}</p>
            </div>

            <div class="ep-panel">
                <div class="ep-panel-header">
                    <h3 class="ep-panel-title">Types de billets</h3>
                    <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">{{ $event->tickets->count() }} type(s)</span>
                </div>
                @if ($event->tickets->isEmpty())
                    <div class="p-8 text-center text-sm text-slate-500">Aucun billet configuré pour le moment.</div>
                @else
                    <ul class="divide-y divide-slate-100">
                        @foreach ($event->tickets as $ticket)
                            <li class="flex items-center justify-between gap-4 px-6 py-4 transition hover:bg-slate-50/80">
                                <div>
                                    <p class="font-semibold text-slate-900">{{ $ticket->name }}</p>
                                    <p class="mt-0.5 text-sm text-slate-500">{{ $ticket->availableQuantity() }} / {{ $ticket->quantity }} places disponibles</p>
                                </div>
                                <p class="shrink-0 text-lg font-bold text-indigo-600">{{ number_format($ticket->price, 0, ',', ' ') }} <span class="text-sm font-semibold text-slate-500">{{ $ticket->currency }}</span></p>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <div class="space-y-6">
            <div class="ep-panel p-6">
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Statut</p>
                <div class="mt-3"><x-ep.status-badge :status="$event->status" class="!text-sm" /></div>
            </div>

            <div class="ep-panel divide-y divide-slate-100">
                <div class="p-5">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Dates</p>
                    <dl class="mt-3 space-y-2 text-sm">
                        <div class="flex justify-between gap-2">
                            <dt class="text-slate-500">Début</dt>
                            <dd class="font-semibold text-slate-900">{{ $event->starts_at->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div class="flex justify-between gap-2">
                            <dt class="text-slate-500">Fin</dt>
                            <dd class="font-semibold text-slate-900">{{ $event->ends_at->format('d/m/Y H:i') }}</dd>
                        </div>
                    </dl>
                </div>
                <div class="p-5">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Lieu</p>
                    <p class="mt-2 font-semibold text-slate-900">{{ $event->location ?? '—' }}</p>
                    <p class="text-sm text-slate-500">{{ trim(($event->city ?? '').' '.$event->country) ?: '—' }}</p>
                </div>
                <div class="p-5">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Capacité</p>
                    <p class="mt-2 text-2xl font-bold text-slate-900">{{ $event->capacity ?? '∞' }}</p>
                </div>
            </div>

            <div class="ep-panel">
                <div class="ep-panel-header !py-3">
                    <h3 class="text-base font-bold text-slate-900">Commandes</h3>
                </div>
                @if ($event->orders->isEmpty())
                    <p class="p-5 text-center text-sm text-slate-500">Aucune commande.</p>
                @else
                    <ul class="divide-y divide-slate-100 p-2">
                        @foreach ($event->orders->take(5) as $order)
                            <li class="rounded-xl p-3 transition hover:bg-indigo-50/50">
                                <p class="font-mono text-xs font-semibold text-indigo-600">{{ $order->reference }}</p>
                                <p class="mt-1 text-sm text-slate-600">{{ $order->user->name }}</p>
                                <div class="mt-2 flex items-center justify-between">
                                    <span class="text-xs font-medium text-slate-500">{{ $order->status->label() }}</span>
                                    <span class="text-sm font-bold text-slate-900">{{ number_format($order->total, 0, ',', ' ') }} {{ $order->currency }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
