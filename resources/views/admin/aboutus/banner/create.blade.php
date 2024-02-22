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
                        @elseif($errors->has('image_video'))
                            <div class="alert alert-icon alert-danger alert-dismissible fade show">
                                <div class="alert--icon">
                                    <i class="fa fa-thermometer"></i>
                                </div>
                                <div class="alert-text">
                                    <strong>Oh snap!</strong>{{ $errors->first('image_video') }}
                                </div>
                                <button type="button" class="close" data-dismiss="alert">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        

                        <form action="{{ route('aboutus.banner.store') }}" method="post" enctype="multipart/form-data" class="brands-form">
                            @csrf
                            <div class="form-group">
                                <label>Type</label>
                                <select name="image_type" class="custom-select">
                                    <option value="banner_images"> Banner</option>
                                    <option value="influencer_images">Influencer</option>
                                    <option value="testimonial_images">Testimonial</option>
                                    <option value="industry_data">Industry Data</option>
                                    <option value="statistics">Statistics</option>
                                </select>
                            </div>
                            <span class="BannerSection">
                                <div class="form-group">
                                    <label>Banner Image/Video</label>  
                                </div>
                                <div>     
                                    <input type="radio" id="html_image" name="banner_image_video" value="image_radio" checked class="radio_btn_image_cls">
                                    <label for="html_image" class="radio_btn_image_cls">Image</label>  &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" id="html_video" name="banner_image_video" value="video_radio" class="radio_btn_video_cls">
                                    <label for="html_video" class="radio_btn_video_cls">Video</label><br><br> 
                                    <div class="video_div" style="display: none">  
                                        <video width="320" height="240" style="display:none" controls autoplay>
                                            Your browser does not support the video tag.
                                        </video><br>                                                         
                                        <input type='file' name="image_video" class="file_multi_video" accept="video/mp4,video/x-m4v,video/*"/>
                                        <br><br>
                                    </div> 
                                </div>
                            </span>


                            <div class="form-group image_div">
                                <label>Banner Image</label>
                                <div class="image-box">
                                    <img id="blah" src="{{url('admin/images/avatar.png')}}" alt="your image" />
                                </div>
                                <div class="buttons"> 
                                    <span>
                                        Choose
                                        <input type='file' name="image" id="image" onchange="readURL(this);"  accept="image/jpeg, image/png, image/bmp, image/gif, image/webp"/>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="buttons">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
    $(document).on('change','.custom-select', function() {
            if(this.value == 'banner_images'){
                $('.BannerSection').css('display','block');                
               var valueget = $('input[name="banner_image_video"]:checked').val();
               if(valueget == 'video_radio'){
                    $('.image_div').css('display','none');
                    $('.video_div').css('display','block');
               }else{
                    $('.image_div').css('display','block');
                    $('.video_div').css('display','none');
               }
            }else{
                $('.BannerSection').css('display','none');
                $('.image_div').css('display','block');
            }
    });

     $(document).on('change','.radio_btn_image_cls', function() {
        $('.image_div').css('display','block');
        $('.video_div').css('display','none');
     });
     $(document).on('change','.radio_btn_video_cls', function() {
        $('.image_div').css('display','none');
        $('.video_div').css('display','block');
     });

})



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

