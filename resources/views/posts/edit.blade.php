@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        @if($errors->any())
            <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach()
            </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Post <a href="{{ route('posts.index') }}" class="label label-primary pull-right">Back</a>
            </div>
            <div class="panel-body">
                <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
                    <div class="form-group">
                        <label class="control-label col-sm-2" >Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" >Content</label>
                        <div class="col-sm-10">
                            <textarea name="body" id="body" class="form-control">{{ $post->body }}</textarea>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-sm-2" >Post Image</label>
                        <div class="col-sm-10">
                        	<img style="width:100px; height:100px;" src="/storage/post_photos/{{$post->post_image}}">      
                        </div>
                    </div>

                      <div class="form-group">
                        <label class="control-label col-sm-2" >Change Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="post_image" id="post_image" class="form-control">
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-default" value="Update Post" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
