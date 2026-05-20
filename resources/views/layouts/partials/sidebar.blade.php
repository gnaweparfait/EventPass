<aside class="ep-sidebar fixed inset-y-0 left-0 z-40 flex w-[17rem] -translate-x-full flex-col transition-transform duration-300 lg:translate-x-0"
       :class="{ 'translate-x-0': sidebarOpen }">
    <div class="flex h-16 shrink-0 items-center gap-3 border-b border-white/10 px-5">
        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-400 to-violet-500 text-base font-bold text-white shadow-lg shadow-indigo-900/50">E</span>
        <div class="min-w-0">
            <p class="truncate text-sm font-bold text-white">EventPass</p>
            <p class="text-xs font-medium text-indigo-300/80">Espace organisateur</p>
        </div>
    </div>

    <nav class="flex-1 space-y-1 overflow-y-auto p-4">
        <p class="mb-2 px-3 text-[10px] font-bold uppercase tracking-widest text-indigo-400/70">Menu</p>

        <a href="{{ route('dashboard') }}"
           class="ep-sidebar-link {{ request()->routeIs('dashboard') ? 'ep-sidebar-link-active' : '' }}">
            <svg class="h-5 w-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Tableau de bord
        </a>

        <a href="{{ route('events.index') }}"
           class="ep-sidebar-link {{ request()->routeIs('events.index', 'events.show', 'events.edit') ? 'ep-sidebar-link-active' : '' }}">
            <svg class="h-5 w-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Mes événements
        </a>

        <a href="{{ route('events.create') }}"
           class="ep-sidebar-link {{ request()->routeIs('events.create') ? 'ep-sidebar-link-active' : '' }}">
            <svg class="h-5 w-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Nouvel événement
        </a>

        <div class="my-4 border-t border-white/10"></div>

        <a href="{{ route('profile.edit') }}" class="ep-sidebar-link">
            <svg class="h-5 w-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Mon profil
        </a>
    </nav>

    <div class="shrink-0 border-t border-white/10 p-4">
        <div class="flex items-center gap-3 rounded-xl bg-white/5 p-3 ring-1 ring-white/10">
            @if (Auth::user()->avatarUrl())
                <img src="{{ Auth::user()->avatarUrl() }}" alt="" class="h-10 w-10 shrink-0 rounded-full object-cover ring-2 ring-indigo-400/50">
            @else
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-indigo-400 to-violet-500 text-sm font-bold text-white">
                    {{ Auth::user()->initials() }}
                </div>
            @endif
            <div class="min-w-0 flex-1">
                <p class="truncate text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                <p class="truncate text-xs text-indigo-200/70">{{ Auth::user()->email }}</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="mt-3">
            @csrf
            <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-lg py-2 text-xs font-medium text-indigo-200/80 transition hover:bg-white/10 hover:text-white">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Déconnexion
            </button>
        </form>
    </div>
</aside>

<div x-show="sidebarOpen" x-cloak x-transition.opacity @click="sidebarOpen = false"
     class="fixed inset-0 z-30 bg-slate-900/60 backdrop-blur-sm lg:hidden"></div>
