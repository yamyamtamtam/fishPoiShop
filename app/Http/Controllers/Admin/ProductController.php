<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $product;

    private $varidator = [
        'name' => 'required|max:128',
        'price' => 'required|max:10',
        'image' => 'image|mimes:jpeg,jpg,png|max:2048',
        'description' => 'required'
    ];

    public function __construct()
    {
        $this->product = new Product;
    }

    /**
     * 商品登録画面
     */
    public function create()
    {
        return view('admin.product.create', ['authgroup' => 'admin']);
    }


    /**
     * 商品登録画面（確認用）
     */
    public function confirm(Request $request)
    {
        $request->validate($this->varidator);
        $file = $request->file('image');
        if (isset($file)) {
            $tempPath = $file->store('public/uploads/temp');
            $readPath = str_replace('public', 'storage', $tempPath);
        } else {
            $readPath = 'storage/default/noimage.jpg';
        }
        $input = $request->all();
        $input["image"] = $readPath;
        return view('admin.product.confirm', ['authgroup' => 'admin', 'input' => $input]);
    }

    /**
     * 商品登録処理
     */
    public function store(Request $request)
    {
        $file = $request->image;
        $filePath = str_replace('storage/', 'public/', $file);
        //確認画面から戻るボタン押したときの処理。name="back"が送信される
        if ($request->get('back')) {
            Storage::delete($filePath);
            return redirect()->route('product-create')->withInput();
        }
        if ($file === 'storage/default/noimage.jpg') {
            $request->image = 'noimage.jpg';
        } else {
            $request->image = date('Ymd') . str_replace('storage/uploads/temp/', '', $file);
        }
        $movedPath = 'public/uploads/' . $request->image;
        Storage::move($filePath, $movedPath);
        $this->product->insertProduct($request);
        return redirect()->route('product-list')->with('store', $request->name);
    }

    /**
     * 商品一覧
     */
    public function list()
    {
        $products = $this->product->where('del_flg', 0)->get();
        return view('admin.product.list', ['authgroup' => 'admin', 'products' => $products]);
    }

    /**
     * 商品編集画面
     */
    public function editView(Int $id)
    {
        $product = $this->product->find($id);
        return view('admin.product.edit', ['authgroup' => 'admin', 'product' => $product]);
    }
    /**
     * 商品編集処理
     */
    public function edit(Request $request)
    {
        $request->validate($this->varidator);
        $file = $request->file('image');
        if (isset($file)) {
            $filePath = $file->store('public/uploads');
            $renamePath = date('Ymd') . str_replace('public/uploads/', '', $filePath);
            $request->filename = $renamePath;
            Storage::move($filePath, 'public/uploads/' . $renamePath);
        } else {
            $request->filename = 'noimage.jpg';
        }
        $input = $request->all();
        $this->product->updateProduct($request);
        return redirect()->route('product-list')->with('edit', $request->name);
    }

    /**
     * 商品削除
     */
    public function delete(Request $request)
    {
        $this->product->delelteProduct($request);
        return redirect()->route('product-list')->with('delete', $request->name);
    }

    /**
     * ゴミ箱
     */
    public function trash()
    {
        $products = $this->product->where('del_flg', 1)->get();
        return view('admin.product.trash', ['authgroup' => 'admin', 'products' => $products]);
    }

    /**
     * 商品元に戻す
     */
    protected function deleteReturn(Request $request)
    {
        $this->product->delelteProductReturn($request);
        return redirect()->route('product-list')->with('return', $request->name);
    }

    /**
     * 商品完全に削除
     */
    protected function deleteComplete(Request $request)
    {
        $this->product->delelteProductComplete($request);
        return redirect()->route('product-trash')->with('delete', $request->name);
    }
}