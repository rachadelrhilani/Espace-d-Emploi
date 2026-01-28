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

    // mise à jour
    $user->fill($request->validated());

    // Si email changé → reset vérification
    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    // 📸 UPLOAD PHOTO
    if ($request->hasFile('photo')) {

        // Supprimer ancienne photo si existe
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        // Stocker la nouvelle photo
        $path = $request->file('photo')->store('photos', 'public');

        // Sauvegarder le chemin en DB
        $user->photo = $path;
    }

    $user->save();

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
