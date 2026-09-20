<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Page::orderBy('id', 'desc')->paginate(20);
        return view('admin.pages.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.create');
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
        ]);

        $data = $request->all();

        Page::create($data);

        return redirect()->route('admin.pages.index')->with('success', 'Готово');
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
        $item = Page::find($id);
        return view('admin.pages.edit', compact('item'));
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
        ]);

        $data = $request->all();
        $item = Page::find($id);

        $item->update($data);

        return redirect()->route('admin.pages.index')->with('success', 'Готово');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Page::find($id);
        $item->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Готово');
    }
}
