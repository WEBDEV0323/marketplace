@extends('layouts.frontend.master')
@section('title', 'Sign in -The Marketplace ')
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



  @endif



            <h2 class="title">Login</h2>
            <form action="{{ route('login.process') }}" class="sign-in-form common-form" method="post">
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
                    <a href="javascript:void(0)" class="btn view-password"><i class="far fa-eye"
                            onclick="currentPassword()"></i></a>
                    <input type="password" class="form-control" name="password" id="passwordlogin">
                    <label for="password">{{ __('Password') }} <span>*</span></label>
                </div>




                <div class="form-row">
                    <div class="form-group col-lg-3 col-md-5 col-sm-6 pr-3">
                        <button class="btn blue-button" type="submit" id="login">Login</button>
                    </div>
                    <div class="form-group form-check col-lg-9 col-md-7 col-sm-6 pl-4">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Remember me</label>
                    </div>
                </div>
                <div class="form-group pt-0 pt-lg-3">
                    <a href="{{route("lost_password")}}" class="d-block text-left text-sm-right">LOST YOUR PASSWORD?</a>
                </div>
            </form>
        </div>
        <div class="column sign-up">
            <h2 class="title">Register</h2>
            <form method="POST" action="{{ route('register.process') }}" class="sign-up-form common-form">
                @csrf
                <div class="form-row">
                    <div class="form-group col-6">
                        <input type="text" name="first_name" class="form-control" id="firstName">
                        <label for="firstName">First Name <span>*</span></label>
                    </div>
                    <div class="form-group col-6">
                        <input type="text" name="last_name" class="form-control" id="lastName">
                        <label for="lastName">Last Name <span>*</span></label>
                    </div>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" id="email">
                    <label for="email">Email Address <span>*</span></label>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="phone" id="phone">
                    <label for="phone">Phone<span>*</span></label>
                </div>
                <div class="form-group">
                    <a href="javascript:void(0)" class="btn view-password"><i class="far fa-eye"
                            onclick="newPassword()"></i></a>
                    <input type="password" class="form-control" name="password" id="password">

                    <label for="password">Password <span>*</span></label>
                </div>
                <div class="form-group">
                    <a href="javascript:void(0)" class="btn view-password"><i class="far fa-eye"
                            onclick="ConfirmPassword()"></i></a>
                    <input type="password" class="form-control" name="confirm_password" id="confirm-password">
                    <label for="confirm-password">Confirm Password <span>*</span></label>
                    <!-- <span class= "password-status " style = "display:none; background-color:green">Password Match</span> -->
                </div>

                <div class="password-status mb-3">
                    <span class="hint">
                    {{--    Hint: The password should be at least twelve characters long. To make it stronger, use upper
                        and lower case letters,
                        numbers, and symbols like ! " ? $ % ^ & ).
                        numbers and symbols. --}}

                        Advice: Your password should be twelve characters or more to maximise security. To make it stronger you should use a range of Upper Case and Lower Case Letters, Numbers and Symbols.
                    </span>


                </div>

                <p>
                    Your personal data will be used to support your experience throughout this website, to manage access
                    to your account,
                    and for other purposes described in our <a href="{{route("coming_soon")}}">privacy policy.</a>
                </p>
                <button class="btn blue-button" type="submit" id="register">Register</button>
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






});
</script>
@endsection
