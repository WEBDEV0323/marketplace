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
                        <li>User</li>
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
                    {{--    <h5 class="panel-title">Seller Requests</h5> --}}
                    </div>

                    <div class="panel-body">
                        <div class="alert alert-icon alert-success alert-dismissible fade ">
                            <div class="alert--icon">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="alert-text">
                                <strong>Well done!</strong>
                            </div>
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="table-responsive">
                        <table
                            class="table table-head-bg table-head-primary table table-striped table-bordered basic-datatable"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th style="width:20%;">Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @if(isset($data))
                                    @foreach($data as $user_request_vendor)

                                        <tr>
                                            <td>{{ $user_request_vendor->id }}</td>
                                            <td>{{ $user_request_vendor->users->first_name??'' }} {{ $user_request_vendor->users->last_name??'' }}</td>
                                            <td>{{ $user_request_vendor->users->email??'' }}</td>
                                            <td style="   display: flex;
    justify-content: center;
    align-items: center;
    gap: 16px !important; ">
                                             

                                         <div>

                                            <select size="1" class="form-control m-0 selectuser" ;
                                                    onchange="get_dist(this,<?php echo $user_request_vendor->id;?>)"
                                                    id="user_request{{ $user_request_vendor->id }}"
                                                    name="user_request{{ $user_request_vendor->id }}">   
                                                    <option value="2"
                                                        {{ ($user_request_vendor->flags == 2 ? 'selected ' :  'selected') }}>
                                                        Pending
                                                    </option>
                                                    <option value="0"
                                                        {{ ($user_request_vendor->flags == 1 ? 'selected ' : '') }}>
                                                        Seller
                                                    </option>
                                                    <option value="3"
                                                        {{ ($user_request_vendor->flags == 1 && $user_request_vendor->affiliate_status == '1' ? 'selected ' : '') }}>
                                                        Affiliate
                                                    </option>
                                                    <option value="1"
                                                        {{ ($user_request_vendor->flags == 0 ? 'selected' : '') }}>
                                                        User
                                                    </option>

                                                </select>
                                                </div>
                                                <div >
                                                <a  href="{{ route('edit.view', ['id' => $user_request_vendor->user_id ]) }}" class="btn btn-primary btn-sm m-1">View</a> 
                                                </div>                                            

                                            
                                           
                                          
                                            
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
<script type="text/javascript" src="{{ asset('admin/dist/js/demo/datatable.js') }}"></script>
<script>
    function get_dist(val, i) {
        userStatus = $(val).val();
        user_request_id = i;
        //if (confirm("Are you sure this user become a vendor?")) {
        $.ajax({
            url: "{{ route('user_request.status') }}",
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                userStatus: userStatus,
                user_request_id: user_request_id,

            },
            success: function (result) {
                console.log(result);
                result = JSON.parse(result);
                if (result.message) {
                    $('.alert-dismissible').addClass('show').find('.alert-text').html(result.message);
                    setTimeout(function() {$('.alert-dismissible').removeClass('show')}, 5000);
                    //$('.table-striped').DataTable().ajax.reload();
                    //$('.basic-datatable').DataTable().ajax.reload();
                }




            }
        });
        //}

    }

</script>

@endsection
