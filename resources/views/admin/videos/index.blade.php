

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
                         
                         


                                                    @if(session('success'))
                                <p class="alert alert-success">{{ session('success') }}</p>
                            @endif

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($videos as $video)
                                        <tr>
                                            <td>{{ $video->id }}</td>
                                            <td>{{ $video->title }}</td>
                                            <td>
                                           <!--     <a href="{{ route('videos.show', $video->id) }}" class="btn btn-info btn-sm">Show</a>
                                                <a href="{{ route('videos.edit', $video->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                             -->
                                              
                                                <form action="{{ route('videos.destroy', $video->id) }}" method="post" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                         @if(count($videos) === 0)
                            <a href="{{ route('videos.create') }}" class="btn btn-primary">Add Video</a>

                         @endif
                         
                         
                         
                         
                         
  					</div>	
     			</div>
            </div>
        </div>
    </div>             
                  
                  
</div>  
  
  
@endsection












