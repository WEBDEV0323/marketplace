

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
                        <li>Order</li>
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
                      {{--  <h5 class="panel-title">Admin Orders</h5> --}}
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
                        <table class="table table-head-bg table-head-primary table table-striped table-bordered basic-datatable" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Reference</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Product</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                   
                                    <th>Status</th>
                                   
                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            @if(isset($data))
                                @foreach($data as $key=>$order)
                                
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{date_format($order->created_at,'d/m/Y - H:i') ?? ''}}</td>
                                    <td>{{ strtoupper($order->reference)}}</td>
                                    <td>{{$order->user->first_name ?? ''}} {{$order->user->last_name ?? ''}}</td>
                                    <td>{{$order->user->email ?? ''}}</td>
                                    @if($order->count >1) <td style="color:red;"> Multiple </td> @else <td> {{$order->product_name ?? ''}} </td> @endif
                                    @if($order->count >1) <td style="color:red;" > Multiple </td> @else <td> {{$order->size ?? ''}} </td>> @endif
                                    <td>£{{ number_format((float)$order->final_price, 2, '.', '') ?? ''}}</td>
                                   
                                    
                                    
                                    <td><select <?php if($order->status == 'refunded') echo 'disabled'; ?>  size="1" class="form-control m-0 selectOrder" onchange = "get_dist(this,<?php echo $order->id;?>)" id="order{{$order->id}}"  name="order{{$order->id}}">
                                        <option value="processing" {{ ($order->status == 'processing' ? 'selected' : '')}}>
                                            Processing
                                        </option>
                                        <option value="completed" {{ ($order->status == 'completed' ? 'selected ' : '')}}>
                                            Completed
                                        </option>
                                        <option value="refunded" {{ ($order->status == 'refunded' ? 'selected ' : '')}}>
                                            Refunded
                                        </option>
                                        <option value="cancelled" {{ ($order->status == 'cancelled' ? 'selected ' : '')}}>
                                            Cancelled
                                        </option>
                                        <option value="onhold" {{ ($order->status == 'onhold' ? 'selected' : '')}}>
                                            On-hold
                                        </option>
                                    </select></td>

                                    
                                    <td>
                                        <a href = "{{ route('product.by.id', ['id' => $order->product_id]) }}" class="btn btn-primary btn-sm m-1">Product</a> 
                                        <a href = "{{ route('order.detail.buyer', ['id' => $order->id]) }}" class="btn btn-primary btn-sm m-1">View</a> 
                                        <a href = "{{ route('order.delete', ['id' => $order->id]) }}" class="btn btn-danger btn-sm m-1">Delete</a>
                                    </td> 
                                </tr>
                                @endforeach
                            @endif  
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Total Amount</th>
                                    <th>Payment Type</th>
                                    <th>Status</th>
                                    <th>Action Orders</th>
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
<!--<script type="text/javascript" src="{{asset('admin/dist/js/demo/datatable.js')}}"></script>-->
<script>
$(document).ready(function () {
  var exampleTable = $('#myTable').DataTable({
	order: [[1, 'ASC']],
});  
});
  function get_dist(val , i){
     orderStatus =  $(val).val();
     orderId = i;

     $.ajax({
        url: "{{ route('order.status') }}",
			method: 'post',
			data: {
				_token: "{{ csrf_token() }}",
                orderStatus:orderStatus,
                orderId:orderId,
			
			},
			success: function(result){
				if(result.response.message){
                   console.log(result.response.message);
                    location.reload();
                }
                //result = JSON.parse(result)
				
            }
    });
   
  }
</script>

@endsection