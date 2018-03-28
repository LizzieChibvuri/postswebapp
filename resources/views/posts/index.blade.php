@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        @if(Session::has('success_msg'))
        <div class="alert alert-success">{{ Session::get('success_msg') }}</div>
        @endif
    <!-- Posts list -->
    @if(!empty($posts))
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Posts List </h2>
                </div>
                 @if (!Auth::guest())
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('posts.create') }}"> Add New</a>
                </div>
                @endif
            </div>
        </div>
        <div class="row">
           @foreach($posts as $post)
            <div class="col-xs-12 col-sm-12 col-md-12">
             
                   <div class="col-md-4  col-sm-4">
                        <img style="width:100px; height:100px;" src="/storage/post_photos/{{$post->post_image}}">
                    </div>

                     <div class="col-md-8  col-sm-8">
                         <h3> <p><div><a href="{{ route('posts.show', $post->id) }}">{{$post->title}}</a></div></p></h3>
                         <small>Published on:{{$post->created_at}} by  {{$post->user->name}}</small>
                    </div>     
                    
            </div>
            <br/><br/>
             @endforeach
        </div>
    @endif
    </div>
</div>
@endsection