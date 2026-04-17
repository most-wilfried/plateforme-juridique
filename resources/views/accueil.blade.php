@extends('layouts.main')

@section('content')
    <section class="bg-[#1A2B42] px-6 py-16 text-white sm:py-24">
        <div class="mx-auto max-w-7xl">
            <div class="flex flex-col items-center gap-8 text-center">
                <span class="inline-flex items-center gap-2 rounded-full bg-[#F3F4F6] px-4 py-2 text-sm font-medium text-[#1A2B42]">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-white text-lg text-[#1A2B42]">⚖</span>
                    Plateforme juridique de confiance
                </span>

                <h1 class="max-w-4xl text-5xl font-semibold leading-tight tracking-tight text-white sm:text-6xl md:text-7xl font-serif">
                    Votre avocat,<br>
                    à portée de clic
                </h1>

                <p class="max-w-3xl text-base text-[#E5E7EB] sm:text-lg">
                    Consultez un avocat qualifié en ligne. Simple, sécurisé et professionnel. Trouvez l'expert qu'il vous faut et obtenez des conseils juridiques personnalisés.
                </p>

                <div class="w-full max-w-3xl rounded-full bg-white p-2 shadow-sm sm:flex sm:items-center">
                    <div class="flex items-center gap-3 px-4 py-3 text-[#1A2B42] sm:flex-1">
                        <span class="text-xl">🔍</span>
                        <input type="search" placeholder="Rechercher par spécialité..." class="w-full border-0 bg-transparent text-sm text-[#1A2B42] outline-none placeholder:text-[#9CA3AF]" />
                    </div>
                    <button class="mt-3 inline-flex w-full items-center justify-center rounded-full bg-[#1A2B42] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#15203a] sm:mt-0 sm:w-auto">
                        Rechercher
                        <span class="ml-2">→</span>
                    </button>
                </div>

                <div class="grid w-full max-w-3xl grid-cols-1 gap-4 text-sm text-[#D1D5DB] sm:grid-cols-3">
                    <div class="flex items-center justify-center gap-3 rounded-2xl bg-white/10 px-4 py-3">
                        <span class="text-lg">👥</span>
                        <span>6 avocats</span>
                    </div>
                    <div class="flex items-center justify-center gap-3 rounded-2xl bg-white/10 px-4 py-3">
                        <span class="text-lg">⭐</span>
                        <span>4.8/5 satisfaction</span>
                    </div>
                    <div class="flex items-center justify-center gap-3 rounded-2xl bg-white/10 px-4 py-3">
                        <span class="text-lg">🛡️</span>
                        <span>100% sécurisé</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white px-6 py-16 sm:py-24">
        <div class="mx-auto max-w-7xl text-center">
            <h2 class="text-4xl font-semibold text-[#1A2B42] font-serif">Domaines d'expertise</h2>
            <p class="mx-auto mt-4 max-w-2xl text-base text-[#4B5563]">Trouvez un avocat spécialisé dans votre domaine</p>

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <a href="{{ route('directory.index', ['specialty' => 'Droit de la famille']) }}" class="rounded-3xl bg-[#F3F4F6] p-6 text-left shadow-sm hover:bg-[#E5E7EB] transition">
                    <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-[#1A2B42] shadow-sm">⚖</div>
                    <h3 class="text-xl font-semibold text-[#1A2B42]">Droit de la famille</h3>
                </a>
                <a href="{{ route('directory.index', ['specialty' => 'Droit pénal']) }}" class="rounded-3xl bg-[#F3F4F6] p-6 text-left shadow-sm hover:bg-[#E5E7EB] transition">
                    <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-[#1A2B42] shadow-sm">⚖</div>
                    <h3 class="text-xl font-semibold text-[#1A2B42]">Droit pénal</h3>
                </a>
                <a href="{{ route('directory.index', ['specialty' => 'Droit du travail']) }}" class="rounded-3xl bg-[#F3F4F6] p-6 text-left shadow-sm hover:bg-[#E5E7EB] transition">
                    <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-[#1A2B42] shadow-sm">⚖</div>
                    <h3 class="text-xl font-semibold text-[#1A2B42]">Droit du travail</h3>
                </a>
                <a href="{{ route('directory.index', ['specialty' => 'Droit commercial']) }}" class="rounded-3xl bg-[#F3F4F6] p-6 text-left shadow-sm hover:bg-[#E5E7EB] transition">
                    <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-[#1A2B42] shadow-sm">⚖</div>
                    <h3 class="text-xl font-semibold text-[#1A2B42]">Droit commercial</h3>
                </a>
                <a href="{{ route('directory.index', ['specialty' => 'Droit immobilier']) }}" class="rounded-3xl bg-[#F3F4F6] p-6 text-left shadow-sm hover:bg-[#E5E7EB] transition">
                    <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-[#1A2B42] shadow-sm">⚖</div>
                    <h3 class="text-xl font-semibold text-[#1A2B42]">Droit immobilier</h3>
                </a>
                <a href="{{ route('directory.index', ['specialty' => 'Droit des affaires']) }}" class="rounded-3xl bg-[#F3F4F6] p-6 text-left shadow-sm hover:bg-[#E5E7EB] transition">
                    <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-[#1A2B42] shadow-sm">⚖</div>
                    <h3 class="text-xl font-semibold text-[#1A2B42]">Droit des affaires</h3>
                </a>
                <a href="{{ route('directory.index', ['specialty' => 'Droit fiscal']) }}" class="rounded-3xl bg-[#F3F4F6] p-6 text-left shadow-sm hover:bg-[#E5E7EB] transition">
                    <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-[#1A2B42] shadow-sm">⚖</div>
                    <h3 class="text-xl font-semibold text-[#1A2B42]">Droit fiscal</h3>
                </a>
                <a href="{{ route('directory.index', ['specialty' => 'Droit de la propriété intellectuelle']) }}" class="rounded-3xl bg-[#F3F4F6] p-6 text-left shadow-sm hover:bg-[#E5E7EB] transition">
                    <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-[#1A2B42] shadow-sm">⚖</div>
                    <h3 class="text-xl font-semibold text-[#1A2B42]">Droit de la propriété intellectuelle</h3>
                </a>
            </div>
        </div>
    </section>

    <section class="bg-white px-6 py-16 sm:py-24">
        <div class="mx-auto max-w-7xl text-center">
            <h2 class="text-4xl font-semibold text-[#1A2B42] font-serif">Comment ça marche</h2>
            <p class="mx-auto mt-4 max-w-2xl text-base text-[#4B5563]">Une expérience simple et transparente de bout en bout</p>

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-5">
                <div class="rounded-3xl bg-[#F3F4F6] p-6 text-left">
                    <div class="mb-5 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-[#1A2B42] text-xl shadow-sm">🔍</div>
                    <h3 class="mb-2 text-lg font-semibold text-[#1A2B42]">Trouvez votre avocat</h3>
                    <p class="text-sm text-[#4B5563]">Parcourez notre annuaire d'avocats qualifiés, filtrés par spécialité et localisation.</p>
                </div>
                <div class="rounded-3xl bg-[#F3F4F6] p-6 text-left">
                    <div class="mb-5 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-[#1A2B42] text-xl shadow-sm">📅</div>
                    <h3 class="mb-2 text-lg font-semibold text-[#1A2B42]">Réservez en ligne</h3>
                    <p class="text-sm text-[#4B5563]">Planifiez votre consultation en quelques clics grâce à notre calendrier interactif.</p>
                </div>
                <div class="rounded-3xl bg-[#F3F4F6] p-6 text-left">
                    <div class="mb-5 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-[#1A2B42] text-xl shadow-sm">🎥</div>
                    <h3 class="mb-2 text-lg font-semibold text-[#1A2B42]">Consultez à distance</h3>
                    <p class="text-sm text-[#4B5563]">Échangez en visioconférence ou par chat sécurisé depuis votre domicile.</p>
                </div>
                <div class="rounded-3xl bg-[#F3F4F6] p-6 text-left">
                    <div class="mb-5 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-[#1A2B42] text-xl shadow-sm">📄</div>
                    <h3 class="mb-2 text-lg font-semibold text-[#1A2B42]">Gérez vos documents</h3>
                    <p class="text-sm text-[#4B5563]">Partagez et consultez vos documents juridiques en toute sécurité.</p>
                </div>
                <div class="rounded-3xl bg-[#F3F4F6] p-6 text-left">
                    <div class="mb-5 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-[#1A2B42] text-xl shadow-sm">🛡️</div>
                    <h3 class="mb-2 text-lg font-semibold text-[#1A2B42]">Paiement sécurisé</h3>
                    <p class="text-sm text-[#4B5563]">Réglez vos consultations en toute confiance avec notre système de paiement.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#1A2B42] px-6 py-16 sm:py-24">
        <div class="mx-auto max-w-7xl text-center">
            <h2 class="text-4xl font-semibold leading-tight text-white font-serif">Prêt à trouver votre avocat ?</h2>
            <p class="mx-auto mt-4 max-w-2xl text-base text-[#E5E7EB]">Rejoignez notre plateforme et accédez à un réseau d'avocats qualifiés pour vos besoins juridiques.</p>
            <div class="mt-10 flex flex-col items-center justify-center gap-4 sm:flex-row">
                <a href="{{ route('directory.index') }}" class="inline-flex items-center justify-center rounded-full bg-white px-8 py-3 text-sm font-semibold text-[#1A2B42] shadow-sm">
                    Trouver un avocat
                    <span class="ml-2">→</span>
                </a>
                <a href="{{ route('register', ['role' => 'avocat']) }}" class="inline-flex items-center justify-center rounded-full border border-white px-8 py-3 text-sm font-semibold text-white hover:bg-white hover:text-[#1A2B42]">
                    Je suis avocat
                </a>
            </div>
        </div>
    </section>
@endsection
