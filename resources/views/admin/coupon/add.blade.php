@extends('layouts.admin.master')

@section('body-content')
<div class="page-wrapper">
    <!-- Page Title -->
    <div class="page-title">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h2 class="page-title-text">

                </h2>
            </div>
            <div class="col-sm-6 text-right">
                <div class="breadcrumbs">
                    <ul>
                        <li>Home</li>
                        <li>coupon</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Body -->
    <div class="page-body">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-head">
                        <div class="panel-title">
                            <span class="panel-title-text">Add Coupon</span>
                        </div>
                    </div>

                    <div class="panel-body">
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
                      
                        <form action="{{ route('coupon.process') }}" method="post">
                            @csrf
                            <div class="row white-box-div">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Coupon Code</label>
                                        <input required type="text" name="name"  placeholder="Enter Your Coupon">
                                    </div>
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input required type="date" name="start_date"  placeholder="Start Date">
                                    </div>
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input required type="date" name="end_date"  placeholder="End Date">
                                    </div>
                                    <div class="form-group">
                                        <label>Discount(%)</label>
                                        <input required type="number" name="discount"  placeholder="Enter Discount Percentage">
                                    </div>
                                    <div class="form-group">
                                        <label>Total </label>
                                        <input required type="number" name="total_coupon"  placeholder="Total Coupon">
                                    </div>
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="checkbox" value="yes" id="flexCheckDefault" name="free_shiping">
                                        <label class="form-check-label" for="flexCheckDefault">
                                        Free Shipping
                                        </label>
                                    </div>
                                    <div class="buttons text-left mb-0">
                                        <button type="submit" class="btn btn-primary ">Submit</button>
                                     <a href="{{url()->previous()}}">   <button type="button"
                                            class="btn btn-danger">Cancel</button></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
