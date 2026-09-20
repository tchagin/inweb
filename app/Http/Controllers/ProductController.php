<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Request $request){
        $item = Product::where('id', $request->id)->firstOrFail();
        return view('pages.products.show', compact('item'));
    }
}
