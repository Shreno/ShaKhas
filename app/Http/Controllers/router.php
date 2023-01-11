<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use Session;
use Socialite;
//DB Connect
use App\Users;
use App\Countries;
use App\BuyReq;
use App\Messages;
use App\Comments;
use App\Products;
use App\Proposal;
use App\Sitestat;
use App\Type;
use App\Billstat;
use App\Billdet;
use App\Shipinfo;
use App\Brands;
use App\Category;
use App\Subcat;
use App\Contact;
use App\Endbage;
use App\Zones;
use App\Zonecont;
use App\Usercart;
use App\Zonercont;
use App\Shipcomp;
use App\Newsletter;
use App\Userwish;
use App\Adminmes;
use App\Newsmes;
use App\Panner;
use App\Banimg;

class router extends Controller
{
    public function index(){
     //check bagtime
  $allbags=Usercart::all();
  $bgtm=Sitestat::first();
  $bgtm=$bgtm->bagtime;
	foreach($allbags as $v){
   if(date('d')==substr($v->reg_date,8,2)&&date('H')!='00'&&date('H')!='00'&&date('H')!='23'&&date('H')!='01'){
    echo 'there';
    $hours=(date('H')-substr($v->reg_date,11,2))+1;
    $min=date('i')-substr($v->reg_date,14,2);
    $allmin=($hours*60)+$min;
    if($allmin>=$bgtm){
     Products::where('id',$v->product_id)->update(['status'=>'show']);
     Usercart::where('id',$v->id)->delete();
    }
   }elseif(date('d')!=substr($v->reg_date,8,2)&&date('H')!='00'&&date('H')!='23'&&date('H')!='01'){
    Products::where('id',$v->product_id)->update(['status'=>'show']);
    Usercart::where('id',$v->id)->delete();
   }
  }
  //end of check bagtime
  //Visits
  $chk=session('visit');
  if($chk==null){
   Session::put('visit', true);
   $visits=Sitestat::first();
   $visits=$visits->visits + 1;
   Sitestat::where('id',1)->update(['visits'=>$visits]);
  }
  //End Visits
     $menu=type::all();
     $cats=Category::all();
     $subs=Subcat::all();
     $cart=[];
     $newmes=0;
     if(Auth::user()){
      $cart=Usercart::join('products','products.id','=','user_cart.product_id')
      ->where('user_cart.user_id',Auth::user()->id)
      ->select('user_cart.*','products.product_name','products.img','products.price')->get();
      $newmes=count(Adminmes::where('to_user',Auth::user()->id)->where('seen','no')->get());
     }
     $stat=Sitestat::first();
     //Index Body
     $hotdeal=Products::where('hotdeal',1)->where('status','show')->take(3)->get();
     $newarrv=Products::where('status','show')->orderBy('id','desc')->take(8)->get();
     $panner=Panner::all();
     return View('index')->withTitle('SHAIKHAS-HOME')->withMenu($menu)->withCats($cats)->withSubs($subs)->withCart($cart)
     ->withNewmes($newmes)->withStat($stat)->withHotdeal($hotdeal)->withNewarrv($newarrv)->withPanner($panner);
    }


    public function inx(){
     return redirect('/');
    }
    public function login(){
     $menu=type::all();
     $cats=Category::all();
     $subs=Subcat::all();
     $con=Contact::all();
     $cart=[];
     $newmes=0;
     if(Auth::user()){
      $cart=Usercart::join('products','products.id','=','user_cart.product_id')
      ->where('user_cart.user_id',Auth::user()->id)
      ->select('user_cart.*','products.product_name','products.img','products.price')->get();
      $newmes=count(Adminmes::where('to_user',Auth::user()->id)->where('seen','no')->get());
     }
     $stat=Sitestat::first();

     if(Auth::user()){
      return redirect('/');
     }
     $countr=Countries::all();
     $panner=Panner::all();
     return View('auth/login')->withTitle('SHAIKHAS-LOGIN')->withCountr($countr)->withMenu($menu)->withCats($cats)
     ->withCon($con)->withSubs($subs)->withCart($cart)->withNewmes($newmes)->withStat($stat)->withPanner($panner);
    }


