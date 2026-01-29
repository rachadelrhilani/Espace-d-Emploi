<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white mt-3 rounded-2xl shadow space-y-6">

        {{-- HEADER --}}
        <div class="flex items-center gap-4">
            <img
                src="{{ $user->photo
                    ? asset('storage/'.$user->photo)
                    : asset('images/avatar.png') }}"
                alt="Photo"
                class="h-24 w-24 rounded-full object-cover border"
            />

            <div>
                <h1 class="text-2xl font-black">{{ $user->nom }}</h1>
                <p class="text-gray-500">
                    {{ ucfirst($user->role) }}
                </p>

                @if($user->biographie)
                    <p class="text-sm text-gray-600 mt-2 max-w-xl">
                        {{ $user->biographie }}
                    </p>
                @endif
            </div>
        </div>

        {{-- ================= CANDIDAT ================= --}}
        @if($user->role === 'candidat' && $user->profilCandidat)
            <div class="border-t pt-6 space-y-3">
                <h2 class="font-bold text-lg text-indigo-600">
                    Profil Candidat
                </h2>

                @if($user->profilCandidat->specialite)
                    <p>
                        <strong>Spécialité :</strong>
                        {{ $user->profilCandidat->specialite }}
                    </p>
                @endif

                @if($user->profilCandidat->annees_experience !== null)
                    <p>
                        <strong>Expérience :</strong>
                        {{ $user->profilCandidat->annees_experience }} ans
                    </p>
                @endif

                @if($user->profilCandidat->competences)
                    <p>
                        <strong>Compétences :</strong><br>
                        {{ $user->profilCandidat->competences }}
                    </p>
                @endif

                @if($user->profilCandidat->cv)
                    <a
                        href="{{ asset('storage/'.$user->profilCandidat->cv) }}"
                        class="inline-block text-indigo-600 font-semibold mt-2 hover:underline"
                        target="_blank"
                        download
                    >
                        📄 Télécharger le CV
                    </a>
                @endif
            </div>
        @endif
        

        {{-- ================= RECRUTEUR ================= --}}
        @if($user->role === 'recruteur' && $user->profilRecruteur)
            <div class="border-t pt-6 space-y-3">
                <h2 class="font-bold text-lg text-indigo-600">
                    Profil Recruteur
                </h2>

                @if($user->profilRecruteur->nom_entreprise)
                    <p>
                        <strong>Entreprise :</strong>
                        {{ $user->profilRecruteur->nom_entreprise }}
                    </p>
                @endif

                @if($user->profilRecruteur->localisation)
                    <p>
                        <strong>Localisation :</strong>
                        {{ $user->profilRecruteur->localisation }}
                    </p>
                @endif

                @if($user->profilRecruteur->description_entreprise)
                    <p>
                        <strong>Description :</strong><br>
                        {{ $user->profilRecruteur->description_entreprise }}
                    </p>
                @endif

                @if($user->profilRecruteur->site_web)
                    <a
                        href="{{ $user->profilRecruteur->site_web }}"
                        target="_blank"
                        class="inline-block text-indigo-600 font-semibold hover:underline"
                    >
                        🌐 Visiter le site
                    </a>
                @endif
            </div>
        @endif
    </div>
    
</x-app-layout>
