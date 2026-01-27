<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
