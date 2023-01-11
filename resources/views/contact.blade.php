@extends('master')
@section('content')
<!-- Title Page -->
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url({{asset('img/pagesbanner/'.$banimg[2]->image)}});">
	<h2 class="l-text2 t-center">
		Contact
	</h2>
</section>
<br>
<div>
	<div class="container">
		<div class="row">

			
				<div class="col-12 col-md-4 p-b-30 ">
					<h3>{{$con[0]->data_body}}</h3>
					<p>{{$con[1]->data_body}}</p>
					<div class="address">
						@if($con[2]->state==1)
						<div class=" address-grid">
							<i class="glyphicon glyphicon-map-marker"></i>
							<div class="address1">
								<h3>Address</h3>
								<p>{{$con[2]->data_body}}</p>
							</div>
							<div class="clearfix"> </div>
						</div>
						@endif
						@if($con[3]->state==1)
						<div class=" address-grid ">
							<i class="glyphicon glyphicon-phone"></i>
							<div class="address1">
								<h3>Our Phone:<h3>
										<p>{{$con[3]->data_body}}</p>
							</div>
							<div class="clearfix"> </div>
						</div>
						@endif
						@if($con[4]->state==1)
						<div class=" address-grid ">
							<i class="glyphicon glyphicon-envelope"></i>
							<div class="address1">
								<h3>Email:</h3>
								<p><a href="mailto:{{$con[4]->data_body}}">{{$con[4]->data_body}}</a></p>
							</div>
							<div class="clearfix"> </div>
						</div>
						@endif
						@if($con[5]->state==1)
						<div class=" address-grid ">
							<i class="glyphicon glyphicon-bell"></i>
							<div class="address1">
								<h3>Open Hours:</h3>
								<p>{{$con[5]->data_body}}</p>
							</div>
							<div class="clearfix"> </div>
						</div>
						@endif
					</div>
				</div>

			<!-- map -->
			<div class="col-12 col-md-4 p-b-30">
				<div class="p-r-20 p-r-0-lg">
					<?php echo $stat->map; ?>
				</div>
			</div>
		
		</div>

	</div>



	<!-- content page -->
	
	<section class="bgwhite p-t-66 p-b-60 ">
		<div class="container">
			<div class="row">
				
				<div class="col-md-6 p-b-30  ">
					<form class="leave-comment" action="/sendmes" method="post">
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
						<h4 class="m-text26 p-b-36 p-t-15">
							Send us your message
						</h4>
						@if(!Auth::user())
						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="name" placeholder="Full Name" value="{{old('name')}}">
						</div>

						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" placeholder="Email" value="{{old('email')}}">
						</div>
						@else
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="name" placeholder="Full Name" hidden value="{{Auth::user()->user_name}} {{Auth::user()->user_name2}}">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="email" placeholder="Email" hidden value="{{Auth::user()->email}}">
						@endif
						<div class="bo4 of-hidden size15 m-b-20">
							<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="sub" placeholder="Subject" value="{{old('sub')}}">
						</div>

						<textarea class="dis-block s-text7 size20 bo4 p-l-22 p-r-22 p-t-13 m-b-20" name="message" placeholder="Message">{{old('message')}}</textarea>

						<div class="w-size25">
							<!-- Button -->
							<button class="flex-c-m size2 bg1 bo-rad-23 hov1 m-text3 trans-0-4" type="submit">
								Send
							</button>
						</div>
					</form>
				</div>
			
			</div>
		</div>
	</section>

	<div>
	</div>
	@stop