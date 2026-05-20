<x-app-layout page-title="Créer un événement">
    <div class="mb-6">
        <a href="{{ route('events.index') }}" class="inline-flex items-center gap-1 text-sm font-semibold text-indigo-600 transition hover:text-indigo-700">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Retour aux événements
        </a>
    </div>

    <div class="ep-page-header mb-8">
        <p class="text-sm font-semibold text-indigo-600">Nouveau</p>
        <h2>Créer un événement</h2>
        <p>Renseignez les informations de votre événement.</p>
    </div>

    <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data" class="ep-form-section max-w-4xl">
        @csrf
        @include('events._form')

        <div class="mt-8 flex flex-col-reverse gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:justify-end">
            <a href="{{ route('events.index') }}" class="ep-btn-ghost text-center">Annuler</a>
            <button type="submit" class="ep-btn-primary">Créer l'événement</button>
        </div>
    </form>
</x-app-layout>
