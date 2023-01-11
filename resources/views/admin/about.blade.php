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
                            About us
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form action='/admin/about' method='POST'>
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
									<div class="col-lg-9">
										<textarea class="form-control " name='about'>{{$stat->about}}</textarea>
									</div>
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