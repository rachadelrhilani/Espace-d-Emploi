<x-guest-layout>
    <div class="flex items-center justify-center p-4 min-h-[calc(100vh-200px)]">
        <div class="w-full max-w-3xl bg-white/95 backdrop-blur-sm rounded-[2.5rem] shadow-2xl overflow-hidden border border-white/20 z-10 flex flex-col md:flex-row max-h-[90vh]">

            <div class="bg-gradient-to-br from-indigo-600 to-violet-700 md:w-1/3 p-8 text-white flex flex-col justify-center items-center text-center shrink-0">
                <div class="w-16 h-16 bg-white/20 rounded-2xl mb-4 flex items-center justify-center backdrop-blur-md">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <h2 class="text-2xl font-black tracking-tight uppercase">Inscription</h2>
                <p class="text-indigo-100 mt-2 text-sm">Créez votre profil professionnel.</p>
            </div>

            <div class="flex-1 overflow-y-auto custom-scrollbar bg-white">
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="p-8 space-y-5">
                    @csrf
                    @if ($errors->any())
                    <div class="bg-red-50 text-red-600 p-4 rounded-xl text-xs">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-indigo-600 uppercase ml-1">Nom complet</label>
                            <input name="nom" type="text" class="w-full border-gray-100 bg-gray-50 rounded-xl py-2.5 text-sm focus:ring-4 focus:ring-indigo-500/10 transition-all" placeholder="Ex: Karim B." required />
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-indigo-600 uppercase ml-1">Email</label>
                            <input name="email" type="email" class="w-full border-gray-100 bg-gray-50 rounded-xl py-2.5 text-sm focus:ring-4 focus:ring-indigo-500/10 transition-all" placeholder="karim@mail.com" required />
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="text-[10px] font-bold text-indigo-600 uppercase ml-1">Vous êtes ?</label>
                        <select id="role" name="role" required onchange="toggleFields()"
                            class="w-full border-gray-100 bg-gray-50 rounded-xl py-2.5 text-sm focus:ring-indigo-500/20 transition-all">
                            <option value="">Choisir...</option>
                            <option value="recruteur">🏢 Entreprise / Recruteur</option>
                            <option value="candidat">🚀 Candidat / Talent</option>
                        </select>
                    </div>

                    <div id="recruteur-fields" class="hidden grid grid-cols-2 gap-3 p-4 bg-indigo-50/50 rounded-2xl animate-fadeIn">
                        <input name="nom_entreprise" placeholder="Entreprise" class="border-none rounded-lg py-2 text-sm shadow-sm" />
                        <input name="site_web" placeholder="Site Web (URL)" class="border-none rounded-lg py-2 text-sm shadow-sm" />
                        <input name="localisation" placeholder="Ville" class="border-none rounded-lg py-2 text-sm shadow-sm" />
                        <textarea name="description_entreprise" rows="2" class="col-span-2 border-none rounded-lg text-sm shadow-sm" placeholder="Bref résumé..."></textarea>
                    </div>

                    <div id="candidat-fields" class="hidden grid grid-cols-2 gap-3 p-4 bg-purple-50/50 rounded-2xl animate-fadeIn">
                        <input name="specialite" placeholder="Spécialité" class="border-none rounded-lg py-2 text-sm shadow-sm" />
                        <input name="annees_experience" type="number" placeholder="Exp (ans)" class="border-none rounded-lg py-2 text-sm shadow-sm" />
                        <textarea name="competences" rows="3" class="col-span-2 border-none rounded-lg text-sm shadow-sm" placeholder="Listez vos compétences..."></textarea>
                        <input
                            type="file"
                            name="cv"
                            accept=".pdf,.doc,.docx"
                            class="col-span-2 border-none rounded-lg py-2 text-sm shadow-sm bg-white" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-indigo-600 uppercase ml-1">Mot de passe</label>
                            <input name="password" type="password" class="w-full border-gray-100 bg-gray-50 rounded-xl py-2.5 text-sm" required />
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-indigo-600 uppercase ml-1">Confirmer</label>
                            <input name="password_confirmation" type="password" class="w-full border-gray-100 bg-gray-50 rounded-xl py-2.5 text-sm" required />
                        </div>
                    </div>

                    <div class="pt-4 sticky bottom-0 bg-white pb-2">
                        <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg transition-all active:scale-95">
                            Finaliser l'inscription
                        </button>
                        <p class="text-center text-xs text-gray-400 mt-4">
                            Déjà inscrit ? <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:underline">Connexion</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }
    </style>

    <script>
        function toggleFields() {
            const role = document.getElementById('role').value;
            const rec = document.getElementById('recruteur-fields');
            const can = document.getElementById('candidat-fields');
            rec.classList.toggle('hidden', role !== 'recruteur');
            can.classList.toggle('hidden', role !== 'candidat');
        }
    </script>
</x-guest-layout>