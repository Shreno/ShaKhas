@extends('admin/master')
@section('content')
   	<section class="wrapper">
	<div class="form-Touch-corp">
        <!-- page start-->
	@if($sel)
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Member View/Editing
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
								<form action="/admin/user" method="POST">
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
										<label for="exampleInputEmail1">Member Name</label>
										<input type="text" class="form-control" name="name" value="{{$user->user_name}}">
										<label for="exampleInputEmail1">Member Second Name</label>
										<input type="text" class="form-control" name="name2" value="{{$user->user_name2}}">
										<label for="exampleInputEmail1">Phone Number</label>
										<input type="tel" class="form-control" name="phone" value="{{$user->phone}}">
										<label for="exampleInputEmail1">Address</label>
										<input type="text" class="form-control" name="address" value="{{$user->address}}">
										<label for="exampleInputEmail1">Country</label>
										<select class="form-control" name="country" style="height:35px;">
											@foreach($cont as $con)
											@if($con->id==$user->country)
											<option value="{{$con->id}}" selected>{{$con->country}}</option>
											@else
											<option value="{{$con->id}}">{{$con->country}}</option>
											@endif
											@endforeach
										</select>
										<label for="exampleInputEmail1">NEW Password</label>
										<input type="password" class="form-control" name="newpass">
										<input type="text" value="{{$user->id}}" name='id' hidden>
										<br>
									<button type="submit" class="btn btn-info">Edit</button>
									@if($user->role!='admin')
									<a href="/admin/removeuser/{{$user->id}}" class="btn btn-danger">Remove User</a>
									@if($user->role=='sadmin')
									<a href="/admin/useradmin/{{$user->id}}" class="btn btn-success">Remove from Administration</a>
									@elseif($user->role=='user')
									<a href="/admin/useradmin/{{$user->id}}" class="btn btn-success">Add to Administration</a>
									<a href="/admin/userblock/{{$user->id}}" class="btn btn-primary">Block user</a>
									@elseif($user->role=='blocked')
									<a href="/admin/userblock/{{$user->id}}" class="btn btn-primary">Unblock user</a>
									@endif
									@endif
								</form>
                            </div>

                        </div>
                    </section>

            </div>
            
        </div>
        @endif
   <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Member List
    </div>
    <div class="row w3-res-tb">
    	<div class="col-sm-3">
	  <span> Search : </span>
        <div class="input-group">
          <input type="text" class="input-sm form-control" id="sdata">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button" id="search">Go!</button>
          </span>
        </div>
      </div>
	  <script>
			$('#search').click(function(){
				if($('#sdata').val()!="")
					location.href='/admin/users/search/'+$('#sdata').val();
				else
					location.href='/admin/users';
			});
		</script>
		<div class="col-sm-3">
			<span> Send Message :
			<button class="btn btn-default" id="sendsel">Selected Users</button>
		</div>
    </div>
    <div class="alert alert-success">
    	<strong>Hints to Search :</strong>
    	if you want all active users type "user" - "blocked" - "pending" - "admin"
    	<br>
    	search can be by email or name or phone.
    </div>
    <div class="table-responsive">
    	<form action="/admin/selformes" method="post" id="selm">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
			#
            </th>
            <th>Send Message </th>
            <th>Member Name</th>
            <th>Member E-Mail</th>
            <th>Register Date</th>
            <th style="width:30px;">Status</th>
          </tr>
        </thead>
    	<tbody>
    		
            	<input type="text" name="source" value="sen" hidden>
            	{{ csrf_field() }}
			<tr>
				@foreach($users as $v)
				<td><label class="i-checks m-b-none"><input type="checkbox" id="{{$v->id}}"><i></i></label></td>
				<td><label class="i-checks m-b-none"><input type="checkbox" name="s[]" value="{{$v->email}}"><i></i></label></td>
				<td>{{$v->user_name}} {{$v->user_name2}}</td>
				<td>{{$v->email}}</td>
				<td>{{$v->reg_date}}</td>
				<td>{{$v->role}}</td>
			</tr>
		<script type="text/javascript">
			$("#{{$v->id}}").change(function(){
				location.href="/admin/users/{{$v->id}}";
			});
			$('#sendsel').click(function(){
        		$('#selm').submit();
			});
		</script>
		@endforeach
        </tbody>
      </table>
      </form>
    </div>
    <br>
    <div style="text-align: right">
    	{!! $users->render() !!}
	</div>
  </div>
</div>
<!-- page end-->
        </div>
</section>
@stop