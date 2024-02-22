<?php

use Illuminate\Support\Carbon; ?>
@extends('frontend.shop.product-master')

@section('title','Shop')
@section('banner')

<script src="https://t-mp.co.uk/assets/js/jquery.js"></script>

<script>
    $(document).ready(function() {
        var totalProducts = "<?php echo isset($totalProducts) ? $totalProducts : ''; ?>"


        if (totalProducts > 0) {
            var total_record_count = document.querySelector('.total_record_count');
            total_record_count.textContent = totalProducts;
        }

        $('.load-more-btn').on('click', function() {
            var nextPage = parseInt($(this).data('page'));
            var gender = window.location.pathname.split('/')[2];
            var slug = window.location.pathname.split('/')[3];

            $.ajax({
                url: '/product_category_load_more',
                type: 'GET',
                data: {
                    page: nextPage,
                    gender: gender,
                    slug: slug,
                },
                success: function(response) {
                    var htmlContent = '';

                    response.products.forEach(function(product) {
                        var brandName = response.brandNames[product.brand_id] || '';
                        var datetime1 = new Date(product.created_at);
                        var datetime2 = new Date();
                        var diffInMilliseconds = Math.abs(datetime2 - datetime1);
                        var diffInDays = Math.ceil(diffInMilliseconds / (1000 * 60 * 60 * 24));
                        var productOutOfStock = checkProductIsOutOfStock(product.id);
                        console.log("productId" + product.id + "productName :" + brandName + " productCategory" + product.shop_category.shop_cat_slug + "productSlug" + product.product_slug);

                        var productlinkHref = "/product/" + product.id + "/" + brandName + "/" + product.shop_category.shop_cat_slug + "/" + product.product_slug;
                        // var productlinkHref = 'product/productName/brandSlug/productCategory/productSlug';
                        htmlContent += '<div class="card product-card ' + '">' +
                            '<div class="card-header">' +
                            '<a href="' + productlinkHref + '" class="d-block">' +
                            '<div class="img-box">' +
                            '<img src="' + product.image_url + '" class="img-fluid lazy">' +
                            '</div>' +
                            '<div class="tags">' +
                            (product.discount > 0 ? '<span class="discount-tag"> -' + product.discount + '% </span>' : '') +
                            (diffInDays <= 14 ? '<span class="new-tag">New </span>' : '') +
                            '</div>' +
                            '</a>' +
                            '</div>' +
                            '<div class="card-body">' +
                            '<div class="product-category">' +
                            '</div>' +
                            '<div class="brand-name">' + brandName + '</div>' +
                            '<a href="' + productlinkHref + '" class="product-title">' + product.product_name + '</a>' +
                            (product.sale_price > 0 && product.regular_price > product.sale_price ?
                                '<span class="real-price">£' + product.regular_price.toLocaleString('en-GB', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }) + '</span>' +
                                '<span class="discounted-price">£' + product.sale_price.toLocaleString('en-GB', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }) + '</span>' :
                                '<span class="discounted-price">£' + product.regular_price.toLocaleString('en-GB', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                }) + '</span>') +
                            '</div>' +
                            '</div>';
                    });

                    $('.products-wrapper').append(htmlContent);

                    var spanElement = document.querySelector('#totalProductShowing');
                    var total_showing_record = document.querySelector('.total_showing_record');

                    if (response.hasMorePages) {
                        $('.load-more-btn').data('page', parseInt(response.currentPage) + 1);
                        total_showing_record.textContent = parseInt(response.currentPage) * 50;

                        if (spanElement) {
                            spanElement.textContent = parseInt(response.currentPage) * 50;
                        }
                    } else {
                        $('.load-more-section').html('<p>No more products</p>');
                    }
                },
                error: function(error) {
                    console.error('Error loading more products:', error);
                }
            });
        });
    });

    function isset(variable) {
        return typeof variable !== 'undefined';
    }

    function number_format(number, decimals) {
        return number.toFixed(decimals);
    }

    function checkProductIsOutOfStock(productId) {
        return 1;
    }
</script>
















<div class="inner-banner">
    <h1 class="dark-heading">The Marketplace</h1>
    <h1 class="page-title">{{ $category_name ?? "" }}</h1>
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
@section('products-content')
@if(!$products->isEmpty())

<section>
    <div class="container">
        <div class="products-wrapper">
            @foreach($products as $product)
            @php
            // Creates DateTime objects
            $datetime1 = date_create($product->created_at);
            $datetime2 = date_create(Carbon::now());

            // Calculates the difference between DateTime objects
            $interval = date_diff($datetime1, $datetime2);

            // Printing result in years & months format
            $diff=(int)$interval->format('%a');

            $productOutOfStock = checkProductIsOutOfStok($product->id); @endphp
            <div class="card product-card {{ $productOutOfStock < 1 ?'out_of_stock_product':''}}">

                <div class="card-header">

                    <a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="d-block">
                        <div class="img-box">
                            <img data-src="{{ $product->image_url }}" class="img-fluid lazy ">
                        </div>
                        <div class="tags">
                            @if((int)$product->discount>0)
                            <span class="discount-tag">-{{ $product->discount }}%</span>
                            @endif
                            @if($diff<=14) <span class="new-tag">New</span>
                                @endif
                        </div>
                        {{-- <span class="out-of-stock">Out of Stock</span> --}}
                    </a>
                </div>
                <div class="card-body">
                    <div class="product-category">
                        {{-- <a href="{{route('product.category1',['slug'=>$product->shop_category->shop_cat_slug])}}">
                        {{ $product->shop_category->shop_cat_name }}</a> --}}
                    </div>
                    <div class="brand-name">@if(isset($product->brand)) {{ $product->brand->brand_name }} @endif</div>
                    <a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="product-title">{{ $product->product_name }}</a>
                    {{-- <span class="real-price">£{{ $product->regular_price }}</span>
                    <span class="discounted-price">£{{ $product->sale_price }}</span> --}}

                    @if((int)$product->sale_price > 0 && (int)$product->regular_price > $product->sale_price)
                    <span class="real-price">£{{number_format($product->regular_price ,2) }}</span>
                    <span class="discounted-price">£{{number_format($product->sale_price ,2) }} </span>
                    @else

                    <span class="discounted-price">£{{number_format($product->regular_price ,2) }}</span>

                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@else
<section>
    <div class="row">
        <div class="col-md-12 text-center" style="margin-top:15%">
            <p>No products were found matching your selection.</p>

            <a href="{{route('shop_products')}}" class="back-to-shop no_djax btn btn-primary">Back to shop</a>
        </div>
    </div>
</section>
@endif




@if($totalProducts)

<div class="load-more-section">
    <!-- This is where the "Load More" button will be placed -->
    @if($hasMorePages)

    <!--    <span style="margin: auto; padding: 5px 10px;
                               display: block;width: 250px;text-align: center;margin-top: 100px;"
                        >Showing 1 - <span id="totalProductShowing">50</span>  of {{$totalProducts}} </span> 
             -->

    <span class="load-more-btn" style="background: #00a9ec;margin: auto;color: white;padding: 5px 10px;
                                                       display: block;width: 150px;text-align: center;margin-top: 100px;cursor: pointer;" data-page="{{ (int)$currentPage + 1  }}">Load More </span>
    @else
    <p style="margin: auto; display: block;width: 150px;text-align: center;margin-top: 100px;">No more products</p>
    @endif


</div>
@endif







@endsection