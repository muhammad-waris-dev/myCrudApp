@extends('admin.layout.app')


    
@section('content')
    <h1>Index file of categories</h1>
    <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
            @foreach( $categories as $category )  
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                      <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">Edit</a>
                    </td>
                    <td>
                      <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-primary">Delete</button>
                      </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    <button><a href="{{ url('categories/create') }}">Create</a></button>
@endsection

