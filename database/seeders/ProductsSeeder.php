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
                'name' => 'テスト',
                'price' => 1000,
                'sale' => '500',
                'code' => 'A0001',
                'category_id' => 1,
                'image' => asset('/storage/app/public24450752_s.jpg'),
                'description' => 'テスト',
                'del_flg' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}