@extends('Layouts.app')
@section('title')
    {{config('app.name','BlogSite')}}
@endsection
@section('content')
    <div class="jumbotron text-center">
        <h1>{{$heading}}</h1>
        <p>Laravel wep application which is used as a blogsite , login and post your posts now !</p>
        <p><a href="/login" class="btn btn-primary btn-lg" role="button">Login</a>
            <a href="/register" class="btn btn-success btn-lg" role="button">Signup</a>
        </p>
    </div>
@endsection
    
