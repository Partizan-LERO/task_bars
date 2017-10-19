@extends('layouts.app')
@section('title', $post['title'])
@section('content')
    <div class="container">
        <h1>{{ $post['title'] }}</h1>
        {!! $post['text'] !!}
    </div>
@endsection