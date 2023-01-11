@extends('admin/master')
@section('content')
<section class="wrapper">
		<div class="mail-w3agile">
        <!-- page start-->
        <div class="row">
            <div class="col-sm-3 com-w3ls">
                <section class="panel">
                    <div class="panel-body">
                        <a href="/admin/sendmes"  class="btn btn-compose">
                            Compose Message
                        </a>
                        <ul class="nav nav-pills nav-stacked mail-nav">
                            <li class="active"><a href=""> <i class="fa fa-inbox"></i> Inbox  <span class="label label-danger pull-right inbox-notification">{{count($getnewmes)}}</span></a></li>
                            <li><a href="/admin/sendmes"> <i class="fa fa-envelope-o"></i> Sent Mail</a></li>
                        </ul>
                    </div>
                </section>

            </div>
            <div class="col-sm-9 mail-w3agile">
                <section class="panel">
                    <header class="panel-heading wht-bg">
					<?php
						$countall=count($allmes);
					?>
                       <h4 class="gen-case">Inbox (<?php echo $countall; ?>)
                       </h4>
                    </header>
                    <form action="/admin/selformes" method="post" id="selm">
                    	<input type="text" name="source" value="inb" hidden>
                    	{{ csrf_field() }}
                    <div class="panel-body minimal">
                    	<div class="mail-option">
                            <div class="chk-all">
                                <div class="pull-left mail-checkbox ">
                                    <input type="checkbox" name="sendall">
									Send to All in menu
                                </div>
                            </div>
							<button class="btn btn-default" id="sendsel">Send to Selected</button>
                        </div>
                        <div class="table-inbox-wrap ">
                            <table class="table table-inbox table-hover">
                        <tbody>
						<?php
							foreach($allmes as $v){
								if($v->seen=="no"){
						?>
                        <tr class="unread" id="message{{$v->id}}">
                            <td class="inbox-small-cells">
                                <input type="checkbox" class="mail-checkbox" name="s[]" value="{{$v->email}}">
                            </td>
                            <td class="view-message  dont-show"><a>{{$v->user_name}}</a></td>
							<td class="view-message "><a>{{$v->subject}}</a></td>
                            <td class="view-message "><a>{{$v->message}}</a></td>
                            <td class="view-message  text-right">{{$v->reg_date}}</td>
                        </tr>
						<?php
							}else{
						?>
                        <tr>
                            <td class="inbox-small-cells">
                                <input type="checkbox" class="mail-checkbox" name="s[]" value="{{$v->email}}">
                            </td>
                            <td class="view-message  dont-show"><a>{{$v->user_name}}</a></td>
							<td class="view-message "><a>{{$v->subject}}</a></td>
                            <td class="view-message "><a>{{$v->message}}</a></td>
                            <td class="view-message  text-right">{{$v->reg_date}}</td>
                        </tr>
						<?php }} ?>
                        </tbody>
                        </table>

                        </div>
                    </div>
                	</form>
                </section>
            </div>
        </div>
        <script type="text/javascript">
        	$('#sendsel').click(){
        		$('#selm').submit();
        	}
        </script>
        <!-- page end-->
        </div>
</section>
@stop