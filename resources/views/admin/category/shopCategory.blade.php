@extends('layouts.admin.master') @section('styles')
<link rel="stylesheet" href="{{asset('admin/assets/plugin/datatable/datatables.min.css')}}" /> @endsection @section('body-content')
<div class="page-wrapper">
	<!-- Page Title -->
	<div class="page-title">
		<div class="row align-items-center">
			<div class="col-sm-6">
				<h2 class="page-title-text"></h2> </div>
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
							<table class="table table-head-bg table-head-primary table table-striped table-bordered basic-datatable" cellspacing="0" width="100%" id="myTable">
								<thead>
									<tr>
										<th>ID</th>
										<th>Name</th> 
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody> @if(isset($shop_categories)) @foreach($shop_categories as $shop_category)
									<tr>
										<td>{{$shop_category['id']}}</td>
										<td>{{$shop_category['shop_cat_name']}}</td>
                                         @if($shop_category['flags'] == 1)
										<td><span class="badge badge-success badge-sm badge-pill">{{App\Models\ShopCategory::STATUS_ACTIVE}}</span></td> 
                                        @else
										<td><span class="badge badge-danger badge-sm badge-pill">{{App\Models\ShopCategory::STATUS_NOT_ACTIVE}}</span></td> @endif
										<td><a href="{{ route('edit.category', ['id' => $shop_category['id']]) }}" class="btn btn-primary btn-sm m-1">Edit</a> <a href="{{ route('delete.category', ['id' => $shop_category['id']]) }}" id="delete" class="btn btn-danger btn-sm m-1">Delete</a> </td>
									</tr> @endforeach @endif </tbody>
								<tfoot>
									<tr>
										<th>ID</th>
										<th>Name</th>
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
</div> @endsection @section('scripts')
<script type="text/javascript" src="{{asset('admin/assets/plugin/datatable/datatables.min.js')}}"></script>
<!-- <script type="text/javascript" src="{{asset('admin/dist/js/demo/datatable.js')}}"></script> -->
<script>
$(document).on("click", "#delete", function(e) {
	if(confirm('Are you sure to remove this record ?')) {} else {
		e.preventDefault();
	}
});
var exampleTable = $('#myTable').DataTable({
	aLengthMenu: [
		[25, 50, 100, 200],
		[25, 50, 100, 200]
	],
	iDisplayLength: 25,
	order: [[2, 'ASC']],
});
$(document).ready(function() {
	let url = "{{route('add.shop.category')}}";
	$('<div class="pull-right">' + '' + '</div>').appendTo("#myTable_wrapper .dataTables_filter");
	$("#myTable_length").append('<a href="' + url + '" class="btn btn-primary btn-shadow" >Add Category</a>');
});
</script>
<script>
function filter(id) {
	//alert(window.location.href);
	const url = window.location.href;
	///alert(url);
	const newUrl = url.slice(0, url.lastIndexOf('/'));
	let result = newUrl.includes("filter-category");
	if(result == false) {
		window.location.href = newUrl + "/filter-category/" + id;
	} else {
		window.location.href = newUrl + "/" + id;
	}
}
</script> @endsection