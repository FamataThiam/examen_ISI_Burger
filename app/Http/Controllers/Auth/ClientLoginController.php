<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class ClientLoginController extends Controller
{
    public function showLogin()
    {

        if (Auth::guard('client')->check()) {
            return redirect()->route('dashboard');
        }

        session()->forget('_old_input');  /// Vide les anciennes données du formulaire
        return view('layout.login');
    }


    public function login(Request $request)
    {

        if (! $request->filled('email') || ! $request->filled('password')) {
            return back()->withErrors(['login_error' => 'Veuillez remplir tous les champs.']);

        }

        $client = \App\Models\Client::where('email', $request->email)->first();

        if (! $client || ! \Illuminate\Support\Facades\Hash::check($request->password, $client->password)) {
            return back()
                ->withErrors(['login_error' => 'Adresse e-mail ou mot de passe incorrect.']);

        }

        Auth::guard('client')->login($client);
        $request->session()->regenerate();

        return redirect()->route('dashboard')
            ->with('success', 'Connexion réussie !');
    }


    public function register(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'nom'                  => ['required', 'string', 'max:255'],
            'prenom'               => ['required', 'string', 'max:255'],
            'email'                => ['required', 'email', 'unique:clients,email'],
            'adresse'              => ['required', 'string', 'max:255'],
            'password'             => ['required', 'confirmed', Password::defaults()],
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                // Garde nom/prenom/email mais JAMAIS les mots de passe
                ->withInput($request->except(['password', 'password_confirmation']))
                // Dit au blade d'afficher l'onglet register avec les erreurs
                ->with('active_tab', 'register');
        }

        $client = Client::create([
            'nom'      => $request->nom,
            'prenom'   => $request->prenom,
            'email'    => $request->email,
            'adresse'  => $request->adresse,
            'password' => Hash::make($request->password),
            'role'     => 'client',
        ]);

        Auth::guard('client')->login($client);
        $request->session()->regenerate();

        return redirect()->route('dashboard')
            ->with('success', 'Inscription réussie !');
    }

   // Deconnexion
    public function logout(Request $request)
    {
        Auth::guard('client')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
