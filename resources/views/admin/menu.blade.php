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
                            Main Menu Editing
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form action="/admin/editmenu" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    @if(count($errors)>0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <label for="exampleInputEmail1">Menu Name</label>
                                    <input type="text" class="form-control" name="typename"
									<?php if($sel){
										echo " value='".$men->type_name."'";
									}else{
										echo " disabled";
									}
									?>>
                                </div>
                                <div class="form-group">

                                    <label>Inner Banner</label>
                                    <input type="file" name="image">
                                    <p class="help-block">Standard Size of Banner is 160x240 px,don't add image if you want the old</p>
                                    @if($sel)
                                    <img src="{{asset('/img/menubanners')}}/{{$men->banner}}" width="150px">
                                    @endif
                                </div>
                               <input type="text" value="{{$sel?$men->id:''}}" name='typeid' hidden>
                                <button type="submit" name="edittype" class="btn btn-info">Edit</button>
                            </form>
                            </div>

                        </div>
                    </section>
            </div>
            
        </div>
        <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Menu List
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
                <p>Get</p>
              </label>
            </th>
            <th>Menu Name</th>
            <th>By Admin</th>
            <th>Last Edit</th>
          </tr>
        </thead>
        <tbody>
		<?php
		foreach($getmenu as $v){
			echo '<tr>
				<td><label class="i-checks m-b-none"><input type="checkbox" id="'.$v->id.'"><i></i></label></td>
				<td>'.$v->type_name.'</td>
				<td>'.$v->user_name.'</td>
				<td>'.$v->reg_date.'</td>
			</tr>
		<script>
			$("#'.$v->id.'").change(function(){
				location.href="/admin/menu/'.$v->id.'";
			});
		</script>';
		}
        ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- page end-->
</div>
</section>
@stop