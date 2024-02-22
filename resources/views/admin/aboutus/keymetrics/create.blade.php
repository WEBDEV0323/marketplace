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
                        

                        <form action="{{ route('aboutus.keymetrics.store') }}" method="post" enctype="multipart/form-data" class="brands-form">
                            @csrf
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" required class="form-control">
                                </div>
                            </div>
                            <input type="hidden" name="value" value="0" required class="form-control">
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Value </label>
                                    <input type="text" name="value" required class="form-control">
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Plus Sign</label>
                                    <select name="plus_sign" class="custom-select">
                                        <option value="No"> No</option>
                                        <option value="Yes">Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                            
                            <div class="buttons">
                                <button type="submit" class="btn btn-primary">Submit</button>
                             <a href="{{route("aboutus.keymetrics")}}">   <button type="button"
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
</script>
@endsection                                          

