@extends('master')
@section('content')
<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" 
	style="background-image: url({{asset('img/pagesbanner/'.$banimg[4]->image)}});">
		<h2 class="l-text2 t-center">
			About
		</h2>
	</section>

	<!-- content page -->
	<section class="bgwhite p-t-66 p-b-38">
		<div class="container">
			<div class="row">
				<div class="col-md-4 p-b-30">
					<div class="hov-img-zoom">
						<img src="/img/pagesbanner/{{$banimg[5]->image}}" alt="IMG-ABOUT">
					</div>
				</div>

				<div class="col-md-8 p-b-30">
					<h3 class="m-text26 p-t-15 p-b-16">
						{{$about->about_head}}
					</h3>

					<p class="p-b-28">
						{{$about->about}}
					</p>
				</div>
			</div>
		</div>
	</section>
@stop