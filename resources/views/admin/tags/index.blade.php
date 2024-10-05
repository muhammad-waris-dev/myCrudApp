@extends('admin.layout.app')


    
@section('content')
    <h1>Index file of tags</h1>
    <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
            @foreach( $tags as $tag )  
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->name }}</td>
                    <td>{{ $tag->created_at }}</td>
                    <td>
                      <form action="{{route('tags.destroy', $tag->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button>Delete</button>
                      </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    <button><a href="{{ url('tags/create') }}">Create Tag</a></button>
@endsection

