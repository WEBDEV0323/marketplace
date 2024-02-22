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
    <!-- Page Body -->
    <div class="page-body">
        <div class="row">
           
        <div class="col-12">
                            <div class="panel panel-default">
                            <a href = "{{route('add.category')}}" class="btn btn-primary btn-shadow m-1 float-right">Add Category</a>
                            
                                <div class="panel-head">
                                    <h5 class="panel-title">Categories</h5>
                                </div>
                                
                                <div class="panel-body">
                                    <table class="table table-striped table-bordered basic-datatable" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @if(isset($categories))
                                               @foreach($categories as $category) 
                                                
                                                <tr>
                                                <td>{{$category['id']}}</td>
                                                <td>{{$category['name']}}</td>
                                                <td><button class="btn btn-primary btn-sm m-1">Edit</button> <button class="btn btn-danger btn-sm m-1">Delete</button></td>
                                                </tr>
                                                @endforeach
                                            @endif
                                          
                                        </tbody>
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
@endsection
@section('scripts')
<script type="text/javascript" src="{{asset('admin/assets/plugin/datatable/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/dist/js/demo/datatable.js')}}"></script>
@endsection