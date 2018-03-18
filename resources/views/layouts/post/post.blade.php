<div class="row">
    <div class="col-4">
        <img src="/storage/{{ $post->thumbnail->photo_url }}" class="img-thumbnail" alt="">
    </div>
    <div class="col-6">
        <p class="text-center"><a href="/post/{{ $post->id }}"><h4> {{ $post->title }}</h4></a></p>
        <br>
        <p>Posted on: {{ $post->created_at }}</p>
    </div>
    <div class="col-2">
        Price: {{ $post->price}} UAH
    </div>
</div>