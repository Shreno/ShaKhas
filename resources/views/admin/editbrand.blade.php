@extends('admin/master')
@section('content')
<section class="wrapper">
	<div class="form-Touch-corp">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Brands Editing
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                            <form action="/admin/editbrand" method="POST" enctype="multipart/form-data">
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
                                <div class="form-group">
                                    <label>Brand Name</label>
                                    <input type="text" class="form-control" name="brandname" value="{{$sel?$brand->brand_name:''}}">
                                </div>
                                <div class="form-group">
                                    <label>Brand Logo</label>
                                    <input type="file" name="image">
                                    <p class="help-block">Standard Size of Logo is 1280x720(16:9),don't put new file if you want old</p>
                                    @if($sel)
                                    <img src="{{asset('/img/Brands')}}/{{$brand->img}}" width="120px">
                                    @endif
                                </div>
								<input type="text" value="{{$sel?$brand->id:''}}" name='id' hidden>
                                <button type="submit" class="btn btn-info">Save</button>
                                @if($sel)
                                <a href="/admin/removebrand/{{$brand->id}}" class="btn btn-danger">Remove</a>
                                @endif
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
            
        </div>
        <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Brand List
    </div>
    <div class="row w3-res-tb">
      
      <div class="col-sm-4">
      </div>
      
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
            </th>
            <th>Brand Name</th>
            <th>By user</th>
            <th>Last Edite</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        	@foreach($getmenu as $v)
          	<tr>
				<td><label class="i-checks m-b-none"><input type="checkbox" id="{{$v->id}}"><i></i></label></td>
				<td>{{$v->brand_name}}</td>
				<td>{{$v->user_name}}</td>
				<td>{{$v->reg_date}}</td>
			</tr>
		<script>
			$("#{{$v->id}}").change(function(){
				location.href="/admin/editbrand/{{$v->id}}";
			});
		</script>
		@endforeach
        </tbody>
      </table>
    </div>
    <br>
    <div style="text-align: right"> 
    	{!! $getmenu->render() !!}
	</div>
  </div>
</div>
        <!-- page end-->
        </div>
</section>
@stop