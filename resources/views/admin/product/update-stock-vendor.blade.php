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
                        <li>Product</li>
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
                        <div class="panel-title">
                            <span class="panel-title-text">Add Stock</span>
                        </div>
                    </div>
                    <div class="panel-body">
                        <p class="text-muted mb-4">Add Your Product Stock</p>
                        <form action="{{ route('vendor.product.stock.update.process') }}"
                            method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Number of Quantity</label>
                                <input type="text" name="stock" class="form-control" 
                                    placeholder="Enter Stock">
                                <input type="hidden" name="id" value="{{ $id }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price</label>
                                <input type="text" name="price" class="form-control"  placeholder="Enter Stock Price">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Size</label>
                                <select multiple name="size[]" class="form-control selectpicker">
                                @if(isset($sizes))
                                    @foreach($sizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->size }}</option>
                                    @endforeach
                                @endif
                                </select>
                                
                            </div>
                            <div class="panel-footer text-right">
                                <button type="submit" class="btn btn-success mr-2 ">Submit</button>
                                <button type="reset"
                                    class="btn btn-outline btn-secondary btn-outline-1x">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(function () {
        $('.selectpicker').selectpicker();
    });
</script>
@endsection
