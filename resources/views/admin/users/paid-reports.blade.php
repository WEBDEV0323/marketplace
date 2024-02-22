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
                                    <div class="table-responsive">
                                    <table class="table table-head-bg table-head-primary table table-striped table-bordered basic-datatable" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Seller Name</th>
                                                <th>Product</th>
                                                <th>Paid Amount</th>
                                                <th>Remaining Amount</th>
                                                <th>From Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        @if(isset($data))
                                        <?php $count = 0;?>
                                            @foreach($data as $user)
                                            
                                            <tr>
                                                <td>{{ ++$count}}</td>
                                                <td>{{$user->vendor_product->user->first_name}} &nbsp; {{$user->vendor_product->user->last_name}}</td>
                                                <td>{{$user->vendor_product->product->product_name}} </td>
                                                <td>{{$user->paid_amount}} </td>
                                                <td>{{$user->due_amount}} </td>
                                                <?php $originalDate = $user->created_at;
                                                        $newDate = date("d-m-Y", strtotime($originalDate));?>
                                                <td>{{$newDate}} </td>
                                               
                                               
                                            </tr>
                                            @endforeach
                                        @endif  
                                          
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>ID</th>
                                                <th>Seller Name</th>
                                                <th>Product</th>
                                                <th>Paid Amount</th>
                                                <th>Remaining Amount</th>
                                                <th>From Date</th>
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


@endsection