    public function postlogin(Request $request)
    {
     $valarr=[
      'email'=>'required|exists:users,email',
     ];
     $this->validate($request,$valarr);
        $credentials = $request->only('email', 'password');
       if (Auth::attempt($credentials)) {
            if(Auth::user()->role=='admin'||Auth::user()->role=='sadmin'){
       return redirect('/admin');
      }elseif(Auth::user()->role=='blocked'){
       return redirect('/out');
      }else{
      	$chk=BuyReq::where('user_id',Auth::user()->id)->where('state',0)->first();
      	if(!empty($chk)){
      		return redirect('/payment/'.$chk->id);
      	}
      	if(session()->has('cartpro')){
      		$mid=session()->get('cartpro');
      		$chek=Products::where('id',$mid)->where('status','show')->first();
      		if(!empty($chek)){
	      		Usercart::insert(['user_id'=>Auth::user()->id,'product_id'=>$mid]);
	            Products::where('id',$mid)->update(['status'=>'sold']);
	            session()->forget('cartpro');
	            return redirect('/product/'.$mid);
	        }
      	}
       return redirect('/');
      }
        }else{
         $error = \Illuminate\Validation\ValidationException::withMessages([
		      'Password' => ['Error In Password']
		   ]);
		   throw $error;
        }
    }
    public function facelog(){
    	return Socialite::driver('facebook')->redirect();
    }
    public function faceback(){
    	try {
            $user = Socialite::driver('facebook')->user();
        } catch (\Exception $e) {
            return redirect('/log');
        }
		if(!isset($user->first_name)){
			$fname='Not';
		}else{
			$fname=$user->first_name;
		}
		if(!isset($user->last_name)){
			$lname='Detected';
		}else{
			$lname=$user->last_name;
		}
    	$chk=Users::where('email',$user->email)->where('face_id','!=','')->first();
    	if(!empty($chk)){
    		Auth::loginUsingId($chk->id);
    	}else{
    		Users::insert(['user_name'=>$fname,'user_name2'=>$lname,'email'=>$user->email,'role'=>'user','face_id'=>$user->id]);
    		$chk=Users::where('email',$user->email)->where('face_id','!=','')->first();
    		Auth::loginUsingId($chk->id);
    	}
    	return redirect('/');
    }
    public function google(){
    	return Socialite::driver('google')->redirect();
    }
    public function gmback(){
    	$user = Socialite::driver('google')->user();
    	/*try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/log');
        }*/
		if(!isset($user->first_name)){
			$fname='Not';
		}else{
			$fname=$user->first_name;
		}
		if(!isset($user->last_name)){
			$lname='Detected';
		}else{
			$lname=$user->last_name;
		}
    	$chk=Users::where('email',$user->email)->where('gmail_id','!=','')->first();
    	if(!empty($chk)){
    		Auth::loginUsingId($chk->id);
    	}else{
    		Users::insert(['user_name'=>$fname,'user_name2'=>$lname,'email'=>$user->email,'role'=>'user','gmail_id'=>$user->id]);
    		$chk=Users::where('email',$user->email)->where('gmail_id','!=','')->first();
    		Auth::loginUsingId($chk->id);
    	}
    	return redirect('/');
    }
    public function contact(){
     $menu=type::all();
     $cats=Category::all();
     $subs=Subcat::all();
     $con=Contact::all();
     $cart=[];
     $newmes=0;
     if(Auth::user()){
      $cart=Usercart::join('products','products.id','=','user_cart.product_id')
      ->where('user_cart.user_id',Auth::user()->id)
      ->select('user_cart.*','products.product_name','products.img','products.price')->get();
      $newmes=count(Adminmes::where('to_user',Auth::user()->id)->where('seen','no')->get());
     }
     $stat=Sitestat::first();
     $panner=Panner::all();
     $banimg=Banimg::all();
     return View('contact')->withTitle('SHAIKHAS-CONTACT US')->withMenu($menu)->withCats($cats)->withCon($con)
     ->withSubs($subs)->withCart($cart)->withNewmes($newmes)->withStat($stat)->withPanner($panner)
     ->withBanimg($banimg);
    }
    public function productlist($id){
     $menu=type::all();
     $cats=Category::all();
     $subs=Subcat::all();
     $con=Contact::all();
     $cart=[];
     $newmes=0;
     if(Auth::user()){
      $cart=Usercart::join('products','products.id','=','user_cart.product_id')
      ->where('user_cart.user_id',Auth::user()->id)
      ->select('user_cart.*','products.product_name','products.img','products.price')->get();
      $newmes=count(Adminmes::where('to_user',Auth::user()->id)->where('seen','no')->get());
     }
     $stat=Sitestat::first();
     //List View
     $srt=Session::get('filtersrt');
     $pri=Session::get('filterpri');
     $brn=Session::get('filterbrn');
     $col=Session::get('filtercol');
     $siz=Session::get('filtersiz');
     $con=Session::get('filtercon');
     $query = Products::query();
     $query = $query->where('sub_id',$id)->where('status','show');
     if(!empty($brn)){
      $brn=explode(',', $brn);
      $i=0;
      foreach($brn as $brnn){
       if($brnn!=""&&$i==0){
        $query = $query->where('brand_id',$brnn);
       }elseif($brnn!=""&&$i!=0){
        $query = $query->orwhere('brand_id',$brnn);
       }
       $i++;
      }
     }
     if(!empty($col)){
      $col=explode(',', $col);
      $i=0;
      foreach($col as $coll){
       if($coll!=""&&$i==0){
        $query = $query->where('color',$coll);
       }elseif($coll!=""&&$i!=0){
        $query = $query->orwhere('color',$coll);
       }
       $i++;
      }
     }
     if(!empty($siz)){
      $siz=explode(',', $siz);
      $i=0;
      foreach($siz as $coll){
       if($coll!=""&&$i==0){
        $query = $query->where('size',$coll);
       }elseif($coll!=""&&$i!=0){
        $query = $query->orwhere('size',$coll);
       }
       $i++;
      }
     }
     if(!empty($con)){
      $con=explode(',', $con);
      $i=0;
      foreach($con as $coll){
       if($coll!=""&&$i==0){
        $query = $query->where('conditions',$coll);
       }elseif($coll!=""&&$i!=0){
        $query = $query->orwhere('conditions',$coll);
       }
       $i++;
      }
     }
     if(!empty($pri)){
      if($pri==1){
    $query = $query->where('price','<',100);
      }elseif($pri==2){
       $query = $query->whereBetween('price',[100,500]);
      }elseif($pri==3){
       $query = $query->whereBetween('price',[500,1000]);
      }elseif($pri==4){
       $query = $query->whereBetween('price',[1000,4000]);
      }elseif($pri==5){
       $query = $query->where('price','>',4000);
      }
     }
     if(!empty($srt)){
      if($srt==1){
       $query = $query->orderBy('visits','desc');
      }elseif($srt==2||$srt==""){
       $query = $query->orderBy('id','desc');
      }elseif($srt==4){
       $query = $query->orderBy('price');
      }elseif($srt==5){
       $query = $query->orderBy('price','desc');
      }else{
       $query = $query->orderBy('id','desc');
      } 
     }else{
      $query = $query->orderBy('id','desc');
     }
     $list = $query->paginate(10);
     //!-- End List View
     $su=Subcat::where('id',$id)->first();

     if(empty($su)){
      return redirect('/');
     }
     $ca=Category::where('id',$su->cat_id)->first();
     $brands=Brands::all();
     $colors=Products::where('status','show')->distinct('color')->select('color')->get();
     $sizes=Products::where('status','show')->distinct()->select('size')->get();
     $condi=Products::where('status','show')->distinct()->select('conditions')->get();

     $panner=Panner::all();
     return View('products')->withTitle('SHAIKHAS-PRODUCT LIST')->withMenu($menu)->withCats($cats)->withSubs($subs)
     ->withCart($cart)->withNewmes($newmes)->withStat($stat)->withCon($con)->withList($list)->withCa($ca)->withSu($su)
     ->withSrt($srt)->withPri($pri)->withBrands($brands)->withColors($colors)->withSizes($sizes)->withCondi($condi)->withPanner($panner);
    }
    public function srtproductlist($id,$num1,$num2){
  Session::put('filtersrt', $num1);
  Session::put('filterpri', $num2);
  return redirect('/products/'.$id);
    }
    public function product($id){
     $menu=type::all();
     $cats=Category::all();
     $subs=Subcat::all();
     $con=Contact::all();
     $stat=Sitestat::first();
     $panner=Panner::all();

     $cart=[];
     $newmes=0;
     if(Auth::user()){
      $cart=Usercart::join('products','products.id','=','user_cart.product_id')
      ->where('user_cart.user_id',Auth::user()->id)
      ->select('user_cart.*','products.product_name','products.img','products.price')->get();
      $newmes=count(Adminmes::where('to_user',Auth::user()->id)->where('seen','no')->get());
     }

     $list=Products::where('id',$id)->first();
     if(empty($list)){
      return redirect('/');
     }
     $ca=Category::where('id',$list->cat_id)->first();
     $su=Subcat::where('id',$list->sub_id)->first();
     $rel=Products::where('sub_id',$su->id)->where('status','show')->get();
     //visits
     $count=$list->visits +1;
     Products::where('id',$id)->update(['visits'=>$count]);
     return View('product')->withTitle('SHAIKHAS-PRODUCT | '.$list->product_name)->withMenu($menu)
     ->withCats($cats)->withSubs($subs)->withCart($cart)->withNewmes($newmes)->withCon($con)->withList($list)->withCa($ca)->withSu($su)
     ->withStat($stat)->withRel($rel)->withPanner($panner);
    }
    public function about(){
     $menu=type::all();
     $cats=Category::all();
     $subs=Subcat::all();
     $con=Contact::all();
     $cart=[];
     $newmes=0;
     if(Auth::user()){
      $cart=Usercart::join('products','products.id','=','user_cart.product_id')
      ->where('user_cart.user_id',Auth::user()->id)
      ->select('user_cart.*','products.product_name','products.img','products.price')->get();
      $newmes=count(Adminmes::where('to_user',Auth::user()->id)->where('seen','no')->get());
     }
     $stat=Sitestat::first();
     $panner=Panner::all();

     $about=Endbage::first();
     $banimg=Banimg::all();
     return View('about')->withTitle('SHAIKHAS-About US')->withMenu($menu)->withCats($cats)->withCon($con)
     ->withSubs($subs)->withCart($cart)->withNewmes($newmes)->withStat($stat)->withPanner($panner)->withAbout($about)
     ->withBanimg($banimg);
    }
    public function user(){
     $menu=type::all();
     $cats=Category::all();
     $subs=Subcat::all();
     $con=Contact::all();
     $cart=[];
     $newmes=0;
     if(Auth::user()){
      $cart=Usercart::join('products','products.id','=','user_cart.product_id')
      ->where('user_cart.user_id',Auth::user()->id)
      ->select('user_cart.*','products.product_name','products.img','products.price')->get();
      $newmes=count(Adminmes::where('to_user',Auth::user()->id)->where('seen','no')->get());
     }
     $stat=Sitestat::first();
     $panner=Panner::all();

     if(!Auth::user()){
      return redirect('/');
     }
     
     $wish=Userwish::join('products','products.id','=','user_wishlist.product_id')
     ->where('user_wishlist.user_id',Auth::user()->id)->get();
     $mesg=Adminmes::where('to_user',Auth::user()->id)->orderBy('id','desc')->get();
     $ord=BuyReq::join('bills_status','bills_status.id','=','buy_requests.order_status')
     ->where('buy_requests.state',1)->where('buy_requests.user_id',Auth::user()->id)
     ->select('buy_requests.*','bills_status.state as stat')->get();
     Adminmes::where('to_user',Auth::user()->id)->where('seen','no')->update(['seen'=>'yes']);
     return View('user')->withTitle('SHAIKHAS-MY ACCOUNT')->withMenu($menu)->withCats($cats)->withCon($con)
     ->withSubs($subs)->withCart($cart)->withNewmes($newmes)->withStat($stat)->withPanner($panner)->withWish($wish)->withMesg($mesg)
     ->withOrd($ord);
    }
    public function cart(){
     $menu=type::all();
     $cats=Category::all();
     $subs=Subcat::all();
     $con=Contact::all();
     $banimg=Banimg::all();
     $cart=[];
     $newmes=0;
     if(Auth::user()){
      $cart=Usercart::join('products','products.id','=','user_cart.product_id')
      ->where('user_cart.user_id',Auth::user()->id)
      ->select('user_cart.*','products.product_name','products.img','products.price')->get();
      $newmes=count(Adminmes::where('to_user',Auth::user()->id)->where('seen','no')->get());
     }
     $stat=Sitestat::first();
     $panner=Panner::all();

     if(!Auth::user()){
      return redirect('/');
     }
     
     $count=Countries::all();
     $comp=Shipcomp::join('company_zone','company_zone.company','=','shipping companies.id')
     ->join('zones_countries','zones_countries.zone','=','company_zone.zone')
     ->select('shipping companies.name','shipping companies.id','zones_countries.country','company_zone.price')->get();
     return View('cart')->withTitle('SHAIKHAS-CART')->withMenu($menu)->withCats($cats)->withCon($con)
     ->withSubs($subs)->withCart($cart)->withNewmes($newmes)->withStat($stat)->withPanner($panner)->withCount($count)->withComp($comp)->withBanimg($banimg);
    }
    public function payment($id){
     $menu=type::all();
     $cats=Category::all();
     $subs=Subcat::all();
     $con=Contact::all();
     $cart=[];
     $newmes=0;
     if(Auth::user()){
      $cart=Usercart::join('products','products.id','=','user_cart.product_id')
      ->where('user_cart.user_id',Auth::user()->id)
      ->select('user_cart.*','products.product_name','products.img','products.price')->get();
      $newmes=count(Adminmes::where('to_user',Auth::user()->id)->where('seen','no')->get());
     }
     $stat=Sitestat::first();
     $panner=Panner::all();

     if(!Auth::user()){
      return redirect('/');
     }
     
     $products=Billdet::join('products','products.id','=','bill_details.product_id')
     ->where('bill_details.buy_id',$id)
     ->select('bill_details.*','products.product_name')->get();
     $breq=BuyReq::where('id',$id)->first();
     return View('payment')->withTitle('SHAIKHAS-Payment')->withMenu($menu)->withCats($cats)->withCon($con)
     ->withSubs($subs)->withCart($cart)->withNewmes($newmes)->withStat($stat)->withPanner($panner)->withProducts($products)->withBreq($breq);
    }
    public function terms(){
     $menu=type::all();
     $cats=Category::all();
     $subs=Subcat::all();
     $con=Contact::all();
     $cart=[];
     $newmes=0;
     if(Auth::user()){
      $cart=Usercart::join('products','products.id','=','user_cart.product_id')
      ->where('user_cart.user_id',Auth::user()->id)
      ->select('user_cart.*','products.product_name','products.img','products.price')->get();
      $newmes=count(Adminmes::where('to_user',Auth::user()->id)->where('seen','no')->get());
     }
     $stat=Sitestat::first();
     $panner=Panner::all();
     
     $end=Endbage::where('id',1)->first();
     return View('terms')->withTitle('SHAIKHAS-TERMS&CONDITIONS')->withMenu($menu)->withCats($cats)->withCon($con)
     ->withSubs($subs)->withCart($cart)->withNewmes($newmes)->withStat($stat)->withPanner($panner)->withEnd($end);
    }
    public function repass(){
    	$menu=type::all();
	     $cats=Category::all();
	     $subs=Subcat::all();
	     $con=Contact::all();
	     $cart=[];
	     $newmes=0;
	     if(Auth::user()){
	      $cart=Usercart::join('products','products.id','=','user_cart.product_id')
	      ->where('user_cart.user_id',Auth::user()->id)
	      ->select('user_cart.*','products.product_name','products.img','products.price')->get();
	      $newmes=count(Adminmes::where('to_user',Auth::user()->id)->where('seen','no')->get());
	     }
	     $stat=Sitestat::first();
       $panner=Panner::all();

    	return view('auth/reset')->withTitle('SHAIKHAS-Reset Password')->withMenu($menu)->withCats($cats)->withCon($con)
     ->withSubs($subs)->withCart($cart)->withNewmes($newmes)->withStat($stat)->withPanner($panner);
    }
    public function logwcart($id){
    	session()->put('cartpro',$id);
    	return redirect('/log');
    }
    public function brands(){
     $menu=type::all();
     $cats=Category::all();
     $subs=Subcat::all();
     $con=Contact::all();
     $banimg=Banimg::all();
     $cart=[];
     $newmes=0;
     if(Auth::user()){
      $cart=Usercart::join('products','products.id','=','user_cart.product_id')
      ->where('user_cart.user_id',Auth::user()->id)
      ->select('user_cart.*','products.product_name','products.img','products.price')->get();
      $newmes=count(Adminmes::where('to_user',Auth::user()->id)->where('seen','no')->get());
     }
     $stat=Sitestat::first();
     $panner=Panner::all();

     $ztn=Brands::where('brand_name', 'regexp', '^[0-9]+')->get();
     $ach=Brands::where('brand_name','like','a%')->get();
     $bch=Brands::where('brand_name','like','b%')->get();
     $cch=Brands::where('brand_name','like','c%')->get();
     $dch=Brands::where('brand_name','like','d%')->get();
     $ech=Brands::where('brand_name','like','e%')->get();
     $fch=Brands::where('brand_name','like','f%')->get();
     $gch=Brands::where('brand_name','like','g%')->get();
     $hch=Brands::where('brand_name','like','h%')->get();
     $ich=Brands::where('brand_name','like','i%')->get();
     $jch=Brands::where('brand_name','like','j%')->get();
     $kch=Brands::where('brand_name','like','k%')->get();
     $lch=Brands::where('brand_name','like','l%')->get();
     $mch=Brands::where('brand_name','like','m%')->get();
     $nch=Brands::where('brand_name','like','n%')->get();
     $och=Brands::where('brand_name','like','o%')->get();
     $pch=Brands::where('brand_name','like','p%')->get();
     $qch=Brands::where('brand_name','like','q%')->get();
     $rch=Brands::where('brand_name','like','r%')->get();
     $sch=Brands::where('brand_name','like','s%')->get();
     $tch=Brands::where('brand_name','like','t%')->get();
     $uch=Brands::where('brand_name','like','u%')->get();
     $vch=Brands::where('brand_name','like','v%')->get();
     $wch=Brands::where('brand_name','like','w%')->get();
     $xch=Brands::where('brand_name','like','x%')->get();
     $ych=Brands::where('brand_name','like','y%')->get();
     $zch=Brands::where('brand_name','like','z%')->get();
     return View('brands')->withTitle('SHAIKHAS-BRANDS')->withMenu($menu)->withCats($cats)->withCon($con)
     ->withSubs($subs)->withCart($cart)->withNewmes($newmes)->withStat($stat)->withPanner($panner)
     ->withZtn($ztn)->withAch($ach)->withBch($bch)->withCch($cch)->withDch($dch)->withEch($ech)->withFch($fch)
     ->withGch($gch)->withHch($hch)->withIch($ich)->withJch($jch)->withKch($kch)->withLch($lch)->withMch($mch)
     ->withNch($nch)->withOch($och)->withPch($pch)->withQch($qch)->withRch($rch)->withSch($sch)->withTch($tch)
     ->withUch($uch)->withVch($vch)->withWch($wch)->withXch($xch)->withYch($ych)->withZch($zch)->withBanimg($banimg);
    }
    public function sell(){
     $menu=type::all();
     $cats=Category::all();
     $subs=Subcat::all();
     $con=Contact::all();
     $cart=[];
     $newmes=0;
     if(Auth::user()){
      $cart=Usercart::join('products','products.id','=','user_cart.product_id')
      ->where('user_cart.user_id',Auth::user()->id)
      ->select('user_cart.*','products.product_name','products.img','products.price')->get();
      $newmes=count(Adminmes::where('to_user',Auth::user()->id)->where('seen','no')->get());
     }
     $stat=Sitestat::first();
     $panner=Panner::all();

     $brands=Brands::all();
     $banimg=Banimg::all();
     return View('sell')->withTitle('SHAIKHAS-SELL WITH US')->withMenu($menu)->withCats($cats)->withCon($con)
     ->withSubs($subs)->withCart($cart)->withNewmes($newmes)->withStat($stat)->withPanner($panner)->withBrands($brands)
     ->withBanimg($banimg);
    }
    public function brandpro($bid){
     $menu=type::all();
     $cats=Category::all();
     $subs=Subcat::all();
     $con=Contact::all();
     $cart=[];
     $newmes=0;
     if(Auth::user()){
      $cart=Usercart::join('products','products.id','=','user_cart.product_id')
      ->where('user_cart.user_id',Auth::user()->id)
      ->select('user_cart.*','products.product_name','products.img','products.price')->get();
      $newmes=count(Adminmes::where('to_user',Auth::user()->id)->where('seen','no')->get());
     }
     $stat=Sitestat::first();
     $panner=Panner::all();
     //List View
     $srt=Session::get('filtersrt');
     $pri=Session::get('filterpri');
     $col=Session::get('filtercol');
     $siz=Session::get('filtersiz');
     $con=Session::get('filtercon');
     $query = Products::query();
     $query = $query->where('brand_id',$bid)->where('status','show');
     if(!empty($col)){
      $col=explode(',', $col);
      $i=0;
      foreach($col as $coll){
       if($coll!=""&&$i==0){
        $query = $query->where('color',$coll);
       }elseif($coll!=""&&$i!=0){
        $query = $query->orwhere('color',$coll);
       }
       $i++;
      }
     }
     if(!empty($siz)){
      $siz=explode(',', $siz);
      $i=0;
      foreach($siz as $coll){
       if($coll!=""&&$i==0){
        $query = $query->where('size',$coll);
       }elseif($coll!=""&&$i!=0){
        $query = $query->orwhere('size',$coll);
       }
       $i++;
      }
     }
     if(!empty($con)){
      $con=explode(',', $con);
      $i=0;
      foreach($con as $coll){
       if($coll!=""&&$i==0){
        $query = $query->where('conditions',$coll);
       }elseif($coll!=""&&$i!=0){
        $query = $query->orwhere('conditions',$coll);
       }
       $i++;
      }
     }
     if(!empty($pri)){
      if($pri==1){
    $query = $query->where('price','<',100);
      }elseif($pri==2){
       $query = $query->whereBetween('price',[100,500]);
      }elseif($pri==3){
       $query = $query->whereBetween('price',[500,1000]);
      }elseif($pri==4){
       $query = $query->whereBetween('price',[1000,4000]);
      }elseif($pri==5){
       $query = $query->where('price','>',4000);
      }
     }
     if(!empty($srt)){
      if($srt==1){
       $query = $query->orderBy('visits','desc');
      }elseif($srt==2||$srt==""){
       $query = $query->orderBy('id','desc');
      }elseif($srt==4){
       $query = $query->orderBy('price');
      }elseif($srt==5){
       $query = $query->orderBy('price','desc');
      }else{
       $query = $query->orderBy('id','desc');
      } 
     }else{
      $query = $query->orderBy('id','desc');
     }
     $list = $query->paginate(10);
     //!-- End List View
     $su=Brands::where('id',$bid)->first();

     if(empty($su)){
      return redirect('/');
     }
     $colors=Products::where('status','show')->distinct('color')->select('color')->get();
     $sizes=Products::where('status','show')->distinct()->select('size')->get();
     $condi=Products::where('status','show')->distinct()->select('conditions')->get();
     return View('brandpro')->withTitle('SHAIKHAS-BRAND PRODUCTS')->withMenu($menu)->withCats($cats)->withSubs($subs)
     ->withCart($cart)->withNewmes($newmes)->withStat($stat)->withPanner($panner)->withCon($con)->withList($list)->withSu($su)
     ->withSrt($srt)->withPri($pri)->withColors($colors)->withSizes($sizes)->withCondi($condi);
    }
    public function typepro($bid){
     $menu=type::all();
     $cats=Category::all();
     $subs=Subcat::all();
     $con=Contact::all();
     $cart=[];
     $newmes=0;
     if(Auth::user()){
      $cart=Usercart::join('products','products.id','=','user_cart.product_id')
      ->where('user_cart.user_id',Auth::user()->id)
      ->select('user_cart.*','products.product_name','products.img','products.price')->get();
      $newmes=count(Adminmes::where('to_user',Auth::user()->id)->where('seen','no')->get());
     }
     $stat=Sitestat::first();
     $panner=Panner::all();
     //List View
     $srt=Session::get('filtersrt');
     $pri=Session::get('filterpri');
     $col=Session::get('filtercol');
     $siz=Session::get('filtersiz');
     $con=Session::get('filtercon');
     $query = Products::query();
     $query = $query->where('status','show');
     if(!empty($col)){
      $col=explode(',', $col);
      $i=0;
      foreach($col as $coll){
       if($coll!=""&&$i==0){
        $query = $query->where('color',$coll);
       }elseif($coll!=""&&$i!=0){
        $query = $query->orwhere('color',$coll);
       }
       $i++;
      }
     }
     if(!empty($siz)){
      $siz=explode(',', $siz);
      $i=0;
      foreach($siz as $coll){
       if($coll!=""&&$i==0){
        $query = $query->where('size',$coll);
       }elseif($coll!=""&&$i!=0){
        $query = $query->orwhere('size',$coll);
       }
       $i++;
      }
     }
     if(!empty($con)){
      $con=explode(',', $con);
      $i=0;
      foreach($con as $coll){
       if($coll!=""&&$i==0){
        $query = $query->where('conditions',$coll);
       }elseif($coll!=""&&$i!=0){
        $query = $query->orwhere('conditions',$coll);
       }
       $i++;
      }
     }
     if(!empty($pri)){
      if($pri==1){
    $query = $query->where('price','<',100);
      }elseif($pri==2){
       $query = $query->whereBetween('price',[100,500]);
      }elseif($pri==3){
       $query = $query->whereBetween('price',[500,1000]);
      }elseif($pri==4){
       $query = $query->whereBetween('price',[1000,4000]);
      }elseif($pri==5){
       $query = $query->where('price','>',4000);
      }
     }
     if(!empty($srt)){
      if($srt==1){
       $query = $query->orderBy('visits','desc');
      }elseif($srt==2||$srt==""){
       $query = $query->orderBy('id','desc');
      }elseif($srt==4){
       $query = $query->orderBy('price');
      }elseif($srt==5){
       $query = $query->orderBy('price','desc');
      }else{
       $query = $query->orderBy('id','desc');
      } 
     }else{
      $query = $query->orderBy('id','desc');
     }
     $list = $query->paginate(10);
     //!-- End List View
     $su=Type::where('id',$bid)->first();
     $availabletypes=Category::where('type_id',$bid)->get();
     if(empty($su)){
      return redirect('/');
     }
     $colors=Products::where('status','show')->distinct('color')->select('color')->get();
     $sizes=Products::where('status','show')->distinct()->select('size')->get();
     $condi=Products::where('status','show')->distinct()->select('conditions')->get();
     return View('typepro')->withTitle('SHAIKHAS-CATEGORY PRODUCTS')->withMenu($menu)->withCats($cats)->withSubs($subs)
     ->withCart($cart)->withNewmes($newmes)->withStat($stat)->withPanner($panner)->withCon($con)->withList($list)->withSu($su)
     ->withSrt($srt)->withPri($pri)->withColors($colors)->withSizes($sizes)->withCondi($condi)->withAvail($availabletypes);
    }
    public function returns(){
     $menu=type::all();
     $cats=Category::all();
     $subs=Subcat::all();
     $con=Contact::all();
     $cart=[];
     $newmes=0;
     if(Auth::user()){
      $cart=Usercart::join('products','products.id','=','user_cart.product_id')
      ->where('user_cart.user_id',Auth::user()->id)
      ->select('user_cart.*','products.product_name','products.img','products.price')->get();
      $newmes=count(Adminmes::where('to_user',Auth::user()->id)->where('seen','no')->get());
     }
     $stat=Sitestat::first();
     $panner=Panner::all();
     
     $end=Endbage::where('id',1)->first();
     $banimg=Banimg::all();
     return View('returns')->withTitle('SHAIKHAS-RETURNS')->withMenu($menu)->withCats($cats)->withCon($con)
     ->withSubs($subs)->withCart($cart)->withNewmes($newmes)->withStat($stat)->withPanner($panner)->withEnd($end)
     ->withBanimg($banimg);
    }
    public function shipping(){
     $menu=type::all();
     $cats=Category::all();
     $subs=Subcat::all();
     $con=Contact::all();
     $cart=[];
     $newmes=0;
     if(Auth::user()){
      $cart=Usercart::join('products','products.id','=','user_cart.product_id')
      ->where('user_cart.user_id',Auth::user()->id)
      ->select('user_cart.*','products.product_name','products.img','products.price')->get();
      $newmes=count(Adminmes::where('to_user',Auth::user()->id)->where('seen','no')->get());
     }
     $stat=Sitestat::first();
     $panner=Panner::all();
     
     $end=Endbage::where('id',1)->first();
     $banimg=Banimg::all();
     return View('shipping')->withTitle('SHAIKHAS-SHIPPING')->withMenu($menu)->withCats($cats)->withCon($con)
     ->withSubs($subs)->withCart($cart)->withNewmes($newmes)->withStat($stat)->withPanner($panner)->withEnd($end)
     ->withBanimg($banimg);
    }
    public function faq(){
     $menu=type::all();
     $cats=Category::all();
     $subs=Subcat::all();
     $con=Contact::all();
     $cart=[];
     $newmes=0;
     if(Auth::user()){
      $cart=Usercart::join('products','products.id','=','user_cart.product_id')
      ->where('user_cart.user_id',Auth::user()->id)
      ->select('user_cart.*','products.product_name','products.img','products.price')->get();
      $newmes=count(Adminmes::where('to_user',Auth::user()->id)->where('seen','no')->get());
     }
     $stat=Sitestat::first();
     $panner=Panner::all();
     
     $end=Endbage::where('id',1)->first();
     $banimg=Banimg::all();
     return View('faq')->withTitle('SHAIKHAS-FAQs')->withMenu($menu)->withCats($cats)->withCon($con)
     ->withSubs($subs)->withCart($cart)->withNewmes($newmes)->withStat($stat)->withPanner($panner)->withEnd($end)
     ->withBanimg($banimg);
    }
    public function hotdeals(){
     $menu=type::all();
     $cats=Category::all();
     $subs=Subcat::all();
     $con=Contact::all();
     $cart=[];
     $newmes=0;
     if(Auth::user()){
      $cart=Usercart::join('products','products.id','=','user_cart.product_id')
      ->where('user_cart.user_id',Auth::user()->id)
      ->select('user_cart.*','products.product_name','products.img','products.price')->get();
      $newmes=count(Adminmes::where('to_user',Auth::user()->id)->where('seen','no')->get());
     }
     $stat=Sitestat::first();
     $panner=Panner::all();
     
     $hotdeals=Products::where('hotdeal',1)->where('status','show')->get();
     $banimg=Banimg::all();
     return View('hotdeals')->withTitle('SHAIKHAS-HOTDEALS')->withMenu($menu)->withCats($cats)->withCon($con)
     ->withSubs($subs)->withCart($cart)->withNewmes($newmes)->withStat($stat)->withPanner($panner)->withHotdeals($hotdeals)
     ->withBanimg($banimg);
    }
    // function to return new arrival poduct by shereen  
    public function NewArrival()
    {
         //check bagtime
  $allbags=Usercart::all();
  $bgtm=Sitestat::first();
  $bgtm=$bgtm->bagtime;
	foreach($allbags as $v){
   if(date('d')==substr($v->reg_date,8,2)&&date('H')!='00'&&date('H')!='00'&&date('H')!='23'&&date('H')!='01'){
    echo 'there';
    $hours=(date('H')-substr($v->reg_date,11,2))+1;
    $min=date('i')-substr($v->reg_date,14,2);
    $allmin=($hours*60)+$min;
    if($allmin>=$bgtm){
     Products::where('id',$v->product_id)->update(['status'=>'show']);
     Usercart::where('id',$v->id)->delete();
    }
   }elseif(date('d')!=substr($v->reg_date,8,2)&&date('H')!='00'&&date('H')!='23'&&date('H')!='01'){
    Products::where('id',$v->product_id)->update(['status'=>'show']);
    Usercart::where('id',$v->id)->delete();
   }
  }
  //end of check bagtime
  //Visits
  $chk=session('visit');
  if($chk==null){
   Session::put('visit', true);
   $visits=Sitestat::first();
   $visits=$visits->visits + 1;
   Sitestat::where('id',1)->update(['visits'=>$visits]);
  }
  //End Visits
     $menu=type::all();
     $cats=Category::all();
     $subs=Subcat::all();
     $cart=[];
     $newmes=0;
     if(Auth::user()){
      $cart=Usercart::join('products','products.id','=','user_cart.product_id')
      ->where('user_cart.user_id',Auth::user()->id)
      ->select('user_cart.*','products.product_name','products.img','products.price')->get();
      $newmes=count(Adminmes::where('to_user',Auth::user()->id)->where('seen','no')->get());
     }
     $stat=Sitestat::first();
     //Index Body
     $newarrv=Products::where('status','show')->orderBy('id','desc')->take(8)->get();
     $panner=Panner::all();
     $banimg=Banimg::all();
     return View('NewArrival')->withTitle('SHAIKHAS-New Arrival')->withMenu($menu)->withCats($cats)->withSubs($subs)->withCart($cart)
     ->withNewmes($newmes)->withStat($stat)->withNewarrv($newarrv)->withPanner($panner)->withBanimg($banimg);
      
     
 
    
    
    }
   
}
