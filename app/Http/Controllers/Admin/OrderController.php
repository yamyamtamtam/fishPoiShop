<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    protected $product;

    public function __construct()
    {
        $this->order = new Order;
        $this->product = new Product;
        $this->user = new User;
    }

    /**
     * 受注一覧
     */
    public function list()
    {
        $orders = $this->order
            ->select('orders.id', 'orders.status', 'products.name as product_name', 'users.name as user_name', 'users.email as user_email', 'orders.prices', 'orders.count', 'orders.bought_data', 'orders.delivery_name', 'orders.delivery_address', 'orders.delivery_tel', 'orders.delivery_mail')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->orderBy('id', 'DESC')->get();
        return view('admin.order.list', ['authgroup' => 'admin', 'orders' => $orders]);
    }


    /**
     * ステータス変更
     */
    public function status(Request $request)
    {
        $this->order->updateStatus($request->id);
        return redirect()->route('order-list')->with('status', $request->id);
    }

    /**
     * 商品削除
     */
    public function cancel(Request $request)
    {
        $this->order->orderCancel($request->id);
        return redirect()->route('order-list')->with('cancel', $request->id);
    }
}