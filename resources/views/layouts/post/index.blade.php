@extends('layouts.master')

@section('content')
		
<div class="container">
  @foreach($posts as $post)
    <div class="row">
        <div class="col-4" style="padding:8px;">
            <div class="image">
                <img src="/storage/{{ $post->thumbnail['photo_url'] }}" class="img-fluid img-thumbnail rounded" alt="">
            </div>
        </div>
        <div class="col-6">
            <p class="text-center"><a href="/post/{{ $post->id }}"><h4> {{ $post->title }}</h4></a></p>
            <br>
            <p>Posted on: {{ $post->created_at }}</p>
            <br>
            By: {{ $post->user->name }}
        </div>
        <div class="col-2">
            <p class="price">Price: {{ $post->price}} UAH</p>
        </div>
    </div>
    <hr>
  @endforeach
</div>

@endsection

@section('page_styles')
<style>
.price {
    line-height: 200px;
}

.image{

    line-height: 200px;
}
.image img{
    vertical-align: middle;
    height: 240px;
    display:block;
    margin:auto;
    width: 100%;

}

</style>

@endsection

@section('page_scripts')

@endsection