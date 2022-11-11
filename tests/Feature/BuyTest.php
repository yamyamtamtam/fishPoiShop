<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class BuyTest extends TestCase
{
    public function test_buy_success_straight()
    {
        parent::setUp();
        $user = User::factory(User::class)->create([
            'password' => bcrypt('testtest')
        ]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'testtest'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
        /**先にSeederを動かしてサンプル商品は登録しておく */
        $response = $this->get('/detail/1');
        $response->assertStatus(200);
        $response = $this->post('/detail/add/1', [
            'num' => 1
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $cartArray[1] = [
            'name' => '金魚ポイ',
            'currentPrice' => 2000,
            'image' => 'default/sampleGoldFish.png',
            'num' => 1
        ];
        $response = $this->session(['cart' => $cartArray]);
        $response = $this->get('/detail/2');
        $response->assertStatus(200);
        $response = $this->post('/detail/add/2', [
            'num' => 2
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $cartArray[2] = [
            'name' => 'くらげポイ',
            'currentPrice' => 1400,
            'image' => 'default/sampleJellyFish.png',
            'num' => 2
        ];
        $response = $this->session(['cart' => $cartArray]);
        $response = $this->get('/cart');
        $response->assertStatus(200);
        //テストデータはid=1が2000円、id=2がセール価格適用で1400円となっている。合計は4800円になるはず
        $response->assertSee('4800');
        //id=1を2個に個数変更する
        $response = $this->post('/cart/delivery', [
            'name1' => '金魚ポイ',
            'currentPrice1' => 2000,
            'image1' => 'default/sampleGoldFish.png',
            'num1' => 2,
            'name2' => 'くらげポイ',
            'currentPrice2' => 1400,
            'image2' => 'default/sampleJellyFish.png',
            'num2' => 2,
            'total' => 4800
        ]);
        $response->assertStatus(200);
        $response->assertSee('6800');
        $response = $this->post('/cart/confirm', [
            'name1' => '金魚ポイ',
            'currentPrice1' => 2000,
            'image1' => 'default/sampleGoldFish.png',
            'num1' => 2,
            'name2' => 'くらげポイ',
            'currentPrice2' => 1400,
            'image2' => 'default/sampleJellyFish.png',
            'num2' => 2,
            'total' => 6800,
            'deliveryName' => '魚好食夫',
            'deliveryPostal' => '036-8227',
            'deliveryAddress' => '青森県弘前市桔梗野1-2-3',
            'deliveryTel' => '00000000000',
            'deliveryMail' => '4leafclover1214@gmail.com'
        ]);
        $response->assertStatus(200);
        $response = $this->post('/cart/thanks', [
            'name1' => '金魚ポイ',
            'currentPrice1' => 2000,
            'image1' => 'default/sampleGoldFish.png',
            'num1' => 2,
            'name2' => 'くらげポイ',
            'currentPrice2' => 1400,
            'image2' => 'default/sampleJellyFish.png',
            'num2' => 2,
            'total' => 6800,
            'deliveryName' => '魚好食夫',
            'deliveryPostal' => '036-8227',
            'deliveryAddress' => '青森県弘前市桔梗野1-2-3',
            'deliveryTel' => '00000000000',
            'deliveryMail' => '4leafclover1214@gmail.com'
        ]);
        $response->assertStatus(200);
        //実際にメールを送るテストを書かないとテストになっていないのでは？要検討
    }
}