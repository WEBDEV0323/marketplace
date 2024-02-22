<style>
    .abc::-webkit-slider-thumb {
        -webkit-appearance: none !important;
        appearance: none !important;
        width: 25px !important;
        height: 25px !important;
        /* background: rgb(218, 218, 229) !important; */
        background: rgb(0, 169, 236) !important;
        cursor: pointer !important;
    }

    .abc::-moz-range-thumb {
        width: 25px !important;
        height: 25px !important;
        /* background: rgb(218, 218, 229) !important; */
        background: rgb(0, 169, 236) !important;
        cursor: pointer !important;
    }
</style>
@extends('layouts.frontend.master')
@section('title','Products - The Marketplace')
@section('banner')

@if(request()->is('shop/menswear'))
@php
header("Location: /search_title?search=&sort=default&min=1&max=100000&menswear=menswear");
exit();
@endphp
@elseif(request()->is('shop/womenswear'))
@php
header("Location: /search_title?search=&sort=default&min=1&max=100000&womenswear=womenswear");
exit();
@endphp
@elseif(request()->is('shop/children'))
@php
header("Location: /search_title?search=&sort=default&min=1&max=100000&childern=childern");
exit();
@endphp
@endif
<div class="inner-banner shop">

    <h1 class="page-title" style="color: #ffff;"></h1>
    <br><br><br>
