@extends('frontend.user.user-masters')
@section('custom-style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    .main_product_card {
        margin: 20px 0;
        padding: 20px 0;
        box-shadow: 0px 1px 79px -58px rgba(0, 0, 0, 0.75);
        -webkit-box-shadow: 0px 1px 79px -58px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 0px 1px 79px -58px rgba(0, 0, 0, 0.75);
        border-radius: 20px;
    }

    .img_part {
        text-align: center;
    }

    .img_part img {
        width: 250px;
        height: 250px;
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
        padding: 10px 25px;
        background-color: rgb(35, 161, 211);
        border: none;
        color: white;
        margin-right: 30px;
        border-radius: 8px;
    }

    .btn_outer .ext:hover {
        background-color: rgb(25, 128, 169);
    }

    .btn_outer .dlt {
        padding: 10px 25px;
        background-color: rgb(255, 59, 59);
        border: none;
        color: white;
        border-radius: 8px;
    }

    .btn_outer .dlt:hover {
        background-color: rgb(211, 44, 44);
    }

    .card_btn h5 {
        text-align: left;
    }

    /* list page */
    .list_img img {
        width: 100px;
        height: 100px;
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

    .social-graph-wrapper {
        text-align: center;
        padding: 1rem 1.25rem 0.2rem 1.25rem;
        position: relative;
        color: #fff;
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
    }

    .social-graph-wrapper .s-icon {
        font-size: 1.5rem;
        position: relative;
        padding: 0 0.625rem;
        color: black;
    }

    .social-graph-wrapper img {
        width: 150px;
        height: 150px;
    }

    .billing_card_head {
        font-size: 24px;
    }

    .billing_card_p {
        font-weight: 400;
        font-size: 13px;
        text-align: end;
    }

    .billing_card_h6 {
        font-weight: 500;
        font-size: 14px;
    }

    .billing_card_h3 {
        font-size: 20px;
    }

    .disabled {
        color: lightgrey;
    }

    @media screen and (max-width:768px) {
        .billing_card_h3 {
            font-size: 14px;
        }
    }
</style>
@endsection
@section('user-content')
<div class="column content px-2">
    <div class="tabs-wrapper orders-tabs">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one">
                <div class="row">
                    <div class="col-lg-11 col-12 mx-auto">
                        <div class="card card1 overflow-hidden p-4" style="position:relative">
                            <div style="position:absolute;">
                                <a href="{{url('dashboard/orders')}}">
                                    <i class="fa fa-times" style="color:black" aria-hidden="true"></i>
                                </a>
                            </div>
                            <div>
                                <h3 class="text-center billing_card_h3">Order Details</h3>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="pt-2 pb-3 ps-0 pe-0 text-center">
                                        <h4 class="m-0 billing_card_h3" style="font-size:16px">Order Date: <span class="counter text-muted">{{ date_format($data->created_at,'d-M-Y') }}</span></h4>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="pt-2 pb-3 ps-0 pe-0 text-center">
                                        <h4 class="m-0 billing_card_h3" style="font-size:16px">Order Time: <span class="counter text-muted">{{ date_format($data->created_at,'H:i') }}</span></h4>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="pt-3 pb-3 ps-0 pe-0 text-center">
                                        <h4 class="m-0 billing_card_h3" style="font-size:16px">Order# <span style="padding: 2px; font-weight:bold">{{$data->reference }}</span> <span class="counter text-muted"> is
                                                currently </span> <span style="padding: 2px; font-weight:bold">{{ucwords($data->status)}}</span>
                                        </h4>
                                    </div>
                                </div>
                            </div>

                            @php
                            foreach ($data['order_detail'] as $orderDetail) {
                            $productData = App\Models\Product::where('id',$orderDetail->product_id)->first();
                            $brandName = App\Models\Brand::where('id' ,$productData->brand_id)->pluck('brand_name')->first();
                            $sizeId = App\Models\ProductSize::where('product_id',$orderDetail->product_id)->pluck('size_id')->first();
                            $size = App\Models\Size::where('id',$sizeId)->pluck('size')->first();
                            $shopCategoryName = App\Models\ShopCategory::where('id',$productData->shop_category_id)->pluck('shop_cat_name')->first();
                            $totalPrice = App\Models\Order::where('id' , $orderDetail->order_id)->pluck('total_price')->first();
                            $paymentInformation = App\Models\BankInformation::where('order_id' , $id)->where('vendor_id' , auth()->user()->id)->first();
                            }
                            @endphp

                            <div class="social-graph-wrapper">
                                <img src="{{asset('assets/images/products/'.$productData->feature_image)}}" alt="Product Image">
                            </div>
                            <div class=" text-center">
                                <i class="fa fa-long-arrow-left disabled" aria-hidden="true"></i>
                                <span>1</span>/ <span>20</span>
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                            </div>
                            <div class="row ">
                                <div class="col-12 border-end">
                                    <div class="pt-3 pb-3 ps-0 pe-0 text-center">
                                        <h6 class="m-1">{{$brandName ?? 'N\A'}}</h6>
                                        <h4 class="m-0">{{$productData->product_name ?? 'N\A'}}</h4>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="pt-3 pb-3 ps-0 pe-0 text-center">
                                        <p class="m-0 font-weight-bold">Price</p>
                                        <p class="m-1 text-muted"><span class="counter">£{{number_format($totalPrice , 2) ?? 'N\A'}}</span></p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="pt-3 pb-3 ps-0 pe-0 text-center">
                                        <p class="m-0 font-weight-bold">Size</p>
                                        <p class="m-1 text-muted"><span class="counter">{{$size ?? 'N\A'}}</span></p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="pt-3 pb-3 ps-0 pe-0 text-center">
                                        <p class="m-0 font-weight-bold">Gender</p>
                                        <p class="m-1 text-muted">
                                            <span class="counter">
                                                @if ($productData->gender == 1)
                                                Menswear
                                                @elseif ($productData->gender == 2)
                                                Womenswear
                                                @else
                                                Children
                                                @endif
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="pt-3 pb-3 ps-0 pe-0 text-center">
                                        <p class="m-0 font-weight-bold">Category</p>
                                        <p class="m-1 text-muted"><span class="counter">{{$shopCategoryName ?? 'N\A'}}</span></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="pt-3 pb-3 ps-0 pe-0 text-center">
                                        <p class="m-0 font-weight-bold">SKU</p>
                                        <p class="m-1 text-muted"><span class="counter">{{$productData->sku ?? 'N\A'}}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @php
                    $sub_total = 0;
                    @endphp
                    <div class="col-lg-11 col-12 mx-auto pt-5">
                        <div class="card card1 ">
                            <div class="card-body">
                                <h2 class="billing_card_head">Payment Details</h2>
                                <ul class="list-group mb-3 mt-3">
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0 billing_card_h6">Payment Details</h6>
                                        </div>
                                        <span class="text-muted billing_card_p">
                                            @if(isset($paymentInformation->card_number))
                                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 496 496" xml:space="preserve" style="width: 25px; margin-right:4px;">
                                                <path id="SVGCleanerId_0" style="fill:#12DB55;" d="M496,379.6c0,9.6-7.2,16.8-16.8,16.8H16.8c-9.6,0-16.8-7.2-16.8-16.8v-264
	                                                c0-9.6,7.2-16.8,16.8-16.8h462.4c9.6,0,16.8,7.2,16.8,16.8L496,379.6L496,379.6z" />
                                                <g>
                                                    <path id="SVGCleanerId_0_1_" style="fill:#12DB55;" d="M496,379.6c0,9.6-7.2,16.8-16.8,16.8H16.8c-9.6,0-16.8-7.2-16.8-16.8v-264
		                                                c0-9.6,7.2-16.8,16.8-16.8h462.4c9.6,0,16.8,7.2,16.8,16.8L496,379.6L496,379.6z" />
                                                </g>
                                                <path style="fill:#0AC945;" d="M0,115.6c0-9.6,7.2-16.8,16.8-16.8h462.4c9.6,0,16.8,7.2,16.8,16.8v264.8c0,9.6-7.2,16.8-16.8,16.8" />
                                                <rect y="118.8" style="fill:#334449;" width="496" height="96.8" />
                                                <polygon points="170.4,215.6 496,215.6 496,118.8 5.6,118.8 " />
                                                <path style="fill:#0CC69A;" d="M496,379.6c0,9.6-7.2,16.8-16.8,16.8H16.8c-9.6,0-16.8-7.2-16.8-16.8" />
                                                <path style="fill:#0BAF84;" d="M479.2,396.4c9.6,0,16.8-7.2,16.8-16.8h-44.8L479.2,396.4z" />
                                                <g>
                                                    <path style="fill:#D4F9ED;" d="M177.6,264.4c0,3.2-2.4,5.6-5.6,5.6H52.8c-3.2,0-5.6-2.4-5.6-5.6l0,0c0-3.2,2.4-5.6,5.6-5.6H172
		                                                C175.2,258.8,177.6,261.2,177.6,264.4L177.6,264.4z" />
                                                    <path style="fill:#D4F9ED;" d="M177.6,293.2c0,3.2-2.4,5.6-5.6,5.6H52.8c-3.2,0-5.6-2.4-5.6-5.6l0,0c0.8-3.2,3.2-5.6,5.6-5.6H172
		                                                C175.2,287.6,177.6,290,177.6,293.2L177.6,293.2z" />
                                                    <path style="fill:#D4F9ED;" d="M154.4,322c0,3.2-2.4,5.6-5.6,5.6h-96c-2.4,0-4.8-2.4-4.8-5.6l0,0c0-3.2,2.4-5.6,5.6-5.6h96
		                                                C152,317.2,154.4,319.6,154.4,322L154.4,322z" />
                                                </g>
                                                <circle style="fill:#FFBC00;" cx="360" cy="300.4" r="60" />
                                                <path style="fill:#FFAA00;" d="M360,240.4c-30.4,0-55.2,22.4-60,51.2l96.8,56.8c14.4-11.2,23.2-28,23.2-48
	                                                C420.8,266.8,393.6,240.4,360,240.4z" />
                                                <path style="fill:#F7B208;" d="M360,240.4c33.6,0,60,27.2,60,60s-27.2,60-60,60" />
                                                <g>
                                                    <circle style="fill:#F20A41;" cx="408" cy="300.4" r="60" />
                                                    <circle style="fill:#F20A41;" cx="408" cy="300.4" r="60" />
                                                </g>
                                                <path style="fill:#E00040;" d="M408,361.2c-33.6,0-60-27.2-60-60s27.2-60,60-60" />
                                                <path style="fill:#F97803;" d="M384,245.2c-21.6,9.6-36,30.4-36,55.2s15.2,46.4,36,55.2c21.6-9.6,36-30.4,36-55.2
	                                                S405.6,254,384,245.2z" />
                                                <path style="fill:#F76806;" d="M384,355.6c21.6-9.6,36-30.4,36-55.2s-15.2-46.4-36-55.2" />
                                            </svg>
                                            @else
                                            @endif {{ isset($paymentInformation->card_number) ? '**** **** **** ' . substr($paymentInformation->card_number, -4) : 'Other Method' }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0 billing_card_h6">SubTotal</h6>
                                        </div>
                                        <span class="text-muted billing_card_p">£{{number_format(abs(($sub_total + $data->shipping + $data->processing) - $data->total_price), 2)}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0 billing_card_h6">Shipping</h6>
                                        </div>
                                        <span class="text-muted billing_card_p">£{{ number_format($data->shipping, 2) }} </span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0 billing_card_h6">Processing</h6>
                                        </div>
                                        <span class="text-muted billing_card_p">£{{ number_format($data->processing, 2) }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0 billing_card_h6">Discount</h6>
                                        </div>
                                        <span class="text-muted billing_card_p">£{{number_format(($sub_total), 2)}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed pt-4">
                                        <div>
                                            <h6 class="my-0 billing_card_h6">Total</h6>
                                        </div>
                                        <span class="text-muted billing_card_p">£{{ number_format($data->total_price, 2) }} </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-11 col-12 mx-auto pt-5">
                        <div class="card card1 ">
                            <div class="card-body">
                                <ul class="list-group mb-3 mt-3">
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <h3 class="my-0 billing_card_h3">Billing Information</h3>
                                        <div>
                                            <!-- <h3 class="my-0 billing_card_h3">x</h3> -->
                                        </div>
                                        <h3 class="billing_card_h3">Shipping Information</h3>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <span class="text-muted  billing_card_p">{{$billing->street_address ?? ""}}</span>
                                        <div>
                                            <h6 class="my-0 billing_card_h6">Address Line 1</h6>
                                        </div>
                                        <span class="text-muted billing_card_p">{{$billing->street_address ?? ""}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed"><span class="text-muted billing_card_p"> {{$billing->appartment_address ?? "N\A"}}</span>
                                        <div>
                                            <h6 class="my-0 billing_card_h6">Address Line 2</h6>
                                        </div>
                                        <span class="text-muted billing_card_p"> {{$billing->appartment_address ?? "N\A"}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <span class="text-muted billing_card_p">{{$billing->city ?? ""}}</span>
                                        <div>
                                            <h6 class="my-0 billing_card_h6">City/Town</h6>
                                        </div>
                                        <span class="text-muted billing_card_p">{{$billing->city ?? ""}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <span class="text-muted billing_card_p">{{$billing->state ?? "N\A"}}</span>
                                        <div>
                                            <h6 class="my-0 billing_card_h6">County</h6>
                                        </div>
                                        <span class="text-muted billing_card_p">{{$billing->state ?? "N\A"}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <span class="text-muted billing_card_p">{{$billing->post_code ?? ""}}</span>
                                        <div>
                                            <h6 class="my-0 billing_card_h6">Post Code</h6>
                                        </div>
                                        <span class="text-muted billing_card_p">{{$billing->post_code ?? ""}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <span class="text-muted billing_card_p">{{$billing->country ?? ""}}</span>
                                        <div>
                                            <h6 class="my-0 billing_card_h6">Country</h6>
                                        </div>
                                        <span class="text-muted billing_card_p">{{$billing->country ?? ""}}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed ">
                                        <span class="text-muted billing_card_p">{{$billing->phone ?? ""}}</span>
                                        <div>
                                            <h6 class="my-0 billing_card_h6">Contact Number</h6>
                                        </div>
                                        <span class="text-muted billing_card_p">{{$billing->phone ?? ""}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection