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
                        <li>Product</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Button Code Starts Here -->

    <div class="action-button-box">
        @if(Auth::guard('admin')->check())
            <a href = "{{route('add.product')}}" class="btn btn-primary btn-shadow">Add Product</a>
        @endif
    </div>

    <!-- Action Button Code Ends Here -->

    <!-- Page Body -->
    <div class="page-body">
        <div class="row">
           
        <div class="col-12">
                            <div class="panel panel-default">
                            
                                <div class="panel-head">
                                    <h5 class="panel-title">All Products</h5>
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
                                                <th>Name</th>
                                                <th>Sale Price</th>
                                                <th>Regular Price</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        @if(isset($products))
                                            @foreach($products as $product)
                                            
                                            <tr>
                                                <td>{{$product['id']}}</td>
                                                <td>{{$product['product_name']}}</td>
                                                <td>{{$product['sale_price']}}</td>
                                                <td>{{$product['regular_price']}}</td>
                                                @if($product['active'] == 1)
                                                <td><span class="badge badge-success badge-sm badge-pill">Active</span></td>
                                                @else
                                                <td><span class="badge badge-danger badge-sm badge-pill">Not Active</span></td>
                                                @endif
                                                <td> 
                                                    <a href = '{{url("dashboard/product/$product[id]")}}' class="btn btn-primary btn-sm m-1">Edit</a>
                                                     <a href = "{{ route('product.delete', ['id' => $product['id']]) }}" class="btn btn-danger btn-sm m-1">Delete </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif  
                                          
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>ID</th>
                                                <th>Name</th>
                                                <th>Sale Price</th>
                                                <th>Regular Price</th>
                                                <th>Status</th>
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