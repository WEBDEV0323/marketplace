<?php


use App\Models\Size;
use App\Models\Brand;

?>
@extends('frontend.user.user-masters')
@section('custom-style')
<style>
    .main_product_card {
        margin: 20px 0;
        padding: 20px 0;
        /* background-color: rgba(245, 238, 238, 0.902); */
        box-shadow: 0px 1px 79px -58px rgba(0, 0, 0, 0.75);
        -webkit-box-shadow: 0px 1px 79px -58px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 0px 1px 79px -58px rgba(0, 0, 0, 0.75);
        border-radius: 20px;
    }

    .orders-tabs p {
        font-size: 19px !important
    }

    .img_part {
        text-align: center;
    }

    .img_part img {
        width: 200px;
        height: 200px;
    }

    .img_intro {
        text-align: center;
        padding: 20px 0;
    }

    .img_intro h5,
    .img_intro h3 {
        margin: 0;
        text-align: center;
    }

    .btn_outer {
        display: flex;
        justify-content: center;
        padding: 30px 0;
    }

    .btn_outer .ext {
        padding: 5px 20px;
        background-color: #00a9ec;
        border: none;
        color: white;
        margin-right: 30px;
        border-radius: 8px;
        cursor: pointer;
    }

    .btn_outer .ext:hover {
        background-color: rgb(25, 128, 169);
    }

    .btn_outer .dlt {
        padding: 5px 20px;
        background-color: rgb(255, 59, 59);
        border: none;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        cursor: pointer;
    }

    .btn_outer .dlt:hover {
        background-color: rgb(211, 44, 44);
    }

    .card_btn h5 {
        text-align: left;
    }

    .side_bar {
        width: 320px;
        /* background-color: gray; */
        box-shadow: 0px 1px 79px -36px rgba(0, 0, 0, 0.75);
        -webkit-box-shadow: 0px 1px 79px -36px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 0px 1px 79px -36px rgba(0, 0, 0, 0.75);
        background-color: white;
        position: fixed;
        right: -320px;
        top: 0;
        bottom: 0;
        overflow: hidden;
        transition: 1s;
        overflow-y: auto;
        z-index: 999999;
    }

    .sidebar_top {
        height: 50px;
        width: 100%;
        /* background-color: lightblue; */
        position: relative;
    }

    .sidebar_top .left {
        position: absolute;
        left: 10px;
        top: 12px;
    }

    .left button {
        border: none;
        background-color: black;
        border-radius: 5px;
    }

    .card1 {
        margin-bottom: 1.875rem;
        background-color: #fff;
        transition: all .5s ease-in-out;
        position: relative;
        border: 0rem solid transparent;
        border-radius: 1.25rem;
        box-shadow: 0rem 0.3125rem 0.3125rem 0rem rgba(82, 63, 105, 0.05);
        height: calc(100% - 30px);
        box-shadow: rgba(0, 0, 0, 1.75) 0px 1px 13px -9px;
        -webkit-box-shadow: rgba(0, 0, 0, 1.75) 0px 1px 13px -9px;
        -moz-box-shadow: rgba(0, 0, 0, 1.75) 0px 1px 13px -9px;
    }

    .btn-primary,
    .btn-primary:hover {
        background-color: #00a9ec;
    }

    .social-graph-wrapper .s-icon {
        font-size: 1.5rem;
        position: relative;
        padding: 0 0.625rem;
        color: black;
    }

    .social-graph-wrapper img {
        width: 100%;
        max-width: 150px;
        height: auto;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@endsection
@section('user-content')
<div class="column content px-2">
    <div class="tabs-wrapper orders-tabs">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one">
                @if (!$vendor_products->isEmpty())
                @foreach ($vendor_products as $vendor_product)
                @php
                $brand = 0;
                $b = App\Models\Brand::where("id", $vendor_product->product_parent->brand_id)->first();
                $product_types =\App\Models\Product::where("id",$vendor_product->id)->first();
                @endphp
                <div class="row">
                    <div class="col-lg-11 mx-auto col-12 mt-3">
                        <div class="card1 overflow-hidden py-2">
                            <div class="row">
                                <div class="col-md-3 align-items-center justify-content-center d-flex">
                                    <div class="social-graph-wrapper text-center">
                                        @if($product_types->product_type == 2)
                                        <img id="getImage-{{$vendor_product->id}}" src="{{url('/')}}/storage/seller-product/{{$vendor_product->id ?? ''}}/{{$vendor_product->feature_image ?? ''}}" alt="">
                                        @else
                                        @php
                                        $parent=\App\Models\Product::where("id",$vendor_product->parent_id)->first();
                                        @endphp
                                        <img id="getImage-{{$vendor_product->id}}" src="{{ url('/').'/storage/product/'.$parent->id.'/'.$parent->feature_image;}}" alt="">
                                        @endif
                                        <h5 class="mt-2">{{$b->brand_name ?? ""}}</h5>
                                    </div>
                                </div>

                                <div class="col-md-9 row">
                                    <div class="col-12 border-end">
                                        <div class="py-2 ps-0 pe-0 text-center">
                                            <p class="font-weight-bold m-0 for_all">Product Name</p>

                                            <p class="m-1 for_all">
                                                {{$vendor_product->product_parent->product_name ?? ""}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="py-2 ps-0 pe-0 text-center">
                                            <p class="font-weight-bold m-0 for_all">Selling Price</p>
                                            <p class="m-1 for_all">
                                                <span class="counter">£{{number_format((float)$vendor_product->sale_price , 2)}}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="py-2 ps-0 pe-0 text-center">
                                            <p class="font-weight-bold m-0 for_all">Size</p>

                                            <p class="m-1 for_all">
                                                @if(count($vendor_product->prod_size)>1)
                                                Multiple
                                                @else
                                                @if(isset($vendor_product->prod_size[0]->size_id) && (int)$vendor_product->prod_size[0]->size_id>0)
                                                @php
                                                $size = Size::where("id", $vendor_product->prod_size[0]->size_id)->first();
                                                if ($size) {
                                                echo $size->size;
                                                }
                                                @endphp
                                                @endif
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="py-2 ps-0 pe-0 text-center">
                                            <p class="font-weight-bold m-0 for_all">Expiry Date</p>

                                            <p class="m-1 for_all">
                                                {{Carbon\Carbon::parse($vendor_product->expiry_date)->format('d-m-Y')}}
                                            </p>
                                        </div>
                                    </div>



                                    @php
                                    if ($vendor_product->pid == 1) {
                                    $gender = 'Menswear';
                                    } elseif ($vendor_product->pid == 2) {
                                    $gender = 'Womenswear';
                                    } else {
                                    $gender = 'Children';
                                    }

                                    if ($vendor_product->product_type == 1) {
                                    $new = 'New';
                                    } else {
                                    $new = 'Pre-Loved';
                                    }

                                    if ($vendor_product->expiry_date <= \Carbon\Carbon::now()->format('Y-m-d')) {
                                        $status = 'Not Live';
                                        } elseif ($vendor_product->draft == 1) {
                                        $status = 'Draft';
                                        } else {
                                        $status = 'Not Approved';
                                        }

                                        $payout = (float)$vendor_product->sale_price - (float)$vendor_product->sale_price * 7.5 / 100 - (float)$vendor_product->shipping;
                                        @endphp

                                        <div class="col-12 text-center">
                                            <form id="delete-form-{{$vendor_product->id}}" action="{{ url('vendors/product/delete') }}" method="POST">
                                                @csrf
                                                <button type="button" onclick='openNav("{{$vendor_product->id}}","{{$b->brand_name}}", "{{url("/")}}/storage/seller-product/{{$vendor_product->id}}/{{$vendor_product->feature_image}}" , "{{$vendor_product->product_parent->product_name}}" , "£{{number_format((float)$vendor_product->sale_price,2)}}" , "£{{number_format($payout, 2)}}" , "{{$size->size}}" , "{{$vendor_product->shop_category->shop_cat_name}}" , "{{$gender}}" , "{{$new}}" , "{{$status}}" , "{{Carbon\Carbon::parse($vendor_product->expiry_date)->format("d-m-Y")}}"); document.getElementById("p_img").src = document.getElementById("getImage-{{$vendor_product->id}}").src;' class="btn btn-primary border-0  p-1 tooltip1" data-toggle="tooltip" title="View Detail" style="margin:10px 18px;height: 35px;width: 35px;border-radius:50%" title1="View Detail">
                                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M15 11.64a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                                                        <path d="M2.4 11.64S6 5.04 12 5.04s9.6 6.6 9.6 6.6-3.6 6.6-9.6 6.6-9.6-6.6-9.6-6.6Zm9.6 4.2a4.2 4.2 0 1 0 0-8.4 4.2 4.2 0 0 0 0 8.4Z">
                                                        </path>
                                                    </svg>
                                                </button>

                                                <input type="hidden" name="id" value="{{ $vendor_product->id }}">
                                                <button type="button" class="btn btn-danger border-0 p-1 tooltip1 delete-btn" data-toggle="tooltip" title="Delete" style="margin: 10px 18px; height: 35px; width: 35px; border-radius: 50%" title1="Delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" viewBox="0 0 128 128" width="16px" height="16px">
                                                        <path d="M 49 1 C 47.34 1 46 2.34 46 4 C 46 5.66 47.34 7 49 7 L 79 7 C 80.66 7 82 5.66 82 4 C 82 2.34 80.66 1 79 1 L 49 1 z M 24 15 C 16.83 15 11 20.83 11 28 C 11 35.17 16.83 41 24 41 L 101 41 L 101 104 C 101 113.37 93.37 121 84 121 L 44 121 C 34.63 121 27 113.37 27 104 L 27 52 C 27 50.34 25.66 49 24 49 C 22.34 49 21 50.34 21 52 L 21 104 C 21 116.68 31.32 127 44 127 L 84 127 C 96.68 127 107 116.68 107 104 L 107 40.640625 C 112.72 39.280625 117 34.14 117 28 C 117 20.83 111.17 15 104 15 L 24 15 z M 24 21 L 104 21 C 107.86 21 111 24.14 111 28 C 111 31.86 107.86 35 104 35 L 24 35 C 20.14 35 17 31.86 17 28 C 17 24.14 20.14 21 24 21 z M 50 55 C 48.34 55 47 56.34 47 58 L 47 104 C 47 105.66 48.34 107 50 107 C 51.66 107 53 105.66 53 104 L 53 58 C 53 56.34 51.66 55 50 55 z M 78 55 C 76.34 55 75 56.34 75 58 L 75 104 C 75 105.66 76.34 107 78 107 C 79.66 107 81 105.66 81 104 L 81 58 C 81 56.34 79.66 55 78 55 z" />
                                                    </svg>
                                                </button>
                                            </form>

                                            <script>
                                                $(document).ready(function() {
                                                    $('.delete-btn').click(function() {
                                                        var formId = $(this).closest('form').attr('id');
                                                        var id = $('#' + formId + ' input[name="id"]').val();

                                                        Swal.fire({
                                                            title: 'Are you sure?',
                                                            text: 'You won\'t be able to revert this!',
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#3085d6',
                                                            cancelButtonColor: '#d33',
                                                            confirmButtonText: 'Yes, delete it!'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                $('#' + formId).submit();
                                                            }
                                                        });
                                                    });
                                                });
                                            </script>


                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="no-order">
                    <p>
                        <i class="uil uil-exclamation-triangle"></i>
                        You have no active listings.
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Side Panel Start-->
<div class="side_bar" id="side_bar">
    <div class="top_main bg-primary">
        <div class="sidebar_top">
            <div class="left">
                <button onclick="closeNav()" style="width: 0px; outline: none; border:none;">
                    <i class="fa fa-times ml-2" aria-hidden="true" style="color: white; font-size:18px;cursor: pointer;"></i>
                </button>
            </div>
            <div class="right">
                <h4 class="text-center pt-2 text-white">Detail</h4>
            </div>
        </div>
    </div>
    <!-- side-bar-body -->
    <div class="sidebar_body">
        <div class="row justify-content-end">
            <div class=" col-12">
                <div class="main_product_card">
                    <div class="img_part">
                        <img src="" id="p_img" alt="" srcset="">
                    </div>
                    <div class="img_intro">
                        <input type="hidden" id="s_id">
                        <h5 id="brand" style="color:#00a9ec;text-transform:uppercase;">Brand</h5>
                        <h4 id="f_name">Product Name</h4>
                    </div>
                    <div class="product_more_detail  ">
                        <div class="out row justify-content-center px-3 py-2">
                            <h6 class=" col-6  m-0">Selling Price:</h6>
                            <p class=" col-6   m-0 text-right" id="f_selling">x</p>
                        </div>
                        <div class="out row  justify-content-center px-3 py-2">
                            <h6 class=" col-lg-7 col-6  m-0">Payout Amount:</h6>
                            <p class=" col-lg-5 col-6  m-0 text-right" id="f_payout">x</p>
                        </div>
                    </div>
                    <div class="product_more_detail  ">
                        <div class="out row  justify-content-center px-3 py-2">
                            <h6 class=" col-6  m-0">Size:</h6>
                            <p class=" col-6  m-0 text-right" id="f_size">x</p>
                        </div>
                        <div class="out row  justify-content-center px-3 py-2">
                            <h6 class=" col-lg-5 col-6  m-0">Category:</h6>
                            <p class=" col-lg-7 col-6  m-0 text-right" id="f_category">x</p>
                        </div>
                        <div class="out row  justify-content-center px-3 py-2">
                            <h6 class=" col-6  m-0">Gender:</h6>
                            <p class=" col-6  m-0 text-right" id="f_gender">x</p>
                        </div>
                    </div>
                    <div class="product_more_detail  ">
                        <div class="out row  justify-content-center px-3 py-2">
                            <h6 class=" col-7  m-0">New/Pre-Loved:</h6>
                            <p class=" col-5  m-0 text-right" id="f_pre">x</p>
                        </div>
                        <div class="out row  justify-content-center px-3 py-2">
                            <h6 class=" col-6  m-0">Status:</h6>
                            <p class=" col-6  m-0 text-right" id="f_status">x</p>
                        </div>
                    </div>
                    <div class="product_more_detail  py-2">
                    </div>
                    <div class="product_more_detail  ">
                        <div class="out row  justify-content-center px-3">
                            <h6 class=" col-6  m-0">Expiry Date:</h6>
                            <p class=" col-6  m-0 text-right" id="f_date">......</p>
                        </div>
                    </div>
                    <div class="catd_bot">
                        <div class="card_btn">
                            <div class="btn_outer">
                                <form id="delete-form" action="{{ url('vendors/product/delete') }}" method="POST">
                                    @csrf
                                    <button class="ext" type="button">
                                        Extent
                                    </button>

                                    <input type="hidden" name="id" id="inputValue">
                                    <button type="button" class="dlt">Delete</button>
                                </form>

                                <script>
                                    $(document).ready(function() {
                                        $('.dlt').click(function() {
                                            var formId = $(this).closest('form').attr('id');
                                            var id = $('#s_id').val();

                                            Swal.fire({
                                                title: 'Are you sure?',
                                                text: 'You won\'t be able to revert this!',
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#3085d6',
                                                cancelButtonColor: '#d33',
                                                confirmButtonText: 'Yes, delete it!'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    $('#' + formId).submit();
                                                }
                                            });
                                        });
                                    });
                                </script>
                                {{--
                                <!-- <button class="ext">Extend</button>
                                <a href="{{route('vendor-product-delete',['id' => $vendor_product->id])}}" class="dlt">Delete</a> -->
                                --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Side Panel End-->
<!-- Brand Name , Product Name , Image , Selling Price , Payout Amount , Size , Category , Gender , New , Status , Date -->

@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(document).ready(function() {
        $('#delete-btn').click(function(e) {
            e.preventDefault();
            // var deleteValue = $(this).val();
            // var id = $('#sno').val();
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            });
        });
    });
