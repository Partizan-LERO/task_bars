@extends('layouts.app')
@section('title', isset($post)? 'Update post' : 'Create post')
@section('content')
    <div class="container">
        <h1>{{ isset($post)? 'Update post' : 'Create post' }}</h1>
        <form action="{{isset($post) ? route('edit',$post['id']) : route('store') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Title" name="title"
                       value="{{ isset($post)? $post['title'] : '' }}">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="text" placeholder="Text">{!! isset($post)? $post['text'] : '' !!}</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-danger add__button" type="submit">Add</button>
            </div>
        </form>
    </div>
    @include('mceImageUpload::upload_form')
@endsection
@section('javascript')
    <script>
        $(document).ready(function () {
            $('.add__button').click(function () {
                var title = $("input[name=title]").val();
                if(!title) {
                    $.notify({
                        message: 'The field `title` is required!'
                    },{
                        type: 'danger'
                    });
                    return false;
                }
            });
        });
    </script>
    <script src="{{ asset('js/vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
@endsection