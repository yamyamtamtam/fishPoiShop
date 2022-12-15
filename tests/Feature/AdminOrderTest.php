<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;

class AdminOrderTest extends TestCase
{
    public function test_buy_and_orders_show()
    {
        parent::setUp();
        $user = User::factory(User::class)->create([
            'password' => bcrypt('testtest')
        ]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'testtest'
        ]);
        $response = $this->post('/cart/thanks', [
            'name1' => '金魚ポイ',
            'currentPrice1' => 2000,
            'image1' => 'default/sampleGoldFish.png',
            'num1' => 3,
            'name2' => 'くらげポイ',
            'currentPrice2' => 1400,
            'image2' => 'default/sampleJellyFish.png',
            'num2' => 1,
            'total' => 7400,
            'deliveryName' => '管理画面登録テスト01',
            'deliveryPostal' => '036-8227',
            'deliveryAddress' => '青森県弘前市桔梗野1-2-3',
            'deliveryTel' => '00000000000',
            'deliveryMail' => '4leafclover1214@gmail.com'
        ]);
        $response->assertStatus(200);
        $response = $this->post('/logout');
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertGuest();

        $admin = Admin::factory(Admin::class)->create([
            'password' => bcrypt('testtest')
        ]);
        $response = $this->post('/login/admin', [
            'email' => $admin->email,
            'password' => 'testtest'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/admin');
        $response = $this->get('/admin/order/list');
        $response->assertSee('金魚ポイ');
        $response->assertSee('くらげポイ');
        $response->assertSee('管理画面登録テスト01');
        $response->assertSee('青森県弘前市桔梗野1-2-3');
        //ステータスを進める
        $response = $this->post('/admin/order/status/1');
        $response->assertStatus(302);
        $response->assertRedirect('/admin/order/list');
        $response = $this->get('/admin/order/list');
        $response->assertSee('連絡済み');
        $response = $this->post('/admin/order/status/1');
        $response->assertStatus(302);
        $response->assertRedirect('/admin/order/list');
        $response = $this->get('/admin/order/list');
        $response->assertSee('決済済み');
        $response = $this->post('/admin/order/status/1');
        $response->assertStatus(302);
        $response->assertRedirect('/admin/order/list');
        $response = $this->get('/admin/order/list');
        $response->assertSee('発送済み');
        $response = $this->post('/admin/order/status/1');
        $response->assertStatus(302);
        $response->assertRedirect('/admin/order/list');
        $response = $this->get('/admin/order/list');
        $response->assertSee('終了');
        //注文キャンセル
        $response = $this->post('/admin/order/cancel/2');
        $response->assertStatus(302);
        $response->assertRedirect('/admin/order/list');
        $response = $this->get('/admin/order/list');
        $response->assertSee('中断');
        $response = $this->post('/admin/order/status/2');
        $response->assertStatus(302);
        $response->assertRedirect('/admin/order/list');
        $response = $this->get('/admin/order/list');
        $response->assertSee('未対応');
    }
}