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
                            Add New Brands 
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form action="/admin/branlogo" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>Brand Main Logo</label>
                                        <input type="file" name="mlogo">
                                    </div>
                                    <button type="submit" class="btn btn-info">Save Image</button>
                                </form>
                                <hr>
                                <form action="/admin/addbrand" method="POST" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control" name="brandname">
                                </div>
                                <div class="form-group">
                                    <label>Brand Logo</label>
                                    <input type="file" name="brandlogo">
                                    <p class="help-block">Standard Size of Logo is 1280x720(16:9)</p>
                                </div>
                                <button type="submit" name="addbrand" class="btn btn-info">Save</button>
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