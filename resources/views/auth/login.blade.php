@extends('master')
@section('content')
<!-- Page Details -->
<left>

<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box;
}

/* style the container */
.containerx {
  position: relative;
  background-color: #ffffff;
  padding: 4px 0 30px 0;
  width: 100%;
} 

/* style inputs and link buttons */
input,
.btn {
  width: 100%;
  padding: 12px;
  border: none;
  border-radius: 4px;
  margin: 5px 0;
  opacity: 0.85;
  display: inline-block;
  font-size: 17px;
  line-height: 20px;
  text-decoration: none; /* remove underline from anchors */
}

input:hover,
.btn:hover {
  opacity: 1;
}

/* add appropriate colors to fb, twitter and google buttons */
.fb {
  background-color: #3B5998;
  color: white;
}

.twitter {
  background-color: #55ACEE;
  color: white;
}

.google {
  background-color: #dd4b39;
  color: white;
}

/* style the submit button */
input[type=submit] {
  background-color: #111111;
  color: white;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #e65540;
}

/* Two-column layout */
.col {
  float: left;
  width: 50%;
  margin: auto;
  padding: 0 50px;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* vertical line */
.vl {
  position: absolute;
  left: 50%;
  transform: translate(-50%);
  border: 2px solid #ddd;
  height: 175px;
}

/* text inside the vertical line */
.vl-innertext {
  position: absolute;
  top: 50%;
  transform: translate(-50%, -50%);
  background-color: #f1f1f1;
  border: 1px solid #ccc;
  border-radius: 50%;
  padding: 8px 10px;
}

/* hide some text on medium and large screens */
.hide-md-lg {
  display: none;
}

/* bottom container */
.bottom-container {
  text-align: center;
  background-color: #666;
  border-radius: 0px 0px 4px 4px;
}

.p-t-26{
  padding-top: 0;
}

/* Responsive layout - when the screen is less than 650px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 650px) {
  .col {
    width: 100%;
    margin-top: 0;
  }
  /* hide the vertical line */
  .vl {
    display: none;
  }
  /* show the hidden text on small screens */
  .hide-md-lg {
    display: block;
    text-align: center;
  }
}

/* style the submit button */
input[type=x] {
  color: white;
  cursor: pointer;
text-align: center;
}

input[type=x]:hover {
  background-color: #e65540;
}
</style>

<div class="containerx">
    <div class="row">
      <div class="vl">
      </div>

      
      <div class="col">
        <form action="/log" method="post">
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
        <div class="hide-md-lg">
          <p>Or sign in manually:</p>
        </div>

        <h1>Sign In</h1>
        <div class="wrap-input100 m-b-16">
            <input class="input100" type="text" name="email" placeholder="Email">
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 m-b-20">
            <span class="btn-show-pass">
              
            </span>
            <input class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100"></span>
            <input type="checkbox" name="remember" style="width:30px">Remember Me
          </div>
          <div class="container-login100-form-btn">
            <input type="submit" value="Login">
      </div>
    </form>
    <a href="/repass">Forget Password ?</a>
	<a href="/auth/facebook" class="fb btn">
          <i class="fa fa-facebook fa-fw"></i> Login with Facebook
         </a>
        <a href="/auth/google" class="google btn"><i class="fa fa-google fa-fw">
          </i> Login with Google+
        </a>
  </div>
	
<div class="col">
        
<form action="/reg" method="post">
    {{ csrf_field() }}
    <div class="containerx">
      <div class="limiter">
      <h1>Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
      <label for="email"><b>First Name</b></label>
      <input type="text" placeholder="Enter First Name" name="first_name" value="{{old('first_name')}}">
      <label for="email"><b>Last Name</b></label>
      <input type="text" placeholder="Enter Last Name" name="last_name" value="{{old('last_name')}}">

      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" value="{{old('email')}}">

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password">

      <label for="psw-repeat"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="password_confirmation">
      <label for="psw-repeat"><b>phone</b></label>
      <input type="text" placeholder="Your phone" name="phone" value="{{old('phone')}}">
        <div class="line">
            <p class="attention">country</p>
            <div class="login-mail">
                <select  name="country">
                    @foreach($countr as $cont)
                    @if(old('country')==$cont->id)
                    <option value="{{$cont->id}}" selected>{{$cont->country}}</option>
                    @else
                    <option value="{{$cont->id}}">{{$cont->country}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>

      <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

      <div class="clearfix">
        <input type="submit" value="Sign Up">
      </div>
    </div>
  </div>
  </form>
      </div>
  <!-- Page Details -->

<center>
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
    background-color: black;
}

* {
    box-sizing: border-box;
}

/* Add padding to containers */
.country-form {
    padding: 20px;
    background-color: white;
}
.limiter{
  margin: 5px 1% 0 1% ;
  padding: 20px;
  border: 2px solid #f1f1f1;
  border-radius: 5px;
}
.p-r-45{
  width: 100%;
}
/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
}

/* Overwrite default styles of hr */
hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
    background-color: #111111;
    color: white;
    padding: 16px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}

.registerbtn:hover {
    opacity: 1;
}

/* Add a blue text color to links */
a {
    color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
    background-color: #f1f1f1;
    text-align: center;
}
</style>
</head>
<body>


</center>



    <!-- Page Details -->
@stop