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
                            <div id = "popup_show" class="alert alert-icon  alert-dismissible fade ">
                                <div class="alert--icon">
                                    <i class="fa fa-check"></i>
                                </div>
                                <div id = "text_popup" class="alert-text">
                                      
                                </div>
                                <button type="button" class="close" data-dismiss="alert">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            
                             
        <div class="row">

            <div class="col-12">
                <div class="panel panel-default">
                    <div class="panel-head">
                        <div class="panel-title">
                            <span class="panel-title-text">Buy Stock</span>
                        </div>
                    </div>

                    <div class="panel-body">
                        <p class="text-muted mb-4">Buy Your Product Stock</p>
                        <form >
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Number of Quantity</label>
                                <input type="text" name="stock" value = "<?php echo $data->quantity;?>" disabled class="form-control" 
                                    placeholder="Enter Stock">
                                <input type="hidden" id = "vendor_product_id" name="id" value="{{ $id }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price</label>
                                <input type="text" name="price"  class="form-control" value = "$<?php echo $data->price;?>"  placeholder="Enter Stock Price" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Name</label>
                                <input type="text" name="price"  class="form-control" value = "<?php echo $data->product->product_name;?>"  placeholder="Enter Stock Price" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Size</label>
                                <?php 
                                
                                $size = json_decode($data->size);
                                

                                ?>
                                <select disabled multiple name="size[]" class="form-control selectpicker">
                                @if(isset($sizes))
                                    @foreach($sizes as $size)
                                    @if(array_search($size['id'],$size))
                                    <option  selected value="{{ $size['id'] }}">{{ $size['size'] }}</option>
                                    @else
                                    <option value="{{ $size['id'] }}">{{ $size['size'] }}</option>
                                    @endif
                                        
                                    @endforeach
                                @endif
                                </select>
                                
                            </div>
                            <div class="panel-footer ">
                                <button id = "purchase" class="btn btn-success mr-2 ">Perchase</button>
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
@section('scripts')
<script>
    $(function () {
        $('.selectpicker').selectpicker();
    });
$(document).ready(function(){
    $("#purchase").on('click',function(e){
        e.preventDefault();
        
    vendor_product_id = $('#vendor_product_id').val();
        
    confirm =  confirm("Are you sure you want to purchase this?");
    if(confirm){
       
        $.ajax({
			url: "{{ route('admin_stock_purchased') }}",
			method: 'post',
			data: {
                "_token": "{{ csrf_token() }}",
                vendor_product_id:vendor_product_id,
			},
			success: function(result){
				var obj = jQuery.parseJSON(result);
                if(obj.Error){
                    $('#popup_show').addClass('alert-danger'); 
                    $('#popup_show').addClass('show').find('.alert-text').html(obj.Error);
                }else if(obj.message){
                    $('#popup_show').addClass('alert-success'); 
                    $('#popup_show').addClass('show').find('.alert-text').html(obj.message);
                } 
                console.log(result);
                
			}});
    }
    else{
        alert('no');
    }
    });
});
    
</script>
@endsection
