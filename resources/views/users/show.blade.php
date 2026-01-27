<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-2xl shadow">

        <h1 class="text-2xl font-black mb-2">{{ $user->nom }}</h1>
        <p class="text-gray-500 mb-4">{{ ucfirst($user->role) }}</p>

        {{-- PROFIL CANDIDAT --}}
        @if($user->role === 'candidat')
            <div class="space-y-3">
                <p><strong>Spécialité :</strong> {{ $user->profilCandidat->specialite }}</p>
                <p><strong>Expérience :</strong> {{ $user->profilCandidat->annees_experience }} ans</p>
                <p><strong>Compétences :</strong><br>{{ $user->profilCandidat->competences }}</p>

                @if($user->profilCandidat->cv)
                    <a href="{{ asset('storage/'.$user->profilCandidat->cv) }}"
                       class="text-indigo-600 font-bold"
                       target="_blank">
                        📄 Télécharger le CV
                    </a>
                @endif
            </div>
        @endif

        {{-- PROFIL RECRUTEUR --}}
        @if($user->role === 'recruteur')
            <div class="space-y-3">
                <p><strong>Entreprise :</strong> {{ $user->profilRecruteur->nom_entreprise }}</p>
                <p><strong>Localisation :</strong> {{ $user->profilRecruteur->localisation }}</p>
                <p><strong>Description :</strong><br>{{ $user->profilRecruteur->description_entreprise }}</p>
            </div>
        @endif

    </div>
</x-app-layout>
