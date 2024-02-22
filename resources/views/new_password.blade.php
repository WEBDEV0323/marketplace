@extends('layouts.frontend.master')
@section('title', 'Lost Your Password')
@section('banner')
<div class="inner-banner">

    <h1 class="dark-heading">The Marketplace</h1>
    <h1 class="page-title">My Account</h1>
</div>



             
                   
                

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
                            <input type="text" class="form-control" placeholder="Search.." aria-label="Username"
                                aria-describedby="basic-addon1">
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
<main class="my-account-page">
    <div class="join-us">
        <div class="column sign-in">

   
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


            <h2 class="title">Lost Your password</h2>
            <form action="{{ route('lost.process') }}" class="sign-in-form common-form" method="post">
                @csrf
                @if(session()->has('error'))
                    <div class="alert alert-danger">
                    {{ session()->get('error') }}
                    </div>
                    @endif

                <div class="form-group">
                    <input type="email" class="form-control" name="email" id="email">
                    <label for="email">{{ __('E-Mail Address') }} <span>*</span></label>
                </div>
           
                <div class="form-group">
                    <input type="password" class="form-control" name="password" id="password">
                    <label for="password">Password <span>*</span></label>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="re_password" id="re_password">
                    <label for="email">Re-password <span>*</span></label>
                </div>

                    


                <div class="form-row">
                    <div class="form-group col-lg-3 col-md-5 col-sm-6 pr-3">
                        <button class="btn blue-button" type="submit" id="login">Get Link</button>
                    </div>
                   
                </div>
               
            </form>
        </div>
       
    </div>


    @if ($errors->any())
    <div class="alert alert-dismissible fade error-alert login-alert show" role="alert">
   
                   
            @foreach ($errors->all() as $error)
            
                
                
                <p>{{ $error }}</p>
            @endforeach
        
    </div>
@endif

    <!-- Login Alert -->
   

    <!-- Register Alert -->
   
</main>


@endsection
@section('scripts')
<script src="{{asset('assets/js/jquery.passwordstrength.js')}}"></script>
<script>


function currentPassword() {
    var x = document.getElementById("passwordlogin");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function newPassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function ConfirmPassword() {
    var x = document.getElementById("confirm-password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

$(document).ready(function() {


    $(function() {
        $("#password").passwordStrength();
    });



    $("form").submit(function(e){
    var pass=$("#password").val();
    var re_pass=$("#re_password").val();

    if(pass != re_pass)
    {
        alert("Password and re password do not match");
        e.preventDefault();

    }
    
  });





});
</script>
@endsection