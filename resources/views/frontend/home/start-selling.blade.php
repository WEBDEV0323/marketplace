@extends('layouts.frontend.master')
@section('title', 'Start Selling - The Marketplace')
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
<main class="vendor-page">
    <div class="join-us">
        <div class="column sign-up">
            <form action="{{route('register_users')}}" method = "post" class="sign-up-form common-form">
                @csrf
                <div class="form-row">
                    <div class="form-group col-12">
                        <input type="email" class="form-control" name="email" id="email" />
                        <label for="email">Email Address <span>*</span></label>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" name="first_name" class="form-control" id="firstName" />
                        <label for="firstName">First Name <span>*</span></label>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" name="last_name" class="form-control" id="lastName" />
                        <label for="lastName">Last Name <span>*</span></label>
                    </div>

                    <div class="form-group col-md-6">
                        <a href="#" class="btn view-password"><i class="far fa-eye" onclick="newPassword()"></i></a>
                        <input type="password" class="form-control" name="password" id="password" />
                        
                        <label for="password">Password <span>*</span></label>

                        
                    </div>
                    <div class="form-group col-md-6">
                        <a href="#" class="btn view-password"><i class="far fa-eye" onclick="ConfirmPassword()"></i></a>
                        <input type="password" class="form-control" name="confirm_password"
                            id="confirm-password" />
                        <label for="confirm-password">Confirm Password <span>*</span></label>
                        <div class="password-status">
                            <span class="hint">
                              {{--  Hint: The password should be at least twelve characters
                                long. To make it stronger, use upper and lower case letters,
                                numbers, and symbols like ! " ? $ % ^ & ).  --}}

                                Advice: Your password should be twelve characters or more to maximise security. To make it stronger you should use a range of Upper Case and Lower Case Letters, Numbers and Symbols.
                            </span>
                          <!--   <span class="very-weak">Very Weak - Please enter a stronger password.</span>
                            <span class="weak">Weak - Please enter a stronger password.</span>
                            <span class="medium">Medium</span>
                            <span class="strong">Strong</span> -->

                        </div>
                    </div>
                </div>
                <!-- <p>
              Your personal data will be used to support your experience
              throughout this website, to manage access to your account, and for
              other purposes described in our <a href="#">privacy policy.</a>
            </p> -->
                <button class="btn blue-button float-right" type="submit" id="register">
                    Register
                </button>
            </form>
        </div>
    </div>

    <!-- Login Alert -->
        @if ( session()->has('message') )
            <div class="alert alert-dismissible fade success-alert register-alert show" role="alert">
                <button type="button" class="close buttonAlert" data-dismiss="alert" aria-label="Close">
                    <i class="uil uil-multiply"></i>
                </button>
                <p class="displayContent"> <strong>Well done!</strong> {{ session('message') }}</p>
            </div>
        @elseif(session()->has('error'))
            <div class="alert alert-dismissible fade error-alert register-alert show" role="alert">
                <button type="button" class="close buttonAlert" data-dismiss="alert" aria-label="Close">
                    <i class="uil uil-multiply"></i>
                </button>
                <p class="displayContent"> <strong>Oh snap!</strong> {{ session('error') }}</p>
            </div>
        @endif 
</main>
@endsection

@section('scripts')
<script src="{{asset('assets/js/jquery.passwordstrength.js')}}"></script>
<script>
/* function check_confirm_password(){
	var confirmPassword = document.getElementById("confirm-password").value;
	var password = document.getElementById("password").value;
	if (password == confirmPassword) {
         $('.password-status').css('display','block');     
         return true;
		}else{
			$('.password-status').css('display','none');
			return false;
		}
   
	} */

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