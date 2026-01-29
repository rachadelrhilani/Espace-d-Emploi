<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $user->load(['profilRecruteur', 'profilCandidat']);

        return view('users.show', compact('user'));
    }


    
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */


public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();
    $data = $request->validated();

    /* ================= USER ================= */
    $user->fill([
        'nom' => $data['nom'],
        'email' => $data['email'],
        'biographie' => $data['biographie'] ?? $user->biographie,
    ]);

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    /* ================= PHOTO ================= */
    if ($request->hasFile('photo')) {

        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->photo = $request->file('photo')->store('photos', 'public');
    }

    $user->save();

    /* ================= CANDIDAT ================= */
    if ($user->role === 'candidat') {

        $user->profilCandidat()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'specialite' => $data['specialite'] ?? null,
                'annees_experience' => $data['annees_experience'] ?? null,
                'competences' => $data['competences'] ?? null,
            ]
        );
    }

    /* ================= RECRUTEUR ================= */
    if ($user->role === 'recruteur') {

        $user->profilRecruteur()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'nom_entreprise' => $data['nom_entreprise'] ?? null,
                'site_web' => $data['site_web'] ?? null,
                'localisation' => $data['localisation'] ?? null,
            ]
        );
    }

    return Redirect::route('profile.edit')
        ->with('status', 'profile-updated');
}


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
