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
                            Sub Category Editing
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                               <form action="/admin/editsub" method="POST">
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
									<label for="exampleInputEmail1">Select Menu Name</label>
									<select class="form-control input-lg m-bot15" name="type" id="type">
										<option value="">Select Menu</option>
											@foreach($type as $v)
											@if($v->id==$sub->type_id)
											<option value="{{$v->id}}" selected>{{$v->type_name}}</option>
											@else
											<option value="{{$v->id}}">{{$v->type_name}}</option>
											@endif
											@endforeach
									</select>
									<label for="exampleInputEmail1">Select Category Name</label>
									<select class="form-control input-lg m-bot15" name="cat" id="cat">
										<option value="">Select category</option>
										@foreach($cat as $v)
											@if($v->type_id==$sub->type_id)
											<option value="{{$v->id}}" id="c{{$v->id}}{{$v->type_id}}" {{($sub->cat_id==$v->id)?'selected':''}}>{{$v->category_name}}</option>
											@else
											<option value="{{$v->id}}" style="display: none" id="c{{$v->id}}{{$v->type_id}}">{{$v->category_name}}</option>
											@endif
										@endforeach
									</select>
                                    <label for="exampleInputEmail1">Sub Category Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$sub->sub_name}}">
                                </div>
								<input type="text" value="{{$sub->id}}" name='id' hidden>
                                <button type="submit" class="btn btn-info">Save</button>
                                <a href="/admin/removesub/{{$sub->id}}" class="btn btn-danger">Remove</a>
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
      Sub Categories List
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
              </label>
            </th>
            <th>Sub Category Name</th>
            <th>By user</th>
            <th>Last Edite</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
     	@foreach($subs as $v)
			<tr>
				<td><label class="i-checks m-b-none"><input type="checkbox" id="{{$v->id}}"><i></i></label></td>
				<td>{{$v->sub_name}}</td>
				<td>{{$v->user_name}}</td>
				<td>{{$v->reg_date}}</td>
			</tr>
		<script>
			$("#{{$v->id}}").change(function(){
				location.href="/admin/editsubcat/{{$v->id}}";
			});
		</script>
		@endforeach
        </tbody>
      </table>
    </div>
    <br>
    <div style="text-align: right"> 
    	{!! $subs->render() !!}
	</div>
  </div>
</div>
   	<!-- page end-->
        </div>
</section>
<script type="text/javascript">
	$('#type').change(function(){
		$('#cat').val("");
		@foreach($cat as $div)
			if($('#type').val()!={{$div->type_id}}){
				$('#c{{$div->id}}{{$div->type_id}}').hide();
			}else{
				$('#c{{$div->id}}{{$div->type_id}}').show();
			}
		@endforeach
	});
</script>
@stop