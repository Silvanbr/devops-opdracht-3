<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisteredUserController extends Controller
{
    public function store(Request $request)
    {
        // Validatie van de request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Aanmaken van de nieuwe gebruiker
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Automatisch inloggen van de gebruiker
        Auth::loginUsingId($user->id, false);

        $request->session()->regenerate();

        // Redirect naar de gewenste pagina
        return redirect('/bars'); // Pas dit aan naar de gewenste route
    }
}
