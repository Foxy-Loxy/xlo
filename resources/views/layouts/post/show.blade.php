@extends('layouts.master')

@section('content')
<div class="container post">
    <div class="row">
        <div class="col-8">
            <h3> {{ $post->title }}</h3>
            <p> By {{ $post->user->name }} at {{ $post->created_at }} in {{ $post->category->category_name }}</p>
            <hr>
            <p> {{ $post->body }}</p>
        </div>
        <div class="col-4">
            @foreach($post->photo as $photo)
                <img class="img-fluid img-rounded" src="/storage/{{ $photo->photo_url }}"></a>
            @endforeach
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
        <p class="text-center">Price: {{ $post->price }} UAH</p>
        <br>
        <p class="text-center">Contact: {{ $post->user->phone }}</p>
        </div>
    </div>
</div>

@endsection

@section('page_styles')
<style>
    img {
        width: 100%;
        height: auto;
        padding-top: 10px !important;
        padding-bottom: 10px !important;
    }

    .post {
        padding-top: 20px;
    }
</style>
@endsection

@section('page_scripts')
<script>

</script>
@endsection