@extends('Layouts.app')
@section('title')
    Create Post
@endsection
@section('content')
    <h1>create your post</h1>
    {!! Form::open(['action' => 'PostsController@store' , 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '' , ['class' => 'form-control' , 'placeholder' => 'Title'])}}
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', '' , ['class' => 'ckeditor form-control' , 'placeholder' => 'Body Text'])}}
        </div>
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