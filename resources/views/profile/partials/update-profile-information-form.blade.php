<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your profile information.") }}
        </p>
    </header>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')
        {{-- Photo de profil --}}
        <div>
            <x-input-label for="photo" value="Photo de profil" />
            @if($user->photo)
                <div class="mt-2 mb-4">
                    <img src="{{ asset('storage/' . $user->photo) }}" alt="Profile" class="h-20 w-20 rounded-full object-cover border-2 border-indigo-500">
                </div>
            @endif
            <input 
                id="photo" 
                name="photo" 
                type="file" 
                accept="image/*"
                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" 
            />
            <x-input-error class="mt-2" :messages="$errors->get('photo')" />
        </div>
        {{-- Nom --}}
        <div>
            <x-input-label for="nom" value="Nom complet" />
            <x-text-input
                id="nom"
                name="nom"
                type="text"
                class="mt-1 block w-full"
                value="{{ old('nom', $user->nom) }}"
                required
            />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full"
                value="{{ old('email', $user->email) }}"
                required
            />
        </div>
        {{-- Biographie (Général) --}}
        <div>
            <x-input-label for="biographie" value="Biographie" />
            <textarea
                id="biographie"
                name="biographie"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                rows="4"
                placeholder="Décrivez votre parcours en quelques mots..."
            >{{ old('biographie', $user->biographie) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('biographie')" />
        </div>

        {{-- ================= CANDIDAT ================= --}}
        @if ($user->role === 'candidat')
            <div class="border-t pt-6">
                <h3 class="font-semibold text-gray-700 mb-4">Profil Candidat</h3>

                <div>
                    <x-input-label for="specialite" value="Spécialité" />
                    <x-text-input
                        id="specialite"
                        name="specialite"
                        type="text"
                        class="mt-1 block w-full"
                        value="{{ old('specialite', $user->profilCandidat->specialite ?? '') }}"
                    />
                </div>

                <div>
                    <x-input-label for="annees_experience" value="Années d'expérience" />
                    <x-text-input
                        id="annees_experience"
                        name="annees_experience"
                        type="number"
                        class="mt-1 block w-full"
                        value="{{ old('annees_experience', $user->profilCandidat->annees_experience ?? '') }}"
                    />
                </div>

                <div>
                    <x-input-label for="competences" value="Compétences" />
                    <textarea
                        name="competences"
                        class="mt-1 block w-full rounded-md border-gray-300"
                        rows="3"
                    >{{ old('competences', $user->profilCandidat->competences ?? '') }}</textarea>
                </div>
            </div>
        @endif

        {{-- ================= RECRUTEUR ================= --}}
        @if ($user->role === 'recruteur')
            <div class="border-t pt-6">
                <h3 class="font-semibold text-gray-700 mb-4">Profil Recruteur</h3>

                <div>
                    <x-input-label for="nom_entreprise" value="Nom de l'entreprise" />
                    <x-text-input
                        id="nom_entreprise"
                        name="nom_entreprise"
                        type="text"
                        class="mt-1 block w-full"
                        value="{{ old('nom_entreprise', $user->profilRecruteur->nom_entreprise ?? '') }}"
                    />
                </div>

                <div>
                    <x-input-label for="site_web" value="Site web" />
                    <x-text-input
                        id="site_web"
                        name="site_web"
                        type="url"
                        class="mt-1 block w-full"
                        value="{{ old('site_web', $user->profilRecruteur->site_web ?? '') }}"
                    />
                </div>

                <div>
                    <x-input-label for="localisation" value="Localisation" />
                    <x-text-input
                        id="localisation"
                        name="localisation"
                        type="text"
                        class="mt-1 block w-full"
                        value="{{ old('localisation', $user->profilRecruteur->localisation ?? '') }}"
                    />
                </div>
            </div>
        @endif

        {{-- Bouton --}}
        <div class="flex items-center gap-4">
            <x-primary-button>Enregistrer</x-primary-button>
        </div>
    </form>
</section>
