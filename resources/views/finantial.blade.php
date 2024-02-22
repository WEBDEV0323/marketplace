


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

                            <a href="{{route('view_finantial_form',["val"=>$val])}}"
                                                    class="btn btn-primary btn-sm m-1">
                                                    <button type="button" class="btn btn-primary add_amount">Add Statement</button>
                                                </a>
                                                @if($val=="opening_inventory" || $val=="purchases" || $val=="carrige_in" || $val=="returns_out" || $val=="closing_inventory" || $val=="incomes" || $val=="expenses" )
                                                <a href="{{route('IncomeStatement')}}"
                                                    class="btn btn-primary btn-sm m-1">
                                                    <button type="button" class="btn btn-primary add_amount">Submit</button>
                                                </a>   
                                                @else
                                                <a href="{{route('FinancialStatement')}}"
                                                    class="btn btn-primary btn-sm m-1">
                                                    <button type="button" class="btn btn-primary add_amount">Submit</button>
                                                </a>   

                                                
                                                
                                               @endif             
                            


                                <span class="panel-title-text"></span>
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
                            


                            <div class="table-responsive">
                            <table class="table table-head-bg table-head-primary table table-striped table-bordered basic-datatable " cellspacing="0" width="100%">
                                <thead>
                                    <tr class="border-color-page">
                                    <th style="border-right-color: #00a9ec !important; min-width: 30px;">Name</th>
                                        <th style="border-right-color: #00a9ec !important; min-width: 30px;">Amount</th>
                                        <th style="border-right-color: #00a9ec !important; max-width: 100px;">Note</th>
                                       
                                        <th style="border-right-color: #00a9ec !important; max-width: 30px;">Action</th>
                                        
                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>

                              
                             
                                @foreach($records as $r)
                                    <tr>
                                    <td>{{$r->name}}</td>
                                        <td>
                                       {{ number_format($r->amount, 2) }}
                                      
                                       
                                        </td>
                                        
                                        <td style="width:50%; text-align:left;">{{$r->note}}</td>
                                       
                                        <td style="width:13%">
                                      
                                        <a href="{{route('edit_finantial_form',["id"=>$r->id,"val"=>$val])}}"
                                                    class="btn btn-primary btn-sm m-1">View</a>
                                                     <a href="{{route('delete_finantial_form',["id"=>$r->id])}}"
                                                    class="btn btn-danger btn-sm m-1">Delete</a>

                                                 
                                        </td>

                                 @endforeach       

                                       
                                    
                                    
                                   
                                    </tr>
                                   

                                </tbody>
                               
                            </table>
                        </div>







                      {{--      <form action = "{{route('finantial.edit.process')}}" method = "post" enctype="multipart/form-data" class="brands-form">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="hidden" value ="{{$val}}" name ="val" id="exampleInputEmail1" placeholder="Enter Your Name">
                                    <input type="text" value ="{{$data->$name}}" name = "name" id="exampleInputEmail1" placeholder="Enter Your Name">
                                    
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Amount</label>
                                    <input type="text"  value ="{{$data->$amount}}" class="amount" id="amount" name = "amount" id="exampleInputEmail1" placeholder="Enter Your Amount">
                                    
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Date</label>
                                    <input type="date"  value ="{{$data->$date}}" name = "date" id="exampleInputEmail1" placeholder="Enter Your Date">
                                    
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Note</label>
                                    <input type="text"  value ="{{$data->$note}}" name = "note" id="exampleInputEmail1" placeholder="Enter Your Note">
                                    
                                </div>
                               
                                <div class="buttons">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn btn-danger">Delete</button> 
                                </div>
                            </form>   --}}
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
    
    $('.amount').keypress(function (e) {    

        var charCode = (e.which) ? e.which : event.keyCode    

        if (String.fromCharCode(charCode).match(/[^0-9]/g))    

            return false;                        

    });    

});   

</script>


@endsection