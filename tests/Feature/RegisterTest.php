<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Teste si un utilisateur peut s'inscrire avec des données valides.
     */
    public function test_user_can_register(): void
    {
        $userData = [
            'name' => 'Houssam',
            'email' => 'houssamlam@live.fr',
            'password' => 'kawtar123',
            'password_confirmation' => 'kawtar123',
        ];

        $response = $this->postJson('/api/register', $userData); // Vérifie bien la route correcte

        $this->assertDatabaseHas('users', [
            'email' => 'houssamlam@live.fr',
        ]);

        // Vérifier que l'utilisateur est bien authentifié
        $this->assertAuthenticated();

        $response->assertStatus(201); // Vérifie que la requête réussit
    }
}
