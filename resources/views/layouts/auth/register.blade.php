@extends('layouts.master')

@section('content')
	<div class="jumbotron">
      <div class="container">
        <h1 class="display-3">Some steps to go...</h1>
        <p>Fill those field below and share your first ad on XLO !</p>
      </div>
    </div>
	<div class="container">
		<h2>Registration Form</h2>
		<form action="/register" method="POST">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="name" class="sr-only">Name</label>
        		<input type="name" id="name" name="name" class="form-control" placeholder="Your name" required>
			</div>
			<div class="form-group">
				<label for="email" class="sr-only">E-Mail address</label>
        		<input name="email" id="email" type="email"class="form-control" placeholder="E-Mail Address" required>
			</div>
			<div class="form-group">
				<label for="phone" class="sr-only">Phone</label>
        		<input type="tel" id="phone" class="form-control" placeholder="Phone number" name="phone" required>
			</div>
			<div class="form-group">
				<label for="city" class="sr-only">City</label>
        		<input type="city" id="city_id" class="form-control" placeholder="City" name="city_id" required>
			</div>
			<div class="form-group">
				<label for="password" class="sr-only">Password</label>
        		<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
			</div>
			<div class="form-group">
				<label for="password_confirmation" class="sr-only">Password</label>
        		<input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Password Confirmation" required>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Sign Up</button>
			</div>
		</form>	
		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
	</div>
@endsection

@section('page_styles')

	<link rel="stylesheet" href="/js/autosuggest/styles/token-input.css" type="text/css" />
    <link rel="stylesheet" href="/js/autosuggest/styles/token-input-facebook.css" type="text/css" />

@endsection

@section('page_scripts')

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="/js/autosuggest/src/jquery.tokeninput.js"></script>

    <script type="text/javascript">
		$(document).ready(function () {
		    $("#city_id").tokenInput("/get/cities", {
		    	tokenLimit : 1
		    });
		});
	</script>

@endsection