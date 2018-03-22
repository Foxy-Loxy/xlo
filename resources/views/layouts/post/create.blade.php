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
	    	<input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter post title here" name="title" value="{{ isset($post) ? $post->title : '' }}">
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
			<label for="post-body">Photos:  {{ isset($post) ? 'Upload new photos if you want to cahnge them' : '' }}</label>
			<input name="image[]" id="image[]" type="file" enctype="multipart/form-data" multiple/>
			@if (isset($post))
				@foreach($post->photo as $photo)
					<img class="img-fluid img-thumbnail rounded" style="height: 200px; width: 200px;" src="/storage/{{ $photo->photo_url }}"></a>
				@endforeach
			@endif
		</div>
		<div class="form-group">
	    	<label for="price">Price</label>
	    	<input type="number" name="price" id="price" class="form-control"  value="{{ isset($post) ? $post->price : '' }}"> UAH
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

	<link rel="stylesheet" href="/js/autosuggest/styles/token-input.css" type="text/css" />
    <link rel="stylesheet" href="/js/autosuggest/styles/token-input-facebook.css" type="text/css" />
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
		$(document).ready(function () {
		    $("#category_id").tokenInput("/get/categories", {
		    	tokenLimit : 1, {!! isset($post) ? 'prePopulate: [{id:' . $post->category->id . ', name:"'. $post->category->category_name . '"}]'  : ''!!}
		    });
		});

		$(function(){
			//client-side upload count verification
    		$("input[type='submit']").click(function(){
	       		var $fileUpload = $("input[type='file']");
	        	if (parseInt($fileUpload.get(0).files.length)>2){
	         		alert("You can only upload a maximum of 2 files");
	        	}
	        });
		});

	
	</script>

@endsection