@extends('admin/master')
@section('content')
<section class="wrapper">
	@if($sel)
	<div class="form-Touch-corp">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Edit Product
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                            <form action="/admin/editproduct" method="POST" enctype="multipart/form-data">
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
											@if($v->id==$prod->type_id)
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
											@if($v->id==$prod->cat_id)
											<option value="{{$v->id}}" id="c{{$v->id}}{{$v->type_id}}" selected>
											{{$v->category_name}}</option>
											@elseif($v->type_id==$prod->type_id)
											<option value="{{$v->id}}" id="c{{$v->id}}{{$v->type_id}}">
											{{$v->category_name}}</option>
											@else
											<option value="{{$v->id}}" style="display: none" id="c{{$v->id}}{{$v->type_id}}">
											{{$v->category_name}}</option>
											@endif
										@endforeach
									</select>
                            		<label for="exampleInputEmail1">Select Sub Category Name</label>
									<select class="form-control input-lg m-bot15" name="sub" id="sub">
										<option value="">Select Sub category</option>
										@foreach($sub as $v)
											@if($v->id==$prod->sub_id)
											<option value="{{$v->id}}" id="s{{$v->id}}{{$v->cat_id}}" selected>{{$v->sub_name}}</option>
											@elseif($v->cat_id==$prod->cat_id)
											<option value="{{$v->id}}" id="s{{$v->id}}{{$v->cat_id}}">{{$v->sub_name}}</option>
											@else
											<option value="{{$v->id}}" style="display: none" id="s{{$v->id}}{{$v->cat_id}}">{{$v->sub_name}}</option>
											@endif
										@endforeach
									</select>
									<label for="exampleInputEmail1">Select Brand Name</label>
									<select class="form-control input-lg m-bot15" name='brand'>
										<option value="">Select Brand</option>
										<option value="0">No/other Brand</option>
										@foreach($bran as $v)
											@if($v->id==$prod->brand_id)
											<option value="{{$v->id}}" selected>{{$v->brand_name}}</option>
											@else
											<option value="{{$v->id}}">{{$v->brand_name}}</option>
											@endif
										@endforeach
									</select>
                                    <label for="exampleInputEmail1">Product Name</label>
                                    <input type="text" class="form-control" name="proname" value="{{$prod->product_name}}">
                                    <label for="exampleInputEmail1">Description</label>
                                    <input type="text" class="form-control" name="prodesc" value="{{$prod->description}}">
									<label for="exampleInputEmail1">Over View tab1</label>
                                    <textarea type="text" class="form-control" name="proover">{{$prod->overview}}</textarea>
									<label for="exampleInputEmail1">Over View tab2</label>
                                    <textarea type="text" class="form-control" name="proover2">{{$prod->overview2}}</textarea>
                                    <label for="exampleInputEmail1">RETAIL PRICE in AED</label>
                                    <input type="text" class="form-control" name="proret" value="{{$prod->ret_price}}">
                                    <label for="exampleInputEmail1">Our Price in AED</label>
                                    <input type="text" class="form-control" name="propri" value="{{$prod->price}}">
                                    <label for="exampleInputEmail1">Size</label>
                                    <input type="text" class="form-control" name="prosize" value="{{$prod->size}}">
									<label for="exampleInputEmail1">Color</label>
                                    <input type="Product" class="form-control" name="procol" value="{{$prod->color}}">
                                    <label for="exampleInputEmail1">CONDITION </label>
                                    <input type="Product" class="form-control" name="procon" value="{{$prod->conditions}}">
                                    <label for="exampleInputEmail1">INCLUSIONS </label>
                                    <input type="Product" class="form-control" name="proinc" value="{{$prod->inclusions}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile"> Primary Image</label>
                                    <input type="file" name="priimg">
                                    <br>
                                    <img src="/img/products/{{$prod->img}}" width=120px>
                                    <br>
									<label for="exampleInputFile"> Images</label>
									<input type="file" name="imgs[]" multiple>
                                    <p class="help-block">Standard Size of all product Image is 426x590</p>
                                    <br>
                                    @foreach(explode(",",$prod->imgs) as $v)
                                    @if($v!="")
                                    <img src="/img/products/imgs/{{$v}}" width=120px>
                                    @endif
                                    @endforeach
                                    <br>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputEmail1">Video Link (*Optional)</label>
                                    <input type="Product" class="form-control" name="provid" value="{{$prod->video_link}}">
                                </div>
                                <input type="text" name="id" value="{{$prod->id}}" hidden>
                                <button type="submit" class="btn btn-primary">Edit</button>
                                @if($prod->status=='show')
                                <a href="/admin/hideproduct/{{$prod->id}}" class="btn btn-warning">Hide</a>
                                @elseif($prod->status=='hide')
                                <a href="/admin/hideproduct/{{$prod->id}}" class="btn btn-warning">Show</a>
                                @else
                                <button class="btn btn-warning" disabled>Sold</button>
                                @endif
                                @if($prod->hotdeal==1)
                                <a href="/admin/hotproduct/{{$prod->id}}" class="btn btn-success">Remove hotdeal</a>
                                @elseif($canhot)
                                <a href="/admin/hotproduct/{{$prod->id}}" class="btn btn-success">Make hotdeal</a>
                                @else
                                <button class="btn btn-success" disabled>Hotdeal Limit</button>
                                @endif
                                <a href="/admin/removeproduct/{{$prod->id}}" class="btn btn-danger">Remove</a>
                            </form>
                            </div>
                        </div>
                    </section>
            </div>
        </div>
	@endif
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Products List
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-3">
		<p>Search by Name :-</p>
        <div class="input-group">
          <input type="text" class="input-sm form-control" id="sdata">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" id="s" type="button">go!</button>
          </span>
        </div>
      </div>
    </div>
	<p>(*try type "hidden" to see the hidden products- Try type "hotdeal" to see the hot deal products)</p>
	<script>
			$("#s").click(function(){
				if($('#sdata').val()!="")
					location.href='/admin/editproduct/search/'+$('#sdata').val();
				else
					location.href='/admin/editproduct';
			});
		</script>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
              </label>
            </th>
            <th>Product Name</th>
            <th>By user</th>
            <th>Last Edit</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
			<tr>
				@foreach($prods as $v)
				<td><label class="i-checks m-b-none"><input type="checkbox" id="{{$v->id}}"><i></i></label></td>
				<td>{{$v->product_name}}</td>
				<td>{{$v->user_name}}</td>
				<td>{{$v->edit_date}}</td>
			</tr>
		<script>
			$("#{{$v->id}}").change(function(){
				location.href="/admin/editproduct/{{$v->id}}";
			});
		</script>     
			@endforeach 
        </tbody>
      </table>
    </div>
       <br>
    <div style="text-align: right"> 
    	{!! $prods->render() !!}
	</div>
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