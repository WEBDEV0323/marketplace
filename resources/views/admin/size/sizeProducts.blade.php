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
                        <li>Brand</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Button Code Starts Here -->

    

    <!-- Action Button Code Ends Here -->

    <!-- Page Body -->
    <div class="page-body">
        <div class="row">    
            <div class="col-12">
                    <div class="panel panel-default">
                        
                        <div class="panel-head">
                         {{--   <h5 class="panel-title">Admin Products </h5> --}}
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
                        @if(count($data))
                            <div class="table-responsive">
                                <table   data-order='[[ 1, "asc" ]]' data-page-length='25' class="table table-head-bg table-head-primary table table-striped table-bordered responsive-datatable" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 0;?>
                                            @foreach($data as $brand)         
                                                <tr>
                                                    <td>{{$brand['id']}}</td>
                                                    <td>{{$brand['brand_name']}}</td>
                                                    @if($brand['active'] == 1)
                                                    <td><span class="badge badge-success badge-sm badge-pill">{{App\Models\Brand::STATUS_ACTIVE}}</span></td>
                                                    @else
                                                    <td><span class="badge badge-danger badge-sm badge-pill">{{App\Models\Brand::STATUS_NOT_ACTIVE}}</span></td>
                                                    @endif
                                                    
                                                    <td><a href = '{{route("cate_sizebrand", ["slug"=>$brand["id"]])}}' class="btn btn-primary btn-sm m-1">View</a>
                                                    
                                                </tr>
                                            @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <th>S#</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endif
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