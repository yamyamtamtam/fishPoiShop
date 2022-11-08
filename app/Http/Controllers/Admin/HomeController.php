<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    protected $product;

    public function __construct()
    {
    }

    public function index()
    {
        $auth = Auth::user();
        return view('admin.home', ['auth' => $auth]);
    }
}