@extends('layouts.admin.master')
@section('styles')
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="{{ asset('admin/assets/plugin/dropzone/dropzone.min.css') }}" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css"
        rel="stylesheet" />


    @endsection
    @section('body-content')
    <div class="page-wrapper">
        <!-- Page Title -->
        <div class="page-title">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h2 class="page-title-text"></h2>
                </div>
                <div class="col-sm-6 text-right">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li>Dashboard</li>
                            <li>Product</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Body -->
        <div class="page-body">
            <div class="panel-title">
                <span class="panel-title-text"></span>
            </div>
            
            <div class="row add-product">

                <div class="col-12">
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
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="panel panel-default border-0">
                        <div class="panel-head">
                            
                        </div>
                        <div class="panel-body p-0">
                            
                            <form action="{{ route('product.process') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                            <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Brand Name</label>
                                            <select required name="brand" class="custom-select mb-2 mr-sm-2 mb-sm-0">

                                               @if(isset($brands))
                                              @foreach($brands as $brand)
                                              
                                            
                                              
                                              <option value="{{$brand['id']}}">{{$brand['brand_name']}}</option>
                                             

                                              @endforeach
                                              @endif

                                              
                                              
                                              
                                               

                                            </select>
                                        </div>
                                    </div>
                              
                              
                              		
                              <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Gender</label>
                                        <select id="categories" name="categories" class="custom-select mb-2 mr-sm-2 mb-sm-0" onchange="getcat(this.value);" readonly>
                                            @if(isset($list_gender))
                                            @foreach($list_gender as $gender_cat)
                                            @if($gender==$gender_cat->shop_cat_name)
                                           
                                            <option selected value="{{$gender_cat->id}}">{{$gender_cat->shop_cat_name}} </option>
                                            @else
                                            <option value="{{$gender_cat->id}}">{{$gender_cat->shop_cat_name}} </option>
                                            @endif
                                            @endforeach
                                            @endif
                                          
                                          
                                          
                                          
                                          
                                          
                                          
                                          
                                          
                                        </select>
                                    </div>
                                </div>
                              
                              

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-form-label">Select Shop Category </label>
                                            <select id="shop_cat_id" name="shop_category" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                              
                                                @if(isset($categories1))
 
                                                    @foreach($categories1 as $category)
                                                      
                                                            <option value="{{ $category->id }}" selected> {{ $category->shop_cat_name }}
                                                            </option>
                                                    @endforeach
                                                @endif
                                              

                                            </select>
                                        </div>
                                    </div>
                                

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input required type="text" name="product_name" placeholder="Enter Product Name">
                                    </div>
                                </div>
                                    <input type="hidden" name="gender" value="{{$gender}}">
                              {{--  <div class="col-md-6">
                                    <div class="form-group">
                                        <label>PID</label>
                                        <input required type="text" name="pid" placeholder="Enter Product Name">
                                    </div>
                                </div>  --}}
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea required name="description"></textarea>

                                    </div>
                                </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>SKU</label>
                                            <input required type="text" name="sku" placeholder="Enter SKU">

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Selling Price</label>
                                            <input id="selling_price" required onkeypress="return isNumberKey(event)"  type="text" name="regular_price" placeholder="Enter Selling Price">

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Unit Price</label>
                                            <input required onkeypress="return isNumberKey(event)"   type="text" name="unit_price" placeholder="Enter Unit Price">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Sale Price</label>
                                            <input type="text" id="sale_price" onkeypress="return isNumberKey(event)"  name="sale_price" placeholder="Enter Sale Price">

                                        </div>
                                    </div>
                                    
                                    <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Weight (Pounds)</label>
                                            <input min = "1" required type="number" name="weight" placeholder="Enter Weight In Pound">

                                        </div>
                                    </div> -->

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Feature Image</label>
                                            <input required type="file" name="feature_image" class="btn " onchange="readURL(this);" style="height:0%;">
                                            <label for="">Insert Photo</label>
                                            <div class="imges-wrapper">
                                                <div class="img-box" style="position:relative; overflow:hidden;">
                                                    <div class="tag-insert-image" style="text-align:center; font-weight:bold; width:100%; position:absolute; top:25%; left:0; text-transform:uppercase; ">Insert <br> Image <br> Here</div>
                                                    <img id="blah" src=""  />
                                                
                                                
                                                    

                                                
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            
                                            <label for="">Multiple Images of Product</label>
                                            <input multiple type="file" id="files11" name="multi_images[]" class="btn" style="height: 0%;">
                                            
                                            <div  id="myImg" class="imges-wrapper " style="margin-top: 12%; justify-content: space-between;">
                                                <div class="img-box img-box-mutiple" style="position:relative; overflow:hidden;">
                                                    <div style="text-align:center; font-weight:bold; width:100%; position:absolute; top:25%; left:0; text-transform:uppercase; ">Insert <br> Image <br> Here</div>
                                                       
                                                
                                                   
                                                </div>
                                                <div class="img-box img-box-mutiple" style="position:relative; overflow:hidden;">
                                                    <div style="text-align:center; font-weight:bold; width:100%; position:absolute; top:25%; left:0; text-transform:uppercase; ">Insert <br> Image <br> Here</div>
                                                        <img src="" alt="">
                                                    </div>
                                                    <div class="img-box img-box-mutiple" style="overflow: hidden; position : relative;">
                                                    <div style="text-align:center; font-weight:bold; width:100%; position:absolute; top:25%; left:0; text-transform:uppercase; ">Insert <br> Image <br> Here</div>
                                                        <img src="" alt="">
                                                    </div>
                                                
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div id = 'size'>
                                                @foreach($sizes as $key => $category_size)
                                                <div class="custom-control custom-checkbox custom-checkbox-1 d-inline-block mb-3 col-md-4" style="float: left;">
                                                        <input type="checkbox" name="size_id[]" value="{{$category_size->id}}" class="custom-control-input" id="{{$category_size->id}}">

                                                        <label class="custom-control-label" for="{{$category_size->id}}">{{$category_size->size}}</label>


                                                        <input class="form-control" type="text" value="" name="category_size_quantity[{{ $category_size->id }}]" placeholder="Please Enter Stock this size">
                                                </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6"> 
                        </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="buttons text-left">
                                            <button type="submit" class="btn btn-primary ">Submit</button>
                                     <a href="{{route('product-catgory',$category_id )}}?brand_slug={{$brand_id ?? ""}}">   <button type="button" class="btn btn-danger">Cancel</button> </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>
