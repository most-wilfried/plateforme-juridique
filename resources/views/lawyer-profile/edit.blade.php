<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1A2B42] leading-tight font-serif">
            Mon Profil Avocat
        </h2>
        <p class="mt-1 text-sm text-[#4B5563]">Complétez votre profil pour apparaître dans l'annuaire</p>
    </x-slot>

    @php
        $initialSpecialties = old('specialties', $profile->specialties ?? []);
        if (!is_array($initialSpecialties)) {
            $initialSpecialties = array_filter(array_map('trim', explode(',', $initialSpecialties)));
        }

        $initialLanguages = old('languages', $profile->languages ?? []);
        if (!is_array($initialLanguages)) {
            $initialLanguages = array_filter(array_map('trim', explode(',', $initialLanguages)));
        }
    @endphp

    <div class="py-12">
        <div class="mx-auto max-w-4xl space-y-6 px-4 sm:px-6 lg:px-8">
            @if(session('status'))
                <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-4 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('lawyer.profile.update') }}" x-data="lawyerProfileForm()" class="space-y-6">
                @csrf
                @method('PATCH')

                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#1A2B42] text-white text-xl">👤</div>
                        <div>
                            <h3 class="text-lg font-semibold text-[#1A2B42]">Informations personnelles</h3>
                            <p class="text-sm text-[#6B7280]">Vos coordonnées professionnelles.</p>
                        </div>
                    </div>

                    <div class="mt-6 grid gap-6 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-[#1A2B42]" for="bar_number">Numéro du barreau</label>
                            <input id="bar_number" name="bar_number" type="text" value="{{ old('bar_number', $profile->bar_number) }}" class="mt-2 block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-[#1A2B42] focus:border-[#1A2B42] focus:ring-[#1A2B42]" />
                            @error('bar_number')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#1A2B42]" for="phone">Téléphone</label>
                            <input id="phone" name="phone" type="text" value="{{ old('phone', $profile->phone) }}" class="mt-2 block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-[#1A2B42] focus:border-[#1A2B42] focus:ring-[#1A2B42]" />
                            @error('phone')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="mt-6 grid gap-6 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-[#1A2B42]" for="experience_years">Années d'expérience</label>
                            <input id="experience_years" name="experience_years" type="number" min="0" max="100" value="{{ old('experience_years', $profile->experience_years) }}" class="mt-2 block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-[#1A2B42] focus:border-[#1A2B42] focus:ring-[#1A2B42]" />
                            @error('experience_years')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#1A2B42]" for="bio">Biographie</label>
                            <textarea id="bio" name="bio" rows="4" class="mt-2 block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-[#1A2B42] focus:border-[#1A2B42] focus:ring-[#1A2B42]">{{ old('bio', $profile->bio) }}</textarea>
                            @error('bio')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#1A2B42] text-white text-xl">📍</div>
                        <div>
                            <h3 class="text-lg font-semibold text-[#1A2B42]">Localisation & Tarifs</h3>
                            <p class="text-sm text-[#6B7280]">Indiquez où vous exercez et vos conditions.</p>
                        </div>
                    </div>

                    <div class="mt-6 grid gap-6 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-[#1A2B42]" for="city">Ville</label>
                            <input id="city" name="city" type="text" value="{{ old('city', $profile->city) }}" class="mt-2 block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-[#1A2B42] focus:border-[#1A2B42] focus:ring-[#1A2B42]" />
                            @error('city')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#1A2B42]" for="address">Adresse</label>
                            <input id="address" name="address" type="text" value="{{ old('address', $profile->address) }}" class="mt-2 block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-[#1A2B42] focus:border-[#1A2B42] focus:ring-[#1A2B42]" />
                            @error('address')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="mt-6 grid gap-6 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-[#1A2B42]" for="hourly_rate">Tarif horaire</label>
                            <input id="hourly_rate" name="hourly_rate" type="number" step="0.01" min="0" value="{{ old('hourly_rate', $profile->hourly_rate) }}" class="mt-2 block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-[#1A2B42] focus:border-[#1A2B42] focus:ring-[#1A2B42]" />
                            @error('hourly_rate')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#1A2B42]" for="currency">Devise</label>
                            <input id="currency" name="currency" type="text" value="{{ old('currency', $profile->currency) }}" class="mt-2 block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-[#1A2B42] focus:border-[#1A2B42] focus:ring-[#1A2B42]" />
                            @error('currency')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#1A2B42] text-white text-xl">⚖</div>
                        <div>
                            <h3 class="text-lg font-semibold text-[#1A2B42]">Spécialités</h3>
                            <p class="text-sm text-[#6B7280]">Sélectionnez les domaines dans lesquels vous souhaitez apparaître.</p>
                        </div>
                    </div>

                    <div class="mt-6 grid gap-3 sm:grid-cols-2">
                        @foreach($specialties as $specialty)
                            @php
                                $specialtyId = data_get($specialty, 'id');
                                $specialtyName = data_get($specialty, 'name');
                            @endphp
                            <button
                                type="button"
                                @click="toggleSpecialty('{{ $specialtyId }}')"
                                :class="specialties.includes('{{ $specialtyId }}') ? 'bg-[#1A2B42] text-white' : 'bg-gray-100 text-[#1A2B42]'"
                                class="rounded-full border border-gray-200 px-4 py-3 text-sm font-medium transition"
                            >
                                {{ $specialtyName }}
                            </button>
                        @endforeach
                    </div>

                    <input type="hidden" name="specialties" :value="specialties.join(',')" />
                    @error('specialties')<p class="mt-3 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm" x-data="languageForm()">
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#1A2B42] text-white text-xl">🗣️</div>
                        <div>
                            <h3 class="text-lg font-semibold text-[#1A2B42]">Langues</h3>
                            <p class="text-sm text-[#6B7280]">Ajoutez les langues que vous parlez.</p>
                        </div>
                    </div>

                    <div class="mt-6 space-y-4">
                        <div class="flex gap-3">
                            <input
                                x-model="languageInput"
                                type="text"
                                placeholder="Ajouter une langue"
                                class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-[#1A2B42] focus:border-[#1A2B42] focus:ring-[#1A2B42]"
                            />
                            <button type="button" @click="addLanguage()" class="inline-flex items-center justify-center rounded-xl bg-[#1A2B42] px-5 py-3 text-sm font-semibold text-white hover:bg-[#15203a]">Ajouter</button>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            <template x-for="(language, index) in languages" :key="index">
                                <div class="inline-flex items-center gap-2 rounded-full bg-gray-100 px-3 py-2 text-sm text-[#1A2B42]">
                                    <span x-text="language"></span>
                                    <button type="button" @click="removeLanguage(index)" class="text-[#6B7280] hover:text-[#1A2B42]">✕</button>
                                </div>
                            </template>
                        </div>

                        <input type="hidden" name="languages" :value="languages.join(',')" />
                    </div>
                </div>

                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#1A2B42] text-white text-xl">📅</div>
                        <div>
                            <h3 class="text-lg font-semibold text-[#1A2B42]">Disponibilité</h3>
                            <p class="text-sm text-[#6B7280]">Choisissez vos jours de consultation et vos horaires.</p>
                        </div>
                    </div>

                    <div class="mt-6 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                        @php
                            $days = [
                                'monday' => 'Lundi',
                                'tuesday' => 'Mardi',
                                'wednesday' => 'Mercredi',
                                'thursday' => 'Jeudi',
                                'friday' => 'Vendredi',
                                'saturday' => 'Samedi',
                                'sunday' => 'Dimanche',
                            ];
                            $selectedWorkingDays = old('working_days', $profile->working_days ?? []);
                        @endphp

                        @foreach($days as $dayKey => $dayLabel)
                            <label class="cursor-pointer">
                                <input type="checkbox" name="working_days[]" value="{{ $dayKey }}" class="sr-only" {{ in_array($dayKey, (array) $selectedWorkingDays) ? 'checked' : '' }} />
                                <span class="inline-flex h-11 items-center justify-center rounded-full border border-gray-200 bg-gray-100 px-4 text-sm text-[#1A2B42] transition hover:border-[#1A2B42] hover:text-[#1A2B42]">
                                    {{ $dayLabel }}
                                </span>
                            </label>
                        @endforeach
                    </div>

                    <div class="mt-6 grid gap-6 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-[#1A2B42]" for="work_start">Début</label>
                            <input id="work_start" name="work_start" type="time" value="{{ old('work_start', $profile->work_start) }}" class="mt-2 block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-[#1A2B42] focus:border-[#1A2B42] focus:ring-[#1A2B42]" />
                            @error('work_start')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-[#1A2B42]" for="work_end">Fin</label>
                            <input id="work_end" name="work_end" type="time" value="{{ old('work_end', $profile->work_end) }}" class="mt-2 block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-[#1A2B42] focus:border-[#1A2B42] focus:ring-[#1A2B42]" />
                            @error('work_end')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <div class="rounded-xl border border-gray-200 bg-white p-6 text-right shadow-sm">
                    <button type="submit" class="inline-flex items-center justify-center rounded-full bg-[#1A2B42] px-8 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#15203a]">
                        <span class="mr-2">💾</span> Enregistrer mon profil
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function lawyerProfileForm() {
            return {
                specialties: @json(array_map('strval', $initialSpecialties)),
                toggleSpecialty(id) {
                    const index = this.specialties.indexOf(id);
                    if (index === -1) {
                        this.specialties.push(id);
                    } else {
                        this.specialties.splice(index, 1);
                    }
                },
            };
        }

        function languageForm() {
            return {
                languages: @json($initialLanguages),
                languageInput: '',
                addLanguage() {
                    const value = this.languageInput.trim();
                    if (!value) return;
                    if (!this.languages.includes(value)) {
                        this.languages.push(value);
                    }
                    this.languageInput = '';
                },
                removeLanguage(index) {
                    this.languages.splice(index, 1);
                },
            };
        }
    </script>
</x-app-layout>
