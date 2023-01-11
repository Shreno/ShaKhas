<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
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

class adminrouter extends Controller
{
    public function __construct(){
     $this->middleware('auth');
 }
    public function index(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
     $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
     $getnewmes=Messages::where('seen','no')->get();
     $getnewcom=Comments::join('products','comments.product_id','=','products.id')
     ->where('comments.seen','no')
     ->select('comments.*','products.product_name')->get();
     $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
     ->where('proposal.seen','no')
     ->select('proposal.*','users.user_name')->get();
     $stat=Sitestat::where('id',1)->first();
     $usercount=count(Users::all());
     $buydata=BuyReq::all();
     return view('admin/index')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
     ->withGetnewprop($getnewprop)->withStat($stat)->withUsercount($usercount)->withBuydata($buydata);
    }
    public function menu(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $getmenu=Type::join('users','users.id','=','type.admin_id')
        ->select("type.*","users.user_name")->get();
        return view('admin/menu')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withGetmenu($getmenu)->withSel(false);
    }
    public function getmenu($id){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $getmenu=Type::join('users','users.id','=','type.admin_id')
        ->select("type.*","users.user_name")->get();
        $men=Type::where('id',$id)->first();
        return view('admin/menu')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withGetmenu($getmenu)->withSel(true)->withMen($men);
    }
    public function orders(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        BuyReq::where('seen','no')->where('state',1)->update(['seen'=>'yes']);
        $getorders=BuyReq::join('users','users.id','=','buy_requests.user_id')
        ->where('buy_requests.state',1)
        ->orderBy('buy_requests.id','desc')
        ->select('buy_requests.*','users.user_name','users.user_name2')->get();
        $getstatus=Billstat::all();
        return view('admin/orders')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withGetorders($getorders)->withGetstatus($getstatus);
    }
    public function order($id){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $getorder=BuyReq::join('users','users.id','=','buy_requests.user_id')
        ->join('shipping companies','shipping companies.id','=','buy_requests.company')
        ->where('buy_requests.id',$id)
        ->select('buy_requests.*','users.user_name','users.user_name2','users.phone','users.email','shipping companies.name')
        ->first();
        if(empty($getorder)){
            return redirect('/admin/orders');
        }
        $getproducts=Billdet::join('products','products.id','=','bill_details.product_id')
        ->where('bill_details.buy_id',$id)->get();
        $getshippinginfo=Shipinfo::join('countries','countries.id','=','shipping_info.Country')
        ->where('shipping_info.id',$getorder->shipping_id)
        ->select('shipping_info.*','countries.country')->first();
        return view('admin/order')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withGetorder($getorder)->withGetproducts($getproducts)
        ->withGetshippinginfo($getshippinginfo);
    }
    public function newbrand(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        return view('admin/newbrand')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop);
    }
    public function editbrand(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $getmenu=Brands::join('users','users.id','=','brands.admin_id')
        ->paginate(10, array('brands.*', 'users.user_name'));
        return view('admin/editbrand')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withGetmenu($getmenu)->withSel(false);
    }
    public function teditbrand($id){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $getmenu=Brands::join('users','users.id','=','brands.admin_id')
        ->paginate(10, array('brands.*', 'users.user_name'));
        $brand=Brands::where('id',$id)->first();
        return view('admin/editbrand')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withGetmenu($getmenu)->withSel(true)->withBrand($brand);
    }
    public function cat(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $getmenu=Type::all();
        return view('admin/newcat')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withGetmenu($getmenu);
    }
    public function editcat(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $getmenu=Type::all();
        $cats=Category::join('users','users.id','=','category.admin_id')
        ->paginate(10, array('category.*', 'users.user_name'));
        return view('admin/editcat')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withGetmenu($getmenu)->withSel(false)->withCats($cats);
    }
    public function teditcat($id){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $getmenu=Type::all();
        $cats=Category::join('users','users.id','=','category.admin_id')
        ->paginate(10, array('category.*', 'users.user_name'));
        $cat=Category::where('id',$id)->first();
        return view('admin/editcat')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withGetmenu($getmenu)->withSel(true)->withCats($cats)->withCat($cat);
    }
    public function subcat(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $type=Type::all();
        $cat=Category::all();
        return view('admin/newsubcat')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withType($type)->withCat($cat);
    }
    public function editsubcat(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $type=Type::all();
        $cat=Category::all();
        $subs=Subcat::join('users','users.id','=','sub_category.admin_id')
        ->paginate(10, array('sub_category.*', 'users.user_name'));
        return view('admin/editsubcat')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withType($type)->withCat($cat)->withSel(false)->withSubs($subs);
    }
    public function teditsubcat($id){
        if(Auth::user()->role!='admin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $type=Type::all();
        $cat=Category::all();
        $subs=Subcat::join('users','users.id','=','sub_category.admin_id')
        ->paginate(10, array('sub_category.*', 'users.user_name'));
        $sub=Subcat::join('category','category.id','=','sub_category.cat_id')
        ->where('sub_category.id',$id)
        ->select('sub_category.*','category.type_id')->first();
        return view('admin/editsubcat')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withType($type)->withCat($cat)->withSel(true)->withSubs($subs)->withSub($sub);
    }
    public function contact(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $con=Contact::all();
        return view('admin/contact')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withCon($con)->withStat($stat);
    }
    public function billstatus(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $prstat=Billstat::first();
        $allstat=Billstat::where('id','>',1)->get();
        return view('admin/billstatus')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withPrstat($prstat)->withAllstat($allstat);
    }
    public function product(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $type=Type::all();
        $cat=Category::all();
        $sub=Subcat::all();
        $bran=Brands::all();
        return view('admin/newproduct')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withType($type)->withCat($cat)->withSub($sub)->withBran($bran);
    }
    public function editproduct(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $type=Type::all();
        $cat=Category::all();
        $sub=Subcat::all();
        $bran=Brands::all();
        $prods=Products::join('users','users.id','=','products.admin_id')
        ->paginate(10, array('products.*', 'users.user_name'));
        return view('admin/editproduct')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withType($type)->withCat($cat)->withSub($sub)->withBran($bran)->withSel(false)->withProds($prods);
    }
    public function seditproduct($s){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $type=Type::all();
        $cat=Category::all();
        $sub=Subcat::all();
        $bran=Brands::all();
        if($s=='hidden'){
            $prods=Products::join('users','users.id','=','products.admin_id')
            ->where('products.status','=','hide')
            ->paginate(10, array('products.*', 'users.user_name'));
        }elseif($s=='hotdeal'){
            $prods=Products::join('users','users.id','=','products.admin_id')
            ->where('products.hotdeal','=',1)
            ->paginate(10, array('products.*', 'users.user_name'));
        }else{
            $prods=Products::join('users','users.id','=','products.admin_id')
            ->where('products.product_name','like', '%' . $s . '%')
            ->paginate(10, array('products.*', 'users.user_name'));
        }
        return view('admin/editproduct')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withType($type)->withCat($cat)->withSub($sub)->withBran($bran)->withSel(false)->withProds($prods);
    }
    public function teditproduct($id){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $type=Type::all();
        $cat=Category::all();
        $sub=Subcat::all();
        $bran=Brands::all();
        $prods=Products::join('users','users.id','=','products.admin_id')
        ->paginate(10, array('products.*', 'users.user_name'));
        $prod=Products::join('category','category.id','=','products.cat_id')
        ->join('type','type.id','=','category.type_id')
        ->where('products.id',$id)
        ->select('products.*','type.id as type_id')->first();
        $canhot=count(Products::where('hotdeal',1)->get());
        if($canhot>=3){
            $canhot=true;
        }else{
            $canhot=true;
        }
        return view('admin/editproduct')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withType($type)->withCat($cat)->withSub($sub)->withBran($bran)->withSel(true)->withProds($prods)->withProd($prod)->withCanhot($canhot);
    }
    public function about(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        return view('admin/about')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withStat($stat);
    }
    public function social(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        return view('admin/social')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withStat($stat);
    }
    public function tabs(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        return view('admin/tabs')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withStat($stat);
    }
    public function users(){
        if(Auth::user()->role!='admin'){
            return redirect('/admin');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();

        $users=Users::paginate(10);
        return view('admin/users')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withSel(false)->withUsers($users);
    }
    public function susers($s){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();

        if($s=="user"||$s=="blocked"||$s=="pending"){
            $users=Users::where('role',$s)->paginate(10);
        }elseif($s=="admin"){
            $users=Users::where('role','admin')->orwhere('role','sadmin')->paginate(10);
        }else{
            $users=Users::where('user_name','like','%'.$s.'%')
            ->orwhere('user_name2','like','%'.$s.'%')
            ->orwhere('email',$s)
            ->orwhere('phone',$s)
            ->paginate(10);
        }
        return view('admin/users')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withSel(false)->withUsers($users);
    }
    public function tusers($id){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();

        $users=Users::paginate(10);
        $user=Users::where('id',$id)->first();
        $cont=Countries::all();
        return view('admin/users')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withSel(true)->withUsers($users)->withUser($user)->withCont($cont);
    }
    public function privacy(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();

        $endb=Endbage::first();
        return view('admin/privacy')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withEndb($endb);
    }
    public function zones(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();

        $cont=Countries::all();
        $zones=Zones::all();
        $relz=Zonecont::join('countries','countries.id','=','zones_countries.country')
        ->select('zones_countries.*','countries.country as cont')
        ->get();
        return view('admin/zones')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withCont($cont)->withZones($zones)->withRelz($relz);
    }
    public function comp(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();

        $comps=Shipcomp::all();
        $zones=Zones::all();
        $relz=Zonercont::join('zones','zones.id','=','company_zone.zone')
        ->select('company_zone.*','zones.zone_name')->get();
        return view('admin/comp')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withComps($comps)->withZones($zones)->withRelz($relz);
    }
    public function inbox(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $all=Messages::orderBy('id','desc')->get();
        Messages::where('seen','no')->update(['seen'=>'yes']);
        return view('admin/messages')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withAllmes($all);
    }
    public function sendmes(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $all=Adminmes::join('users','users.id','=','admin_messages.to_user')
        ->orderBy('admin_messages.id','desc')
        ->select('admin_messages.*','users.email')->get();
        Messages::where('seen','no')->update(['seen'=>'yes']);
        return view('admin/sendmes')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withAllmes($all)->withTo('');
    }
    public function resendmes(Request $req){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $all=Adminmes::join('users','users.id','=','admin_messages.to_user')
        ->orderBy('admin_messages.id','desc')
        ->select('admin_messages.*','users.email')->get();
        Messages::where('seen','no')->update(['seen'=>'yes']);
        if($req->input('source')=='inb'){
            if($req->input('sendall')){
                $allm=Messages::all();
                foreach ($allm as $v) {
                    $to[]=$v->email;
                }
                if(!empty($to)){
                    $to=implode(',', $to);
                }else{
                    $to='';
                }
            }else{
                if(!empty($req->input('s'))){
                    $to=implode(',', $req->input('s'));
                }else{
                    $to='';
                }
            }
        }elseif($req->input('source')=='sen'){
            if($req->input('sendall')){
                $allm=Adminmes::join('users','users.id','=','admin_messages.to_user')
                    ->orderBy('admin_messages.id','desc')
                    ->select('admin_messages.*','users.email')->get();
                foreach ($allm as $v) {
                    $to[]=$v->email;
                }
                if(!empty($to)){
                    $to=implode(',', $to);
                }else{
                    $to='';
                }
            }else{
                if(!empty($req->input('s'))){
                    $to=implode(',', $req->input('s'));
                }else{
                    $to='';
                }
            }
        }else{
            if(!empty($req->input('s'))){
                $to=implode(',', $req->input('s'));
            }else{
                $to='';
            }
        }
        return view('admin/sendmes')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withAllmes($all)->withTo($to);
    }
    public function prop(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $props=Proposal::join('users','users.id','=','proposal.user_id')
        ->paginate(10, array('proposal.*','users.user_name'));
        Proposal::where('seen','no')->update(['seen'=>'yes']);
        return view('admin/proposal')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withProps($props);
    }
    public function rprop($id){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $prop=Proposal::leftjoin('category','category.id','=','proposal.cat_id')
        ->leftjoin('brands','brands.id','=','proposal.brand_id')
        ->where('proposal.id',$id)
        ->select('proposal.*','category.category_name','brands.brand_name')->first();
        if(empty($prop)){
            return redirect('/admin/prop');
        }
        return view('admin/seeproposal')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withProp($prop);
    }
    public function newsletter(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $allnews=Newsletter::paginate(20);
        $olds='';
        $oldm='';
        return view('admin/newsletter')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withAllnews($allnews)->withOlds($olds)->withOldm($oldm);
    }
    public function newsletterwi($id){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $allnews=Newsletter::paginate(20);
        $olds=Newsmes::where('id',$id)->first();
        $oldm=$olds->text;
        $olds=$olds->subject;
        return view('admin/newsletter')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withAllnews($allnews)->withOlds($olds)->withOldm($oldm);
    }
    public function oldnews(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $oldnews=Newsmes::orderBy('id','desc')->paginate(10);
        return view('admin/oldnews')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withOldnews($oldnews);
    }
    public function word(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $panner=Panner::where('id',1)->first();
        return view('admin/word')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withPanner($panner);
    }
    public function butbanner(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $panner=Panner::where('id',2)->first();
        return view('admin/butbanner')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withPanner($panner);
    }
    public function banners(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $panner=Panner::where('id','>',2)->get();
        return view('admin/banners')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withPanner($panner);
    }
    public function bagesbanner(){
        if(Auth::user()->role!='admin'&&Auth::user()->role!='sadmin'){
            return redirect('/');
        }
        $norders=count(BuyReq::where('seen','no')->where('state',1)->get());
        $getnewmes=Messages::where('seen','no')->get();
        $getnewcom=Comments::join('products','comments.product_id','=','products.id')
        ->where('comments.seen','no')
        ->select('comments.*','products.product_name')->get();
        $getnewprop=Proposal::join('users','proposal.user_id','=','users.id')
        ->where('proposal.seen','no')
        ->select('proposal.*','users.user_name')->get();
        $stat=Sitestat::where('id',1)->first();

        $banimg=Banimg::all();
        return view('admin/bagesbanner')->withNorders($norders)->withGetnewmes($getnewmes)->withGetnewcom($getnewcom)
        ->withGetnewprop($getnewprop)->withBanimg($banimg);
    }
}
