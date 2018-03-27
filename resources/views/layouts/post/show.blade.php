@extends('layouts.master')

@section('content')
<div class="container post">
    <div class="row">
        <div class="col-8">
            <h3> {{ $post->title }}</h3>
            @if (auth()->check())
                <form  style="display:inline-block" method="GET" action="/home/favourites/{{ $post->id }}">
                    {{csrf_field()}}
                    <button type="submit" class="btn @if(\App\Favourite::where('post_id', $post->id)->where('user_id', auth()->id())->exists()) {{ 'btn-primary' }} @else {{ 'btn-secondary' }} @endif">
                        <i class="far fa-star"></i>
                    </button>
                </form>
            @endif
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
    @if (($post->user->id == auth()->id()) || ($post->user->isadmin == true))
        <hr>
        <h2 class="text-center">Statistics</h2>
        <div class="row" style="text-align: center">
            <div class="col-4">Visits: {{ $post->views }}</div>
            <div class="col-4">Saved to favourites: {{ $post->favourites }}</div>
            <div class="col-4">Active till: {{ $post->deactiveDate() }}</div>
        </div>
        <hr>
        <div class="row"  style="text-align: center">
            <div class="col-12">
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
            </div>
        </div>
    @endif
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