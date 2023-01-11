@extends('master')
@section('content')
<!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m">
		<h2 class="l-text2 t-center" style="text-shadow: 2px 2px 2px black;">
			{{$su->brand_name}}
		</h2>
	</section>


	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
				<form action="/filter" method="post">
					{{ csrf_field() }}
					<div class="leftbar p-r-20 p-r-0-sm">
						<!--  -->
						<h4 class="m-text14 p-b-7">
							Color
						</h4>

						<ul class="p-b-54" style="overflow-y:scroll; height:200px;">
							@foreach($colors as $col)
							<li class="p-t-4">
								<input type="checkbox" name="color[]" hidden value="{{$col->color}}" id="colo{{$col->color}}"
								<?php
									$ccolor='black';
									$coll=Session::get('filtercol');
									if(!empty($coll)){
							    		$coll=explode(',', $coll);
							    		foreach($coll as $brnn){
								    		if($brnn!=""&&$brnn==$col->color){
								    			echo 'checked';
								    			$ccolor='red';
								    		}
								    	}
							    	}
								?>
								>
								<a class="s-text13 active1" style="cursor: pointer;color:{{$ccolor}}" id="col{{$col->color}}">
									{{$col->color}}
								</a>
							</li>
							<script type="text/javascript">
								$('#col{{$col->color}}').click(function(){
									if(this.style.color=='red'){
										this.style.color='black';
										$('#colo{{$col->color}}').prop('checked', false);
									}else{
										this.style.color='red';
										$('#colo{{$col->color}}').prop('checked', true);
									}
								});
							</script>
							@endforeach
						</ul>
						<h4 class="m-text14 p-b-7">
							Size
						</h4>

						<ul class="p-b-54" style="overflow-y:scroll; height:200px;">
							<?php $i=0; ?>
							@foreach($sizes as $col)
							<li class="p-t-4">
								<input type="checkbox" name="size[]" hidden value="{{$col->size}}" id="size{{$i}}"
								<?php
									$scolor='black';
									$siz=Session::get('filtersiz');
									if(!empty($siz)){
							    		$siz=explode(',', $siz);
							    		foreach($siz as $brnn){
								    		if($brnn!=""&&$brnn==$col->size){
								    			echo 'checked';
								    			$scolor='red';
								    		}
								    	}
							    	}
								?>
								>
								<a class="s-text13 active1" style="cursor: pointer;color:{{$scolor}}" id="siz{{$i}}">
									{{$col->size}}
								</a>
							</li>
							<script type="text/javascript">
								$("#siz{{$i}}").click(function(){
									if(this.style.color=='red'){
										this.style.color='black';
										$("#size{{$i}}").prop('checked', false);
									}else{
										this.style.color='red';
										$("#size{{$i}}").prop('checked', true);
									}
								});
							</script>
							<?php $i++; ?>
							@endforeach
						</ul>
						<h4 class="m-text14 p-b-7">
							Condition
						</h4>

						<ul class="p-b-54" style="overflow-y:scroll; height:200px;">
							<?php $i=0; ?>
							@foreach($condi as $col)
							<li class="p-t-4">
								<input type="checkbox" name="condi[]" hidden value="{{$col->conditions}}" id="coni{{$i}}"
								<?php
									$cocolor='black';
									$co=Session::get('filtercon');
									if(!empty($co)){
							    		$co=explode(',', $co);
							    		foreach($co as $brnn){
								    		if($brnn!=""&&$brnn==$col->conditions){
								    			echo 'checked';
								    			$cocolor='red';
								    		}
								    	}
							    	}
								?>
								>
								<a class="s-text13 active1" style="cursor: pointer;color:{{$cocolor}}" id="con{{$i}}">
									{{$col->conditions}}
								</a>
							</li>
							<script type="text/javascript">
								$("#con{{$i}}").click(function(){
									if(this.style.color=='red'){
										this.style.color='black';
										$("#coni{{$i}}").prop('checked', false);
									}else{
										this.style.color='red';
										$("#coni{{$i}}").prop('checked', true);
									}
								});
							</script>
							<?php $i++; ?>
							@endforeach
						</ul>
						<br>
						<button class="flex-c-m size4 bg7 bo-rad-15 hov1 s-text14 trans-0-4" type="submit" name="fl">
							Filtering
						</button>
						<br>
						<a class="flex-c-m size4 bg7 bo-rad-15 hov1 s-text14 trans-0-4" href="/clearfilter">
							Clear All
						</a>
						<br>
						<!--  -->
						<h4 class="m-text14 p-b-32">
							Filters
						</h4>

						<div class="filter-price p-t-22 p-b-50 bo3">
							<div class="m-text15 p-b-17">
								Price
							</div>

							<div class="wra-filter-bar">
								<div id="filter-bar"></div>
							</div>

							<div class="flex-sb-m flex-w p-t-16">
								<div class="w-size11">
									<!-- Button -->
									<button class="flex-c-m size4 bg7 bo-rad-15 hov1 s-text14 trans-0-4">
										Filter
									</button>
								</div>

								<div class="s-text3 p-t-10 p-b-10">
									Range: $<span id="value-lower">610</span> - $<span id="value-upper">980</span>
								</div>
							</div>
						</div>

						<div class="filter-color p-t-22 p-b-50 bo3">
							<div class="m-text15 p-b-12">
								Color
							</div>

							<ul class="flex-w">
								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter1" type="checkbox" name="color-filter1">
									<label class="color-filter color-filter1" for="color-filter1"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter2" type="checkbox" name="color-filter2">
									<label class="color-filter color-filter2" for="color-filter2"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter3" type="checkbox" name="color-filter3">
									<label class="color-filter color-filter3" for="color-filter3"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter4" type="checkbox" name="color-filter4">
									<label class="color-filter color-filter4" for="color-filter4"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter5" type="checkbox" name="color-filter5">
									<label class="color-filter color-filter5" for="color-filter5"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter6" type="checkbox" name="color-filter6">
									<label class="color-filter color-filter6" for="color-filter6"></label>
								</li>

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter7" type="checkbox" name="color-filter7">
									<label class="color-filter color-filter7" for="color-filter7"></label>
								</li>
							</ul>
						</div>
						<div class="search-product pos-relative bo4 of-hidden">
							<input class="s-text7 size6 p-l-23 p-r-50" type="text" name="search-product" placeholder="Search Products...">

							<button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
								<i class="fs-12 fa fa-search" aria-hidden="true"></i>
							</button>
						</div>
					</div>
				</form>
				</div>

				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					<!--  -->
					<div class="flex-sb-m flex-w p-b-35">
						<div class="flex-w">
							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="form-control" name="sorting" id="sort">
									<option value="0">Sorting</option>
									<option value="1" {{(isset($srt)&&$srt==1)?'selected':''}}>Popularity</option>
									<option value="2" {{(isset($srt)&&$srt==2)?'selected':''}}>Newest</option>
									<option value="3" {{(isset($srt)&&$srt==3)?'selected':''}}>oldest</option>
									<option value="4" {{(isset($srt)&&$srt==4)?'selected':''}}>Price: low to high</option>
									<option value="5" {{(isset($srt)&&$srt==5)?'selected':''}}>Price: high to low</option>
								</select>
							</div>
							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select class="form-control" name="sorting" id="price">
									<option value="0">Price</option>
									<option value="1" {{(isset($pri)&&$pri==1)?'selected':''}}>0 - 100 AED</option>
									<option value="2" {{(isset($pri)&&$pri==2)?'selected':''}}>100 AED - 500 AED</option>
									<option value="3" {{(isset($pri)&&$pri==3)?'selected':''}}>500 AED - 1000 AED</option>
									<option value="4" {{(isset($pri)&&$pri==4)?'selected':''}}>1000 AED - 4000 AED</option>
									<option value="5" {{(isset($pri)&&$pri==5)?'selected':''}}>4000+ AED</option>
								</select>
							</div>
							<button class="btn" style="height: 40px;margin-top: 5px;background-color: #333333;color: white" id="sortexe">Execute</button>
						</div>
						<script>
							$("#sortexe").click(function(){
								location.href="/products/{{$su->id}}/"+$("#sort").val()+"/"+$("#price").val();
							});
						</script>
					</div>

					<!-- Product -->
					<div class="row">
						@foreach($list as $lis)
						@if($lis->status=='show')
						<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative">
									<img src="{{asset('img/products')}}/{{$lis->img}}" alt="IMG-PRODUCT">

									<div class="block2-overlay trans-0-4">
										@if(Auth::user())
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true" id="addwish1{{$lis->id}}"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true" id="addwish2{{$lis->id}}"></i>
										</a>
										<script type="text/javascript">
											$('#addwish1{{$lis->id}}').click(function(){
												location.href='/wishtog/{{$lis->id}}';
											});
											$('#addwish2{{$lis->id}}').click(function(){
												location.href='/wishtog/{{$lis->id}}';
											});
										</script>
										@endif
										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button -->
											<?php $not=false; ?>
                                                @if(Auth::user())
                                                @foreach($cart as $carta)
                                                @if($lis->id==$carta->product_id)
                                                <?php $not=true; ?>
                                                @endif
                                                @endforeach
                                                @if($not)
                                                <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" id="addcartn{{$lis->id}}">
                                                    Remove from cart
                                                </button>
                                                @else
                                                <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" id="addcart{{$lis->id}}">
                                                    Add to Cart
                                                </button>
                                                @endif
                                                @else
                                                <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" id="nlog{{$lis->id}}">
                                                    add to Cart
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        $('#addcart{{$lis->id}}').click(function(){
                                            $.ajaxSetup({
                                              headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                              }
                                            });
                                            $.post("/addcart",{
                                                  id: '{{$lis->id}}'
                                              });
                                            location.reload();
                                        });
                                        $('#addcartn{{$lis->id}}').click(function(){
                                            $.ajaxSetup({
                                              headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                              }
                                            });
                                            $.post("/addcart",{
                                                  id: '{{$lis->id}}'
                                              });
                                        });
                                        $('#nlog{{$lis->id}}').click(function(){
                                            location.href="/logwithcart/{{$lis->id}}";
                                        });
                                    </script>

								<div class="block2-txt p-t-20">
									<a href="/product/{{$lis->id}}" class="block2-name dis-block s-text3 p-b-5">
										{{$lis->product_name}}
									</a>

									<span class="block2-price m-text6 p-r-5">
										{{$lis->price}} AED / <s>{{$lis->ret_price}} AED</s>
									</span>
								</div>
							</div>
						</div>
						@endif
						@endforeach	
					</div>

					<!-- Pagination -->
					{!! $list->render() !!}
				</div>
			</div>
		</div>
	</section>
@stop