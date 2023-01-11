@extends('admin/master')
@section('content')
<section class="wrapper">
	<div class="form-Touch-corp">
    <!-- page start-->
    <div class="row">
        <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Pages Banners
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form action='/admin/pagesbanner' method='POST' enctype="multipart/form-data">
                            	{{ csrf_field() }}
                                <div class="form-groub">
                                    <label>Shipping Page Banner</label>
                                    <input type="file" name="shipban">
                                    <img src="{{asset('/img/pagesbanner')}}/{{$banimg[0]->image}}" width="150px">
                                    <br>
                                    <label>Returns Page Banner</label>
                                    <input type="file" name="retban">
                                    <img src="{{asset('/img/pagesbanner')}}/{{$banimg[1]->image}}" width="150px">
                                    <br>
                                    <label>Contact-US Page Banner</label>
                                    <input type="file" name="conban">
                                    <img src="{{asset('/img/pagesbanner')}}/{{$banimg[2]->image}}" width="150px">
                                    <br>
                                    <label>FAQs Page Banner</label>
                                    <input type="file" name="faqban">
                                    <img src="{{asset('/img/pagesbanner')}}/{{$banimg[3]->image}}" width="150px">
                                    <br>
                                    <label>About-US Page Banner</label>
                                    <input type="file" name="aboban">
                                    <img src="{{asset('/img/pagesbanner')}}/{{$banimg[4]->image}}" width="150px">
                                    <br>
                                    <label>About-US Image Page</label>
                                    <input type="file" name="abiban">
                                    <img src="{{asset('/img/pagesbanner')}}/{{$banimg[5]->image}}" width="150px">
                                    <br>
                                    <label>Sell With Us Image Page</label>
                                    <input type="file" name="sellban">
                                    <img src="{{asset('/img/pagesbanner')}}/{{$banimg[6]->image}}" width="150px">
                                    <br>
                                    <label>Cart Page Banner</label>
                                    <input type="file" name="carban">
                                    <img src="{{asset('/img/pagesbanner')}}/{{$banimg[7]->image}}" width="150px">
                                    <br>
                                    <label>Brands Page Banner</label>
                                    <input type="file" name="braban">
                                    <img src="{{asset('/img/pagesbanner')}}/{{$banimg[8]->image}}" width="150px">
                                    <br>
                                    <label>Hot Deals Page Banner</label>
                                    <input type="file" name="HDaban">
                                    <img src="{{asset('/img/pagesbanner')}}/{{$banimg[9]->image}}" width="150px">
                                    <br>
                                    <label>New Arrival Page Banner</label>
                                    <input type="file" name="Nraban">
                                    <img src="{{asset('/img/pagesbanner')}}/{{$banimg[10]->image}}" width="150px">
                                    <br>
                                    <label>Sell with us Page Banner</label>
                                    <input type="file" name="Sellaban">
                                    <img src="{{asset('/img/pagesbanner')}}/{{$banimg[11]->image}}" width="150px">
                                    <br>
                                    <label>Payment Method Page Banner</label>
                                    <input type="file" name="Paymentaban">
                                    <img src="{{asset('/img/pagesbanner')}}/{{$banimg[12]->image}}" width="150px">
                                    <br>
                                    <button type="submit" class="btn btn-info">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
@stop