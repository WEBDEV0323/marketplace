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
                            <form action = "{{route('brand.edit.process')}}" method = "post" enctype="multipart/form-data" class="brands-form">
                                @csrf

                                <input type="hidden" name="all_remove" value="0" id="all_remove">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brand Name</label>
                                    <input type="text" value = "{{$brand[0]['brand_name']}}" name = "name" id="exampleInputEmail1" placeholder="Enter the Brands name">
                                    <input type="hidden" value = "{{$brand[0]['id']}}" name = "id" >
                                </div>
                                <div class="form-group">
                                    <label>Brand Logo</label>
                                      
                                    <div class="image-box">
                                    @if(strlen($brand[0]['image'])>0) 
                                        <img id="blah" src="<?php echo (!empty($brand[0]['image']) ? $brand[0]['image_url'] : '')?>" alt="your image" />
                                        @else
                                        <img id="blah" class="emp" src="{{url('admin/images/avatar.png')}}"  alt="" />    
                                        @endif  
                                    </div>
                                    

                                    
                                  
                            
                                    <div class="buttons">
                                        <span>
                                            Choose
                                            <input type="file" {{-- value = <?php echo (!empty($brand[0]['image']) ? $brand[0]['image'] : '');?> --}} name="image" id="image" onchange="readURL(this);" />
                                        </span>
                                        <input type="button" value="Remove" id="remove" class="btn btn-danger" onclick="removeImage({{$brand[0]['id']}})">
                                    </div>
                                    
                                </div>

                                
                               
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name = "status" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                        <option value = "1" @if($brand[0]["flags"]==1) selected @endif> Active</option>
                                        <option value = "0" @if($brand[0]["flags"]==0) selected @endif>Deactivated</option>
                                    </select>
                                </div>
                                <div class="buttons">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                  <a href="{{route("brand-home")}}">  <button type="button" class="btn btn-danger">Cancel</button></a>
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

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#blah')
                .attr('src', e.target.result)
        };
        $('#blah').show();

        reader.readAsDataURL(input.files[0]);
    }
}
$(document).ready(function (){
$('#blah').show();
});


function removeImage(id)
{

  // window.location.href= window.location.origin+"/market-place/public/dashboard/remove_brand_image/"+id;
  $("#image").val("");
  //$('#blah').hide();
  $("#blah").attr("src","{{url('admin/images/avatar.png')}}");
  $("#blah").css("width", "100%");
  $("#all_remove").val("1");


}

</script>
@endsection