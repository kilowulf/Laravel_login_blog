@extends('layouts.app')

@section('content')
    <h1><strong>{{$post->title}}</strong></h1> 
    <img style="width: 100%" src="/storage/cover_images/{{$post->cover_image}}"><br><br>
        
        <div>
            {!!$post->body!!}
        </div>
        <hr>
        <small>Written on {{$post->created_at}} by <strong>{{$post->user->name}}</strong></small>
        <br>        
        <hr>
        @if(!Auth::guest())
            @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
            <a href="/posts" class="btn btn-default">Go Back</a>

            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
            @endif
        @endif
@endsection