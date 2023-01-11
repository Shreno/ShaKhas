@extends('admin/master')
@section('content')
<section class="wrapper">
	<div class="form-Touch-corp">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
        </div>
        <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Old News Letter
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
              </label>
            </th>
            <th>Sent To</th>
            <th>Subject</th>
            <th>message</th>
            <th>sent Date</th>
          </tr>
        </thead>
        <tbody>
        	@foreach($oldnews as $v)
        	<tr>
				<td><label class="i-checks m-b-none"><input type="checkbox" id="{{$v->id}}"><i></i></label></td>
				<td>{{$v->send_to}}</td>
				<td>{{$v->subject}}</td>
				<td>{{$v->text}}</td>
				<td>{{$v->reg_date}}</td>
			</tr>
			<script>
				$("#{{$v->id}}").change(function(){
					location.href="/admin/newsletter/{{$v->id}}";
				});
			</script>
         @endforeach
        </tbody>
      </table>
    </div>
    <br>
    <div style="text-align: right"> 
    	{!! $oldnews->render() !!}
	</div>
  </div>
</div>


        <!-- page end-->
        </div>
</section>
@stop