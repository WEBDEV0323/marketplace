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
    /*display: none; */
    width: 100%;
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
                        <li><a href="#">About</a></li>
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
                           {{-- <span class="panel-title-text">Add Brand</span> --}}
                        </div>
                    </div>

                    <div class="panel-body">
                        @if( session()->has('message') )
                            <div class="alert alert-icon alert-success alert-dismissible fade show">
                                <div class="alert--icon">
                                    <i class="fa fa-check"></i>
                                </div>
                                <div class="alert-text">
                                    <strong>Well done!</strong> {{ session('message') }}
                                </div>
                                <button type="button" class="close" data-dismiss="alert">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @elseif($errors->has('image'))
                            <div class="alert alert-icon alert-danger alert-dismissible fade show">
                                <div class="alert--icon">
                                    <i class="fa fa-thermometer"></i>
                                </div>
                                <div class="alert-text">
                                    <strong>Oh snap!</strong>{{ $errors->first('image') }}
                                </div>
                                <button type="button" class="close" data-dismiss="alert">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        

                        <form action="{{ route('aboutus.banner.update',[$data->id]) }}" method="post" enctype="multipart/form-data" class="brands-form">
                            @csrf
                            <div class="form-group">
                                <label>Type</label>
                                <select name="" class="custom-select" disabled>
                                    <option value="banner_images">Banner</option>
                                    <option value="influencer_images" {{($data->about_type_key == 'influencer_images')?'selected':''}}>Influencer</option>
                                    <option value="testimonial_images" {{($data->about_type_key == 'testimonial_images')?'selected':''}}>Testimonial</option>
                                    <option value="industry_data" {{($data->about_type_key == 'industry_data')?'selected':''}}>Industry Data</option>
                                    <option value="statistics" {{($data->about_type_key == 'statistics')?'selected':''}}>Statistics</option>
                                </select>
                                <input type="hidden" name="image_type" value="{{$data->about_type_key}}">
                            </div>
                            <div class="<?php ($data->about_type_key == 'banner_images' && $data->titile == 'Video')?'form-group':''?>">
                                @if($data->about_type_key == 'banner_images' && $data->titile == 'Video')
                                <label>Banner Video</label>
                                @else
                                    <label>Banner Image</label>
                                @endif
                                <div class="image-box">
                                    @if($data->about_type_key == 'banner_images')
                                        @if($data->titile == 'Video')
                                            <video  id="myVideo" width="200"  controls>
                                                <source src="{{url('/').'/storage/about_us/banner/'.$data->image}}" class="video_here" type="video/mp4">
                                            </video> 
                                        @else
                                        <img id="blah" src="{{url('/').'/storage/about_us/banner/'.$data->image}}" alt="your image"/>
                                        @endif
                                    @elseif($data->about_type_key == 'influencer_images')
                                        <img id="blah" src="{{url('/').'/storage/about_us/influencer/'.$data->image}}" alt="your image"/>
                                    @elseif($data->about_type_key == 'testimonial_images')
                                        <img id="blah" src="{{url('/').'/storage/about_us/testimonial/'.$data->image}}" alt="your image"/>
                                    @elseif($data->about_type_key == 'industry_data')
                                        <img id="blah" src="{{url('/').'/storage/about_us/industry_data/'.$data->image}}" alt="your image"/>
                                    @elseif($data->about_type_key == 'statistics')
                                        <img id="blah" src="{{url('/').'/storage/about_us/statistics/'.$data->image}}" alt="your image"/>
                                    @endif
                                </div>
                                
                                @if($data->about_type_key == 'banner_images' && $data->titile == 'Video')
                                    <div class="video_div" >                        
                                        <input type='file' name="image_video" class="file_multi_video"  accept="video/mp4,video/x-m4v,video/*"/>
                                        <br><br>
                                    </div> 
                                @else
                                <div class="buttons"> 
                                    <span>
                                        Choose
                                        <input type='file' name="image" id="image" onchange="readURL(this);"  accept="image/jpeg, image/png, image/bmp, image/gif, image/webp"/>
                                    </span>
                                    <input type="button" value="Remove" id="remove" class="btn btn-danger">
                                </div>
                                @endif

                            </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="custom-select">
                                        <option value="1" selected=""> Active</option>
                                        <option value="0" {{($data->flags == 0)?'selected':''}}>Deactivated</option>
                                    </select>
                                </div>
                            
                            <div class="buttons">
                                <button type="submit" class="btn btn-primary">Update</button>
                             <a href="{{route("aboutus.banner")}}">   <button type="button"
                                    class="btn btn-danger">Cancel</button></a>
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
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript">
</script>
<script>

$("#remove").click(function(){
    //$('#blah').hide();
    $("#image").val("");
    $("#blah").attr("src","{{url('admin/images/avatar.png')}}");
    $("#blah").css("width", "100%");
});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#blah')
                .attr('src', e.target.result)
               // .width(150)
                //.height(200);
        };
        $('#blah').show();
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function(){
    $(document).on("change", ".file_multi_video", function(evt) {
        let file = event.target.files[0];
        let blobURL = URL.createObjectURL(file);
        document.querySelector("video").style.display = 'block';
        document.querySelector("video").src = blobURL;
    });
})

</script>
@endsection                                          

