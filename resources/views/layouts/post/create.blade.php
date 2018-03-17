@extends('layouts.master')

@section('content')
<div class="container">
	<h2>Publish a post</h2>
	<hr>
	<form method="POST" action="/post">
		{{csrf_field()}}
	  	<div class="form-group">
	    	<label for="title">Title</label>
	    	<input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter post title here" name="title">
	  	</div>
	  	<div class="form-group">
	    	<label for="post-body">Post body</label>
	    	<textarea name="body" id="body" class="form-control"></textarea>
	  	</div>
	  	<div class="form-group">
			<label for="category">Category</label>
	        <input type="category" id="category" class="form-control" placeholder="Category" name="category" required>
		</div>
		<div class="form-group">
			<label for="post-body">Photos: </label>
		    <input name="img" id="img" type="file" multiple="" />
		</div>
	<span class='label label-info' id="upload-file-info"></span>
	  	<div class="form-group">
	  		<button type="submit" class="btn btn-primary">Publish</button>
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
		    $("#category").tokenInput("/get/categories");
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