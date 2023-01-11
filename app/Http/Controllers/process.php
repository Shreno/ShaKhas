<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use Session;
use Mail;
use App\Mail\Reminder;
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
use App\Newsletter;
use App\Userwish;
use App\Adminmes;
use App\Shipcomp;
use App\Newsmes;
use App\Panner;
use App\Banimg;

class process extends Controller
{
    public function reg(Request $req)
    {
    	$valarr=[
    		'first_name'=>'required|min:3|max:30',
    		'last_name'=>'required|min:3|max:50',
    		'email'=>'required|unique:users,email',
    		'phone'=>'required|min:10|max:20',
    		'password'=>'required|min:8|max:50|confirmed',
    		'country'=>'exists:countries,id'
    	];
    	$this->validate($req,$valarr);
    	$fname=$req->input('first_name');
    	$lname=$req->input('last_name');
    	$email=$req->input('email');
    	$phone=$req->input('phone');
    	$cont=$req->input('country');
    	$pass=Hash::make($req->input('password'));
        Users::insert(['user_name'=>$fname,'user_name2'=>$lname,'email'=>$email,'phone'=>$phone,'country'=>$cont,'password'=>$pass
        	,'role'=>'user']);
        return back();
    }
    public function addcart(Request $req){
        $id=$req->input('id');
        $chk=Usercart::where('user_id',Auth::user()->id)->where('product_id',$id)->get();
        if(count($chk)==0){
            Usercart::insert(['user_id'=>Auth::user()->id,'product_id'=>$id]);
            Products::where('id',$id)->update(['status'=>'sold']);
        }else{
            Usercart::where('user_id',Auth::user()->id)->where('product_id',$id)->delete();
            Products::where('id',$id)->update(['status'=>'show']);
        }
        return back();
    }
    public function filter(Request $req){
        if(!empty($brns=$req->input('brand'))){
            $brn=implode(',', $brns);
            Session::put('filterbrn',$brn);
        }
        if(!empty($col=$req->input('color'))){
            $col=implode(',', $col);
            Session::put('filtercol',$col);
        }
        if(!empty($siz=$req->input('size'))){
            $siz=implode(',', $siz);
            Session::put('filtersiz',$siz);
        }
        if(!empty($con=$req->input('condi'))){
            $con=implode(',', $con);
            Session::put('filtercon',$con);
        }
        return back();
    }
    public function cfilter(){
            Session::put('filterbrn','');
            Session::put('filtercol','');
            Session::put('filtersiz','');
            Session::put('filtercon','');
        return back();
    }
    public function sendmes(Request $req){
        $valarr=[
            'name'=>'required|min:3|max:30',
            'email'=>'required|min:3|max:50|email',
            'sub'=>'required|max:30',
            'message'=>'required|min:1|max:1000'
        ];
        $this->validate($req,$valarr);
        $name=$req->input('name');
        $email=$req->input('email');
        $sub=$req->input('sub');
        $mes=$req->input('message');
        Messages::insert(['user_name'=>$name,'email'=>$email,'subject'=>$sub,'message'=>$mes,'seen'=>'no']);
        return back();
    }
    public function addnews(Request $req){
        $valarr=[
            'email'=>'required|min:3|max:50|email|unique:news_members,email'
        ];
        $this->validate($req,$valarr);
        $email=$req->input('email');
        Newsletter::insert(['email'=>$email]);
        return back();
    }
    public function wishtog($id){
        $olddata=Userwish::where('product_id',$id)->where('user_id',Auth::user()->id)->first();
        if(!empty($olddata)){
            Userwish::where('product_id',$id)->where('user_id',Auth::user()->id)->delete();
        }else{
            Userwish::insert(['product_id'=>$id,'user_id'=>Auth::user()->id]);
        }
        return back();
    }
    public function edituser(Request $req){
        $valarr=[
            'username'=>'required|min:3|max:50',
            'username2'=>'required|min:3|max:50',
            'phone'=>'required|min:8|max:20'
        ];
        $this->validate($req,$valarr);
        $username=$req->input('username');
        $username2=$req->input('username2');
        $phone=$req->input('phone');
        $address=$req->input('address');
        Users::where('id',Auth::user()->id)->update(['user_name'=>$username,'user_name2'=>$username2,'phone'=>$phone,'address'=>$address]);
        return back();
    }
    public function edituserpass(Request $req){
        $valarr=[
            'pass'=>'required|min:8|max:50|confirmed'
        ];
        $this->validate($req,$valarr);
        if(!Hash::check($req->input('opass'),Auth::user()->password)){
            $error = \Illuminate\Validation\ValidationException::withMessages([
               'Old Password' => ['Old Password is Wrong']
            ]);
            throw $error;
        }
        $pass=Hash::make($req->input('pass'));
        Users::where('id',Auth::user()->id)->update(['password'=>$pass]);
        return back();
    }
    public function sendproposal(Request $req){
        $valarr=[
            'name'=>'required|min:4|max:50',
            'cat'=>'exists:category,id',
            'phone'=>'required|min:8|max:30'
        ];
        $this->validate($req,$valarr);
        if(!$req->input('chk')){
            $error = \Illuminate\Validation\ValidationException::withMessages([
               'Terms' => ['You Must Allow Terms and Conditions']
            ]);
            throw $error;
        }
        $name=$req->input('name');
        $cat=$req->input('cat');
        $brand=$req->input('brand');
        $cond=$req->input('cond');
        $phone=$req->input('phone');
        if(Auth::user()){
            $id=Auth::user()->id;
        }else{
            $id=1;
        }
        Proposal::insert(['user_id'=>$id,'name'=>$name,'price'=>0,'link'=>'','seen'=>'no','cat_id'=>$cat,'brand_id'=>$brand,'phone'=>$phone,'approve'=>0]);
        $names=array();
        $i=0;
        $get=Proposal::orderBy('id','desc')->first();
        $get=$get->id;
        if($images=$req->file('imgs')){
            $logoPath = public_path('/img/proposal');
            foreach($images as $file){
                $names[]=$get.'p'.$i.'.'.$file->getClientOriginalExtension();
                $file->move($logoPath,$names[$i]);
                $i++;
            }
        }
        $names=implode(',', $names);
        Proposal::where('id',$get)->update(['imgs'=>$names]);
        return back();
    }
    public function newcont(Request $req){
        $country=$req->input('country');
        Users::where('id',Auth::user()->id)->update(['country'=>$country]);
        return back();
    }
    public function removefcart($id){
        Products::where('id',$id)->update(['status'=>'show']);
        Usercart::where('product_id',$id)->where('user_id',Auth::user()->id)->delete();
        return back();
    }
    public function tobill(Request $req){
        $valarr=[
            'name'=>'required|min:4|max:50',
            'address'=>'required|min:10',
            'comp'=>'exists:shipping companies,id',
            'city'=>'required',
            'zip'=>'required'
        ];
        $this->validate($req,$valarr);
        $name=$req->input('name');
        $address=$req->input('address');
        $comp=$req->input('comp');
        $city=$req->input('city');
        $zip=$req->input('zip');
        Shipinfo::insert(['user_id'=>Auth::user()->id,'full_name'=>$name,'Address'=>$address,'city'=>$city,'zip'=>$zip,'country'=>Auth::user()->country]);
        $shipinf=Shipinfo::orderBy('id','desc')->first();
        $shipinf=$shipinf->id;
        $prod=Usercart::where('user_id',Auth::user()->id)->get();
        Usercart::where('user_id',Auth::user()->id)->delete();
        BuyReq::insert(['user_id'=>Auth::user()->id,'shipping_id'=>$shipinf,'seen'=>'no','state'=>0,'order_status'=>1,'company'=>$comp]);
        $breq=BuyReq::orderBy('id','desc')->first();
        $breq=$breq->id;
        $totalprice=0;
        foreach ($prod as $v) {
            Products::where('id',$v->product_id)->update(['status'=>'sold']);
            $getpro=Products::where('id',$v->product_id)->first();
            Billdet::insert(['buy_id'=>$breq,'product_id'=>$getpro->id,'price'=>$getpro->price]);
            $totalprice+=$getpro->price;
        }
        $comp=Shipcomp::join('company_zone','company_zone.company','=','shipping companies.id')
         ->join('zones_countries','zones_countries.zone','=','company_zone.zone')
         ->where('shipping companies.id',$comp)
         ->select('shipping companies.name','shipping companies.id','zones_countries.country','company_zone.price')->first();
         $tota=$totalprice+$comp->price;
        BuyReq::where('id',$breq)->update(['price'=>$tota]);
        return redirect('/payment/'.$breq);
    }
    public function cashpay($id){
        $chk=BuyReq::where('id',$id)->where('user_id',Auth::user()->id)->first();
        if(empty($chk)){
            return back();
        }
        BuyReq::where('id',$id)->update(['state'=>1,'payment_method'=>'cash']);
        return redirect('/user');
    }
    public function repass(Request $req){
        $valarr=[
            'email'=>'required|exists:users,email'
        ];
        $this->validate($req,$valarr);
        $email=$req->input('email');
        session()->put('gemail',$email);
        Mail::to($email)->send(new Reminder);
        return back();
    }
    public function respass(Request $req){
        $valarr=[
            'pass'=>'required|min:8|max:50'
        ];
        $this->validate($req,$valarr);
        if(session()->get('code')!=$req->input('code')){
            $error = \Illuminate\Validation\ValidationException::withMessages([
              'code' => ['Error In code']
           ]);
           throw $error;
        }
        users::where('email',session()->get('gemail'))->update(['password'=>Hash::make($req->input('pass'))]);
        return redirect('/log');
    }
    public function codeback(){
        session()->forget('gemail');
        session()->forget('code');
        return back();
    }
    public function check(){
        $chk=Shipinfo::where('user_id',Auth::user()->id)->orderBy('id','desc')->first();
        if(empty($chk)){
            return redirect('/cart');
        }
        $shipinf=$chk->id;
        print_r( $prod=Usercart::where('user_id',Auth::user()->id)->get());
        if(count($prod)==0){
            return redirect('/cart');
        }
        Usercart::where('user_id',Auth::user()->id)->delete();
        $breq=BuyReq::where('user_id',Auth::user()->id)->orderBy('id','desc')->first();
        $comp=$breq->company;
        BuyReq::insert(['user_id'=>Auth::user()->id,'shipping_id'=>$shipinf,'seen'=>'no','state'=>0,'order_status'=>1,'company'=>$comp]);
        $breq=BuyReq::orderBy('id','desc')->first();
        $breq=$breq->id;
        $totalprice=0;
        foreach ($prod as $v) {
            Products::where('id',$v->product_id)->update(['status'=>'sold']);
            $getpro=Products::where('id',$v->product_id)->first();
            Billdet::insert(['buy_id'=>$breq,'product_id'=>$getpro->id,'price'=>$getpro->price]);
            $totalprice+=$getpro->price;
        }
        $comp=Shipcomp::join('company_zone','company_zone.company','=','shipping companies.id')
         ->join('zones_countries','zones_countries.zone','=','company_zone.zone')
         ->where('shipping companies.id',$comp)
         ->select('shipping companies.name','shipping companies.id','zones_countries.country','company_zone.price')->first();
         $tota=$totalprice+$comp->price;
        BuyReq::where('id',$breq)->update(['price'=>$tota]);
        return redirect('/payment/'.$breq);
    }
}
