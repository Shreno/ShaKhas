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
                            Pages Control
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form action='/admin/privacy' method='POST'>
                                	{{ csrf_field() }}
								<h4> About Us Head: </h4>
								<input type="text" class="form-control" name="abh" value="{{$endb->about_head}}">
								<h4> About Us Body: </h4>
								<textarea class="form-control " name='abb'>{{$endb->about}}</textarea>
								<h4> Privacy Head: </h4>
								<input type="text" class="form-control" name="prh" value="{{$endb->privacy_head}}">
								<h4> Privacy Body: </h4>
								<textarea class="form-control " name='prb'>{{$endb->privacy}}</textarea>
								<h4> Terms Head: </h4>
								<input type="text" class="form-control" name="th" value="{{$endb->terms_head}}">
								<h4> Terms Body: </h4>
								<textarea name="tb">{{$endb->terms}}</textarea>

                                <hr>

                                <h4> Returns Head: </h4>
                                <input type="text" class="form-control" name="reth" value="{{$endb->returns_head}}">
                                <h4> Returns Body: </h4>
                                <textarea name="retb">{{$endb->returns_body}}</textarea>
                                <hr>
                                <h4> Shipping Head: </h4>
                                <input type="text" class="form-control" name="shh" value="{{$endb->shipping_head}}">
                                <h4> Shipping Body: </h4>
                                <textarea name="shb">{{$endb->shipping}}</textarea>
                                <hr>
                                <h4> Faq Head: </h4>
                                <input type="text" class="form-control" name="fah" value="{{$endb->faq_head}}">
                                <h4> Faq Body: </h4>
                                <textarea name="fab">{{$endb->faq}}</textarea>
								<br>
                                <button type="submit" class="btn btn-info">Save</button>
                            </form>
                            <script>
                                CKEDITOR.replace( 'tb' );
                                CKEDITOR.replace( 'retb' );
                                CKEDITOR.replace( 'shb' );
                                CKEDITOR.replace( 'fab' );
                            </script>
                            </div>
                        </div>
                    </section>

            </div>
        </div>
        <!-- page end-->
        </div>
</section>
@stop