@extends('admin/master')
@section('content')
<section class="wrapper">
	<div class="form-Touch-corp">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Contact Us Control
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                            <form action="/admin/contact" method="POST">
                            	{{ csrf_field() }}
                                <div class="form-group">
                                    <label>Contact Head :-</label>
                                    <input type="text" class="form-control" name="conhead" value="{{$con[0]->data_body}}">
									<div class="checkbox">
										<label><input type="checkbox" name="conheadshow" {{($con[0]->state==1)?'checked':''}}>Show</label>
									</div>
									<label>contact Body :-</label>
                                    <textarea type="text" class="form-control" name="conbody">{{$con[1]->data_body}}</textarea>
									<div class="checkbox">
										<label><input type="checkbox" name="conbodyshow" {{($con[1]->state==1)?'checked':''}}>Show</label>
									</div>
									<label>Address :-</label>
                                    <input type="text" class="form-control" name="addr" value="{{$con[2]->data_body}}">
									<div class="checkbox">
										<label><input type="checkbox" name="addrshow" {{($con[2]->state==1)?'checked':''}}>Show</label>
									</div>
									<label>Phone :-</label>
                                    <input type="text" class="form-control" name="phn" value="{{$con[3]->data_body}}">
									<div class="checkbox">
										<label><input type="checkbox" name="phnshow" {{($con[3]->state==1)?'checked':''}}>Show</label>
									</div>
									<label>E-Mail :-</label>
                                    <input type="text" class="form-control" name="mal" value="{{$con[4]->data_body}}">
									<div class="checkbox">
										<label><input type="checkbox" name="malshow" {{($con[4]->state==1)?'checked':''}}>Show</label>
									</div>
									<label>Open Hours :-</label>
                                    <input type="text" class="form-control" name="hrs" value="{{$con[5]->data_body}}">
									<div class="checkbox">
										<label><input type="checkbox" name="hrsshow" {{($con[5]->state==1)?'checked':''}}>Show</label>
									</div>
                                    <label>Map :-</label>
                                    <input type="text" class="form-control" name="map" value="{{$stat->map}}">
                                </div>
                                <button type="submit" class="btn btn-info">Save</button>
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