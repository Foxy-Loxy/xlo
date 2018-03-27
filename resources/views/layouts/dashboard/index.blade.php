@extends('layouts.master')

@section('content')
    <br>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="list-group">
                    <p class="list-group-item list-group-item-action active text-center ">
                        Favourites
                    </p>
                    @foreach ($favouritess as $favourite)
                        @if( isset($favourite->id) )
                        <a href="/post/{{ $favourite->id }}" class="list-group-item list-group-item-action">{{ $favourite->title }}</a>
                        @endif
                    @endforeach
                </div>
                <hr>
                <div class="list-group">
                    <p class="text-center list-group-item list-group-item-action active">
                        My Posts
                    </p>
                    @foreach ($user_posts as $post)
                        <a href="/post/{{ $post->id }}" class="list-group-item list-group-item-action">{{ $post->title }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_styles')

@endsection

@section('page_scripts')

@endsection