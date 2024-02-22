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
                        <li>Coupon</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Button Code Starts Here -->

    <div class="action-button-box align-middle">
   {{-- <a href = "{{route('coupon-add')}}" class="btn btn-primary btn-shadow">Add Coupon</a> --}}
    </div>

    <!-- Action Button Code Ends Here -->

    <!-- Page Body -->
    <div class="page-body">
        <div class="row">    
            <div class="col-12">
                    <div class="panel panel-default">
                      
                            
                        <div class="panel-head">
                            <h5 class="panel-title">All Coupon</h5>
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
                            @endif
                       
                                <div class="table-responsive">
                                <table class="table table-head-bg table-head-primary table table-striped table-bordered basic-datatable" cellspacing="0" width="100%" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Coupon</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Total Coupon</th>
                                            <th>Discount</th>
                                            <th>Free Shipping</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                                
                                        @foreach($coupons as $coupon)         
                                                <tr>
                                                    <td>{{ $coupon->id }}</td>
                                                    <td>{{ $coupon->coupon_code }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($coupon->start_date)) }}
                                    
                                                    <td>{{ date('d-m-Y', strtotime($coupon->end_date)) }}</td>
                                                    <td>{{ $coupon->total_coupon }}</td>
                                                    <td>{{ $coupon->discount }}</td>
                                                    <td class="text-capitalize">{{ $coupon->free_shiping }}</td>
                                                    @if($coupon->flags == 1 && $coupon->start_date >= date("Y-m-d") )
                                                    <td><span class="badge badge-success badge-sm badge-pill">{{App\Models\Coupon::STATUS_ACTIVE}}</span></td>
                                                    @else
                                                    <td><span class="badge badge-danger badge-sm badge-pill">Expired</span></td>
                                                    @endif
                                                    
                                                    <td><a href = "{{route('edit_coupon',["id"=>$coupon->id ])}}"  class="btn btn-primary btn-sm m-1">Edit</a> 
                                                    <a id="delete" href ="{{route('delete_coupon',["id"=>$coupon->id ])}}"  class="btn btn-danger btn-sm m-1">Delete</a></td>
                                                    
                                                </tr>
                                        @endforeach 
                                    
                                </table>
                                </div>
                       {{--@endif--}} 
                    </div>
                </div>
            </div> 
     </div>
</div>
</div>
@endsection
@section('scripts')




<script type="text/javascript" src="{{asset('admin/assets/plugin/datatable/datatables.min.js')}}"></script>


    <!-- <script type="text/javascript" src="{{asset('admin/dist/js/demo/datatable.js')}}"></script> -->

    <script>
    var exampleTable = $('#myTable').DataTable({
        aLengthMenu: [
            [25, 50, 100, 200],
            [25, 50, 100, 200]
        ],
        iDisplayLength: 25,
    });

    $(document).ready(function() {

        let url = "{{route('coupon-add')}}";
        $('<div class="pull-right">' + '' +
            '</div>').appendTo("#myTable_wrapper .dataTables_filter");
        $("#myTable_length").append('<a href="'+url+'" class="btn btn-primary btn-shadow" >Add Coupon</a>');
    });
</script>

    <script>
    $(document).on("click", "#delete", function(e) {
        if (confirm('Are you sure to remove this record ?')) {
        } else {
            e.preventDefault();
        }
    });
</script>
@endsection