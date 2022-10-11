@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{route('admin.posts.store')}}" method="post">
            @csrf
                        
            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control" id="title" name="title">
                <small id="title" class="form-text text-muted">Titolo Post </small>
            </div>
            <div class="form-group">
                <label for="content">Corpo del Post</label>
               <textarea class="form-control" id="content" name='content'>

               </textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Crea Post</button>

        </form>

    </div>



@endsection