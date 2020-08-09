@extends('Layouts.app')
@section('title')
    {{$post->title}}
@endsection
@section('content')
    
    <h1>{{$post->title}}</h1>
    <img style="width:50%" src="/storage/cover_images/{{$post->cover_image}}" alt="post image">
    <br />
    <br />
    <div>
        <!--two !! in order to parse HTML-->
        {!!$post->body!!}
    </div>
    @if (!Auth::guest())
      @if (Auth::user()->id == $post->user_id)
        <div class="container mt-5">
          <div class="row">
            <div class="col-lg-6">
                <a href="/posts/{{$post->id}}/edit" class="btn btn-secondary"> Edit </a>
            </div>
            <div class="col-lg-6">
              {!! Form::open(['action' => ['PostsController@destroy' , $post->id]]) !!}
              {{Form::hidden('_method' , 'DELETE')}}
              {{Form::submit('Delete' , ['class' => 'btn btn-danger'])}}
              {!! Form::close() !!}
            </div>
          </div>
      </div>    
      @endif
    @endif
    <hr />
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr />
    <div class="container mt-2">
      <div class="row">
        <div class="col-lg-12">
          <a href="../posts" class="btn btn-primary">&larr; Go Back</a>
        </div>
      </div>
    </div>
@endsection