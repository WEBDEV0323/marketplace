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
                        <li>Banner</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Button Code Starts Here -->

    {{-- <h5 class="panel-title">All Brands</h5> --}}

    <div class="action-button-box">
        @if(Auth::guard('admin')->check())
        <div class="align-middle">
        </div>
        @endif
    </div>

    <!-- Action Button Code Ends Here -->

    <!-- Page Body -->
    <div class="page-body">
        <div class="row">
            <div class="col-12">
                <div class="panel panel-default">

                    <div class="panel-head">
                    </div>
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
                            <table data-order='[[ 1, "asc" ]]' data-page-length='25'
                                class="table table-head-bg table-head-primary table table-striped table-bordered responsive-datatable"
                                cellspacing="0" width="100%" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Image</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($data) > 0)
                                    <?php $counter = 0;?>
                                    @foreach($data as $row)
                                    <tr>
                                        <td>
                                            <?php echo ++$counter;?>
                                        </td>
                                        <td>
                                            @if($row->about_type_key == 'banner_images')
                                                 @if($row->titile == 'Video')
                                                    <video  id="myVideo" width="120"  controls>
                                                        <source src="{{url('/').'/storage/about_us/banner/'.$row->image}}" type="video/mp4">
                                                    </video> 
                                                 @else
                                                    <img src="{{url('/').'/storage/about_us/banner/'.$row->image}}" style="max-width: 70px;max-height: 70px;"/>
                                                 @endif
                                            @elseif($row->about_type_key == 'influencer_images')
                                                <img src="{{url('/').'/storage/about_us/influencer/'.$row->image}}" style="max-width: 70px;max-height: 70px;"/>
                                            @elseif($row->about_type_key == 'testimonial_images')
                                                <img src="{{url('/').'/storage/about_us/testimonial/'.$row->image}}" style="max-width: 70px;max-height: 70px;"/>
                                            @elseif($row->about_type_key == 'industry_data')
                                                <img src="{{url('/').'/storage/about_us/industry_data/'.$row->image}}" style="max-width: 70px;max-height: 70px;"/>
                                            @elseif($row->about_type_key == 'statistics')
                                                <img src="{{url('/').'/storage/about_us/statistics/'.$row->image}}" style="max-width: 70px;max-height: 70px;"/>
                                            @endif
                                        </td>
                                       
                                        <td>
                                            @if($row->about_type_key == 'banner_images')
                                                <span class="badge badge-success badge-sm badge-pill">Banner</span>
                                            @elseif($row->about_type_key == 'influencer_images')
                                                <span class="badge badge-primary badge-sm badge-pill">Influencer</span>
                                            @elseif($row->about_type_key == 'testimonial_images')
                                                <span class="badge badge-info badge-sm badge-pill">Testimonial </span>
                                            @elseif($row->about_type_key == 'industry_data')
                                                <span class="badge badge-secondary badge-sm badge-pill">Industry Data </span>
                                            @elseif($row->about_type_key == 'statistics')
                                                <span class="badge badge-dark badge-sm badge-pill">Statistics </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->flags == 1) 
                                                <span class="badge badge-success badge-sm badge-pill">Active</span>
                                            @else
                                                <span class="badge badge-danger badge-sm badge-pill">Non-Active </span>
                                            @endif
                                        </td> 

                                        <td>
                                            <a href='{{route('aboutus.banner.edit',[$row->id])}}'class="btn btn-primary btn-sm m-1">Edit</a> 
                                                <a href='{{url("dashboard/about-us-banner-delete/$row->id")}}'
                                                class="btn btn-danger btn-sm m-1" id="delete">Delete</a></td>

                                    </tr>
                                    @endforeach
                                </tbody>
                                @endif

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
    $(document).on("click", "#delete", function(e) {
        if (confirm('Are you sure to remove this record ?')) {
        } else {
            e.preventDefault();
        }
    });
</script>

<script>
    var exampleTable = $('#myTable').DataTable({
        aLengthMenu: [
            [25, 50, 100, 200],
            [25, 50, 100, 200]
        ],
        iDisplayLength: 25,
    });

    $(document).ready(function() {
        let url = "{{route('aboutus.banner.create')}}";
        $('<div class="pull-right">' + '' +
            '</div>').appendTo("#myTable_wrapper .dataTables_filter");
        $("#myTable_length").append('<a href="'+url+'" class="btn btn-primary btn-shadow" >Add Image</a>');
    });
</script>

@endsection