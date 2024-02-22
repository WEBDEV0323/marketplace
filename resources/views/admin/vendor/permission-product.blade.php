



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
            <div class="alert-text update_message_successfully before_page">
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

                        <h5 class="main-heading">Product Image</h5>
                        <div class="user-avtar">
                            {{-- <form action="{{ route('user.editimage') }}" method="post" enctype="multipart/form-data">

                            @csrf --}}


                            <form action="{{ route('seller.edit') }}" method="post" enctype="multipart/form-data">

                                @csrf
                                <div class="img-box">
                                    <div>
                                    
                                    @if(strlen($product->feature_image)>0)
                                    <img src="{{url('/')}}/storage/seller-product/{{$product->id}}/{{$product->feature_image}}" id="user-image-main" class="img-fluid">
                                    @else    
                                   @endif                        
                                    </div>
                                   
                                </div>

                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <div class="buttons">
                                  
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
                       
                    </div>
                    <div class="panel-body">


                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="form-body">

                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Selling Price</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">£</span>
                                            </div>
                                            <input type="text" name="sale_price"  class="form-control" placeholder="Selling Price" value="{{number_format((float)$data->sale_price, 2, '.', '')  ?? ""}}">
                                        </div>
                                        
                                    </div>
                                  
                                    
                                    
                                </div>


                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label">SKU</label>
                                       

                                        <input type="text" name="sku" value="{{$parent->sku ?? ""}}" disabled class="form-control" placeholder="SKU">


                                    
                                    </div>
                                   
                                </div>             



                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label">Status</label>                                      
                                        <select id="purchase" name="status" class="form-control">
												<option @if($product->flags==1) selected @endif value="1">Active</option>
												<option @if($product->flags==1) @else selected @endif value="0">Non-Active</option>
											</select>
                                     </div>                                   
                                </div>

                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label class="col-form-label">New / Pre-Loved</label> 
                                        @if($product->product_type == 1)   
                                            <input type="text"  value="New" disabled class="form-control"> 
                                        @else
                                        <input type="text"  value="Pre-Loved" disabled class="form-control">
                                        @endif                                 
                                       
                                     </div>                                   
                                </div>  


                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="buttons text-left mb-0">
                                        <button type="submit" class="btn btn-info">Update</button>
                                        <a href="{{route("vendors") }}">  <input style="background:#F86A52;border:#F86A52" type=" button" class="btn btn-info" value="Cancel"> </a>
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

    $(document).ready(function(){       
        setTimeout(() => {
                pageUpdateAfterGoPrevUrl();
        }, 1500);

    })
function pageUpdateAfterGoPrevUrl(){
        if($(".update_message_successfully").hasClass('before_page')){            
            window.location.href = "{{ route('dashboard.vendors_products')}}";
        }
    }
    
</script>





@endsection