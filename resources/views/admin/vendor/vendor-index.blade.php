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
                        <li>Vendor</li>
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


                    <div class="align-middle">
                        
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
                            <table class="table table-head-bg table-head-primary table table-striped table-bordered basic-datatable" cellspacing="0" width="100%" id="myTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        @if (\Route::is('affiliates'))
                                            <th>Sales</th>
                                            <th>Total Commission</th>
                                            <th>Payout Amount</th>
                                            <th>Payout Email</th>
                                        @else
                                            <th>Status</th>
                                        @endif
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if(isset($data))
                                    @foreach($data as $vendor)

                                    <tr>
                                        <td>{{$vendor->id}}</td>
                                        <td>{{$vendor->first_name}} {{$vendor->last_name}}</td>
                                        <td>{{$vendor->email}}</td>
                                        @if (\Route::is('affiliates'))

                                        {{-- <td>£{{number_format((float)$vendor->totalPrice, 2, '.', '')}}</td>
                                        <td>£{{number_format((float)$vendor->commission, 2, '.', '')}}</td>
                                        <td>£{{number_format((float)$vendor->payoutAmount, 2, '.', '')}}</td> --}}
                                       <?php 
                                       $totalPrice = 0;
                                       $commission = 0;
                                       $payoutAmount = 0;
                                             $orderId = \App\Models\OrderDetail::select('order_id')
                                            ->where("order_details.product_owner_id",'=',$vendor->id)
                                            ->groupBy('order_id')->pluck('order_id');

                                            if($orderId){
                                                $total_data = \App\Models\Order::select(DB::raw('SUM(orders.total_price) as `total_amount`'),DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"))
                                                    ->whereIn("id", $orderId)
                                                    ->groupby('monthyear')
                                                    ->get(); 
                                                if(count($total_data) > 0){
                                                    foreach($total_data as $rowdata){
                                                        $getamount = $rowdata->total_amount;
                                                        $totalPrice += $rowdata->total_amount;
                                                        if($getamount > 10000 && $getamount < 20000){
                                                                $commission += ($getamount * 2.5) / 100;
                                                            }elseif($getamount > 20000 && $getamount < 50000){
                                                                $commission += ($getamount * 3) / 100;
                                                            }elseif($getamount > 50000){
                                                                $commission += ($getamount * 5) / 100;
                                                            }elseif($getamount < 1){
                                                                $commission += 0;
                                                            }else{
                                                                $commission += ($getamount * 2) / 100;
                                                            } 
                                                    }
                                                }
                                            }  

                                            $checkPaidStatus = \App\Models\affiliate_payment::where('user_id',$vendor->id)
                                                        ->where('payment_status','1')
                                                        ->get();
                                            if($checkPaidStatus){
                                                $payoutAmount = $commission - $checkPaidStatus->sum('commission');
                                            }                                           
                                            if($payoutAmount < 0){
                                                $payoutAmount = 0;
                                            }

                                       ?>
                                        <td>£{{number_format((float)$totalPrice, 2, '.', '')}}</td>
                                        <td>£{{number_format((float)$commission, 2, '.', '')}}</td>
                                        <td>£{{number_format((float)$payoutAmount, 2, '.', '')}}</td>
                                        <td>{{$vendor->selling_paypal_email}}</td>
                                        @else

                                        <td><span class="badge badge-success badge-sm badge-pill">Verified</span>
                                        </td>
                                        @endif

                                        <td>
                                            {{-- @if(Route::is('affiliates'))<a href="{{ route('edit.view', ['id' => $vendor->id ]) }}" class="btn btn-primary btn-sm m-1">View</a>@endif --}}
                                            <a href="{{ route('edit.user', ['id' => $vendor->id ]) }}" class="btn btn-primary btn-sm m-1">Edit</a>
                                            <a href="{{ route('delete-user', ['id' => $vendor->id ]) }}" class="btn btn-danger btn-sm m-1" id="delete">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>
                               
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

<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/jquery.dataTables.min.js" type="text/javascript"></script>





<script type="text/javascript" src="{{asset('admin/assets/plugin/datatable/datatables.min.js')}}"></script>




<script>
    var exampleTable = $('#myTable').DataTable({
        aLengthMenu: [
            [25, 50, 100, 200],
            [25, 50, 100, 200]
        ],
        iDisplayLength: 25,
    });

    $(document).ready(function() {
        let url = "{{ route('add.user','user=seller') }}";
        let btnText = "Add Seller";
        if (window.location.href.indexOf("affiliates") > -1) {
            url = "{{ route('add.user','user=affiliate') }}";
            btnText = "Add Affiliate";
        }
        $('<div class="pull-right">' + '' +
            '</div>').appendTo("#myTable_wrapper .dataTables_filter");
        $("#myTable_length").append('<a href="'+url+'" class="btn btn-primary btn-shadow" >'+btnText+'</a>');
    

    });
</script>
<script>
    $(document).on("click", "#delete", function(e) {
        if (confirm('Are you sure to remove this record ?')) {} else {
            e.preventDefault();
        }
    });
</script>

@endsection