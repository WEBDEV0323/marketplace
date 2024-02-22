<?php

use App\Models\Product;
use App\Models\Size;
?>
@extends('frontend.user.new-masters')
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
        cursor: pointer;
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

    /* Footer Code */

    footer {
        background-color: #555;
        padding: 40px 30px 60px;
        text-align: center;
    }

    footer .logo-img {
        width: 100%;
        max-width: 300px;
    }

    footer ul {
        display: flex;
        align-items: center;
        justify-content: space-around;
        flex-wrap: wrap;
        max-width: 650px;
        margin: 0 auto;
    }

    footer ul a {
        color: #f5f5f5;
        font-family: poppins;
        font-weight: 800;
        font-size: 13px;
    }

    footer ul a:hover {
        color: #00a9ec;
    }

    .usefull-links {
        text-align: left;
    }

    .usefull-links ul {
        display: block !important;
    }

    footer h4 {
        color: #FFF !important;
    }

    .copyright-tag {
        color: #FFF;
        font-size: 12px;
        border-top: 1px solid #999;
        padding-top: 12px;
        text-align: center;
        margin-top: 20px;
    }
</style>
@endsection
@section('user-content')
<div class="column content px-2">
    <div class="tabs-wrapper orders-tabs">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one">
                @if (!$orders->isEmpty())
                @foreach ($orders as $order)
                <div class="row">
                    <div class=" col-11 mx-auto mt-3">
                        @php
                        $brandID = App\Models\Product::where('id', $order->details[0]->product_id)->pluck('brand_id')->first();
                        $brandName = App\Models\Brand::where('id' ,$brandID)->pluck('brand_name')->first();
                        $productImage = App\Models\Product::where('id',$order->details[0]->product_id)->pluck('feature_image')->first();
                        @endphp
                        <div onclick="location.href='{{ route('user_order_detail', ['id' => $order->id]) }}'" class="card1 overflow-hidden" data-toggle="tooltip" title="View Detail">
                            <div class="row">
                                <div class="col-md-4 align-items-center justify-content-center d-flex">
                                    <div class="social-graph-wrapper text-center">
                                        <img src="{{ asset('assets/images/products/'.$productImage) }}" alt="Product Image">
                                        <h5 class="mt-3">{{$brandName}}</h5>
                                    </div>
                                </div>
                                <div class="col-md-8 row">
                                    <div class="col-12 border-end">
                                        <div class="py-2 ps-0 pe-0 text-center">
                                            <p class="font-weight-bold m-0">Product Name</p>
                                            <p class="m-1">
                                                @if (count($order->details) > 1)
                                                <span class="counter"> Multiple </span>
                                                @elseif(isset($order->details[0]->id) && $order->details[0]->parent_id
                                                == 0)
                                                <span class="counter"> {{ $order->details[0]->product_name ?? '' }}
                                                </span>
                                                @else
                                                @if (isset($order->details[0]))
                                                <span class="counter"> {{ Product::where('id',
                                                    $order->details[0]->parent_id)->first()->product_name ?? '' }}
                                                </span>
                                                @endif
                                                @endif

                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="py-2 ps-0 pe-0 text-center">
                                            <p class="font-weight-bold m-0">Size</p>
                                            <p class="m-1">
                                                @if (count($order->details) > 1)
                                                <span class="counter">Multiple </span>
                                                @else
                                                @if (isset($order->details[0]))
                                                <span class="counter"> {{ Size::where('id',
                                                    $order->details[0]->size_id)->first()->size ?? '' }} </span>
                                                @endif
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="py-2 ps-0 pe-0 text-center">
                                            <p class="font-weight-bold m-0">Price</p>

                                            <p class="m-1">
                                                <span class="counter">£{{ number_format($order->total_price, 2) }}</span>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="py-2 ps-0 pe-0 text-center">
                                            <p class="m-0 font-weight-bold">Bought on</p>

                                            <p class="m-1">
                                                <span class="counter">{{ date('d/m/Y', strtotime($order->created_at)) ??
                                                    '' }}</span>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="py-2 ps-0 pe-0 text-center">
                                            <p class="m-0 font-weight-bold">Reference</p>

                                            <p class="m-1"><span class="counter">{{ $order->reference }}</span></p>
                                        </div>
                                    </div>

                                    <div class="col-12 mx-auto">
                                        <div class="py-2 ps-0 pe-0 text-center">
                                            <p class="m-0 font-weight-bold">Status</p>

                                            <p class="m-1">
                                                @if ($order->status == 'processing')
                                                <span class="badge badge-danger ">{{ $order->status }}</span>
                                                @elseif($order->status == 'completed')
                                                <span class="badge badge-success ">{{ $order->status }}</span>
                                                @elseif($order->status == 'refunded')
                                                <span class="badge badge-warning ">{{ $order->status }}</span>
                                                @elseif($order->status == 'cancelled')
                                                <span class="badge badge-info ">{{ $order->status }}</span>
                                                @elseif($order->status == 'onhold')
                                                <span class="badge badge-primary ">{{ $order->status }}</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-6 text-center mt-1">

                                        {{-- <a href="{{ route('user_order_detail', ['id' => $order->id]) }}"
                                        class="btn btn-primary border-0 p-1 tooltip1"
                                        style="margin:10px 18px;height: 35px;width: 35px;border-radius:50%"
                                        title1="View Detail">
                                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15 11.64a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                                            <path d="M2.4 11.64S6 5.04 12 5.04s9.6 6.6 9.6 6.6-3.6 6.6-9.6 6.6-9.6-6.6-9.6-6.6Zm9.6 4.2a4.2 4.2 0 1 0 0-8.4 4.2 4.2 0 0 0 0 8.4Z">
                                            </path>
                                        </svg>
                                        </a> --}}

                                        @if ($order->paid == 0)
                                        <a href="{{ route('user_payment', ['id' => $order->id]) }}" class="btn btn-primary  border-0  p-1 tooltip1" data-toggle="tooltip" title="Payment" style="margin:10px 18px;height: 35px;width: 35px;border-radius:50%" title1="Payment">
                                            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <defs>
                                                    <style>
                                                        .cls-1 {
                                                            fill: #dde5e8;
                                                        }

                                                        .cls-2 {
                                                            fill: #00a9ec;
                                                        }

                                                        .cls-3 {
                                                            fill: #afc3c9;
                                                        }

                                                        .cls-4 {
                                                            fill: #fff;
                                                        }

                                                        .cls-5 {
                                                            fill: #fff;
                                                        }
                                                    </style>
                                                </defs>
                                                <title>secure-payment-flat</title>
                                                <path class="cls-1" d="M435.2,140.8V320a64.19,64.19,0,0,1-64,64H64A64.19,64.19,0,0,1,0,320V140.8A65.28,65.28,0,0,1,1.28,128,64.23,64.23,0,0,1,64,76.8H371.2A64.23,64.23,0,0,1,433.92,128,65.28,65.28,0,0,1,435.2,140.8Z" />
                                                <path class="cls-2" d="M435.2,140.8V192H0V140.8A65.28,65.28,0,0,1,1.28,128H433.92A65.28,65.28,0,0,1,435.2,140.8Z" />
                                                <path class="cls-3" d="M153.6,268.8H76.8a12.8,12.8,0,1,1,0-25.6h76.8a12.8,12.8,0,1,1,0,25.6Z" />
                                                <path class="cls-3" d="M217.6,320H76.8a12.8,12.8,0,1,1,0-25.6H217.6a12.8,12.8,0,0,1,0,25.6Z" />
                                                <path class="cls-4" d="M480,294.4h-6.4a51.2,51.2,0,0,0-102.4,0h-6.4a32,32,0,0,0-32,32v76.8a32,32,0,0,0,32,32H480a32,32,0,0,0,32-32V326.4A32,32,0,0,0,480,294.4Zm-83.2,0a25.6,25.6,0,0,1,51.2,0Z" />
                                                <path class="cls-5" d="M422.4,384a12.8,12.8,0,0,1-12.8-12.8V358.4a12.8,12.8,0,0,1,25.6,0v12.8A12.8,12.8,0,0,1,422.4,384Z" />
                                            </svg>
                                        </a>
                                        @endif
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
@section('scripts')
<script type="text/javascript" src="{{ asset('admin/assets/plugin/datatable/datatables.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#user_orders_dt').DataTable({
            searching: false,
            paging: false,
            info: false,
            aaSorting: [
                [1, "asc"]
            ]
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection