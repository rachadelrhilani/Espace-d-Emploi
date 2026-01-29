<?php

namespace App\Http\Controllers;

use App\Models\Amitie;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AmitieController extends Controller
{
    public function store(User $user)
{
    $auth = Auth::user();

    if ($auth->id === $user->id) {
        return response()->json(['message' => 'Action interdite'], 403);
    }

    $exists = Amitie::where(function ($q) use ($auth, $user) {
        $q->where('id_expediteur', $auth->id)
          ->where('id_destinataire', $user->id);
    })->orWhere(function ($q) use ($auth, $user) {
        $q->where('id_expediteur', $user->id)
          ->where('id_destinataire', $auth->id);
    })->first();

    if ($exists) {
        return response()->json([
            'status' => $exists->statut,
            'message' => 'Relation déjà existante'
        ]);
    }

    $amitie = Amitie::create([
        'id_expediteur' => $auth->id,
        'id_destinataire' => $user->id,
        'statut' => 'pending'
    ]);

    return response()->json([
        'status' => 'pending',
        'message' => 'Demande envoyée'
    ]);
}

}
