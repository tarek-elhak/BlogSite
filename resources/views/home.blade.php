@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a class="btn btn-primary mb-2" href="/posts/create">Create Post</a>
                    <h3>Your Blog Posts</h3>
                    <!-- showing the posts -->
                    @if (count($posts) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td><a href="/posts/{{$post->id}}/edit" class="btn btn-secondary">Edit</a></td>
                                    <td>
                                        {!! Form::open(['action' => ['PostsController@destroy' , $post->id]]) !!}
                                        {{Form::hidden('_method' , 'DELETE')}}
                                        {{Form::submit('Delete' , ['class' => 'btn btn-danger'])}}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>you have no posts</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
