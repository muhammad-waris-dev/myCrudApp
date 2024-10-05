@extends('admin.layout.app');

@section('content')
<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3 mt-3">
        <label for="name" class="form-label">Category Name:</label>
        <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{$category->name}}">
      </div>

      
      <button type="submit" class="btn btn-primary">Update item</button>

  

    
</form>
@endsection
