@extends('admin.layout.app')

@section('content')
<form action="{{ route('tags.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Category Name:</label>
        <input type="text" class="form-control" name="name">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
@endsection