@endsection

@section("scripts")

<script>


// $("#selling_price").change(function(){


//     var s=$("#selling_price").val();
//     $("#sale_price").val(s);

// });



function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }



    $(document).ready(function () {
      
      $.ajax({
        url: "{{ route('shop-cat.value') }}",
        method: 'post',
        data: {
            _token: "{{ csrf_token() }}",
            id: $('#categories').val(), // Assuming you want to send the initial value of #categories
            flags: '1',
        },
        success: function(result) {
            $('#shop_cat_id').html(result);
        }
    });
      
      
      
      
      
      
        $('#categories').on('change', function () {

            $.ajax({
                url: "{{ route('shop-cat.value') }}",
                    method: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: this.value,
                        flags:'1',
                    
                    },
                    success: function(result){
                        $('#shop_cat_id').html(result);
                        //result = JSON.parse(result)
                        
                    }
            });
        });

            var shop_cat_id = $('#shop_cat_id').val();
            $.ajax({
                url: "{{ route('shop-cat.value') }}",
                    method: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: shop_cat_id,
                        flags:'2',
                        admin_size_get:"admin_size_get"                    
                    },
                    success: function(result){
                       ////// $('#size').html(result);
                        //result = JSON.parse(result)
                        
                    }
            });
        CKEDITOR.replace('description');

$(function () {
    $('.selectpicker').selectpicker();
});
    });


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#blah')
                .attr('src', e.target.result);
        };
        $('.tag-insert-image').hide();
        $('#blah').show();


        reader.readAsDataURL(input.files[0]);
    }
}

$(function() {
  $("#files11").change(function() {
    $('#myImg').html('');
   var  html = "";
    if (this.files && this.files[0]) {
      for (var i = 0; i < this.files.length; i++) {
        var reader = new FileReader();
        reader.onload = imageIsLoaded;
        reader.readAsDataURL(this.files[i]);
      }
    }
  });
});

function imageIsLoaded(e) {
  //$('#myImg').append('<img src=' + e.target.result + '>');
   
    html = '<div class="img-box" style="position:relative; overflow:hidden;">';
    html += '<img src="'+e.target.result+'" >';
    html += '</div>';
    $('#myImg').append(html);

};

</script>
@endsection
