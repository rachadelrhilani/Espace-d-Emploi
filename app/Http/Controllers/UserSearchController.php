<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserSearchController extends Controller
{
    public function index(Request $request)
    {
        $term = $request->get('q');

        $users = User::with(['profilRecruteur', 'profilCandidat'])
            ->when($term, function ($query) use ($term) {
                $query->search($term);
            })
            ->where('id', '!=', auth()->id()) // éviter soi-même
            ->paginate(10);

        return view('users.search', compact('users', 'term'));
    }
}
