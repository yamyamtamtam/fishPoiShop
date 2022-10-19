<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    protected $product;

    public function __construct()
    {
        $this->product = new Product;
    }

    public function index(Request $request)
    {
        $auth = Auth::user();
        $products = $this->product->where('del_flg', 0)->get();
        $cart = $request->session()->get('cart');
        if (isset($cart)) {
            $cartCount = count($cart);
        } else {
            $cartCount = 0;
        }
        return view('home', ['auth' => $auth, 'products' => $products, 'cartCount' => $cartCount]);
    }
}