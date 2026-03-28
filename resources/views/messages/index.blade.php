<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-[#1A2B42] leading-tight">Messagerie</h2>
                <p class="text-sm text-[#6B7280]">Retrouvez vos conversations récentes et ouvrez un chat.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-4xl space-y-6 px-4 sm:px-6 lg:px-8">
            @if($contacts->isEmpty())
                <div class="rounded-3xl border border-gray-200 bg-white p-10 text-center text-[#4B5563]">
                    <p class="text-lg font-medium text-[#1A2B42]">Aucune conversation pour le moment.</p>
                    <p class="mt-3 text-sm">Commencez par contacter un avocat ou un client via leur profil.</p>
                </div>
            @else
                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach($contacts as $contact)
                        <a href="{{ route('messages.show', $contact) }}" class="block rounded-3xl border border-gray-200 bg-white p-6 text-left transition hover:border-[#1A2B42] hover:shadow-sm">
                            <div class="flex items-center gap-4">
                                <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-gray-200 text-lg font-semibold text-[#1A2B42]">{{ strtoupper(substr($contact->name, 0, 1)) }}</div>
                                <div>
                                    <p class="text-base font-semibold text-[#1A2B42]">{{ $contact->name }}</p>
                                    <p class="text-sm text-[#6B7280]">{{ $contact->email }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
