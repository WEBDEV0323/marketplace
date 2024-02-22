@extends('frontend.user.user-masters')
@section('custom-style')
<style>
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
@endsection
@section('user-content')
<div class="column content px-2">
    <div class="tabs-wrapper orders-tabs">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one">
                @if ($vendor_products)
                @foreach ($vendor_products as $vendor_product)
                <div class="row pr-1">
                    <div class=" col-11 mx-auto mt-3">
                        <div class="card1 overflow-hidden py-2">
                            <div class="row">
                                <div class="col-md-4 align-items-center justify-content-center d-flex">
                                    <div class="social-graph-wrapper text-center">
                                        <img src="{{ asset('assets/images/products/'.$vendor_product->feature_image) }}"
                                            alt="Image">
                                        @php
                                        $brand_name = App\Models\Brand::where('id' ,
                                        $vendor_product->brand_id)->pluck('brand_name')->first();
                                        @endphp
                                        <h5 class="mt-3">{{$brand_name}}</h5>
                                    </div>
                                </div>

                                <div class="col-md-8 row">
                                    <div class="col-12 border-end">
                                        <div class="py-2 ps-0 pe-0 text-center">
                                            <p class="font-weight-bold m-0">Product Name</p>
                                            <p class="m-1">
                                                {{$vendor_product->product_name ?? ""}}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-6">

                                        <div class="py-2 ps-0 pe-0 text-center">
                                            <p class="font-weight-bold m-0">Size</p>

                                            <p class="m-1">
                                                {{$vendor_product->size ?? ""}}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="py-2 ps-0 pe-0 text-center">
                                            <p class="font-weight-bold m-0">Sold On</p>

                                            <p class="m-1">
                                                <span
                                                    class="counter">{{Carbon\Carbon::parse($vendor_product->order_date)->format('d-m-Y
                                                    H:i')}}</span>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="py-2 ps-0 pe-0 text-center">
                                            <p class="font-weight-bold m-0">Selling Price</p>

                                            <p class="m-1">
                                                <span
                                                    class="counter">£{{number_format($vendor_product->selling_price,2)}}</span>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="py-2 ps-0 pe-0 text-center">
                                            <p class="font-weight-bold m-0">Payout Amount</p>

                                            <p class="m-1">
                                                <span class="counter">£{{number_format($vendor_product->selling_price -
                                                    $vendor_product->selling_price* 7.5/100,2)}}</span>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-6 m-auto">
                                        <div class="py-2 ps-0 pe-0 text-center">
                                            <p class="font-weight-bold m-0">Status</p>

                                            <p class="m-1">
                                                @if ($vendor_product->status == 'processing')
                                                <span class="badge badge-danger ">{{ $vendor_product->status }}</span>
                                                @elseif($vendor_product->status == 'completed')
                                                <span class="badge badge-success ">{{ $vendor_product->status }}</span>
                                                @elseif($vendor_product->status == 'refunded')
                                                <span class="badge badge-warning ">{{ $vendor_product->status }}</span>
                                                @elseif($vendor_product->status == 'cancelled')
                                                <span class="badge badge-info ">{{ $vendor_product->status }}</span>
                                                @elseif($vendor_product->status == 'onhold')
                                                <span class="badge badge-primary ">{{ $vendor_product->status }}</span>
                                                @endif
                                            </p>
                                        </div>
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
                        No order has been made yet.
                    </p>
                    <a href="#" class="btn blue-button-outline">Browse products</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection