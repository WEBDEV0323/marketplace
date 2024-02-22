@extends('layouts.admin.master')
@section('styles')
<link rel="stylesheet"
    href="{{ asset('admin/assets/plugin/datatable/datatables.min.css') }}" />
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
                        <li>News</li>
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
                      {{--  <h5 class="panel-title">All News</h5> --}}
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
                        @endif
                        <div class="table-responsive">
                        <table id="myTable"
                            class="table table-head-bg table-head-primary table table-striped table-bordered basic-datatable"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Section</th>
                                    <th>Article Title</th>
                                    <th>Brand</th>
                                    <th>Date Published</th>
                                    <th>Views</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if(isset($data))
                                <?php $counter = 0;?>
                                    @foreach($data as $news)
                                    
                                        <tr>
                                            <td><?php echo ++$counter; ?></td>
                                            <td><?php echo $news->section; ?></td>
                                            <td><?php echo $news->title;?></td>
                                            <td><?php if(isset($news->brand->brand_name)){ echo $news->brand->brand_name; }?></td>
                                          {{--  <td><img src="<?php echo $news->news_image_url;?>" height = "50" width = "50" alt=""></td> --}}
                                          <td><?php echo \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $news->created_at)
                                    ->format('d/m/Y - H:i'); ?></td>

                                          <td><?php echo thousand_format($news->visit); ?></td>
                                          

                                                <td> 
                                                    <span class="badge <?php echo ($news->active == 1) ? 'badge-success' : 'badge-danger'; ?> badge-sm badge-pill"><?php echo ($news->active == 1) ? 'Active' : 'Not Active'; ?></span>
                                                </td>
                                                
                                          


                                             <td><a href="{{route('news-edit',[$news->id])}}" class="btn btn-primary btn-sm m-1">Edit</a>
                                              <a onclick="return myFunction();" href="{{route('news-delete',[$news->id])}}" class="btn btn-danger btn-sm m-1">Delete</a></td>
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                            <tfoot>
                                <tr>
                                <th>ID</th>
                                    <th>Title</th>
                                    <th>Brand Name</th>
                                    <th>image</th>
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
<script type="text/javascript"
    src="{{ asset('admin/assets/plugin/datatable/datatables.min.js') }}"></script>
<!-- <script type="text/javascript" src="{{ asset('admin/dist/js/demo/datatable.js') }}"></script> -->
<script>
 function myFunction() {
      if(!confirm("Are you sure to delete this"))
      event.preventDefault();
  }

    function get_dist(val, i) {
        orderStatus = $(val).val();
        orderId = i;

        $.ajax({
            url: "{{ route('order.status') }}",
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                orderStatus: orderStatus,
                orderId: orderId,

            },
            success: function (result) {
                if (result.response.message) {
                    console.log(result.response.message);
                    location.reload();
                }
                //result = JSON.parse(result)

            }
        });

    }

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

        let url = "{{ route('add.news') }}";
        $('<div class="pull-right">' + '' +
            '</div>').appendTo("#myTable_wrapper .dataTables_filter");
        $("#myTable_length").append('<a href="'+url+'" class="btn btn-primary btn-shadow" >Add News</a>');
    

    });
</script>

@endsection
