<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\mailSend;

class CartController extends Controller
{
    protected $product;

    private $varidator = [
        'deliveryName' => 'required|max:128',
        'deliveryPostal' => 'required|max:10', //アメリカの十桁が最大数らしい
        'deliveryAddress' => 'required|max:255',
        'deliveryTel' => 'required|max:15', //15桁が最大数らしい
        'deliveryMail' => 'required|email|max:255'
    ];

    public function __construct()
    {
        $this->product = new Product;
        $this->order = new Order;
    }

    public function list(Request $request)
    {
        $auth = Auth::user();
        $cartArray = array();
        $cartArray = $request->session()->get('cart');
        $total = 0;
        if (!empty($cartArray) && count($cartArray)) {
            foreach ($cartArray as $item) {
                $total += $item['currentPrice'] * $item['num'];
            }
        }
        return view('cart.cart', ['auth' => $auth, 'cart' => $cartArray, 'total' => $total]);
    }

    public function delete(Int $id, Request $request)
    {
        $cartArray = $request->session()->get('cart');
        unset($cartArray[$id]);
        $request->session()->put('cart', $cartArray);
        return redirect()->route('cart');
    }

    public function delivery(Request $request)
    {
        $auth = Auth::user();
        $cartPost = $request->all();
        $oldInput = $request->session()->get('_old_input');
        $total = 0;
        if (isset($oldInput)) {
            $newCartArray = $this->cartArrayRebuild($oldInput);
        } else {
            $newCartArray = $this->cartArrayRebuild($cartPost);
        }
        foreach ($newCartArray as $item) {
            $total += $item['currentPrice'] * $item['num'];
        }
        //個数変更のためにセッションを再設定
        $request->session()->forget('cart');
        $request->session()->put('cart', $newCartArray);

        return view('cart.delivery', ['auth' => $auth, 'cart' => $newCartArray, 'total' => $total]);
    }

    public function confirm(Request $request)
    {
        $request->validate($this->varidator);
        $cartPost = $request->all();
        $newCartArray = $this->cartArrayRebuild($cartPost);
        return view(
            'cart.confirm',
            [
                'cart' => $newCartArray,
                'total' => $cartPost['total'],
                'deliveryName' => $cartPost['deliveryName'],
                'deliveryPostal' => $cartPost['deliveryPostal'],
                'deliveryAddress' => $cartPost['deliveryAddress'],
                'deliveryTel' => $cartPost['deliveryTel'],
                'deliveryMail' => $cartPost['deliveryMail']
            ]
        );
    }

    public function thanks(Request $request)
    {
        //確認画面から戻るボタン押したときの処理。name="back"が送信される
        if ($request->get('back')) {
            return redirect()->route('cart-delivery')->withInput();
        }
        $cartPost = $request->all();
        $newCartArray = $this->cartArrayRebuild($cartPost);

        $this->order->insertOrder(
            $newCartArray,
            Auth::id(),
            $cartPost['deliveryName'],
            $cartPost['deliveryPostal'],
            $cartPost['deliveryAddress'],
            $cartPost['deliveryTel'],
            $cartPost['deliveryMail']
        );

        Mail::to($cartPost['deliveryMail'])->send(
            new mailSend(
                'returnMail',
                $newCartArray,
                $cartPost['total'],
                $cartPost['deliveryName'],
                $cartPost['deliveryPostal'],
                $cartPost['deliveryAddress'],
                $cartPost['deliveryTel'],
                $cartPost['deliveryMail']
            )
        );
        Mail::to('4leafclover1214@gmail.com')->send(
            new mailSend(
                'adminMail',
                $newCartArray,
                $cartPost['total'],
                $cartPost['deliveryName'],
                $cartPost['deliveryPostal'],
                $cartPost['deliveryAddress'],
                $cartPost['deliveryTel'],
                $cartPost['deliveryMail']
            )
        );
        $request->session()->forget('cart');
        return view('cart.thanks', ['mail' => $cartPost['deliveryMail']]);
    }

    /**
     * POSTリクエストで、送られてきたprice{id}のような配列をidをキーにした配列に再構築する
     * {'num{id}'}: 個数
     * {'name{id}'}: 名前
     * {'image{id}'}: 画像名
     * {'currentPrice{id}'}: 購入時の価格
     * total: 合計金額
     * 
     * return
     * [商品のid] => { .... },[],....
     * 
     */
    private function cartArrayRebuild(array $array)
    {
        $newArray = array();
        foreach ($array as $key => $value) {
            if (strpos($key, 'num') !== false) {
                $currentId = (string) str_replace('num', '', $key);
                $newArray[$currentId]['num'] = $value;
            }
            if (strpos($key, 'name') !== false) {
                $currentId = (string) str_replace('name', '', $key);
                $newArray[$currentId]['name'] = $value;
            }
            if (strpos($key, 'image') !== false) {
                $currentId = (string) str_replace('image', '', $key);
                $newArray[$currentId]['image'] = $value;
            }
            if (strpos($key, 'currentPrice') !== false) {
                $currentId = (string) str_replace('currentPrice', '', $key);
                $newArray[$currentId]['currentPrice'] = $value;
            }
        }
        return $newArray;
    }
}