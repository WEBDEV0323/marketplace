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

                        <div class="panel-head"></div>

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
                                <table id="all_orders_dt" class="table table-head-bg table-head-primary table table-striped table-bordered basic-datatable" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Reference</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Product</th>
                                        <th>Size</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($data as $key => $order)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td> <?php echo date('d/m/Y - H:i', strtotime($order->orderCreatedDate));?></td>
                                            <td>{{strtoupper($order->reference)}}</td>
                                            <td>{{$order->user->first_name ?? ''}} {{$order->user->last_name ?? ''}}</td>
                                            <td>{{$order->user->email ?? ''}}</td>
                                            @if($order->count > 1)
                                                <td style="color:red;"> Multiple</td>
                                                <td style="color:red;"> Multiple</td>
                                            @else
                                                <td>{{$order->product_name ?? ''}} </td>
                                                <td> {{$order->size ?? ''}}</td>
                                            @endif

                                            <td>£{{ number_format((float)$order->final_price, 2, '.', '') ?? ''}}</td>

                                            <td class="d-flex">
                                                <a href="{{ route('product.by.id', ['id' => $order->product_id ?? 0]) }}" class="btn btn-primary btn-sm m-1">Product</a>
                                                <a href="{{ route('allorder.detail.buyer', ['id' => $order->id]) }}" class="btn btn-primary btn-sm m-1">View</a>
                                                <a onclick="deleteRow(this, {{$order->id}})" href="javascript:void(0);" class="btn btn-danger btn-sm m-1">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
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

    <script>

        $(document).ready(function () {
            $('#all_orders_dt').DataTable({
                order: [[1, 'ASC']],
            });
        });

        function deleteRow(button, id) {

            let confirmed = confirm("Are you sure you want to delete this order?");

            if (confirmed) {
                button.disabled = true;
                window.location = `order-delete/${id}`;
            }
        }

    </script>

@endsection
