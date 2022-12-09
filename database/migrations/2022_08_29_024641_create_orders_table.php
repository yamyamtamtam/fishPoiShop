<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('status', 20)->comment('ステータス');
            $table->string('product_id', 128)->comment('商品id');
            $table->decimal('user_id', 10, 0)->comment('購入ユーザー');
            $table->decimal('prices', 10, 0)->comment('購入時点の金額');
            $table->decimal('count', 2, 0)->comment('購入個数');
            $table->dateTime('bought_data')->comment('購入日時');
            $table->text('delivery_name')->comment('お届け先お名前');
            $table->string('delivery_postal', 9)->comment('お届け先郵便番号');
            $table->text('delivery_address')->comment('お届け先住所');
            $table->string('delivery_tel', 16)->comment('電話番号');
            $table->text('delivery_mail')->comment('メールアドレス');
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
        Schema::dropIfExists('orders');
    }
}