@extends('layouts.admin.master')

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
                        <li>Category</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Body -->
    <div class="page-body">
        <div class="panel-title">
            <span class="panel-title-text">Add Category</span>
        </div>
        <p class="text-muted mb-4">Add Your Main Product Categories</p>
        <div class="row">
           
        <div class="col-12">
            <div class="panel panel-default">
                <div class="panel-head">
                    
                </div>
                <div class="panel-body">
                    
                    <form action = "{{route('category.store')}}" method = "post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name = "name"class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                            
                        </div>
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-success mr-2 ">Submit</button>
                            <button type="reset" class="btn btn-outline btn-secondary btn-outline-1x">Cancel</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
      


</div>
@endsection
