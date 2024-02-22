
@extends('layouts.frontend.new')

@section('title','My account -The Marketplace ')
@section('banner')







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


  <div class="dashboard-block">
    <div class="column sidebar">
      <div class="block block1">
        <div class="image-wrapper">
          <?php $user = App\Models\User::where('id', auth()->user()->id)->first(); ?>
          @if($user->image_url) <img src="{{$user->user_image}}" class="img-fluid"> @else <img src="{{asset('assets/images/avatar.png')}}" class="img-fluid"> @endif

          <a href="#" class="btn edit-button"><i class="fas fa-pencil-alt"></i></a>
        </div>

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




@endsection