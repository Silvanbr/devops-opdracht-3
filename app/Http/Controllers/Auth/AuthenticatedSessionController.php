<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function store(Request $request)
    {
        // Validatie van de request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // "Onthoud mij" functionaliteit
        $remember = $request->filled('remember');

        // Authenticatie poging
        if (Auth::attempt($request->only('email', 'password'), $remember)) {
            // Regenereren van de sessie
            if(!$remember) {
                $request->session()->regenerate();
            }

            // Redirect naar de bedoelde pagina
            return redirect()->intended('/bars'); // Pas dit aan naar de gewenste route
        }

        // Terugkeren met foutmelding bij mislukte authenticatie
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login'); // Redirect naar de homepage of een andere gewenste route na uitloggen
    }
}
