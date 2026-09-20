<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $products = Product::get();
        $pages = Page::get();
        return view('index', compact('products', 'pages'));
    }
}
