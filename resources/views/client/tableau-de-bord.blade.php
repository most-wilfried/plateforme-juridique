<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-[#1A2B42] leading-tight">Tableau de bord Client</h2>
                <p class="text-sm text-[#6B7280]">Bienvenue {{ auth()->user()->name }}, voici votre espace.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-3">
                <a href="{{ route('appointments.index') }}" class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm transition hover:shadow-md">
                    <p class="text-sm font-semibold text-[#1A2B42]">Rendez-vous</p>
                    <p class="mt-3 text-3xl font-bold text-[#0C2C55]">{{ $appointments->count() }}</p>
                    <p class="mt-2 text-sm text-[#6B7280]">Prochains rendez-vous et planning.</p>
                </a>

                <a href="{{ route('documents.index') }}" class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm transition hover:shadow-md">
                    <p class="text-sm font-semibold text-[#1A2B42]">Documents</p>
                    <p class="mt-3 text-3xl font-bold text-[#0C2C55]">{{ $documentsCount }}</p>
                    <p class="mt-2 text-sm text-[#6B7280]">Documents accessibles et partagés.</p>
                </a>

                <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-semibold text-[#1A2B42]">Messages</p>
                    <p class="mt-3 text-3xl font-bold text-[#0C2C55]">{{ $messages->count() }}</p>
                    <p class="mt-2 text-sm text-[#6B7280]">Dernières conversations en cours.</p>
                </div>
            </div>

            <div class="grid gap-6 xl:grid-cols-[2fr_1fr]">
                <section class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-[#1A2B42]">Vos derniers messages</h3>
                    <p class="mt-1 text-sm text-[#6B7280]">Les échanges récents avec vos avocats.</p>

                    <div class="mt-6 space-y-4">
                        @forelse($messages as $message)
                            <div class="rounded-3xl bg-[#F8FAFC] p-5">
                                <p class="text-sm text-[#6B7280]">{{ $message->sender_id === auth()->id() ? 'Envoyé à' : 'Reçu de' }} {{ $message->sender_id === auth()->id() ? $message->receiver->name : $message->sender->name }}</p>
                                <p class="mt-2 text-sm text-[#1A2B42]">{{ $message->content }}</p>
                                <p class="mt-2 text-xs text-[#6B7280]">{{ $message->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        @empty
                            <div class="rounded-3xl bg-[#F8FAFC] p-5 text-sm text-[#4B5563]">Vous n'avez pas encore de conversation.</div>
                        @endforelse
                    </div>
                </section>

                <aside class="space-y-6">
                    <section class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-[#1A2B42]">Vos contacts</h3>
                        <p class="mt-1 text-sm text-[#6B7280]">Avocats avec qui vous avez échangé.</p>

                        <div class="mt-6 space-y-3">
                            @forelse($contacts as $contact)
                                <div class="rounded-3xl bg-[#F8FAFC] px-4 py-4 text-sm text-[#1A2B42]">
                                    <p class="font-semibold">{{ $contact->name }}</p>
                                    <p class="mt-1 text-[#6B7280]">{{ $contact->email }}</p>
                                </div>
                            @empty
                                <div class="rounded-3xl bg-[#F8FAFC] px-4 py-4 text-sm text-[#4B5563]">Aucun contact pour le moment.</div>
                            @endforelse
                        </div>
                    </section>
                </aside>
            </div>
        </div>
    </div>
</x-app-layout>
