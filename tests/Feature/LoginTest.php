<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory(User::class)->create([
            'password' => bcrypt('testtest')
        ]);
    }

    public function test_login_success()
    {
        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'testtest'
        ]);
        $response->assertStatus(302);
        $this->assertAuthenticatedAs($this->user);
    }

    public function test_login_faliled_password()
    {
        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'test'
        ]);
        $response->assertStatus(302);
        $this->assertGuest();
    }

    public function test_login_faliled_email()
    {
        $response = $this->post('/login', [
            'email' => 'test@gmail.com',
            'password' => 'testtest'
        ]);
        $response->assertStatus(302);
        $this->assertGuest();
    }

    public function test_logout()
    {
        $response = $this->actingAs($this->user);
        $response = $this->post('/logout');
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response = $this->assertGuest();
    }

    public function test_remember_password()
    {
    }

    public function test_forgot_password()
    {
    }
}