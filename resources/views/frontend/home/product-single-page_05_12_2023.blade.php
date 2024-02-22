@extends('layouts.frontend.master')
@section('title')
    {{ $product->product_name }} - The Marketplace
@endsection
@section('banner')
@endsection
@section('content')
<style>
    .success-alert.show{
        z-index: 9999999999;
    }
    /* .size_guide_div ul{
        list-style: none;
        float: left;
        width: 100%;
        margin-bottom: 0;
        border-bottom: 1px solid #e9ecef;
    }
    .size_guide_div ul li{
        float: left;
        padding: 5px 15px;
       
    } */
    .size_guide_table td{
        min-width: 100px;
        text-align: center;
        border-top: 0px solid #dee2e6;
    }
    .size_guide_table tr{
        border-top: 1px solid #dee2e6;
    }
</style>
    <?php
    $recent_products = Cookie::get('recentViews');
    $user_id = 0;
    if ($recent_products) {

        $recent_products .= ','. $product->id;
        Cookie::queue('recentViews', $recent_products, 86400);

    } else {

        Cookie::queue('recentViews', $product->id, 86400);
        $recent_products = $product->id;
    }

    $recent_prod_array = array_unique(explode(",", $recent_products));
    $recent_view_products = \App\Models\Product::select('products.*')->whereIn('products.id', $recent_prod_array)->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags',1)->get();
    $current_url = URL::current();
    $reviews = 0;

    if (auth()->user()) {
        $user_id = auth()->user()->id;
    }

    ?>
    <style>
    .cart-items-wrapper,.sidebar-cart.show {
        height: calc(100vh - 210px);
        background: #f4f4f4;
}
    </style>

    <main class="product-page product-page-new pb-0">

        <div class="container pt-5">

            <div class="single-product">
                <div class="column column-img flex-column">
                    @if(count($product->multi_images)>0)
                        <div class="owl-carousel owl-theme single-img-slider">
                            <div class="item"> 
                                <div class="img-wrapper"> 
                                    @if($product->parent_id > 0)
                                        <?php $p=\App\Models\Product::where("id",$product->parent_id)->first(); ?>
                                            <?php 
                                            if($product->product_type == 2){ ?>
                                            <img src="{{ url('/').'/storage/seller-product/'.$product->id.'/'.$product->feature_image;}}" alt="" class="img-fluid">
                                            <?php }else{ ?>
                                            <img src="{{ url('/').'/storage/product/'.$p->id.'/'.$p->feature_image;}}" alt="abc" class="img-fluid">
                                        <?php } ?>
                                    @else
                                        <img src="{{ $product->image_url }}" class="img-fluid">
                                    @endif
                                </div>
                            </div>
                            @if(isset($product->multi_images))
                                  @foreach($product->multi_images as $multi_images)                                            
                                    <div class="item"> 
                                        <div class="img-wrapper">
                                            @php 
                                                $imageurlis = $multi_images->image_multi_url;
                                                if($product->product_type == 2){
                                                    $imageurlis = str_replace("product","seller-product",$multi_images->image_multi_url);
                                                }
                                            @endphp
                                            <img src="{{ $imageurlis }}" class="img-fluid">
                                        </div>
                                    </div>
                                @endforeach


                            @endif
                        </div>
                    @else
                        <div class="owl-carousel owl-theme single-img-slider" style="display: block;">
                            <div class="item"> 
                                <div class="img-wrapper" style="width: 80%;margin: auto;">
                                    @if($product->parent_id > 0)
                                        <?php $p=\App\Models\Product::where("id",$product->parent_id)->first(); ?>
                                        <?php 
                                        if($product->product_type == 2){ ?>
                                        <img src="{{ url('/').'/storage/seller-product/'.$product->id.'/'.$product->feature_image;}}" alt="" class="img-fluid">
                                        <?php }else{ ?>
                                        <img src="{{ url('/').'/storage/product/'.$p->id.'/'.$p->feature_image;}}" alt="abc" class="img-fluid">
                                        <?php } ?>
                                    @else
                                        <img src="{{ $product->image_url }}" class="img-fluid">
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                    <div id="counterindex"></div>
                </div>
                <div class="column column-details">  
                    <div class="inner-wrapper">
                        <h3 class="product-title">{{$product->product_name}}</h3>
                        <div class="product-price">
                            {{-- <h3 class="discounted-price">£{{$product->regular_price}}</h3>
                             <h3 class="actual-price">£{{$product->sale_price}}</h3>  --}}

                             @php 
                              $getLowestPrice = skuToGetProductLowestPrivce($product->id,$product->parent_id);
                             @endphp
                                
                            @if((int)$getLowestPrice->sale_price > 0 && (int)$getLowestPrice->regular_price > $getLowestPrice->sale_price)
                                <h3 class="discounted-price">£{{number_format($getLowestPrice->regular_price,2) }}</h3>
                                <h3 class="real-price" >£{{number_format($getLowestPrice->sale_price,2) }}</h3>
                            @else
                                <h3 class="real-price">£{{number_format($getLowestPrice->regular_price,2) }}</h3>
                            @endif

                            {{-- @if((int)$product->sale_price > 0 && (int)$product->regular_price > $product->sale_price)
                                <h3 class="real-price" >£{{number_format($product->sale_price,2) }}</h3>
                                <h3 class="discounted-price">£{{number_format($product->regular_price,2) }}</h3>
                            @else
                                <h3 class="real-price">£{{number_format($product->regular_price,2) }}</h3>
                            @endif --}}

                        </div>

                        

                        <form action="">
                            <h4 class="size-guide"><span class="view_single_page_show"></span> <a data-toggle="modal" data-target="#sizeGuide_Modal"> View Size Guide</a></h4>
                            <div class="product-slider-wrapper"> 
                                   @php $getTotalSlidecount = isset($product->prod_size)? count($product->prod_size->where('flags', 1)): 0; @endphp

                                   
                                <div class="owl-carousel owl-theme product-pills-slider {{($getTotalSlidecount > 5)?'slide_more_then_five':''}}">
                                    {{-- for admin sizes --}}
                                        @php $adminSizes = array(); @endphp
                                   {{-- for admin sizes --}}
                                    @foreach($product->prod_size->where('flags', 1) as $sizes)
                                         {{-- for admin sizes --}}
                                             @php
                                                $sizearray = array();
                                                $sizearray['size_id'] = $sizes->size_id;
                                                $sizearray['size_name'] = $sizes->size->size??$sizes->size_id;
                                                $sizearray['check_quantity'] = $sizes->quantity;
                                                $adminSizes[]=$sizearray;
                                             @endphp
                                         {{-- for admin sizes --}}
                                        <div class="item" @if($sizes->size_id == 111) style="margin-left:207%;"  @endif > 
                                            <div class="item-wrapper">
                                                @php
                                                    $product_is_wishlist = "";
                                                    if(isset($_GET['wishlist_size'])){
                                                        $product_size_wishlit = $_GET['wishlist_size'];
                                                        if($product_size_wishlit == $sizes->size->size){
                                                            $product_is_wishlist = "product_is_wishlist";
                                                        }
                                                    }
                                                @endphp
                                                <button onclick="wishlist({{$sizes->product_id}}, {{$sizes->size_id}});" class="pills-link-admin {{$product_is_wishlist}} pills-link <?php echo ($sizes->quantity > 0 ? '' : 'quantity-disabled' );?>" <?php echo ($sizes->quantity > 0 ? '' : 'disabled' );?> data-size_id = '{{$sizes->size_id}}' data-variation_id = '{{$sizes->id}}' data-toggle="pill" type="button">
                                                @if($sizes->size != null)
                                                {{$sizes->size->size}}
                                                @else   
                                                {{$sizes->size_id}}
                                                @endif 
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div> 
                            <div class="product-quantity">
                                <div class="quantity">
                                    <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value"><i class="uil uil-minus"></i></div>
                                    <input type="number" id="number" value="01" readonly/>
                                    <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value"><i class="uil uil-plus"></i></div>  
                                </div>
                                <div class="wishlist_and_compayr_btns">
                                    <div class="action-buttons">
                                        <a style="color: rgb(173, 173, 173);" class="btn Add-to-Wishlist" style="color:red;" id = "addWishlist"><i class="uil uil-heart-alt"></i></a>
                                        <!-- <a type="button" class="btn Add-to-Wishlist" style="color:red;" id = "addWishlist"></a> -->
                                        <a href="javascript:void(0)" class="btn add_to_comper_btn">
                                            <svg width="18" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.5761 10.208C13.902 9.90722 14.431 9.90722 14.7526 10.2041L14.7568 10.208L19.7547 14.8218C20.0806 15.1226 20.0806 15.607 19.7547 15.9078L14.7568 20.5254C14.431 20.8263 13.902 20.8263 13.5761 20.5254C13.2503 20.2246 13.2503 19.7363 13.5761 19.4355L17.9858 15.3648L13.5761 11.2941C13.2503 10.9972 13.2503 10.5088 13.5761 10.208Z" fill="#212121"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.10352e-05 15.3648C6.10352e-05 14.939 0.372469 14.5952 0.833747 14.5952H18.3327C18.794 14.5952 19.1664 14.939 19.1664 15.3648C19.1664 15.7906 18.794 16.1344 18.3327 16.1344H0.833747C0.372469 16.1344 6.10352e-05 15.7906 6.10352e-05 15.3648ZM6.4241 0.976691C6.74996 1.2775 6.74996 1.76192 6.4241 2.06273L2.01022 6.13735L6.41987 10.2081C6.74572 10.5089 6.74572 10.9972 6.41987 11.298C6.09401 11.5988 5.56502 11.5988 5.23916 11.298L0.245512 6.68037C-0.0803453 6.37956 -0.0803453 5.89123 0.245512 5.59433L5.2434 0.976691C5.56925 0.675881 6.09824 0.675881 6.4241 0.976691Z" fill="#212121"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.833679 6.13733C0.833679 5.71151 1.20609 5.36772 1.66737 5.36772H19.1663C19.6276 5.36772 20 5.71151 20 6.13733C20 6.56315 19.6276 6.90694 19.1663 6.90694H1.66737C1.20609 6.90303 0.833679 6.55924 0.833679 6.13733Z" fill="#212121"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="add_to_card_btn_show">
                                <input type="hidden" name="product_id" id = "product_id" value = "{{$product->id}}">
                                <button class="btn add-to-cart-button" id = "addToCart" disabled style="background:#dcdcdc;" type="button" >Add to Cart <i class="ml-1 fa fa-shopping-cart"></i></button>
                            </div>
                        </form>
                                        
                        <div class="social">
                            <p class="mr-1">Share:</p>
                            <p>
                                <?php $site_url = route('single-product', ['id' => $product->id]);?>
                                <a href="http://www.facebook.com/sharer.php?u=<?=$site_url;?>"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://twitter.com/share?url=<?=$site_url?>&amp;text=Simple%20Share%20Buttons&amp;hashtags=simplesharebuttons" target="_blank"><i class="fab fa-twitter"></i></a>
                                <a href="mailto:?Subject=The Marketpalce&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 <?=$site_url;?>"><i class="fas fa-envelope"></i></a>
                                <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());"><i class="fab fa-pinterest"></i></a>
                            </p>
                        </div>

                    </div>


                </div>
            </div>

            <div style="display:none" class="product-layout single_page_product">

                <div class="column images-column column-img">
                    <div class="owl-carousel owl-theme single-img-slider">
                        <div class="item">
                            <div class="img-wrapper">
                                <img src="{{ $product->image_url }}" class="img-fluid">
                            </div>
                        </div>
                        @if(isset($product->multi_images))
                            @foreach($product->multi_images as $multi_images)
                                <div class="item">
                                    <div class="img-wrapper">
                                        <img src="{{ $multi_images->image_multi_url }}" class="img-fluid">
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                <!--
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Brand</a></li>
                        <li class="breadcrumb-item"><a href="#">Sub Brand</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$product->product_name}}</li>
                        </ol>
                    </nav> -->
                </div>
                <div class="column product-details-column">
                    <a href="javascript:void(0)" class="cross-times">
                        &times;
                    </a>
                    <div class="heading-area">
                        <h3 class="product-title" style="font-weight: 600;">{{$product->product_name}}</h3>
                    </div>

                    <ul class="nav nav-pills nav-pills-product" id="pills-products" role="tablist">
                        <li class="nav-item">                           
                            <a class="nav-link active" id="new-product" data-toggle="pill" href="#pills-new-product">New</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="used-product" data-toggle="pill" href="#pills-used-product">Pre-Loved</a>
                        </li>
                    </ul>
                    <div class="tab-content product-pills-content" style="text-align:center;">
                        <div class="tab-pane fade  show active" id="pills-new-product">

                            <div class="product-size-wrapper">
                                <div class="inner product-sizes product-slider-wrapper" id="product-sizes">
                                    <div class="owl-carousel owl-theme product-pills-slider {{($getTotalSlidecount > 5)?'slide_more_then_five':''}}">


                                        <?php $array = array();?>
                                        @foreach($new_products as $sizes)
                                            <?php
                                            if(! empty($sizes['product_size']) ) {
                                                foreach($sizes['product_size'] as $product_size_new) {
                                                    if( !empty($product_size_new['products']) ) {
                                                        array_push($array, $product_size_new['sale_price']);
                                                    }
                                                }

                                            }
                                            ?>
                                        @endforeach
                                        <?php
                                            $min=0;
                                            if(count($array) > 0 ){
                                                $min = min($array);
                                            }
                                        ?>

                                        {{-- @foreach($new_products as $key=> $sizes)
                                            <div class="item"   @if( isset($sizes['size']) && $sizes['size']=="One Size" )  style="width:0% !important; margin-left:207%;" @endif>

                                                <button  class="pills-general pills-link-new-product pills-link
                                                     <?php 
                                                    //  if(isset($sizes['product_size']) && $sizes['product_size'] != NULL) {
                                                    //             foreach ($sizes['product_size'] as $product_size) {
                                                    //                 if(isset($product_size['products']) && $product_size['products'] != NULL) {
                                                    //                     if($product_size['sale_price'] == $min) {
                                                    //                         echo 'active';
                                                    //                         break;
                                                    //                     }
                                                    //                 } else {
                                                    //                 if(isset($sizes["product_size"][0])  || isset($sizes["product_size"][1])  )
                                                    //                 {
                                                    //                 }
                                                    //                 else
                                                    //                 {
                                                    //                     echo 'quantity-disabled';
                                                    //                 }
                                                    //                 }
                                                    //             }
                                                    //  }else {
                                                    //     echo 'quantity-disabled';
                                                    //  }
                                                     ?>
                                                    " data-product_id = "{{$product->id}}" data-size_id="{{$sizes['id']}}" data-flags='1'  data-toggle="pill" type="button"  >

                                                    {{$sizes['size']}}                                                        
                                                    <?php
                                                        // if(!empty($sizes['product_size'])){
                                                        // foreach ($sizes['product_size'] as $product_size) {
                                                        // if(isset($product_size['products']) && $product_size['products'] != NULL) {
                                                         ?>
                                                        // <span class="pill-price">£{{number_format($product_size['sale_price'],2)}}</span>
                                                         <?php
                                                        // break;
                                                        // }
                                                        // }
                                                        // }
                                                    ?>
                                                </button>
                                            </div>
                                        @endforeach --}}





                                        {{-- before size issue fixed --}}
                                        {{-- @if(count($new_products) > 0)
                                            @foreach($new_products as $new_products)
                                                @php
                                                    $product_is_wishlist_new = "";
                                                    if(isset($_GET['wishlist_new'])){
                                                        $product_size_wishlit_new = $_GET['wishlist_new'];
                                                        if($product_size_wishlit_new == $new_products->size){
                                                            $product_is_wishlist_new = "product_is_wishlist_new";
                                                        }
                                                    }
                                                @endphp
                                                <div class="item">
                                                    <button  class="pills-general pills-link-new-product pills-link by_new_wishlist {{$product_is_wishlist_new}}
                                                        <?php //if($new_products->product_sizes_quantity < 1 ){ echo "quantity-disabled"; } ?>"  
                                                        data-product_id="{{$product->id}}" data-size_id="{{$new_products->size_id}}" data-flags='1'  data-toggle="pill" type="button">
                                                            {{$new_products->size}}
                                                            <?php
                                                            //$getprice = \App\Models\ProductSize::select('product_sizes.sale_price')->whereIN('product_id',$buyNewProducts)
                                                           // ->where('size_id',$new_products->size_id)->where('sale_price', '>', 0)->orderBy('sale_price', 'ASC')->first();
                                                           // if($getprice){?>
                                                                    <span class="pill-price">£{{number_format($getprice->sale_price,2)}}</span> 
                                                            <?php //} ?>                                                            
                                                        </button>
                                                </div>
                                            @endforeach
                                        @endif --}}
                                        {{-- before size issue fixed --}}

                                    {{-- for admin sizes --}}
                                    @if(count($adminSizes) > 0)
                                        @foreach($adminSizes as $adminSizesIs)
                                            @if(count($new_products) > 0)
                                                @php $sizeExitOrNot = "No"; @endphp
                                                @foreach($new_products as $new_products_row)
                                                    @if($adminSizesIs['size_id'] == $new_products_row->size_id)
                                                        @php
                                                            $sizeExitOrNot = "Yes";
                                                            $product_is_wishlist_new = "";
                                                            if(isset($_GET['wishlist_new'])){
                                                                $product_size_wishlit_new = $_GET['wishlist_new'];
                                                                if($product_size_wishlit_new == $new_products_row->size){
                                                                    $product_is_wishlist_new = "product_is_wishlist_new";
                                                                }
                                                            }
                                                        @endphp
                                                        <div class="item">
                                                            <button  class="pills-general pills-link-new-product pills-link  {{$product_is_wishlist_new}}
                                                                <?php echo ($new_products_row->product_sizes_quantity < 1) ? 'quantity-disabled' : 'by_new_wishlist';?>"  
                                                                data-product_id="{{$product->id}}" data-size_id="{{$new_products_row->size_id}}" data-flags='1'  data-toggle="pill" type="button">
                                                                    {{$new_products_row->size}}
                                                                    <?php
                                                                $getprice = \App\Models\ProductSize::select('product_sizes.sale_price')->whereIN('product_id',$buyNewProducts)
                                                                ->where('size_id',$new_products_row->size_id)->where('sale_price', '>', 0)->orderBy('sale_price', 'ASC')->first();
                                                                if($getprice){ ?>
                                                                            <span class="pill-price">£{{number_format($getprice->sale_price,2)}}</span> 
                                                                    <?php } ?>                                                            
                                                                </button>
                                                        </div>
                                                    @endif
                                                @endforeach
                                                @if($sizeExitOrNot == "No")
                                                    <div class="item">
                                                        <button  class="pills-general pills-link-new-product pills-link quantity-disabled " disabled data-toggle="pill" type="button">
                                                                {{$adminSizesIs['size_name']}}
                                                        </button>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="item">
                                                    <button  class="pills-general pills-link-new-product pills-link quantity-disabled " disabled data-toggle="pill" type="button">
                                                            {{$adminSizesIs['size_name']}}
                                                    </button>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                     {{-- for admin sizes --}}

                                    </div>
                                </div>

                                <!-- <button class="btn p-size-btn-left" id="p-size-btn-left"><i class="uil uil-arrow-left"></i></button>
                                <button class="btn p-size-btn-right" id="p-size-btn-right"><i class="uil uil-arrow-right"></i></button>  -->
                            </div>

                            <div class="pro_upper_box" style="margin-top: -18px;"></div>

                            <div class="tab-content product-size-content">
                                <div class="tab-pane fade show active" id="product-size-1">
                                    <ul>

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-used-product">
                            <div class="product-size-wrapper">
                                <div class="inner product-sizes product-slider-wrapper" id="used-product-sizes">
                                    <div class="owl-carousel owl-theme product-pills-slider {{($getTotalSlidecount > 5)?'slide_more_then_five':''}}">
                                        <?php $array1 = array();?>


                                        @foreach($used_products as $i=>$sizes)

                                            <?php
                                            if(! empty($sizes['product_size']) ) {
                                                foreach($sizes['product_size'] as $product_size_new) {
                                                    if( !empty($product_size_new['products']) ) {
                                                        array_push($array1, $product_size_new['sale_price']);
                                                    }
                                                }
                                            }
                                            ?>
                                        @endforeach

                                        <?php
                                        $min1=0;
                                        if(count($array1) > 0 ){
                                            $min1 = min($array1);
                                        }
                                        ?>

                                        {{-- @foreach($used_products as $used_product)
                                            <div class="item" @if(isset($used_product['size']) && $used_product['size']=="One Size") style="width:0%;margin-left:207%;"  @endif>
                                                <div class="item-wrapper">
                                                    <button class="pills-general pills-link-used-product pills-link
                                                    <?php
                                                    // if(isset($used_product['product_size']) && $used_product['product_size'] != NULL) {
                                                    //       if( !empty($used_product['product_size'])){
                                                    //         $temperory=0;
                                                    //         foreach ($used_product['product_size'] as $product_size) {
                                                    //             if(isset($product_size['products']) && $product_size['products'] != NULL && (int)$product_size['sale_price'] > 0) {

                                                    //                 $temperory= $temperory+1;
                                                    //             }
                                                    //         }
                                                    //         if($temperory==0)
                                                    //         {
                                                    //             echo 'quantity-disabled';
                                                    //         }
                                                    //     }
                                                    //     }else {
                                                    //         echo 'quantity-disabled';
                                                    //     }
                                                    ?>"  data-product_id = "{{$product->id}}" data-size_id="{{$used_product['id']}}" data-flags='2'  data-toggle="pill" type="button">
                                                        {{$used_product['size']}}

                                                        <?php
                                                        // if( !empty($used_product['product_size'])){
                                                        //     foreach ($used_product['product_size'] as $product_size) {
                                                        //         if(isset($product_size['products']) && $product_size['products'] != NULL) { ?>
                                                                <span class="pill-price">£{{number_format($product_size['sale_price'],2)}}</span>
                                                        <?php
                                                        // break;
                                                        //     }
                                                        //     }
                                                        // } ?>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach --}}
                                        
                                    {{-- before size issue fixed --}}
                                        {{-- @if(count($used_products) > 0)
                                            @foreach($used_products as $used_product)
                                                <div class="item">
                                                    <div class="item-wrapper">
                                                        <button class="pills-general pills-link-used-product pills-link
                                                        <?php //if($used_product->product_sizes_quantity < 1 ){ echo "quantity-disabled"; } ?>"  
                                                        data-product_id="{{$product->id}}" data-size_id="{{$used_product->size_id}}" data-flags='2'  data-toggle="pill" type="button">
                                                            {{$used_product->size}}
                                                            <?php
                                                           // $getprice = \App\Models\ProductSize::select('product_sizes.sale_price')->whereIN('product_id',$preLovedProducts)
                                                            //->where('size_id',$used_product->size_id)->where('sale_price', '>', 0)->orderBy('sale_price', 'ASC')->first();
                                                           // if($getprice){?>
                                                                    <span class="pill-price">£{{number_format($getprice->sale_price,2)}}</span> 
                                                            <?php //} ?>                                                            
                                                        </button>
                                                    </div>
                                                </div>
                                             @endforeach
                                        @endif --}}
                                    {{-- before size issue fixed --}}

                                    {{-- for admin sizes --}}
                                    @if(count($adminSizes) > 0)
                                        @foreach($adminSizes as $adminSizesIs)
                                            @if(count($used_products) > 0)
                                                @php $sizeExitOrNot = "No"; @endphp
                                                    @foreach($used_products as $used_product)
                                                        @if($adminSizesIs['size_id'] == $used_product->size_id)
                                                            @php $sizeExitOrNot = "Yes"; @endphp
                                                                <div class="item">
                                                                    <div class="item-wrapper">
                                                                        <button class="pills-general pills-link-used-product pills-link
                                                                        <?php if($used_product->product_sizes_quantity < 1 ){ echo "quantity-disabled"; } ?>"  
                                                                        data-product_id="{{$product->id}}" data-size_id="{{$used_product->size_id}}" data-flags='2'  data-toggle="pill" type="button">
                                                                            {{$used_product->size}}
                                                                            <?php
                                                                            $getprice = \App\Models\ProductSize::select('product_sizes.sale_price')->whereIN('product_id',$preLovedProducts)
                                                                            ->where('size_id',$used_product->size_id)->where('sale_price', '>', 0)->orderBy('sale_price', 'ASC')->first();
                                                                            if($getprice){?>
                                                                                    <span class="pill-price">£{{number_format($getprice->sale_price,2)}}</span> 
                                                                            <?php } ?>                                                            
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            {{-- @endif --}}
                                                        @endif
                                                    @endforeach
                                                @if($sizeExitOrNot == "No")
                                                    <div class="item"><div class="item-wrapper">
                                                        <button class="pills-general pills-link-used-product pills-link quantity-disabled" disabled data-toggle="pill" type="button">
                                                                {{$adminSizesIs['size_name']}}
                                                        </button>
                                                    </div></div>
                                                @endif
                                            @else
                                                <div class="item"><div class="item-wrapper">
                                                    <button class="pills-general pills-link-used-product pills-link quantity-disabled" disabled data-toggle="pill" type="button">
                                                            {{$adminSizesIs['size_name']}}
                                                    </button>
                                                </div></div>
                                            @endif
                                        @endforeach
                                    @endif
                                    {{-- for admin sizes --}}

                                    </div>
                                </div>
                                <div style="margin-top:-11px;"></div>
                                <div class="pro_upper_box" style="padding: 0px 0;border: 0px;" >
                                </div>


                                <!-- <button class="btn p-size-btn-left" id="used-size-btn-left"><i class="uil uil-arrow-left"></i></button>
                                <button class="btn p-size-btn-right" id="used-size-btn-left"><i class="uil uil-arrow-right"></i></button> -->
                            </div>


                            <div class="pro_upper_box"  style="margin-top: -32px;" ></div>

                            <div class="tab-content used-product-size-content">
                                <div class="tab-pane fade show active" id="used-product-size-1">
                                    {{-- <h6>Authenticity Assured</h6>
                                        <div class="pro_upper_box">
                                            <div class="pro_box">
                                                <a href="product-used.html" class="btn used-product">
                                                    <div class="img-wrapper">
                                                        <!--<img src="assets/images/used-product-1.jpeg" class="img-fluid">-->
                                                        <img src="{{ $product->image_url }}" class="img-fluid">
                                                    </div>
                                                </a>
                                                <div class="pro_detail">
                                                    <font>Price: <span class="price">$300</span></font>
                                                    <span class="about-used-product">Original Box (Good)</span>
                                                    <span class="about-used-product">Faults: <font>Missing Labels</font></span>
                                                </div>
                                            </div>
                                            <a class="btn  blue-button">View</a>
                                        </div> --}}
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="sizeGuide_Modal" tabindex="-1" role="dialog" aria-labelledby="sizeGuide_ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="sizeGuide_ModalLabel">Size Guide</h5>
                            <button id = "close_button_model" type="button" class="close"  data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="size_guide_div table-responsive">
                                @if(count($adminSizes) > 0)
                                <table class="size_guide_table table">
                                    @foreach($adminSizes as $adminSizesIs)
                                        <tr>
                                            <td>
                                                {{$adminSizesIs['size_name']}}
                                            </td>
                                            @php 
                                                $allSizeGuide = App\Models\SizeGuide::where('brand_id',$product->brand_id)->where('shop_category_id',$product->shop_category_id)->where('gender',$product->gender)->where('size_id',$adminSizesIs['size_id'])->get();	
                                            @endphp
                                            @if(count($allSizeGuide) > 0)
                                                @foreach($allSizeGuide as $row)
                                                    <td>
                                                        {{$row->guide_size}}
                                                    </td>
                                                @endforeach 
                                            @endif
                                        </tr>
                                    @endforeach
                                </table>
                                @endif                                     
                            </div>

                            {{-- <div id="accordionlvl1">
                                <div class="card">
                                    <div class="card-header">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#lvl1_collapseOne"
                                                aria-expanded="false" aria-controls="lvl1_collapseOne">
                                            Men
                                        </button>
                                    </div>
                                    <div id="lvl1_collapseOne" class="collapse" data-parent="#accordionlvl1">
                                        <div class="card-body">
                                            <div id="menAcc">
                                                <div class="card">
                                                    <div class="card-header" id="headingOne">

                                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                                                data-target="#menAcc_collapseOne" aria-expanded="false" aria-controls="menAcc_collapseOne">
                                                            Clothing
                                                        </button>

                                                    </div>
                                                    <div id="menAcc_collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#menAcc">
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>UK</th>
                                                                        <th>CHEST</th>
                                                                        <th>WAIST</th>
                                                                        <th>HIP</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>XS</td>
                                                                        <td>31-33"</td>
                                                                        <td>27-29"</td>
                                                                        <td>32-34"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>S</td>
                                                                        <td>34-37"</td>
                                                                        <td>30-32"</td>
                                                                        <td>35-37"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>M</td>
                                                                        <td>37-40"</td>
                                                                        <td>32-35"</td>
                                                                        <td>37-40"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>L</td>
                                                                        <td>40-44"</td>
                                                                        <td>35-39"</td>
                                                                        <td>40-44"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>XL</td>
                                                                        <td>44-48"</td>
                                                                        <td>39-43"</td>
                                                                        <td>44-48"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>2XL</td>
                                                                        <td>48-52"</td>
                                                                        <td>43-47"</td>
                                                                        <td>48-51"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>3XL</td>
                                                                        <td>43-58"</td>
                                                                        <td>48-53"</td>
                                                                        <td>51-56"</td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingTwo">

                                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                                                data-target="#menAcc_collapseTwo" aria-expanded="false" aria-controls="menAcc_collapseTwo">
                                                            Footwear
                                                        </button>

                                                    </div>
                                                    <div id="menAcc_collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#menAcc">
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>UK</th>
                                                                        <th>CHEST</th>
                                                                        <th>WAIST</th>
                                                                        <th>HIP</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>XS</td>
                                                                        <td>31-33"</td>
                                                                        <td>27-29"</td>
                                                                        <td>32-34"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>S</td>
                                                                        <td>34-37"</td>
                                                                        <td>30-32"</td>
                                                                        <td>35-37"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>M</td>
                                                                        <td>37-40"</td>
                                                                        <td>32-35"</td>
                                                                        <td>37-40"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>L</td>
                                                                        <td>40-44"</td>
                                                                        <td>35-39"</td>
                                                                        <td>40-44"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>XL</td>
                                                                        <td>44-48"</td>
                                                                        <td>39-43"</td>
                                                                        <td>44-48"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>2XL</td>
                                                                        <td>48-52"</td>
                                                                        <td>43-47"</td>
                                                                        <td>48-51"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>3XL</td>
                                                                        <td>43-58"</td>
                                                                        <td>48-53"</td>
                                                                        <td>51-56"</td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingThree">

                                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                                                data-target="#menAcc_collapseThree" aria-expanded="false"
                                                                aria-controls="menAcc_collapseThree">
                                                            Accessories

                                                        </button>
                                                    </div>
                                                    <div id="menAcc_collapseThree" class="collapse" aria-labelledby="headingThree"
                                                         data-parent="#menAcc">
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>UK</th>
                                                                        <th>CHEST</th>
                                                                        <th>WAIST</th>
                                                                        <th>HIP</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>XS</td>
                                                                        <td>31-33"</td>
                                                                        <td>27-29"</td>
                                                                        <td>32-34"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>S</td>
                                                                        <td>34-37"</td>
                                                                        <td>30-32"</td>
                                                                        <td>35-37"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>M</td>
                                                                        <td>37-40"</td>
                                                                        <td>32-35"</td>
                                                                        <td>37-40"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>L</td>
                                                                        <td>40-44"</td>
                                                                        <td>35-39"</td>
                                                                        <td>40-44"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>XL</td>
                                                                        <td>44-48"</td>
                                                                        <td>39-43"</td>
                                                                        <td>44-48"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>2XL</td>
                                                                        <td>48-52"</td>
                                                                        <td>43-47"</td>
                                                                        <td>48-51"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>3XL</td>
                                                                        <td>43-58"</td>
                                                                        <td>48-53"</td>
                                                                        <td>51-56"</td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">

                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#lvl1_collapsetwo"
                                                aria-expanded="false" aria-controls="lvl1_collapsetwo">
                                            Women
                                        </button>

                                    </div>
                                    <div id="lvl1_collapsetwo" class="collapse" data-parent="#accordionlvl1">
                                        <div class="card-body">
                                            <div id="womenAcc">
                                                <div class="card">
                                                    <div class="card-header" id="headingOne">

                                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                                                data-target="#womenAcc_collapseOne" aria-expanded="false" aria-controls="womenAcc_collapseOne">
                                                            Clothing
                                                        </button>

                                                    </div>
                                                    <div id="womenAcc_collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#womenAcc">
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>UK</th>
                                                                        <th>CHEST</th>
                                                                        <th>WAIST</th>
                                                                        <th>HIP</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>XS</td>
                                                                        <td>31-33"</td>
                                                                        <td>27-29"</td>
                                                                        <td>32-34"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>S</td>
                                                                        <td>34-37"</td>
                                                                        <td>30-32"</td>
                                                                        <td>35-37"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>M</td>
                                                                        <td>37-40"</td>
                                                                        <td>32-35"</td>
                                                                        <td>37-40"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>L</td>
                                                                        <td>40-44"</td>
                                                                        <td>35-39"</td>
                                                                        <td>40-44"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>XL</td>
                                                                        <td>44-48"</td>
                                                                        <td>39-43"</td>
                                                                        <td>44-48"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>2XL</td>
                                                                        <td>48-52"</td>
                                                                        <td>43-47"</td>
                                                                        <td>48-51"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>3XL</td>
                                                                        <td>43-58"</td>
                                                                        <td>48-53"</td>
                                                                        <td>51-56"</td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingTwo">

                                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                                                data-target="#womenAcc_collapseTwo" aria-expanded="false" aria-controls="womenAcc_collapseTwo">
                                                            Footwear
                                                        </button>

                                                    </div>
                                                    <div id="womenAcc_collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#womenAcc">
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>UK</th>
                                                                        <th>CHEST</th>
                                                                        <th>WAIST</th>
                                                                        <th>HIP</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>XS</td>
                                                                        <td>31-33"</td>
                                                                        <td>27-29"</td>
                                                                        <td>32-34"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>S</td>
                                                                        <td>34-37"</td>
                                                                        <td>30-32"</td>
                                                                        <td>35-37"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>M</td>
                                                                        <td>37-40"</td>
                                                                        <td>32-35"</td>
                                                                        <td>37-40"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>L</td>
                                                                        <td>40-44"</td>
                                                                        <td>35-39"</td>
                                                                        <td>40-44"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>XL</td>
                                                                        <td>44-48"</td>
                                                                        <td>39-43"</td>
                                                                        <td>44-48"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>2XL</td>
                                                                        <td>48-52"</td>
                                                                        <td>43-47"</td>
                                                                        <td>48-51"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>3XL</td>
                                                                        <td>43-58"</td>
                                                                        <td>48-53"</td>
                                                                        <td>51-56"</td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingThree">

                                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                                                data-target="#womenAcc_collapseThree" aria-expanded="false"
                                                                aria-controls="womenAcc_collapseThree">
                                                            Accessories

                                                        </button>
                                                    </div>
                                                    <div id="womenAcc_collapseThree" class="collapse" aria-labelledby="headingThree"
                                                         data-parent="#womenAcc">
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>UK</th>
                                                                        <th>CHEST</th>
                                                                        <th>WAIST</th>
                                                                        <th>HIP</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>XS</td>
                                                                        <td>31-33"</td>
                                                                        <td>27-29"</td>
                                                                        <td>32-34"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>S</td>
                                                                        <td>34-37"</td>
                                                                        <td>30-32"</td>
                                                                        <td>35-37"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>M</td>
                                                                        <td>37-40"</td>
                                                                        <td>32-35"</td>
                                                                        <td>37-40"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>L</td>
                                                                        <td>40-44"</td>
                                                                        <td>35-39"</td>
                                                                        <td>40-44"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>XL</td>
                                                                        <td>44-48"</td>
                                                                        <td>39-43"</td>
                                                                        <td>44-48"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>2XL</td>
                                                                        <td>48-52"</td>
                                                                        <td>43-47"</td>
                                                                        <td>48-51"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>3XL</td>
                                                                        <td>43-58"</td>
                                                                        <td>48-53"</td>
                                                                        <td>51-56"</td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">

                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#lvl1_collapseThree"
                                                aria-expanded="false" aria-controls="lvl1_collapseThree">
                                            Junior
                                        </button>

                                    </div>
                                    <div id="lvl1_collapseThree" class="collapse" aria-labelle data-parent="#accordionlvl1">
                                        <div class="card-body">
                                            <div id="juniorAcc">
                                                <div class="card">
                                                    <div class="card-header" id="headingOne">

                                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                                                data-target="#juniorAcc_collapseOne" aria-expanded="false"
                                                                aria-controls="juniorAcc_collapseOne">
                                                            Clothing

                                                        </button>
                                                    </div>
                                                    <div id="juniorAcc_collapseOne" class="collapse" aria-labelledby="headingOne"
                                                         data-parent="#juniorAcc">
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>UK</th>
                                                                        <th>CHEST</th>
                                                                        <th>WAIST</th>
                                                                        <th>HIP</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>XS</td>
                                                                        <td>31-33"</td>
                                                                        <td>27-29"</td>
                                                                        <td>32-34"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>S</td>
                                                                        <td>34-37"</td>
                                                                        <td>30-32"</td>
                                                                        <td>35-37"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>M</td>
                                                                        <td>37-40"</td>
                                                                        <td>32-35"</td>
                                                                        <td>37-40"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>L</td>
                                                                        <td>40-44"</td>
                                                                        <td>35-39"</td>
                                                                        <td>40-44"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>XL</td>
                                                                        <td>44-48"</td>
                                                                        <td>39-43"</td>
                                                                        <td>44-48"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>2XL</td>
                                                                        <td>48-52"</td>
                                                                        <td>43-47"</td>
                                                                        <td>48-51"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>3XL</td>
                                                                        <td>43-58"</td>
                                                                        <td>48-53"</td>
                                                                        <td>51-56"</td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingTwo">

                                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                                                data-target="#juniorAcc_collapseTwo" aria-expanded="false"
                                                                aria-controls="juniorAcc_collapseTwo">
                                                            Footwear

                                                        </button>
                                                    </div>
                                                    <div id="juniorAcc_collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                                         data-parent="#juniorAcc">
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>UK</th>
                                                                        <th>CHEST</th>
                                                                        <th>WAIST</th>
                                                                        <th>HIP</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>XS</td>
                                                                        <td>31-33"</td>
                                                                        <td>27-29"</td>
                                                                        <td>32-34"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>S</td>
                                                                        <td>34-37"</td>
                                                                        <td>30-32"</td>
                                                                        <td>35-37"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>M</td>
                                                                        <td>37-40"</td>
                                                                        <td>32-35"</td>
                                                                        <td>37-40"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>L</td>
                                                                        <td>40-44"</td>
                                                                        <td>35-39"</td>
                                                                        <td>40-44"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>XL</td>
                                                                        <td>44-48"</td>
                                                                        <td>39-43"</td>
                                                                        <td>44-48"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>2XL</td>
                                                                        <td>48-52"</td>
                                                                        <td>43-47"</td>
                                                                        <td>48-51"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>3XL</td>
                                                                        <td>43-58"</td>
                                                                        <td>48-53"</td>
                                                                        <td>51-56"</td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">

                                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                                                data-target="#juniorAcc_collapseThree" aria-expanded="false"
                                                                aria-controls="juniorAcc_collapseThree">
                                                            Accessories

                                                        </button>
                                                    </div>
                                                    <div id="juniorAcc_collapseThree" class="collapse" data-parent="#juniorAcc">
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>UK</th>
                                                                        <th>CHEST</th>
                                                                        <th>WAIST</th>
                                                                        <th>HIP</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td>XS</td>
                                                                        <td>31-33"</td>
                                                                        <td>27-29"</td>
                                                                        <td>32-34"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>S</td>
                                                                        <td>34-37"</td>
                                                                        <td>30-32"</td>
                                                                        <td>35-37"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>M</td>
                                                                        <td>37-40"</td>
                                                                        <td>32-35"</td>
                                                                        <td>37-40"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>L</td>
                                                                        <td>40-44"</td>
                                                                        <td>35-39"</td>
                                                                        <td>40-44"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>XL</td>
                                                                        <td>44-48"</td>
                                                                        <td>39-43"</td>
                                                                        <td>44-48"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>2XL</td>
                                                                        <td>48-52"</td>
                                                                        <td>43-47"</td>
                                                                        <td>48-51"</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>3XL</td>
                                                                        <td>43-58"</td>
                                                                        <td>48-53"</td>
                                                                        <td>51-56"</td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            

            <div class="product-description">
                <h6 class="des-tab"><!--Product--> Description</h6>
                <p>{!! $product->product_description !!}</p>
            </div>

            <div class="product-info">

                <div class="">
                    <div class="infoIcon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M23.5 31H26.5C29.5 31 31 29.5 31 26.5V23.5C31 20.5 29.5 19 26.5 19H23.5C20.5 19 19 20.5 19 23.5V26.5C19 29.5 20.5 31 23.5 31ZM5.5 31H8.5C11.5 31 13 29.5 13 26.5V23.5C13 20.5 11.5 19 8.5 19H5.5C2.5 19 1 20.5 1 23.5V26.5C1 29.5 2.5 31 5.5 31ZM25 13C26.5913 13 28.1174 12.3679 29.2426 11.2426C30.3679 10.1174 31 8.5913 31 7C31 5.4087 30.3679 3.88258 29.2426 2.75736C28.1174 1.63214 26.5913 1 25 1C23.4087 1 21.8826 1.63214 20.7574 2.75736C19.6321 3.88258 19 5.4087 19 7C19 8.5913 19.6321 10.1174 20.7574 11.2426C21.8826 12.3679 23.4087 13 25 13Z" stroke="#00A9EC" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8.5 13H5.5C2.5 13 1 11.5 1 8.5V5.5C1 2.5 2.5 1 5.5 1H8.5C11.5 1 13 2.5 13 5.5V8.5C13 11.5 11.5 13 8.5 13Z" stroke="#00A9EC" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <p><span>Category</span>
                        @if(isset($product->shop_category))
                        <a href="{{route('product.category',['slug'=>$product->shop_category->shop_cat_slug])}}">
                            {{ $product->shop_category->shop_cat_name }}</a>
                        @endif
                    </p>
                </div>

                <div class="">
                    <div class="infoIcon">
                        <svg width="46" height="45" viewBox="0 0 46 45" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.0683 0.168119C21.7759 0.261665 20.934 0.764475 20.1973 1.29067C17.8821 2.9628 18.3615 2.78741 16.1398 2.78741C13.9064 2.78741 13.2516 2.91603 12.3863 3.50069C11.4976 4.10874 11.1468 4.68171 10.4569 6.7748C10.1061 7.8155 9.75528 8.73927 9.67343 8.84451C9.59158 8.93805 8.84321 9.53441 8.00129 10.1542C6.21223 11.4989 6.06022 11.6392 5.65095 12.5396C5.14814 13.6387 5.19492 14.3637 5.95498 16.7258L6.57472 18.6902L5.95498 20.5845C5.48725 22.0111 5.33523 22.6659 5.33523 23.1921C5.32354 24.6655 5.83804 25.5775 7.31139 26.665L8.29363 27.39L4.61025 31.0851C-0.265829 35.9728 -0.254136 35.587 4.37639 37.3877L7.2997 38.5337L8.43394 41.4453C9.69682 44.6609 9.83713 44.8831 10.6674 44.8831C11.1468 44.8831 11.1702 44.848 15.6136 40.428L20.0804 35.9728L20.8639 36.5107C21.7642 37.1188 22.3489 37.3176 23.261 37.3176C24.1731 37.3176 24.7577 37.1188 25.6581 36.5107L26.4415 35.9728L30.9084 40.428C35.3518 44.848 35.3752 44.8831 35.8546 44.8831C36.6848 44.8831 36.8251 44.6609 38.088 41.4453L39.2223 38.5453L42.1456 37.3994C45.3261 36.1482 45.5951 35.9845 45.5951 35.2011C45.5951 34.8035 45.3963 34.5813 41.9117 31.0851L38.2283 27.39L39.2106 26.665C40.6605 25.5892 41.1867 24.6889 41.1984 23.2506C41.1984 22.7829 41.0347 22.0813 40.5787 20.643L39.9472 18.6785L40.567 16.7258C41.327 14.3637 41.3738 13.6387 40.871 12.5396C40.4617 11.6392 40.3097 11.4989 38.5207 10.1542C37.6904 9.53441 36.9304 8.93805 36.8485 8.84451C36.7667 8.73927 36.4159 7.8155 36.0651 6.7748C35.3986 4.77526 35.001 4.06197 34.2643 3.55916C33.3406 2.92772 33.0599 2.85757 30.6043 2.7991C28.5112 2.72894 28.2774 2.70555 27.9734 2.48338C25.9153 0.96326 24.9214 0.308438 24.4069 0.156426C23.6702 -0.0540526 22.7932 -0.0540526 22.0683 0.168119ZM24.021 2.53015C24.2198 2.64709 24.9916 3.20836 25.7633 3.75795C27.529 5.0559 27.7629 5.12605 30.2418 5.12605C32.2531 5.12605 32.6974 5.20791 33.1184 5.67564C33.2353 5.80426 33.6095 6.76311 33.9486 7.80381C34.2994 8.84451 34.7321 9.90859 34.9075 10.1658C35.0945 10.4348 35.9248 11.1481 36.8836 11.8497C38.4388 12.9956 38.7078 13.2646 38.8715 13.8492C38.9065 13.9895 38.6844 14.8899 38.3219 16.0125C37.515 18.5616 37.515 18.8422 38.3219 21.2978C39.1872 23.8937 39.2573 23.7183 36.4743 25.788C35.6792 26.3727 35.1179 26.8989 34.8724 27.2614C34.6619 27.5771 34.2643 28.5476 33.9486 29.4831C33.3289 31.4008 33.1769 31.7282 32.8144 31.927C32.6507 32.0322 31.8087 32.1024 30.3354 32.1491C28.6866 32.1959 27.9851 32.2661 27.5992 32.4064C27.3185 32.5233 26.3948 33.108 25.5412 33.716C23.869 34.9204 23.4715 35.1075 22.9102 34.9438C22.7114 34.8854 21.8461 34.3358 20.9925 33.7277C20.1389 33.108 19.2151 32.5233 18.9228 32.4181C18.5369 32.2661 17.847 32.1959 16.1866 32.1491C14.7132 32.1024 13.8713 32.0322 13.7076 31.927C13.3451 31.7282 13.158 31.3306 12.5617 29.4597C11.8835 27.3549 11.5911 26.934 10.0476 25.788C7.25293 23.7066 7.33478 23.9054 8.18839 21.3212C9.01861 18.8422 9.01861 18.5733 8.20008 16.0125C7.83759 14.8899 7.61542 13.9895 7.6505 13.8492C7.8142 13.2646 8.08315 12.9956 9.63835 11.8497C10.5738 11.1715 11.4274 10.4348 11.6028 10.1775C11.7782 9.93198 12.2109 8.86789 12.5617 7.8155C12.9125 6.7748 13.2983 5.80426 13.4036 5.67564C13.8245 5.20791 14.2689 5.12605 16.2801 5.12605C18.7591 5.12605 19.0046 5.0559 20.7703 3.75795C21.5304 3.20836 22.3138 2.65878 22.5009 2.53015C22.9453 2.26121 23.5767 2.26121 24.021 2.53015ZM10.3984 30.4069C10.9246 32.1258 11.3456 32.956 12.0004 33.5289C12.9008 34.3241 13.4854 34.4761 15.7539 34.4761C16.8297 34.4761 17.7652 34.5229 17.847 34.5696C17.9406 34.6281 16.8414 35.8208 14.5027 38.1478L11.0182 41.6324L10.3633 39.9485C10.0008 39.0365 9.61496 38.0192 9.49803 37.7034C9.3811 37.3994 9.18231 37.0252 9.05369 36.8849C8.91337 36.7329 7.8142 36.2301 6.49287 35.7039L4.1776 34.8035L7.01906 31.9504C8.58596 30.3835 9.8956 29.0972 9.94237 29.0972C9.97745 29.0972 10.1879 29.6936 10.3984 30.4069ZM39.5029 31.9504L42.3444 34.8035L40.0525 35.7039C38.7896 36.195 37.6554 36.6861 37.5267 36.7914C37.3396 36.9551 36.9772 37.8321 35.5623 41.4687C35.5272 41.5739 34.2176 40.3461 32.0192 38.1478C29.6806 35.8208 28.5814 34.6281 28.675 34.5696C28.7568 34.5229 29.6923 34.4761 30.768 34.4761C33.0365 34.4761 33.6212 34.3241 34.5216 33.5289C35.1764 32.956 35.5974 32.1258 36.1235 30.4069C36.334 29.6936 36.5445 29.0972 36.5796 29.0972C36.6264 29.0972 37.936 30.3835 39.5029 31.9504Z" fill="#00A9EC"/>
                            <path d="M22.5711 8.58723C22.3957 8.71586 21.8344 9.74487 21.0743 11.3118C20.4078 12.6916 19.8349 13.8492 19.8115 13.8843C19.7764 13.9077 18.4551 14.1181 16.8765 14.3637L13.9882 14.7847L13.6491 15.1822C13.006 15.8838 13.1346 16.0943 15.5317 18.5148L17.6248 20.6196L17.1454 23.426C16.8414 25.1916 16.7011 26.3493 16.7478 26.5598C16.8414 26.9222 17.4377 27.3432 17.8587 27.3432C18.0107 27.3432 19.2853 26.7352 20.7002 25.9868L23.261 24.6421L25.8218 25.9868C27.2367 26.7352 28.5112 27.3432 28.6633 27.3432C29.0842 27.3432 29.6806 26.9222 29.7741 26.5598C29.8209 26.3493 29.6806 25.1916 29.3765 23.426L28.8971 20.6196L30.9902 18.5148C33.1769 16.3048 33.3756 16.0241 33.0599 15.4278C32.7442 14.8431 32.4402 14.7379 29.7507 14.3637C28.3358 14.1649 27.073 13.9895 26.9327 13.9544C26.7573 13.9194 26.3948 13.2879 25.4827 11.3702C24.7577 9.88518 24.1497 8.75094 23.9743 8.62231C23.6352 8.35337 22.9453 8.32998 22.5711 8.58723ZM24.1964 14.0246C24.6642 14.9951 25.167 15.8604 25.3073 15.954C25.4359 16.0358 26.4065 16.2463 27.4589 16.3983C28.4996 16.5503 29.3882 16.7023 29.4116 16.7374C29.4467 16.7608 28.8504 17.3572 28.102 18.0588C27.3536 18.7604 26.6637 19.497 26.5819 19.6958C26.4532 20.0115 26.4766 20.3039 26.769 21.976C26.9444 23.0284 27.0847 23.9171 27.0613 23.9288C27.0379 23.9522 26.2545 23.578 25.3307 23.0869C24.2432 22.5139 23.5065 22.1982 23.2727 22.1982C23.0271 22.1982 22.2904 22.5139 21.203 23.0869C20.2675 23.578 19.4841 23.9639 19.4607 23.9405C19.4373 23.9171 19.5776 23.0284 19.753 21.976C20.0453 20.3156 20.0687 20.0115 19.9401 19.6958C19.8582 19.497 19.18 18.7604 18.42 18.0588C17.6716 17.3572 17.0753 16.7608 17.1103 16.7374C17.1337 16.714 18.0107 16.562 19.0631 16.3983C20.1155 16.2463 21.086 16.0358 21.2264 15.954C21.355 15.8604 21.8578 14.9951 22.3255 14.0246C22.8049 13.0541 23.2259 12.2589 23.261 12.2589C23.2961 12.2589 23.717 13.0541 24.1964 14.0246Z" fill="#00A9EC"/>
                        </svg>
                    </div>
                    <p><span>Brand</span>
                        @php 
                            $brandNameCheck = "";    
                        @endphp 
                        @if(isset($product->shop_category))
                        <a href="{{route('product.category',['slug'=>$product->shop_category->shop_cat_slug])}}">
                           
                            @if($product->brand_id > 0)
                                @if(isset($product->getBrand)) 
                                {{ $product->getBrand->brand_name }}
                                    @php 
                                        $brandNameCheck = $product->getBrand->brand_name;    
                                    @endphp 
                                @endif
                            @endif

                            {{-- {{ $product->brand_id > 0 ? $product->getBrand->brand_name : ''}} --}}
                        </a>
                        @endif
                    </p>

                </div>

                <div class="sold_by">
                    <div class="infoIcon">
                        <svg width="34" height="42" viewBox="0 0 34 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.6148 0.5813C12.6103 1.12904 10.1616 3.40055 9.38027 6.37285C9.18695 7.08974 9.16279 7.36361 9.12251 8.92628L9.09029 10.6823H6.3677C4.63588 10.6823 3.55651 10.7145 3.41152 10.7709C3.13765 10.8675 2.76712 11.2139 2.62213 11.4878C2.56574 11.6005 2.49325 11.8502 2.46908 12.0516C2.43686 12.253 1.8569 18.6809 1.16417 26.3492C-0.205178 41.6457 -0.156848 40.6952 0.358672 41.2188C0.858082 41.7262 -0.350169 41.694 17.0003 41.694C30.1541 41.694 32.917 41.6779 33.1345 41.5812C33.4969 41.4282 33.9078 40.9852 33.9964 40.6388C34.1091 40.22 31.5718 11.8583 31.3946 11.5119C31.2335 11.2139 30.871 10.8756 30.5891 10.7709C30.4441 10.7145 29.3647 10.6823 27.6329 10.6823H24.9103L24.8781 8.92628C24.8378 7.36361 24.8137 7.08974 24.6203 6.37285C23.5651 2.39368 19.6262 -0.14365 15.6148 0.5813ZM18.2488 3.59387C19.9726 4.0369 21.3742 5.47069 21.785 7.21862C21.8736 7.58915 21.9139 8.17716 21.9139 9.2082V10.6823H17.0003H12.0868V9.2082C12.0868 7.52471 12.1754 7.01725 12.6345 6.09092C13.005 5.33375 13.8347 4.46381 14.5919 4.04495C15.6712 3.44888 17.0245 3.27973 18.2488 3.59387ZM9.12251 15.2172C9.14668 16.7074 9.15473 16.788 9.34 17.0618C10.0247 18.0606 11.4343 17.9479 11.9337 16.8443C12.0626 16.5705 12.0868 16.3047 12.0868 15.0884V13.6626H17.0003H21.9139V15.0884C21.9139 16.3047 21.938 16.5705 22.0669 16.8443C22.5663 17.9479 23.9759 18.0606 24.6606 17.0618C24.8459 16.788 24.8539 16.7074 24.8781 15.2172L24.9103 13.6626L26.8113 13.6787L28.7203 13.7029L29.8239 25.9868C30.428 32.7449 30.9274 38.3673 30.9355 38.4881V38.7137H17.0003C9.33194 38.7137 3.06515 38.6895 3.0571 38.6492C3.0571 38.617 3.55651 32.9866 4.16869 26.1318L5.28028 13.6626H7.18931H9.09029L9.12251 15.2172Z" fill="#00A9EC"/>
                        </svg>
                    </div>
                    <p><span>Sold By </span><a href="#">The Marketplace</a></p>
                </div>
                <div class="">
                    <div class="infoIcon">
                        <svg width="37" height="40" viewBox="0 0 37 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.36719 0.252397C7.18903 0.430563 7.12964 2.46958 7.12964 8.17089V15.8518H4.99164C3.58611 15.8518 2.77447 15.931 2.6161 16.0894C2.43793 16.2676 2.37854 18.4649 2.37854 24.7997V33.2725H1.42832C-0.0761931 33.2725 -0.293952 33.7872 0.319732 35.846C0.557287 36.6181 0.893823 37.1526 1.66588 37.9444C3.40795 39.6667 2.75467 39.6073 18.2155 39.6073C33.6764 39.6073 33.0231 39.6667 34.7652 37.9444C35.5372 37.1526 35.8738 36.6181 36.1113 35.846C36.725 33.7872 36.5073 33.2725 35.0027 33.2725H34.0525V24.7997C34.0525 18.4649 33.9931 16.2676 33.815 16.0894C33.6566 15.931 32.845 15.8518 31.4394 15.8518H29.3014V8.17089C29.3014 2.46958 29.242 0.430563 29.0639 0.252397C28.7273 -0.0841391 7.70373 -0.0841391 7.36719 0.252397ZM14.2563 6.11208C14.2563 11.8134 14.2563 11.8134 16.7506 10.0911L18.2155 9.08152L19.6805 10.0911C22.1748 11.8134 22.1748 11.8134 22.1748 6.11208V1.59854H24.9463H27.7177V10.3089V19.0192H18.2155H8.71334V10.3089V1.59854H11.4848H14.2563V6.11208ZM20.5911 5.18166C20.5911 7.97293 20.5317 8.72519 20.3535 8.60641C20.215 8.50743 19.7398 8.19069 19.3241 7.89375C18.3541 7.20088 18.077 7.20088 17.1069 7.89375C16.6912 8.19069 16.2161 8.50743 16.0973 8.60641C15.8994 8.72519 15.84 7.97293 15.84 5.18166V1.59854H18.2155H20.5911V5.18166ZM7.12964 18.7817C7.12964 19.5735 7.22862 20.2268 7.36719 20.3654C7.70373 20.7019 28.7273 20.7019 29.0639 20.3654C29.2024 20.2268 29.3014 19.5735 29.3014 18.7817V17.4355H30.8851H32.4688V25.354V33.2725H27.9553C23.1052 33.2725 22.9666 33.2923 22.9666 34.3019V34.8562H18.2155H13.4644V34.3019C13.4644 33.2923 13.3259 33.2725 8.47578 33.2725H3.96224V25.354V17.4355H5.54594H7.12964V18.7817ZM11.8807 35.4105C11.8807 35.7075 11.9797 36.0638 12.1183 36.2024C12.4548 36.5389 23.9762 36.5389 24.3128 36.2024C24.4513 36.0638 24.5503 35.7075 24.5503 35.4105V34.8562H29.5984C34.2901 34.8562 34.6464 34.876 34.6464 35.2126C34.6464 35.7669 33.7358 36.9546 32.9241 37.4495L32.1719 37.9246H18.3145C5.05103 37.9246 4.41755 37.9049 3.68509 37.5485C2.87345 37.1328 1.78465 35.8262 1.78465 35.2126C1.78465 34.876 2.0618 34.8562 6.83269 34.8562H11.8807V35.4105Z" fill="#00A9EC"/>
                            <path d="M17.6612 22.5232C16.9684 23.1368 14.2563 26.6804 14.2563 26.9773C14.2563 27.4128 14.672 27.7296 15.2857 27.7296H15.84V30.2635C15.84 31.966 15.9192 32.8766 16.0775 33.035C16.3943 33.3517 20.0368 33.3517 20.3535 33.035C20.5119 32.8766 20.5911 31.966 20.5911 30.2635V27.7296H21.1454C21.7591 27.7296 22.1748 27.4128 22.1748 26.9773C22.1748 26.8189 21.5017 25.8291 20.6703 24.7799C19.146 22.8795 18.5125 22.1866 18.2155 22.1866C18.1363 22.1866 17.879 22.345 17.6612 22.5232ZM18.9678 25.1957C19.5419 25.9281 19.5617 26.0469 19.3043 26.3438C19.0668 26.6012 19.0074 27.2347 19.0074 29.1747V31.6888H18.2155H17.4237V29.1747C17.4237 27.2347 17.3643 26.6012 17.1267 26.3438C16.8694 26.0469 16.8892 25.9281 17.4633 25.1957C17.8196 24.7403 18.1561 24.3642 18.2155 24.3642C18.2749 24.3642 18.6115 24.7403 18.9678 25.1957Z" fill="#00A9EC"/>
                        </svg>
                    </div>
                    <p><span>SKU </span> <span class="skNumber"><?php if(is_null($product->sku)) echo ''; else echo $product->sku;?><span> </p>
                </div>
            </div>

            

            <div class="related-products">
                <h5 class="heading-5">Related Products</h5>
                @if(!$related_products->isEmpty())
                    <div class="mb-3 owl-carousel owl-theme product-slider" id="slider-men-new">
                        @foreach($related_products as $product)
                               @php  $productOutOfStock = checkProductIsOutOfStok($product->id); @endphp
                            <div class="card product-card {{ $productOutOfStock < 1 ?'out_of_stock_product':''}} ">
                                <div class="card-header">
                                    <a href="{{ route('single-product', ['id' => $product->id]) }}" class="d-block">
                                        <div class="img-box">
                                            <img data-src="{{ $product->image_url }}" class="img-fluid lazy ">
                                        </div>
                                        <div class="tags">
                                            @if((int)$product->discount>0)
                                                <span class="discount-tag">  -{{ $product->discount }}% </span>
                                            @endif
                                            <span class="new-tag">New</span>
                                        </div>

                                    </a>
                                </div>
                                <div class="card-body" style="text-align:center;">
                                    <div class="product-category" >

                                        {{--   <a href="{{route('product.category',['slug'=>$product->shop_category->shop_cat_slug])}}">
                                               {{ $product->shop_category->shop_cat_name }}</a> --}}
                                    </div>
                                    <div class="brand-name">@if(isset($product->brand)){{ $product->brand->brand_name }}@endif</div>
                                    <a href="{{ route('single-product', ['id' => $product->id]) }}"
                                       class="product-title">{{ $product->product_name }}</a>
                                    @if((int)$product->sale_price > 0 && (int)$product->regular_price > $product->sale_price)
                                        <span class="real-price">£{{number_format($product->regular_price,2) }}</span>
                                        <span class="discounted-price">£{{number_format($product->sale_price,2) }}</span>
                                    @else
                                        <span class="discounted-price">£{{number_format($product->regular_price,2) }}</span>
                                    @endif


                                </div>
                            </div>


                        @endforeach
                        @endif
                    </div>
                    <div class="slider_nav">
                        <div class="slider-counter"></div>
                    </div>
            </div>

            

        </div>
        <div class="recently-viewed-products">
            <div class="container">
            <h5 class="heading-5">recently viewed products</h5>

            <div class="mb-3 owl-carousel owl-theme product-slider product-slider1" id="slider-men-new">
                @foreach($recent_view_products as $product)
                        @php  $productOutOfStock = checkProductIsOutOfStok($product->id); @endphp
                    <div class="card product-card {{ $productOutOfStock < 1 ?'out_of_stock_product':''}}">
                        <div class="card-header">
                            <a href="{{ route('single-product', ['id' => $product->id]) }}" class="d-block">
                                <div class="img-box">
                                    <img data-src="{{ $product->image_url }}" class="img-fluid lazy ">
                                </div>
                                <div class="tags">
                                    @if((int)$product->discount>0)
                                        <span class="discount-tag">  -{{ $product->discount }}% </span>
                                    @endif
                                    <span class="new-tag">New</span>
                                </div>

                            </a>
                        </div>
                        <div class="card-body" style="text-align:center;">
                            <div class="product-category">

                                {{--   <a href="{{route('product.category',['slug'=>$product->shop_category->shop_cat_slug])}}">
                                       {{ $product->shop_category->shop_cat_name }}</a> --}}
                                
                            </div>
                            <div class="brand-name">@if(isset($product->brand)){{ $product->brand->brand_name }}@endif</div>
                            <a href="{{ route('single-product', ['id' => $product->id]) }}"
                               class="product-title">{{ $product->product_name }}</a>
                            @if((int)$product->sale_price > 0 && (int)$product->regular_price > $product->sale_price)
                                <span class="real-price">£{{number_format($product->regular_price,2) }}</span>
                                <span class="discounted-price">£{{number_format($product->sale_price,2) }}</span>
                            @else

                                <span class="discounted-price">£{{number_format($product->regular_price,2) }}</span>

                            @endif


                        </div>
                    </div>


                @endforeach

            </div>
            <div class="slider_nav">
                <div id="counterindex1"></div>
            </div>

            <div class="alert alert-dismissible fade" role="alert" style="text-align:center;">
                <button id="error_model" type="button" class="close buttonAlert" data-dismiss="alert" aria-label="Close" onclick="closeup();">
                    <i class="uil uil-multiply"></i>
                </button>
                <p style="display: contents;"></p>
            </div>


            <div class="alert alert-dismissible1 fade" role="alert" style="text-align:center;">
                <button id="error_model" type="button" class="close buttonAlert" data-dismiss="alert" aria-label="Close" onclick="closeup();">
                    <i class="uil uil-multiply"></i>
                </button>
                <p style="display: contents;"></p>
            </div>
            </div>
        </div>
    </main>
    

{{-- <a href="#" class="btn btn-lg btn-success" data-toggle="modal" data-target="#comparebasicModal">Click to open Modal</a> --}}
<!-- basic modal -->
<div class="modal fade" id="comparebasicModal" tabindex="-1" role="dialog" aria-labelledby="comparebasicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header compare_product-sec1">
          <h1 class="modal-title" id="myModalLabel">Compare Products</h1>  
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="fa fa-times"></span>
            </button>       
        </div>
        <div class="modal-body compare_model_html">
        </div>
      </div>
    </div>
  </div>
<!-- basic modal -->

@endsection

@section('extra-css')
    <div class="fixed-buttons">
        <a href="#header" class="btn white-btn go-top"><i class="fas fa-caret-up"></i></a>

        <a href="javascript:void(0)" class="btn blue-btn buy_used"
           style="border-left: 1px solid #25252d;">buy Pre-Loved </a>
        <a href="javascript:void(0)" class="btn blue-btn buy_new">buy
            new</a>
    </div>
@endsection
@section('scripts')
            
    <script>
        $(document).ready(function () {   
        var brand_name_get = "{{$brandNameCheck}}";
        if(brand_name_get == "Cartier"){
                $(".buy_used").css({'pointer-events':'none','background':'#e8e8e8','border':'#e8e8e8','color':'#c1c1c1'});
                $("#used-product").css({'pointer-events':'none'});
        }

            let cancel = {{$cancel}};

            if (cancel == 1) {
                $(".sold_by").hide();
                $('.single-product').hide();
                $('.product-layout').show();
                $('.product-details-column').addClass('column-details-fixed');
                $('#new-product').removeClass('active');
                $('#used-product').addClass('active');
                $('#pills-new-product').removeClass('show active');
                $('#pills-used-product').addClass('show active');
                $('#pills-used-product.product-pills-slider').owlCarousel('refresh');
            }

            if ($('.pills-general').hasClass('active') == true) {

                let size_id = $('.pills-general.active').attr('data-size_id');
                let product_id = $('.pills-general.active').attr('data-product_id');
                let flags = $('.pills-general.active').attr('data-flags');
                $.ajax({
                    url: "{{ route('ProductNew') }}",
                    method: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        product_id: product_id,
                        size_id: size_id,
                        flags: flags,
                    },
                    success: function (result) {


                        $('.product-sizes').owlCarousel(
                            {items: 5,}
                        );

                        $('#product-size-1').html(result);


                    }
                });
            }

            if ($('.pills-link-used-product').hasClass('active') == true) {

                let size_id = $('.pills-link-used-product.active').attr('data-size_id');
                let product_id = $('.pills-link-used-product.active').attr('data-product_id');
                let flags = $('.pills-link-used-product.active').attr('data-flags');

                $.ajax({
                    url: "{{ route('ProductNew') }}",
                    method: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        product_id: product_id,
                        size_id: size_id,
                        flags: flags,
                    },
                    success: function (result) {


                        $('#used-product-size-1').html(result);

                    }
                });
            }

            $('#close_button_model').click(function () {
                $('#sizeGuide_Modal').modal('hide');
            });

            $('.buy_new').on('click', function (e) {
                $(".sold_by").hide();
                $('.single-product').hide();
                $('.product-layout').show();
                $('.product-details-column').addClass('column-details-fixed');
                $('#new-product').addClass('active');
                $('#used-product').removeClass('active');
                $('#pills-new-product').addClass('show active');
                $('#pills-used-product').removeClass('show active');
                $('#pills-new-product.product-pills-slider').owlCarousel('refresh');


            });

            $('.buy_used').on('click', function (e) {
                $(".sold_by").hide();
                $('.single-product').hide();
                $('.product-layout').show();
                $('.product-details-column').addClass('column-details-fixed');
                $('#new-product').removeClass('active');
                $('#used-product').addClass('active');
                $('#pills-new-product').removeClass('show active');
                $('#pills-used-product').addClass('show active');
                $('#pills-used-product.product-pills-slider').owlCarousel('refresh');

            });

            $('.product-details-column .cross-times').on('click', function () {
                $('.product-layout').hide();
                $('.product-details-column').removeClass('column-details-fixed');
                $('.single-product').show();
            });

            $('#error_model').click(function () {
                $('.alert-dismissible').modal('hide');
            });

            $('.pills-link-admin').on('click', function () {

                $('.pills-link-admin').removeClass('active');
                $(this).addClass('active');
                $('#product_size').val($(this).data('size_id'));
                $('#addToCart').prop('disabled', false);
                $("#addToCart").css({"background-color":"#00a9ec", "color":"#fff"});
            });


            $('#addToCart').on('click', function (e) {

                let quantity = $('#number').val();
                product_id = $('#product_id').val();
                let size_id = $('.pills-link-admin.pills-link.active').data('size_id');
                let variation = $('.pills-link-admin.pills-link.active').data('variation_id');
                addToCartFun(quantity,product_id,size_id,variation);
            });



            $('.pills-link-new-product').on('click', function () {
                $('.pills-link-new-product').removeClass('active');
                $(this).addClass('active');
                size_id = $(this).data('size_id');
                product_id = $(this).data('product_id');
                flags = $(this).data('flags');

                $.ajax({
                    url: "{{ route('ProductNew') }}",
                    method: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        product_id: product_id,
                        size_id: size_id,
                        flags: flags,
                    },
                    success: function (result) {
                        $('#product-size-1').html(result);
                    }
                });
            });

            $('.pills-link-used-product').on('click', function () {

                $('.pills-link-used-product').removeClass('active');
                $(this).addClass('active');

                size_id = $(this).data('size_id');
                product_id = $(this).data('product_id');

                $.ajax({
                    url: "{{ route('ProductNew') }}",
                    method: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        product_id: product_id,
                        size_id: size_id,
                        flags: 2,
                    },
                    success: function (result) {

                        $('#used-product-size-1').html(result);
                    }
                });
            });

            $('#addWishlist').on('click', function (e) {
                let authid = "{{isset(auth()->user()->id)}}";
                let product_id = $('#product_id').val();
                let size_id = $('.pills-link-admin.pills-link.active').data('size_id');
                if(authid > 0 && typeof(size_id) !='undefined'){
                    if($(this).hasClass('red-heart')){
                        $("#addWishlist").html('<i class="fa uil-heart-alt"></i>');
                        $(this).removeClass('red-heart');
                        $(this).addClass('white-heart');
                    }else{
                        $(this).removeClass('white-heart');
                        $(this).addClass('red-heart');
                        $("#addWishlist").html('<i class="fa fa-heart"></i>');                       
                    }
                }

                
                addWishlist(product_id,size_id);                
            });
            $(document).on('click','.addwishlistNewPreLoved',function(){
                let product_id = $(this).data('product_id');
                let size_id = $(this).data('size_id');
                let authid = "{{isset(auth()->user()->id)}}";
                if(authid > 0){
                    if($(this).hasClass('product_in_wishlist')){
                        $(this).removeClass('product_in_wishlist');
                        $(this).html('<i class="uil uil-heart"></i>');
                    }else{
                        $(this).addClass('product_in_wishlist');
                        $(this).html('<i class="fa fa-heart"></i>');
                    }
                }
                addWishlist(product_id,size_id);
            });
            $(document).on('click','.add_to_comper_btn', function (e) {
                let product_id = $('#product_id').val();
                let size_id = $('.pills-link-admin.pills-link.active').data('size_id');
                addToComper(product_id,size_id);                
            });
            $(document).on('click','.new_product_compayr_btn', function (e) {
                let comp_product_id = $(this).data('product_id');
                let comp_size_id = $(this).data('size_id');
                addToComper(comp_product_id,comp_size_id);                
            });
            // remove comper
            $(document).on('click','.compare_add_to_wishlist', function (e) {
                    let comp_product_id = $(this).data('product_id');
                    let comp_size_id = $(this).data('size_id');
                    let authid = "{{isset(auth()->user()->id)}}";
                    if(authid > 0){
                        if($(this).hasClass('product_in_wishlist')){
                            $(this).removeClass('product_in_wishlist');
                            $(this).html('<i class="uil uil-heart"></i>');
                        }else{
                            $(this).addClass('product_in_wishlist');
                            $(this).html('<i class="fa fa-heart"></i>');
                        }
                    }
                    addWishlist(comp_product_id,comp_size_id);
            });
            $(document).on('click','.compare_add_to_cart_btn', function (e) {
                    let comp_product_id = $(this).data('product_id');
                    let comp_size_id = $(this).data('size_id');
                    let variation_id = $(this).data('variation_id');
                    let quantity = 1;
                    addToCartFun(quantity,comp_product_id,comp_size_id,variation_id);
            });
            $(document).on('click','.remove_campare_product', function (e) {
                let compareidis = $(this).data('compare_id');
                $(`.remove_compare_${compareidis}`).remove();
                $.ajax({
                    url: "{{ route('user-remove-compare-product')}}",
                    method: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: compareidis,
                    },
                    success: function (result){   
                        $('.alert-dismissible1').addClass('success-alert');
                        $('.alert-dismissible1').addClass('show').find('p').html("Item deleted from Compare."); 
                        setTimeout(() => {
                            $('.alert-dismissible1').removeClass('show');
                        }, 1500);                  
                    }
                });           
            });
            // remove comper
        });

        function addToCartFun(quantity,product_id,size_id,variation){
            $.ajax({
                    url: "{{ route('admin_cart') }}",
                    method: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        quantity: quantity,
                        product_id: product_id,
                        size_id: size_id,
                        variation: variation,
                    },
                    success: function (result) {

                        if (result.status == "true") {

                            $('.alert-dismissible').addClass('success-alert');
                            $('.alert-dismissible').addClass('show').find('p').html("Product added to the cart");

                            parent.location.reload();

                        } else {

                            let lo = "<?php echo route('login.login'); ?>";

                            $('.alert-dismissible').addClass('success-alert');
                            $('.alert-dismissible').addClass('show').find('p').html('User must be logged in. Click <a style="color:#00A9EC !important;" href="' + lo + '">here </a> to sign in');
                        }
                    }
                });
        }

        function addWishlist(product_id,size_id){
            $.ajax({
                    url: "{{ route('user-wishlist') }}",
                    method: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        product_id: product_id,
                        size: size_id
                    },
                    success: function (result) {

                        let obj = JSON.parse(result);
                        let b = parseInt($(".wish").text());
                        if (obj.status == 'deleted') {
                            $(".wish").text(b - 1);
                        }
                        if (obj.status == 'added') {
                            $(".wish").text(b + 1);
                        }
                        if (obj.error) {
                            if (obj.error == "User must be logged in") {
                                $('.alert-dismissible').addClass('success-alert');
                                $('.alert-dismissible').addClass('show').find('p').html(obj.error);

                            } else {
                                $('.alert-dismissible1').addClass('success-alert');
                                $('.alert-dismissible1').addClass('show').find('p').html(obj.error);
                               // $("#addWishlist").html('<i class="fa fa-heart"></i>');
                               // $("#addWishlist fa-heart").css("color", "#e0e0e0"); 
                            }
                        }
                        if (obj.message) {
                            $('.alert-dismissible1').addClass('success-alert');
                            $('.alert-dismissible1').addClass('show').find('p').html(obj.message);
                            //$("#addWishlist").html('<i class="fa fa-heart"></i>');
                           // $("#addWishlist").css("color", "red");
                            //$('#addWishlist').find('.fa-heart').addClass('red-heart');
                           // $("#addWishlist .fa-heart").css("color", "red");
                            $('.nav-item .nav-button .wishlist-btn ').find('a').html('<span class = "badge">' + obj.message + '<span>');
                        }
                    }
                });
        }
        function addToComper(product_id,size_id){
            $.ajax({
                    url: "{{ route('user-add-compare-product')}}",
                    method: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        product_id: product_id,
                        size: size_id
                    },
                    success: function (result){
                        let obj = JSON.parse(result);
                        if (obj.error) {
                            if (obj.error == "User must be logged in") {
                                $('.alert-dismissible').addClass('success-alert');
                                $('.alert-dismissible').addClass('show').find('p').html(obj.error);
                            } else {
                                $('.alert-dismissible1').addClass('success-alert');
                                $('.alert-dismissible1').addClass('show').find('p').html(obj.error);
                            }
                        }
                        if (obj.message) {
                            $("#comparebasicModal").modal('show');
                            $(".compare_model_html").html(obj.compare_html);
                            //$('.alert-dismissible1').addClass('success-alert');
                            //$('.alert-dismissible1').addClass('show').find('p').html(obj.message);                            
                        }
                    }
                });
        }

        function closeup() {
            let login = '<?php echo route("login.login");  ?>';
            $(".alert-dismissible1").hide();
            parent.location.reload();
        }

        function wishlist(product_id, size_id) {
            $.ajax({
                url: "{{ route('user-wishlists') }}",
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    product_id: product_id,
                    size: size_id
                },
                success: function (result) {
                    let obj = JSON.parse(result);
                    if (obj.value == 1) {
                        $("#addWishlist").html('<i class="fa fa-heart"></i>');
                        //$("#addWishlist i").css("color", "red");                        
                        $("#addWishlist").removeClass('white-heart');
                        $("#addWishlist").addClass('red-heart');
                    } else {
                        $("#addWishlist").html('<i class="fa uil-heart-alt"></i>');
                        $("#addWishlist").removeClass('red-heart');
                        $("#addWishlist").addClass('white-heart');
                        //$("#addWishlist i").css("color", "#e0e0e0");
                    }
                }

            });
        }

        $(document).ready(function(){
            $(".product_is_wishlist").trigger("click"); 
        });
        $(document).ready(function(){
             if($('.by_new_wishlist').hasClass('product_is_wishlist_new')){
                    $("#new-product").trigger("click");
                    $(".product_is_wishlist_new").trigger("click");
             }
        })

    </script>
@endsection
