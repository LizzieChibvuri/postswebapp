@extends('layouts.app')
@section('content')
     <h1>{{$title}}</h1>
     <p>This is a paragraph in the services page</p>   

     @if(count($services>0))
     <ul>
        @foreach($services as $service)
            <li>{{$service}}</li>

        @endforeach
    </ul>

     @endif
@endsection