</div>
<div class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="search-popup">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="search-wrapper">
                    <div class="form-group m-0">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search.." aria-label="Username" aria-describedby="basic-addon1">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <div class="typing-indicator">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </span>
                                <span class="input-group-text" id="basic-addon1"><i class="uil uil-search"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="show_all_results">
                        <div class="emptyresult">Nothing Found For : </div>
                        <a href="#" class="productsearchlink"> dsf</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<form action="{{route('search_title')}}" method="get" id="filter_form">
    <main class="shop-page">
        <div class="container">
            <div class="filters">
                <p class="result-count">Showing 1– <span class="total_showing_record">{{count($products)}}</span> of <span class="total_record_count">{{count($products)}}</span> results</p>
                <div class="filter-header">
                    <a class="filter_btn icon-open-container">Filter</a>

                    <div class="form-group form-inline m-0">
                        <input class="form-control" type="search" value="@if(isset($search)){{$search}}@endif" name="search" placeholder="Search" aria-label="Search">
                        <button class="btn submit_filter_btn" type="submit"><i class="fas fa-search"></i></button>
                    </div>

                    <select class="form-control" name="sort">
                        <option value="default" @if(isset($sort) && $sort=="default" ) selected @endif>Default sorting</option>
                        <option value="popularity" @if(isset($sort) && $sort=="popularity" ) selected @endif>Sort by popularity</option>
                        {{--<option value="rating">Sort by average rating</option> --}}
                        <option value="newness" @if(isset($sort) && $sort=="newness" ) selected @endif>Sort by newness</option>
                        <option value="low_to_high" @if(isset($sort) && $sort=="low_to_high" ) selected @endif>Sort by price: low to high</option>
                        <option value="high_to_low" @if(isset($sort) && $sort=="high_to_low" ) selected @endif> Sort by price: high to low</option>
                    </select>
                </div>
                {{-- <div class="select-box" name="">
                        <div class="options-container">
                            <div class="option">
                                <input type="radio" class="radio" id="defaultSorting" name="category" />
                                <label for="defaultSorting">Default sorting</label>
                            </div>
                            <div class="option">
                                <input type="radio" class="radio" id="popularity" name="category" />
                                <label for="popularity">Sort by popularity</label>
                            </div>
                            <div class="option">
                                <input type="radio" class="radio" id="averageRating" name="category" />
                                <label for="averageRating">Sort by average rating</label>
                            </div>
                            <div class="option">
                                <input type="radio" class="radio" id="newness" name="category" />
                                <label for="newness">Sort by newness</label>
                            </div>
                            <div class="option">
                                <input type="radio" class="radio" id="lowToHigh" name="category" />
                                <label for="lowToHigh">Sort by price: low to high</label>
                            </div>
                            <div class="option">
                                <input type="radio" class="radio" id="highToLow" name="category" />
                                <label for="highToLow">Sort by price: high to low</label>
                            </div>
                        </div>

                        <div class="selected">
                            Default Sorting
                        </div>
                    </div> --}}

            </div>
            <div class="main-content">
                <div class="off-canvas">
                    <div class="off-canvas-header">
                        <h4 class="off-canvas-title">Filter</h4>
                        <div aria-label="Close">
                            <div class="icon-close"><i class="uil uil-times"></i></div>
                        </div>
                    </div>

                    <div class="off-canvas-body">
                        <aside class="filter-sidebar">
                            <form action="#" class="filter-sidebar">
                                <div class="form-group">
                                    <div class="position-relative">
                                        <button class="btn btn_collFilter text-left" type="button" data-toggle="collapse" data-target="#crntfilter_acc" aria-expanded="false" aria-controls="crntfilter_acc">
                                            Current Filter
                                        </button>
                                        <a class="flt_clear_btn clear_all_btn">Clear All</a>
                                    </div>
                                    <div class="collapse show" id="crntfilter_acc">
                                        <div class="filter-check-list m-0">
                                            <ul class="crntfilter">
                                                @if(isset($_GET['in_stock']))
                                                <li>
                                                    <p>In Stock</p>
                                                    <span class="clear-single"><i class="uil uil-times in_stock_remove"></i></span>
                                                </li>
                                                @endif
                                                @if(isset($_GET['new_product']))
                                                <li>
                                                    <p>New Products</p>
                                                    <span class="clear-single"><i class="uil uil-times new_product_remove"></i></span>
                                                </li>
                                                @endif
                                                @if(isset($_GET['on_sale']))
                                                <li>
                                                    <p>On Sale</p>
                                                    <span class="clear-single"><i class="uil uil-times on_sale_remove"></i></span>
                                                </li>
                                                @endif
                                                @if(isset($_GET['menswear']))
                                                <li>
                                                    <p>Menswear</p>
                                                    <span class="clear-single"><i class="uil uil-times menswear_remove"></i></span>
                                                </li>
                                                @endif
                                                @if(isset($_GET['womenswear']))
                                                <li>
                                                    <p>Womenswear</p>
                                                    <span class="clear-single"><i class="uil uil-times womenswear_remove"></i></span>
                                                </li>
                                                @endif
                                                @if(isset($_GET['childern']))
                                                <li>
                                                    <p>Childern</p>
                                                    <span class="clear-single"><i class="uil uil-times childern_remove"></i></span>
                                                </li>
                                                @endif
                                                <span class="category_list_show"></span>
                                                <span class="size_list_show"></span>
                                                <span class="brand_list_show"></span>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn range-filter-label btn_collFilter" type="button" data-toggle="collapse" data-target="#rangeilter" aria-expanded="false" aria-controls="rangeilter">
                                        <i class="fas fa-caret-down"></i> Price
                                    </button>
                                    <div class="collapse show" id="rangeilter">
                                        <div class="range-slider">
                                            <div class="track-box">
                                                <div class="slider-track"></div>
                                                <input type="range" min="0" max="100000" value="{{ isset($_GET['min'])?$_GET['min']:1}}" name="min" class="abc" id="slider-1" oninput="slideOne()">
                                                <input type="range" min="0" max="100000" value="{{ isset($_GET['max'])?$_GET['max']:100000}}" name="max" class="abc" id="slider-2" oninput="slideTwo()">
                                            </div>
                                            <div class="filter-values justify-content-center">
                                                <div class="values">
                                                    <span class="py-1 px-2 border border-dark" id="range1"></span>
                                                    <span> &dash; </span>
                                                    <span class="py-1 px-2 border border-dark" id="range2"></span>
                                                </div>
                                                <input type="button" class="btn blue-button filter d-none" id="fil" class="filter" value="Filter">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn_collFilter" type="button" data-toggle="collapse" data-target="#stock_acc" aria-expanded="false" aria-controls="stock_acc">
                                        <i class="fas fa-caret-down"></i> Stock
                                    </button>
                                    <div class="collapse show" id="stock_acc">
                                        <ul class="filter-check-list">
                                            <li>
                                                <div class="check-item">
                                                    <input type="checkbox" id="in_Stock" class="checkboxClick {{ isset($_GET['in_stock'])?'instock_is_checked':''}}" name="in_stock" value="in_stock" {{ isset($_GET['in_stock'])?'checked':''}}>
                                                    <label for="in_Stock" class="checkboxClick">In Stock</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="check-item">
                                                    <input type="checkbox" id="new_Products" class="checkboxClick" name="new_product" value="new" {{ isset($_GET['new_product'])?'checked':''}}>
                                                    <label for="new_Products" class="checkboxClick">New Products</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="check-item">
                                                    <input type="checkbox" id="on_Sale" class="checkboxClick" name="on_sale" value="sale" {{ isset($_GET['on_sale'])?'checked':''}}>
                                                    <label for="on_Sale" class="checkboxClick">On Sale</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="position-relative">
                                        <button class="btn btn_collFilter" type="button" data-toggle="collapse" data-target="#gender_acc" aria-expanded="false" aria-controls="gender_acc">
                                            <i class="fas fa-caret-down"></i> Gender
                                        </button>
                                        <a class="flt_clear_btn gender_clear_btn">Clear</a>
                                    </div>
                                    <div class="collapse show" id="gender_acc">

                                        <ul class="filter-check-list">

                                            <li>
                                                @php
                                                $man_gender_selected = "NO";
                                                $woman_gender_selected = "NO";
                                                $child_gender_selected = "NO";
                                                if(isset($_GET['gender'])){
                                                if($_GET['gender'] == 1){ $man_gender_selected = "Yes";}
                                                if($_GET['gender'] == 2){ $woman_gender_selected = "Yes";}
                                                if($_GET['gender'] == 3){ $child_gender_selected = "Yes";}
                                                }
                                                @endphp
                                                <div class="check-item">
                                                    <input type="checkbox" class="checkboxClick wear-checkbox" id="menswear" name="menswear" value="menswear" {{ isset($_GET['menswear'])?'checked':''}} {{ (Request::segment(2) == 'man')?'checked':'' }} {{ ($man_gender_selected == "Yes")?'checked':''}}>
                                                    <label for="menswear" class="checkboxClick">Menswear</label>

                                                </div>
                                            </li>
                                            <li>
                                                <div class="check-item">
                                                    <input type="checkbox" class="checkboxClick wear-checkbox" id="womenswear" name="womenswear" value="womenswear" {{ isset($_GET['womenswear'])?'checked':''}} {{ (Request::segment(2) == 'woman')?'checked':''}} {{ ($woman_gender_selected == "Yes")?'checked':'' }}>
                                                    <label for="womenswear" class="checkboxClick">Womenswear</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="check-item">
                                                    <input type="checkbox" class="checkboxClick wear-checkbox" id="Childern" name="childern" value="childern" {{ isset($_GET['childern'])?'checked':''}} {{ (Request::segment(2) == 'children')?'checked':'' }} {{ ($child_gender_selected == "Yes")?'checked':'' }}>
                                                    <label for="Childern" class="checkboxClick">Childern</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn_collFilter" type="button" data-toggle="collapse" data-target="#category_acc" aria-expanded="false" aria-controls="category_acc">
                                        <i class="fas fa-caret-down"></i> Category
                                    </button>
                                    <div class="collapse show" id="category_acc">
                                        <ul class="filter-check-list">
                                            @if(request()->is('shop'))
                                            <?php
                                            $child_cats = App\Models\ShopCategory::whereRaw("flags & ? = ?", [App\Models\ShopCategory::FLAG_ACTIVE, App\Models\ShopCategory::FLAG_ACTIVE])->where('parent_id', '>', 0)->groupBy("shop_cat_slug")->orderBy('shop_cat_name', 'ASC')->get()->toArray();
                                            ?>
                                            @foreach($child_cats as $key => $child_cat)
                                            <?php
                                            $category_checkbox = "";
                                            if (isset($_GET['categories'])) {
                                                if (count($_GET['categories']) > 0) {
                                                    $categoryList = $_GET['categories'];
                                                    foreach ($categoryList as $row) {
                                                        if ($row == $child_cat['shop_cat_slug']) {
                                                            $category_checkbox = "checked";
                                                            break;
                                                        }
                                                    }
                                                }
                                            }

                                            if (isset($_GET['gender'])) {
                                                if (Request::segment(2) == $child_cat['shop_cat_slug']) {
                                                    $category_checkbox = "checked";
                                                }
                                            }
                                            ?>
                                            <li>
                                                <div class="check-item">
                                                    <input type="checkbox" class="checkboxClick {{($category_checkbox == 'checked')?'category_get':''}}" data-id="{{$child_cat['id']}}" data-name_category="{{$child_cat['shop_cat_name']}}" id="Accessories_{{ $child_cat['id']}}" value="{{ $child_cat['shop_cat_slug'] }}" name="categories[]" {{$category_checkbox}}>
                                                    <label for="Accessories_{{ $child_cat['id'] }}" class="checkboxClick"><?php echo $child_cat['shop_cat_name']; ?></label>

                                                </div>
                                            </li>
                                            @endforeach
                                            @else

                                            <?php
                                            if (isset($_GET['menswear'])) {
                                                $genders = 1;
                                            } elseif (isset($_GET['womenswear'])) {
                                                $genders = 2;
                                            } elseif (isset($_GET['children'])) {
                                                $genders = 3;
                                            } else {
                                                $genders = 0;
                                            }

                                            if (isset($shop_categories)) {
                                                // pre($shop_categories);
                                                $CatData = $shop_categories;
                                                foreach ($CatData as $getCatData) {
                                                    $ProductData[] = App\Models\Product::where('shop_category_id', $getCatData->id)->where('gender', $genders)->groupBy("shop_category_id")->pluck('shop_category_id')->toArray();
                                                    $filteredData = array_filter($ProductData);
                                                    $child_cats = App\Models\ShopCategory::whereRaw("flags & ? = ?", [App\Models\ShopCategory::FLAG_ACTIVE, App\Models\ShopCategory::FLAG_ACTIVE])->whereIn('id', $filteredData)->groupBy("shop_cat_slug")->orderBy('shop_cat_name', 'ASC')->get()->toArray();
                                                }
                                                // pre($child_cats);
                                            ?>

                                                @foreach($child_cats as $key => $child_cat)
                                                <?php
                                                $category_checkbox = "";
                                                if (isset($_GET['categories'])) {
                                                    if (count($_GET['categories']) > 0) {
                                                        $categoryList = $_GET['categories'];
                                                        foreach ($categoryList as $row) {
                                                            if ($row == $child_cat['shop_cat_slug']) {
                                                                $category_checkbox = "checked";
                                                                break;
                                                            }
                                                        }
                                                    }
                                                }

                                                if (isset($_GET['gender'])) {
                                                    if (Request::segment(2) == $child_cat['shop_cat_slug']) {
                                                        $category_checkbox = "checked";
                                                    }
                                                }
                                                ?>
                                                <li>
                                                    <div class="check-item">
                                                        @if(isset($row))
                                                        <input type="checkbox" class="checkboxClick" data-id="{{$child_cat['id']}}" data-name_category="{{$child_cat['shop_cat_name']}}" id="Accessories_{{ $child_cat['id']}}" value="{{ $child_cat['shop_cat_slug'] }}" name="categories[]" {{ ($child_cat['shop_cat_slug'] == $row) ? 'checked' : '' }}>
                                                        @else
                                                        <input type="checkbox" class="checkboxClick" data-id="{{$child_cat['id']}}" data-name_category="{{$child_cat['shop_cat_name']}}" id="Accessories_{{ $child_cat['id']}}" value="{{ $child_cat['shop_cat_slug'] }}" name="categories[]">

                                                        @endif
                                                        <label for="Accessories_{{ $child_cat['id']}}" class="checkboxClick"><?php echo $child_cat['shop_cat_name']; ?></label>
                                                    </div>
                                                </li>
                                                @endforeach
                                            <?php } else {
                                                $lastSegment = collect(explode('/', request()->path()))->last();
                                                $url = request()->url();
                                                $value = null;
                                                // pre(request()->segment(2));

                                                // $lastSegment = request()->segment(3);

                                                if (Str::contains($url, 'woman')) {
                                                    $value = 2;
                                                } elseif (Str::contains($url, 'man')) {
                                                    $value = 1;
                                                } elseif (Str::contains($url, 'children')) {
                                                    $value = 3;
                                                }

                                                // if (request()->segment(2) == 'woman') {
                                                //     $value = 2;
                                                // } elseif (request()->segment(2) == 'man') {
                                                //     $value = 1;
                                                // } elseif (request()->segment(2) == 'children') {
                                                //     $value = 3;
                                                // }
                                                $allCat = App\Models\ShopCategory::where('parent_id', '!=', 0)->pluck('id')->toArray();
                                                $getAllProductCategory = App\Models\Product::where('gender', $value)->whereIn('shop_category_id', $allCat)->groupBy("shop_category_id")->orderBy('shop_category_id', 'ASC')->pluck('shop_category_id')->toArray();
                                                // $FilteredallCat = App\Models\ShopCategory::whereIn('id', $getAllProductCategory)->where('parent_id', $value)->get()->toArray();

                                                $FilteredallCat = App\Models\ShopCategory::where('parent_id', '>', 0)->orderBy('shop_cat_name', 'ASC')->groupBy("shop_cat_slug")->get()->toArray();


                                            ?>
                                                @if(isset($FilteredallCat))
                                                @foreach($FilteredallCat as $filterItem)
                                                <li>
                                                    <div class="check-item">
                                                        <input type="checkbox" class="checkboxClick" data-id="{{$filterItem['id'] ?? ''}}" data-name_category="{{$filterItem['shop_cat_name'] ?? ''}}" id="Accessories_{{ $filterItem['id'] ?? ''}}" value="{{ $filterItem['shop_cat_slug'] ?? ''}}" name="categories[]" @if($filterItem['shop_cat_slug']==$lastSegment) checked @endif>
                                                        <label for="Accessories_{{ $filterItem['id'] ?? ''}}" class="checkboxClick"><?php echo $filterItem['shop_cat_name'];
                                                                                                                                    ?></label>
                                                    </div>
                                                </li>
                                                @endforeach
                                                @endif

                                            <?php } ?>

                                            @endif

                                        </ul>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn_collFilter" type="button" data-toggle="collapse" data-target="#sizes_acc" aria-expanded="false" aria-controls="sizes_acc">
                                        <i class="fas fa-caret-down"></i> Sizes
                                    </button>
                                    <div class="collapse show" id="sizes_acc">
                                        <ul class="filter-check-list">
                                            <?php
                                            if (isset($_GET['menswear'])) {
                                                $gender = 1;
                                            } elseif (isset($_GET['womenswear'])) {
                                                $gender = 2;
                                            } else {
                                                $gender = 3;
                                            }
                                            if (isset($row)) {
                                                $filterCategory = App\Models\ShopCategory::where('shop_cat_slug', $row)->pluck('id')->first();
                                                $filterProduct = App\Models\Product::where('shop_category_id', $filterCategory)->where('gender', $gender)->get()->toArray();
                                                if ($filterProduct == null) {
                                                    $all_sizes = App\Models\Size::where('flags', 1)->where('gender', $gender)
                                                        ->groupBy("size")
                                                        ->orderBy('size', 'ASC')->get()->toArray();
                                                } else {
                                                    foreach ($filterProduct as $productData) {
                                                        $productIds[] = $productData['id'];
                                                    }
                                                    $filterSizes = App\Models\ProductSize::whereIn('product_id', $productIds)->groupBy("size_id")->pluck('size_id')->toArray();
                                                    $all_sizes = App\Models\Size::where('flags', 1)->whereIn('id',  $filterSizes)->where('gender', $gender)
                                                        ->groupBy("size")
                                                        ->orderBy('size', 'ASC')->get()->toArray();
                                                }
                                            } else {
                                                if (isset($gender)) {
                                                    $all_sizes = App\Models\Size::where('flags', 1)->where('gender', $gender)
                                                        ->groupBy("size")
                                                        ->orderBy('size', 'ASC')->get()->toArray();
                                                } else {
                                                    $all_sizes = App\Models\Size::where('flags', 1)
                                                        ->groupBy("size")
                                                        ->orderBy('size', 'ASC')->get()->toArray();
                                                }
                                            }

                                            foreach ($all_sizes as $key => $all_size) {
                                                $size_checkbox = "";
                                                if (isset($_GET['size'])) {
                                                    if (count($_GET['size']) > 0) {
                                                        $sizeList = $_GET['size'];
                                                        foreach ($sizeList as $row) {
                                                            if ($row == $all_size['size']) {
                                                                $size_checkbox = "checked";
                                                                break;
                                                            }
                                                        }
                                                    }
                                                }
                                            ?>
                                                <li>
                                                    <div class="check-item">
                                                        <input type="checkbox" class="checkboxClick  {{($size_checkbox == 'checked')?'size_get':''}}" data-id="{{$all_size['id']}}" data-name_size="{{$all_size['size']}}" id="Size_{{$all_size['id']}}" value="{{ $all_size['size'] }}" name="size[]" {{$size_checkbox}}>
                                                        <label for="Size_{{$all_size['id']}}" class="checkboxClick">{{$all_size['size']}}</label>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn_collFilter" type="button" data-toggle="collapse" data-target="#brands_acc" aria-expanded="false" aria-controls="brands_acc">
                                        <i class="fas fa-caret-down"></i> Brands
                                    </button>
                                    <div class="collapse show" id="brands_acc">
                                        <ul class="filter-check-list">
                                            <?php
                                            if (isset($_GET['menswear'])) {
                                                $genders = 1;
                                            } elseif (isset($_GET['womenswear'])) {
                                                $genders = 2;
                                            } else {
                                                $genders = 3;
                                            }
                                            if (isset($shop_categories)) {
                                                $catlog = $shop_categories;

                                                foreach ($catlog as $item) {
                                                    if (isset($gender)) {
                                                        $productModelData[] = App\Models\Product::where('shop_category_id', $item->id)->where('gender', $genders)->distinct('brand_id')->orderBy('brand_id')->pluck('brand_id')->toArray();
                                                    } else {
                                                        $productModelData[] = App\Models\Product::where('shop_category_id', $item->id)->distinct('brand_id')->orderBy('brand_id')->pluck('brand_id')->toArray();
                                                    }
                                                }
                                                if (request()->is('shop')) {
                                                    $filteredBrandData = array_filter($productModelData);
                                                    $brands = App\Models\Brand::whereRaw("flags & ? = ?", [App\Models\Brand::FLAG_ACTIVE, App\Models\Brand::FLAG_ACTIVE])
                                                        ->orderBy('brand_name')->get()->toArray();
                                                } else {
                                                    $filteredBrandData = array_filter($productModelData);
                                                    if ($filteredBrandData == null) {
                                                        $brands = App\Models\Brand::whereRaw("flags & ? = ?", [App\Models\Brand::FLAG_ACTIVE, App\Models\Brand::FLAG_ACTIVE])
                                                            ->orderBy('brand_name')->get()->toArray();
                                                    } else {
                                                        $brands = App\Models\Brand::whereRaw("flags & ? = ?", [App\Models\Brand::FLAG_ACTIVE, App\Models\Brand::FLAG_ACTIVE])->whereIn('id', $filteredBrandData[0])
                                                            ->orderBy('brand_name')->get()->toArray();
                                                    }
                                                }
                                            } elseif (isset($child_cats)) {
                                                $catlog = $child_cats;

                                                foreach ($catlog as $item) {
                                                    if (isset($gender)) {
                                                        $productModelData[] = App\Models\Product::where('shop_category_id', $item->id)->where('gender', $genders)->distinct('brand_id')->orderBy('brand_id')->pluck('brand_id')->toArray();
                                                    } else {
                                                        $productModelData[] = App\Models\Product::where('shop_category_id', $item->id)->distinct('brand_id')->orderBy('brand_id')->pluck('brand_id')->toArray();
                                                    }
                                                }
                                                if (request()->is('shop')) {
                                                    $filteredBrandData = array_filter($productModelData);
                                                    $brands = App\Models\Brand::whereRaw("flags & ? = ?", [App\Models\Brand::FLAG_ACTIVE, App\Models\Brand::FLAG_ACTIVE])
                                                        ->orderBy('brand_name')->get()->toArray();
                                                } else {
                                                    $filteredBrandData = array_filter($productModelData);
                                                    if ($filteredBrandData == null) {
                                                        $brands = App\Models\Brand::whereRaw("flags & ? = ?", [App\Models\Brand::FLAG_ACTIVE, App\Models\Brand::FLAG_ACTIVE])
                                                            ->orderBy('brand_name')->get()->toArray();
                                                    } else {
                                                        $brands = App\Models\Brand::whereRaw("flags & ? = ?", [App\Models\Brand::FLAG_ACTIVE, App\Models\Brand::FLAG_ACTIVE])->whereIn('id', $filteredBrandData[0])
                                                            ->orderBy('brand_name')->get()->toArray();
                                                    }
                                                }
                                            }

                                            $brands = App\Models\Brand::whereRaw("flags & ? = ?", [App\Models\Brand::FLAG_ACTIVE, App\Models\Brand::FLAG_ACTIVE])
                                                ->orderBy('brand_name')->get()->toArray();
                                            foreach ($brands as $key => $brand) {

                                                $brand_checkbox = "";
                                                if (isset($_GET['brands'])) {
                                                    if (count($_GET['brands']) > 0) {
                                                        $brandList = $_GET['brands'];
                                                        foreach ($brandList as $row) {
                                                            if ($row == $brand['id']) {
                                                                $brand_checkbox = "checked";
                                                                break;
                                                            }
                                                        }
                                                    }
                                                }
                                            ?>
                                                <li>
                                                    <div class="check-item">
                                                        <input type="checkbox" class="checkboxClick {{($brand_checkbox == 'checked')?'brand_get':''}}" data-id="{{$brand['id']}}" data-name_brand="{{$brand['brand_name']}}" id="brand_{{$brand['id']}}" value="<?php echo $brand['id']; ?>" name="brands[]" {{$brand_checkbox}}>
                                                        <label for="brand_{{$brand['id']}}" class="checkboxClick"><?php echo $brand['brand_name']; ?></label>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>

                            </form>

                        </aside>
                    </div>
                </div>
            </div>
        </div>
</form>
@yield('products-content')


</main>
@endsection
{{-- filter functionlity --}}
<script src="{{asset('assets/js/jquery.js')}}"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.checkboxClick', function() {
            $('.submit_filter_btn').trigger('click');
        });
        var buttonMinPrice = $('#slider-1');
        buttonMinPrice.on('mouseup touchend', function(event) {
            event.preventDefault();
            $('.submit_filter_btn').trigger('click');
        });
        var buttonMaxPrice = $('#slider-2');
        buttonMaxPrice.on('mouseup touchend', function(event) {
            event.preventDefault();
            $('.submit_filter_btn').trigger('click');
        });
        if ($("#in_Stock").hasClass('instock_is_checked')) {
            var count_out_stock_class = $('.out_of_stock_product').length;
            if (count_out_stock_class > 0) {
                $('.out_of_stock_product').remove();
                var total_showing_record = $(".total_showing_record").text();
                var total_record_count = $(".total_record_count").text();
                $(".total_showing_record").text((parseInt(total_showing_record) - parseInt(count_out_stock_class)));
                $(".total_record_count").text((parseInt(total_record_count) - parseInt(count_out_stock_class)));
            }
        }
        $(document).on('click', '.gender_clear_btn', function() {
            $("#menswear").prop('checked', false);
            $("#womenswear").prop('checked', false);
            $("#Childern").prop('checked', false);
            $('.submit_filter_btn').trigger('click');
        });

        $(document).on('click', '.clear_all_btn', function() {
            $('.checkboxClick').prop('checked', false);
            $("#slider-1").val(1);
            $("#slider-2").val(100000);
            $('.submit_filter_btn').trigger('click');
        });


        // remove products
        $(document).on('click', '.in_stock_remove', function() {
            $('#in_Stock').prop('checked', false);
            $('.submit_filter_btn').trigger('click');
        });
        $(document).on('click', '.new_product_remove', function() {
            $('#new_Products').prop('checked', false);
            $('.submit_filter_btn').trigger('click');
        });
        $(document).on('click', '.on_sale_remove', function() {
            $('#on_Sale').prop('checked', false);
            $('.submit_filter_btn').trigger('click');
        });
        $(document).on('click', '.menswear_remove', function() {
            $('#menswear').prop('checked', false);
            $('.submit_filter_btn').trigger('click');
        });
        $(document).on('click', '.womenswear_remove', function() {
            $('#womenswear').prop('checked', false);
            $('.submit_filter_btn').trigger('click');
        });
        $(document).on('click', '.childern_remove', function() {
            $('#Childern').prop('checked', false);
            $('.submit_filter_btn').trigger('click');
        });

        $(document).on('click', '.category_remove', function() {
            let cat_id = $(this).data('id');
            $(`#Accessories_${cat_id}`).prop('checked', false);
            $('.submit_filter_btn').trigger('click');
        });
        $(document).on('click', '.size_remove', function() {
            let size_id = $(this).data('id');
            $(`#Size_${size_id}`).prop('checked', false);
            $('.submit_filter_btn').trigger('click');
        });
        $(document).on('click', '.brand_remove', function() {
            let brand_id = $(this).data('id');
            $(`#brand_${brand_id}`).prop('checked', false);
            $('.submit_filter_btn').trigger('click');
        });
        // remove products

        //add category
        $(".category_get").each(function() {
            let cat_name = $(this).data('name_category');
            let cat_id = $(this).data('id');
            $('.category_list_show').append(`<li><p>${cat_name}</p><span class="clear-single"><i class="uil uil-times category_remove" data-id='${cat_id}'></i></span></li>`);
        });
        $(".size_get").each(function() {
            let name_size = $(this).data('name_size');
            let size_id = $(this).data('id');
            $('.category_list_show').append(`<li><p>${name_size}</p><span class="clear-single"><i class="uil uil-times size_remove" data-id='${size_id}'></i></span></li>`);
        });
        $(".brand_get").each(function() {
            let brand_name = $(this).data('name_brand');
            let brand_id = $(this).data('id');
            $('.category_list_show').append(`<li><p>${brand_name}</p><span class="clear-single"><i class="uil uil-times brand_remove" data-id='${brand_id}'></i></span></li>`);
        });
        //add category

    });
    //@if(request()->is('shop'))
    // $(document).ready(function() {
    //     $('.wear-checkbox').change(function() {
    //         var checkedId = $(this).attr('id');
    //         $('.wear-checkbox').each(function() {
    //             var checkboxId = $(this).attr('id');
    //             if (checkboxId !== checkedId) {
    //                 $('label[for="' + checkboxId + '"]').hide(!$(this).prop('checked'));
    //                 $(this).hide(!$(this).prop('checked'));
    //             }
    //         });
    //     });
    // });
    //@else
    // $(document).ready(function() {
    //     $('.wear-checkbox').each(function() {
    //         if (!$(this).prop('checked')) {
    //             var checkboxId = $(this).attr('id');
    //             $('label[for="' + checkboxId + '"]').hide();
    //             $(this).hide();
    //         }
    //     });
    // });
    //@endif
