@extends('admin/master')
@section('content')
<section class="wrapper">
	<div class="form-Touch-corp">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Orders List
                        </header>
                        <div class="panel-body">
							  <table class="table">
								<thead>
								  <tr>
									<th>User Name</th>
									<th>Order Link</th>
									<th>Price</th>
									<th>Payment</th>
									<th>Transfare ID</th>
									<th>Date</th>
									<th>Status</th>
								  </tr>
								</thead>
								<tbody> 
									<?php
										foreach($getorders as $v){
											echo'
										<tr class="danger">
											<td>'.$v->user_name." ".$v->user_name2.'</td>
											<td><a href="/admin/orders/'.$v->id.'">here</a></td>
											<td>'.$v->price.'</td>
											<td>'.$v->payment_method.'</td>
											<td>'.$v->transfare_id.'</td>
											<td>'.$v->reg_data.'</td>
											<td><select class="form-control" id="s'.$v->id.'">
										';
										foreach($getstatus as $vv){
											if($v->order_status==$vv->id){
												echo '<option value="'.$vv->id.'" selected>'.$vv->state.'</option>';
											}else{
												echo '<option value="'.$vv->id.'">'.$vv->state.'</option>';
											}
										}
										echo '
											</select></td>
										<tr>
										<script>
											$("#s'.$v->id.'").on("change", function() {
												location.href="/changeorder/'.$v->id.'/"+$("#s'.$v->id.'").val();
											});
											$( "#r'.$v->id.'" ).click(function() {
												$.ajax({  
													type: "POST",  
													url: "index.php",
													data: { removeorder: true ,id: '.$v->id.' }
												});
												location.reload();
											});
										</script>
										';					
										}
									?>
								</tbody>
							  </table>
                        </div>
                    </section>
            </div>           
        </div>
		<!-- page end-->
        </div>
</section>
@stop