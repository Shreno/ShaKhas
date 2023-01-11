@extends('master')
@section('content')
<!-- breadcrumb -->
	<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
		<a href="/" class="s-text16">
			Home
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<a href="/products/{{$su->id}}" class="s-text16">
			{{$ca->category_name}}
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>
		<a href="/products/{{$su->id}}" class="s-text16">
			{{$su->sub_name}}
			<i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
		</a>

		<span class="s-text17">
			{{$list->product_name}}
		</span>
	</div>

	<!-- Product Detail -->
	<div class="container bgwhite p-t-35 p-b-80">
		<div class="flex-w flex-sb">
			<div class="w-size13 p-t-30 respon5">
				<div class="wrap-slick3 flex-sb flex-w">
					<div class="wrap-slick3-dots"></div>

					<div class="slick3">
						<div class="item-slick3" data-thumb="{{asset('img/products')}}/{{$list->img}}">
							<div class="wrap-pic-w">
								<img src="{{asset('img/products')}}/{{$list->img}}" alt="IMG-PRODUCT">
							</div>
						</div>
						<?php 
							$imgs=[];
							$imgs=explode(',', $list->imgs); 
						?>
						@foreach($imgs as $im)
						@if($im!="")
						<div class="item-slick3" data-thumb="{{asset('img/products/imgs')}}/{{$im}}">
							<div class="wrap-pic-w">
								<img src="{{asset('img/products/imgs')}}/{{$im}}" alt="IMG-PRODUCT">
							</div>
						</div>
						@endif
						@endforeach
					</div>
				</div>
			</div>

			<div class="w-size14 p-t-30 respon5">
				<h4 class="product-detail-name m-text16 p-b-13">
					{{$list->product_name}}
				</h4>

				<span class="m-text17">
					{{$list->price}} AED
				</span>

				<p class="s-text8 p-t-10">
					{{$list->description}}
				</p>

				<!--  -->
				<div class="p-t-33 p-b-60">
					<div class="flex-m flex-w p-b-10">
						<div class="s-text15 w-size15 t-center">
							Size
						</div>

						<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
							<select class="form-control" name="size">
								<option>{{$list->size}}</option>
							</select>
						</div>
					</div>

					<div class="flex-m flex-w">
						<div class="s-text15 w-size15 t-center">
							Color
						</div>

						<div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
							<select class="form-control" name="size">
								<option>{{$list->color}}</option>
							</select>
						</div>
					</div>

					<div class="flex-r-m flex-w p-t-10">
						<div class="w-size16 flex-m flex-w">
							<div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
								<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
								</button>

								<input class="size8 m-text18 t-center num-product" type="number" name="num-product" value="1">

								<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
									<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
								</button>
							</div>
							<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
								<!-- Button -->
								<?php $not=false; ?>
                                @if(Auth::user())
                                @foreach($cart as $carta)
                                @if($list->id==$carta->product_id)
                                <?php $not=true; ?>
                                @endif
                                @endforeach
                                @if($not)
                                <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" id="addcartn{{$list->id}}">
                                    Remove from cart
                                </button>
                                @else
                                <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" id="addcart{{$list->id}}">
                                    Add to Cart
                                </button>
                                @endif
                                @else
                                <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" id="nlog{{$list->id}}">
                                    add to Cart
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $('#addcart{{$list->id}}').click(function(){
                            $.ajaxSetup({
                              headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                              }
                            });
                            $.post("/addcart",{
                                  id: '{{$list->id}}'
                              });
                            location.reload();
                        });
                        $('#addcartn{{$list->id}}').click(function(){
                            $.ajaxSetup({
                              headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                              }
                            });
                            $.post("/addcart",{
                                  id: '{{$list->id}}'
                              });
                            location.reload();
                        });
                        $('#nlog{{$list->id}}').click(function(){
                            location.href="/logwithcart/{{$list->id}}";
                        });
                    </script>

				<div class="p-b-45">
					<span class="s-text8 m-r-35">SKU: MUG-01</span>
					<span class="s-text8">Categories: Mug, Design</span>
				</div>

				<!--  -->
				<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						{{$stat->tab1}}
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							{{$list->overview}}
						</p>
					</div>
				</div>

				<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						{{$stat->tab2}}
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							{{$list->overview2}}
						</p>
					</div>
				</div>

				<div class="wrap-dropdown-content bo7 p-t-15 p-b-14">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Reviews (0)
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							Fusce ornare mi vel risus porttitor dignissim. Nunc eget risus at ipsum blandit ornare vel sed velit. Proin gravida arcu nisl, a dignissim mauris placerat
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Relate Product -->
	<section class="relateproduct bgwhite p-t-45 p-b-138">
		<div class="container">
			<div class="sec-title p-b-60">
				<h3 class="m-text5 t-center">
					Related Products
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">
					@foreach($rel as $re)
					@if($re->id!=$list->id)
					<div class="item-slick2 p-l-15 p-r-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-img wrap-pic-w of-hidden pos-relative">
								<img src="{{asset('img/products')}}/{{$re->img}}" alt="IMG-PRODUCT">

								<div class="block2-overlay trans-0-4">
									<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
										<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
										<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
									</a>

									<div class="block2-btn-addcart w-size1 trans-0-4">
										<!-- Button -->
										@if(Auth::user())
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" id="addcart{{$re->id}}">
											Add to Cart
										</button>
										@else
										<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" disabled>
											add to Cart
										</button>
										@endif
									</div>
								</div>
							</div>
							<script type="text/javascript">
		                        $('#addcart{{$re->id}}').click(function(){
		                            $.ajaxSetup({
		                              headers: {
		                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		                              }
		                            });
		                            $.post("/addcart",{
		                                  id: '{{$re->id}}'
		                              });
		                            location.reload();
		                        });
		                    </script>
							<div class="block2-txt p-t-20">
								<a href="/product/{{$re->id}}" class="block2-name dis-block s-text3 p-b-5">
									{{$re->product_name}}
								</a>

								<span class="block2-price m-text6 p-r-5">
									{{$re->price}} AED
								</span>
							</div>
						</div>
					</div>
					@endif
					@endforeach
				</div>
			</div>

		</div>
	</section>
@stop