@extends('layouts.master')

@section('content')
		
<div class="container">
  @foreach($posts as $post)
    
    <div class="row">
        <div class="col-4">
            <img src="/storage/{{ $post->thumbnail['photo_url'] }}" class="img-fluid" alt="">
        </div>
        <div class="col-6">
            <p class="text-center"><a href="/post/{{ $post->id }}"><h4> {{ $post->title }}</h4></a></p>
            <br>
            <p>Posted on: {{ $post->created_at }}</p>
        </div>
        <div class="col-2 textContainer">
            <p class="text-left">Price: {{ $post->price}} UAH</p>
       </div>
    </div>
  @endforeach
</div>

@endsection

@section('page_styles')
<style>
  .textContainer { 
    height: 345px; 
    line-height: 340px;
}

.textContainer p {
    vertical-align: middle;
    display: inline-block;
}
</style>

@endsection

@section('page_scripts')

@endsection