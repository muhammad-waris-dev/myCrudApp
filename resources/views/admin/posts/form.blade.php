@extends('admin.layout.app');


@section('content')
    


<h2>Create New Post</h2>
<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Title Input -->
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $post->title ?? '') }}" required>
    </div>

    <!-- Content Input -->
    <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" id="content" class="form-control" required>{{ old('content', $post->content ?? '') }}</textarea>
    </div>

    <!-- Category Dropdown -->
    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" class="form-control">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ (old('category_id') == $category->id || (isset($post) && $post->category_id == $category->id)) ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Tags (Checkboxes) -->
    <div class="form-group">
        <label>Tags</label>
        @foreach($tags as $tag)
            <div class="form-check">
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ (isset($post) && $post->tags->contains($tag->id)) ? 'checked' : '' }}>
                <label>{{ $tag->name }}</label>
            </div>
        @endforeach
    </div>

    <!-- Publish (Radio Button) -->
    <div class="form-group">
        <label>Publish</label>
        <div class="form-check">
            <input type="radio" name="is_published" value="1" {{ old('is_published', $post->is_published ?? '') == 1 ? 'checked' : '' }}> Yes
        </div>
        <div class="form-check">
            <input type="radio" name="is_published" value="0" {{ old('is_published', $post->is_published ?? '') == 0 ? 'checked' : '' }}> No
        </div>
    </div>

    <!-- File Upload -->
    <div class="form-group">
        <label for="image">Upload Image</label>
        <input type="file" name="image" id="image" class="form-control">
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
