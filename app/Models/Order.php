<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $primaryKey = 'id';

    protected $fillable = [
        'status',
        'product_id',
        'user_id',
        'prices',
        'count',
        'bought_data',
        'delivery_name',
        'delivery_postal',
        'delivery_address',
        'delivery_tel',
        'delivery_mail'
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function insertOrder($orders, $user_id, $deliveryName, $deliveryPostal, $deliveryAddress, $deliveryTel, $deliveryMail)
    {
        foreach ($orders as $key => $value) {
            $this->create([
                'status' => 'yet',
                'product_id' => $key,
                'user_id' => $user_id,
                'prices' => $value['currentPrice'],
                'count' => $value['num'],
                'bought_data' =>  date('Y.m.d H:i:s'),
                'delivery_name' => $deliveryName,
                'delivery_postal' => $deliveryPostal,
                'delivery_address' => $deliveryAddress,
                'delivery_tel' => $deliveryTel,
                'delivery_mail' => $deliveryMail
            ]);
        }
    }
    public function updateStatus($id)
    {
        $status = $this->where('id', $id)->value('status');
        if ($status == 'yet') {
            $status = 'reply';
        } elseif ($status == 'reply') {
            $status = 'pay';
        } elseif ($status == 'pay') {
            $status = 'send';
        } elseif ($status == 'send') {
            $status = 'end';
        } elseif ($status == 'cancel') {
            $status = 'yet';
        }
        $this->where('id', $id)->update([
            'status' => $status
        ]);
    }
    public function orderCancel($id)
    {
        $this->where('id', $id)->update([
            'status' => 'cancel'
        ]);
    }
}