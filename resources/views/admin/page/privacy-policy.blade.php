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
            <div class="row">

                <div class="col-12">
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
                    <div class="panel panel-default">
                        <div class="panel-head">
                            <div class="panel-title">
                                <span class="panel-title-text">Privacy Policy</span>
                            </div>
                        </div>
                        <div class="panel-body">
                           
                            <form action="{{ route('privacy.process') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <?php echo (!empty($data->title) ? $data->title : '' ); ?>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input required value = <?php echo (!empty($data->title) ? $data->title : '' ); ?> type="text" name="title" placeholder="Enter Title">

                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea required name="description"></textarea>

                                </div>
                                
                            <div class="panel-footer text-left">
                                    <button type="submit" class="btn btn-success mr-2 ">Submit</button>
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

@section("scripts")

<script>
    


    CKEDITOR.replace('description');

   
</script>
@endsection
