@extends('master')
@section('content')
<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/heading-pages-06.jpg);">
		<h2 class="l-text2 t-center">
			{{$end->terms_head}}
		</h2>
	</section>
<br>
<div>
	<div class="col-md-6 contact-left">
		<p><?php echo $end->terms; ?></p>
	</div>
</div>
@stop