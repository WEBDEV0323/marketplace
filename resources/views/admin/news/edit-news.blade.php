@extends('layouts.admin.master')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

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
        display: block;
        height: 150px;
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
                        <li><a href="#">News</a></li>
                        <li><a href="#">Add</a></li>
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
                          {{--  <span class="panel-title-text">Add News</span>  --}}
                        </div>
                    </div>

                    <div class="panel-body">

                        <form action="{{ route('edit-news-process') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row white-box-div news-row">
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" name="title" value="<?php echo $news->title; ?>" class="form-control">
                                                <input type="hidden" name="id" value="<?php echo $news->id; ?>" class="form-control">
                                            </div>
                                        </div>
                                      
                                      
                                      	<div class="col-md-6">
                                        <div class="dropdown-news">
                                            <label>Section</label>

                                            <select class="dropdown-news" name="section">
                                                <option value="Featured" {{ $news->section == 'Featured' ? 'selected' : '' }}>Featured</option>
                                                <option value="Top Trending" {{ $news->section == 'Top Trending' ? 'selected' : '' }}>Top Trending</option>
                                                <option value="Most Recent" {{ $news->section == 'Most Recent' ? 'selected' : '' }}>Most Recent</option>
                                                <option value="Other Article" {{ $news->section == 'Other Article' ? 'selected' : '' }}>Other Article</option>
                                            </select>
                                        </div>
                                    </div>

                                      
                                      
                                    </div>  
                                      
                                      
                                      
                                    <div class="row">  
                                      
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Author Name</label>
                                                <input type="text" name="created_name" value="<?php echo $news->created_name; ?>" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-5 mt-0 mt-lg-4">
                                            <div class="form-group">
                                                <label>Brand</label>
                                                <select name="brand" class="form-control">
                                                    @foreach($brands as $brand)
                                                    @if($brand->id == $news->brand_id)
                                                    <option value="{{$brand->id}}" selected>{{$brand->brand_name}}</option>
                                                    @else
                                                    <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                                    @endif

                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-5 mt-0 mt-lg-4">
                                            <div class="form-group">
                                                <label>Action</label>
                                                <select name="status" class="form-control">
                                                    @if($news->active == 0)
                                                    <option value="1">Publish</option>
                                                    <option value="0" selected>Draft</option>
                                                    @else
                                                    <option value="1">Publish</option>
                                                    <option value="0">Draft</option>
                                                    @endif
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-5 mt-0 mt-lg-4">
                                            <div class="form-group">
                                                <label>Views</label>
                                                <input type="text" value="<?php echo thousand_format($news->visit); ?>" class="form-control" disabled>
                                                
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-2 mt-0 mt-lg-4">
                                            <div class="form-group">
                                                
                                                <label class="text-white">Views</label>
                                               <a href="{{url('/')}}/news/<?php echo $news->news_slug; ?>"> <input type="button" value="preview" class="mb-0 d-block" style=" text-transform: capitalize; line-height: 44px; background:#00a9ec;color:#fff; width: 120px"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group text-center">
                                        <label>Main Images</label>

                                        <div class="image-box mx-auto">
                                            <img id="blah" src="<?php echo $news->news_image_url; ?>" alt="your image" />
                                        </div>
                                        <div class="buttons justify-content-center">
                                            <span>
                                                Choose
                                                <input type='file' accept="image/*" name="image" onchange="readURL(this);" />
                                            </span>
                                            <input type="button" value="Remove" onclick="removeImage()" class="btn btn-danger">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea required name="description"><?php echo $news->description; ?></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="buttons text-left mb-0">
                                        <button type="submit" class="btn btn-primary ">Submit</button>
                                       <a href="{{route('news_all');}}"> <button type="button" class="btn btn-danger">Cancel</button></a>
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


@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript">
</script>
<script>
    /* $("#file-1").fileinput({
    theme: 'fa',
    uploadUrl: '#',
    allowedFileExtensions: ['jpg', 'png', 'gif'],
    overwriteInitial: false,
    maxFileSize: 2000,
    maxFilesNum: 10,
    slugCallback: function(filename) {
        return filename.replace('(', '_').replace(']', '_');
    }
}); */
    CKEDITOR.replace('description');

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };
            $('#blah').show();

            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeImage(){
        $('#blah').hide();
        $('#blah').attr('src', '');
    }
</script>
@endsection