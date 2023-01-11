@extends('admin/master')
@section('content')
	<section class="wrapper">
	<div class="form-Touch-corp">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Shipping Companies
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
								<h3>Add New Company</h3>
								<form action="/admin/newcomp" method="POST" enctype="multipart/form-data">
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
									<label>Company Name</label>
									<input type="text" class="form-control" name="comp">
									<label>Company Logo</label>
									<input type="file" name="img">
									<br>
									<button type="submit">Add Company</button>
								</form>
                            </div>
                        </div>
						<div class="panel-body">
                            <div class="position-center">
								<h3>Add Zone to Company</h3>
								<form action="/admin/compzone" method="POST">
									{{ csrf_field() }}
									<label>Company</label>
									<select class="form-control" name="comp">
										<option value="">Select Company</option>
										@foreach($comps as $cmp)
										<option value="{{$cmp->id}}">{{$cmp->name}}</option>
										@endforeach						
									</select>
									<label>Zone</label>
									<select class="form-control" name="zone">
										<option value="">Select Zone</option>
										@foreach($zones as $zon)
										<option value="{{$zon->id}}">{{$zon->zone_name}}</option>
										@endforeach	
									</select>
									<label>Price in AED</label>
									<input type="text" class="form-control" name="price">
									<label>Days to Delever</label>
									<input type="text" class="form-control" name="days">
									<br>
									<button type="submit">Add Zone</button>
								</form>
                            </div>
                        </div>
						<div class="panel-body">
                        <div class="position-center">
                        	<h3>Edit Company</h3>
			                    @foreach($comps as $v)
							<form action="/admin/editcomp" method="post">
			                {{ csrf_field() }}
			                <div style="display: none" id="blockx{{$v->id}}">
			                <div class="form-group">
			                    <label>Company Name</label>
			                    <input type="text" class="form-control" name="comp" value="{{$v->name}}">
			                    <label>Company Logo</label>
								<input type="file" name="img">
								<img src="{{asset('/img/shipping')}}/{{$v->logo}}" width="120px">
			                </div>
			                <input type="text" name="id" value="{{$v->id}}" hidden>
			                <button type="submit" class="btn btn-primary">Save Edits</button>
			                <a href="/admin/comp/remove/{{$v->id}}" class="btn btn-danger">Remove</a>
			                </form>
			                <br><br>
			                <h4>Related Zones (check to auto unlink)</h4>
			                @foreach($relz as $vv)
			                @if($v->id==$vv->company)
			                <form action="/admin/editcompzone" method="post">
			                	{{ csrf_field() }}
			                	<input type="text" name="id" value="{{$vv->id}}" hidden>
				                <input type="checkbox" id="rc{{$vv->id}}">{{$vv->zone_name}}
				                <br>
				                <label>Price in AED</label>
										<input type="text" class="form-control" name="price" value="{{$vv->price}}">
										<label>Days to Delever</label>
										<input type="text" class="form-control" name="days" value="{{$vv->days}}">
										<br>
										<button type="submit">Edit Link Data</button>
										<br>
				                <script>
									$("#rc{{$vv->id}}").change(function(){
										location.href="/admin/remrelcomp/{{$vv->id}}";
									});
								</script>
								<hr>
				                @endif
				                @endforeach
				                <br>
				              </div>
				            </form>
			              @endforeach
			              <h5>Select company :</h5>
			                <select class="form-control" id="brogselector">
			                  <option value="0">Select Company</option>
			                  @foreach($comps as $v)
			                  <option value="{{$v->id}}">{{$v->name}}</option>
			                  @endforeach
			                </select>
			                <br>

			                <script type="text/javascript">
			                    $('#brogselector').change(function(){
			                    @foreach($comps as $v)
			                    if($('#brogselector').val()=={{$v->id}}){
			                        $('#blockx{{$v->id}}').show();
			                    }else{
			                        $('#blockx{{$v->id}}').hide();
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