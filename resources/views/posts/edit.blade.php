@extends('Layouts.app')
@section('title')
    {{$post->title}}
@endsection
@section('content')
    <h1>Edit your post</h1>
    {!! Form::open(['action' => ['PostsController@update' , $post->id] , 'enctype' => 'multipart/form-data' ]) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $post->title , ['class' => 'form-control' , 'placeholder' => 'Title'])}}
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', $post->body , ['class' => 'ckeditor form-control' , 'placeholder' => 'Body Text'])}}
        </div>
            {{Form::hidden('_method' , 'PUT')}}
            <div class="form-group">
                {{Form::file('cover_image')}}
            </div>
            {{Form::submit('Submit' , ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>
@endsection