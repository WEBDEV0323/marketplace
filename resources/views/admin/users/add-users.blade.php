<?php

// $url = url()->previous();
// $arr = explode("/", $url);
// $route = end($arr);

?>

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
                        <li>Users / Vendors</li>
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



                            @if($data=='seller')

                            <span class="panel-title-text">Add Seller</span>

                            @elseif($data=='affiliate')

                            <span class="panel-title-text">Add Affiliate</span>

                            @else

                            <span class="panel-title-text">Add User</span>

                            @endif
                        </div>
                    </div>
                    <div class="panel-body">
                        {{-- <p class="text-muted mb-4">Update Your Users or Vendors</p> --}}
                        <form action="{{ route('register.process') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row white-box-div">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="form-label">First Name</label>
                                        <input required name="first_name" type="text" class="form-control" placeholder="Enter First Name">
                                        <input name="created_by" type="hidden" value="admin">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="form-label">User Name</label>

                                        <input required name="last_name" type="text" class="form-control" placeholder="Enter Last Name">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="form-label">Email</label>

                                        <input required class="form-control" name="email" type="email" placeholder="bootstrap@example.com">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="form-label">Password</label>

                                        <input required name="password" class="form-control" type="password" placeholder="***************">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class=" col-form-label">Confirm Password</label>

                                        <input required name="confirm_password" class="form-control" type="password" placeholder="***************">

                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group ">
                                        <label class=" col-form-label">Phone</label>

                                        <input name="phone" class="form-control" type="text" placeholder="+44 7828580742">

                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class=" col-form-label">Gender</label>

                                        <select required name="gender" class="form-control">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>

                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class=" col-form-label">User Type</label>

                                        <select required hidden name="user_type" class="form-control">
                                            
                                            <option value="1" @if($data=='seller') selected @endif>Seller</option>
                                            <option value="3" @if($data=='affiliate') selected @endif>Affiliate</option>
                                            <option value="2" @if($data=='user') selected @endif>User</option>

                                        </select>
                                        @if($data=='seller')
                                        <input type="text"  value="Seller" class="form-control" disabled>
                                        @elseif($data=='affiliate')
                                        <input type="text" value="Affiliate" class="form-control" disabled>
                                        @else
                                        <input type="text" value="User" class="form-control" disabled>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class=" col-form-label">User Image</label>

                                        <input type="file" name="image" class="form-control">

                                    </div>
                                </div>

                                @if($data=='affiliate')
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="col-form-label">Discount Coupon Code</label>

                                        <input name="coupon_code" type="text" class="form-control" placeholder="Enter Discount Coupon Code">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="col-form-label">Commission Setting</label>

                                        <select name="commission_setting" class="form-control">
                                            <option value="">Select Tier</option>
                                            <option value="tier-1">Tier 1 (Standard) – 2% Commission </option>
                                            <option value="tier-2">Tier 2 – Have to sell £10,000 worth of products – 2.5% Commission </option>
                                            <option value="tier-3">Tier 3 – Have to sell £20,000 worth of products – 3% Commission </option>
                                            <option value="tier-4">Tier 4 – Have to sell £50,000 worth of products – 5% Commission </option>
                                        </select>

                                    </div>
                                </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="buttons text-left mb-0">

                                        @if($data=='seller')

                                        <button type="submit" class="btn btn-primary ">Add Seller</button>

                                        @elseif($data=='affiliate')

                                        <button type="submit" class="btn btn-primary ">Add Affiliate</button>

                                        @else

                                        <button type="submit" class="btn btn-primary ">Add User</button>

                                        @endif



                                        <a href="{{ URL::previous() }}" type="reset" class="btn btn-danger">Cancel</a>
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