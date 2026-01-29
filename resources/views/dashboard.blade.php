<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tableau de bord
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            
            <div class="bg-white shadow-sm rounded-xl p-6">
                <h3 class="text-lg font-bold">
                    Bienvenue {{ auth()->user()->nom }} 👋
                </h3> 
                <p class="text-sm text-gray-500">
                    Vous êtes connecté en tant que
                    <span class="font-semibold text-indigo-600">
                        {{ ucfirst(auth()->user()->role) }}
                    </span>
                </p>
            </div>

 
            <div class="bg-white shadow-sm rounded-xl p-6">
                <h4 class="font-semibold mb-4 text-gray-700">
                    Rechercher un utilisateur
                </h4>

                <form method="GET" action="{{ route('dashboard') }}">
                    <div class="flex gap-3">
                        <input
                            type="text"
                            name="q"
                            placeholder="Nom ou spécialité..."
                            class="flex-1 rounded-lg border-gray-300 px-4 py-2 focus:ring-indigo-500"
                        />
                        <button
                            class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition"
                        >
                            Rechercher
                        </button>
                    </div>
                </form>
            </div>

          @isset($users)
<div class="bg-white shadow-sm rounded-xl p-6">
    <h4 class="font-semibold mb-4 text-gray-700">
        Résultats
    </h4>

    <div class="grid md:grid-cols-2 gap-4">
        @forelse($users as $user)
            <div class="flex gap-4 border rounded-xl p-4 hover:shadow transition">

                {{-- PHOTO --}}
                <img
                    src="{{ $user->photo
                        ? asset('storage/'.$user->photo)
                        : asset('images/avatar.png') }}"
                    alt="Photo"
                    class="h-16 w-16 rounded-full object-cover border"
                />

                <div class="flex-1">
                    <h5 class="font-bold">{{ $user->nom }}</h5>

                    <p class="text-sm text-gray-500">
                        {{ ucfirst($user->role) }}
                    </p>

                    {{-- BIO --}}
                    @if($user->biographie)
                        <p class="text-sm text-gray-600 mt-1 line-clamp-2">
                            {{ $user->biographie }}
                        </p>
                    @endif

                    {{-- ===== CANDIDAT ===== --}}
                    @if($user->role === 'candidat' && $user->profilCandidat)
                        @if($user->profilCandidat->specialite)
                            <p class="text-sm text-indigo-600 mt-1">
                                🎯 {{ $user->profilCandidat->specialite }}
                            </p>
                        @endif

                        @if($user->profilCandidat->annees_experience !== null)
                            <p class="text-xs text-gray-500">
                                {{ $user->profilCandidat->annees_experience }} ans d’expérience
                            </p>
                        @endif
                    @endif

                    {{-- ===== RECRUTEUR ===== --}}
                    @if($user->role === 'recruteur' && $user->profilRecruteur)
                        @if($user->profilRecruteur->nom_entreprise)
                            <p class="text-sm text-indigo-600 mt-1">
                                🏢 {{ $user->profilRecruteur->nom_entreprise }}
                            </p>
                        @endif

                        @if($user->profilRecruteur->localisation)
                            <p class="text-xs text-gray-500">
                                📍 {{ $user->profilRecruteur->localisation }}
                            </p>
                        @endif
                    @endif

                    <a
                        href="{{ route('users.show', $user) }}"
                        class="inline-block mt-2 text-indigo-600 font-semibold text-sm hover:underline"
                    >
                        Voir le profil →
                    </a>
                </div>
            </div>
        @empty
            <p class="text-gray-500">Aucun utilisateur trouvé.</p>
        @endforelse
    </div>
</div>
@endisset

</x-app-layout>
