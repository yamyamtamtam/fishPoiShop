<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128)->comment('商品名');
            $table->decimal('price', 10, 0)->comment('税込価格');
            $table->decimal('sale', 10, 0)->nullable()->comment('税込セール価格');
            $table->string('code', 128)->nullable()->comment('商品コード');
            $table->integer('category_id', false, false)->nullable()->comment('カテゴリーid');
            $table->string('image', 128)->nullable()->comment('画像パス');
            $table->text('description')->comment('商品説明');
            $table->text('del_flg')->comment('削除フラグ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}