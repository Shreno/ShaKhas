@extends('admin/master')
@section('content')
<section class="wrapper">
		<!-- //market-->
		<div class="market-updates">
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-2">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-eye"> </i>
					</div>
					 <div class="col-md-8 market-update-left">
					 <h4>Visitors</h4>
					 <?php
						if($stat->visits>=100000000){
							$stat->visits=substr($stat->visits,0,3).",".substr($stat->visits,3,1)." M";
						}else if($stat->visits>=10000000){
							$stat->visits=substr($stat->visits,0,2).",".substr($stat->visits,2,1)." M";
						}else if($stat->visits>=1000000){
							$stat->visits=substr($stat->visits,0,1).",".substr($stat->visits,1,1)." M";
						}else if($stat->visits>=100000){
							$stat->visits=substr($stat->visits,0,3).",".substr($stat->visits,3,1)." K";
						}else if($stat->visits>=10000){
							$stat->visits=substr($stat->visits,0,2).",".substr($stat->visits,2,1)." K";
						}
					 ?>
					<h3>{{$stat->visits}}</h3>
					<p>Other hand, we denounce</p>
				  </div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-users" ></i>
					</div>
					<div class="col-md-8 market-update-left">
					<h4>Users</h4>
						<h3>{{$usercount}}</h3>
						<p>Other hand, we denounce</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-usd"></i>
					</div>
					<?php
						$orders=count($buydata);
						$totalpice=[];
						foreach($buydata as $v){
							$totalpice[]=$v->price;
						}
						$totalpice=array_sum($totalpice);
						if($totalpice>=100000000){
							$totalpice=substr($totalpice,0,3).",".substr($totalpice,3,1)." M";
						}else if($totalpice>=10000000){
							$totalpice=substr($totalpice,0,2).",".substr($totalpice,2,1)." M";
						}else if($totalpice>=1000000){
							$totalpice=substr($totalpice,0,1).",".substr($totalpice,1,1)." M";
						}else if($totalpice>=100000){
							$totalpice=substr($totalpice,0,3).",".substr($totalpice,3,1)." K";
						}else if($totalpice>=10000){
							$totalpice=substr($totalpice,0,2).",".substr($totalpice,2,1)." K";
						}
						if($orders>=10000000){
							$orders=substr($orders,0,2).",".substr($orders,2,1)." M";
						}else if($orders>=1000000){
							$orders=substr($orders,0,1).",".substr($orders,1,1)." M";
						}else if($orders>=100000){
							$orders=substr($orders,0,3).",".substr($orders,3,1)." K";
						}else if($orders>=10000){
							$orders=substr($orders,0,2).",".substr($orders,2,1)." K";
						}
					?>
					<div class="col-md-8 market-update-left">
						<h4>Sales</h4>
						<h3>{{$totalpice}}</h3>
						<p>Other hand, we denounce</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-4">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Orders</h4>
						<h3>{{$orders}}</h3>
						<p>Other hand, we denounce</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div>
		<!-- Pag time -->
		<form action='/admin/bagtime' method='post'>
			{{ csrf_field() }}
        	@if(count($errors)>0)
            <br>
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
			<label style="width:100%">Remove products from Bag after:</label>
			<?php $pgtm=$stat->bagtime; ?>
			<input type="text" name="pagtime" class="form-control" style="width:20%;display:inline;margin-left:10px" <?php if(!empty($pgtm)){ echo "value='".$pgtm."'";} ?>>
			<span> Min </span>
			<br><br>
			<button type="submit" class="btn btn-primary">Save time</button>
		</form>
		<!-- Pag time End -->
		<!-- //market-->
		<div class="row">
			<div class="panel-body">
				<div class="col-md-12 w3ls-graph">
					<!--agileinfo-grap-->
						<div class="agileinfo-grap">
							<div class="agileits-box">
								<header class="agileits-box-header clearfix">
									<h3>Visitor Statistics</h3>
										<div class="toolbar">
											
											
										</div>
								</header>
								<div class="agileits-box-body clearfix">
									<div id="hero-area"></div>
								</div>
							</div>
						</div>
	<!--//agileinfo-grap-->

				</div>
			</div>
		</div>
</section>
@stop