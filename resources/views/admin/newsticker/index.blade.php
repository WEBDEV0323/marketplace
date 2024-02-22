@extends('layouts.admin.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/assets/plugin/datatable/datatables.min.css') }}" />
    <style>
        .nt_lables {
            font-size: 15px !important;
            font-weight: 500 !important;
            color: #333 !important;
            margin-bottom: 10px !important;
        }
    </style>
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
                            <li>News</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Body -->
        <div class="page-body">
            <div class="row">
                <div class="col-12">
                    <div class="panel panel-default">

                        <div class="panel-head">
                            {{--  <h5 class="panel-title"></h5> --}}
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
                            <form action="{{route('save_news_ticker')}}" method="post" style="width: 100%;">
                                @csrf
                                <div class="row white-box-div">

                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label for="" class="form-control-label">Title</label>
                                            <input type="text" required name="title" value="{{$newsticker->title ?? ''}}" placeholder="Important, Top, Latest News, Note, and etc..." class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label for="" class="form-control-label">News Ticker</label>
                                            <textarea row="5" required name="message" placeholder="News Content" class="form-control">{{$newsticker->content ?? ''}}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox custom-checkbox-1 d-inline-block mb-3">
                                            <input type="checkbox" class="custom-control-input" id="active" name="active" {{($newsticker->flags ?? '') == '1' ? ' checked' : ''}}>
                                            <label class="custom-control-label nt_lables" for="active">Active</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <strong class="nt_lables">Text Color:</strong>
                                        <input type="color" id="text_color" name="text_color" value="{{$newsticker->text_color ?? '#ffffff'}}">
                                    </div>
                                    <div class="col-md-12">
                                        <strong class="nt_lables">Background Color:</strong>
                                        <input type="color" id="bg_color" name="bg_color" value="{{$newsticker->bg_color ?? '#000000'}}">
                                    </div>

                                </div>

                                <div class="col-md-12">
                                    <div class="buttons text-center mb-0">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-danger">Cancel</button>
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
    <script>

    </script>

@endsection