</script>

<script>
    function openNav(s_id, brand, p_img, pro_name, selling_price, payout_price, size, category, gender, news, status, date) {
        console.log(s_id, brand, p_img, pro_name, selling_price, payout_price, size, category, gender, news, status, date);
        document.getElementById('side_bar').style.right = '0px'
        document.getElementById('s_id').value = s_id;
        document.getElementById('inputValue').value = s_id;
        document.getElementById('brand').innerHTML = brand;
        document.getElementById('f_name').innerHTML = pro_name;
        document.getElementById('f_selling').innerHTML = selling_price;
        document.getElementById('f_payout').innerHTML = payout_price;
        document.getElementById('f_size').innerHTML = size;
        document.getElementById('f_category').innerHTML = category;
        document.getElementById('f_gender').innerHTML = gender;
        document.getElementById('f_pre').innerHTML = news;
        document.getElementById('f_status').innerHTML = status;
        document.getElementById('f_date').innerHTML = date;
    }

    function closeNav() {
        document.getElementById('side_bar').style.right = '-320px'
    }
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.extend_poup_btn', function() {
            var product_id = $(this).data('product_id');
            var product_title = $(this).data('product_title');
            $(".extend_product_id").val(product_id);
            $(".product_name_extedn").html(product_title);
        })
    })
</script>
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection