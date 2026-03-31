<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-[#1A2B42] leading-tight">Validation des comptes avocats</h2>
                <p class="text-sm text-[#6B7280]">Validez les profils avocats avant qu'ils n'accèdent à la plateforme.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-6xl space-y-6 px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="rounded-3xl border border-green-200 bg-green-50 px-6 py-4 text-sm text-green-800">{{ session('success') }}</div>
            @endif

            @forelse($pendingLawyers as $lawyer)
                <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-[#1A2B42]">{{ $lawyer->name }}</h3>
                            <p class="mt-1 text-sm text-[#6B7280]">{{ $lawyer->email }}</p>
                            <p class="mt-2 text-sm text-[#4B5563]">Profil complété : {{ $lawyer->lawyerProfile?->isCompleted() ? 'Oui' : 'Non' }}</p>
                        </div>
                        <form action="{{ route('admin.lawyers.approve', $lawyer) }}" method="POST" class="sm:ml-6">
                            @csrf
                            <button type="submit" class="inline-flex items-center justify-center rounded-full bg-[#1A2B42] px-5 py-3 text-sm font-semibold text-white hover:bg-[#15203a]">Approuver le compte</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm text-sm text-[#475569]">
                    Il n’y a pas de nouveaux comptes avocat en attente de validation.
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
