<x-guest-layout>
    <div class="flex items-center justify-center p-4 min-h-[calc(100vh-200px)]">
        <div class="w-full max-w-3xl bg-white/95 backdrop-blur-sm rounded-[2.5rem] shadow-2xl overflow-hidden border border-white/20 z-10 flex flex-col md:flex-row max-h-[85vh]">
            
            <div class="bg-gradient-to-br from-indigo-600 to-violet-700 md:w-5/12 p-10 text-white flex flex-col justify-center items-center text-center shrink-0">
                <div class="w-20 h-20 bg-white/20 rounded-3xl mb-6 flex items-center justify-center backdrop-blur-md shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                </div>
                <h2 class="text-3xl font-black tracking-tight uppercase">Connexion</h2>
                <p class="text-indigo-100 mt-3 font-medium">Ravi de vous revoir !</p>
                
                <div class="mt-8 pt-8 border-t border-white/10 w-full">
                    <p class="text-xs text-indigo-200">Pas encore membre ?</p>
                    <a href="{{ route('register') }}" class="inline-block mt-2 px-6 py-2 bg-white text-indigo-600 rounded-xl font-bold text-sm transition-transform hover:scale-105 active:scale-95">
                        Créer un compte
                    </a>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto custom-scrollbar bg-white">
                <form method="POST" action="{{ route('login') }}" class="p-10 space-y-8">
                    @csrf

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <div class="space-y-2">
                        <label class="text-[11px] font-bold text-indigo-600 uppercase ml-1 tracking-wider">Adresse Email</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                            <input id="email" type="email" name="email" :value="old('email')" required autofocus
                                class="pl-11 block w-full border-none bg-gray-50 rounded-2xl py-4 focus:ring-4 focus:ring-indigo-500/10 focus:bg-white transition-all duration-300 shadow-sm" 
                                placeholder="votre@email.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center ml-1">
                            <label class="text-[11px] font-bold text-indigo-600 uppercase tracking-wider">Mot de passe</label>
                            @if (Route::has('password.request'))
                                <a class="text-[11px] font-bold text-gray-400 hover:text-indigo-600 transition-colors uppercase" href="{{ route('password.request') }}">
                                    Oublié ?
                                </a>
                            @endif
                        </div>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                            <input id="password" type="password" name="password" required
                                class="pl-11 block w-full border-none bg-gray-50 rounded-2xl py-4 focus:ring-4 focus:ring-indigo-500/10 focus:bg-white transition-all duration-300 shadow-sm"
                                placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <div class="flex items-center">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                            <input id="remember_me" type="checkbox" class="rounded-lg border-gray-200 text-indigo-600 shadow-sm focus:ring-indigo-500 w-5 h-5 transition-all cursor-pointer" name="remember">
                            <span class="ms-3 text-sm font-semibold text-gray-500 group-hover:text-indigo-600 transition-colors">Rester connecté</span>
                        </label>
                    </div>

                    <div class="pt-4 sticky bottom-0 bg-white pb-2">
                        <button type="submit" 
                            class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black text-xl rounded-2xl shadow-xl shadow-indigo-100 transition-all transform hover:-translate-y-1 active:scale-95">
                            Se connecter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
    </style>
</x-guest-layout>