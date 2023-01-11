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
                            New Product
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                            <form action="/admin/addproduct" method="POST" enctype="multipart/form-data">
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
                            		<label for="exampleInputEmail1">Select Sub Category Name</label>
									<select class="form-control input-lg m-bot15" name="sub" id="sub">
										<option value="">Select Sub category</option>
										@foreach($sub as $v)
											<option value="{{$v->id}}" style="display: none" id="s{{$v->id}}{{$v->cat_id}}">{{$v->sub_name}}</option>
										@endforeach
									</select>
									<label for="exampleInputEmail1">Select Brand Name</label>
									<select class="form-control input-lg m-bot15" name='brand'>
										<option value="">Select Brand</option>
										<option value="0">No/other Brand</option>
										@foreach($bran as $v)
											<option value="{{$v->id}}">{{$v->brand_name}}</option>
										@endforeach
									</select>
                                    <label for="exampleInputEmail1">Product Name</label>
                                    <input type="text" class="form-control" name="proname" value="{{old('proname')}}">
                                    <label for="exampleInputEmail1">Description</label>
                                    <input type="text" class="form-control" name="prodesc" value="{{old('prodesc')}}">
									<label for="exampleInputEmail1">Over View tab1</label>
                                    <textarea type="text" class="form-control" name="proover">{{old('proover')}}</textarea>
									<label for="exampleInputEmail1">Over View tab2</label>
                                    <textarea type="text" class="form-control" name="proover2">{{old('proover2')}}</textarea>
                                    <label for="exampleInputEmail1">RETAIL PRICE in AED</label>
                                    <input type="text" class="form-control" name="proret" value="{{old('proret')}}">
                                    <label for="exampleInputEmail1">Our Price in AED</label>
                                    <input type="text" class="form-control" name="propri" value="{{old('propri')}}">
                                    <label for="exampleInputEmail1">Size</label>
                                    <input type="text" class="form-control" name="prosize" value="{{old('prosize')}}">
									<label for="exampleInputEmail1">Color</label>
                                    <input type="Product" class="form-control" name="procol" value="{{old('procol')}}">
                                    <label for="exampleInputEmail1">CONDITION </label>
                                    <input type="Product" class="form-control" name="procon" value="{{old('procon')}}">
                                    <label for="exampleInputEmail1">INCLUSIONS </label>
                                    <input type="Product" class="form-control" name="proinc" value="{{old('proinc')}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile"> Primary Image</label>
                                    <input type="file" name="priimg">
									<label for="exampleInputFile"> Images</label>
									<input type="file" name="imgs[]" multiple>
                                    <p class="help-block">Standard Size of all product Image is 426x590</p>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputEmail1">Video Link (*Optional)</label>
                                    <input type="Product" class="form-control" name="provid">
                                </div>
                                <button type="submit">Add</button>
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
		$('#sub').val("");
		@foreach($sub as $div)
		$('#s{{$div->id}}{{$div->cat_id}}').hide();
		@endforeach
		@foreach($cat as $div)
			if($('#type').val()!={{$div->type_id}}){
				$('#c{{$div->id}}{{$div->type_id}}').hide();
			}else{
				$('#c{{$div->id}}{{$div->type_id}}').show();
			}
		@endforeach
	});
	$('#cat').change(function(){
		$('#sub').val("");
		@foreach($sub as $div)
			if($('#cat').val()!={{$div->cat_id}}){
				$('#s{{$div->id}}{{$div->cat_id}}').hide();
			}else{
				$('#s{{$div->id}}{{$div->cat_id}}').show();
			}
		@endforeach
	});
</script>
@stop