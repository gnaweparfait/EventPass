<div class="ep-alert-danger mb-6">
    <p>
        Une fois votre compte supprimé, toutes vos données seront définitivement effacées.
        Téléchargez d'abord toute information que vous souhaitez conserver.
    </p>
</div>

<button type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="ep-btn-danger">
    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
    Supprimer mon compte
</button>

<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <div class="p-6 sm:p-8">
        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100 text-red-600">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        </div>

        <h2 class="mt-4 text-center text-lg font-bold text-slate-900 sm:text-left">
            Confirmer la suppression
        </h2>

        <p class="mt-2 text-center text-sm text-slate-600 sm:text-left">
            Cette action est irréversible. Saisissez votre mot de passe pour confirmer.
        </p>

        <form method="post" action="{{ route('profile.destroy') }}" class="mt-6">
            @csrf
            @method('delete')

            <label for="password" class="ep-label">Mot de passe</label>
            <input id="password" name="password" type="password" class="ep-input" placeholder="Votre mot de passe actuel" autocomplete="current-password">
            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />

            <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <button type="button" x-on:click="$dispatch('close')" class="ep-btn-ghost w-full sm:w-auto">
                    Annuler
                </button>
                <button type="submit" class="ep-btn-danger w-full sm:w-auto">
                    Supprimer définitivement
                </button>
            </div>
        </form>
    </div>
</x-modal>
