<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Category::orderBy('id', 'desc')->paginate(20);
        return view('admin.categories.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
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
        ]);

        $data = $request->all();
        $data['thumbnail'] = Category::uploadImage($request);

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Готово');
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
        $item = Category::find($id);
        return view('admin.categories.edit', compact('item'));
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
        ]);

        $data = $request->all();
        $item = Category::find($id);

        if ($file = Category::uploadImage($request, $item->thumbnail)) {
            $data['thumbnail'] = $file;
        }

        $item->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Готово');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Category::find($id);

        if ($item->products()->exists()) {
            return redirect()->route('admin.categories.index')->with('error', 'Ошибка! У категории есть записи');
        }

        if ($item->thumbnail) {
            Storage::delete($item->thumbnail);
        }

        $item->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Готово');
    }
}
