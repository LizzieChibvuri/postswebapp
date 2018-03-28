@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Read Post</h2>
        </div>
        <div class="pull-right">
            <a href="{{ route('posts.index') }}" class="label label-primary pull-right"> Back</a>
        </div>
    </div>
</div>

 <img style="width:200px;height:200px;" src="/storage/post_photos/{{$post->post_image}}">
 <br/><br/>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Title:</strong>
            {{ $post->title }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Content:</strong>
            {{ $post->body}}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Published On:</strong>
            {{ $post->created_at}}

            By:
            {{$post->user->name}}
        </div>
    </div>
</div>
@endsection