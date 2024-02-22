@extends('layouts.frontend.master')
@section('title', 'Sign in -The Marketplace ')
@section('banner')



@endsection
@section('content')
<main class="my-account-page">
    <div class="join-us main_centerBlock">
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



            
        </div>


        <section class="login-bg">
            <div class="container h-100">
              <div class="row justify-content-center align-items-center text-center h-100">
                    <!-- Session Status -->
                   
        
                    <!-- Validation Errors -->
                    {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}
                    <form method="POST" action="{{ route('resend_verification.email') }}">
                        @csrf
                        <div class="login-form">
                            <div class="brand-logo mb-4">
                              <a href="{{url('/login')}}"> <img src="{{asset('/assets/images/logo-black.png')}}" alt="logo"></a>
                            </div>
                            <div class="my-4">
                                <img src="{{asset('/assets/images/send-mail.png')}}" alt="logo">
                            </div>
                            <div class="form-title mb-3">
                              <h4>Please check your emails to activate your account.</h4>
                              <p>If you didn’t receive an email, please resend</p>
                            </div>    
                            @if(Session::has('status_already'))
                                 <p class="text-success"> {{session('status_already')}}</p>
                            @endif
                            @if(Session::has('status_email_error'))
                                 <p class="text-danger"> {{session('status_email_error')}}</p>
                            @endif
                            @if(Session::has('status_email_send'))
                                 <p class="text-success"> {{session('status_email_send')}}</p>
                            @endif                            
                            <div class="form-group position-relative">
                                 <input type="email" class="form-control" id="email" placeholder="Enter Email"  name="email"  value="{{Session::has('mail_resend_get')?session('mail_resend_get'):''}}" required  >                              
                            </div>
                            @if ($errors->has('email'))
                                <div class="error text-danger"> <span>{{ $errors->first('email') }}</span></div>
                            @endif
                             <button type="submit" class="btn-theme Login-btn">Resend Verification Email</button>   
                        </div>           
                </form>
            </div>          
            </div>
        </section>

  

</main>


@endsection
@section('scripts')
<script src="{{asset('assets/js/jquery.passwordstrength.js')}}"></script>

@endsection
