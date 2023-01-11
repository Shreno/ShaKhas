@extends('master')
@section('content')
<!-- Page Details -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
  
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #0c0d0c;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #0c0d0c;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}


</style>
</head>
<body>
 

    <section  class="bg-title-page  p-t-40 p-b-50 flex-col-c-m"
    style=" background-image:url({{asset('img/pagesbanner/'.$banimg[11]->image)}});">
      <h2 class="l-text2 t-center">
          
                
                    sell with us
                
            
      </h2>
    </section>
  <br>
  <br>

  


              


<div class="row">

    
  <div class="col-75">
   <h4 class="product-detail-name m-text16 p-b-13">
					Submit your item
				</h4>
    <div class="container">
   
     <form action="/sendproposal" method="post" enctype="multipart/form-data">
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
        <div class="row">
          <div class="col-50">
            <h3></h3>
            <label for="fname"><i class="fa fa-dropbox"></i> Add Item Name and description here</label>
            <input type="text" id="fname" placeholder="Prada Midem Clasic, Sling Bag" name="name">
            <label for="state">Category</label>
            <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
							<select class="form-control" name="cat">
								<option value="">Choose Category</option>
								@foreach($cats as $cat)
								<option value="{{$cat->id}}">{{$cat->category_name}}</option>
								@endforeach
							</select>
						</div>
            <label for="state">Brand</label>
            <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
							<select class="form-control" name="brand">
								<option value="">Choose Brand</option>
								<option value="0">No Brand</option>
								@foreach($brands as $bran)
								<option value="{{$bran->id}}">{{$bran->brand_name}}</option>
								@endforeach
							</select>
						</div>
            <label for="state">Condition</label>
            <div class="rs2-select2 rs3-select2 bo4 of-hidden w-size16">
							<input type="text" class="form-control" name="cond" placeholder="New , like new , etc..">
						</div>
           
          </div>

          <div class="col-50">
            <h3>Item Photos</h3>
            <label for="fname">Browes Item Photo</label>
            <input type="file" name="imgs[]" multiple>
            
           
          </div>
          
        </div>
        
        <hr />
         <div class="row">
              <div class="col-50">
                <label for="expyear">Phone Number</label>
                <input type="text" name="phone" placeholder="123456789"
                @if (Auth::check()&&!empty(Auth::user()->phone))
                value="{{Auth::user()->phone}}" 
                @endif
                >
              </div>
              <div class="col-50">
                <label for="cvv">apply voucher</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
              </div>
            </div>
         <label>
          <input type="checkbox" checked="checked" name="chk"> Accept our <a href="/terms">Terms & Conditions</a>
        </label>
        <input type="submit" value="Continue to checkout" class="btn">
      </form>
    </div>
  </div>
  <div class="col-25">
    <div class="container">
      <h4>SELLING 10+ OR  HIGH-VALUE ITEMS<span class="price" style="color:black"> </span></h4>
     <img src="/img/pagesbanner/{{$banimg[6]->image}}" alt="IMG-PRODUCT" width=100%>
     <a href="/contact" class="btn">Contact Us</a>
    </div>
  </div>
</div>
<br>
<br>

<!-- Page Details -->
@stop