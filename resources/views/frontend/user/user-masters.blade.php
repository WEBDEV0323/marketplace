

@extends('layouts.frontend.master')
@section('title','My account -The Marketplace ')
@section('banner')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all"
    rel="stylesheet" type="text/css" />
<style>
.main-section {
    margin: 0 auto;
    padding: 20px;
    margin-top: 100px;
    background-color: #fff;
    box-shadow: 0px 0px 20px #c1c1c1;
}

.fileinput-remove,
.fileinput-upload {
    display: none;
}

#blah {
    display: none;
}
</style>
<div class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="search-popup">
  <div class="modal-dialog  modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="search-wrapper">
          <div class="form-group m-0">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search.." aria-label="Username" aria-describedby="basic-addon1">
              <div class="input-group-append">
                <span class="input-group-text">
                  <div class="typing-indicator">
                    <span></span>
                    <span></span>
                    <span></span>
                  </div>
                </span>
                <span class="input-group-text" id="basic-addon1"><i class="uil uil-search"></i></span>
              </div>
            </div>
          </div>
          <div class="show_all_results">
            <div class="emptyresult">Nothing Found For : </div>
            <a href="#" class="productsearchlink"> dsf</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('content')
<main class="dashboard-pages">


  <div class="dashboard-block"  @if(\Request::route()->getName()=="my_list") style="max-width: 1628px;" @endif>
    <div class="column sidebar">
      <div class="block block1">
        <form action="{{route('imageUpdate')}}" method = "post" class="common-form text-center" enctype = "multipart/form-data" style="position: relative">
            @csrf
        <div class="image-wrapper">
          <?php $user = App\Models\User::where('id', auth()->user()->id)->first(); ?>
          @if($user->image_url) 
          <?php $userImage =asset('/storage/user/'.auth()->user()->id.'/'.$user->image_url );?>
          <img src="{{$userImage}}" class="img-fluid image_upload_url"> @else <img src="{{asset('assets/images/avatar.png')}}" class="img-fluid image_upload_url"> @endif

          <a class="edit_profile_pik"><i class="fas fa-pencil-alt"></i></a>

          {{-- <a href="#" class="btn edit-button"> --}}{{-- <i class="fas fa-pencil-alt"><input type="file" name="user_image" id="user_image" class="btn edit-button"></i> --}}
          {{-- </a> --}}
        </div>
            <input type='file' name="image_url" accept="image/jpeg, image/png, image/bmp, image/gif, image/webp" onchange="previewFile()" class="image_upload" style="position: absolute; z-index: -1; visibility: hidden;"/>
        <button class="btn blue-button mt-3">Update Profile</button>
        </form>   
        <hr/>                       
        <div class="user-detail">
          <h2 class="user-title"><?php echo $user->first_name . ' ' . $user->last_name; ?></h2>
          @if($user->user_type == 1)
          <h5 class="user-status">Seller Status: <span class="status text-success">confirmed</span></h5>
          @else
          <h5 class="user-status">Seller Status: <span class="status text-danger">Unconfirmed</span></h5>
          @endif
          @if($user->user_type == 1)
          @else
          <a href="{{route('become.vendor')}}" class="btn blue-button">Verify</a>
          @endif
        </div>
      </div>
      <div class="block block2">
        <nav class="nav flex-column">
          @if(auth()->user()->user_type == 1)
          <a class="nav-link {!! request()->route()->getName() == 'update_account' ? 'active': '' !!}" href="{{route('update_account')}}"><i class="far fa-id-badge"></i> Account Details</a>
          <a class="nav-link {!! request()->route()->getName() == 'edit_address' ? 'active': '' !!}" href="{{route('edit_address')}}"><i class="far fa-address-card"></i> Addresses</a>
          
          @if(Auth::user()->affiliate_status == 1)<a class="nav-link hover_afileate_btn {!! request()->route()->getName() == 'get_affiliate' ? 'active': '' !!}" href="{{route('get_affiliate')}}">
            @if(request()->route()->getName() == 'get_affiliate')
                <?php $imapgeurl = asset('assets/images/afiliat_hover.png'); ?>
            @else
              <?php $imapgeurl = asset('assets/images/affiliate.png'); ?>
            @endif
            <img src="{{$imapgeurl}}" class="afiliate_image_chagne" style="height: 20px;width: 20px;margin-right: 10px;">
            
            Affiliate</a>@endif
          <a class="nav-link {!! request()->route()->getName() == 'bank_detail' ? 'active': '' !!}" href="{{route('bank_detail')}}"><i class="fas fa-university"></i> Bank Information</a>
          <a class="nav-link {!! request()->route()->getName() == 'my_list' ? 'active': '' !!}" href="{{route('my_list')}}"><i class="fas fa-university"></i> My Listings</a>
          <a class="nav-link {!! request()->route()->getName() == 'user_subscribe' ? 'active': '' !!}" href="{{route('user_subscribe')}}"><i class="fas fa-magnet"></i> My Subscriptions</a>
          <a class="nav-link {!! request()->route()->getName() == 'user_orders' ? 'active': '' !!}" href="{{route('user_orders')}}"><i class="fas fa-list"></i> Orders</a>
          <a class="nav-link {!! request()->route()->getName() == 'sale_your_product' ? 'active': '' !!}" href="{{route('sale_your_product')}}"><i class="fas fa-pen"></i> Sell a product</a>
          <a class="nav-link {!! request()->route()->getName() == 'seller_sold_item' ? 'active': '' !!}" href="{{route('seller_sold_item')}}"><i class="fas fa-list"></i> Sold Items</a>

          @else
          <a class="nav-link {!! request()->route()->getName() == 'update_account' ? 'active': '' !!}" href="{{route('update_account')}}"><i class="far fa-id-badge"></i> Account Details</a>
          <a class="nav-link {!! request()->route()->getName() == 'edit_address' ? 'active': '' !!}" href="{{route('edit_address')}}"><i class="far fa-address-card"></i> Addresses</a>

          <a class="nav-link {!! request()->route()->getName() == 'bank_detail' ? 'active': '' !!}" href="{{route('bank_detail')}}"><i class="fas fa-university"></i> Bank Information</a>
          <a class="nav-link {!! request()->route()->getName() == 'user_subscribe' ? 'active': '' !!}" href="{{route('user_subscribe')}}"><i class="fas fa-magnet"></i> My Subscriptions</a>
          <a class="nav-link {!! request()->route()->getName() == 'user_orders' ? 'active': '' !!}" href="{{route('user_orders')}}"><i class="fas fa-list"></i> Orders</a>
          @endif
          @if(auth()->user()->user_type != 1)
          <a class="nav-link {!! request()->route()->getName() == 'become.vendor' ? 'active': '' !!}" href="{{route('become.vendor')}}"><i class="far fa-id-badge"></i> Start Selling</a>
          @endif
          <a class="nav-link " href="{{route('logout')}}"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </nav>
      </div>
    </div>
    @yield('user-content')
  </div>


  @if ( session()->has('message') )
  <div class="alert alert-dismissible fade success-alert register-alert show" role="alert">
    <button type="button" class="close buttonAlert" data-dismiss="alert" aria-label="Close">
      <i class="uil uil-multiply"></i>
    </button>
    <p style="text-align:center;"> {{ session('message') }}</p>
  </div>

  @elseif(session()->has('error'))


  <div class="alert alert-dismissible fade success-alert register-alert show" role="alert">
    <button type="button" class="close buttonAlert" data-dismiss="alert" aria-label="Close">
      <i class="uil uil-multiply"></i>
    </button>
    <p style="text-align:center;"> {{ session('error') }}</p>
  </div>


 {{-- <div class="alert alert-dismissible fade error-alert register-alert show" role="alert">
    <button type="button" class="close buttonAlert" data-dismiss="alert" aria-label="Close">
      <i class="uil uil-multiply"></i>
    </button>
    <p> {{ session('error') }}</p>
  </div>  --}}

  @endif

  {{-- <div class="alert alert-dismissible fade error-alert register-alert search-class" role="alert">
        <button type="button" class="close buttonAlert" data-dismiss="alert" aria-label="Close">
            <i class="uil uil-multiply"></i>
        </button>
        <p id = "para"> </p>
    </div> --}}
