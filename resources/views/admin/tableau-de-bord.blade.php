<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-[#1A2B42] leading-tight">Tableau de bord administrateur</h2>
                <p class="text-sm text-[#6B7280]">Gestion des utilisateurs, clients et avocats de la plateforme.</p>
            </div>
            <div>
                <a href="{{ route('admin.lawyers.pending') }}" class="inline-flex items-center justify-center rounded-full bg-[#1A2B42] px-5 py-3 text-sm font-semibold text-white hover:bg-[#15203a]">Valider les comptes avocats</a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl space-y-8 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                    <h3 class="text-sm font-semibold text-[#1A2B42]">Utilisateurs</h3>
                    <p class="mt-4 text-3xl font-bold text-[#0C2C55]">{{ $stats['users'] ?? '—' }}</p>
                    <p class="mt-2 text-sm text-[#6B7280]">Total des comptes inscrits.</p>
                </div>

                <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                    <h3 class="text-sm font-semibold text-[#1A2B42]">Clients</h3>
                    <p class="mt-4 text-3xl font-bold text-[#0C2C55]">{{ $stats['clients'] ?? '—' }}</p>
                    <p class="mt-2 text-sm text-[#6B7280]">Nombre de clients actifs.</p>
                </div>

                <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                    <h3 class="text-sm font-semibold text-[#1A2B42]">Avocats</h3>
                    <p class="mt-4 text-3xl font-bold text-[#0C2C55]">{{ $stats['lawyers'] ?? '—' }}</p>
                    <p class="mt-2 text-sm text-[#6B7280]">Profils avocats enregistrés.</p>
                </div>
            </div>

            <div class="grid gap-8 xl:grid-cols-[1.2fr_0.8fr]">
                <section class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-[#1A2B42] mb-4">Liste des clients</h3>
                    <div class="space-y-4">
                        @forelse($clients as $client)
                            <div class="rounded-3xl border border-gray-100 bg-[#F8FAFC] p-5">
                                <p class="font-semibold text-[#0C2C55]">{{ $client->name }}</p>
                                <p class="mt-1 text-sm text-[#6B7280]">{{ $client->email }}</p>
                                <p class="mt-2 text-xs uppercase tracking-wide text-[#4B5563]">Client</p>
                            </div>
                        @empty
                            <div class="rounded-3xl bg-[#F8FAFC] p-5 text-sm text-[#4B5563]">Aucun client enregistré pour le moment.</div>
                        @endforelse
                    </div>
                </section>

                <section class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-[#1A2B42] mb-4">Liste des avocats</h3>
                    <div class="space-y-4">
                        @forelse($lawyers as $lawyer)
                            <div class="rounded-3xl border border-gray-100 bg-[#F8FAFC] p-5">
                                <p class="font-semibold text-[#0C2C55]">{{ $lawyer->name }}</p>
                                <p class="mt-1 text-sm text-[#6B7280]">{{ $lawyer->email }}</p>
                                <div class="mt-3 flex flex-wrap gap-2">
                                    @forelse($lawyer->lawyerProfile->specialties ?? [] as $specialty)
                                        <span class="rounded-full bg-[#E0F2FE] px-3 py-1 text-xs font-semibold text-[#0C2C55]">{{ $specialty }}</span>
                                    @empty
                                        <span class="rounded-full bg-[#F3F4F6] px-3 py-1 text-xs font-semibold text-[#6B7280]">Aucune spécialité définie</span>
                                    @endforelse
                                </div>
                            </div>
                        @empty
                            <div class="rounded-3xl bg-[#F8FAFC] p-5 text-sm text-[#4B5563]">Aucun avocat enregistré pour le moment.</div>
                        @endforelse
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
