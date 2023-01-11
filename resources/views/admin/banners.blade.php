@extends('admin/master')
@section('content')
<section class="wrapper">
	<div class="form-Touch-corp">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            New Banner
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form action='/admin/newbanner' method='POST' enctype='multipart/form-data'>
                                	{{ csrf_field() }}
								<h4> Word 1: </h4>
								<input type="text" class="form-control" name="word1">
								<h4> Word 2: </h4>
								<input type="text" class="form-control" name="word2">
                                <h4> Link(Shop Now): </h4>
                                <input type="text" class="form-control" name="link">
                                <h4> Image: </h4>
                                <input type="file" name="image">
                                <br><br>
                                <button type="submit" class="btn btn-info">Save</button>
                            </form>
                            </div>
                        </div>
                    </section>
                    <section class="panel">
                        <header class="panel-heading">
                            Edit Banners
                        </header>
                        <br>
                        <select id="sel" class="form-control">
                            <option value="">Select Banner</option>
                            <?php $i=1; ?>
                            @foreach($panner as $pan)
                            <option value="{{$pan->id}}">Banner : {{$i}}</option>
                            <?php $i++; ?>
                            @endforeach
                        </select>
                        @foreach($panner as $pan)
                        <div class="panel-body" style="display: none;" id={{$pan->id}}>
                            <div class="position-center">
                                <form action='/admin/editban/{{$pan->id}}' method='POST' enctype='multipart/form-data'>
                                    {{ csrf_field() }}
                                <h4> Word 1: </h4>
                                <input type="text" class="form-control" name="word1" value="{{$pan->word1}}">
                                <h4> Word 2: </h4>
                                <input type="text" class="form-control" name="word2" value="{{$pan->word2}}">
                                <h4> Link(Shop Now): </h4>
                                <input type="text" class="form-control" name="link" value="{{$pan->link}}">
                                <h4> Image: </h4>
                                <input type="file" name="image">
                                <img src="/img/panners/{{$pan->image}}" width=200px>
                                <br><br>
                                <button type="submit" class="btn btn-info">edit</button>
                                <a href="/admin/banrem/{{$pan->id}}" class="btn btn-danger">Remove</a>
                            </form>
                            </div>
                        </div>
                        @endforeach
                    </section>
                    <script type="text/javascript">
                        $('#sel').change(function(){
                            @foreach($panner as $pan)
                            if($('#sel').val()=={{$pan->id}}){
                                $('#{{$pan->id}}').show();
                            }else{
                                $('#{{$pan->id}}').hide();
                            }
                            @endforeach
                        });
                    </script>
            </div>
        </div>
        <!-- page end-->
        </div>
</section>
@stop