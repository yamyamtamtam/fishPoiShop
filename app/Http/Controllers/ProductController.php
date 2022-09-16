<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __constract()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * 商品登録
     */
    public function showAdminProductCreate()
    {
        return view('admin.product.create');
    }

    /**
     * 商品一覧
     */
    public function showAdminProductList()
    {
        return view('admin.product.list');
    }

    /**
     * 商品編集
     */
    public function showAdminProductEdit()
    {
        return view('admin.product.edit');
    }
}