@extends('layouts.app')

@section('title', 'View Post')

@section('content')
<h3>{{ $post->title }}</h3>

<p class="flex ">{{ $post->content }}</p>
@endsection