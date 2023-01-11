@if(session()->has('gemail'))
<?php
	session()->put('code',rand(1000, 9999));
?>
Welcome to shaika's
<br>
your verification key is : {{session()->get('code')}}
<br>
Type this code in page then reset password.
@elseif(session()->has('notef'))
Notifications from Shaikha's
<br>
<?php
	session()->pull('notef');
	$order=session()->pull('order');
	$x=session()->pull('message'); 
	echo $x[0];
?>
<hr>
<p>Order Details:</p>
<?php
	foreach($order[0] as $o){
		echo '<p>'.$o->product_name.' | Price:'.$o->price.'</p>';
	}
?>
@else
Newsletter from Shaikhas
<br>
<?php 
	$x=session()->pull('message'); 
	echo $x[0];
?>
@endif