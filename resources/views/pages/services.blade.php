@extends('Layouts.app')
@section('title')
    Services
@endsection
@section('content')
    <h1>{{$heading}}</h1>
    <p>this is the Services Page of BlogSite web app</p>
        @if (count($services) > 0)
            <ul class="list-group">
                @foreach ($services as $service)
                    <li class="list-group-item">{{$service}}</li>
                @endforeach
            </ul>
        @endif
@endsection