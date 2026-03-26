<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ClientLoginController extends Controller
{
    public function showLogin()
    {
        return view('layout.login');
    }

    // Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        $client = Client::where('email', $request->email)->first();

        if (!$client || !Hash::check($request->password, $client->password)) {
            return back()->withErrors(['login_error' => 'Adresse e-mail ou mot de passe incorrect.'])->withInput();
        }

        // ⚡ Utiliser le guard 'client'
        Auth::guard('client')->login($client);

        return redirect()->route('dashboard');
    }

    // Inscription
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $names = explode(' ', $request->name, 2);
        $nom = $names[0];
        $prenom = $names[1] ?? '';

        $client = Client::create([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'client',
        ]);

        Auth::guard('client')->login($client);

        return redirect()->route('dashboard');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::guard('client')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
