<?php

/*
This File Create By Eng.Ahmed Magdy "6/10/2018 - 6:45 PM"
This File send routes to router controller to make process then return View
© 2018 By Touch-Corp (Shaikha's Closet V1.2)
*/

Route::get('/','router@index');

Route::get('/NewArrival','router@NewArrival');
Route::get('/hotdeals','router@hotdeals');
Route::get('/contact','router@contact');
Route::get('/logout','router@inx');
Route::get('/products/{id}','router@productlist');
Route::get('/products/{id}/{num1}/{num2}','router@srtproductlist');
Route::post('/filter','process@filter');
Route::get('/clearfilter','process@cfilter');
Route::get('/product/{id}','router@product');
Route::post('/addcart','process@addcart');
Route::get('/about','router@about');
Route::post('/sendmes','process@sendmes');
Route::post('/addnews','process@addnews');
Route::get('/user','router@user');
Route::get('/wishtog/{id}','process@wishtog');
Route::post('/edituser','process@edituser');
Route::post('/edituserpass','process@edituserpass');
Route::post('/sendproposal','process@sendproposal');
Route::get('/cart','router@cart');
Route::get('/removecart/{id}','process@removefcart');
Route::post('/newcountry','process@newcont');
Route::post('/tobill','process@tobill');
Route::get('/payment/{id}','router@payment');
Route::get('/paycash/{id}','process@cashpay');
Route::get('/terms','router@terms');
Route::get('/repass','router@repass');
Route::post('/resetpass','process@repass');
Route::post('/respass','process@respass');
Route::get('/codeback','process@codeback');
Route::get('/check','process@check');
Route::get('/logwithcart/{id}','router@logwcart');
Route::get('/brands','router@brands');
Route::get('/sell','router@sell');
Route::get('/brandpro/{id}','router@brandpro');
Route::get('/typepro/{id}','router@typepro');
Route::get('/returns','router@returns');
Route::get('/shipping','router@shipping');
Route::get('/faq','router@faq');
Route::get('/hotdeals','router@hotdeals');
//Login
Auth::routes();
Route::get('/log','router@login');
Route::post('/log', 'router@postlogin');
Route::get('/out','Auth\LoginController@logout');

Route::get('/auth/facebook','router@facelog');
Route::get('/fbcallback','router@faceback');
Route::get('/auth/google','router@google');
Route::get('/gmcallback','router@gmback');
//Registration
Route::post('/reg', 'process@reg');
//Admin DB
Route::get('/admin','adminrouter@index');

Route::post('/admin/bagtime','adminprocess@pgtm');

Route::get('/admin/menu','adminrouter@menu');
Route::get('/admin/menu/{id}','adminrouter@getmenu');
Route::post('/admin/editmenu','adminprocess@menu');

Route::get('/admin/orders','adminrouter@orders');
Route::get('/admin/orders/{id}','adminrouter@order');
Route::get('/changeorder/{order}/{state}','adminprocess@corder');

Route::get('/admin/newbrand','adminrouter@newbrand');
Route::post('/admin/addbrand','adminprocess@addbrand');

Route::get('/admin/editbrand','adminrouter@editbrand');
Route::get('/admin/editbrand/{id}','adminrouter@teditbrand');
Route::post('/admin/editbrand','adminprocess@editbrand');
Route::get('/admin/removebrand/{id}','adminprocess@removebrand');
Route::post('/admin/branlogo','adminprocess@branlogo');

Route::get('/admin/newcat','adminrouter@cat');
Route::post('/admin/addcat','adminprocess@addcat');

Route::get('/admin/editcat','adminrouter@editcat');
Route::get('/admin/editcat/{id}','adminrouter@teditcat');
Route::post('/admin/editcat','adminprocess@editcat');
Route::get('/admin/removecat/{id}','adminprocess@removecat');

Route::get('/admin/newsubcat','adminrouter@subcat');
Route::post('/admin/addnewsub','adminprocess@addsubcat');

Route::get('/admin/newproduct','adminrouter@product');
Route::post('/admin/addproduct','adminprocess@addpro');

