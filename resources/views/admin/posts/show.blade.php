@extends('layouts.app')

@section('content')
    <div class="container">

        <div>
            <span class="font-weight-bold">Title:
                {{$post->title}}
            </span>
        </div>
        <div>
            <span class="fw-bold">Contenuto:
                {{$post->content}}
            </span>
        </div>
        <div>
            <span class="font-italic">Slug:
                {{$post->slug}}
            </span>

        </div>
        <a href="{{route('admin.posts.index')}}" class="btn btn-info">Torna alla Lista</a>
    </div>

@endsection