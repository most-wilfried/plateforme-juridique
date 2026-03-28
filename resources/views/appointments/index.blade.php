<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-[#1A2B42] leading-tight">Rendez-vous</h2>
                <p class="text-sm text-[#6B7280]">Consultez et suivez tous vos rendez-vous juridiques.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            <section class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-[#1A2B42]">Tous les rendez-vous</h3>
                        <p class="mt-1 text-sm text-[#6B7280]">Liste des prochaines rencontres et des échanges associés.</p>
                    </div>
                    <span class="rounded-full bg-[#EFF6FF] px-4 py-2 text-sm font-semibold text-[#1E3A8A]">{{ $appointments->count() }} rendez-vous</span>
                </div>

                <div class="mt-6 space-y-4">
                    @forelse($appointments as $appointment)
                        <article class="rounded-3xl bg-[#F8FAFC] p-5 shadow-sm">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-[#6B7280]">{{ $appointment->status ? ucfirst($appointment->status) : 'En attente' }}</p>
                                    <h4 class="mt-2 text-lg font-semibold text-[#1A2B42]">{{ $appointment->start_time?->format('d/m/Y H:i') ?? 'Date non définie' }}</h4>
                                    <p class="mt-2 text-sm text-[#4B5563]">
                                        {{ $user->role === 'avocat' ? 'Client : '.$appointment->client?->name : 'Avocat : '.$appointment->lawyer?->name }}
                                    </p>
                                </div>
                                <div class="rounded-3xl bg-white px-4 py-3 text-sm text-[#1A2B42] shadow-sm">
                                    <p class="font-semibold">{{ $appointment->notes ? 'Notes enregistrées' : 'Pas de notes' }}</p>
                                </div>
                            </div>
                        </article>
                    @empty
                        <x-empty-state title="Aucun rendez-vous">
                            Vous n'avez pas de rendez-vous programmé pour l'instant.
                        </x-empty-state>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
