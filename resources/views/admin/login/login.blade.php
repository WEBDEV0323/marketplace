<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from pepdev.com/template/apez/admin/login-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Jun 2020 19:57:12 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Virtual Marketplace | Login</title>
    <link rel="icon" type="image/x-icon" href="{{asset('admin/images/favicon.png')}}">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{asset('admin/dist/css/style.css')}}" />
</head>
<body>

    <!-- Page Wrapper -->
    <div class="lgn-background" >
        <div class="lgn-wrapper">
            <div class="lgn-logo text-center">
                <a><img src="{{asset('assets/images/market-place-logo.png')}}" alt=""></a>
            </div>
            <div id="login-form" class="lgn-form ">
            @if ( session()->has('message') )
                            <div class="alert alert-icon alert-success alert-dismissible fade show">
                                <div class="alert--icon">
                                    <i class="fa fa-check"></i>
                                </div>
                                <div class="alert-text">
                                    <strong>Well done!</strong>  {{ session('message') }}
                                </div>
                                <button type="button" class="close" data-dismiss="alert">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @elseif(session()->has('error'))
                            <div class="alert alert-icon alert-danger alert-dismissible fade show">
                            <div class="alert--icon">
                                <i class="fa fa-thermometer"></i>
                            </div>
                            <div class="alert-text">
                                <strong>Oh snap!</strong> {{ session('error') }}
                            </div>
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            @endif  
                <form action = "{{ route('login.process') }}" class="form-vertical" method = "post">
                    @csrf
                    <div class="lgn-input form-group">
                        <label class="control-label col-sm-12">Email</label>
                        <div class="col-sm-12">
                            <input class="form-control" type="text" name="email" id="lgn-mail" placeholder="Enter your Username" autocomplete="off">
                        </div>
                    </div>
                    <div class="lgn-input form-group">
                        <label class="control-label col-sm-12">Password</label>
                        <div class="col-sm-12">
                            <input type="password" name="password" id="lgn-pass" class="form-control" placeholder="Enter your Password" autocomplete="off">
                        </div>  
                    </div>
                    <div class="lgn-forgot">
                        <a href="#">Forgotten Password?</a>
                    </div>
                    <div class="lgn-submit">
                        <button type="submit" id="lgn-submit" class="btn btn-primary btn-pill btn-lg" name="login">Login</button>
                    </div>
                </form>
            </div> 
        </div>
    </div>

    <!-- Include js files -->
    <!-- jQuery Library -->
    <script type="text/javascript" src="{{asset('admin/assets/plugin/jquery/jquery-3.3.1.min.js')}}"></script>
    <!-- Popper Plugin -->
    <script type="text/javascript" src="{{asset('admin/assets/plugin/popper/popper.min.js')}}"></script>
    <!-- Bootstrap Framework -->
    <script type="text/javascript" src="{{asset('admin/assets/plugin/bootstrap/bootstrap.min.js')}}"></script>
</body>

<!-- Mirrored from pepdev.com/template/apez/admin/login-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Jun 2020 19:57:26 GMT -->
</html>


