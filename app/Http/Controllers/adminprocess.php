<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
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
use App\Brands;
use App\Category;
use App\Subcat;
use App\Contact;
use App\Billstat;
use App\Billdet;
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

class adminprocess extends Controller
{
    public function menu(Request $req){
     $olddata=Type::where('id',$req->input('typeid'))->first();
     if($olddata->type_name!=$req->input('typename')){
      $valarr=[
       'typename'=>'required|min:3|max:30|unique:type,type_name'
      ];
      $this->validate($req,$valarr);
     }
     $valarr=[
      'image'=>'max:2048'
     ];
     $this->validate($req,$valarr);
     $name=$req->input('typename');
     $img=$req->file('image');
     if(!empty($req->file('image'))){
        $logoPath = public_path('/img/menubanners');
        $logoName=$olddata->id;
        $logoName.='.'.$img->getClientOriginalExtension();
        $img->move($logoPath,$logoName);
     }else{
        $logoName=$olddata->banner;
     }
     $admin=Auth::user()->id;
     Type::where('id',$olddata->id)->update(['type_name'=>$name,'admin_id'=>$admin,'banner'=>$logoName]);
     return redirect('/admin/menu/'.$olddata->id);
    }
    public function addbrand(Request $req){
     $valarr=[
      'brandname'=>'required|min:3|max:30|unique:type,type_name',
      'brandlogo'=>'required|max:4096'
     ];
  $this->validate($req,$valarr);
  $name=$req->input('brandname');
     $img=$req->file('brandlogo');
     $admin=Auth::user()->id;
     Brands::insert(['brand_name'=>$name,'admin_id'=>$admin]);
     $get=Brands::orderBy('id','desc')->first();
     $get=$get->id;
     $logoPath = public_path('/img/brands');
       $logoName=$get;
       $logoName.='.'.$img->getClientOriginalExtension();
       $img->move($logoPath,$logoName);
       Brands::where('id',$get)->update(['img'=>$logoName]);
       return redirect('/admin/newbrand');
    }
    public function editbrand(Request $req){
     $olddata=Brands::where('id',$req->input('id'))->first();
     if($olddata->brand_name!=$req->input('brandname')){
      $valarr=[
       'brandname'=>'required|min:3|max:30|unique:brands,brand_name'
      ];
      $this->validate($req,$valarr);
     }
     $valarr=[
      'image'=>'max:2048'
     ];
     $this->validate($req,$valarr);
     $name=$req->input('brandname');
     $img=$req->file('image');
     if(!empty($req->file('image'))){
        $logoPath = public_path('/img/brands');
        $logoName=$olddata->id;
        $logoName.='.'.$img->getClientOriginalExtension();
        $img->move($logoPath,$logoName);
     }else{
        $logoName=$olddata->img;
     }
     $admin=Auth::user()->id;
     Brands::where('id',$olddata->id)->update(['brand_name'=>$name,'admin_id'=>$admin,'img'=>$logoName]);
     return redirect('/admin/editbrand/'.$olddata->id);
    }
    public function removebrand($id){
     Products::where('barnd_id',$id)->update(['barnd_id'=>0]);
     $brand=Brands::where('id',$id)->first();
      @unlink('img/brands/'.$brand->img);
      Brands::where('id',$id)->delete();
     return redirect('/admin/editbrand');
    }
    public function branlogo(Request $req){
        $img=$req->file('mlogo');
        $logoPath = public_path('/images');
        $logoName='br';
        $logoName.='.'.$img->getClientOriginalExtension();
        $img->move($logoPath,$logoName);
        Sitestat::where('id',1)->update(['brand_img'=>$logoName]);
        return back();
    }
    public function addcat(Request $req){
     $valarr=[
      'name'=>'required|min:3|max:30|unique:category,category_name',
      'image'=>'required|max:4096',
      'type'=>'exists:type,id'
     ];
  $this->validate($req,$valarr);
  $name=$req->input('name');
     $img=$req->file('image');
     $type=$req->input('type');
     $admin=Auth::user()->id;
     Category::insert(['category_name'=>$name,'admin_id'=>$admin,'type_id'=>$type]);
     $get=Category::orderBy('id','desc')->first();
     $get=$get->id;
     $logoPath = public_path('/img/category');
       $logoName=$get;
       $logoName.='.'.$img->getClientOriginalExtension();
       $img->move($logoPath,$logoName);
       Category::where('id',$get)->update(['img'=>$logoName]);
       return redirect('/admin/newcat');
    }
    public function editcat(Request $req){
     $olddata=Category::where('id',$req->input('id'))->first();
     if($olddata->category_name!=$req->input('name')){
      $valarr=[
       'name'=>'required|min:3|max:30|unique:brands,brand_name'
      ];
      $this->validate($req,$valarr);
     }
     $valarr=[
      'type'=>'exists:type,id',
      'image'=>'max:2048'
     ];
     $this->validate($req,$valarr);
     $name=$req->input('name');
     $img=$req->file('image');
     $type=$req->input('type');
     if(!empty($req->file('image'))){
        $logoPath = public_path('/img/category');
        $logoName=$olddata->id;
        $logoName.='.'.$img->getClientOriginalExtension();
        $img->move($logoPath,$logoName);
     }else{
        $logoName=$olddata->img;
     }
     $admin=Auth::user()->id;
     Category::where('id',$olddata->id)->update(['category_name'=>$name,'admin_id'=>$admin,'img'=>$logoName,'type_id'=>$type]);
     return redirect('/admin/editcat/'.$olddata->id);
    }
    public function removecat($id){
     $pro=Products::where('cat_id',$id)->get();
     
     foreach ($pro as $v) {
      @unlink('img/products/'. $v->img);
      $imgs=explode(",", $v->imgs);
      foreach($imgs as $im){
       @unlink('img/products/imgs/'.$im);
      }
     }
     Products::where('cat_id',$id)->delete();
     $cat=Category::where('id',$id)->first();
      @unlink('img/category/'.$cat->img);
      Subcat::where('cat_id',$id)->delete();
      Category::where('id',$id)->delete();
     return redirect('/admin/editcat');
    }
    public function addsubcat(Request $req){
     $valarr=[
      'name'=>'required|min:3|max:30|unique:category,category_name',
      'type'=>'exists:type,id',
      'cat'=>'exists:category,id'
     ];
  $this->validate($req,$valarr);
  $name=$req->input('name');
     $cat=$req->input('cat');
     $admin=Auth::user()->id;
     $chkcat=Subcat::where('sub_name',$name)->where('cat_id',$cat)->get();
     if(count($chkcat)>0){
      $error = \Illuminate\Validation\ValidationException::withMessages([
      'name' => ['The Sub-category name repeated for same category']
   ]);
   throw $error;
     }
     Subcat::insert(['sub_name'=>$name,'admin_id'=>$admin,'cat_id'=>$cat]);
       return redirect('/admin/newsubcat');
    }
    public function editsub(Request $req){
     $olddata=Subcat::where('id',$req->input('id'))->first();
     if($olddata->sub_name!=$req->input('name')){
      $valarr=[
       'name'=>'required|min:3|max:30'
      ];
      $this->validate($req,$valarr);
      $chkcat=Subcat::where('sub_name',$req->input('name'))->where('cat_id',$req->input('cat'))->get();
      if(count($chkcat)>0){
       $error = \Illuminate\Validation\ValidationException::withMessages([
       'name' => ['The Sub-category name repeated for same category']
    ]);
    throw $error;
      }
     }
     $valarr=[
      'type'=>'exists:type,id',
      'cat'=>'exists:category,id'
     ];
     $this->validate($req,$valarr);
     $name=$req->input('name');
     $cat=$req->input('cat');
     $admin=Auth::user()->id;
     Subcat::where('id',$olddata->id)->update(['sub_name'=>$name,'admin_id'=>$admin,'cat_id'=>$cat]);
     return redirect('/admin/editsubcat/'.$olddata->id);
    }
    public function removesub($id){
     $pro=Products::where('sub_id',$id)->get();
     foreach ($pro as $v) {
      @unlink('img/products/'.$v->img);
      $imgs=explode(",", $v->imgs);
      foreach($imgs as $im){
       @unlink('img/products/imgs/'.$im);
      }
     }
     Products::where('sub_id',$id)->delete();
      Subcat::where('id',$id)->delete();
     return redirect('/admin/editsubcat');
    }
    public function contact(Request $req){
     $conhead=$req->input('conhead');
     $conheadshow=$req->input('conheadshow');
     $conbody=$req->input('conbody');
     $conbodyshow=$req->input('conbodyshow');
     $addr=$req->input('addr');
     $addrshow=$req->input('addrshow');
     $phn=$req->input('phn');
     $phnshow=$req->input('phnshow');
     $mal=$req->input('mal');
     $malshow=$req->input('malshow');
     $hrs=$req->input('hrs');
     $hrsshow=$req->input('hrsshow');
        $map=$req->input('map');
     $cns=$cbs=$as=$phs=$ms=$hrss=0; //Show Data or not
     if($conheadshow){
      $cns=1;
     }if($conbodyshow){
      $cbs=1;
     }if($addrshow){
      $as=1;
     }if($phnshow){
      $phs=1;
     }if($malshow){
      $ms=1;
     }if($hrsshow){
      $hrss=1;
     }
     Contact::where('id',1)->update(['data_body'=>$conhead,'state'=>$cns]);
     Contact::where('id',2)->update(['data_body'=>$conbody,'state'=>$cbs]);
     Contact::where('id',3)->update(['data_body'=>$addr,'state'=>$as]);
     Contact::where('id',4)->update(['data_body'=>$phn,'state'=>$phs]);
     Contact::where('id',5)->update(['data_body'=>$mal,'state'=>$ms]);
     Contact::where('id',6)->update(['data_body'=>$hrs,'state'=>$hrss]);
        Sitestat::where('id',1)->update(['map'=>$map]);
     return redirect('/admin/contact');
    }
    public function billstatuspr(Request $req){
     $name=$req->input('pstatus');
     Billstat::where('id',1)->update(['state'=>$name]);
     return back();
    }
    public function addbillstat(Request $req){
     $valarr=[
      'status'=>'required|unique:bills_status,state'
     ];
     $this->validate($req,$valarr);
     $name=$req->input('status');
     $message=$req->input('statusmessage');
     $action=$req->input('action');
     Billstat::insert(['state'=>$name,'message'=>$message,'action'=>$action]);
     return back();
    }
    public function editbillstat(Request $req){
     $valarr=[
      'status'=>'required'
     ];
     $this->validate($req,$valarr);
     $name=$req->input('status');
     $message=$req->input('statusmessage');
     $action=$req->input('action');
     $id=$req->input('id');
     Billstat::where('id',$id)->update(['state'=>$name,'message'=>$message,'action'=>$action]);
     return back();
    }
    public function removestatus($id){
     Billstat::where('id',$id)->delete();
     return back();
    }
    public function addpro(Request $req){
     $valarr=[
      'type'=>'exists:type,id',
      'cat'=>'exists:category,id',
      'sub'=>'exists:sub_category,id',
      'brand'=>'required',
      'proname'=>'required|min:3|max:30|unique:products,product_name',
      'prodesc'=>'required|min:3|max:40',
      'proover'=>'required|min:3',
      'proover2'=>'required|min:3',
      'proret'=>'required|min:1|numeric',
      'propri'=>'required|min:1|numeric',
      'prosize'=>'required',
      'procol'=>'required',
      'procon'=>'required|min:3|max:30',
      'proinc'=>'required|min:3|max:30',
      'priimg'=>'required|max:4096'
     ];
  $this->validate($req,$valarr);
  $cat=$req->input('cat');
  $sub=$req->input('sub');
  $brand=$req->input('brand');
  $name=$req->input('proname');
  $desc=$req->input('prodesc');
  $over=$req->input('proover');
  $over2=$req->input('proover2');
  $ret=$req->input('proret');
  $pri=$req->input('propri');
  $size=$req->input('prosize');
  $col=$req->input('procol');
  $lnk=$req->input('provid');
  $con=$req->input('procon');
  $inc=$req->input('proinc');
     $img=$req->file('priimg');
     $admin=Auth::user()->id;
     Products::insert(['product_name'=>$name,'admin_id'=>$admin,'cat_id'=>$cat,'sub_id'=>$sub,'brand_id'=>$brand,'description'=>$desc,'overview'=>$over,'overview2'=>$over2,'ret_price'=>$ret,'price'=>$pri,'size'=>$size,'color'=>$col,'video_link'=>$lnk,'conditions'=>$con,'inclusions'=>$inc,'hotdeal'=>0,'status'=>'show','visits'=>0]);
     $names=array();
     $i=0;
     $get=Products::orderBy('id','desc')->first();
     $get=$get->id;
     if($images=$req->file('imgs')){
      $logoPath = public_path('/img/products/imgs');
         foreach($images as $file){
             $names[]=$get.'p'.$i.'.'.$file->getClientOriginalExtension();
             $file->move($logoPath,$names[$i]);
             $i++;
         }
     }
     $logoPath = public_path('/img/products');
       $logoName=$get;
       $logoName.='.'.$img->getClientOriginalExtension();
       $img->move($logoPath,$logoName);
       Products::where('id',$get)->update(['img'=>$logoName,'imgs'=>implode(",",$names)]);
       return redirect('/admin/newproduct');
    }
    public function editpro(Request $req){
     $olddata=Products::where('id',$req->input('id'))->first();
     $valarr=[
      'type'=>'exists:type,id',
      'cat'=>'exists:category,id',
      'sub'=>'exists:sub_category,id',
      'brand'=>'required',
      'prodesc'=>'required|min:3|max:40',
      'proover'=>'required|min:3',
      'proover2'=>'required|min:3',
      'proret'=>'required|min:1|numeric',
      'propri'=>'required|min:1|numeric',
      'prosize'=>'required',
      'procol'=>'required',
      'procon'=>'required|min:3|max:30',
      'proinc'=>'required|min:3|max:30',
      'priimg'=>'max:4096'
     ];
  $this->validate($req,$valarr);
  if($req->input('proname')!=$olddata->product_name){
   $valarr=[
    'proname'=>'required|min:3|max:30|unique:products,product_name'
   ];
   $this->validate($req,$valarr);
  }
  $cat=$req->input('cat');
  $sub=$req->input('sub');
  $brand=$req->input('brand');
  $name=$req->input('proname');
  $desc=$req->input('prodesc');
  $over=$req->input('proover');
  $over2=$req->input('proover2');
  $ret=$req->input('proret');
  $pri=$req->input('propri');
  $size=$req->input('prosize');
  $col=$req->input('procol');
  $lnk=$req->input('provid');
  $con=$req->input('procon');
  $inc=$req->input('proinc');
     $img=$req->file('priimg');
     $admin=Auth::user()->id;
     if(!empty($req->file('priimg'))){
        $logoPath = public_path('/img/products');
        $logoName=$olddata->id;
        $logoName.='.'.$img->getClientOriginalExtension();
        $img->move($logoPath,$logoName);
     }else{
        $logoName=$olddata->img;
     }
     $names=array();
     $i=0;
     if($images=$req->file('imgs')){
      foreach(explode(",",$olddata->imgs) as $v){
       @unlink('img/products/imgs'.$v);
      }
      $logoPath = public_path('/img/products/imgs');
         foreach($images as $file){
             $names[]=$olddata->id.'p'.$i.'.'.$file->getClientOriginalExtension();
             $file->move($logoPath,$names[$i]);
             $i++;
         }
     }else{
      $names=explode(',', $olddata->imgs);
     }
       Products::where('id',$olddata->id)->update(['product_name'=>$name,'admin_id'=>$admin,'cat_id'=>$cat,'sub_id'=>$sub,'brand_id'=>$brand,'description'=>$desc,'overview'=>$over,'overview2'=>$over2,'ret_price'=>$ret,'price'=>$pri,'size'=>$size,'color'=>$col,'video_link'=>$lnk,'conditions'=>$con,'inclusions'=>$inc,'img'=>$logoName,'imgs'=>implode(",",$names)]);
       return redirect('/admin/editproduct/'.$olddata->id);
    }
    public function hidepro($id){
     $olddata=Products::where('id',$id)->first();
     if($olddata->status=='show'){
      Products::where('id',$id)->update(['status'=>'hide']);
     }else{
      Products::where('id',$id)->update(['status'=>'show']);
     }
     return back();
    }
    public function hotpro($id){
     $olddata=Products::where('id',$id)->first();
     if($olddata->hotdeal==1){
      Products::where('id',$id)->update(['hotdeal'=>0]);
     }else{
      Products::where('id',$id)->update(['hotdeal'=>1]);
     }
     return back();
    }
    public function removepro($id){
     $pro=Products::where('id',$id)->first();
     foreach (explode(',', $pro->imgs) as $v) {
      @unlink('img/products/imgs/'.$v);
     }
     @unlink('img/products/'.$pro->img);
      Products::where('id',$id)->delete();
     return redirect('/admin/editproduct');
    }
    public function about(Request $req){
     $valarr=[
      'about'=>'required|min:5'
     ];
     $this->validate($req,$valarr);
     $about=$req->input('about');
     Sitestat::where('id',1)->update(['about'=>$about]);
     return back();
    }
    public function pgtm(Request $req){
     $valarr=[
      'pagtime'=>'required|numeric'
     ];
     $this->validate($req,$valarr);
     $pgtm=$req->input('pagtime');
     Sitestat::where('id',1)->update(['bagtime'=>$pgtm]);
     return back();
    }
    public function social(Request $req){
     $valarr=[
      'face'=>'url',
      'twit'=>'url',
      'inst'=>'url',
            'snap'=>'url'
     ];
     $this->validate($req,$valarr);
     $face=$req->input('face');
     $twit=$req->input('twit');
     $inst=$req->input('inst');
        $snap=$req->input('snap');
     Sitestat::where('id',1)->update(['face'=>$face,'twit'=>$twit,'insta'=>$inst,'snap'=>$snap]);
     return back();
    }
    public function tabs(Request $req){
     $tab1=$req->input('tab1');
     $tab2=$req->input('tab2');
     Sitestat::where('id',1)->update(['tab1'=>$tab1,'tab2'=>$tab2]);
     return back();
    }
    public function user(Request $req){
     $valarr=[
      'name'=>'required|min:3|max:30',
      'name2'=>'required|min:3|max:50',
      'phone'=>'required|min:10|max:20',
      'password'=>'min:8|max:50',
      'country'=>'exists:countries,id'
     ];
     $this->validate($req,$valarr);
     $name=$req->input('name');
     $name2=$req->input('name2');
     $phone=$req->input('phone');
     $country=$req->input('country');
     $address=$req->input('address');
     $id=$req->input('id');
     if(!empty($req->input('password'))){
      $password=Hash::make($req->input('password'));
      Users::where('id',$id)->update(['password'=>$password]);
     }
     Users::where('id',$id)->update(['user_name'=>$name,'user_name2'=>$name2,'phone'=>$phone,'address'=>$address,'country'=>$country]);
     return back();
    }
    public function removeuser($id){
     Users::where('id',$id)->delete();
     return redirect('/admin/users');
    }
    public function useradmin($id){
     $user=Users::where('id',$id)->first();
     if($user->role=='sadmin'){
      Users::where('id',$id)->update(['role'=>'user']);
     }else{
      Users::where('id',$id)->update(['role'=>'sadmin']);
     }
     return back();
    }
    public function userblock($id){
     $user=Users::where('id',$id)->first();
     if($user->role=='user'){
      Users::where('id',$id)->update(['role'=>'blocked']);
     }else{
      Users::where('id',$id)->update(['role'=>'user']);
     }
     return back();
    }
    public function privacy(Request $req){
     $abh=$req->input('abh');
     $abb=$req->input('abb');
     $prh=$req->input('prh');
     $prb=$req->input('prb');
     $th=$req->input('th');
     $tb=$req->input('tb');
        $reth=$req->input('reth');
        $retb=$req->input('retb');
        $shh=$req->input('shh');
        $shb=$req->input('shb');
        $fah=$req->input('fah');
        $fab=$req->input('fab');
     Endbage::where('id',1)->update(['about_head'=>$abh,'about'=>$abb,'privacy_head'=>$prh,'privacy'=>$prb,'terms_head'=>$th,'terms'=>$tb,'returns_head'=>$reth,'returns_body'=>$retb,'shipping_head'=>$shh,'shipping'=>$shb,'faq_head'=>$fah,'faq'=>$fab]);
     return back();
    }
    public function newzone(Request $req){
     $valarr=[
      'zone'=>'required|min:3|max:30|unique:zones,zone_name'
     ];
     $this->validate($req,$valarr);
     $name=$req->input('zone');
     zones::insert(['zone_name'=>$name]);
     return back();
    }
    public function contzone(Request $req){
     $valarr=[
      'zone'=>'exists:zones,id',
      'cont'=>'exists:countries,id|unique:zones_countries,country'
     ];
     $this->validate($req,$valarr);
     $zone=$req->input('zone');
     $cont=$req->input('cont');
     $chkzc=Zonecont::where('zone',$zone)->where('country',$cont)->get();
     if(count($chkzc)>0){
      $error = \Illuminate\Validation\ValidationException::withMessages([
      'link' => ['This country Linked Before']
   ]);
   throw $error;
     }
     Zonecont::insert(['zone'=>$zone,'country'=>$cont]);
     return back();
    }
    public function remrel($id){
     Zonecont::where('id',$id)->delete();
     return back();
    }
    public function editzone(Request $req){
     $valarr=[
      'zone'=>'required|min:3|max:30|unique:zones,zone_name'
     ];
     $this->validate($req,$valarr);
     $name=$req->input('zone');
     $id=$req->input('id');
     zones::where('id',$id)->update(['zone_name'=>$name]);
     return back();
    }
    public function removezone($id){
     Zonecont::where('zone',$id)->delete();
     Zonercont::where('zone',$id)->delete();
     Zones::where('id',$id)->delete();
     return back();
    }
    public function newcomp(Request $req){
     $valarr=[
      'comp'=>'required|min:3|max:30|unique:shipping companies,name',
      'img'=>'required|max:8192'
     ];
     $this->validate($req,$valarr);
     $name=$req->input('comp');
     $img=$req->file('img');
     Shipcomp::insert(['name'=>$name]);
     $get=Shipcomp::orderBy('id','desc')->first();
     $get=$get->id;
     $logoPath = public_path('/img/shipping');
       $logoName=$get;
       $logoName.='.'.$img->getClientOriginalExtension();
       $img->move($logoPath,$logoName);
       Shipcomp::where('id',$get)->update(['logo'=>$logoName]);
       return back();
    }
    public function compzone(Request $req){
     $valarr=[
      'comp'=>'exists:shipping companies,id',
      'zone'=>'exists:zones,id',
      'price'=>'required|numeric',
      'days'=>'required|numeric'
     ];
     $this->validate($req,$valarr); 
     $zone=$req->input('zone');
     $comp=$req->input('comp');
     $price=$req->input('price');
     $days=$req->input('days');
     $chkzc=Zonercont::where('zone',$zone)->where('company',$comp)->get();  
     if(count($chkzc)>0){
      $error = \Illuminate\Validation\ValidationException::withMessages([
      'link' => ['This zone Linked Before']
   ]);
   throw $error;
     }
     Zonercont::insert(['company'=>$comp,'zone'=>$zone,'price'=>$price,'days'=>$days]);
     return back();
    }
    public function remrelcomp($id){
     Zonercont::where('id',$id)->delete();
     return back();
    }
    public function editcomp(Request $req){
     $olddata=Shipcomp::where('id',$req->input('id'))->first();
     if($olddata->name!=$req->input('comp')){
       $valarr=[
       'comp'=>'required|min:3|max:30|unique:shipping companies,name'
      ];
      $this->validate($req,$valarr);
     }
     $valarr=[
      'img'=>'max:8192'
     ];
     $this->validate($req,$valarr);
     $name=$req->input('comp');
     $img=$req->file('img');
     $logoPath = public_path('/img/shipping');
     if(!empty($img)){
        $logoName=$id;
        $logoName.='.'.$img->getClientOriginalExtension();
        $img->move($logoPath,$logoName);
       }else{
        $logoName=$olddata->logo;
       }
       Shipcomp::where('id',$olddata->id)->update(['name'=>$name,'logo'=>$logoName]);
       return back();
    }
    public function removecomp($id){
     Zonercont::where('company',$id)->delete();
     $idx=Shipcomp::where('id',$id)->first();
     @unlink('img/shipping/'.$idx->logo);
     Shipcomp::where('id',$id)->delete();
     return back();
    }
    public function editcompzone(Request $req){
     $valarr=[
      'price'=>'required|numeric',
      'days'=>'required|numeric'
     ];
     $this->validate($req,$valarr); 
     $price=$req->input('price');
     $days=$req->input('days');
     $id=$req->input('id');
     Zonercont::where('id',$id)->update(['price'=>$price,'days'=>$days]);
     return back();
    }
    public function sendmes(Request $req){
        $valarr=[
            'email'=>'required|min:3',
            'sub'=>'required|max:30',
            'message'=>'required|min:1|max:1000'
        ];
        $this->validate($req,$valarr);
        $email=$req->input('email');
        $sub=$req->input('sub');
        $mes=$req->input('message');
        $email=explode(',', $email);
        $ids=[];
        foreach ($email as $v) {
            $chk=Users::where('email',$v)->first();
            if(!empty($chk)){
                $ids[]=$chk->id;
            }
        }
        foreach ($ids as $v) {
            Adminmes::insert(['to_user'=>$v,'subject'=>$sub,'message'=>$mes,'seen'=>'no']);
        }
        return back();
    }
    public function propapp($id){
        $user=Proposal::where('id',$id)->first();
        if($user->approve==0){
            Proposal::where('id',$id)->update(['approve'=>1]);
            $user=Proposal::where('id',$id)->first();
            Adminmes::insert(['to_user'=>$user->user_id,'subject'=>'Proposal Approved','message'=>'your proposal with title :'.$user->name.' Approved . please contact us for details','seen'=>'no']);
        }
        return back();
    }
    public function corder($order,$state){
        BuyReq::where('id',$order)->update(['order_status'=>$state]);
        $orderd=BuyReq::where('id',$order)->first();
        $status=Billstat::where('id',$state)->first();
        $orderdet=Billdet::join('products','products.id','=','bill_details.product_id')
            ->where('bill_details.buy_id',$order)
            ->select('products.id','products.product_name','products.price')->get();
        session()->push('notef',true);
        //Send Message and do Action Here
        session()->put('sub',"Shaikha's Notifications");
        $message=$status->message;
        session()->push('message',$message);
        //Get User
        $user=Users::where('id',$orderd->user_id)->first();
        //Get Order Details
        session()->push('order',$orderdet);
        //Send
        Mail::to($user->email)->send(new Reminder);
        sleep(1);
        //Do Action
        $action=$status->action;
        if($action==1){
            foreach($orderdet as $o){
                Products::where('id',$o->id)->update(['status'=>$show]);
            }
        }elseif($action==2){
            foreach($orderdet as $o){
                Products::where('id',$o->id)->delete();
            }
        }elseif($action==3){
            foreach($orderdet as $o){
                Products::where('id',$o->id)->update(['status'=>'hist']);
            }
        }
        return back();
    }
    public function sendnews(Request $req){
        $valarr=[
            'sub'=>'required',
            'message'=>'required'
        ];
        $this->validate($req,$valarr);
        $emails=$req->input('reciv');
        $all=$req->input('all');
        $sub=$req->input('sub');
        $message=$req->input('message');
        if($all){
            $get=Newsletter::all();
            $emails=[];
            foreach ($get as $v) {
                $emails[]=$v->email;
            }
        }
        if(count($emails)>0){
            foreach($emails as $em){
                session()->put('sub',$sub);
                session()->push('message',$message);
                Mail::to($em)->send(new Reminder);
                sleep(1);
                Newsmes::insert(['send_to'=>$em,'subject'=>$sub,'text'=>$message]);
            }
        }
        return back();
    }
    public function word(Request $req){
        $word=$req->input('word');
        $link=$req->input('link');
        $show=$req->input('show');
        if($show){
            $sho=1;
        }else{
            $sho=0;
        }
        Panner::where('id',1)->update(['word1'=>$word,'link'=>$link,'show'=>$sho]);
        return back();
    }
    public function butbanner(Request $req){
        $word1=$req->input('word1');
        $word2=$req->input('word2');
        $link=$req->input('link');
        $img=$req->file('image');
        $logoPath = public_path('/img/panners');
        $olddata=Panner::where('id',2)->first();
        if(!empty($img)){
            $logoName='2';
            $logoName.='.'.$img->getClientOriginalExtension();
            $img->move($logoPath,$logoName);
        }else{
            $logoName=$olddata->image;
        }
        Panner::where('id',2)->update(['word1'=>$word1,'word2'=>$word2,'link'=>$link,'image'=>$logoName]);
        return back();
    }
    public function newban(Request $req){
        $word1=$req->input('word1');
        $word2=$req->input('word2');
        $link=$req->input('link');
        $img=$req->file('image');
        $logoPath = public_path('/img/panners');
        Panner::insert(['word1'=>$word1,'word2'=>$word2,'link'=>$link]);
        $id=Panner::orderBy('id','desc')->first();
        $id=$id->id;
        if(!empty($img)){
            $logoName=$id;
            $logoName.='.'.$img->getClientOriginalExtension();
            $img->move($logoPath,$logoName);
        }else{
            $logoName='';
        }
        Panner::where('id',$id)->update(['image'=>$logoName]);
        return back();
    }
    public function editban(Request $req,$id){
        $word1=$req->input('word1');
        $word2=$req->input('word2');
        $link=$req->input('link');
        $img=$req->file('image');
        $logoPath = public_path('/img/panners');
        $olddata=Panner::where('id',$id)->first();
        if(!empty($img)){
            $logoName=$olddata->id;
            $logoName.='.'.$img->getClientOriginalExtension();
            $img->move($logoPath,$logoName);
        }else{
            $logoName=$olddata->image;
        }
        Panner::where('id',$id)->update(['word1'=>$word1,'word2'=>$word2,'link'=>$link,'image'=>$logoName]);
        return back();
    }
    public function remban($id){
        $ban=Panner::where('id',$id)->first();
        @unlink('img/panners/'.$ban->image);
        Panner::where('id',$id)->delete();
        return back();
    }
    public function pagesbanner(Request $req){
        $shpimg=$req->file('shipban');
        $retimg=$req->file('retban');
        $conimg=$req->file('conban');
        $faqimg=$req->file('faqban');
        $aboimg=$req->file('aboban');
        $abiimg=$req->file('abiban');
        $sellimg=$req->file('sellban');
        $carimg=$req->file('carban');
        $braimg=$req->file('braban');
        // start  shereen add banner to hotdeals+ new arrival + sell with us + payment method
        $HDaimg=$req->file('HDaban'); 
        $Nraban=$req->file('Nraban');
        $Sellaban=$req->file('Sellaban');
        $Paymentaban=$req->file('Paymentaban');
        //  end 
        $Path = public_path('/img/pagesbanner');
        $olddata=Banimg::all();
        if(!empty($shpimg)){
            $shpimgt='shipping';
            $shpimgt.='.'.$shpimg->getClientOriginalExtension();
            $shpimg->move($Path,$shpimgt);
        }else{
            $shpimgt=$olddata[0]->image;
        }
        if(!empty($retimg)){
            $retimgt='returns';
            $retimgt.='.'.$retimg->getClientOriginalExtension();
            $retimg->move($Path,$retimgt);
        }else{
            $retimgt=$olddata[1]->image;
        }
        if(!empty($conimg)){
            $conimgt='contact';
            $conimgt.='.'.$conimg->getClientOriginalExtension();
            $conimg->move($Path,$conimgt);
        }else{
            $conimgt=$olddata[2]->image;
        }
        if(!empty($faqimg)){
            $faqimgt='faq';
            $faqimgt.='.'.$faqimg->getClientOriginalExtension();
            $faqimg->move($Path,$faqimgt);
        }else{
            $faqimgt=$olddata[3]->image;
        }
        if(!empty($aboimg)){
            $aboimgt='about';
            $aboimgt.='.'.$aboimg->getClientOriginalExtension();
            $aboimg->move($Path,$aboimgt);
        }else{
            $aboimgt=$olddata[4]->image;
        }
        if(!empty($abiimg)){
            $abiimgt='aboutimg';
            $abiimgt.='.'.$abiimg->getClientOriginalExtension();
            $abiimg->move($Path,$abiimgt);
        }else{
            $abiimgt=$olddata[5]->image;
        }
        if(!empty($sellimg)){
            $sellimgt='sell';
            $sellimgt.='.'.$sellimg->getClientOriginalExtension();
            $sellimg->move($Path,$sellimgt);
        }else{
            $sellimgt=$olddata[6]->image;
        }
        if(!empty($carimg)){
            $carimgt='cart';
            $carimgt.='.'.$carimg->getClientOriginalExtension();
            $carimg->move($Path,$carimgt);
        }else{
            $carimgt=$olddata[7]->image;
        }
        if(!empty($braimg)){
            $braimgt='brand';
            $braimgt.='.'.$braimg->getClientOriginalExtension();
            $braimg->move($Path,$braimgt);
        }else{
            $braimgt=$olddata[8]->image;
        }
        // by shereen 
        if(!empty($HDaimg)){
            $HDaimgt='Hotdeals';
            $HDaimgt.='.'.$HDaimg->getClientOriginalExtension();
            $HDaimg->move($Path,$HDaimgt);
        }else{
            $HDaimgt=$olddata[9]->image;
        }
        // 
        if(!empty($Nraban)){
            $Nrabant='NewArrival';
            $Nrabant.='.'.$Nraban->getClientOriginalExtension();
            $Nraban->move($Path,$Nrabant);
        }else{
            $Nrabant=$olddata[10]->image;
        }
        // 
        if(!empty($Sellaban)){
            $Sellabant='SellWithus';
            $Sellabant.='.'.$Sellaban->getClientOriginalExtension();
            $Sellaban->move($Path,$Sellabant);
        }else{
            $Sellabant=$olddata[11]->image;
        }
        // 
        if(!empty($Paymentaban)){
            $Paymentabant='Payment';
            $Paymentabant.='.'.$Paymentaban->getClientOriginalExtension();
            $Paymentaban->move($Path,$Paymentabant);
        }else{
            $Paymentabant=$olddata[12]->image;
        }

        Banimg::where('id',1)->update(['image'=>$shpimgt]);
        Banimg::where('id',2)->update(['image'=>$retimgt]);
        Banimg::where('id',3)->update(['image'=>$conimgt]);
        Banimg::where('id',4)->update(['image'=>$faqimgt]);
        Banimg::where('id',5)->update(['image'=>$aboimgt]);
        Banimg::where('id',6)->update(['image'=>$abiimgt]);
        Banimg::where('id',7)->update(['image'=>$sellimgt]);
        Banimg::where('id',8)->update(['image'=>$carimgt]);
        Banimg::where('id',9)->update(['image'=>$braimgt]);
        // by shereen 
        Banimg::where('id',10)->update(['image'=>$HDaimgt]);
        Banimg::where('id',11)->update(['image'=>$Nrabant]);
        Banimg::where('id',12)->update(['image'=>$Sellabant]);
        Banimg::where('id',13)->update(['image'=>$Paymentabant]);
        return back();
    }
}
