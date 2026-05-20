<header class="ep-topbar">
    <div class="flex h-[4.25rem] items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
        <div class="flex min-w-0 items-center gap-3">
            <button type="button" @click="sidebarOpen = !sidebarOpen"
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-slate-200 text-slate-600 transition hover:bg-slate-50 lg:hidden">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <div class="min-w-0">
                <p class="truncate text-xs font-semibold uppercase tracking-wider text-indigo-600">EventPass</p>
                <h1 class="truncate text-lg font-bold text-slate-900">{{ $pageTitle ?? 'Tableau de bord' }}</h1>
            </div>
        </div>

        <div class="flex shrink-0 items-center gap-2 sm:gap-3">
            <a href="{{ route('events.create') }}" class="ep-btn-primary hidden !py-2.5 !px-4 sm:inline-flex">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span class="hidden md:inline">Créer un événement</span>
                <span class="md:hidden">Créer</span>
            </a>

            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button type="button" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white py-2 pl-2 pr-3 shadow-sm transition hover:border-indigo-200 hover:shadow-ep sm:pl-3">
                        @if (Auth::user()->avatarUrl())
                            <img src="{{ Auth::user()->avatarUrl() }}" alt="" class="h-8 w-8 rounded-lg object-cover">
                        @else
                            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-indigo-500 to-violet-600 text-xs font-bold text-white">
                                {{ Auth::user()->initials() }}
                            </span>
                        @endif
                        <span class="hidden max-w-[8rem] truncate text-sm font-semibold text-slate-700 sm:inline">{{ Auth::user()->name }}</span>
                        <svg class="h-4 w-4 text-slate-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                    </button>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">Mon profil</x-dropdown-link>
                    <x-dropdown-link :href="route('events.index')">Mes événements</x-dropdown-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            Déconnexion
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</header>
