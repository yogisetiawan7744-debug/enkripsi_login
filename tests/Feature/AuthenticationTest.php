<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_stores_a_hashed_password_and_authenticates_the_user(): void
    {
        $response = $this->post('/register', [
            'name' => 'Ayu',
            'email' => 'ayu@example.com',
            'password' => 'password-aman',
            'password_confirmation' => 'password-aman',
        ]);

        $user = User::where('email', 'ayu@example.com')->firstOrFail();

        $this->assertNotSame('password-aman', $user->password);
        $this->assertTrue(Hash::check('password-aman', $user->password));
        $this->assertAuthenticatedAs($user);
        $response->assertRedirect('/dashboard');
    }

    public function test_login_and_dashboard_require_valid_authentication(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password-aman'),
        ]);

        $this->get('/dashboard')->assertRedirect('/login');

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password-aman',
        ])->assertRedirect('/dashboard');

        $this->assertAuthenticatedAs($user);
        $this->get('/dashboard')->assertOk();
    }

    public function test_logout_ends_the_authenticated_session(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post('/logout')
            ->assertRedirect('/login');

        $this->assertGuest();
    }
}
