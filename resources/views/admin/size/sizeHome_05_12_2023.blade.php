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
				<h2 class="page-title-text">Home Page Setting</h2> </div>
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
					<div class="panel-body"> @if ( session()->has('message') )
						<div class="alert alert-icon alert-success alert-dismissible fade show">
							<div class="alert--icon"> <i class="fa fa-check"></i> </div>
							<div class="alert-text"> <strong>Well done!</strong> {{ session('message') }} </div>
							<button type="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
						</div> @elseif(session()->has('error'))
						<div class="alert alert-icon alert-danger alert-dismissible fade show">
							<div class="alert--icon"> <i class="fa fa-thermometer"></i> </div>
							<div class="alert-text"> <strong>Oh snap!</strong> {{ session('error') }} </div>
							<button type="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
						</div> @endif
						<div class="table-responsive">
							<table id="myTable" class="table table-head-bg table-head-primary table table-striped table-bordered basic-datatable" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th style="width:20%;">IDs</th>
										<th style="width:20%;">Name</th>
										<th style="width:40%;">Guide Sizes</th>
										<th style="width:20%;" >Action</th>
									</tr>
								</thead>
								<tbody> @if(isset($data)) @foreach($data as $size)
									<tr>
										<!-- <td>{{$size['size_id']}}</td> -->
										<td>{{ $loop->iteration }}</td>
										<td>{{$size['size']}}</td>
										<td>
											@php 
												$allSizeGuide = App\Models\SizeGuide::where('size_id',$size['id'])->get();	
												$i = 1;
											@endphp
											@if(count($allSizeGuide) > 0)											
												@foreach($allSizeGuide as $row)
													@if($i > 1) ,@endif <span>{{$row->guide_size}}</span>
													@php $i++; @endphp
												@endforeach
											@endif
										</td>
										<td><a href="{{route('sizeEdit',['id'=>$size['id']])}}" class="btn btn-primary btn-sm m-1">Edit</a> <a href="{{route('sizeDelete',['id'=>$size['id']])}}" onclick="return confirm('Are you sure want to delete this size and it will delete all from the product size?');" class="btn btn-danger btn-sm m-1">Delete</a></td>
									</tr> @endforeach @endif </tbody>
								<tfoot>
									<tr>
										<th>ID</th>
										<th>Name</th>
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
    <!-- <script type="text/javascript" src="{{asset('admin/dist/js/demo/datatable.js')}}"></script> -->

    <script>
    var exampleTable = $('#myTable').DataTable({
        aLengthMenu: [
            [25, 50, 100, 200],
            [25, 50, 100, 200]
        ],
        iDisplayLength: 25,
        order: [[2, 'ASC']]
    });

    $(document).ready(function() {

    	 let url = "{{route('add.size', ['brand_id' => $brand_id, 'category_id' => $category_id,'gender' => $gender])}}";
        //let url = "{{route('add.size')}}";
        $('<div class="pull-right">' + '' +
            '</div>').appendTo("#myTable_wrapper .dataTables_filter");
        $("#myTable_length").append('<a href="'+url+'" class="btn btn-primary btn-shadow" >Add Size</a>');
    

    });
</script>
@endsection