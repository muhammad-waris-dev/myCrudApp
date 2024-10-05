<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.form', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'is_published' => 'boolean',
            'image' => 'nullable|image',
        ]);
        
        $post = Post::create($validated);
    

        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }
        
        return redirect()->route('posts.index');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $posts = Post::findOrFail($id);

        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('posts', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
    $validated = $request->validate([
        'title' => 'required|string',
        'content' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'tags' => 'array',
        'tags.*' => 'exists:tags,id',
        'is_published' => 'boolean',
        'image' => 'nullable|image',
    ]);

    // Find the post by ID
    $post = Post::findOrFail($id);

    // Update post details
    $post->title = $validated['title'];
    $post->content = $validated['content'];
    $post->category_id = $validated['category_id'];
    $post->is_published = $validated['is_published'] ?? false; // Default to false if not provided

    // Handle image upload if provided
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads', 'public');
        $post->image = $imagePath;
    }

    // Save the post
    $post->save();

    // Sync tags (if any are selected)
    if (isset($validated['tags'])) {
        $post->tags()->sync($validated['tags']);
    }

    // Redirect back with a success message
    return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         // Find and delete the tag
        $post = Post::findOrFail($id);
        $post->delete();
        

    // Redirect to the index page with a success message
        return redirect('/posts')->with('success', 'Tag deleted successfully!');  
    }
}
