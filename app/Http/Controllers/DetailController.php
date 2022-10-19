<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Auth;

class DetailController extends Controller
{
    protected $product;

    public function __construct()
    {
        $this->product = new Product;
    }

    public function view(Int $id, Request $request)
    {
        $auth = Auth::user();
        $recommends = $this->product->where('del_flg', 0)->orderBy('id', 'DESC')->take(10)->get();
        $content = $this->product->where('del_flg', 0)->find($id);
        $cart = $request->session()->get('cart');
        if (isset($cart)) {
            $cartCount = count($cart);
        } else {
            $cartCount = 0;
        }
        return view('detail', ['auth' => $auth, 'content' => $content, 'recommends' => $recommends, 'cartCount' => $cartCount]);
    }

    public function add(Int $id, Request $request)
    {
        $cartArray = $request->session()->get('cart');
        if (isset($request->sale)) {
            $currentPrice = $request->sale;
        } else {
            $currentPrice = $request->price;
        }
        $cartArray[$id] = [
            'name' => $request->name,
            'currentPrice' => $currentPrice,
            'image' => $request->image,
            'num' => $request->num
        ];
        $request->session()->put('cart', $cartArray);
        return redirect()->route('home');
    }
}