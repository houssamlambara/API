<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    public function store(Request $request) //POST
    {
        $request->name;
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->JSON($request);
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
