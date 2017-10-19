@extends('layouts.app')
@section('title','All posts')
@section('content')
    <div class="container">
        @guest
        @else
            <a class="btn-lg btn btn-success" href="{{route('create')}}">New post</a>
        @endguest
        @foreach($posts as $post)
            <div class="post">
                @guest
                @else
                @if( Auth::user()->isAdmin or (Auth::user()->id == $post['user']['id']) )
                    <div class="post__edit"><a href="{{ route('update', $post['id']) }}"><i class="fa fa-edit"></i></a></div>
                    <div class="post__remove">
                        <a data-toggle="confirmation" data-placement="right" href="{{ route('delete', $post['id']) }}">
                            <i class="fa fa-remove"></i>
                        </a>
                    </div>
                @endif
                @endguest
                <h2 class="post__title"><a href="{{ route('post', $post['id']) }}">{{ $post['title'] }}</a></h2>
                <div class="post__description"> {!! str_limit($post['text'], 355) !!} </div>
                <div class="post__date">{{ (new \Carbon\Carbon($post['created_at']))->format('d.m.Y H:i:s') }}</div>
                <div class="post__author">{{ $post['user']['name'] }}</div>
            </div>
        @endforeach
    </div>
@endsection
@section('javascript')
    <script>
        $(document).ready(function () {
            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]'
            });
        });
    </script>
@endsection