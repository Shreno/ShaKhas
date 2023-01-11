@extends('admin/master')
@section('content')
<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Proposals List
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle" id="gub">
		  <option value="all">all</option>
		  <option value="0">Pending</option>
          <option value="1">Approve</option>
        </select>		
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Item Name</th>
            <th>phone</th>
            <th>Date</th>
            <th>status</th>
          </tr>
        </thead>
        <tbody>
        	@foreach($props as $v)
			<tr>
				<td> <a href="/admin/prop/{{$v->id}}">{{$v->name}}</a></td>
				<td>{{$v->phone}}</td>
				<td>{{$v->reg_date}}</td>
				<td>{{($v->approve==0)?'Not Approved':'Approved'}}</td>
			</tr>
			@endforeach
        </tbody>
      </table>
    </div>
    <br>
    <div style="text-align: right"> 
    	{!! $props->render() !!}
	</div>
  </div>
</div>
</section>
@stop