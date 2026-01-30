<?php

namespace App\Http\Controllers;

use App\Models\Amitie;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AmitieController extends Controller
{

    public function invitations()
    {
        $invitations = Amitie::with('expediteur')
            ->where('id_destinataire', Auth::id())
            ->where('statut', 'pending')
            ->latest()
            ->get();

        return view('amis.invitations', compact('invitations'));
    }

    public function accept(Amitie $amitie)
    {
        abort_if($amitie->id_destinataire !== Auth::id(), 403);

        $amitie->update(['statut' => 'accepted']);

        return response()->json(['status' => 'accepted']);
    }

    public function reject(Amitie $amitie)
    {
        abort_if($amitie->id_destinataire !== Auth::id(), 403);

        $amitie->update(['statut' => 'rejected']);

        return response()->json(['status' => 'rejected']);
    }
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
    public function status(User $user)
    {
        $authId = Auth::id();
         $rejected = Amitie::where(function ($q) use ($authId, $user) {
            $q->where('id_expediteur', $authId)
                ->where('id_destinataire', $user->id);
        })
            ->orWhere(function ($q) use ($authId, $user) {
                $q->where('id_expediteur', $user->id)
                    ->where('id_destinataire', $authId);
            })
            ->where('statut', 'rejected')
            ->exists();

        if ($rejected) {
            return response()->json(['status' => 'rejected']);
        }
        $isFriend = Amitie::where(function ($q) use ($authId, $user) {
            $q->where('id_expediteur', $authId)
                ->where('id_destinataire', $user->id);
        })
            ->orWhere(function ($q) use ($authId, $user) {
                $q->where('id_expediteur', $user->id)
                    ->where('id_destinataire', $authId);
            })
            ->where('statut', 'accepted')
            ->exists();

        if ($isFriend) {
            return response()->json(['status' => 'friends']);
        }

        // Invitation déjà envoyée
        $pending =  Amitie::where(function ($q) use ($authId, $user) {
            $q->where('id_expediteur', $authId)
                ->where('id_destinataire', $user->id);
        })
            ->orWhere(function ($q) use ($authId, $user) {
                $q->where('id_expediteur', $user->id)
                    ->where('id_destinataire', $authId);
            })
            ->where('statut', 'pending')
            ->exists();

        if ($pending) {
            return response()->json(['status' => 'pending']);
        }

       
        return response()->json(['status' => 'none']);
    }
}
