<!--A Design by Touch-corp
Author: Touch-corp
Author URL: http://Touch-corp.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>Shaikha's an Admin Panel Category Bootstrap Responsive Website Template | Home :: Touch-corp</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('cssadmin/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('cssadmin/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('cssadmin/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{asset('cssadmin/morris.css')}}" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{asset('cssadmin/monthly.css')}}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset('jsadmin/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('jsadmin/raphael-min.js')}}"></script>
<script src="{{asset('jsadmin/morris.js')}}"></script>
<!-- Text Editor Library -->
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<!-- // Text editor -->
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="/admin" class="logo">
        Shaikha's LC
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu">
        <!-- settings start -->
        <li class="dropdown" id="header_inbox_bar">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="fa fa-tasks"></i>
                @if($norders>0)
                <span class="badge bg-success">{{$norders}}</span>
                @endif
            </a>
            <ul class="dropdown-menu extended tasks-bar">
                <li>
                    <p>You have {{$norders}} pending Orders</p>
                </li>
                <li class="external">
                    <a href="admin/orders">See All Orders</a>
                </li>
            </ul>
        </li>
        <!-- settings end -->
        <!-- inbox dropdown start-->
        <li id="header_inbox_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" id="messages">
                <i class="fa fa-envelope-o"></i>
				<?php
					if(count($getnewmes)>0){
					$newmescount=count($getnewmes);
				?>
                <span class="badge bg-important" id="notno"><?php echo $newmescount; ?></span>
				<?php }else{ $newmescount=0; } ?>
            </a>
            <ul class="dropdown-menu extended inbox">
                <li>
                    <p class="red">You have {{$newmescount}} Messages</p>
                </li>
					@foreach($getnewmes as $v){
                <li>
                    <a href="/admin/messages">
						<span class="subject">
						<span class="from">{{$v->user_name}}</span>
						<span class="time">{{$v->reg_date}}</span>
						</span>
						<span><b><?php echo $v->subject." : "; ?></b>
						<span class="message">
						<?php
							if(strlen($v->message)>20){
								echo substr($v->message,0,20)." ...";
							}else{
								echo $v->message;
							}
						?>
						</span>
						</span>
                    </a>
                </li>
					@endforeach
                <li>
                    <a href="/admin/messages">See all messages</a>
                </li>
            </ul>
        </li>
        <!-- inbox dropdown end -->
        <!-- notification dropdown start-->
        <li id="header_notification_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#" id="comments">

                <i class="fa fa-bell-o"></i>
                <?php
					if(count($getnewcom)>0){
					$newcomcount=count($getnewcom);
				?>
                <span class="badge bg-important" id="notn"><?php echo $newcomcount; ?></span>
				<?php }else{ $newcomcount=0; } ?>
            </a>
            <ul class="dropdown-menu extended notification">
                <li>
                    <p>Notifications</p>
                </li>
					@foreach($getnewcom as $v){
                <li>
                    <div class="alert alert-info clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#">New Comment on product : {{$v->product_name}} Wait your Approve</a>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </li>
        <!-- notification dropdown end -->
		<!-- notification Proposal start -->
         <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#" id="prop">
			 <i class="fa fa-gift"></i>
				<?php
					if(count($getnewprop)>0){
					$newpropcount=count($getnewprop);
				?>
                <span class="badge bg-success" id="notnp">{{$newpropcount}}</span>
				<?php }else{$newpropcount=0;} ?>
            </a>
            <ul class="dropdown-menu extended tasks-bar">
                <li>
                    <p class="">You received <?php echo $newpropcount; ?> new proposals</p>
                </li>
				@foreach($getnewprop as $v){
                <li>
                    <a href="/admin/prop/{{$v->id}}">
                        <div class="task-info clearfix">
                            <div class="desc pull-left">
                                <h5>{{$v->name}}</h5>
                                <p>{{$v->price}} $ , {{$v->user_name}} , {{$v->reg_date}}</p>
                            </div>
                                    <span class="notification-pie-chart pull-right" data-percent="45">
                            <span class="percent"></span>
                            </span>
                        </div>
                    </a>
                </li>
				@endforeach
                <li class="external">
                    <a href="/admin/prop">See All proposals</a>
                </li>
            </ul>
        </li>
        <!-- notification Proposal end -->
    </ul>
    <!--  notification end -->
</div>
<form action="/admin" method="POST" id='outform'>
	<div class="top-nav clearfix">
		<!--search & user info start-->
		<ul class="nav pull-right top-menu">
			<li>
				<input type="text" class="form-control search" placeholder=" Search">
			</li>
			<!-- user login dropdown start-->
			<li class="dropdown">
				<a data-toggle="dropdown" class="dropdown-toggle" href="#" style="padding:4px">
					<span class="username"><?php
						if(strlen(Auth::user()->user_name)>15){
							echo substr(Auth::user()->user_name,0,15)."...";
						}else{
							echo Auth::user()->user_name;
						}
					?></span>
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu extended logout">
					<li><a href="#"><i class=" fa fa-suitcase"></i> Profile</a></li>
					<li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
					<li><a href="/"><i class="fa fa-home"></i> Back to site</a></li>
					<li><a style="color:#333;cursor:pointer;" id='out' href="/out"><i class="fa fa-key"></i> Log Out</a></li>
					<input type='text' name='out' hidden>
				</ul>
			</li>
			<!-- user login dropdown end -->
		   
		</ul>
		<!--search & user info end-->
	</div>
</form>
<script>
	$("#out").click(function(){
		document.getElementById("outform").submit();
	});
</script>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="/admin">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                 <li>
                    <a class="active" href="/admin/menu">
                        <i class="fa fa-list"></i>
                        <span>Menu</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Brands</span>
                    </a>
                    <ul class="sub">
                        <li><a href="/admin/newbrand">New Brand</a></li>
                        <li><a href="/admin/editbrand">Edit Brand</a></li>
                        
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Banners</span>
                    </a>
                    <ul class="sub">
                        <li><a href="/admin/word">Main Top Banner</a></li>
                        <li><a href="/admin/banners">Banners</a></li>
                        <li><a href="/admin/butbanner">Buttom Banner</a></li>
                        <li><a href="/admin/bagesbanner">Pages Banner</a></li>
                    </ul>
                </li>
				<li>
                    <a href="/admin/orders">
                        <i class="fa fa-list"></i>
                        <span>Orders (<?php echo $norders; ?>)</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Brands</span>
                    </a>
                    <ul class="sub">
						<li><a href="/admin/newbrand">New Brand</a></li>
						<li><a href="/admin/editbrand">Edit Brand</a></li>
                        
                    </ul>
                </li>
            
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-list-alt"></i>
                        <span>Categories</span>
                    </a>
                    <ul class="sub">
                        <li><a href="/admin/newcat">New Categories</a></li>
                        <li><a href="/admin/editcat">Edit Categories</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-list-ol"></i>
                        <span>Sub Categories</span>
                    </a>
                    <ul class="sub">
                        <li><a href="/admin/newsubcat">New Sub Categories</a></li>
                        <li><a href="/admin/editsubcat">Edit Sub Categories</a></li>
						
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-product-hunt"></i>
                        <span>Products </span>
                    </a>
                    <ul class="sub">
                        <li><a href="/admin/newproduct">New Products</a></li>
                        <li><a href="/admin/editproduct">Edit Products</a></li>
                        <li><a href="/admin/historyproduct">Sold/ History Products</a></li>
                    </ul>
                </li>
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-newspaper-o"></i>
                        <span>Footer </span>
                    </a>
                    <ul class="sub">
                        <li><a href="/admin/about">About Us</a></li>
                        <li><a href="/admin/social">Social Media</a></li>
						<li><a href="/admin/tabs">Product Tabs</a></li>
						<li><a href="/admin/contact">Contact US</a></li>
                    </ul>
                </li>
				<li class="sub-menu">
					<a href="javascript:;">
						<i class="fa fa-truck"></i>
						<span>Shipping</span>
					</a>
					<ul class="sub">
						<li><a href="/admin/zones">Zones</a></li>
						<li><a href="/admin/comp">Company</a></li>
					</ul>
				</li>
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-envelope-o"></i>
                        <span>News Letter </span>
                    </a>
                    <ul class="sub">
                        <li><a href="/admin/newsletter">Send new Message</a></li>
                        <li><a href="/admin/oldnews">Pick a message to resend</a></li>
                    </ul>
                </li>
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-user"></i>
                        <span>Users</span>
                    </a>
                    <ul class="sub">
                        <li><a href="/admin/users">User Edit</a></li>
                        <li><a href="/admin/messages">Messages (<?php echo $newmescount; ?>)</a></li>
						<li id="comment"><a href="#">Comments (<?php echo $newcomcount; ?>)</a></li>
						<li id="prop"><a href="/admin/prop">Proposals (<?php echo $newpropcount; ?>)</a></li>
                    </ul>
					<li>
						<a href="/admin/privacy">
							<i class="fa fa-legal"></i>
							<span>Privacy | Terms</span>
						</a>
					</li>
                </li>
				<li>
                    <a href="/admin/billstatus">
                        <i class="fa fa-clone"></i>
                        <span>Bills Status</span>
                    </a>
                </li>
            </ul>           
			   </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">

@yield('content')

<!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>© 2017 Shaikha's LC. All rights reserved | Developed by <a href="http://touch-corp.com">Touch</a></p>
			</div>
		  </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{asset('jsadmin/bootstrap.js')}}"></script>
<script src="{{asset('jsadmin/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('jsadmin/scripts.js')}}"></script>
<script src="{{asset('jsadmin/jquery.slimscroll.js')}}"></script>
<script src="{{asset('jsadmin/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('jsadmin/jquery.scrollTo.js')}}"></script>
<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="js/monthly.js"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}
		});
	</script>
	<!-- //calendar -->
</body>
</html>