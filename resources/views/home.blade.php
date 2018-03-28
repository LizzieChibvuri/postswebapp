@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach($posts as $post)
                    <h3> <p><div><a href="{{ route('posts.show', $post->id) }}">{{$post->title}}</a></div></p></h3>
                     <img style="width:200px;height:200px;" src="/storage/post_photos/{{$post->post_image}}"><br/>
                    <small>Published on:{{$post->created_at}} by  {{$post->user->name}} </small>
                    <a href="{{ route('posts.edit', $post->id) }}" class="label label-warning">Edit</a>
                    <form action="{{action('PostsController@destroy', $post->id)}}" method="post">
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="Delete">
                    <button class="btn btn-danger" type="submit"  onclick="return confirm('Are you sure to delete?')">Delete</button>
                    </form>
                    <br/><br/>
                     @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
