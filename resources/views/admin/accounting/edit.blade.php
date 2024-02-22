<?php

//non_current_name


$name=$val."_name";
$amount=$val."_amount";
$date=$val."_date";
$note=$val."_note";



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
.border-color-page  th {
   
}






</style>
@endsection
@section('body-content')

{{-- <button type="button" class="btn btn-primary add_amount">Add Amount</button> --}}

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



            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-head">
                            <div class="panel-title">
                                <span class="panel-title-text"></span>
                            </div>
                        </div>
        
                       
                        
                              
                             
                          <form action = "{{route('finantial.edit.process.yes')}}" method = "post" enctype="multipart/form-data" class="brands-form">
                                @csrf

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>

                                    <input type="hidden" value="{{$val}}"  name ="val" id="exampleInputEmail1" placeholder="Enter Name" required>
                                    <input type="hidden" value="{{$data->id ?? ''}}"  name ="id" id="exampleInputEmail1" placeholder="Enter Name" required>
                                    
                                    <input type="text"  value="{{$data->name ?? ''}}"  name = "name" id="exampleInputEmail1" placeholder="Enter Name" required>
                                    
                                </div>

                                <div class="form-group amount_append">
                                    <label for="exampleInputEmail1">Amount</label>
                                  
                                    <input type="text"  value="{{$data->amount}}" class="amount"  id="amount" name = "amount" id="exampleInputEmail1" placeholder="Enter Your Amount" required>                                    
                                   
                                
                                </div>
                               
                                
                                

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Note</label>
                                    
                                    <input type="text" value="{{$data->note ?? ''}}"   name = "note" id="exampleInputEmail1" placeholder="Enter Note" required>
                                    
                                </div>

                               
                                <div class="buttons">
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
  
$(document).ready(function () {    

    $(".add_amount").click(function(){

        $(".amount_append").append('<input type="text"   class="amount" id="amount" name = "amount[]" id="exampleInputEmail1" placeholder="Enter Your Amount" required>');



    });


    
    $('.amount').keypress(function (e) {    

        var charCode = (e.which) ? e.which : event.keyCode    

        if (String.fromCharCode(charCode).match(/[^0-9.]/g))    

            return false;                        
    });    
});   




</script>


@endsection