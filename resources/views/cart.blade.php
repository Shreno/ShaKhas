@extends('master')
@section('content')
<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" 
	style="background-image: url({{asset('img/pagesbanner/'.$banimg[7]->image)}});">
		<h2 class="l-text2 t-center">
			Cart
		</h2>
	</section>

	<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
			<!-- Cart item -->
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">
					<table class="table-shopping-cart">
						<tr class="table-head">
							<th class="column-1"></th>
							<th class="column-2">Product</th>
							<th class="column-3">Price</th>
							
							<th class="column-5">Total</th>
						</tr>
						<?php $totp=0; ?>
                        @foreach($cart as $carta)
						<tr class="table-row">
							<td class="column-1">
								<a href="/removecart/{{$carta->product_id}}">
								<div class="cart-img-product b-rad-4 o-f-hidden">
									<img src="{{asset('img/products')}}/{{$carta->img}}" alt="IMG-PRODUCT">
								</div>
								</a>
							</td>
							<td class="column-2">{{$carta->product_name}}</td>
							<td class="column-3">{{$carta->price}} AED</td>
							
							<td class="column-5">{{$carta->price}} AED</td>
						</tr>
						<?php $totp+=$carta->price; ?>
                        @endforeach
					</table>
				</div>
			</div>

			<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
				<div class="flex-w flex-m w-full-sm">
					<div class="size11 bo4 m-r-10">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="coupon-code" placeholder="Coupon Code">
					</div>

					<div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
						<!-- Button -->
						<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
							Apply coupon
						</button>
					</div>
				</div>

				<div class="size10 trans-0-4 m-t-10 m-b-10">
					<!-- Button -->
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
						Update Cart
					</button>
				</div>
			</div>

			<!-- Total -->
			<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
				<h5 class="m-text20 p-b-24">
					Order Summary
				</h5>

				<!--  -->
				<div class="flex-w flex-sb-m p-b-12">
					<span class="s-text18 w-size19 w-full-sm">
						Subtotal:
					</span>

					<span class="m-text21 w-size20 w-full-sm">
						{{$totp}} AED
					</span>
				</div>

				<!--  -->
				<div class="flex-w flex-sb bo10 p-t-15 p-b-20">
					<span class="s-text18 w-size19 w-full-sm">
						Shipping:
					</span>

					<div class="w-size20 w-full-sm">
						<p class="s-text8 p-b-23">
							If There are no shipping methods available. Please double check your address, or contact us if you need any help.
						</p>

						<span class="s-text19">
							Calculate Shipping
						</span>
						<form action="/newcountry" method="post" id="editcon">
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
							<div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
								<select class="form-control" name="country" id="contr">
									<option>Select a country...</option>
									@foreach($count as $v)
									@if(Auth::user()->country==$v->id)
									<option value="{{$v->id}}" selected>{{$v->country}}</option>
									@else
									<option value="{{$v->id}}">{{$v->country}}</option>
									@endif
									@endforeach
								</select>
							</div>
						</form>
						<script type="text/javascript">
		                    $('#contr').change(function(){
		                    	$('#editcon').submit();
		                    });
		                </script>
		        <form action="/tobill" method="post" id="editcon">
						{{ csrf_field() }}
						<div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
							<select class="form-control" name="comp" id="comp">
								<option value="">Shipping Company</option>
								@foreach($comp as $c)
								@if(Auth::user()->country==$c->country)
								<option value="{{$c->id}}">{{$c->name}}</option>
								@endif
								@endforeach
							</select>
						</div>

						<div class="size13 bo4 m-b-12">
						<input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="city" placeholder="City">
						</div>

						<div class="size13 bo4 m-b-22">
							<input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="zip" placeholder="Postcode / Zip">
						</div>
						<div class="size13 bo4 m-b-12">
						<input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="name" placeholder="Full Name" value="{{Auth::user()->address}}">
						</div>
						<div class="size13 bo4 m-b-12">
						<input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="address" placeholder="Address" value="{{Auth::user()->address}}">
						</div>

						
					
					</div>
				</div>

				<!--  -->
				<div class="flex-w flex-sb-m p-t-26 p-b-30">
					<span class="m-text22 w-size19 w-full-sm">
						Total:
					</span>

					<span class="m-text21 w-size20 w-full-sm" id='total'>
						Select Shipping Company
					</span>
				</div>
				<script type="text/javascript">
					$('#comp').change(function(){
						if($('#comp').val()==''){
							$('#total').text('Select Shipping Company');
						}
						@foreach($comp as $c)
						@if(Auth::user()->country==$c->country)
						if($('#comp').val()=={{$c->id}}){
							$('#total').text('{{$totp+$c->price}} AED');
						}
						@endif
						@endforeach	
					});
						
				</script>
				<div class="size15 trans-0-4">
					<!-- Button -->
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" type="submit">
						Proceed to Checkout
					</button>
				</div>
			</form>
			</div>
		</div>
	</section>
@stop