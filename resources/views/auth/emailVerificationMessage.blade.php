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
              <div class="row justify-content-center align-items-center h-100 text-center">
                    <!-- Session Status -->
                   
        
                    <!-- Validation Errors -->
                    {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}
                    
                        <div class="login-form">
                            <div class="brand-logo">
                              <a href="{{url('/login')}}"> <img src="{{asset('/assets/images/logo-black.png')}}" alt="logo"></a>
                            </div>
                            <div class="form-title">
                                <div class="my-4">
                                    <img src="{{asset('/assets/images/send-mail.png')}}" alt="logo">
                                </div>
                                <h4>Please check your emails to activate your account.</h4>
                                <p>If you didn’t receive an email, please resend</p>
                            </div>    
                            <a class="btn-theme" href="user-resend-verification-email">Resend Verification Email</a>
                        </div> 
            </div>          
            </div>
        </section>

  

</main>


@endsection
@section('scripts')
<script src="{{asset('assets/js/jquery.passwordstrength.js')}}"></script>

@endsection
