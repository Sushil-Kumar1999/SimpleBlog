@extends('layouts.app')

@section('title', 'Posts')

@section('content')

<h5>Posts:</h5>

<ul>
    @foreach($posts as $post)
<li><a href="{{ route('posts.show', ['post' => $post]) }}">{{$post->title}}</a></li>
    @endforeach
</ul>

<div>{{$posts->links()}}</div>

@endsection