</main>
<div class="alert alert-dismissible fade" role="alert" style="text-align:center;">
  <button id="error_model" type="button buttonAlert" class="close buttonAlert" data-dismiss="alert" aria-label="Close" onclick="closeup();">
    <i class="uil uil-multiply"></i>
  </button>
  <p class="displayContent"></p>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript">
</script>
<script type="text/javascript">

  $(document).ready(function(){
    var geturiSegment = "{{Request::segment(2) }}";
    if($('.hover_afileate_btn').hasClass('.active') || geturiSegment == "affiliate"){
        $('.afiliate_image_chagne').attr('src',"{{asset('assets/images/afiliat_hover.png')}}");
    };
    if(geturiSegment != "affiliate"){
      $('.hover_afileate_btn ').hover(      
          function() {
            $('.afiliate_image_chagne').attr('src',"{{asset('assets/images/afiliat_hover.png')}}");
          },
          function() {
              $('.afiliate_image_chagne').attr('src',"{{asset('assets/images/affiliate.png')}}");
          }
      );
    }
  })

  function previewFile() {
    var preview = document.querySelector('img.image_upload_url');
    var file    = document.querySelector('input[type=file]').files[0];
    var reader  = new FileReader();

    reader.addEventListener("load", function () {
        preview.src = reader.result;
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    }
    }
      $(document).ready(function(){
        $(document).on('click',".edit_profile_pik",function(){
          $('.image_upload').trigger('click');
        });        
    });
  

  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#blah')
                .attr('src', e.target.result);
        };
        $('#blah').show();

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection