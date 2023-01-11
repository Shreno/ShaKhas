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
                            Add New Category 
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form action="/admin/addcat" method="POST" enctype="multipart/form-data">
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
								<label for="exampleInputEmail1">Selected Menu Name</label>
									<select class="form-control input-lg m-bot15" name="type">
										@foreach($getmenu as $v)
											<option value="{{$v->id}}">{{$v->type_name}}</option>
										@endforeach
									</select>
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <input type="text" name="name" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Category innar Banner</label>
                                    <input type="file" name="image">
                                    <p class="help-block">Standard Size of Image is 1360x300</p>
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
@stop