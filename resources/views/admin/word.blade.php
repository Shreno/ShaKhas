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
                                <form action='/admin/word' method='POST'>
                                	{{ csrf_field() }}
								<h4> Word: </h4>
								<input type="text" class="form-control" name="word" value="{{$panner->word1}}">
                                <h4> Link(Shop Now): </h4>
                                <input type="text" class="form-control" name="link" value="{{$panner->link}}">
                                <p>!hint : Default link to hot deals is : /hotdeals</p>
                                @if($panner->show==1)
                                <input type="checkbox" name="show" checked>Show This Tab
                                @else
                                <input type="checkbox" name="show" >Show This Tab
                                @endif
                                <br>
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