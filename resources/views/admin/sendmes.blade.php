@extends('admin/master')
@section('content')
<section class="wrapper">
		<!-- page start-->
		<div class="mail-w3agile">
        <div class="row">
            <div class="col-sm-3 com-w3ls">
                <section class="panel">
                    <div class="panel-body">
                        <ul class="nav nav-pills nav-stacked mail-nav">
                            <li><a href="/admin/messages"> <i class="fa fa-inbox"></i> Inbox  <span class="label label-danger pull-right inbox-notification">{{count($getnewmes)}}</span></a></li>
                            <li class="active"><a href="#"> <i class="fa fa-envelope-o"></i> Sent Mail</a></li>
                        </ul>
                    </div>
                </section>
            </div>
            <div class="col-sm-9 mail-w3agile">
                <section class="panel">
                    <header class="panel-heading wht-bg">
                       <h4 class="gen-case">
							Compose Message
                       </h4>
                    </header>
                    <div class="panel-body">
                        <div class="compose-btn pull-right">
                            <a href="/admin/users"><button class="btn btn-primary btn-sm">Select members</button></a>
                        </div>
						<p>
							Message Can Be Send to active members only .. if there are E-Mail out of members the system auto neglegt it.
							<br>
							If you want to send to more than one use (,) between E-Mails
						</p>
                        <div class="compose-mail">
                            <form role="form-horizontal" method="POST" action="/admin/sendmes">
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
                                    <label for="to" class="">To:</label>
                                    <input type="text" tabindex="1" id="to" class="form-control" name="email" value="{{$to}}">
                                </div>
                                <div class="form-group">
                                    <label for="subject" class="">Subject:</label>
                                    <input type="text" tabindex="1" id="subject" name="sub" class="form-control" value="">
                                </div>
                                <div class="compose-editor">
                                    <textarea class="wysihtml5 form-control" rows="9" name="message"></textarea>
                                </div>
                                <div class="compose-btn">
                                    <button class="btn btn-primary btn-sm" type="submit" name="adminsendmes"><i class="fa fa-check"></i> Send</button>
                                    <a href="/admin/sendmes" class="btn btn-sm"><i class="fa fa-times"></i> Discard</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
		</div>
</section>


<div class="mail-w3agile">
        <!-- page start-->
        <div class="row">
            <div class="col-sm-3 com-w3ls">
            </div>
            <div class="col-sm-9 mail-w3agile">
                <section class="panel">
                    <header class="panel-heading wht-bg">
					<?php
						$countall=count($allmes);
					?>
                       <h4 class="gen-case">Sent Messages (<?php echo $countall; ?>)
                       </h4>
                    </header>
                    <form action="/admin/selformes" method="post" id="selm">
                    	<input type="text" name="source" value="sen" hidden>
                    	{{ csrf_field() }}
                    <div class="panel-body minimal">
                        <div class="mail-option">
                            <div class="chk-all">
                                <div class="pull-left mail-checkbox ">
                                    <input type="checkbox" name="sendall">
									Send to All menu
                                </div>
                            </div>
							<button class="btn btn-default" id="sendsel">Send to Selected</button>
                        </div>
                        <div class="table-inbox-wrap ">
                            <table class="table table-inbox table-hover">
                        <tbody>
						<?php
							foreach($allmes as $v){
						?>
                        <tr class="">
                            <td class="inbox-small-cells">
                                <input type="checkbox" class="mail-checkbox" name="s[]" value="{{$v->email}}">
                            </td>
                            <td class="view-message  dont-show"><a><?php echo $v->email; ?></a></td>
							<td class="view-message "><a><?php echo $v->subject; ?></a></td>
                            <td class="view-message "><a><?php echo $v->message; ?></a></td>
                            <td class="view-message  text-right"><?php echo $v->reg_date; ?></td>
                        </tr>
						<?php } ?>
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
@stop