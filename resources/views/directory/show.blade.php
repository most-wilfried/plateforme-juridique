@extends('layouts.main')

@section('content')
    <section class="bg-white px-6 py-16 sm:py-24">
        <div class="mx-auto max-w-5xl">
            <div class="grid gap-10 lg:grid-cols-[1fr_320px]">
                <div class="space-y-6">
                    <div class="rounded-3xl border border-gray-200 bg-[#F8FAFC] p-8">
                        <div class="flex items-center justify-between gap-6">
                            <div>
                                <p class="text-sm uppercase tracking-[0.28em] text-[#1A2B42]/60">Profil avocat</p>
                                <h1 class="mt-3 text-3xl font-semibold text-[#1A2B42]">{{ $user->name }}</h1>
                                <p class="mt-2 text-sm text-[#4B5563]">{{ $user->lawyerProfile->city }}</p>
                            </div>
                            <div class="flex h-16 w-16 items-center justify-center rounded-3xl bg-gray-200 text-2xl font-semibold text-[#1A2B42]">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        </div>

                        <div class="mt-8 grid gap-4 sm:grid-cols-2">
                            <div class="rounded-3xl bg-white p-5 shadow-sm">
                                <p class="text-sm text-[#6B7280]">Expérience</p>
                                <p class="mt-2 text-xl font-semibold text-[#1A2B42]">{{ $user->lawyerProfile->experience_years }} ans</p>
                            </div>
                            <div class="rounded-3xl bg-white p-5 shadow-sm">
                                <p class="text-sm text-[#6B7280]">Tarif horaire</p>
                                <p class="mt-2 text-xl font-semibold text-[#1A2B42]">{{ $user->lawyerProfile->currency ?? '€' }}{{ number_format($user->lawyerProfile->hourly_rate ?? 0, 2, ',', ' ') }}/h</p>
                            </div>
                        </div>

                        <div class="mt-8">
                            <h2 class="text-lg font-semibold text-[#1A2B42]">À propos</h2>
                            <p class="mt-4 text-sm leading-7 text-[#475569]">{{ $user->lawyerProfile->bio }}</p>
                        </div>

                        <div class="mt-8">
                            <h2 class="text-lg font-semibold text-[#1A2B42]">Spécialités</h2>
                            <div class="mt-4 flex flex-wrap gap-2">
                                @foreach($user->lawyerProfile->specialties ?? [] as $specialty)
                                    <span class="rounded-full bg-[#F3F4F6] px-3 py-1 text-sm font-semibold text-[#1A2B42]">{{ $specialty }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl border border-gray-200 bg-white p-8 shadow-sm">
                        <h2 class="text-lg font-semibold text-[#1A2B42]">Contact</h2>
                        <div class="mt-4 space-y-3 text-sm text-[#475569]">
                            <p><strong>Barreau:</strong> {{ $user->lawyerProfile->bar_number }}</p>
                            <p><strong>Téléphone:</strong> {{ $user->lawyerProfile->phone }}</p>
                            <p><strong>Adresse:</strong> {{ $user->lawyerProfile->address }}</p>
                            <p><strong>Langues:</strong> {{ implode(', ', $user->lawyerProfile->languages ?? []) }}</p>
                        </div>
                    </div>
                </div>

                <aside class="space-y-6">
                    <div class="rounded-3xl border border-gray-200 bg-white p-8 shadow-sm">
                        <h2 class="text-lg font-semibold text-[#1A2B42]">Prendre contact</h2>
                        @auth
                            @if(auth()->user()->role === 'client')
                                @if($existingRequest)
                                    <p class="mt-3 text-sm text-[#4B5563]">Vous avez déjà demandé un rendez-vous avec cet avocat.</p>
                                    <p class="mt-3 text-sm font-semibold text-[#1A2B42]">Statut : {{ ucfirst($existingRequest->status) }}</p>
                                    @if($existingRequest->status === 'accepted')
                                        <a href="{{ route('messages.show', $user) }}" class="mt-6 inline-flex w-full items-center justify-center rounded-full bg-[#1A2B42] px-5 py-3 text-sm font-semibold text-white hover:bg-[#15203a]">Contacter</a>
                                    @endif
                                @else
                                    <p class="mt-3 text-sm text-[#4B5563]">Envoyez une demande de rendez-vous à cet avocat pour pouvoir échanger.</p>
                                    <form action="{{ route('appointments.request', $user) }}" method="POST" class="mt-6 space-y-4">
                                        @csrf
                                        <textarea name="notes" rows="4" placeholder="Décrivez brièvement votre besoin..." class="block w-full rounded-3xl border border-gray-300 bg-white px-4 py-3 text-sm text-[#1A2B42] shadow-sm focus:border-[#1A2B42] focus:ring-[#1A2B42]"></textarea>
                                        <button type="submit" class="inline-flex w-full items-center justify-center rounded-full bg-[#1A2B42] px-5 py-3 text-sm font-semibold text-white hover:bg-[#15203a]">Demander un rendez-vous</button>
                                    </form>
                                @endif
                            @else
                                <p class="mt-3 text-sm text-[#4B5563]">Connectez-vous en tant que client pour faire une demande à cet avocat.</p>
                            @endif
                        @else
                            <p class="mt-3 text-sm text-[#4B5563]">Connectez-vous pour envoyer une demande de rendez-vous.</p>
                        @endauth
                    </div>

                    <div class="rounded-3xl border border-gray-200 bg-white p-8 shadow-sm">
                        <h2 class="text-lg font-semibold text-[#1A2B42]">Disponibilité</h2>
                        <p class="mt-4 text-sm text-[#4B5563]">Horaires de consultation : {{ $user->lawyerProfile->work_start ?? 'N/A' }} - {{ $user->lawyerProfile->work_end ?? 'N/A' }}</p>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
