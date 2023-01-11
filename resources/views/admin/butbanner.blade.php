@extends('admin/master')
@section('content')
<section class="wrapper">
	<div class="form-Touch-corp">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Top Banner
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form action='/admin/butbanner' method='POST' enctype='multipart/form-data'>
                                	{{ csrf_field() }}
								<h4> Word 1: </h4>
								<input type="text" class="form-control" name="word1" value="{{$panner->word1}}">
								<h4> Word 2: </h4>
								<input type="text" class="form-control" name="word2" value="{{$panner->word2}}">
                                <h4> Link(Play Video): </h4>
                                <input type="text" class="form-control" name="link" value="{{$panner->link}}">
                                <h4> Image: </h4>
                                <input type="file" name="image">
                                <img src="/img/panners/{{$panner->image}}" width=200px>
                                <br><br>
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