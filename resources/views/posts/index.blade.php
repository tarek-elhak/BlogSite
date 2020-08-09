@extends('Layouts.app')
@section('title')
    Posts
@endsection
@section('content')
    <h1>Posts</h1>
    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="card card-body bg-light m-2">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}" alt="post image">
                    </div>
                    <div class="col-md-8 col-sm-4">
                        <h3><a href="/posts/{{$post->id}}"> {{$post->title}} </a></h3>
                        <!-- we could do that $post->user->name , since we set up the relationship 
                        between those two models we set up user function in the Post model -->
                        <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>        
                    </div>
                </div>
                
            </div>
        @endforeach
        {{$posts->links()}}
    @else
        <div class="alert alert-danger" role="alert">
            No Posts Found!
        </div>
    @endif
@endsection