<?php

use App\Models\Brand;


?>
@extends('layouts.admin.master')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all"
    rel="stylesheet" type="text/css" />

<style>
.main-section {
    margin: 0 auto;
    padding: 20px;
    margin-top: 100px;
    background-color: #fff;
    box-shadow: 0px 0px 20px #c1c1c1;
}

.fileinput-remove,
.fileinput-upload {
    display: none;
}

#blah {
    display: none;
}
</style>
@endsection
@section('body-content')
<div class="page-wrapper">
    <!-- Page Title -->
        <div class="page-title">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h2 class="page-title-text">
                
                    </h2>
                </div>
                <div class="col-sm-6 text-right">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Brands</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Body -->
        <div class="page-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-head">
                            <div class="panel-title">
                              {{--  <span class="panel-title-text">Edit Brand Details</span> --}}
                            </div>
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
                            <!-- <p class="text-muted mb-4">Add Your Brand of Product</p> -->
                            <form action = "{{route('commission.edit.process')}}" method = "post" enctype="multipart/form-data" class="brands-form">
                                @csrf

                              
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Shipping Fee</label>
                                    <input type="text" value = "{{$commission->shipping}}" name = "name" class="number" id="exampleInputEmail1" placeholder="Enter Commission Percentage">
                                    <input type="hidden" value = "{{$commission->id}}" name = "id" >
                                </div>
                                <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                </div>

                                
                               
                               
                               
                            </form>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>

      
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript">
</script>
<script>


    $('.number').keypress(function(event) {
      if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
      }
    });


</script>
@endsection