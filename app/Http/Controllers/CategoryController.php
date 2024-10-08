<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        // Fetch all categories
        $categories = Category::all();
        $name = "Waris";
        return view('admin.categories.index', compact('categories','name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        // Create and store the category
        Category::create([
            'name' => $request->name,
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);

        // Find and update the tag
        $tag = Category::findOrFail($id);
        $tag->update([
            'name' => $request->name,
        ]);

        // Redirect to the index page with a success message
        return redirect('/categories')->with('success', 'Tag updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        // Redirect to the index page with a success message
        return redirect('categories')->with('success', 'Category deleted successfully!');
    }
}
