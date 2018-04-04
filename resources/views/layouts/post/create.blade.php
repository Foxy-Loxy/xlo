@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>{{ isset($post) ? 'Update' : 'Create' }} a post</h2>
        <hr>
        <form method="POST" action="/post{{ isset($post) ? '/' . $post->id : ''}}" enctype="multipart/form-data">
            {{csrf_field()}}
            {{ isset($post) ? method_field('PATCH') : '' }}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" aria-describedby="emailHelp"
                       placeholder="Enter post title here" name="title" value="{{ isset($post) ? $post->title : '' }}">
            </div>
            <div class="form-group">
                <label for="post-body">Post body</label>
                <textarea name="body" id="body" class="form-control">{{ isset($post) ? $post->body : '' }}</textarea>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="category" id="category_id" class="form-control" placeholder="Category" name="category_id">
            </div>
            <div class="form-group">
                <label for="post-body">Photos: {{ isset($post) ? 'Upload new photos if you want to cahnge them' : '' }}</label>
                <input name="image[]" id="image" type="file" enctype="multipart/form-data" multiple/>
                <div id="uploaded"></div>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control"
                       value="{{ isset($post) ? $post->price : '' }}"> UAH
            </div>
            <span class='label label-info' id="upload-file-info"></span>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ isset($post) ? 'Update' : 'Publish' }}</button>
            </div>
            @include('layouts.error')
        </form>
    </div>
@endsection

@section('page_styles')

    <link rel="stylesheet" href="/js/autosuggest/styles/token-input.css" type="text/css"/>
    <link rel="stylesheet" href="/js/autosuggest/styles/token-input-facebook.css" type="text/css"/>
    <style>

    </style>

@endsection

@section('page_scripts')

    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="/js/autosuggest/src/jquery.tokeninput.js"></script>

    <script type="text/javascript">


        @if(isset($post)) {!! 'var edit = true;'  !!} @endif

        $(document).ready(function () {
            $("#category_id").tokenInput("/get/categories", {
                tokenLimit: 1, {!! isset($post) ? 'prePopulate: [{id:' . $post->category->id . ', name:"'. $post->category->category_name . '"}]'  : ''!!}
            });
            @if(isset($post))
            $('#image').trigger('change');
            @endif
        });
        $('#uploaded').on('click', '.btn-danger', function (event) {
            var img_id = event.target.value;
            var formData = new FormData;
            formData.append('img_id', img_id);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "/ajax/deletePhoto",
                type: 'post',
                data: formData,
                dataType: 'html',
                async: true,
                processData: false,
                contentType: false,
                success: function (data) {
                    $('#uploaded > [value=' + img_id + ']').remove();
                }
            });
        });
        $('#uploaded').on('click', '.btn-success', function (event) {
            var img_id = event.target.value;
            var formData = new FormData;
            formData.append('img_id', img_id);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "/ajax/thumbPhoto",
                type: 'post',
                data: formData,
                dataType: 'html',
                async: true,
                processData: false,
                contentType: false,
                success: function (data) {
                    $('#uploaded > .btn-success[disabled]').attr('disabled', false);
                    $('#uploaded > button.btn-success[value=' + img_id + ']').attr('disabled', true);
                }
            });
        });
        var a = 1;
        $('#image').change(function () {
            var formData = new FormData();
            @if(isset($post))
            if (a == 1) {
                formData.append('edit', true);
                a = 0;
            }
            formData.append('post_id', {{ $post->id }});
            @endif
            for (var i = 0, len = document.getElementById('image').files.length; i < len; i++) {
                formData.append("image[]", document.getElementById('image').files[i]);
                console.log(i);
            }
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "/ajax/uploadPhoto",
                type: 'post',
                data: formData,
                dataType: 'html',
                async: true,
                processData: false,
                contentType: false,
                success: function (data) {
                    var html = "..";
                    var result = JSON.parse(data);
                    if ($('#uploaded img').length == 5)
                        return 0;
                    result['image'].forEach(function (image) {
                        // Here div with custom value should yo the trick, but not now...
                        $('#uploaded').append('<img value="' + image['id'] + '"style="width: 100px; height: auto;" class="img img-thumbnail img-responsive"src="/storage/' + image['filename'] + '" alt="">');
                        $('#uploaded').append('<button class="btn btn-success" type="button" value="' + image['id'] + '"><i class="far fa-images"></i></button>')
                        $('#uploaded').append('<button class="btn btn-danger" type="button" value="' + image['id'] + '"><i class="far fa-trash-alt"></i></button>')
                        $('#uploaded').append('<hr value="' + image['id'] + '">');
                    });

                    $('#upload-result').append('<div  class="alert alert-success"><p>File(s) uploaded successfully!</p><br/>');
                    $('#upload-result .alert').append(data);
                },
            });
        });


    </script>

@endsection