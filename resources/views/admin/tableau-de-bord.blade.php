@extends('layouts.app')

@section('content')

<section class="p-8">
    <h2 class="text-2xl font-bold text-[#0C2C55] mb-4">Administration</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="p-4 bg-white rounded shadow">
            <h3 class="font-semibold">Utilisateurs</h3>
            <p class="mt-2 text-lg">{{ $stats['users'] ?? '—' }}</p>
        </div>

        <div class="p-4 bg-white rounded shadow">
            <h3 class="font-semibold">Avocats</h3>
            <p class="mt-2 text-lg">{{ $stats['lawyers'] ?? '—' }}</p>
        </div>

        <div class="p-4 bg-white rounded shadow">
            <h3 class="font-semibold">Rendez-vous aujourd'hui</h3>
            <p class="mt-2 text-lg">{{ $stats['appointments_today'] ?? '—' }}</p>
        </div>
    </div>

</section>

@endsection
