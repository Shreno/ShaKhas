<!------------------------------------------------------------------
Project:  120
Version:  x1
Last change:  3/10/2018
Assigned to:  SHIKHAS Corp!
Primary use:  Company
Designed by: Www.123solution.net
Developed By : http://www.touch-corp.com/
-------------------------------------------------------------------*/
/*------------------------------------------------------------------>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$title}}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('images/icons/favicon.png')}}"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/themify/themify-icons.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/elegant-font/html-css/style.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/animate/animate.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/slick/slick.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/lightbox2/css/lightbox.min.css')}}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    <!--  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
<!--===============================================================================================-->
</head>
<body class="animsition">

    <!-- header fixed -->
    <div class="wrap_header fixed-header2 trans-0-4">
        <!-- Logo -->
        <a href="/" class="logo">
            <img src="{{asset('images/icons/logo.png')}}" alt="IMG-LOGO">
        </a>

        <!-- Menu -->
        <div class="wrap_menu">
            <nav class="menu">
                <ul class="main_menu">
                            @foreach($menu as $men)
                            <li>
                                <a href="/typepro/{{$men->id}}">{{$men->type_name}}</a>
                                <ul class="sub_menu">
                                @foreach($cats as $cat)
                                @if($cat->type_id==$men->id)
                                <li>
                                    <a href="#">{{$cat->category_name}}</a>
                                    <ul class="sub-menu">
                                        @foreach($subs as $sub)
                                        @if($sub->cat_id==$cat->id)
                                        <li><a href="/products/{{$sub->id}}">{{$sub->sub_name}}</a></li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </li>
                                @endif
                                @endforeach
                                </ul>
                            </li>
                            @endforeach
                            <li>
                                <a href="/sell">SELL WITH US</a>
                            </li>
                            <li>
                                <a href="/brands">BRANDS</a>
                            </li>
                </ul>
            </nav>
        </div>

        <!-- Header Icon -->
        <div class="header-icons">
            <a href="#" class="header-wrapicon1 dis-block">
                <img src="{{asset('images/icons/icon-header-01.png')}}" class="header-icon1" alt="ICON">
            </a>

            <span class="linedivide1"></span>

            <div class="header-wrapicon2">
                <img src="{{asset('images/icons/icon-header-02.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON">
                <span class="header-icons-noti">{{count($cart)}}</span>

                <!-- Header cart noti -->
                <div class="header-cart header-dropdown">
                    <ul class="header-cart-wrapitem">
                        <?php $totp=0; ?>
                        @foreach($cart as $carta)
                        <li class="header-cart-item">
                            <a href="/removecart/{{$carta->product_id}}">
                            <div class="header-cart-item-img">
                                <img src="{{asset('img/products')}}/{{$carta->img}}" alt="IMG">
                            </div>
                            </a>

                            <div class="header-cart-item-txt">
                                <a href="/product/{{$carta->product_id}}" class="header-cart-item-name">
                                    {{$carta->product_name}}
                                </a>

                                <span class="header-cart-item-info">
                                    {{$carta->price}} AED
                                </span>
                            </div>
                        </li>
                        <?php $totp+=$carta->price; ?>
                        @endforeach
                    </ul>

                    <div class="header-cart-total">
                        Total: {{$totp}} AED
                    </div>

                    <div class="header-cart-buttons">
                        <div class="header-cart-wrapbtn">
                            <!-- Button -->
                            <a href="/cart" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                View Cart
                            </a>
                        </div>

                        <div class="header-cart-wrapbtn">
                            <!-- Button -->
                            <a href="/check" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                Check Out
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($panner[0]->show==1)
    <!-- top noti -->
    <div class="flex-c-m size22 bg0 s-text21 pos-relative">
        {{$panner[0]->word1}}
        <a href="{{$panner[0]->link}}" class="s-text22 hov6 p-l-5">
            Shop Now
        </a>

        <button class="flex-c-m pos2 size23 colorwhite eff3 trans-0-4 btn-romove-top-noti">
            <i class="fa fa-remove fs-13" aria-hidden="true"></i>
        </button>
    </div>
    @endif
    <!-- Header -->
    <header class="header2">
        <!-- Header desktop -->
        <div class="container-menu-header-v2 p-t-26">
            <div class="topbar2">
                <div class="topbar-social">
                    <a href="{{$stat->face}}" class="topbar-social-item fa fa-facebook"></a>
                    <a href="{{$stat->insta}}" class="topbar-social-item fa fa-instagram"></a>
					<a href="{{$stat->twit}}"><i class="fa fa-twitter"></i></a>
                    <a href="{{$stat->snap}}" class="topbar-social-item fa fa-snapchat-ghost"></a>
                   
                </div>

                <!-- Logo2 -->
                <a href="/" class="logo2">
                    <img src="{{asset('images/icons/logo.png')}}" alt="IMG-LOGO">
                </a>

                <div class="topbar-child2">
                    <!--<span class="topbar-email">
                        info@123solution.net
                    </span>

                    <div class="topbar-language rs1-select2">
                        <select class="selection-1" name="time">
                            <option>USD</option>
                            <option>EUR</option>
                        </select>
                    </div>-->
                    <!--  -->
                    <a href="/log"><img src="{{asset('images/icons/icon-header-01.png')}}" class="header-icon1" alt="ICON">
                    </a>
                    @if(isset(Auth::user()->user_name))
                    <div class="topbar-language rs1-select2">
                        <a href="/">Welcome {{Auth::user()->user_name}}</a>
                        <a href="/out">| Logout</a>
                        @if(Auth::user()->role=='admin'||Auth::user()->role=='sadmin')
                        <a href="/admin">| Admin DB</a>
                        @else
                        <a href="/user">| My Account {{($newmes!=0)?'('.$newmes.')':''}}</a>
                        @endif
                    </div>
                    @endif
                    <span class="linedivide1"></span>

                    <div class="header-wrapicon2 m-r-13">
                        <img src="{{asset('images/icons/icon-header-02.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON">
                        <span class="header-icons-noti">{{count($cart)}}</span>

                        <!-- Header cart noti -->
                        <div class="header-cart header-dropdown">
                            <ul class="header-cart-wrapitem">
                            <?php $totp=0; ?>
                        @foreach($cart as $carta)
                        <li class="header-cart-item">
                            <a href="/removecart/{{$carta->product_id}}">
                            <div class="header-cart-item-img">
                                <img src="{{asset('img/products')}}/{{$carta->img}}" alt="IMG">
                            </div>
                            </a>

                            <div class="header-cart-item-txt">
                                <a href="/product/{{$carta->product_id}}" class="header-cart-item-name">
                                    {{$carta->product_name}}
                                </a>

                                <span class="header-cart-item-info">
                                    {{$carta->price}} AED
                                </span>
                            </div>
                        </li>
                        <?php $totp+=$carta->price; ?>
                        @endforeach
                    </ul>

                    <div class="header-cart-total">
                        Total: {{$totp}} AED
                    </div>

                            <div class="header-cart-buttons">
                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="/cart" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        View Cart
                                    </a>
                                </div>

                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="/check" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        Check Out
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="wrap_header">

                <!-- Menu -->
                <div class="wrap_menu">
                    <nav class="menu">
                        <ul class="main_menu">
                            @if($title=='SHAIKHAS Luxury Closet-HOME')
                            <li class="sale-noti">
                            @else
                            
                            @endif
                                
                            
                            @foreach($menu as $men)
                            <li>
                                <a href="/typepro/{{$men->id}}">{{$men->type_name}}</a>
                                <ul class="sub_menu">
                                @foreach($cats as $cat)
                                @if($cat->type_id==$men->id)
                                <li>
                                    <a href="#">{{$cat->category_name}}</a>
                                    <div class="col-md-6">
                                    <ul class="sub-menu">
                                        @foreach($subs as $sub)
                                        @if($sub->cat_id==$cat->id)
                                        
                                        <li><a href="/products/{{$sub->id}}">{{$sub->sub_name}}</a></li>
                                        
                                        @endif
                                        @endforeach
                                    </ul>
                                    </div>
                                </li>
                                @endif
                                @endforeach
                                </ul>
                            </li>
                            @endforeach
                            <li>
                                <a href="/sell">SELL WITH US</a>
                            </li>
                            <li>
                                <a href="/brands">BRANDS</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Header Icon -->
                <div class="header-icons">

                </div>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap_header_mobile">
            <!-- Logo moblie -->
            <a href="/log" class="logo-mobile">
                <img src="{{asset('images/icons/logo.png')}}" alt="IMG-LOGO">
            </a>

            <!-- Button show menu -->
            <div class="btn-show-menu">
                <!-- Header Icon mobile -->
                <div class="header-icons-mobile">
                    <a href="/log" class="header-wrapicon1 dis-block">
                        <img src="{{asset('images/icons/icon-header-01.png')}}" class="header-icon1" alt="ICON">
                    </a>
                    <span class="linedivide2"></span>

                    <div class="header-wrapicon2">
                        <img src="{{asset('images/icons/icon-header-02.png')}}" class="header-icon1 js-show-header-dropdown" alt="ICON">
                        <span class="header-icons-noti">{{count($cart)}}</span>

                        <!-- Header cart noti -->
                        <div class="header-cart header-dropdown">
                            <ul class="header-cart-wrapitem">
                                <?php $totp=0; ?>
                        @foreach($cart as $carta)
                        <li class="header-cart-item">
                            <a href="/removecart/{{$carta->product_id}}">
                            <div class="header-cart-item-img">
                                <img src="{{asset('img/products')}}/{{$carta->img}}" alt="IMG">
                            </div>
                            </a>

                            <div class="header-cart-item-txt">
                                <a href="/product/{{$carta->product_id}}" class="header-cart-item-name">
                                    {{$carta->product_name}}
                                </a>

                                <span class="header-cart-item-info">
                                    {{$carta->price}} AED
                                </span>
                            </div>
                        </li>
                        <?php $totp+=$carta->price; ?>
                        @endforeach
                    </ul>

                    <div class="header-cart-total">
                        Total: {{$totp}} AED
                    </div>

                            <div class="header-cart-buttons">
                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="/cart" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        View Cart
                                    </a>
                                </div>

                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="/check" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        Check Out
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </div>
            </div>
        </div>

        <!-- Menu Mobile -->
        <div class="wrap-side-menu" >
            <nav class="side-menu">
                <ul class="main-menu">
                    <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                        <span class="topbar-child1">
                            Free shipping for standard order over $100
                        </span>
                    </li>

                    <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                        <div class="topbar-child2-mobile">
                            <span class="topbar-email">
                                
                            </span>

                            @if(isset(Auth::user()->user_name))
                            <div class="topbar-language rs1-select2">
                                <a href="/">Welcome {{Auth::user()->user_name}}</a>
                                <a href="/out">| Logout</a>
                                @if(Auth::user()->role=='admin'||Auth::user()->role=='sadmin')
                                <a href="/admin">| Admin DB</a>
                                @else
                                <a href="/user">| My Account</a>
                                @endif
                            </div>
                            @endif
                        </div>
                    </li>

                    <li class="item-topbar-mobile p-l-10">
                        <div class="topbar-social-mobile">
                            <a href="{{$stat->face}}" class="topbar-social-item fa fa-facebook"></a>
							<a href="{{$stat->insta}}" class="topbar-social-item fa fa-instagram"></a>
							<a href="{{$stat->twit}}"><i class="fa fa-twitter"></i></a>
                            
                            <a href="{{$stat->snap}}" class="topbar-social-item fa fa-snapchat-ghost"></a>
                            
                        </div>
                    </li>

                    

                    @foreach($menu as $men)
                    <li class="item-menu-mobile">
                        <a href="product-detail.html">{{$men->type_name}}</a>
                        <ul class="sub-menu">
                            @foreach($cats as $cat)
                            @if($cat->type_id==$men->id)
                            <li>
                                <a href="">{{$cat->category_name}}</a>
                                <ul class="sub-menu">
                                    @foreach($subs as $sub)
                                    @if($sub->cat_id==$cat->id)
                                    <li><a href="/products/{{$sub->id}}">{{$sub->sub_name}}</a></li>
                                    @endif
                                    @endforeach
                                </ul>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                        <i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
                    </li>
                    @endforeach
                    <li class="item-menu-mobile">
                        <a href="/sell">SELL WITH US</a>
                    </li>
                    <li class="item-menu-mobile">
                        <a href="/brands">BRANDS</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    @yield('content')

    <!-- Footer -->
    <footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
        <div class="flex-w p-b-90">
            <div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
                <h4 class="s-text12 p-b-30">
                    GET IN TOUCH
                </h4>

                <div>
                    <p class="s-text7 w-size27">
                        {{$stat->about}}
                    </p>

                    <div class="flex-m p-t-30">
                        <a href="{{$stat->face}}" class="topbar-social-item fa fa-facebook"></a>
						<a href="{{$stat->insta}}" class="topbar-social-item fa fa-instagram"></a>
						<a href="{{$stat->twit}}" class="fs-18 color1 p-r-20 fa fa-twitter"></a>
                        
                        <a href="{{$stat->snap}}" class="fs-18 color1 p-r-20 fa fa-snapchat-ghost"></a>
                        
                    </div>
                </div>
            </div>

            <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
                <h4 class="s-text12 p-b-30">
                    Categories
                </h4>
                <ul>
                    @foreach($menu as $men)
                    <li class="p-b-9">
                        <a href="/typepro/{{$men->id}}" class="s-text7">
                            {{$men->type_name}}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
                <h4 class="s-text12 p-b-30">
                    Links
                </h4>

                <ul>
                    <li class="p-b-9">
                        <a href="#" class="s-text7">
                            SEARCH
                        </a>
                    </li>

                    <li class="p-b-9">
                        <a href="/about" class="s-text7">
                            ABOUT US
                        </a>
                    </li>

                    <li class="p-b-9">
                        <a href="/contact" class="s-text7">
                            CONTACT US
                        </a>
                    </li>

                    <!--<li class="p-b-9">
                        <a href="#" class="s-text7">
                            Returns
                        </a>
                    </li>-->
                </ul>
            </div>

            <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
                <h4 class="s-text12 p-b-30">
                    HELP
                </h4>

                <ul>
                    <li class="p-b-9">
                        <a href="#" class="s-text7">
                            TRACK ORDER
                        </a>
                    </li>

                    <li class="p-b-9">
                        <a href="/returns" class="s-text7">
                            RETURNS
                        </a>
                    </li>

                    <li class="p-b-9">
                        <a href="/shipping" class="s-text7">
                            SHIPPING
                        </a>
                    </li>

                    <li class="p-b-9">
                        <a href="/faq" class="s-text7">
                            FAQs
                        </a>
                    </li>
                </ul>
            </div>

            <div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
                <h4 class="s-text12 p-b-30">
                    Newsletter
                </h4>

                <form action="/addnews" method="post">
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
                    <div class="effect1 w-size9">
                        <input class="s-text7 bg6 w-full p-b-5" type="text" name="email" placeholder="email@example.com">
                        <span class="effect1-line"></span>
                    </div>
                    <div class="w-size2 p-t-20">
                        <!-- Button -->
                        <button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4" type="submit">
                            Subscribe
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="t-center p-l-15 p-r-15">
            <a href="#">
                <img class="h-size2" src="{{asset('images/icons/paypal.png')}}" alt="IMG-PAYPAL">
            </a>

            <a href="#">
                <img class="h-size2" src="{{asset('images/icons/visa.png')}}" alt="IMG-VISA">
            </a>

            <a href="#">
                <img class="h-size2" src="{{asset('images/icons/mastercard.png')}}" alt="IMG-MASTERCARD">
            </a>

            <a href="#">
                <img class="h-size2" src="{{asset('images/icons/express.png')}}" alt="IMG-EXPRESS">
            </a>

            <a href="#">
                <img class="h-size2" src="{{asset('images/icons/discover.png')}}" alt="IMG-DISCOVER">
            </a>

            <div class="t-center s-text8 p-t-20">
                Copyright © 2018 <a href="#" target="_blank">SHIKHAS</a> All rights reserved. | Developed <i class="#" aria-hidden="true"></i> by <a href="http://www.touch-corp.com/" target="_blank">Touch-Corp</a>
            </div>
        </div>
    </footer>



    <!-- Back to top -->
    <div class="btn-back-to-top bg0-hov" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="fa fa-angle-double-up" aria-hidden="true"></i>
        </span>
    </div>

    <!-- Container Selection1 -->
    <div id="dropDownSelect1"></div>

    <!-- Modal Video 01-->
    <div class="modal fade" id="modal-video-01" tabindex="-1" role="dialog" aria-hidden="true">

        <div class="modal-dialog" role="document" data-dismiss="modal">
            <div class="close-mo-video-01 trans-0-4" data-dismiss="modal" aria-label="Close">&times;</div>

            <div class="wrap-video-mo-01">
                <div class="w-full wrap-pic-w op-0-0"><img src="{{asset('images/icons/video-16-9.jpg')}}" alt="IMG"></div>
                <div class="video-mo-01">
                    <iframe src="#" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

<!--===============================================================================================-->
    <script type="text/javascript" src="{{asset('vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
    <script type="text/javascript" src="{{asset('vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
    <script type="text/javascript" src="{{asset('vendor/bootstrap/js/popper.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
    <script type="text/javascript" src="{{asset('vendor/select2/select2.min.js')}}"></script>
    <script type="text/javascript">
        $(".selection-1").select2({
            minimumResultsForSearch: 20,
            dropdownParent: $('#dropDownSelect1')
        });
    </script>
<!--===============================================================================================-->
    <script type="text/javascript" src="{{asset('vendor/slick/slick.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/slick-custom.js')}}"></script>
<!--===============================================================================================-->
    <script type="text/javascript" src="{{asset('vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
    <script type="text/javascript" src="{{asset('vendor/lightbox2/js/lightbox.min.js')}}"></script>
<!--===============================================================================================-->
    <script type="text/javascript" src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script>
    <script type="text/javascript">
        $('.block2-btn-addcart').each(function(){
            var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            $(this).on('click', function(){
                swal(nameProduct, "is added to cart !", "success");
            });
        });

        $('.block2-btn-addwishlist').each(function(){
            var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            $(this).on('click', function(){
                swal(nameProduct, "is added to wishlist !", "success");
            });
        });
    </script>

<!--===============================================================================================-->
    <script type="text/javascript" src="{{asset('vendor/parallax100/parallax100.js')}}"></script>
    <script type="text/javascript">
        $('.parallax100').parallax100();
    </script>
<!--===============================================================================================-->
    <script src="{{asset('js/main.js')}}"></script>

</body>
</html>
<!------------------------------------------------------------------
Project:  120
Version:  x1
Last change:  3/10/2018
Assigned to:  SHIKHAS Corp!
Primary use:  Company
Designed by: Www.123solution.net
Mail: info@123solution.net
Phone: (+2) 01012470555
123SOLUTION GP
-------------------------------------------------------------------*/
/*------------------------------------------------------------------>