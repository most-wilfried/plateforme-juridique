<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-[#1A2B42] leading-tight">Compte en attente de validation</h2>
                <p class="text-sm text-[#6B7280]">Votre profil avocat est en cours de validation par un administrateur.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-3xl space-y-6 px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-gray-200 bg-white p-10 shadow-sm">
                <h3 class="text-lg font-semibold text-[#1A2B42]">Merci pour votre inscription</h3>
                <p class="mt-4 text-sm text-[#475569]">
                    Votre compte avocat a bien été créé. Il doit maintenant être validé par un administrateur avant que vous puissiez accéder pleinement à l’interface.
                </p>
                <p class="mt-4 text-sm text-[#475569]">
                    Une notification vous sera envoyée dès que votre compte sera approuvé.
                </p>
                <div class="mt-6 rounded-3xl bg-[#F8FAFC] p-6 text-sm text-[#1A2B42]">
                    <p><strong>Nom :</strong> {{ $user->name }}</p>
                    <p class="mt-2"><strong>Email :</strong> {{ $user->email }}</p>
                    <p class="mt-2"><strong>Rôle :</strong> Avocat</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
