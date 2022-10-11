@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('admin.posts.update', ['post' => $post->id])}}" method="post">
            @method('PUT')
            @csrf
                        
            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" value="{{old('title', $post->title)}}">
                <small id="title" class="form-text text-muted">Titolo Post </small>
            </div>
            <div class="form-group">
                <label for="content">Corpo del Post</label>
               <textarea class="form-control" id="content" name='content'>
               {{old('content', $post->content)}}
               </textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Modifica Post</button>

        </form>

    </div>



@endsection