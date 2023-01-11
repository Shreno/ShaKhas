@extends('master')
@section('content')
    <!-- Slide1 -->
    <section class="slide1">
        <div class="wrap-slick1">
            <div class="slick1">
                <?php $i=0; ?>
                @foreach($panner as $pan)
                @if($i>1)
				
                <div class="item-slick1 item1-slick1" style="background-image: url(img/panners/{{$pan->image}});">
                    <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
                        <h2 class="caption1-slide1 xl-text2 t-center bo14 p-b-6 animated visible-false m-b-22" data-appear="fadeInUp">
                            {{$pan->word1}}
                        </h2>

                        <span class="caption2-slide1 m-text1 t-center animated visible-false m-b-33" data-appear="fadeInDown">
                            {{$pan->word2}}
                        </span>

                        <div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
                            <!-- Button -->
                            <a href="{{$pan->link}}" class="flex-c-m size2 bo-rad-23 s-text2 bgwhite hov1 trans-0-4">
                                Shop Now
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                <?php $i++; ?>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Banner -->
    

    <!-- Our product -->
    <section class="bgwhite p-t-45 p-b-58">
        <div class="container">
            <div class="sec-title p-b-22">
            <a href="{{url('NewArrival')}}"> <h3 class="m-text5 t-center">
                New Arrivals  
                </h3></a>
            </div>

            <!-- Tab01 -->
            <div class="tab01">
                <!-- Nav tabs -->
                
                <!-- Tab panes -->
                <div class="tab-content p-t-35">
                    <!-- - -->
                    <div class="tab-pane fade show active" id="best-seller" role="tabpanel">
                        <div class="row">
                            @foreach($newarrv as $n)
                            <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                                <!-- Block2 -->
                                <div class="block2">
                                    <div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew">
                                        <img src="{{asset('/img/products')}}/{{$n->img}}" alt="IMG-PRODUCT">

                                        <div class="block2-overlay trans-0-4">
                                            @if(Auth::user())
                                        <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true" id="addwish1{{$n->id}}"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true" id="addwish2{{$n->id}}"></i>
                                        </a>
                                        <script type="text/javascript">
                                            $('#addwish1{{$n->id}}').click(function(){
                                                location.href='/wishtog/{{$n->id}}';
                                            });
                                            $('#addwish2{{$n->id}}').click(function(){
                                                location.href='/wishtog/{{$n->id}}';
                                            });
                                        </script>
                                        @endif

                                            <div class="block2-btn-addcart w-size1 trans-0-4">
                                                <!-- Button -->
                                                <?php $not=false; ?>
                                                @if(Auth::user())
                                                @foreach($cart as $carta)
                                                @if($n->id==$carta->product_id)
                                                <?php $not=true; ?>
                                                @endif
                                                @endforeach
                                                @if($not)
                                                <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" id="addcartn{{$n->id}}">
                                                    Remove from cart
                                                </button>
                                                @else
                                                <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" id="addcart{{$n->id}}">
                                                    Add to Cart
                                                </button>
                                                @endif
                                                @else
                                                <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4" id="nlog{{$n->id}}">
                                                    add to Cart
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        $('#addcart{{$n->id}}').click(function(){
                                            $.ajaxSetup({
                                              headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                              }
                                            });
                                            $.post("/addcart",{
                                                  id: '{{$n->id}}'
                                              });
                                            location.reload();
                                        });
                                        $('#addcartn{{$n->id}}').click(function(){
                                            $.ajaxSetup({
                                              headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                              }
                                            });
                                            $.post("/addcart",{
                                                  id: '{{$n->id}}'
                                              });
                                            location.reload();
                                        });
                                        $('#nlog{{$n->id}}').click(function(){
                                            location.href="/logwithcart/{{$n->id}}";
                                        });
                                    </script>
                                    <div class="block2-txt p-t-20">
                                        <a href="/product/{{$n->id}}" class="block2-name dis-block s-text3 p-b-5">
                                            {{$n->product_name}}
                                        </a>

                                        <span class="block2-price m-text6 p-r-5">
                                            {{$n->price}} AED <s> {{$n->ret_price}} AED</s>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Hot Deals By Islam -->
<div class="banner bgwhite p-t-40 p-b-40">
        <div class="container">
            <div class="sec-title p-b-22">
				<a href="{{url('hotdeals')}}"><h3 class="m-text5 t-center">
                    Hot Deals
                </h3></a>
            </div>
            <div class="row">
				
                @foreach($hotdeal as $hot)
                <div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
                    <!-- block1 -->
                    <div class="block1 hov-img-zoom pos-relative m-b-30">
                        <img src="{{asset('/img/products')}}/{{$hot->img}}" alt="IMG-BENNER">

                        
                    </div>
					<div class="block2-txt p-t-20">
                                        <a href="/product/{{$hot->id}}" class="block2-name dis-block s-text3 p-b-5">
                                            {{$hot->product_name}}
                                        </a>

                                        <span class="block2-price m-text6 p-r-5">
                                            {{$hot->price}} AED <s> {{$hot->ret_price}} AED</s>
                                        </span>
                                    </div> 
					
                </div>
                @endforeach
            </div>
        </div>
    </div>


    <!-- Banner video -->
    <section class="parallax0 parallax100" style="background-image: url(img/panners/{{$panner[1]->image}});">
        <div class="overlay0 p-t-190 p-b-200">
            <div class="flex-col-c-m p-l-15 p-r-15">
                <span class="m-text9 p-t-45 fs-20-sm">
                    {{$panner[1]->word1}}
                </span>

                <h3 class="l-text1 fs-35-sm">
                    {{$panner[1]->word2}}
                </h3>

                <span class="btn-play s-text4 hov5 cs-pointer p-t-25">
                    <i class="fa fa-play" aria-hidden="true"></i>
                    <a href="{{$panner[1]->link}}" style="color:white">Play Video</a>
                </span>
            </div>
        </div>
    </section>
@stop
