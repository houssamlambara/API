<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() // GET
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // POST
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Authentifier l'utilisateur après l'inscription
        Auth::login($user);

        // Si tu utilises Laravel Sanctum, retourne un token
        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json(['message' => 'Inscription réussie', 'user' => $user, 'token' => $token], 201);
    }

    public function login(Request $request)
    {
        // Valider les données envoyées
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Vérifier les informations d'identification
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            // Si tu utilises Laravel Sanctum (API)
            $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;
            return response()->json(['token' => $token], 200);
        }

        // Si échec d'authentification
        return back()->withErrors(['email' => 'Email ou mot de passe incorrect.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Déconnexion réussie.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) //GET
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) // PUT
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) //DELETE
    {
        //
    }
}
