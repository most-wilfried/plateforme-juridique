<!-- HEADER -->
<header x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm">
    <div class="mx-auto flex max-w-7xl flex-col gap-4 px-6 py-4 md:flex-row md:items-center md:justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ route('accueil') }}" class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-full bg-[#1A2B42] text-white">
                    <span class="text-lg">⚖</span>
                </div>
                <span class="text-xl font-semibold text-[#1A2B42]">JuriConseil</span>
            </a>
        </div>

        <nav class="hidden flex-1 items-center justify-center gap-6 text-sm font-medium text-[#4B5563] md:flex">
            <a href="{{ route('accueil') }}" class="rounded-full bg-[#F3F4F6] px-4 py-2 text-[#1A2B42]">Accueil</a>
            <a href="{{ route('directory.index') }}" class="hover:text-[#1A2B42]">Annuaire</a>
            @auth
                <a href="{{ route('dashboard') }}" class="hover:text-[#1A2B42]">Tableau de bord</a>
            @endauth
        </nav>

        <div class="flex items-center gap-3 justify-end">
            @guest
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-full border border-[#1A2B42] px-5 py-2 text-sm font-semibold text-[#1A2B42] hover:bg-[#F3F4F6]">Connexion</a>
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-[#1A2B42] px-5 py-2 text-sm font-semibold text-white hover:bg-[#15203a]">S'inscrire</a>
            @else
                @php
                    $unreadCount = auth()->user()->receivedMessages()->where('is_read', false)->count();
                    $recentNotifications = auth()->user()->receivedMessages()->where('is_read', false)->latest()->take(5)->get();
                @endphp

                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-[#1A2B42] hover:bg-gray-200 relative">
                        <span class="text-lg">🔔</span>
                        @if($unreadCount)
                            <span class="absolute -end-1 -top-1 inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-red-600 px-1.5 text-xs font-semibold text-white">{{ $unreadCount }}</span>
                        @endif
                    </button>

                    <div x-show="open" x-cloak @click.outside="open = false" class="absolute right-0 z-10 mt-3 w-80 overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-xl">
                        <div class="border-b border-gray-100 px-4 py-4">
                            <p class="text-sm font-semibold text-[#1A2B42]">Notifications</p>
                            <p class="mt-1 text-xs text-[#6B7280]">Derniers messages non lus</p>
                        </div>
                        <div class="max-h-72 overflow-auto">
                            @forelse($recentNotifications as $message)
                                <a href="{{ route('messages.show', $message->sender) }}" class="block border-b border-gray-100 px-4 py-3 text-sm text-[#1A2B42] hover:bg-[#F8FAFC]">
                                    <p class="font-semibold">{{ $message->sender->name }}</p>
                                    <p class="mt-1 text-sm text-[#6B7280]">{{ Illuminate\Support\Str::limit($message->content, 60) }}</p>
                                </a>
                            @empty
                                <p class="px-4 py-3 text-sm text-[#6B7280]">Aucun message non lu.</p>
                            @endforelse
                        </div>
                        <div class="border-t border-gray-100 px-4 py-3 text-center">
                            <a href="{{ route('messages.index') }}" class="text-sm font-semibold text-[#1A2B42] hover:text-[#15203a]">Voir toutes les conversations</a>
                        </div>
                    </div>
                </div>

                <div class="relative" x-data="{ openMenu: false }">
                    <button @click="openMenu = !openMenu" class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-[#1A2B42] text-white hover:bg-[#15203a]">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </button>

                    <div x-show="openMenu" x-cloak @click.outside="openMenu = false" class="absolute right-0 z-10 mt-3 w-72 overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-xl">
                        <div class="border-b border-gray-100 px-4 py-4">
                            <p class="text-sm font-semibold text-[#1A2B42]">{{ auth()->user()->name }}</p>
                            <p class="mt-1 text-xs text-[#6B7280]">{{ auth()->user()->email }}</p>
                            <p class="mt-2 rounded-full bg-[#EFF6FF] px-3 py-1 text-xs font-semibold text-[#1E3A8A]">{{ ucfirst(auth()->user()->role) }}</p>
                        </div>
                        <div class="space-y-1 px-4 py-3">
                            <a href="{{ route('dashboard') }}" class="block rounded-2xl px-4 py-3 text-sm text-[#1A2B42] hover:bg-[#F8FAFC]">Tableau de bord</a>
                            <a href="{{ route('profile.edit') }}" class="block rounded-2xl px-4 py-3 text-sm text-[#1A2B42] hover:bg-[#F8FAFC]">Mon profil</a>
                            <a href="{{ route('messages.index') }}" class="block rounded-2xl px-4 py-3 text-sm text-[#1A2B42] hover:bg-[#F8FAFC]">Mes messages</a>
                        </div>
                        <div class="border-t border-gray-100 px-4 py-3">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full rounded-2xl bg-[#1A2B42] px-4 py-3 text-sm font-semibold text-white hover:bg-[#15203a]">Se déconnecter</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endguest
        </div>
    </div>
</header>
