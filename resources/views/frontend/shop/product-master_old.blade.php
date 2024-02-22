<style>

.abc::-webkit-slider-thumb {
  -webkit-appearance: none !important;
  appearance: none !important;
  width: 25px !important;
  height: 25px !important;
  /* background: rgb(218, 218, 229) !important; */
  background:  rgb(0,169,236) !important;
  cursor: pointer !important;
}

.abc::-moz-range-thumb {
  width: 25px !important;
  height: 25px !important;
  /* background: rgb(218, 218, 229) !important; */
  background:  rgb(0,169,236) !important;
  cursor: pointer !important;
}

</style>
@extends('layouts.frontend.master')
@section('title','Products - The Marketplace')
@section('banner')
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
                            <input type="text" class="form-control" placeholder="Search.." aria-label="Username"
                                aria-describedby="basic-addon1">
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
<main class="shop-page">
    <div class="filters">
        <p class="result-count">Showing 1–{{count($products)}} of {{count($products)}} results</p>
        <form action="{{route("search_title")}}" method="get">
            
            <a class="filter_btn icon-open-container">Filter</a>

            <div class="form-group form-inline m-0">
                <input class="form-control" type="search" value="@if(isset($search)){{$search}}@endif" name="search" placeholder="Search" aria-label="Search">
                <button class="btn " type="submit"><i class="fas fa-search"></i></button>
            </div>
                
            <select class="form-control" name="sort">
                <option value="default" @if(isset($sort) && $sort=="default") selected @endif >Default sorting</option>
                <option value="popularity" @if(isset($sort) && $sort=="popularity") selected @endif>Sort by popularity</option>
            {{--<option value="rating">Sort by average rating</option> --}}
                <option value="newness" @if(isset($sort) && $sort=="newness") selected @endif>Sort by newness</option>
                <option value="low_to_high" @if(isset($sort) && $sort=="low_to_high") selected @endif >Sort by price: low to high</option>
                <option value="high_to_low" @if(isset($sort) && $sort=="high_to_low") selected @endif> Sort by price: high to low</option>
            </select>
            {{--  <div class="select-box" name="">
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
            </form>
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
            <aside>
                <form action="#" class="filter-sidebar">
                    <div class="form-group">
                        <button class="btn btn_collFilter text-left" type="button" data-toggle="collapse"
                            data-target="#crntfilter_acc" aria-expanded="false" aria-controls="crntfilter_acc">
                            Current Filter
                            <a class="flt_clear_btn">Clear All</a>
                        </button>
                        <div class="collapse show" id="crntfilter_acc">
                            <ul class="crntfilter">
                                <li>
                                    <p>Menswear</p>
                                    <span class="clear-single"><i class="uil uil-times"></i></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn range-filter-label btn_collFilter" type="button" data-toggle="collapse"
                            data-target="#rangeilter" aria-expanded="false" aria-controls="rangeilter">
                            <i class="fas fa-caret-down"></i> Price 
                        </button>
                        <div class="collapse show" id="rangeilter">
                            <div class="range-slider">
                                <div class="track-box">
                                    <div class="slider-track" ></div>
                                    <input type="range" min="0" max="900" value="0" class="abc" id="slider-1" oninput="slideOne()">
                                    <input type="range" min="0" max="900" value="900" class="abc" id="slider-2" oninput="slideTwo()">
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
                        <button class="btn btn_collFilter" type="button" data-toggle="collapse"
                            data-target="#stock_acc" aria-expanded="false" aria-controls="stock_acc">
                            <i class="fas fa-caret-down"></i> Stock
                        </button>
                        <div class="collapse show" id="stock_acc">
                            <ul class="filter-check-list">
                                <li>
                                    <div class="check-item">
                                        <input type="checkbox" id="in_Stock">
                                        <label for="in_Stock">In Stock</label>
                                    </div>
                                    <div class="check-count-number">(99+)</div>
                                </li>
                                <li>
                                    <div class="check-item">
                                        <input type="checkbox" id="new_Products">
                                        <label for="new_Products">New Products</label>
                                    </div>
                                    <div class="check-count-number">(99+)</div>
                                </li>
                                <li>
                                    <div class="check-item">
                                        <input type="checkbox" id="on_Sale">
                                        <label for="on_Sale">On Sale</label>
                                    </div>
                                    <div class="check-count-number">(99+)</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn_collFilter" type="button" data-toggle="collapse"
                            data-target="#gender_acc" aria-expanded="false" aria-controls="gender_acc">
                            <i class="fas fa-caret-down"></i> Gender
                            <a class="flt_clear_btn">Clear</a>
                        </button>
                        <div class="collapse show" id="gender_acc">
                            <ul class="filter-check-list">
                                <li>
                                    <div class="check-item">
                                        <input type="checkbox" id="menswear">
                                        <label for="menswear">Menswear</label>
                                    </div>
                                    <div class="check-count-number">(99+)</div>
                                </li>
                                <li>
                                    <div class="check-item">
                                        <input type="checkbox" id="womenswear">
                                        <label for="womenswear">Womenswear</label>
                                    </div>
                                    <div class="check-count-number">(99+)</div>
                                </li>
                                <li>
                                    <div class="check-item">
                                        <input type="checkbox" id="Childern">
                                        <label for="Childern">Childern</label>
                                    </div>
                                    <div class="check-count-number">(99+)</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn_collFilter" type="button" data-toggle="collapse"
                            data-target="#category_acc" aria-expanded="false" aria-controls="category_acc">
                            <i class="fas fa-caret-down"></i> Category
                        </button>
                        <div class="collapse show" id="category_acc">
                            <ul class="filter-check-list">
                                <li>
                                    <div class="check-item">
                                        <input type="checkbox" id="Accessories">
                                        <label for="Accessories">Accessories</label>
                                    </div>
                                    <div class="check-count-number">(99+)</div>
                                </li>
                                <li>
                                    <div class="check-item">
                                        <input type="checkbox" id="BabyCarriers">
                                        <label for="BabyCarriers">Baby Carriers</label>
                                    </div>
                                    <div class="check-count-number">(99+)</div>
                                </li>
                                <li>
                                    <div class="check-item">
                                        <input type="checkbox" id="Babywear">
                                        <label for="Babywear">Babywear</label>
                                    </div>
                                    <div class="check-count-number">(99+)</div>
                                </li>
                                <li>
                                    <div class="check-item">
                                        <input type="checkbox" id="Bags">
                                        <label for="Bags">Bags</label>
                                    </div>
                                    <div class="check-count-number">(99+)</div>
                                </li>
                                <li>
                                    <div class="check-item">
                                        <input type="checkbox" id="Belts">
                                        <label for="Belts">Belts</label>
                                    </div>
                                    <div class="check-count-number">(99+)</div>
                                </li>
                                <li>
                                    <div class="check-item">
                                        <input type="checkbox" id="Blankets-and-Nests">
                                        <label for="Blankets-and-Nests">Blankets & Nests</label>
                                    </div>
                                    <div class="check-count-number">(99+)</div>
                                </li>
                                <li>
                                    <div class="check-item">
                                        <input type="checkbox" id="Blazers">
                                        <label for="Blazers">Blazers</label>
                                    </div>
                                    <div class="check-count-number">(99+)</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn_collFilter" type="button" data-toggle="collapse"
                            data-target="#sizes_acc" aria-expanded="false" aria-controls="sizes_acc">
                            <i class="fas fa-caret-down"></i> Sizes
                        </button>
                        <div class="collapse show" id="sizes_acc">
                            <ul class="filter-check-list">
                                <li>
                                    <div class="check-item">
                                        <input type="checkbox" id="Size">
                                        <label for="Size">Size 1</label>
                                    </div>
                                    <div class="check-count-number">(99+)</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn_collFilter" type="button" data-toggle="collapse"
                            data-target="#brands_acc" aria-expanded="false" aria-controls="brands_acc">
                            <i class="fas fa-caret-down"></i> Brands
                        </button>
                        <div class="collapse show" id="brands_acc">
                            <ul class="filter-check-list">
                                <li>
                                    <div class="check-item">
                                        <input type="checkbox" id="brand1">
                                        <label for="brand1">Any Brand</label>
                                    </div>
                                    <div class="check-count-number">(99+)</div>
                                </li>
                                <li>
                                    <div class="check-item">
                                        <input type="checkbox" id="A-Bathing-Ape">
                                        <label for="A-Bathing-Ape">A Bathing Ape</label>
                                    </div>
                                    <div class="check-count-number">(99+)</div>
                                </li>
                                <li>
                                    <div class="check-item">
                                        <input type="checkbox" id="Aape">
                                        <label for="Aape">Aape</label>
                                    </div>
                                    <div class="check-count-number">(99+)</div>
                                </li>
                                <li>
                                    <div class="check-item">
                                        <input type="checkbox" id="Alexander-McQueen">
                                        <label for="Alexander-McQueen">Alexander McQueen</label>
                                    </div>
                                    <div class="check-count-number">(99+)</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value='0' selected>Any Gender</option>
                            @forelse($parent_categories as $parent_category)
                            <option  @if(isset($gender) &&  $parent_category->id==$gender ) selected  @endif value="{{ $parent_category->id }}">{{ $parent_category->shop_cat_name }}
                            </option>
                            @empty
                            <option>No option</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Categories</label>
                        <select name="categories" id="categories" class="form-control">
                            <option value="0" selected>Select a category</option>
                        
                            
                                <?php
                                    $child_cats =App\Models\ShopCategory::whereRaw("flags & ? = ?", [App\Models\ShopCategory::FLAG_ACTIVE, App\Models\ShopCategory::FLAG_ACTIVE])->where('parent_id','>',0)
                                    ->groupBy("shop_cat_slug")
                                    ->orderBy('shop_cat_name', 'ASC')->get()->toArray();
                                    foreach ($child_cats as $key => $child_cat){ 
                                    ?>
                                        <option @if(isset($category) && $category==$child_cat['id'] ) selected  @endif  value="{{ $child_cat['shop_cat_slug'] }}"> <?php echo $child_cat['shop_cat_name'];?></option>
                                    <?php
                            }
                        
                    ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="color">Sizes</label>
                        <select name="sizes" id="size" class="form-control">
                            <option value="0" selected>Please Select Size</option>
                            
                        </select>
                    </div> 
                    <div class="form-group">
                        <label for="brands">Brands</label>
                        <select name="brands" id="brand" class="form-control">
                            <option value='0' selected>Any Brand</option>
                            <?php $brands = App\Models\Brand::whereRaw("flags & ? = ?", [App\Models\Brand::FLAG_ACTIVE, App\Models\Brand::FLAG_ACTIVE])
                            ->orderBy('brand_name')
                            ->get()
                            ->toArray();
                    foreach ($brands as $key => $brand) {
                        ?>
                            <option @if(isset($brand_id) && $brand_id==$brand['id']) selected @endif value="<?php echo $brand['id']; ?>"><?php echo $brand['brand_name']; ?></option>
                            <?php }?>
                        </select>
                    </div> -->
                {{-- <button type="reset" class="btn blue-button mt-2 ml-4 mb-4">Reset</button> --}}
                </form>

            </aside>
        </div>
    </div>
       
@yield('products-content')


</main>
@endsection

@section('scripts')
<script>
$(document).ready(function() {

 

    $("#brand").change(function() {
                brand = $('#brand').val();
                categories = $('#categories').val();
                gender = $('#gender').val();
                size_id=$('#size').val();
                $.ajax({
                    url: "{{ route('shop.gender') }}",
                    method: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        brand: brand,
                        categories: categories,
                        gender: gender,
                        sizes : size_id

                    },
                    success: function(result) {
                        $(".result-count").html("Showing 1–" + result.selected + " of " + result.count + " results");
                        $('.products-wrapper').html(result.html);
                        //console.log(result);
                        //$('.products-wrapper').html(result);
                        //result = JSON.parse(result)

                    }
                });
            });
            $("#categories").change(function() {
                brand = $('#brand').val();
                categories = $('#categories').val();
                gender = $('#gender').val();
                size_id=$('#size').val();
                $.ajax({
                    url: "{{ route('shop.gender') }}",
                    method: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        brand: brand,
                        categories: categories,
                        gender: gender,
                        sizes : size_id,
                    },
                    success: function(result) {

                        var sz=JSON.parse(result.sizes);

                        $("#size").empty();
                        $("#size").append('<option value="0" selected="">Please Select Size</option>');

                       for(j=0; j<sz.length; j++)
                       {

                        $("#size").append('<option  value="'+sz[j].id+'">'+sz[j].size+'</option>');

                       }

                        $(".result-count").html("Showing 1–" + result.selected + " of " + result.count + " results");
                        $('.products-wrapper').html(result.html);


                    }
                });
            });
            //product-filters
            $("#gender").change(function() {   
                brand = $('#brand').val();
                categories = $('#categories').val();
                gender = $('#gender').val();
                size_id=$('#size').val();
                $.ajax({
                    url: "{{ route('shop.gender') }}",
                    method: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        brand: brand,
                        categories: categories,
                        gender: gender,
                        sizes : size_id
                    },
                    success: function(result) {
                        $(".result-count").html("Showing 1–" + result.selected + " of " + result.count + " results");
                        $('.products-wrapper').html(result.html);

                        $("#categories").empty();
                        $("#categories").append('<option value="0" selected="">Select a category</option>');
                        var ca=JSON.parse(result.scat);

                        var sz=JSON.parse(result.sizes);

                        $("#size").empty();
                        $("#size").append('<option value="0" selected="">Please Select Size</option>');

                        for(j=0; j<sz.length; j++)
                        {

                        $("#size").append('<option  value="'+sz[j].id+'">'+sz[j].size+'</option>');

                        }




                        

                        for(i=0; i<ca.length; i++)
                        {
                            if(ca[i].shop_cat_slug==categories)
                            {
                                $("#categories").append('<option selected value="'+ca[i].shop_cat_slug+'">'+ca[i].shop_cat_name+'</option>');
                            }
                            else
                            {
                                $("#categories").append('<option  value="'+ca[i].shop_cat_slug+'">'+ca[i].shop_cat_name+'</option>');
                            }     
                        }
                    }
                });

            });

            $("#size").change(function() {   
                brand = $('#brand').val();
                categories = $('#categories').val();
                gender = $('#gender').val();
                size_id=$('#size').val();
                $.ajax({
                    url: "{{ route('shop.gender') }}",
                    method: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        brand: brand,
                        categories: categories,
                        gender: gender,
                        sizes : size_id
                    },
                    success: function(result) {
                        $(".result-count").html("Showing 1–" + result.selected + " of " + result.count + " results");
                        $('.products-wrapper').html(result.html);

                        $("#categories").empty();
                        $("#categories").append('<option value="0" selected="">Select a category</option>');
                        var ca=JSON.parse(result.scat);

                        var sz=JSON.parse(result.sizes);

                        $("#size").empty();
                        $("#size").append('<option value="0" selected="">Please Select Size</option>');

                        for(j=0; j<sz.length; j++)
                        {

                        $("#size").append('<option  value="'+sz[j].id+'">'+sz[j].size+'</option>');

                        }

                        for(i=0; i<ca.length; i++)
                        {
                            if(ca[i].shop_cat_slug==categories){
                                $("#categories").append('<option selected value="'+ca[i].shop_cat_slug+'">'+ca[i].shop_cat_name+'</option>');
                            }
                            else{
                                $("#categories").append('<option  value="'+ca[i].shop_cat_slug+'">'+ca[i].shop_cat_name+'</option>');
                            }     
                        }
                    }
                });

            });




});
</script>
@endsection