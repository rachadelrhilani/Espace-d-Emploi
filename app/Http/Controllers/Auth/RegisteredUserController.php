<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ProfilCandidat;
use App\Models\ProfilRecruteur;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'role' => 'required|in:recruteur,candidat',

            // Recruteur
            'nom_entreprise' => 'required_if:role,recruteur',
            'localisation' => 'required_if:role,recruteur',

            // Candidat
            'specialite' => 'required_if:role,candidat',
            'annees_experience' => 'required_if:role,candidat|integer|min:0',
        ]);

        $user = User::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        if ($request->role === 'recruteur') {
            ProfilRecruteur::create([
                'user_id' => $user->id,
                'nom_entreprise' => $request->nom_entreprise,
                'description_entreprise' => $request->description_entreprise,
                'site_web' => $request->site_web,
                'localisation' => $request->localisation,
            ]);
        }

        if ($request->role === 'candidat') {
            ProfilCandidat::create([
                'user_id' => $user->id,
                'specialite' => $request->specialite,
                'annees_experience' => $request->annees_experience,
                'competences' => $request->competences,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
