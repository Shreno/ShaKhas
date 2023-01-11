@extends('admin/master')
@section('content')
	<section class="wrapper">
	<div class="form-Touch-corp">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Bills Status Control
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
								<h3>Set Primary status (show before admin see bill!)</h3>
								<form action="/admin/billstatuspr" method="POST">
									{{ csrf_field() }}
									<label>Status Name</label>
									<input type="text" class="form-control" name="pstatus" value="{{$prstat->state}}">
									<br>
									<button type="submit">Edit Primary Status</button>
								</form>
                            </div>
                        </div>
						<div class="panel-body">
                            <div class="position-center">
								<h3>Add New Status</h3>
								<form action="/admin/addbillstat" method="POST">
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
									<label>Status Name</label>
									<input type="text" class="form-control" name="status" >
									<label>Status Message (Mail)</label>
									<input type="text" class="form-control" name="statusmessage">
									<p>Hint : Request/ Order Details Automatic Send With Mail</p>
									<br>
									<select class="form-control" name="action">
										<option value="0">Select Action On Product/s</option>
										<option value="0">No Action</option>
										<option value="1">Back Product/s to Show</option>
										<option value="2">Remove Product/s</option>
										<option value="3">Send Product/s to History</option>
									</select>
									<br>
									<button type="submit">Add Status</button>
								</form>
                            </div>
                        </div>
						<div class="panel-body">
                            <div class="position-center">
								<h3>Edit/Show Status</h3>
								@foreach($allstat as $st)
								<form action="/admin/editbillstat" method="POST" style="display: none" id="f{{$st->id}}">
									{{ csrf_field() }}
									<label>Status Name</label>
									<input type="text" class="form-control" name="status" value="{{$st->state}}">
									<label>Status Message (Mail)</label>
									<input type="text" class="form-control" name="statusmessage" value="{{$st->message}}">
									<br>
									<select class="form-control" name="action">
										<option value="0">Select Action On Product/s</option>
										<option value="0">No Action</option>
										<option value="1" {{$st->action==1?"selected":""}}>Back Product/s to Show</option>
										<option value="2" {{$st->action==2?"selected":""}}>Remove Product/s</option>
										<option value="3" {{$st->action==3?"selected":""}}>Send Product/s to History</option>
									</select>

									<br>
									<button type="submit" class="btn btn-primary">Edit Status</button>
									<a href="/admin/removestatus/{{$st->id}}" class="btn btn-danger">Remove</a>
									<input type="text" name="id" value="{{$st->id}}" hidden>
								</form>
								@endforeach
								<br>
								<select id="stsel" class="form-control">
									<option value="">Select Status To Edit</option>
									@foreach($allstat as $st)
									<option value="{{$st->id}}">{{$st->state}}</option>
									@endforeach
								</select>
								<script type="text/javascript">
									$('#stsel').change(function(){
										@foreach($allstat as $st)
										if($('#stsel').val()=={{$st->id}}){
											$('#f{{$st->id}}').show();
										}else{
											$('#f{{$st->id}}').hide();
										}
										@endforeach
									});
								</script>
                            </div>
                        </div>
                    </section>
            </div>           
        </div>
		<!-- page end-->
        </div>
</section>
@stop