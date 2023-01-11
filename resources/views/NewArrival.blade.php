@extends('master')
@section('content')
    
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" 
	style="background-image: url({{asset('img/pagesbanner/'.$banimg[10]->image)}});">
		<h2 class="l-text2 t-center">
        
              
        New Arrivals
              
          
		</h2>
	</section>
<br>

    <!-- Our product -->
    <section class="bgwhite p-t-45 p-b-58">
        <div class="container">
           

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




   
@stop
