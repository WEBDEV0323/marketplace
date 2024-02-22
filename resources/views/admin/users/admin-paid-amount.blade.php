@extends('layouts.admin.master')

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
                        <li>Users</li>
                        <li>Sell Seller</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Body -->
    <div class="page-body">
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
        <div class="row">

            <div class="col-12">
                <div class="panel panel-default">
                    <div class="panel-head">
                        <div class="panel-title">
                            <span class="panel-title-text">Seller Pay Amount Report</span>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('admin_paid_amount') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Seller Name</label>
                                <div class="col-10 input-group">
                                    <input required name="seller_name" type="text" class="form-control"
                                        placeholder="Enter First Name" value = "{{$data->user->first_name}} &nbsp; {{$data->user->last_name}}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Product ID</label>
                                <div class="col-10 input-group">
                                    <input required name="product_name" type="text" class="form-control" value = "{{$data->product->product_name}}"
                                        placeholder="Enter Last Name" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Email</label>
                                <div class="col-10">
                                    <input required class="form-control" name="email" type="email"
                                        placeholder="bootstrap@example.com" value = "{{$data->user->email}}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Remaining Quantity</label>
                                <div class="col-10">
                                    <input required name="quantity" class="form-control" type="text" value = "{{$data->vendor_stock->quantity}}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Total Quantity</label>
                                <div class="col-10">
                                    <input required name="total_qty" class="form-control" type="text"
                                        value = "{{$data->vendor_quantity}}" disabled>
                                        
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Total Payout</label>
                                <div class="col-10">
                                    <input name="payout" class="form-control" type="text" value="${{$data->price}}" disabled >
                                    <input name="price" class="form-control" type="hidden" value="{{$data->price}}"  >
                                    <input name="vendor_product_id" class="form-control" type="hidden" value="{{$data->id}}" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Pay Here</label>
                                <div class="col-10">
                                    <input name="pay" class="form-control" type="text" <?php if($data->price <= 0) echo 'disabled'; else echo '';?>  >
                                </div>
                            </div>
                            
                            <div class="panel-footer ">
                                <button type="submit" class="btn btn-primary mr-2 ">Pay Amount</button>
                                <button type="reset"
                                    class="btn btn-outline btn-secondary btn-outline-1x">Cancel</button>
                            </div>



                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
