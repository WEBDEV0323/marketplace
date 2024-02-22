
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
                        <li>My Products</li>
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
                      {{--  <h5 class="panel-title">Seller’s Products</h5>  --}}
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
                        @elseif ( session()->has('error') )
                        <div class="alert alert-icon alert-danger alert-dismissible fade show">
                            <div class="alert--icon">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="alert-text">
                                <strong>Ohh Snap!</strong> {{ session('error') }}
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
                                    <th>Seller’s Name</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Fault Status</th>
                                    <th>New / Pre-Loved</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($data))
                                <?php $counter = 0;?>
                                @foreach($data as $product)
                                <tr>
                                    <td><?php echo ++$counter;?></td>
                                    <td>
                                        @if(isset($product->user))
                                         {{$product->user->first_name}} {{$product->user->last_name}}
                                         @endif
                                    
                                    </td>
                                    
                                    <td>
                                        {{$product->product_parent->product_name}}
                                    </td>
                                    <td>
                                        @foreach($product->prod_size as $product_sizes)
                                             £{{ number_format((float)$product_sizes->sale_price, 2, '.', '')   }}
                                        @endforeach
                                        
                                    </td>
                                    @if($product->fault == 1)
                                    <td><span class="badge badge-warning badge-md badge-pill">Fault</span></td>
                                    @else
                                    <td><span class="badge badge badge-success badge-sm badge-pill">No Fault</span></td>
                                    @endif


                                    @if($product->product_type==1)
                                    <td><p>New</p></td>
                                    @else
                                    <td><p>Pre-Loved</p></td>
                                    @endif 

                                   @if($product->active == 1)
                                        <td><span class="badge badge-success badge-sm badge-pill">Live</span></td>
                                   
                                   @else
                                    <td><span class="badge badge-danger badge-sm badge-pill">Non-Active</span></td>
                                    @endif 

                                    @foreach($product->prod_size as $product_sizes)
                                    
                                    <td><a href="{{route('vendor_product_detail',[$product_sizes->id])}}" class="btn btn-primary btn-sm m-1">Details</a>
                                        <a id="delete" href="{{route('product.delete',[$product->id])}}" class="btn btn-danger btn-sm m-1">Delete</a>
                                    </td>

                                    @endforeach
                                   
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>ID</th>
                                    <th>Seller’s Name</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Fault Status</th>
                                    <th>New / Pre-Loved</th>
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
<script>

    function chgStatus(id,status)
    {
        
       
    

        var val=$("#change").find(":selected").val();
        $.ajax({
            url: "{{ route('product.chgStatus') }}",
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                id : id,
                status: status
                
            },
            success: function(result) {
                if (result.response.message) {


                   
                }


            }
        });



    }


    $(document).on("click", "#delete", function(e) {
        if (confirm('Are you sure to remove this record ?')) {
        } else {
            e.preventDefault();
        }
    });
</script>
@endsection