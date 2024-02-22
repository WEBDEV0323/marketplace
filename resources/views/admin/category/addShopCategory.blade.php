@extends('layouts.admin.master')
@section('styles')
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<link rel="stylesheet" href="{{ asset('admin/assets/plugin/dropzone/dropzone.min.css') }}" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css"
    rel="stylesheet" />


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
                        <li>Category</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Body -->
    <div class="page-body">
       
        <div class="row">
           
        <div class="col-12">
            <div class="panel panel-default border-0 p-4">
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
                    
                    <form action = "{{route('add.shop.process')}}" method = "post">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Parent Category</label>
                                    <select  name = "parent_id" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                        <option  value="0">Select Parent Category</option>
                                        @if(isset($main_categories))
                                            @foreach($main_categories as $main_category)
                                                <option value="{{$main_category['id']}}">{{$main_category['shop_cat_name']}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category Name</label>
                                    <input required type="text" name = "shop_cat_name" id="exampleInputEmail1" placeholder="Enter Category Name">
                                </div>

                                <div class="form-group">
                                    <label for="">Please Select Size</label>
                                    <select required multiple name="sizes[]" class="form-control selectpicker specificpicker" >

                                        @if(isset($sizes))
                                            @foreach($sizes as $size)
                                                <option value="{{ $size->id }}">{{ $size->size }}</option>
                                            @endforeach
                                        @endif
                                        
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Status</label>
                                    <select  name="status" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                    <option value="1">Active</option>
                                    <option value="0">DeActive</option>
                                    </select>
                                </div>

                                <div class="buttons text-left">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                   <a href="{{url()->previous()}}"> <button type="button" class="btn btn-danger">Cancel</button></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      
</div>
</div>
</div>

</div>
@endsection
@section("scripts")

<script>
   

    $(function () {
        $('.selectpicker').selectpicker();
    });

</script>
@endsection
