<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-[#1A2B42] leading-tight">Documents juridiques</h2>
                <p class="text-sm text-[#6B7280]">Gérez, téléchargez et consultez vos fichiers juridiques en toute sécurité.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="rounded-3xl border border-green-200 bg-green-50 px-6 py-4 text-sm text-green-800">{{ session('success') }}</div>
            @endif

            <section class="grid gap-6 lg:grid-cols-[1.15fr_0.85fr]">
                <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-[#1A2B42]">Vos documents</h3>
                    <p class="mt-1 text-sm text-[#6B7280]">Accédez à tous vos documents partagés et associés à vos rendez-vous.</p>

                    <div class="mt-6 space-y-4">
                        @forelse($documents as $document)
                            <div class="flex flex-col gap-3 rounded-3xl bg-[#F8FAFC] p-5 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <p class="font-semibold text-[#1A2B42]">{{ $document->file_name }}</p>
                                    <p class="mt-1 text-sm text-[#6B7280]">{{ $document->category }} • {{ number_format($document->size / 1024, 1) }} KB</p>
                                    @if($document->appointment)
                                        <p class="mt-2 text-sm text-[#4B5563]">Rendez-vous avec {{ $document->appointment->lawyer?->name ?? $document->appointment->client?->name }} le {{ $document->appointment->start_time?->format('d/m/Y H:i') }}</p>
                                    @endif
                                </div>

                                <div class="flex items-center gap-3">
                                    <a href="{{ route('documents.download', $document) }}" class="rounded-full bg-[#1A2B42] px-4 py-2 text-sm font-semibold text-white hover:bg-[#15203a]">Télécharger</a>
                                </div>
                            </div>
                        @empty
                            <x-empty-state title="Aucun document trouvé">
                                Vous n'avez pas encore de document juridique. Utilisez le formulaire pour en ajouter un.
                            </x-empty-state>
                        @endforelse
                    </div>
                </div>

                <aside class="space-y-6">
                    <section class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-[#1A2B42]">Ajouter un document</h3>
                        <p class="mt-1 text-sm text-[#6B7280]">Téléversez un document pour l'associer à un rendez-vous.</p>

                        <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-4">
                            @csrf

                            <div>
                                <label for="file" class="block text-sm font-medium text-[#1A2B42]">Fichier</label>
                                <input id="file" name="file" type="file" class="mt-2 block w-full rounded-3xl border border-gray-300 bg-white px-4 py-3 text-sm text-[#1A2B42] shadow-sm focus:border-[#1A2B42] focus:ring-[#1A2B42]" required>
                                @error('file')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label for="appointment_id" class="block text-sm font-medium text-[#1A2B42]">Rendez-vous associé (facultatif)</label>
                                <select id="appointment_id" name="appointment_id" class="mt-2 block w-full rounded-3xl border border-gray-300 bg-white px-4 py-3 text-sm text-[#1A2B42] shadow-sm focus:border-[#1A2B42] focus:ring-[#1A2B42]">
                                    <option value="">Aucun</option>
                                    @foreach($appointments as $appointment)
                                        <option value="{{ $appointment->id }}">
                                            {{ $appointment->start_time?->format('d/m/Y H:i') }} — {{ $user->role === 'avocat' ? $appointment->client->name : $appointment->lawyer->name ?? '—' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('appointment_id')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <button type="submit" class="inline-flex items-center justify-center rounded-full bg-[#1A2B42] px-5 py-3 text-sm font-semibold text-white hover:bg-[#15203a]">Téléverser le document</button>
                        </form>
                    </section>
                </aside>
            </section>
        </div>
    </div>
</x-app-layout>
