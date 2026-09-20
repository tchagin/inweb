<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Product::orderBy('id', 'desc')->paginate(20);
        return view('admin.products.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get()->pluck('title', 'id');
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'shortDesc' => 'required',
            'description' => 'required',
            'thumbnail' => 'nullable',
            'category_id' => 'required',
        ]);

        $data = $request->all();
        $data['thumbnail'] = Product::uploadImage($request);

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Готово');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Product::find($id);
        $categories = Category::get()->pluck('title', 'id');
        return view('admin.products.create', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'shortDesc' => 'required',
            'description' => 'required',
            'thumbnail' => 'nullable',
            'category_id' => 'required',
        ]);

        $data = $request->all();
        $item = Product::find($id);

        if ($file = Product::uploadImage($request, $item->thumbnail)) {
            $data['thumbnail'] = $file;
        }

        $item->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Готово');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Product::find($id);
        Storage::delete($item->thumbnail);
        $item->delete();
        return redirect()->route('admin.products.index')->with('success', 'Готово');
    }
}
