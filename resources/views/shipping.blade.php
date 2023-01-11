@extends('master')
@section('content')
<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" 
	style="background-image: url({{asset('img/pagesbanner/'.$banimg[0]->image)}});">
		<h2 class="l-text2 t-center">
			{{$end->shipping_head}}
		</h2>
	</section>
<br>
<div>
	<div class="col-md-6 contact-left">
		<p><?php echo $end->shipping; ?></p>
	</div>
</div>
@stop