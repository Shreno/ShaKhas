@extends('master')
@section('content')
@if(session()->has('gemail')&&session()->has('code'))
	<form action="/respass" method="post">
		{{ csrf_field() }}
		@if(count($errors)>0)
	      <br>
	      <div class="alert alert-danger">
	          <ul>
	              @foreach($errors->all() as $error)
	              <li>{{ $error }}</li>
	              @endforeach
	          </ul>
	      </div>
	      @endif
	      <div class="form-group" style="margin: 40px;">
	      	<label>Type Code :</label>
	      	<input type="text" name="code" class="form-control" style="background-color: lightgray;width:40%;margin:20px;">
	      	<label>Type New Password :</label>
	      	<input type="password" name="pass" class="form-control" style="background-color: lightgray;width:40%;margin:20px;">
	      	<button type="submit" class="btn btn-success">Reset password</button>
	      	<a href="/codeback" class="btn btn-primary">Return to email/Resend</a>
	      </div>
	</form>
@else
    <form action="/resetpass" method="post">
	{{ csrf_field() }}
    @if(count($errors)>0)
      <br>
      <div class="alert alert-danger">
          <ul>
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif
      <div class="form-group" style="margin: 40px;">
      	<label>Type your Email :</label>
      	<input type="email" name="email" class="form-control" style="background-color: lightgray;width:40%;margin:20px;">
      	<button type="submit" class="btn btn-success">Send Code</button>
      </div>
      </form>
@endif
@stop