<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
{
    $users = null;
    if ($request->filled('q')) {
        $users = User::with(['profilCandidat', 'profilRecruteur'])
            ->search($request->q)
            ->where('id', '!=', Auth::id())
            ->get();
    }

    return view('dashboard', compact('users'));
}

}
