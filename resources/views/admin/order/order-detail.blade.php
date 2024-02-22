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

                                {{--<div class="refund-button">--}}
                                {{--     <label for="">Order Status</label>--}}
                                {{--     <a href="#" class="btn btn-primary"> {{$data->status ?? ""}}</a>--}}
                                {{--</div>--}}

                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="detail-box">
                                    <label for="">Billing Address</label>
                                    <div class="value-box big">
                                    <span>
                                        <ul class="listStyleNone">
                                            <li>Country: {{$billing->country ?? ""}} </li>
                                            <li>Address Line 1 : {{$billing->street_address ?? ""}} </li>
                                            <li>Address Line 2 : {{$billing->appartment_address ?? ""}} </li>
                                            <li>City/Town: {{$billing->city ?? ""}} </li>
                                            <li>County : {{$billing->state ?? " "}} </li>
                                            <li>Post Code: {{$billing->post_code ?? ""}} </li>
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
                            <div class="col-lg-2 col-md-4 text-center track-order">
                                <div class="detail-box">
                                    <label for="">Tracking</label>
                                    <input id="tracking" type="text" value="{{$data->tracking_number}}">
                                    <button class="btn btn-primary">Track</button>
                                    <button type="button" class="btn btn-primary" onclick="get_submit(<?php echo $data->id; ?>)">Submit</button>
                                </div>
                            </div>

                            <div class="col-lg-2 col-sm-6">
                                <div class="detail-box">
                                    <label for="">Order Date</label>
                                    <div class="value-box">
                                        @if(isset($data->created_at)) {{date_format($data->created_at,'d-m-Y')}} @endif
                                    </div>
                                    <div class="detail-box">
                                        <label for="">Order Time</label>
                                        <div class="value-box">
                                            @if(isset($data->created_at)) {{ date_format($data->created_at,'H:i') }} @endif
                                        </div>
                                        <div class="detail-box">
                                            <label for="">Order Reference</label>
                                            <div class="value-box">
                                                {{strtoupper($data->reference) ?? ""}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <h5 class="panel-title">Sellers Info</h5>

                        @if(isset($data->order_detail))

                            @forelse($data->order_detail as $order_detail)
                                @forelse($order_detail->product as $product)
                                    <div class="row sellers-info-row">
                                        <div class="col-lg-3 col-sm-6">

                                            <div class="detail-box">
                                                @if(isset($product->product_user) && $product->product_user != NULL )
                                                    <label for="">Name</label>

                                                    <div class="value-box">
                                                        {{$product->product_user->first_name . " " . $product->product_user->last_name}}
                                                    </div>
                                                @else
                                                    {{--{{"Admin Product"}}--}}
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-6">
                                            <div class="detail-box">
                                                @if(isset($product->product_user) && $product->product_user != NULL )
                                                    <label for="">Email</label>
                                                    <div class="value-box">
                                                        {{$product->product_user->email}}
                                                    </div>
                                                @else
                                                    {{--{{"Admin Product"}}--}}
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-6">

                                            <div class="detail-box">
                                                @if(isset($product->product_user) && $product->product_user != NULL )
                                                    <label for="">Contact Number</label>

                                                    <div class="value-box">
                                                        {{$product->product_user->phone}}
                                                    </div>
                                                @else
                                                    {{--{{"Admin Product"}}--}}
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-sm-6 profile-btn-box">
                                            @if(isset($product->product_user) && $product->product_user != NULL )
                                                <a href="{{ route('edit.user', ['id' => $product->product_user->id]) }}" class="btn btn-primary">Profile</a>
                                            @endif
                                        </div>
                                    </div>

                                @empty
                                @endforelse
                            @empty
                            @endforelse
                        @endif

                        <br>

                        <h5 class="panel-title">Product Info</h5>

                        <!-- Product Details Row Start -->
                        @if(isset($data->order_detail))

                            @forelse($data->order_detail as $order_detail)
                                @forelse($order_detail->product as $product)

                                    @if(isset($product->product_user) && $product->product_user != NULL )
                                        <div class="row product-row">
                                            <div class="col-md-2 col-sm-12">
                                                <div class="detail-box">
                                                    <label for="">Product Name</label>
                                                    <div class="value-box">

                                                        {{$product->product_parent->product_name  ?? ""}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-md-2 col-sm-12">
                                                <div class="detail-box">
                                                    <label for="">Size</label>
                                                    <div class="value-box">
                                                        {{$order_detail->size_detail->size ?? ""}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-md-1 col-sm-6">
                                                <div class="detail-box">
                                                    <label for="">Price</label>
                                                    <div class="value-box">
                                                        £<?php echo number_format((float)$order_detail->price, 2, '.', ''); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-sm-12">
                                                <div class="detail-box">
                                                    <label for="">Discount</label>
                                                    <div class="value-box">
                                                        <span>£<?php echo number_format((float)$order_detail->product_discount, 2, '.', ''); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-sm-12">
                                                <div class="detail-box">
                                                    <label for="">Quantity</label>
                                                    <div class="value-box">
                                                        <?php echo abs($order_detail->quantity); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-12">
                                                <div class="detail-box">
                                                    <label for="">SKU</label>
                                                    <div class="value-box">
                                                        {{$product->product_parent->sku  ?? ""}}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-1 col-sm-12">
                                                <div class="detail-box">
                                                    <label for="">Action</label>
                                                    <div class="">
                                                        <button class="btn btn-primary" onclick = "get_dist(<?php echo $data->id; ?>,<?php echo $order_detail->odd ?>, <?php  echo $order_detail->refund;   ?>)">@if($order_detail->refund==0) Refund  @else Refunded @endif </button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                @endif
                            @empty
                            @endforelse
                        @empty
                        @endforelse

                    @endif
                    <!-- Product Details Row End -->

                        <!-- Document attachment Row Start -->
                        <br>

                        <h5 class="panel-title">Shipping Documents Info</h5>

                        <div class="row document-row">

                            <div class="col-md-12">

                                <div class="detail-box">

                                    <label for="">Document List</label>

                                    <div class="value-box" style="padding: 0px">
                                        <table class="document-custom-table table-head-bg table-head-primary table-striped " cellspacing="0" width="100%">
                                        {{--<table class="table table-head-bg table-head-primary table-striped table-bordered " cellspacing="0" width="100%">--}}
                                            <thead>
                                            <tr>
                                                <th style="height: 38px; font-size: 14px;">Name</th>
                                                <th style="font-size: 14px;">Type</th>
                                                <th style="font-size: 14px;">Email Status</th>
                                                <th style="font-size: 14px;">Uploaded At</th>
                                                <th style="font-size: 14px;">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if(count($documents) > 0)
                                                @foreach($documents as $document)
                                                    <tr>
                                                        <td>{{$document->name}}</td>
                                                        <td>{{strtoupper($document->extension)}}</td>
                                                        <td>{{ucwords($document->email_status)}}</td>
                                                        <td>{{date_format($document->created_at,'d-m-Y')}}</td>
                                                        <td>
                                                            <a href="{{ route('down.document', ['id' => encrypt($document->id)]) }}" class="btn btn-info btn-sm">Download</a>
                                                            <a href="{{route('delete.document',['id' => $document->id])}}" onclick="return confirm('Are you sure want to delete this!');" class="btn btn-danger btn-sm">Delete</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <td colspan="4" class="text-center">There is no documents</td>
                                            @endif
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-10">

                                <div class="detail-box">
                                    <label for="">Browse Files</label>
                                    <div class="value-box">
                                        <input type="file" id="documents" name="documents" multiple>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-1 col-sm-12">
                                <div class="detail-box">
                                    <label for="">Action</label>
                                    <div class="">
                                        <button type="button" class="btn btn-primary" onclick="upload_doc(<?php echo $data->id; ?>)">Upload</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-1 col-sm-12">
                                <div class="detail-box">
                                    <label for="">&nbsp;</label>
                                    <div class="">
                                        <button type="button" class="btn btn-primary" onclick="send_doc(this, <?php echo $data->id; ?>)">Send Doc's</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Document attachment Row End -->

                    </form>
                </div>
            </div>
        </div>

    </section>
@endsection


<script>

    function get_dist(order_id, detail_id, status) {

        event.preventDefault();

        $.ajax({
            url: "{{ route('order.status') }}",
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                orderStatus: status,
                orderId: detail_id,
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

        var tracking=$("#tracking").val();

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

    function upload_doc(order_id) {

        let files = $('#documents')[0].files || [];

        if (files.length > 0) {

            let formData = new FormData();

            // append token
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('order_id', order_id);

            // append files
            for (let i = 0; i < files.length; i++) {
                formData.append('documents[]', files[i]);
            }

            $.ajax({
                url: "{{ route('add.documents') }}",
                type: 'POST',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response == 'true') {
                        location.reload();
                    } else {
                        alert(response);
                    }
                }
            });
        } else {

            alert("Please select file");
        }
    }

    function send_doc(obj, order_id) {

        if (confirm("Are you sure you want to send the above documents to the vendor?")) {

            $(obj).prop('disabled', true).text('Sending...');

            $.ajax({
                url: "{{ route('send.documents') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    order_id: order_id
                },
                success: function (response) {

                    $(obj).prop('disabled', false).text("Send Doc's");

                    if (response == 'true') {

                        location.reload();
                    } else {

                        alert(response);
                    }
                }
            });
        }
    }


</script>
