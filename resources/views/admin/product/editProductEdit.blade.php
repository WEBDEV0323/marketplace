@extends('layouts.admin.master')
@section('styles')
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

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
    <?php $parent_id = 0; ?>
    <!-- Page Body -->
    <div class="page-body">
        <div class="panel-title">

        </div>
        <div class="row update-product">

            <div class="col-12">
                <div class="panel panel-default border-none">
                    <div class="panel-head">

                    </div>
                    <div class="panel-body">
                        <form action="{{route('product.edit.process')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Brand Name</label>
                                        <select name="brand" class="custom-select mb-2 mr-sm-2 mb-sm-0" readonly>

                                            @if(isset($brands))
                                            @foreach($brands as $brand)
                                            @if($product['brand_id']==$brand['id'])
                                            <option selected value="{{$brand['id']}}">{{$brand['brand_name']}}</option>
                                            @else
                                            <option value="{{$brand['id']}}">{{$brand['brand_name']}}</option>
                                            @endif

                                            @endforeach
                                            @endif

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Gender</label>
                                        <select id="categories" name="categories" class="custom-select mb-2 mr-sm-2 mb-sm-0" onchange="getcat(this.value);" readonly>
                                            @if(isset($categories))
                                            @foreach($list_gender as $category)
                                            @if($product['gender']==$category->id)
                                            <option selected value="{{$category->id}}">{{$category->shop_cat_name}}</option>
                                            @else
                                            <option value="{{$category->id}}">{{$category->shop_cat_name}}</option>
                                            @endif
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Category</label>
                                        <select id="shop_cat_id" name="shop_category" class="custom-select mb-2 mr-sm-2 mb-sm-0" readonly>

                                            @foreach($categories as $category)
                                            @if($category->parent_id != 0)
                                            @if(isset($product['shop_category']['id']) && $product['shop_category']['id'] == $category->id)
                                            <option value="{{$category->id}}" selected>{{$category->shop_cat_name}}</option>
                                            @else
                                            <option value="{{$category->id}}">{{$category->shop_cat_name}}</option>
                                            @endif
                                            @endif

                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input type="text" value="{{$product['product_name']}}" name="product_name" placeholder="Enter Product Name">
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label>PID</label>
                                        <input type="text" value = "{{$product['pid']}}" name = "pid" placeholder="Enter Product Name">
                            </div>
                    </div> --}}

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" style="width:100%">{{$product['product_description']}}</textarea>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>SKU</label>
                            <input type="text" value="{{$product['sku']}}" name="sku" placeholder="Enter SKU" readonly>
                        </div>
                    </div>



                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Selling Price</label>
                            <input type="text" value="{{$product['regular_price']}}" name="regular_price" placeholder="Enter Selling price">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Unit Price</label>
                            <input type="text" value="{{$product['unit_price']}}" name="unit_price" onkeypress="return isNumberKey(event)" placeholder="Enter PID Value">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sale Price</label>
                            <input type="text" value="{{$product['sale_price']}}" name="sale_price" placeholder="Enter sale price">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label" for="">Status</label>
                            <select name="status" class="custom-select mb-2 mr-sm-2 mb-sm-0">

                                <option value="1" @if($product['active']==1) selected @endif> Active</option>
                                <option value="0" @if($product['active']==0) selected @endif> Deactive</option>


                            </select>
                        </div>
                    </div>

                    <div class="col-md-6"> </div>

                    <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Weight</label>
                                        <input type="number" value = "{{$product['weight']}}" name = "weight"  placeholder="Enter weight">
                                    </div>
                                </div> -->

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Feature Image</label>
                            <input type="file" name="feature_image" class="btn " onchange="readURL(this);" style="height:0%;">
                            <div class="imges-wrapper">
                                <div class="img-box">
                                    <img id="blah" src="<?php echo $product['image_url']; ?>" alt="your image" />
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Multiple Images of Product</label>
                            <input multiple id="files11" type="file" name="multi_images[]" class="btn" style="height:0%;">

                            @if(count($product["multi_images"])==0)
                            <div id="myImg" class="imges-wrapper">
                                <div class="img-box">
                                    <img src="" alt="">
                                </div>
                                <div class="img-box">
                                    <img src="" alt="">
                                </div>
                                <div class="img-box">
                                    <img src="" alt="">
                                </div>
                            </div>

                            @else
                            <div id="myImg" class="imges-wrapper">
                                @foreach($product["multi_images"] as $key=>$im)



                                <div class="img-box">
                                    <img src="{{$im["image_multi_url"] ?? ""}}" alt="">
                                </div>


                                @endforeach
                            </div>

                            @endif
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <div id = 'size'>
                                @foreach($categorysize as $key => $category_size)
                                <div class="custom-control custom-checkbox custom-checkbox-1 d-inline-block mb-3 col-md-4" style="float: left;">

                                    <?php 
                                         $psize =\App\Models\ProductSize::where("product_id",$product['id'])->where('size_id',$category_size->id)->first(); 
                                         $checkboxcheck = "";   
                                         if($psize){
                                                $quantity = $psize->quantity;
                                                $checkboxcheck = "checked"; 
                                            }else{
                                                $quantity = 0; 
                                            }
                                        // $quantity = $product['prod_size'][$key]['quantity'] ?? 0;                                        
                                        ?>

                                        {{-- <input type="checkbox" name="category_size_id[{{$category_size->id}}]" value="{{$category_size->id}}" class="custom-control-input" id="{{$category_size->id}}" <?php // if ($quantity > 0) echo 'checked'; ?>> --}}
                                        <input type="checkbox" name="size_id[{{$category_size->id}}]" value="{{$category_size->id}}" class="custom-control-input" id="{{$category_size->id}}" <?php echo $checkboxcheck; ?>>

                                        <label class="custom-control-label" for="{{$category_size->id}}">{{$category_size->size}}</label>

                                        {{-- <input type="hidden" name="size_id[{{$category_size->id ?? '' }}]" value="{{$category_size->id ?? '' }}"> --}}

                                        <input class="form-control" type="text" value="{{$quantity}}" name="category_size_quantity[{{$category_size->id}}]" placeholder="Please Enter Stock this size {{$category_size->size}} ">
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                </div>

                <div class="buttons text-left mb-0">
                    <button type="submit" class="btn btn-primary ">Submit</button>

                   @if(isset($re["cat_id"]))
                    <a href="{{route('product-catgory',$re["cat_id"])}}?brand_slug={{$re["brand_id"]}}"> <button type="button" class="btn btn-danger">Cancel</button></a>
                    @else
                    <a href="{{route('product-catgory',$product["shop_category_id"])}}?brand_slug={{$product["brand_id"]}}"> <button type="button" class="btn btn-danger">Cancel</button></a>
                @endif
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

<script language=Javascript>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31 &&
            (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
</script>


<script>
    //     $(document).ready(function(){
    //         $('#categories').on('change', function() {
    //             $.ajax({
    //                 url: '{{url("dashboard/shop/cat/value")}}',
    //                 data: {id:this.value},
    //                 type: "GET",
    //                 headers: {
    //                     'X-CSRF-Token': '{{ csrf_token() }}',
    //                 },
    //                 success: function(data){
    //                   var len = data.length;
    //                   $("#shop_cat_id").empty();
    //                   for( var i = 0; i<len; i++){
    //                     var id = data[i]['id'];
    //                     var name = data[i]['shop_cat_name'];
    //                     console.log(+ ' '+ name );
    //                     $('#shop_cat_id').append('<option value="'+id+'">'+name+'</option>');
    //                  }

    //                    //
    //                 },
    //                 error: function(){
    //                     alert("failure From php side!!! ");
    //                 }

    //                 });
    //             });


    // });
</script>

<script>
    CKEDITOR.replace('description');

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah')
                    .attr('src', e.target.result);
            };
            $('#blah').show();

            reader.readAsDataURL(input.files[0]);
        }
    }


    $(function() {
        $("#files11").change(function() {



            $('#myImg').html('');
            var html = "";
            if (this.files && this.files[0]) {
                for (var i = 0; i < this.files.length; i++) {

                    console.log(this.files[i]);
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
        html += '<img src="' + e.target.result + '" >';
        html += '</div>';


        $('#myImg').append(html);

    };

    function getcat(id) {
        $.ajax({
            url: "{{ route('ord') }}",
            method: 'get',
            data: {

                id: id,


            },
            success: function(result) {

                var cate = JSON.parse(result);
                $('#shop_cat_id').empty();

                $.each(cate, function(i, item) {
                    $('#shop_cat_id').append($('<option>', {
                        value: item.id,
                        text: item.shop_cat_name
                    }));
                });

            }
        });

    }
</script>
@endsection
