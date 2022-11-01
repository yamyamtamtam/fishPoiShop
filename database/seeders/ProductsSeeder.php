<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => '金魚ポイ',
                'price' => 2000,
                'sale' => NULL,
                'code' => 'A0001',
                'category_id' => NULL,
                'image' => 'default/sampleGoldFish.png',
                'description' => '（これはサンプルの商品です。購入しても商品は届きません。）<br>金魚の形のポイです。ポイを回す様子はまるで本物の金魚が泳ぐよう。',
                'del_flg' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'くらげポイ',
                'price' => 1800,
                'sale' => 1400,
                'code' => 'A0002',
                'category_id' => NULL,
                'image' => 'default/sampleJellyFish.png',
                'description' => '（これはサンプルの商品です。購入しても商品は届きません。）<br>くらげの形のポイです。透明感のあるくらげのようなポイを幻想的に回しましょう。',
                'del_flg' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}