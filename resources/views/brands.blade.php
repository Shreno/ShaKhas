@extends('master')
@section('content')
<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" 
	style="background-image: url({{asset('img/pagesbanner/'.$banimg[8]->image)}});">
		<h2 class="l-text2 t-center">
			Brands
		</h2>
	</section>

	<!-- content page -->
	<section class="bgwhite p-t-66 p-b-38">
		<div class="container">
        <hr />
        <div class="col-md-12 t-center">
					<h3 class="m-text26 p-t-15 p-b-16 ">
						<a href="#num">0-9 &nbsp;&nbsp;</a> <a href="#a">A &nbsp;&nbsp;</a><a href="#b"> B &nbsp;&nbsp; </a><a href="#c">C &nbsp;&nbsp; </a><a href="#d">D &nbsp;&nbsp; </a><a href="#e">E &nbsp;&nbsp; </a><a href="#f">F &nbsp;&nbsp; </a><a href="#g">G &nbsp;&nbsp; </a><a href="#h">H &nbsp;&nbsp; </a><a href="#i">I &nbsp;&nbsp; </a><a href="#j">J &nbsp;&nbsp; </a><a href="#k">K &nbsp;&nbsp; </a><a href="#l">L &nbsp;&nbsp; </a><a href="#m">M &nbsp;&nbsp; </a><a href="#n"> N &nbsp;&nbsp;<a href="#o"> O &nbsp;&nbsp;<a href="#p"> P &nbsp;&nbsp; <a href="#q"> Q &nbsp;&nbsp; <a href="#r">R &nbsp;&nbsp; <a href="#s">S &nbsp;&nbsp; <a href="#t">T &nbsp;&nbsp; <a href="#u">U &nbsp;&nbsp; <a href="#v">V &nbsp;&nbsp; <a href="#w">W &nbsp;&nbsp; <a href="#x">X &nbsp;&nbsp; <a href="#y">Y &nbsp;&nbsp; <a href="#z"> Z</a>
					</h3>
        </div>
        <hr />
			<div class="row">
				<div class="col-md-3 p-b-30">
					<div class="hov-img-zoom">
						<img src="images/{{$stat->brand_img}}" alt="IMG-Brands">
					</div>
				</div>

				<div style="" class="col-md-9 p-b-30 ">
					<h3 class="m-text26 p-t-15 p-b-16" id="num">
						0-9
					</h3>

					<p class="p-b-20">
                    <div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($ztn as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
                        </p>
                    <h3 class="m-text26 p-t-15 p-b-16" id="a">
						A
					</h3>

					<p class="p-b-20">
                    <div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($ach as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
                    </p>
					<h3 class="m-text26 p-t-15 p-b-16" id="b">
						B
					</h3>

					<p class="p-b-20">
                    <div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($bch as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
                    </p>
                    <h3 class="m-text26 p-t-15 p-b-16" id="c">
						C
					</h3>
					<p class="p-b-20">
                    <div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($cch as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
                    </p>
					<h3 class="m-text26 p-t-15 p-b-16" id="d">
						D
					</h3>
					<div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($dch as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
					<h3 class="m-text26 p-t-15 p-b-16" id="e">
						E
					</h3>
					<div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($ech as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
					<h3 class="m-text26 p-t-15 p-b-16" id="f">
						F
					</h3>
					<div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($fch as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
					<h3 class="m-text26 p-t-15 p-b-16" id="g">
						G
					</h3>
					<div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($gch as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
					<h3 class="m-text26 p-t-15 p-b-16" id="h">
						H
					</h3>
					<div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($hch as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
					<h3 class="m-text26 p-t-15 p-b-16" id="i">
						I
					</h3>
					<div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($ich as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
					<h3 class="m-text26 p-t-15 p-b-16" id="j">
						J
					</h3>
					<div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($jch as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
					<h3 class="m-text26 p-t-15 p-b-16" id="k">
						K
					</h3>
					<div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($kch as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
					<h3 class="m-text26 p-t-15 p-b-16" id="l">
						L
					</h3>
					<div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($lch as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
					<h3 class="m-text26 p-t-15 p-b-16" id="m">
						M
					</h3>
					<div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($mch as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
					<h3 class="m-text26 p-t-15 p-b-16" id="n">
						N
					</h3>
					<div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($nch as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
					<h3 class="m-text26 p-t-15 p-b-16" id="o">
						O
					</h3>
					<div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($nch as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
					<h3 class="m-text26 p-t-15 p-b-16" id="p">
						P
					</h3>
					<div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($nch as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
					<h3 class="m-text26 p-t-15 p-b-16" id="q">
						Q
					</h3>
					<div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($nch as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
					<h3 class="m-text26 p-t-15 p-b-16" id="r">
						R
					</h3>
					<div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($nch as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
					<h3 class="m-text26 p-t-15 p-b-16" id="s">
						S
					</h3>
					<div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($nch as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
					<h3 class="m-text26 p-t-15 p-b-16" id="t">
						T
					</h3>
					<div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($nch as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
					<h3 class="m-text26 p-t-15 p-b-16" id="u">
						U
					</h3>
					<div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($nch as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
					<h3 class="m-text26 p-t-15 p-b-16" id="v">
						V
					</h3>
					<div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($nch as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
					<h3 class="m-text26 p-t-15 p-b-16" id="w">
						W
					</h3>
					<div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($nch as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
					<h3 class="m-text26 p-t-15 p-b-16" id="x">
						X
					</h3>
					<div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($nch as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
					<h3 class="m-text26 p-t-15 p-b-16" id="y">
						Y
					</h3>
					<div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($nch as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
					<h3 class="m-text26 p-t-15 p-b-16" id="z">
						Z
					</h3>
					<div class="row ">
                    	<?php $x=0; ?>
                    	<div class="col-md-3">
                    	@foreach($nch as $v)
		                        <a href="/brandpro/{{$v->id}}">{{$v->brand_name}}</a><br>
		                    <?php if($x%2==0&&$x!=0){ ?>
		                    	</div>
		                        <div class="col-md-3">
                   			<?php } $x++;?>
                        @endforeach
                        </div>                    
                    </div>
				</div>
			</div>
		</div>
	</section>
@stop