@extends('admin/master')
@section('content')
<section class="wrapper">
	<div class="form-Touch-corp">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Tabs Name
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                            <form action="/admin/tabs" method="POST" enctype="multipart/form-data">
                            	{{ csrf_field() }}
                                <div class="form-group">
                                    <label>tab1:</label>
                                    <input type="text" class="form-control" name="tab1" value="{{$stat->tab1}}">
									<label>tab2:</label>
                                    <input type="text" class="form-control" name="tab2" value="{{$stat->tab2}}">
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