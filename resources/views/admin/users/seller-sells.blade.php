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
                       
                        <li>Dashboard</li>
                        <li>Users</li>
                        <li>Seller Sells</li>
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
                          
                                <div class="panel-head">
                                    <h5 class="panel-title">All Seller</h5>
                                </div>
                                
                                <div class="panel-body">
                                @if ( session()->has('message') )
                                <div class="alert alert-icon alert-success alert-dismissible fade show">
                                        <div class="alert--icon">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="alert-text">
                                            <strong>Well done!</strong>  {{ session('message') }}
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
                                    <table class="table table-head-bg table-head-primary table table-striped table-bordered basic-datatable" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Seller Name</th>
                                                <th>Total Stock</th>
                                                <th>Product</th>
                                                <th>Remaining Stock</th>
                                                <th>Sold Stock</th>
                                                <th>Pay to Seller</th>
                                                <th>Earning</th>
                                               
                                                <th>Permission Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        @if(isset($data))
                                        <?php $count = 0;?>
                                            @foreach($data as $user)
                                            
                                            <tr>
                                                <td>{{ ++$count}}</td>
                                                <td>{{$user->user->first_name}} &nbsp; {{$user->user->last_name}}</td>
                                                <td>{{$user->vendor_quantity}}</td>
                                                <td>{{$user->product->product_name}}</td>
                                                <td>{{$user->vendor_stock->quantity}}</td>
                                                <td><?php 
                                                    if($user->vendor_quantity > 0){
                                                        $vendor_stock =  $user->vendor_stock->quantity;
                                                        echo ($user->vendor_quantity - $vendor_stock);
                                                    }
                                                ?></td>
                                                <td>${{$user->price}}</td>
                                                <td>$<?php  
                                                     
                                                     echo $price =  ($user->vendor_quantity * $user->product->regular_price) - $user->price;
                                                    ?></td>

                                                
                                                @if($user->flags == 1)
                                                <td><span class="badge badge-success badge-sm badge-pill">{{App\Models\User::STATUS_ACTIVE}}</span></td>
                                                @else
                                                <td><span class="badge badge-danger badge-sm badge-pill">{{App\Models\User::STATUS_NOT_ACTIVE}}</span></td>
                                                @endif
                                                <td><a href = "{{ route('vendor_amount_paid', ['id' => $user->id ]) }}" class="btn btn-primary btn-sm m-1">Pay</a> <a href = '' class="btn btn-danger btn-sm m-1">Delete</a></td> 
                                            </tr>
                                            @endforeach
                                        @endif  
                                          
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>ID</th>
                                                <th>Seller Name</th>
                                                <th>Total Stock</th>
                                                <th>Product</th>
                                                <th>Remaining Stock</th>
                                                <th>Sold Stock</th>
                                                <th>Pay to Seller</th>
                                                <th>Earning</th>
                                                <th>Permission Status</th>
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
@endsection
@section('scripts')
<script type="text/javascript" src="{{asset('admin/assets/plugin/datatable/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/dist/js/demo/datatable.js')}}"></script>


@endsection