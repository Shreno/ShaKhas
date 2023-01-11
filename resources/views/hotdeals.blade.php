@extends('master')
@section('content')
<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" 
	style="background-image: url({{asset('img/pagesbanner/'.$banimg[9]->image)}});">
		<h2 class="l-text2 t-center">
        
              
                    Hot Deals
              
          
		</h2>
	</section>
<br>
<div class="banner bgwhite p-t-40 p-b-40">
        <div class="container">
            
            <div class="row">
                
                @foreach($hotdeals as $hot)
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
@stop