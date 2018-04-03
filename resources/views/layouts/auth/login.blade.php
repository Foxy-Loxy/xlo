@extends('layouts.master')

@section('content')
	<div class="jumbotron">
      <div class="container">
        <h1 class="display-3">Welcome back...</h1>
        <p>Oh, we can't recognize you! Remind us about you, so we can continue to work together!</p>
      </div>
    </div>
	<div class="container">
		<h1>Login Form</h1>
		<form action="/login" method="POST">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="password_confirmation" class="sr-only">E-Mail Address</label>
	       		<input type="email" id="email" name="email" class="form-control" placeholder="E-Mail Address" required>
			</div>
			<div class="form-group">
				<label for="password" class="sr-only">Password</label>
	       		<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Log In</button>
			</div>
		</form>
		@if ($error = $errors->first('password'))
			<div class="alert alert-danger">
				{{ $error }}
			</div>
		@endif
	</div>
@endsection

@section('page_styles')

@endsection

@section('page_scripts')

@endsection