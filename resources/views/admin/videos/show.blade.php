

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
  
  <div class="page-title">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h2 class="page-title-text">
						 <h2>Add New Video</h2>

                </h2>
            </div>
            <div class="col-sm-6 text-right">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Videos</a></li>
                        <li><a href="#">Index page</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
  
  
  
  <div class="page-body">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
					  <div class="panel-head">
                        <div class="panel-title">
                       <span class="panel-title-text"> <h2>Video List</h2></span>  
                        </div>
                    </div>	
 
                       <div class="panel-body">
                         
                         

 							<div class="container">
                              <h2>{{ $video->title }}</h2>
                              <p>ID: {{ $video->id }}</p>
                              <p>Title: {{ $video->title }}</p>
                              <p>Video Path: {{ $video->video_path }}</p>
                              <a href="{{ route('videos.index') }}" class="btn btn-secondary">Back to Video List</a>
                          </div>

                         
                         
                         
  					</div>	
     			</div>
            </div>
        </div>
    </div>             
                  
                  
</div>  
  
  
@endsection












