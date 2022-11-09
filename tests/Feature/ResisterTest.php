<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;


class ResisterTest extends TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->make([
            'password' => bcrypt('testtest'),
            'remember_token' => null,
            'email_verified_at' => null
        ]);
    }
    public function test_resister_success()
    {
        $response = $this->post('/register', [
            'name' => $this->user->name,
            'email' => $this->user->email,
            'password' => 'testtest',
            'password_confirmation' => 'testtest'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertAuthenticated();
    }
    public function test_resister_faliled_password_digits()
    {
        $response = $this->post('/register', [
            'name' => $this->user->name,
            'email' => $this->user->email,
            'password' => 'test',
            'password_confirmation' => 'test'

        ]);
        $response->assertStatus(302);
        $this->assertGuest();
    }

    public function test_resister_faliled_password_confirmation()
    {
        $response = $this->post('/register', [
            'name' => $this->user->name,
            'email' => $this->user->email,
            'password' => 'testtest',
            'password_confirmation' => 'testtesttest'

        ]);
        $response->assertStatus(302);
        $this->assertGuest();
    }

    public function test_resister_faliled_email_already_exist()
    {
        $response = $this->post('/register', [
            'name' => $this->user->name,
            'email' => '4leafclover1214@gmail.com',
            'password' => 'testtest',
            'password_confirmation' => 'testtesttest'

        ]);
        $response->assertStatus(302);
        $this->assertGuest();
    }
}