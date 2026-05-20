<x-app-layout :page-title="'Modifier — '.$event->title">
    <div class="mb-6">
        <a href="{{ route('events.show', $event) }}" class="inline-flex items-center gap-1 text-sm font-semibold text-indigo-600 transition hover:text-indigo-700">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Retour à l'événement
        </a>
    </div>

    <div class="ep-page-header mb-8">
        <p class="text-sm font-semibold text-indigo-600">Édition</p>
        <h2>Modifier l'événement</h2>
        <p class="truncate">{{ $event->title }}</p>
    </div>

    <form method="POST" action="{{ route('events.update', $event) }}" enctype="multipart/form-data" class="ep-form-section max-w-4xl">
        @csrf
        @method('PUT')
        @include('events._form', ['event' => $event])

        <div class="mt-8 flex flex-col-reverse gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:justify-end">
            <a href="{{ route('events.show', $event) }}" class="ep-btn-ghost text-center">Annuler</a>
            <button type="submit" class="ep-btn-primary">Enregistrer les modifications</button>
        </div>
    </form>
</x-app-layout>
