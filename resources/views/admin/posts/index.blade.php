@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('admin.posts.create')}}" class="btn btn-info mb-3">+ New Post</a>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col"># ID</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post )
                    <tr>
                        <th scope="row">{{$post->id}}</th>
                        <td>{{$post->title}}</td>
                        <td>{{$post->slug}}</td>
                        <td>
                            <a href="{{route('admin.posts.show', ['post'=>$post])}}" class="btn btn-primary">Visualizza</a>
                            <a href="{{route('admin.posts.edit', ['post'=>$post])}}" class="btn btn-warning">Modifica</a>
                            <form method="POST" action="{{route('admin.posts.destroy', ['post' => $post->id])}}">
                                @csrf
                                @method('DELETE')
                            <button  type="submit" class="btn btn-danger mt-1">Elimina</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>        
    </div>

@endsection