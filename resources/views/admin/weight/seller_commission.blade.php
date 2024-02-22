@extends('layouts.admin.master')
@section('styles')
<link rel="stylesheet" href="{{asset('admin/assets/plugin/datatable/datatables.min.css')}}" />
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
                        <li>Order</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Body -->
    <div class="page-body">
        <div class="row">

            <div class="col-12">
                <div class="panel panel-default">

                   {{-- <div class="panel-head">
                        <h5 class="panel-title">All Orders</h5>
                    </div> --}}

                    <div class="panel-body">
                        @if ( session()->has('message') )
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
                        @endif
                        <div class="table-responsive">
                            <table class="table table-head-bg table-head-primary table table-striped table-bordered basic-datatable" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Selling Price</th>
                                        <th>Commission paid</th>
                                        <th>Amount To Pay</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @if(isset($data))
                                    @foreach($data as $order)

                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->user->first_name}} {{$order->user->last_name}}</td>
                                        <td>{{$order->user->email}}</td>
                                        <td>£{{number_format($order->total_price, 2)}}</td>

                                        <td>
                                            <select size="1" class="form-control m-0 selectOrder" onchange="commission(this.options[this.selectedIndex].value,<?php echo $order->id; ?>);">
                                                <option value="1" {{ ($order->commission_paid == 1 ? 'selected' : '')}}>
                                                    Yes
                                                </option>
                                                <option value="0" {{ ($order->commission_paid == 0 ? 'selected ' : '')}}>
                                                    No
                                                </option>
                                            </select>
                                        </td>
                                        <?php $total_commission = $order->total_price -  ($order->total_price * 7.5 /100);?>
                                        <td>£{{ number_format($total_commission, 2)}}</td>
                                        <td>
                                            <a href="{{ route('edit.view', ['id' => $order->user->id ]) }}" class="btn btn-primary btn-sm m-1">View Profile</a>
                                            <a href="{{route('allorder.detail.buyer',['id'=>$order->id])}}" class="btn btn-primary btn-sm m-1">View Order</a>
                                        </td>


                                        @endforeach
                                        @endif

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Total Amount</th>
                                        <th>Payment Type</th>
                                        <th>Status</th>
                                        <th>Action Orders</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{asset('admin/assets/plugin/datatable/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/dist/js/demo/datatable.js')}}"></script>
<script>
    function commission(val, i) {

        $.ajax({
            url: "{{ route('order.compaid') }}",
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                val: val,
                orderid: i,

            },
            success: function(result) {
                if (result.response.message) {
                    console.log(result.response.message);
                    location.reload();
                }
                //result = JSON.parse(result)

            }
        });

    }



    //   function get_dist(val , i){
    //      orderStatus =  $(val).val();
    //      orderId = i;

    //      $.ajax({
    //         url: "{{ route('order.status') }}",
    // 			method: 'post',
    // 			data: {
    // 				_token: "{{ csrf_token() }}",
    //                 orderStatus:orderStatus,
    //                 orderId:orderId,

    // 			},
    // 			success: function(result){
    // 				if(result.response.message){
    //                    console.log(result.response.message);
    //                     location.reload();
    //                 }
    //                 //result = JSON.parse(result)

    //             }
    //     });

    //   }
</script>

@endsection