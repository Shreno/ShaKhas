@extends('master')
@section('content')
<!-- Page Details -->
	<center>
	  <h2>{{Auth::user()->user_name}} {{Auth::user()->user_name2}} Account</h2>
	  <br>
<style>
.btn {
  background-color: black;
  border: 1px solid white;
  color: white;
  padding: 30px 40px;
  text-align: center;
  font-size: 20px;
  margin: 4px 2px;
  opacity: 0.8;
  transition: 0.3s;
}

.btn:hover {opacity: 4}
.inp{
	background-color: #bbbbbb;
	width: 40%;
	color: white;
}
.inp:focus{
	background-color: #d8d8d8;
	color:black;
}
.panel-default {
    border-color: #ddd;
}
.panel {
    margin-bottom: 20px;
    background-color: #fff;
    border: 1px solid transparent;
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.panel-body {
    padding: 15px;
}
.panel-default>.panel-heading {
    color: #333;
    background-color: #f5f5f5;
    border-color: #ddd;
}
.panel-heading {
    padding: 10px 15px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
}
</style>

<center>
<button class="btn" id="wl"> <a href= "#"  > View wish List</a></button>
<button class="btn" id="bil"> <a href= "#"  > View all Oreders</a></button>
<button class="btn" id="set"> <a href= "#"  > Settings And Account</a></button>
<button class="btn"> <a href= "/sell"  > Proposal/Sell With US</a></button>
<button class="btn" id="inp"> <a href= "#"  > Inbox {{($newmes!=0)?'('.$newmes.')':''}}</a></button>

@if(count($errors)>0)
<br>
<div class="alert alert-danger">
  <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
  </ul>
</div>
<?php $errors=[]; ?>
@endif

<div id="wls" style="display: none">
	<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
			<!-- Cart item -->
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table-shopping-cart">
						<tr class="table-head">
							<th class="column-1">Click on image to remove</th>
							<th class="column-2">Product</th>
							<th class="column-3">Price</th>
							<th class="column-3">Status</th>
						</tr>
						@foreach($wish as $w)
						<tr class="table-row">
							<td class="column-1">
								<a href="/wishtog/{{$w->id}}">
									<div class="cart-img-product b-rad-4 o-f-hidden">
										<img src="{{asset('/img/products')}}/{{$w->img}}" alt="IMG-PRODUCT">
									</div>
								</a>
							</td>
							<td class="column-2">
								@if($w->status=='show')
								<a href="/product/{{$w->id}}">{{$w->product_name}}</a>
								@else
								{{$w->product_name}}
								@endif
							</td>
							<td class="column-3">{{$w->price}} AED</td>
							<td class="colum-4">
								@if($w->status=='show')
								<strong style="color:green">Available</strong>
								@elseif($w->status=='sold')
								<strong style="color:red">Sold</strong>
								@else
								<strong style="color:orange">Removed By Admin</strong>
								@endif
							</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</section>
</div>
<div id="st" style="display: none;margin-top: 20px;">
	<form action="/edituser" method="post">
		{{ csrf_field() }}
		<h4>Settings</h4>
          <div class="form-groub">
          	<label>User First Name</label>
          	<input type="text" name="username" class="form-control inp" value="{{Auth::user()->user_name}}" placeholder="User First Name">
          	<label>User Last Name</label>
          	<input type="text" name="username2" class="form-control inp" value="{{Auth::user()->user_name2}}" placeholder="User Last Name">
          	<label>Phone</label>
          	<input type="text" name="phone" class="form-control inp" value="{{Auth::user()->phone}}" placeholder="phone">
          	<label>Address</label>
          	<input type="text" name="address" class="form-control inp" value="{{Auth::user()->address}}" placeholder="address">
          	<button class="btn btn-success" style="padding: 5px;" type="submit">Save Edits</button>
          </div>		
	</form>
	<form action="/edituserpass" method="post">
		{{ csrf_field() }}
		<h4>Edit Password</h4>
          <div class="form-groub">
          	<label>Old Password</label>
          	<input type="password" name="opass" class="form-control inp" placeholder="old password">
          	<label>New Password</label>
          	<input type="password" name="pass" class="form-control inp" placeholder="new password">
          	<label>Re New Password</label>
          	<input type="password" name="pass_confirmation" class="form-control inp" placeholder="new password">
          	<button class="btn btn-success" style="padding: 5px;" type="submit">Save Edits</button>
          </div>		
	</form>
</div>
<div id="pr" style="display: none;margin-top: 20px;">
	<form action="/sendproposal" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		<h4>Send product Proposal</h4>
        <div class="form-groub">
          	<label>Product Name</label>
          	<input type="text" name="name" class="form-control inp" placeholder="Product">
          	<label>Product Images</label>
          	<br>
			<input type="file" name="imgs[]" multiple>
			<br>
			<label>Price in AED</label>
          	<input type="text" name="price" class="form-control inp" placeholder="Price">
          	<label>link</label>
          	<input type="text" name="link" class="form-control inp" placeholder="like youtube video .. facebook image etc..">
        	<button class="btn btn-success" style="padding: 5px;" type="submit">Send</button>
        </div>
    </form>
</div>
<div id="in" style="display: none;margin-top: 20px;">
	<a href="/contact" class="btn btn-success" style="padding: 5px;background-color: black">Send Message</a>
	@if(count($mesg)==0)
	<h4>No Messages yet</h4>
	@endif
	@foreach($mesg as $v)
	@if($v->seen=='no')
	<div class="panel panel-default">
	    <div class="panel-heading"><strong>{{$v->subject}} (New) : {{$v->reg_date}}</strong></div>
	    <div class="panel-body">{{$v->message}}</div>
	</div>
	@endif
	@endforeach
	@foreach($mesg as $v)
	@if($v->seen=='yes')
	<div class="panel panel-default">
	    <div class="panel-heading">{{$v->subject}} : {{$v->reg_date}}</div>
	    <div class="panel-body">{{$v->message}}</div>
	</div>
	@endif
	@endforeach
</div>
<div id="bi" style="display: none;margin-top: 20px;">
	<table class="table-shopping-cart" style="width: 70%;">
		<tr class="table-head">
			<th class="column-1">Order no</th>
			<th class="column-2">Price</th>
			<th class="column-3">Status</th>
		</tr>
		<?php $i=1; ?>
		@foreach($ord as $r)
		<tr class="table-row">
			<td>{{$i}}</td>
			<td>{{$r->price}}</td>
			<td>{{$r->stat}}</td>
		</tr>
		<?php $i++; ?>
		@endforeach
	</table>
</div>
<script type="text/javascript">
	$('#wl').click(function(){
		$('#wls').toggle();
		$('#st').hide();
		$('#pr').hide();
		$('#in').hide();
		$('#bi').hide();
	});
	$('#set').click(function(){
		$('#wls').hide();
		$('#st').toggle();
		$('#pr').hide();
		$('#in').hide();
		$('#bi').hide();
	});
	$('#pro').click(function(){
		$('#wls').hide();
		$('#st').hide();
		$('#pr').toggle();
		$('#in').hide();
		$('#bi').hide();
	});
	$('#inp').click(function(){
		$('#wls').hide();
		$('#st').hide();
		$('#pr').hide();
		$('#in').toggle();
		$('#bi').hide();
	});
	$('#bil').click(function(){
		$('#wls').hide();
		$('#st').hide();
		$('#pr').hide();
		$('#in').hide();
		$('#bi').toggle();
	});
</script>

	<!-- Page Details -->
@stop