</script>
{{-- filter functionlity --}}

@section('scripts')
<script>
    $(document).ready(function() {

        // Brand Filter
        $("#brand").change(function() {
            brand = $('#brand').val();
            categories = $('#categories').val();
            gender = $('#gender').val();
            size_id = $('#size').val();
            $.ajax({
                url: "{{ route('shop.gender') }}",
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    brand: brand,
                    categories: categories,
                    gender: gender,
                    sizes: size_id

                },
                success: function(result) {
                    $(".result-count").html("Showing 1–" + result.selected + " of " + result.count + " results");
                    $('.products-wrapper').html(result.html);
                    //console.log(result);

                }
            });
        });

        // Categories Filter
        $("#categories").change(function() {
            brand = $('#brand').val();
            categories = $('#categories').val();
            gender = $('#gender').val();
            size_id = $('#size').val();
            $.ajax({
                url: "{{ route('shop.gender') }}",
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    brand: brand,
                    categories: categories,
                    gender: gender,
                    sizes: size_id,
                },
                success: function(result) {

                    var sz = JSON.parse(result.sizes);

                    $("#size").empty();
                    $("#size").append('<option value="0" selected="">Please Select Size</option>');

                    for (j = 0; j < sz.length; j++) {

                        $("#size").append('<option  value="' + sz[j].id + '">' + sz[j].size + '</option>');

                    }

                    $(".result-count").html("Showing 1–" + result.selected + " of " + result.count + " results");
                    $('.products-wrapper').html(result.html);


                }
            });
        });

        //Product Filters
        $("#gender").change(function() {
            brand = $('#brand').val();
            categories = $('#categories').val();
            gender = $('#gender').val();
            size_id = $('#size').val();
            $.ajax({
                url: "{{ route('shop.gender') }}",
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    brand: brand,
                    categories: categories,
                    gender: gender,
                    sizes: size_id
                },
                success: function(result) {
                    $(".result-count").html("Showing 1–" + result.selected + " of " + result.count + " results");
                    $('.products-wrapper').html(result.html);

                    $("#categories").empty();
                    $("#categories").append('<option value="0" selected="">Select a category</option>');
                    var ca = JSON.parse(result.scat);

                    var sz = JSON.parse(result.sizes);

                    $("#size").empty();
                    $("#size").append('<option value="0" selected="">Please Select Size</option>');

                    for (j = 0; j < sz.length; j++) {
                        $("#size").append('<option  value="' + sz[j].id + '">' + sz[j].size + '</option>');
                    }

                    for (i = 0; i < ca.length; i++) {
                        if (ca[i].shop_cat_slug == categories) {
                            $("#categories").append('<option selected value="' + ca[i].shop_cat_slug + '">' + ca[i].shop_cat_name + '</option>');
                        } else {
                            $("#categories").append('<option  value="' + ca[i].shop_cat_slug + '">' + ca[i].shop_cat_name + '</option>');
                        }
                    }
                }
            });
        });

        $("#size").change(function() {
            brand = $('#brand').val();
            categories = $('#categories').val();
            gender = $('#gender').val();
            size_id = $('#size').val();
            $.ajax({
                url: "{{ route('shop.gender') }}",
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    brand: brand,
                    categories: categories,
                    gender: gender,
                    sizes: size_id
                },
                success: function(result) {
                    $(".result-count").html("Showing 1–" + result.selected + " of " + result.count + " results");
                    $('.products-wrapper').html(result.html);

                    $("#categories").empty();
                    $("#categories").append('<option value="0" selected="">Select a category</option>');
                    var ca = JSON.parse(result.scat);

                    var sz = JSON.parse(result.sizes);

                    $("#size").empty();
                    $("#size").append('<option value="0" selected="">Please Select Size</option>');

                    for (j = 0; j < sz.length; j++) {

                        $("#size").append('<option  value="' + sz[j].id + '">' + sz[j].size + '</option>');

                    }

                    for (i = 0; i < ca.length; i++) {
                        if (ca[i].shop_cat_slug == categories) {
                            $("#categories").append('<option selected value="' + ca[i].shop_cat_slug + '">' + ca[i].shop_cat_name + '</option>');
                        } else {
                            $("#categories").append('<option  value="' + ca[i].shop_cat_slug + '">' + ca[i].shop_cat_name + '</option>');
                        }
                    }
                }
            });

        });
    });
</script>
@endsection