@extends('admin.layout.app')

@section('content')
<div class="container">
    <h1>Edit Post</h1>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit form -->
    <form action="{{ route('posts.update', $posts->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $posts->title) }}" required>
        </div>

        <!-- Content -->
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" class="form-control" rows="5" required>{{ old('content', $posts->content) }}</textarea>
        </div>

        <!-- Category -->
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">Choose Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == old('category_id', $posts->category_id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tags -->
        <div class="form-group">
            <label for="tags">Tags</label>
            <select name="tags[]" id="tags" class="form-control" multiple>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', $posts->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Is Published -->
        <div class="form-group">
            <label for="is_published">Published</label>
            <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $posts->is_published) ? 'checked' : '' }}>
        </div>

        <!-- Image Upload -->
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control-file">
            @if($posts->image)
                <img src="{{ asset('storage/' . $posts->image) }}" alt="Current Image" class="img-thumbnail mt-2" width="150">
            @endif
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>
@endsection
