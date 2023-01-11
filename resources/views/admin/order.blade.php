@extends('admin/master')
@section('content')
<section class="wrapper">
	<div class="form-Touch-corp">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Order
                        </header>
                        <div class="panel-body">
							<h2>User Data:-</h2>
							<h4>Name: <?php echo $getorder->user_name." ".$getorder->user_name2; ?></h4>
							<h4>Phone: <?php echo $getorder->phone; ?></h4>
							<h4>Email: <?php echo $getorder->email; ?></h4>
							<h2>Shipping Data:-</h2>
							<h4>Shipping Company: <?php echo $getorder->name; ?></h4>
							<h4>Country: <?php echo $getshippinginfo->country; ?></h4>
							<h4>Zip-code: <?php echo $getshippinginfo->zip; ?></h4>
							<h4>City: <?php echo $getshippinginfo->city; ?></h4>
							<h4>Name of Agent in Order: {{$getshippinginfo->full_name}}</h4>
							<h4>Address: {{$getshippinginfo->Address}}</h4>
							<h2>Products Order:-</h2>
							<?php
								foreach($getproducts as $v){
									echo '<h4>'.$v->product_name.'</h4>';
								}
							?>
							<a href="/admin/orders">Back to Menu</a>
                        </div>
                    </section>
            </div>           
        </div>
		<!-- page end-->
        </div>
</section>
@stop