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
                                    <form action = "{{route('product.stock.update.process')}}" method = "post">
                                       @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="text" name = "stock"class="form-control" id="exampleInputEmail1" placeholder="Enter Stock">
                                           <input type="hidden" name="id" value = "{{$id}}">
                                        </div>
                                        <div class="panel-footer text-right">
                                            <button type="submit" class="btn btn-success mr-2 ">Submit</button>
                                            <button type="reset" class="btn btn-outline btn-secondary btn-outline-1x">Cancel</button>
                                         </div>
                                    </form>
                                </div>
                            </div>
                        </div>
      

</div>
</div>
</div>
@endsection
