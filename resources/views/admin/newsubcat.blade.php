@extends('admin/master')
@section('content')
<section class="wrapper">
	<div class="form-Touch-corp">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sub Category Creating
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form action="/admin/addnewsub" method="POST">
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
											<option value="{{$v->id}}">{{$v->type_name}}</option>
											@endforeach
									</select>
									<label for="exampleInputEmail1">Select Category Name</label>
									<select class="form-control input-lg m-bot15" name="cat" id="cat">
										<option value="">Select category</option>
										@foreach($cat as $v)
											<option value="{{$v->id}}" style="display: none" id="c{{$v->id}}{{$v->type_id}}">{{$v->category_name}}</option>
										@endforeach
									</select>
                                    <label for="exampleInputEmail1">Sub Category Name</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                               
                                <button type="submit" class="btn btn-info">Add</button>
                            </form>
                            </div>

                        </div>
                    </section>

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