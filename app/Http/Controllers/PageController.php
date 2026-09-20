<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(Request $request){
        $item = Page::where('id', $request->id)->firstOrFail();
        return view('pages.pages.show', compact('item'));
    }
}
