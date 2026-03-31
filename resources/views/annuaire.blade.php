@extends('layouts.main')

@section('content')
    <section class="bg-white px-6 py-16 sm:py-24">
        <div class="mx-auto max-w-7xl">
            <div class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.28em] text-[#1A2B42]/60">Annuaire</p>
                    <h1 class="mt-3 text-4xl font-semibold text-[#1A2B42]">Avocats disponibles</h1>
                    <p class="mt-4 max-w-2xl text-base text-[#4B5563]">Trouvez un avocat avec un profil complet et prenez contact directement.</p>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 rounded-3xl border border-green-200 bg-green-50 px-6 py-4 text-sm text-green-800">{{ session('success') }}</div>
            @endif

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse($lawyers as $lawyer)
                    <article class="overflow-hidden rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                        <div class="flex items-center gap-4">
                            <div class="flex h-14 w-14 items-center justify-center rounded-3xl bg-gray-200 text-2xl font-semibold text-[#1A2B42]">
                                {{ strtoupper(substr($lawyer->name, 0, 1)) }}
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-[#1A2B42]">{{ $lawyer->name }}</h2>
                                <p class="text-sm text-[#6B7280]">{{ $lawyer->lawyerProfile->city ?? '—' }}</p>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center gap-2 text-sm text-[#4B5563]">
                            <span class="inline-flex items-center gap-1 rounded-full bg-[#EFF6FF] px-3 py-1 text-[#1E3A8A]">★ 4.8</span>
                            <span>{{ $lawyer->lawyerProfile->experience_years ?? 0 }} ans d'expérience</span>
                        </div>

                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach($lawyer->lawyerProfile->specialties ?? [] as $specialty)
                                <span class="rounded-full bg-[#F3F4F6] px-3 py-1 text-xs font-semibold text-[#1A2B42]">{{ $specialty }}</span>
                            @endforeach
                        </div>

                        <div class="mt-6 flex items-center justify-between gap-4 border-t border-gray-100 pt-4 text-sm text-[#4B5563]">
                            <span>À partir de</span>
                            <span class="text-base font-semibold text-[#1A2B42]">{{ $lawyer->lawyerProfile->currency ?? '€' }}{{ number_format($lawyer->lawyerProfile->hourly_rate ?? 0, 2, ',', ' ') }}/h</span>
                        </div>

                        <div class="mt-6 space-y-3">
                            @auth
                                @if(auth()->user()->role === 'admin')
                                    <div class="flex flex-col gap-3">
                                        @if($lawyer->is_approved)
                                            <div class="rounded-full bg-green-50 px-4 py-2 text-sm font-semibold text-green-800">Avocat validé</div>
                                            <a href="{{ route('directory.show', $lawyer) }}" class="inline-flex w-full items-center justify-center rounded-full bg-[#1A2B42] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#15203a]">Voir le profil</a>
                                        @else
                                            <form action="{{ route('admin.lawyers.approve', $lawyer) }}" method="POST" class="inline-flex w-full">
                                                @csrf
                                                <button type="submit" class="inline-flex w-full items-center justify-center rounded-full bg-[#1A2B42] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#15203a]">Valider l'accès</button>
                                            </form>
                                        @endif
                                    </div>
                                @else
                                    <a href="{{ route('directory.show', $lawyer) }}" class="inline-flex w-full items-center justify-center rounded-full bg-[#1A2B42] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#15203a]">
                                        Consulter
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('directory.show', $lawyer) }}" class="inline-flex w-full items-center justify-center rounded-full bg-[#1A2B42] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#15203a]">
                                    Consulter
                                </a>
                            @endauth
                        </div>
                    </article>
                @empty
                    <div class="col-span-full rounded-3xl border border-gray-200 bg-white p-10 text-center text-[#4B5563]">
                        Aucun avocat disponible pour le moment.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
