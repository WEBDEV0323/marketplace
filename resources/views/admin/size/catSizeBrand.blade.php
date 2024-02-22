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
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Button Code Starts Here -->

  {{--  <div class="action-button-box align-middle">
        <a href="{{route('add.shop.category')}}" class="btn btn-primary btn-shadow">Add Category</a>
    </div> --}}

    <!-- Action Button Code Ends Here -->


    <!-- Page Body -->
    <div class="page-body">
        <div class="row">

            <div class="col-12">
                <div class="panel panel-default">

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
                            <table
                                class="table table-head-bg table-head-primary table table-striped table-bordered basic-datatable"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Status</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if(isset($shop_categories))
                                    @foreach($shop_categories as $shop_category)

                                    <tr>
                                        <td>{{$shop_category['id']}}</td>
                                        <td>{{$shop_category['shop_cat_name']}}</td>
                                        <td>{{$shop_category['gender']}}</td>
                                        @if($shop_category['active'] == 1)
                                        <td><span
                                                class="badge badge-success badge-sm badge-pill">{{App\Models\ShopCategory::STATUS_ACTIVE}}</span>
                                        </td>
                                        @else
                                        <td><span
                                                class="badge badge-danger badge-sm badge-pill">{{App\Models\ShopCategory::STATUS_NOT_ACTIVE}}</span>
                                        </td>
                                        @endif
                                        <td><a href="{{ route('size-home', ['slug' => $shop_category['id'], 'brand_slug' => $brand_slug,'gender' => $shop_category['gender']]) }}"
                                                class="btn btn-primary btn-sm m-1">View</a></td>

                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Slug</th>
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
