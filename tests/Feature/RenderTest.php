<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RenderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_pages_public()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response = $this->get('/privacy');
        $response->assertStatus(200);
        $response = $this->get('/notation');
        $response->assertStatus(200);
        $response = $this->get('/about');
        $response->assertStatus(200);
        $response = $this->get('/cart');
        $response->assertStatus(200);
        $response = $this->get('/detail/1');
        $response->assertStatus(200);
    }

    public function test_pages_admin()
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/login/admin');
        $response = $this->get('/admin/product/list/');
        $response->assertStatus(302);
        $response = $this->get('/admin/product/create/');
        $response->assertStatus(302);
        $response = $this->get('/admin/product/edit/{id}/');
        $response->assertStatus(302);
        $response = $this->get('/admin/product/edit/{id}/');
        $response->assertStatus(302);
        $response = $this->get('/admin/product/list/trash');
        $response->assertStatus(302);
        $response = $this->post('/admin/product/create/confirm/');
        $response->assertStatus(302);
        $response = $this->post('/admin/product/create/store/');
        $response->assertStatus(302);
        $response = $this->post('/admin/product/edit/{id}');
        $response->assertStatus(302);
        $response = $this->post('/admin/product/delete/{id}');
        $response->assertStatus(302);
        $response = $this->post('/admin/product/delete/complete/{id}');
        $response->assertStatus(302);
        $response = $this->post('/admin/product/delete/return/{id}');
        $response->assertStatus(302);
    }
}