@extends('admin/master')
@section('content')
<section class="wrapper">
	<div class="gallery">
		<h4 >{{$prop->name}}</h4>
        <h4> Category : {{$prop->category_name}}</h4>
        <h4> Brand : {{$prop->brand_name}}</h4>
        <div class="checkbox">
			<label>
				<input type="checkbox" id="app" <?php if($prop->approve==1){echo "checked";} ?>> Approve
			</label>
		</div>
		<script>
			$('#app').change(function(){
				location.href='/admin/propapprove/{{$prop->id}}';
			});
		</script>
		<div class="gallery-grids">
		<?php
			$images=explode(",",$prop->imgs);
			foreach($images as $x){
		?>
			<div class="gallery-top-grids">
				<div class="col-sm-4 gallery-grids-left">
					<div class="gallery-grid">
						<img src="{{asset('/img/proposal')}}/{{$x}}" alt="" />
					</div>
				</div>
			</div>
		<?php
			}
		?>
		<div class="clearfix"> </div>
		<a href="/admin/prop" class="btn btn-success">Back to Proposals</a>
		<script src="js/lightbox-plus-jquery.min.js"> </script>
		</div>
	</div>
	<!-- //gallery -->
</section>
@stop