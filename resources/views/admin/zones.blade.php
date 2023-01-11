@extends('admin/master')
@section('content')
	<section class="wrapper">
	<div class="form-Touch-corp">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Shipping Zones
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
							<h3>Add New Zone</h3>
							<form action="/admin/newzone" method="POST">
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
								<label>Zone Name</label>
								<input type="text" class="form-control" name="zone">
								<br>
								<button type="submit">Add Zone</button>
							</form>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="position-center">
							<h3>Add Country to Zone</h3>
							<form action="/admin/contzone" method="POST">
								{{ csrf_field() }}
								<label>Zone</label>
								<select class="form-control" name="zone">
									@foreach($zones as $v)
									<option value="{{$v->id}}">{{$v->zone_name}}</option>
									@endforeach
								</select>
								<label>Country</label>
								<select class="form-control" name="cont">
									@foreach($cont as $v)
									<option value="{{$v->id}}">{{$v->country}}</option>
									@endforeach
								</select>
								<br>
								<button type="submit">Link Zone/Country</button>
							</form>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="position-center">
                        	<h3>Edit Zone</h3>
                    @foreach($zones as $v)
				<form action="/admin/editzones" method="post">
                {{ csrf_field() }}
                <div style="display: none" id="blockx{{$v->id}}">
                <h4 >Edit zone</h4>
                <div class="form-group">
                    <label>Zone Name</label>
                    <input type="text" class="form-control" name="zone" value="{{$v->zone_name}}">
                </div>
                <input type="text" name="id" value="{{$v->id}}" hidden>
                <button type="submit" class="btn btn-primary">Save Edits</button>
                <a href="/admin/zones/remove/{{$v->id}}" class="btn btn-danger">Remove</a>
                <br><br>
                <h5>Related Countries (check to auto unlink)</h5>
                @foreach($relz as $vv)
                @if($v->id==$vv->zone)
                <input type="checkbox" id="rc{{$vv->id}}">{{$vv->cont}}
                <br>
                <script>
					$("#rc{{$vv->id}}").change(function(){
						location.href="/admin/remrel/{{$vv->id}}";
					});
				</script>
                @endif
                @endforeach
                <br>
              </div>
            </form>
              @endforeach
                <select class="form-control" id="brogselector">
                  <option value="0">Select Zone</option>
                  @foreach($zones as $v)
                  <option value="{{$v->id}}">{{$v->zone_name}}</option>
                  @endforeach
                </select>
                <br>
                <script type="text/javascript">
                    $('#brogselector').change(function(){
                    @foreach($zones as $v)
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