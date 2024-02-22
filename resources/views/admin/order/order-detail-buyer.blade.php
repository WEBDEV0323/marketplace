


@extends('layouts.admin.master')
@section('body-content')




<section>


    <!-- ---------------------------------------------------- -->
    <!-- ---------------------------------------------------- -->
    <!-- -------------------- Admin's View ------------------ -->
    <!-- ---------------------------------------------------- -->
    <!-- ---------------------------------------------------- -->

    <div class="white-box-div order-view">
        <div class="panel panel-default">
            <div class="panel-head">
                <h5 class="panel-title">Buyers Info</h5>
            </div>
            <div class="panel-body">
                <form action="">
                    <div class="row">
                        <div class="col-lg-3 col-sm-3">
                            <div class="detail-box">
                                <label for="">Name</label>
                                <div class="value-box">
                                    {{$data->user->first_name ?? ""}} {{$data->user->last_name ?? ""}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3">
                            <div class="detail-box">
                                <label for="">Email</label>
                                <div class="value-box">
                                    {{$data->user->email ?? ""}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3">
                            <div class="detail-box">
                                <label for="">Contact Number</label>
                                <div class="value-box">
                                    {{$data->user->phone ?? ""}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3 payment-type">
                            <div class="detail-box">
                                <label for="">Payment Type</label>
                                <div class="value-box">
                                    {{\App\Models\Order::PAYMENT_TYPES[$data->payment_type ?? 0] ?? ""}}
                                </div>
                            </div>
                            {{-- <div class="refund-button">
                                        <label for="">Order Status</label>
                                        <a href="#" class="btn btn-primary"> {{$data->status ?? ""}}</a>
                        </div> --}}
                    </div>

                    <div class="row" style="width:100%">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="detail-box">
                                <label for="">Billing Address</label>
                                <div class="value-box big">
                                <span>
                                    <ul class="listStyleNone">
                                        <li>Country: {{$billing->country ?? ""}}</li>
                                        <li> Address Line 1 : {{$billing->street_address ?? ""}} </li>
                                        <li>Address Line 2 : {{$billing->appartment_address ?? ""}} </li>
                                        <li>City/Town: {{$billing->city ?? ""}}</li>
                                        <li>County : {{$billing->state ?? " "}}</li>
                                        <li>Post Code: {{$billing->post_code ?? ""}}</li>
                                        <li>Contact Number : {{$billing->phone ?? ""}}</li>
                                    </ul>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="detail-box">
                                <label for="">Shipping Address</label>
                                <div class="value-box big">
                                    <span>
                                        <ul class="listStyleNone">
                                            <li>Country: {{$shipping->country ?? ""}} </li>
                                            <li>Address Line 1 : {{$shipping->street_address ?? ""}} </li>
                                            <li>Address Line 2 : {{$shipping->appartment_address ?? ""}} </li>
                                            <li>City/Town: {{$shipping->city ?? " "}} </li>
                                            <li>County : {{$shipping->state ?? ""}} </li>
                                            <li>Post Code: {{$shipping->post_code ?? ""}} </li>
                                            <li>Contact Number : {{$shipping->phone ?? ""}} </li>
                                        </ul>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 text-center track-order">
                            <div class="detail-box">
                                <label for="">Tracking</label>
                                <input type="text" id="tracking" value="{{$data->tracking_number}}">
                                <button class="btn btn-primary">Track</button>
                                <button type="button" class="btn btn-primary" onclick="get_submit(<?php echo $data->id; ?>)">Submit</button>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12">
                            <div class="detail-box">
                                <label for="">Order Date</label>
                                <div class="value-box">
                                    @if(isset($data->created_at)) {{date_format($data->created_at,'d-m-Y')}} @endif
                                </div>
                            </div>
                            <div class="detail-box">
                                <label for="">Order Time</label>
                                <div class="value-box">
                                    @if(isset($data->created_at))
                                    {{date_format($data->created_at,'H:i')}}

                                    @endif
                                </div>
                            </div>
                            <div class="detail-box">
                            <label for="">Reference</label>
                            <div class="value-box">
                                {{strtoupper($data->reference) ?? ""}}
                            </div>
                        </div>
                        </div>
                    </div>



            </div>


            <br>
            <h5 class="panel-title">Product Info</h5>



            @if(isset($data->order_details))

            <!-- Product Details Row Start -->
            @forelse($data->order_details as $order_detail)
            @forelse($order_detail->product as $product)


            <div class="row product-row">
                <div class="col-lg-3">
                    <div class="detail-box">
                        <label for="">Product Name</label>
                        <div class="value-box">
                            <?php echo $product->product_name; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-md col-sm-4 col-6">
                    <div class="detail-box">
                        <label for="">Size</label>
                        <div class="value-box">
                            {{$order_detail->size_detail->size ?? ""}}
                        </div>
                    </div>
                </div>
                <div class="col-lg col-md col-sm-4 col-6">
                    <div class="detail-box">
                        <label for="">Price</label>
                        <div class="value-box">
                            <?php if ($order_detail->price != NULL) echo  number_format((float)$order_detail->price, 2, '.', '');
                            else echo number_format((float)$order_detail->price, 2, '.', '');  ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-md col-sm-4 col-6">
                    <div class="detail-box">
                        <label for="">Discount</label>
                        <div class="value-box">
                        £<?php echo number_format((float)$order_detail->discount, 2, '.', '');  ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-md col-sm-4 col-6">
                    <div class="detail-box">
                        <label for="">Quantity</label>
                        <div class="value-box">
                            <?php echo $order_detail->quantity; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg col-md col-sm-4 col-6">
                    <div class="detail-box">
                        <label for="">SKU</label>
                        <div class="value-box">
                            <?php echo $product->sku; ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg col-md col-sm-4 col-6">
                    <div class="detail-box">
                        <label for="">Action</label>
                        <div class="">
                        <button class="btn btn-primary" onclick = "get_dist(<?php echo $data->id; ?>,<?php echo $order_detail->odd ?>, <?php  echo $order_detail->refund;   ?>)">@if($order_detail->refund==0) Refund  @else Refunded @endif </button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            @endforelse
            @empty
            @endforelse
            <!-- Product Details Row End -->
            @endif

            </form>
        </div>
    </div>
    </div>


</section>
</div>
</div>
@endsection

<script>
    function get_dist(val, i) {

        event.preventDefault();
        orderStatus = val;
        orderId = i;



        $.ajax({
            url: "{{ route('order.status') }}",
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                orderStatus: orderStatus,
                orderId: orderId,
            },
            success: function(result) {
                if (result.response.message) {


                    console.log(result.response.message);
                    location.reload();
                }


            }
        });

    }

    function get_submit(id) {

        var tracking = $("#tracking").val();



        $.ajax({
            url: "{{ route('order.tracking') }}",
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                tracking: tracking,
                orderId: id,
            },
            success: function(result) {
                if (result.response.message) {


                    console.log(result.response.message);
                    location.reload();
                }


            }
        });





    }
</script>
