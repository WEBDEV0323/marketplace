@extends('layouts.admin.master')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all"
    rel="stylesheet" type="text/css" />
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
                         {{--   <span class="panel-title-text">Add News</span>  --}}
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
                        <form action="{{ route('add_news_process') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row white-box-div news-row">
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" name="title" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="dropdown-news">
                                            <label>Section</label>
                                            <select class="dropdown-news" name="section">
                                              <option value="Featured" selected="">Featured</option>
                                              <option value="Top Trending">Top Trending</option>
                                              <option value="Most Recent">Most Recent</option>
                                              <option value="Other Article">Other Article</option>
                                            </select>
                                        </div>
                                        </div>
                                        <div class="col-md-4 mt-0 mt-lg-5">
                                            <div class="form-group">
                                                <label>Brand</label>
                                                <select name="brand" class="form-control">
                                                    @foreach($brands as $brand)
                                                    <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-0 mt-lg-5">
                                            <div class="form-group">
                                                <label>Action</label>
                                                <select name="status" class="form-control">
                                                    <option value="1">Publish</option>
                                                    <option value="0">Draft</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-0 mt-lg-5">
                                            <div class="form-group">
                                                <label>Author Name</label>
                                                <input type="text" name="created_name" class="form-control">
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-4 mt-0 mt-lg-5">
                                            <div class="form-group news-views">
                                                <label>Views</label>
                                                <div class="buttons">
                                                    <font class="views">0</font>
                                                    <a href="#" class="btn btn-primary">Preview</a>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group text-center">
                                        <label>Main Images</label>
                                        
                                        <div class="image-box mx-auto">
                                            <img id="blah" src="#" alt="your image" />
                                        </div>
                                        <div class="buttons justify-content-center">
                                            <span>
                                                Choose
                                                <input type='file' name="image" accept="image/*" onchange="readURL(this);" />
                                            </span>
                                            <input type="button" value="Remove" class="btn btn-danger" onclick="removeImage()">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea required name="description"></textarea>
                                        <!-- <input id="file-1" type="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="2"> -->
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="buttons text-left mb-0">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{route('news_all');}}"> <button type="button"
                                            class="btn btn-danger">Cancel</button> </a>
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
                .attr('src', e.target.result);
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