<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Admin;

class AdminLoginTest extends TestCase
{
    protected $admin;

    public function setUp(): void
    {
        parent::setUp();
        $this->admin = Admin::factory(Admin::class)->create([
            'password' => bcrypt('testtest')
        ]);
    }
    public function test_admin_login_redirect()
    {
        $response = $this->get('/admin');
        $response->assertStatus(302);
        $response->assertRedirect('/login/admin');
        $response = $this->get('/admin/product/list/');
        $response->assertStatus(302);
        $response->assertRedirect('/login/admin');
        $response = $this->get('/admin/product/create/');
        $response->assertStatus(302);
        $response->assertRedirect('/login/admin');
        $response = $this->get('/admin/product/edit/1');
        $response->assertStatus(302);
        $response->assertRedirect('/login/admin');
        $response = $this->get('/admin/product/list/trash');
        $response->assertStatus(302);
        $response->assertRedirect('/login/admin');
        $response = $this->post('/admin/product/create/confirm/');
        $response->assertStatus(302);
        $response->assertRedirect('/login/admin');
        $response = $this->post('/admin/product/create/store/');
        $response->assertStatus(302);
        $response->assertRedirect('/login/admin');
        $response = $this->post('/admin/product/edit/1');
        $response->assertStatus(302);
        $response->assertRedirect('/login/admin');
        $response = $this->post('/admin/product/delete/1');
        $response->assertStatus(302);
        $response->assertRedirect('/login/admin');
    }

    public function test_admin_login_success()
    {
        $response = $this->get('/login/admin');
        $response->assertStatus(200);

        $response = $this->post('/login/admin', [
            'email' => $this->admin->email,
            'password' => 'testtest'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/admin');
        $response->assertSeeText($this->admin->user);
        $response->assertSeeText($this->admin->mail);
    }

    public function test_admin_login_faliled_password()
    {
        $response = $this->post('/login/admin', [
            'email' => $this->admin->email,
            'password' => 'test'
        ]);
        $response->assertStatus(302);
        $this->assertGuest();
    }

    public function test_admin_login_faliled_email()
    {
        $response = $this->post('/login/admin', [
            'email' => 'test@gmail.com',
            'password' => 'testtest'
        ]);
        $response->assertStatus(302);
        $this->assertGuest();
    }
    public function test_admin_logout()
    {
        $response = $this->actingAs($this->admin);
        $response = $this->post('/logout');
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $response = $this->assertGuest();
    }
}