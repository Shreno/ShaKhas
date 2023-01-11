@extends('admin/master')
@section('content')
<section class="wrapper">
    @if($sel)
	<div class="form-Touch-corp">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Category Editing
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form action="/admin/editcat" method="POST" enctype="multipart/form-data">
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
								<label for="exampleInputEmail1">Selected Menu Name</label>
									<select class="form-control input-lg m-bot15" name="type">
										@foreach($getmenu as $v)
											@if($sel&&$cat->type_id==$v->id)
											<option value="{{$v->id}}" selected>{{$v->type_name}}</option>
											@else
											<option value="{{$v->id}}">{{$v->type_name}}</option>
											@endif
										@endforeach
									</select>
                                    <label for="exampleInputEmail1">Category Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$sel?$cat->category_name:''}}">
                                </div>
                               
                                <div class="form-group">
                                    <label for="exampleInputFile">Category Inner Banner</label>
                                    <input type="file" name="image">
                                    <p class="help-block">Standard Size of Image is 1360x300,Don't put file if you need old</p>
                                    @if($sel)
                                    <img src="{{asset('/img/category')}}/{{$cat->img}}" width="120px">
                                    @endif
                                </div>
                               <input type="text" value="{{$sel?$cat->id:''}}" name='id' hidden>
                               @if($sel)
                                <button type="submit" name="editcat" class="btn btn-info">Save</button>
                                <a href="/admin/removecat/{{$cat->id}}" class="btn btn-danger">Remove</a>
                                @endif
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
            
        </div>
        <div class="table-agile-info">
    @endif
  <div class="panel panel-default">
    <div class="panel-heading">
      Categories List
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
              <label class="i-checks m-b-none">
              </label>
            </th>
            <th>Category Name</th>
            <th>By user</th>
            <th>Last Edit</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        	@foreach($cats as $v)
		    <tr>
				<td><label class="i-checks m-b-none"><input type="checkbox" id="{{$v->id}}"><i></i></label></td>
				<td>{{$v->category_name}}</td>
				<td>{{$v->user_name}}</td>
				<td>{{$v->reg_date}}</td>
			</tr>
		<script>
			$("#{{$v->id}}").change(function(){
				location.href="/admin/editcat/{{$v->id}}";
			});
		</script>
		@endforeach
        </tbody>
      </table>
    </div>
    <br>
    <div style="text-align: right"> 
    	{!! $cats->render() !!}
	</div>
  </div>
</div>
@stop