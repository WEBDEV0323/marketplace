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
                        <li>Size</li>
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
                        <div class="panel-title">
                            <span class="panel-title-text">Add Category Size</span>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('add-size-category-process') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Please Select Category</label>
                                        <select required name="category" class="form-control ">

                                            @if(isset($shop_cats))

                                                @foreach($shop_cats as $shop_cat)
                                                    <option value="{{ $shop_cat->id }}">{{ $shop_cat->shop_cat_name }}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Please Select Size</label>
                                        <select required multiple name="sizes[]" class="form-control selectpicker ">

                                            @if(isset($sizes))

                                                @foreach($sizes as $size)
                                                    <option value="{{ $size->id }}">{{ $size->size }}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                    </div>
                                </div>
                            </div>
                            



                            <div class="panel-footer">
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

</div>
@endsection
@section("scripts")

<script>
   

    $(function () {
        $('.selectpicker').selectpicker();
    });

</script>
@endsection