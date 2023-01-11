@extends('admin/master')
@section('content')
<form action="/admin/sendnews" method='POST'>
<section class="wrapper">
	<div class="form-Touch-corp">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Newsletter Registration list
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                
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
                                    <label for="exampleInputEmail1">Subject Name</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="sub" value="{{$olds}}">
                                    <label for="exampleInputEmail1">Massage</label>
									<textarea class="form-control " name="message" required>{{$oldm}}</textarea>
                                </div>
                                <button type="submit" class="btn btn-info">Send</button>

                            </div>
                        </div>
                    </section>

            </div>
            
        </div>
        <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      NewsLetter Members
    </div>
    <div class="row w3-res-tb">
      
      <div class="col-sm-4">
      </div>
      
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox" id='all' name='all'><i></i>
              </label>
            </th>
            <th>Email</th>
            <th>Registration Date</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        	@foreach($allnews as $v)
			<tr>
				<td><label class="i-checks m-b-none"><input type="checkbox" name="reciv[]" value="{{$v->email}}"><i></i></label>
				</td>
				<td>{{$v->email}}</td>
				<td>{{$v->reg_date}}</td>
			</tr>
			@endforeach
        </tbody>
      </table>
    </div>
    <br>
    <div style="text-align: right"> 
    	{!! $allnews->render() !!}
	</div>
  </div>
</div>
        <!-- page end-->
        </div>
</section>
</form>
@stop