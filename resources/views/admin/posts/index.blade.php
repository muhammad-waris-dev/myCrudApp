@extends('admin.layout.app');

@section('content');

<h2 class="txt-center mb-4">Posts Lits</h2>
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('posts.create') }}" class="btn btn-primary">Create New Post</a>
</div>

@foreach($posts as $post)
    <div class="post">
        <h2 class="col">{{ $post->title }}</h2>
        <p class=".col">{{ $post->content }}</p>
        
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit</a><br><br>
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-primary">Delete</button>
            </form>
        
    </div>
@endforeach
    
@endsection
 