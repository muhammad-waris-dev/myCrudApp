<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\db;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        // Fetch all tags
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags',
        ]);

        // Create and store the tag
        Tag::create([
            'name' => $request->name,
        ]);
        

        // Redirect to the index page with a success message
        return redirect('/tags')->with('success', 'Tag created successfully!');   
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $id)
    {
        // Find the tag by id
        $tag = Tag::findOrFail($id);
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $id,
        ]);

        // Find and update the tag
        $tag = Tag::findOrFail($id);
        $tag->update([
            'name' => $request->name,
        ]);

        // Redirect to the index page with a success message
        return redirect('/tags')->with('success', 'Tag updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    // Find and delete the tag
    $tag = Tag::findOrFail($id);
    $tag->delete();

    // Redirect to the index page with a success message
    return redirect('/tags')->with('success', 'Tag deleted successfully!');  
  }
}
