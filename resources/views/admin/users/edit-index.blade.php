@extends('layouts.admin.master')

@section('body-content')
<div class="page-wrapper">
    <!-- Page Title -->
    <div class="page-title">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h2 class="page-title-text">Users Details</h2>
            </div>
            <div class="col-sm-6 text-right">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li>Users Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Body -->
    <div class="page-body">
        @if( session()->has('message') )
        <div class="alert alert-icon alert-success alert-dismissible fade show">
            <div class="alert--icon">
                <i class="fa fa-check"></i>
            </div>
            <div class="alert-text">
                <strong>Well done!</strong> {{ session('message') }}
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
        <div class="row edit-details-row">



            <div class="column column-1">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <h5 class="main-heading">@if($data->user_type==1)Seller Profile @else User Profile @endif</h5>
                        <div class="user-avtar">
                            {{-- <form action="{{ route('user.editimage') }}" method="post" enctype="multipart/form-data">

                            @csrf --}}


                            <form action="{{ route('user.edit') }}" method="post" enctype="multipart/form-data" id="update_form">

                                @csrf
                                <div class="img-box">
                                    <div>
                                        {{-- <img class="img-fluid"
                                            src="<?php echo (!empty($data->user_image) ? $data->user_image : '{{ asset("admin/uploads/example.png") }}') ?> "
                                            alt=""> --}}



                                        <img src="<?php echo  $data->user_image  ?>" alt="" id="user-image-main">


                                    </div>
                                    {{-- <span class="file-upload-btn">

                                        <input type="file" onchange="readURL(this);" name="image" id="image-picker">
                                        <i class="uil uil-camera"></i>
                                    </span> --}}
                                </div>

                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <div class="buttons">
                                    <!-- <input type="file" onchange="readURL(this);" name="feature_image" id="image-picker"> -->
                                    <label for="profile_input" class="btn btn-info change-btn">
                                        <input type="file" onchange="readURL(this);" id="profile_input" style="color:#fff; width:0; height:0;" name="image">
                                        Change
                                    </label>
                                    <a href="{{ route('user.image.remove.all',$data->id) }}"><input style="background:#F86A52;border: #F86A52;" type="button" value="Remove" class="btn btn-info"></a>
                                </div>


                        </div>
                        <div class="user-details text-center">
                            <h5>{{ $data->first_name }}&nbsp;{{ $data->last_name }}</h5>
                            <h5><i class="icon-envelope"></i>&nbsp; {{ $data->email }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column column-2">
                <div class="panel panel-default">
                    <div class="panel-head">
                        <div class="panel-title">
                            <h5 class="main-heading text-left">Personal details</h5>
                        </div>
                    </div>
                    <div class="panel-body">


                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="form-body">

                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label">First Name</label>
                                        <input type="text" name="first_name" value="<?php echo $data->first_name; ?>" class="form-control" placeholder="First Name">
                                        <!-- <span class="form-text">Please enter your Firstname</span> -->
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Last Name</label>
                                        <input type="text" name="last_name" value="<?php echo $data->last_name; ?>" class="form-control" placeholder="Last Name">
                                        <!-- <span class="form-text">Please enter your Lastname</span> -->
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Email</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">@</span>
                                            </div>
                                            <input disabled type="email" name="email" value="<?php echo $data->email; ?>" class="form-control" placeholder="Enter Email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Payout Email</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">@</span>
                                            </div>
                                            <input disabled type="email" name="email" value="<?php echo $payout_email; ?>" class="form-control" placeholder="Enter Email">
                                        </div>
                                    </div>
                                    <div class="form-group" style="display: {{$data->user_type == 1 && $data->affiliate_status == '1'?'':'none'}};" id="commission_div">
                                        <label class="col-form-label">Commission Setting </label>
                                        <select name="commission_setting" class="form-control" id="select_commission_setting">
                                            <option value="" {{$data->tier_type == null?'selected':''}}>Select Tier</option>
                                            <option value="tier-1" {{$data->tier_type == "tier-1"?'selected':''}}>Tier 1 (Standard) – 2% Commission </option>
                                            <option value="tier-2" {{$data->tier_type == "tier-2"?'selected':''}}>Tier 2 – Have to sell £10,000 worth of products – 2.5% Commission </option>
                                            <option value="tier-3" {{$data->tier_type == "tier-3"?'selected':''}}>Tier 3 – Have to sell £20,000 worth of products – 3% Commission </option>
                                            <option value="tier-4" {{$data->tier_type == "tier-4"?'selected':''}}>Tier 4 – Have to sell £50,000 worth of products – 5% Commission </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Status</label>

                                        <select name="status" class="form-control" id="select_status">
                                            {{-- <option value="">Select a Status</option> --}}
                                            <option value="0" <?php if ($data->user_type == 0) echo 'selected'; ?>>Pending</option>
                                            <option value="1" <?php if ($data->user_type == 1 && $data->affiliate_status == '0') echo 'selected'; ?>>Seller</option>
                                            <option value="3" <?php if ($data->user_type == 1 && $data->affiliate_status == '1') echo 'selected'; ?>>Affiliate</option>
                                            <option value="2" <?php if ($data->user_type == 2) echo 'selected'; ?>>User</option>
                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">Phone</label>
                                        <input type="text" name="phone" value="<?php echo $data->phone; ?>" class="form-control" placeholder="Phone">
                                    </div>

                                    <div class="form-group">
                                        <label for="address" class="col-form-label">Address</label>
                                        <textarea name="address" id="address" class="form-control" row="20" disabled></textarea>
                                    </div>

                                    <div class="form-group" style="display: {{$data->user_type == 1 && $data->affiliate_status == '1'?'':'none'}};" id="discount_div">
                                        <label class="col-form-label">Discount Coupon Code</label>
                                        <input type="text" name="coupon_code" value="<?php echo $data->coupon_code; ?>" class="form-control" placeholder="Enter Discount Coupon Code">
                                    </div>
                                </div>
                                
                                
                                <div class="col-sm-12 col-md-12 col-lg-12" style="display: {{$data->user_type == 1 && $data->affiliate_status == '1'?'':'none'}};" id="history_div">
                                    <label class="col-form-label">History</label>
                                    <span class="payment_status text-success"></span>
                                    <div class="affiliate-table">
                                        <div class="table-responsive">
                                            <table class="table table-borderless m-0 fixed-header">
                                                <thead>
                                                    <tr>
                                                        <th>Month</th>
                                                        <th>Sales</th>
                                                        <th>Commission Earned</th>
                                                        <th>Paid?</th>
                                                        <th>Rank</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @php $i=0; @endphp
                                                @foreach($dataTableData as $i=>$value)
                                                    @php
                                                    if($value['total_price'] > 10000 && $value['total_price'] < 20000){
                                                        $commission = ($value['total_price'] * 2.5) / 100;
                                                    }elseif($value['total_price'] > 20000 && $value['total_price'] < 50000){
                                                        $commission = ($value['total_price'] * 3) / 100;
                                                    }elseif($value['total_price'] > 50000){
                                                        $commission = ($value['total_price'] * 5) / 100;
                                                    }elseif($value['total_price'] < 1){
                                                        $commission = 0;
                                                    }else{
                                                        $commission = ($value['total_price'] * 2) / 100;
                                                    }
                                                    @endphp
                                                    <tr> 
                                                        <td>{{$value['month']}}</td>
                                                        <td>£{{number_format((float)$value['total_price'], 2, '.', '')}}</td>
                                                        <td class="text-center">£{{number_format((float)$commission, 2, '.', '')}}</td>
                                                        <td>
                                                            <input name="commission_paid[{{$i}}]" type="checkbox" {{$value["paidStatus"]}} class="paid_checkbox" value="yes">
                                                            <input type="hidden" name="month_year[{{$i}}]" value="{{$value['month_year']}}">
                                                            <input type="hidden" name="commission[{{$i}}]" value="{{number_format((float)$commission, 2, '.', '')}}">
                                                        </td>
                                                        <td>{{($value['total_price'] > 0) ? $value['rank']: 0}}</td>
                                                    </tr>
                                                    @php $i++; @endphp
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="buttons text-left mb-0">
                                        <button type="submit" class="btn btn-info">Update</button>
                                        @if($data->user_type == 1 && $data->affiliate_status == '1')
                                        <a href="{{route('affiliates') }}">  <input style="background:#F86A52;border:#F86A52" type=" button" class="btn btn-info" value="Cancel"> </a>
                                        @else
                                        <a href="{{route('vendors') }}">  <input style="background:#F86A52;border:#F86A52" type=" button" class="btn btn-info" value="Cancel"> </a>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <!-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Gender</label>
                                            <select name="gender" class="form-control">
                                                <option
                                                    <?php if (isset($data->gender) && $data->gender == 'male') echo 'selected';
                                                    else ''; ?>
                                                    value="male">Male</option>
                                                <option
                                                    <?php if (isset($data->gender) && $data->gender == 'female') echo 'selected';
                                                    else ''; ?>
                                                    value="female">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="">Select a Status</option>
                                                <option value="1" <?php if ($data->active == 1) echo 'selected'; ?> >Active</option>
                                                <option value="0" <?php if ($data->active == 0) echo 'selected'; ?>>Deactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">User Type</label>
                                            <select name="user_type" class="form-control">
                                                <option value='1' <?php if ($data->user_type == 1) echo 'selected'; ?> > Vendor </option>
                                                <option value="2" <?php if ($data->user_type == 2) echo 'selected'; ?>> User</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Phone Number</label>
                                            <input type="text"
                                                value="@if(isset($data->phone)) {{ $data->phone }} @endif"
                                                class="form-control" placeholder="Enter Phone" name="phone" id="phone">
                                        </div>
                                    </div>
                                </div> -->
                            <!-- <div class="row">

                                    <div class="col-md-6">
                                        <label class="col-form-label d-block">Select Subscription</label>
                                        <div class="custom-control custom-checkbox custom-checkbox-1 d-inline-block mb-3">
                                            <input type="checkbox" class="custom-control-input" id="Yearly">
                                            <label class="custom-control-label" for="Yearly">Yearly Subscription</label>
                                        </div>
                                        <div class="custom-control custom-checkbox custom-checkbox-1 d-inline-block mb-3">
                                            <input type="checkbox" class="custom-control-input" id="Life">
                                            <label class="custom-control-label" for="Life">Life Time</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="form-group">
                                            <label class="col-form-label">Street <i class="tip tippy" data-tippy-size="large" data-tippy-animation="scale" data-tippy-arrow="true" title="Street Name"></i></label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">City <i class="tip tippy" data-tippy-size="large" data-tippy-animation="scale" data-tippy-arrow="true" title="City"></i></label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">State  <i class="tip tippy" data-tippy-size="large" data-tippy-animation="scale" data-tippy-arrow="true" title="State"></i></label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Post Code <i class="tip tippy" data-tippy-size="large" data-tippy-animation="scale" data-tippy-arrow="true" title="Post Code"></i></label>
                                            <input type="number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label">Country <i class="tip tippy" data-tippy-size="large" data-tippy-animation="scale" data-tippy-arrow="true" title="Country"></i></label>
                                            <select class="form-control">
                                                <option>--Select your Country--</option>
                                                <option>United Kingdom</option>
                                                <option>United State</option>
                                                <option>China</option>
                                                <option>Russia</option>
                                                <option>France</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> -->

                        </div>
                        <!-- <div class="panel-footer ">
                                    <button type="submit" class="btn btn-success mr-2 ">Update</button>
                                    <button type="reset"
                                        class="btn btn-outline btn-secondary btn-outline-1x">Cancel</button>
                                </div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>










        {{-- <div class="edit-details-row">
            <div class="column column-1">
                <div class="inner-wrapper">
                    <h3 class="heading">Sellers Profile </h3>
                    <div class="user-avtar">
                        <form action="{{ route('user.image') }}" method="post" enctype="multipart/form-data">
        <div class="image-wrapper">
            <img class="img-fluid" src="{{asset('images/foo.png') }}" alt="">
            <span class="file-upload-btn">
                <i class="uil uil-camera"></i>
                <input type="file" name="image">
            </span>
        </div>

        <input type="submit" value="Change" class="btn btn-info" name="submit" id="submit">
        </form>

    </div>
    <div class="user-details text-center pt-3">
        <h2>{{ $data->first_name }}&nbsp;{{ $data->last_name }}</h2>
        <p><i class="icon-envelope"></i>&nbsp; {{ $data->email }}</p>

    </div>
</div>
</div>
<div class="column column-2">
    <div class="inner-wrapper"></div>
</div>
</div>

</div>
</div> --}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>



<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                //$('#blah')
                $('#user-image-main')
                    .attr('src', e.target.result)
                    .width(300)
                    .height(300);
            };
            //$('#blah').show();
            $('#user-image-main').show();




            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).on('change', '#select_status', function (e) {
        var optionSelected = $("option:selected", this); 
        var valueSelected = this.value;
        if(valueSelected == 3){
            $('#discount_div').show();
            $('#commission_div').show();
            $('#history_div').show();
        }else{
            $('#discount_div').hide();
            $('#commission_div').hide();
            $('#history_div').hide();
        }
    });

    $(document).ready(function() {
        $('#update_form').submit(function(event) {
            $('input[type="checkbox"]:not(:checked)').each(function() {
                $(this).val('no');
            });
        });
    });

    // $(document).ready(function(){


    // $("#remove").click(function(){


    // $.ajax({
    // 	type: 'GET',
    // 	url: '//vimeo.com/api/v2/video/' + video.id + '.json',
    // 	jsonp: 'callback',
    // 	dataType: 'jsonp',
    // 	success: function(data) {
    // 		path = data[0].thumbnail_large;
    // 		create(path);
    // 	}
    // });

    //$("#user-image-main").attr('src', 'http://localhost:8000/admin/images/avatar.png');

    // window.location.href = "http://www.w3schools.com";



    // });


    // });
</script>





@endsection
