@extends('layouts.admin.master')
@section('styles')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />

<style>
    .panel-title-text {
        padding: 12px;
    }
</style>
@endsection
@section('body-content')
<div class="page-wrapper">
    <!-- Page Title -->
    <div class="page-title">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h2 class="page-title-text">Home Page Setting</h2>
            </div>
            <div class="col-sm-6 text-right">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li>Home Page Setting</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Body -->
    <div class="page-body">
        @if ( session()->has('message') )
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

        <div class="row">
            <form action="{{route('setting.store')}}" method="post">
                @csrf
                <div class="    float-right">
                    <div style="margin: 7px;">
                        <button type="submit" class="btn btn-primary mr-2 ">Submit</button>
                        <button type="reset" class="btn btn-outline btn-secondary btn-outline-1x btn-danger" style="color:#ffffff;">Cancel</button>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-head">
                            <div class="panel-title">
                                <span class="panel-title-text">Brand Setting</span>
                            </div>
                        </div>
                        <div class="panel-body">
                            <input type="hidden" name="brand" value="brand">
                            <div class="form-group row">
                                <label for="" class="col-sm-2 form-control-label">Brands</label>
                                <div class="col-sm-10">
                                 {{--   <select multiple name="home_brands[]" class="form-control selectpicker specificpicker" id="select-country1" data-live-search="true"> --}}
                                 <select multiple name="home_brands[]" class="form-control js-example-basic-multiple" id="select-country1" data-live-search="true">


                                        @forelse($brands as $brand)
                                        @if(isset($brand_selected))
                                        @if(array_search($brand['id'],$brand_selected))
                                        <option selected value="{{$brand['id']}}">{{$brand['brand_name']}}</option>
                                        @else
                                        <option value="{{$brand['id']}}">{{$brand['brand_name']}}</option>
                                        @endif
                                        @else
                                        <option value="{{$brand['id']}}">{{$brand['brand_name']}}</option>
                                        @endif


                                        @empty
                                        <option value="0">No brands</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-head">
                            <div class="panel-title">
                                <span class="panel-title-text">Man's In new</span>

                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group row">
                                <label for="" class="col-sm-2 form-control-label">Man's In new</label>
                                <div class="col-sm-10">
                                    <select name="mans_in_new[]" class="form-control js-example-basic-multiple" id="select-country2" multiple data-live-search="true">
                                        <?php if (isset($product_mans_new)) { ?>

                                            @forelse($product_mans_new as $product_man)
                                            @if(isset($man_in_new_selected))
                                            @if(array_search($product_man['id'],$man_in_new_selected))
                                            <option selected value="{{$product_man['id']}}">{{$product_man['product_name']}}</option>
                                            @else
                                            <option value="{{$product_man['id']}}">{{$product_man['product_name']}}</option>
                                            @endif
                                            @else
                                            <option value="{{$product_man['id']}}">{{$product_man['product_name']}}</option>
                                            @endif

                                            @empty
                                            <option value="0">No product</option>
                                            @endforelse
                                        <?php } ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-head">
                            <div class="panel-title">
                                <span class="panel-title-text">Man's In Sale</span>

                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group row">
                                <label for="" class="col-sm-2 form-control-label ">Man's in Sale</label>
                                <div class="col-sm-10">

                                    <select name="mans_in_sale[]" class="form-control js-example-basic-multiple" id="select-country3" multiple data-live-search="true">
                                        @if(isset($product_mans_sale))
                                        @forelse($product_mans_sale as $product_man)
                                        @if(isset($man_in_sale_selected))
                                        @if(array_search($product_man['id'],$man_in_sale_selected))
                                        <option selected value="{{$product_man['id']}}">{{$product_man['product_name']}}</option>
                                        @else
                                        <option value="{{$product_man['id']}}">{{$product_man['product_name']}}</option>
                                        @endif
                                        @else
                                        <option value="{{$product_man['id']}}">{{$product_man['product_name']}}</option>
                                        @endif

                                        @empty
                                        <option value="0">No product</option>
                                        @endforelse
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-head">
                            <div class="panel-title">
                                <span class="panel-title-text">Man's In Popular</span>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group row">
                                <label for="" class="col-sm-2 form-control-label">Man's in Popular</label>
                                <div class="col-sm-10">

                                    <select name="mans_in_popular[]" class="form-control js-example-basic-multiple" id="select-country4" multiple data-live-search="true">
                                        @if(isset($product_mans))
                                        @forelse($product_mans as $product_man)
                                        @if(isset($man_in_popular_selected))
                                        @if(array_search($product_man['id'],$man_in_popular_selected))
                                        <option selected value="{{$product_man['id']}}">{{$product_man['product_name']}}</option>
                                        @else
                                        <option value="{{$product_man['id']}}">{{$product_man['product_name']}}</option>
                                        @endif
                                        @else
                                        <option value="{{$product_man['id']}}">{{$product_man['product_name']}}</option>
                                        @endif

                                        @empty
                                        <option value="0">No product</option>
                                        @endforelse
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-head">
                            <div class="panel-title">
                                <span class="panel-title-text">Woman's In New</span>

                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group row">
                                <label for="" class="col-sm-2 form-control-label">Woman's in New</label>
                                <div class="col-sm-10">

                                    <select name="woman_in_new[]" class="form-control js-example-basic-multiple" id="select-country5" multiple data-live-search="true">
                                        @if(isset($woman_products_new))
                                        {{-- @forelse($woman_products as $woman_product)  --}}

                                        @forelse($woman_products_new as $woman_product)

                                        @if(isset($woman_in_new_selected))
                                        @if(array_search($woman_product['id'],$woman_in_new_selected))
                                        <option selected value="{{$woman_product['id']}}">{{$woman_product['product_name']}}</option>
                                        @else
                                        <option value="{{$woman_product['id']}}">{{$woman_product['product_name']}}</option>
                                        @endif
                                        @else
                                        <option value="{{$woman_product['id']}}">{{$woman_product['product_name']}}</option>
                                        @endif

                                        @empty
                                        <option value="0">No product</option>
                                        @endforelse
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-head">
                            <div class="panel-title">
                                <span class="panel-title-text">Woman's In Sale</span>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group row">
                                <label for="" class="col-sm-2 form-control-label">Woman's In Sale</label>
                                <div class="col-sm-10">

                                    <select name="woman_in_sale[]" class="form-control js-example-basic-multiple" id="select-country6" multiple data-live-search="true">
                                        @if(isset($woman_products_sale))
                                        {{-- @forelse($woman_products as $woman_product)  --}}
                                        @forelse($woman_products_sale as $woman_product)

                                        @if(isset($woman_in_sale_selected))
                                        @if(array_search($woman_product['id'],$woman_in_sale_selected))
                                        <option selected value="{{$woman_product['id']}}">{{$woman_product['product_name']}}</option>
                                        @else
                                        <option value="{{$woman_product['id']}}">{{$woman_product['product_name']}}</option>
                                        @endif
                                        @else
                                        <option value="{{$woman_product['id']}}">{{$woman_product['product_name']}}</option>
                                        @endif

                                        @empty
                                        <option value="0">No product</option>
                                        @endforelse
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-head">
                            <div class="panel-title">
                                <span class="panel-title-text">Woman's In Popular</span>

                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group row">
                                <label for="" class="col-sm-2 form-control-label">Woman's in Popular</label>
                                <div class="col-sm-10">

                                    <select name="woman_in_popular[]" class="form-control js-example-basic-multiple" id="select-country7" multiple data-live-search="true">
                                        @if(isset($woman_products))
                                        {{-- @forelse($woman_products as $woman_product) --}}

                                        @forelse($woman_products as $woman_product)

                                        @if(isset($woman_in_popular_selected))
                                        @if(array_search($woman_product['id'],$woman_in_popular_selected))
                                        <option selected value="{{$woman_product['id']}}">{{$woman_product['product_name']}}</option>
                                        @else
                                        <option value="{{$woman_product['id']}}">{{$woman_product['product_name']}}</option>
                                        @endif
                                        @else
                                        <option value="{{$woman_product['id']}}">{{$woman_product['product_name']}}</option>
                                        @endif

                                        @empty
                                        <option value="0">No product</option>
                                        @endforelse
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-head">
                            <div class="panel-title">
                                <span class="panel-title-text">Children In New</span>

                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group row">
                                <label for="" class="col-sm-2 form-control-label">Children In New</label>
                                <div class="col-sm-10">

                                    <select name="children_in_new[]" class="form-control js-example-basic-multiple" id="select-country8" multiple data-live-search="true" style="position:relative;">
                                        @if(isset($children_products_new))
                                        {{-- @forelse($children_products as $children_product)  --}}

                                        @forelse($children_products_new as $children_product)

                                        @if(isset($children_in_new_selected))
                                        @if(array_search($children_product['id'],$children_in_new_selected))
                                        <option selected value="{{$children_product['id']}}">{{$children_product['product_name']}}</option>
                                        @else
                                        <option value="{{$children_product['id']}}">{{$children_product['product_name']}}</option>
                                        @endif
                                        @else
                                        <option value="{{$children_product['id']}}">{{$children_product['product_name']}}</option>
                                        @endif

                                        @empty
                                        <option value="0">No product</option>
                                        @endforelse
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-head">
                            <div class="panel-title">
                                <span class="panel-title-text">Children In Sale</span>

                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group row">
                                <label for="" class="col-sm-2 form-control-label">Children In Sale</label>
                                <div class="col-sm-10">
                                    <select name="children_in_sale[]" class="form-control js-example-basic-multiple" id="select-country9" multiple data-live-search="true">
                                        @if(isset($children_products_sale))
                                        {{-- @forelse($children_products as $children_product)  --}}

                                        @forelse($children_products_sale as $children_product)

                                        @if(isset($children_in_sale_selected))
                                        @if(array_search($children_product['id'],$children_in_sale_selected))
                                        <option selected value="{{$children_product['id']}}">{{$children_product['product_name']}}</option>
                                        @else
                                        <option value="{{$children_product['id']}}">{{$children_product['product_name']}}</option>
                                        @endif
                                        @else
                                        <option value="{{$children_product['id']}}">{{$children_product['product_name']}}</option>
                                        @endif

                                        @empty
                                        <option value="0">No product</option>
                                        @endforelse
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-head">
                            <div class="panel-title">
                                <span class="panel-title-text">Children In Popular</span>

                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group row">
                                <label for="" class="col-sm-2 form-control-label">Children In Popular</label>
                                <div class="col-sm-10">
                                    <select name="children_in_popular[]" class="form-control js-example-basic-multiple" id="select-country10" multiple data-live-search="true">
                                        @if(isset($children_products))
                                        {{-- @forelse($children_products as $children_product)  --}}

                                        @forelse($children_products as $children_product)


                                        @if(isset($children_in_popular_selected))
                                        @if(array_search($children_product['id'],$children_in_popular_selected))
                                        <option selected value="{{$children_product['id']}}">{{$children_product['product_name']}}</option>
                                        @else
                                        <option value="{{$children_product['id']}}">{{$children_product['product_name']}}</option>
                                        @endif
                                        @else
                                        <option value="{{$children_product['id']}}">{{$children_product['product_name']}}</option>
                                        @endif

                                        @empty
                                        <option value="0">No product</option>
                                        @endforelse
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                Top Trands Setting
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-head">
                            <div class="panel-title">
                                <span class="panel-title-text">Top Trands Of Product</span>

                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group row">
                                <label for="" class="col-sm-2 form-control-label">Man's Top Trend</label>
                                <div class="col-sm-10">
                                    <select name="top_mans_trend_product[]" class="form-control js-example-basic-multiple" id="select-country11" multiple data-live-search="true">
                                        {{-- <?php // if(isset($mans_product_last_months)) { ?> --}}
                                        <?php  if(isset($top_mans_trend_products)) { ?>

                                            {{-- @forelse($product_mans as $product_man) --}}
                                            @forelse($top_mans_trend_products as $product_man)
                                                @if(isset($top_mans_trend_product_selected))
                                                    @if(array_search($product_man['id'],$top_mans_trend_product_selected))
                                                        <option selected value="{{$product_man['id']}}">{{$product_man['product_name']}}</option>
                                                    @else
                                                        <option value="{{$product_man['id']}}">{{$product_man['product_name']}}</option>
                                                @endif
                                            @else
                                            <option value="{{$product_man['id']}}">{{$product_man['product_name']}}</option>
                                            @endif

                                            @empty
                                            <option value="0">No product</option>
                                            @endforelse
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-head">
                            <div class="panel-title">
                                <span class="panel-title-text">Woman's Top Trend</span>

                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group row" style="position:relative;">
                                <label for="" class="col-sm-2 form-control-label">Woman's Top Trend</label>
                                <div class="col-sm-10">
                                    <select name="top_womans_trend_product[]"  class="form-control js-example-basic-multiple" id="select-country12" multiple data-live-search="true">
                                        
                                        {{-- @forelse($woman_product_last_months as $woman_product)  --}}
                                        @if(isset($top_womans_trend_products))
                                            @foreach($top_womans_trend_products as $woman_product)
                                                @if(isset($top_womans_trend_product_selected))
                                                @if(array_search($woman_product['id'],$top_womans_trend_product_selected))
                                                            <option selected value="{{$woman_product['id']}}">{{$woman_product['product_name']}}</option>
                                                            @else
                                                            <option value="{{$woman_product['id']}}">{{$woman_product['product_name']}}</option>
                                                            @endif
                                                    @else
                                                        <option value="{{$woman_product['id']}}">{{$woman_product['product_name']}}</option>
                                                @endif     
                                            @endforeach
                                        @endif
                                       
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-head">
                            <div class="panel-title">
                                <span class="panel-title-text">Children Top Trend Product</span>

                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group row" style="position:relative;">
                                <label for="" class="col-sm-2 form-control-label">Children's Top Trend Product</label>
                                <div class="col-sm-10">
                                    <select name="top_children_trend_product[]" class="form-control js-example-basic-multiple" id="select-country13" multiple data-live-search="true" >
                                        {{-- @if(isset($children_product_last_months)) --}}
                                        @if(isset($top_children_trend_products))

                                        @forelse($top_children_trend_products as $children_product)
                                            @if(isset($top_children_trend_product_selected))
                                            @if(array_search($children_product['id'],$top_children_trend_product_selected))
                                            <option selected value="{{$children_product['id']}}">{{$children_product['product_name']}}</option>
                                            @else
                                            <option value="{{$children_product['id']}}">{{$children_product['product_name']}}</option>
                                            @endif
                                            @else
                                            <option value="{{$children_product['id']}}">{{$children_product['product_name']}}</option>
                                            @endif

                                        @empty
                                        <option value="0">No product</option>
                                        @endforelse
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



        </div>


        </form>
    </div>
</div>

@endsection
@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2({
    sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
});
});
</script>
@endsection