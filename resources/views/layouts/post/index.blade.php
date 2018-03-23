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
            <p class="text-center {{ $post->active == 0 ? 'muted' : '' }}"><a href="/post/{{ $post->id }}"><h4> {{ $post->title }}</h4></a></p>
            @if( $post->user->id == auth()->id())
                <form style="display:inline-block" method="POST" action="/post/{{ $post->id }}">
                    {{csrf_field()}} 
                    {{ method_field('DELETE') }} 
                    <button type="submit" class="btn btn-danger">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </form>
                <form  style="display:inline-block" method="GET" action="/post/{{ $post->id }}/edit">
                    {{csrf_field()}} 
                    <button type="submit" class="btn btn-success">
                        <i class="far fa-edit"></i>
                    </button>
                </form>
            @endif
            <br>
            <p>Posted on: {{ $post->created_at }}</p>
            <br>
            <p>By: {{ $post->user->name }}</p>  
            <br>
            <p>In: {{ $post->category->category_name }}</p>
        </div>
        <div class="col-2">
            <p class="price {{$post->active == 0 ? 'bg-danger' : ''}}">{{ $post->active == 0 ? 'OFFER IS INACTIVE' : 'Price:' . $post->price . 'UAH }}</p>
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