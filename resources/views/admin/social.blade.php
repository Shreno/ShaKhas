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
                            Social media Links
                        </header>
						<p> * Insert the full link ex(https://www.facebock.com/shaika)</p>
                        <div class="panel-body">
                            <div class="position-center">
                                <form class="cmxform form-horizontal" action='/admin/social' method='POST'>
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
                                <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-3">Facebook Page</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="Face" name="face" minlength="2" type="text" value="{{$stat->face}}">
                                        </div>
                                    </div>
                                <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-3">Twitter</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="Text1" name="twit" minlength="2" type="text" value="{{$stat->twit}}">
                                        </div>
                                    </div>
                                <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-3">Instigram</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="Text2" name="inst" minlength="2" type="text" value="{{$stat->insta}}">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-3">SnapChat</label>
                                        <div class="col-lg-6">
                                            <input class=" form-control" id="Text2" name="snap" minlength="2" type="text" value="{{$stat->snap}}">
                                        </div>
                                    </div>
                                <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit">Save</button>
                                        </div>
                                    </div>
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