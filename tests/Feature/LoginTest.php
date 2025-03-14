<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test de connexion avec des informations valides.
     *
     * @return void
     */
    public function test_login_with_valid_credentials()
    {
        // Crée un utilisateur avec des données valides
        $user = User::factory()->create([
            'email' => 'houssamlam@live.fr',
            'password' => bcrypt('kawtar123'), // Assurez-vous que le mot de passe est crypté
        ]);

        // Envoie une requête POST avec les données du formulaire de connexion
        $response = $this->post('/login', [
            'email' => 'houssamlam@live.fr',
            'password' => 'kawtar123',
        ]);

        // Vérifie que l'utilisateur est bien connecté
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test de connexion avec des informations invalides.
     *
     * @return void
     */
    public function test_login_with_invalid_credentials()
    {
        // Envoie une requête POST avec des informations de connexion invalides
        $response = $this->post('/login', [
            'email' => 'wronguser@example.com',
            'password' => 'wrongpassword',
        ]);

        // Vérifie que la réponse contient une erreur de validation
        $response->assertSessionHasErrors(['email']);
    }
}