Route::get('/admin/editproduct','adminrouter@editproduct');
Route::get('/admin/editproduct/search/{s}','adminrouter@seditproduct');
Route::get('/admin/editproduct/{id}','adminrouter@teditproduct');
Route::post('/admin/editproduct','adminprocess@editpro');
Route::get('/admin/hideproduct/{id}','adminprocess@hidepro');
Route::get('/admin/hotproduct/{id}','adminprocess@hotpro');
Route::get('/admin/removeproduct/{id}','adminprocess@removepro');

Route::get('/admin/editsubcat','adminrouter@editsubcat');
Route::get('/admin/editsubcat/{id}','adminrouter@teditsubcat');
Route::post('/admin/editsub','adminprocess@editsub');
Route::get('/admin/removesub/{id}','adminprocess@removesub');

Route::get('/admin/contact','adminrouter@contact');
Route::post('/admin/contact','adminprocess@contact');

Route::get('/admin/billstatus','adminrouter@billstatus');
Route::post('/admin/billstatuspr','adminprocess@billstatuspr');
Route::post('/admin/addbillstat','adminprocess@addbillstat');
Route::post('/admin/editbillstat','adminprocess@editbillstat');
Route::get('/admin/removestatus/{id}','adminprocess@removestatus');

Route::get('/admin/about','adminrouter@about');
Route::post('/admin/about','adminprocess@about');

Route::get('/admin/social','adminrouter@social');
Route::post('/admin/social','adminprocess@social');

Route::get('/admin/tabs','adminrouter@tabs');
Route::post('/admin/tabs','adminprocess@tabs');

Route::get('/admin/users','adminrouter@users');
Route::get('/admin/users/search/{s}','adminrouter@susers');
Route::get('/admin/users/{id}','adminrouter@tusers');
Route::post('/admin/user','adminprocess@user');
Route::get('/admin/removeuser/{id}','adminprocess@removeuser');
Route::get('/admin/useradmin/{id}','adminprocess@useradmin');
Route::get('/admin/userblock/{id}','adminprocess@userblock');

Route::get('/admin/privacy','adminrouter@privacy');
Route::post('/admin/privacy','adminprocess@privacy');

Route::get('/admin/zones','adminrouter@zones');
Route::post('/admin/newzone','adminprocess@newzone');
Route::post('/admin/contzone','adminprocess@contzone');
Route::post('/admin/editzones','adminprocess@editzone');
Route::get('/admin/remrel/{id}','adminprocess@remrel');
Route::get('/admin/zones/remove/{id}','adminprocess@removezone');

Route::get('/admin/comp','adminrouter@comp');
Route::post('/admin/newcomp','adminprocess@newcomp');
Route::post('/admin/compzone','adminprocess@compzone');
Route::get('/admin/remrelcomp/{id}','adminprocess@remrelcomp');
Route::post('/admin/editcomp','adminprocess@editcomp');
Route::get('/admin/comp/remove/{id}','adminprocess@removecomp');
Route::post('/admin/editcompzone','adminprocess@editcompzone');

Route::get('/admin/messages','adminrouter@inbox');
Route::get('/admin/sendmes','adminrouter@sendmes');
Route::post('/admin/sendmes','adminprocess@sendmes');
Route::post('/admin/selformes','adminrouter@resendmes');

Route::get('/admin/prop','adminrouter@prop');
Route::get('/admin/prop/{id}','adminrouter@rprop');
Route::get('/admin/propapprove/{id}','adminprocess@propapp');

Route::get('/admin/newsletter','adminrouter@newsletter');
Route::get('/admin/newsletter/{id}','adminrouter@newsletterwi');
Route::post('/admin/sendnews','adminprocess@sendnews');

Route::get('/admin/oldnews','adminrouter@oldnews');

Route::get('/admin/word','adminrouter@word');
Route::post('/admin/word','adminprocess@word');

Route::get('/admin/butbanner','adminrouter@butbanner');
Route::post('/admin/butbanner','adminprocess@butbanner');

Route::get('/admin/banners','adminrouter@banners');
Route::post('/admin/newbanner','adminprocess@newban');
Route::post('/admin/editban/{id}','adminprocess@editban');
Route::get('/admin/banrem/{id}','adminprocess@remban');

Route::get('/admin/bagesbanner','adminrouter@bagesbanner');
Route::post('/admin/pagesbanner','adminprocess@pagesbanner');