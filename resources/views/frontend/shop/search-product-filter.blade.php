<?php

use Illuminate\Support\Carbon;

?>

@extends('frontend.shop.product-master')

@section('products-content')
@if(!$products->isEmpty())
<script src="https://t-mp.co.uk/assets/js/jquery.js"></script>

<script>
    $(document).ready(function() {
        var totalProducts = @if(isset($totalProducts)) {{$totalProducts}}
        @else ''
        @endif;


        if (totalProducts > 0) {
            var total_record_count = document.querySelector('.total_record_count');
            total_record_count.textContent = totalProducts;
        }


        $('.load-more-btn').on('click', function() {
            var nextPage = parseInt($(this).data('page'));
            // Make an AJAX request to load more products
            var currentUrl = window.location.href;
            $.ajax({

                url: currentUrl,
                type: 'GET',
                data: {
                    page: nextPage
                }, // Include the page parameter
                success: function(response) {
                    // Update the product list with the new products
                    //  $('.product-list').append(response.products);

                    var htmlContent = '';

                    response.products.forEach(function(product) {

                        var brandName = product.brand_name;

                        var brandId = product.brand_id; // Assuming brands is the id of the brand


                        for (var property in product) {
                            if (product.hasOwnProperty(property)) {
                                // Log the property name and its value
                                console.log(property + ':', product[property]);
                            }
                        }

                        // Create Date objects
                        var datetime1 = new Date(product.created_at);
                        var datetime2 = new Date(); // Current date

                        // Calculate the difference in days
                        var diffInMilliseconds = Math.abs(datetime2 - datetime1);
                        var diffInDays = Math.ceil(diffInMilliseconds / (1000 * 60 * 60 * 24));

                        // Check if the product is out of stock
                        var productOutOfStock = checkProductIsOutOfStock(product.id);

                        var productlinkHref = "/product/" + product.id + "/" + product.brand.brand_slug + "/" + product.shop_category.shop_cat_slug + "/" + product.product_slug;

                        // Build the HTML content for each product
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
                            // Add product category HTML here if available in the API response
                            '</div>' +
                            '<div class="brand-name">' + brandName + '</div>' +
                            '<a href="' + productlinkHref + '" class="product-title">' + product.product_name + '</a>' +
                            (product.sale_price > 0 && product.regular_price > product.sale_price ?
                                '<span class="real-price">£' + number_format(product.regular_price, 2) + '</span>' +
                                '<span class="discounted-price">£' + number_format(product.sale_price, 2) + '</span>' :
                                '<span class="discounted-price">£' + number_format(product.regular_price, 2) + '</span>'
                            ) +
                            '</div>' +
                            '</div>';

                        // Append the HTML content to the product list
                        // $('.product-list').append(htmlContent);
                    });

                    // Assuming you have the following function in your JavaScript code
                    function isset(variable) {
                        return typeof variable !== 'undefined';
                    }

                    // Assuming you have the following function in your JavaScript code
                    function number_format(number, decimals) {
                        return number.toFixed(decimals);
                    }

                    // Assuming you have the following function in your JavaScript code
                    function checkProductIsOutOfStock(productId) {
                        // Implement the logic to check if the product is out of stock
                        // Return 1 if out of stock, 0 otherwise

                        return 1;
                    }

                    // Update the content of the .updated-content div
                    $('.products-wrapper').append(htmlContent);

                    var spanElement = document.querySelector('#totalProductShowing');

                    var total_showing_record = document.querySelector('.total_showing_record');

                    // Update the "Load More" button if there are more pages
                    if (response.hasMorePages) {
                        $('.load-more-btn').data('page', parseInt(response.currentPage) + 1);

                        total_showing_record.textContent = parseInt(response.currentPage) * 50;
                        // Check if the element exists
                        if (spanElement) {
                            // Replace the content with a new number, for example, 15
                            spanElement.textContent = parseInt(response.currentPage) * 50;
                        }

                    } else {
                        $('.load-more-section').html('<p>No more products</p>');
                    }
                },
                error: function(error) {
                    alert("failed");
                    console.error('Error loading more products:', error);
                }
            });
        });
    });
</script>
























<div class="container">
    <div class="products-wrapper">

        @foreach($products as $key=>$product)

        <?php



        // Creates DateTime objects
        $datetime1 = date_create($product->created_at);
        $datetime2 = date_create(Carbon::now());

        // Calculates the difference between DateTime objects
        $interval = date_diff($datetime1, $datetime2);

        // Printing result in years & months format
        $diff = (int)$interval->format('%a');

        $productOutOfStock = checkProductIsOutOfStok($product->id);

        // dd($product->created_at);
        ?>



        <div class="card product-card {{ $productOutOfStock < 1 ?'out_of_stock_product':''}} {{ (isset($_GET['in_stock']) && $productOutOfStock < 1)?'d-none':''}}">
            <div class="card-header">
                <a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="d-block">
                    <div class="img-box">
                        <img data-src="{{ $product->image_url }}" class="img-fluid lazy ">
                    </div>
                    <div class="tags">
                        @if((int)$product->discount>0)
                        <span class="discount-tag"> -{{ $product->discount }}% </span>
                        @endif

                        @if($diff <= 14) <span class="new-tag">New </span>
                            @endif
                    </div>

                    <>
            </div>
            <div class="card-body">
                <div class="product-category">

                    {{-- <a href="{{route('product.category',['slug'=>$product->shop_category->shop_cat_slug])}}">
                    {{ $product->shop_category->shop_cat_name }}</a> --}}
                    <a href="">
                    </a>
                </div>
                <div class="brand-name">@if(isset($product->brand)) {{ $product->brand->brand_name }} @endif</div>
                <a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                             $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}" class="product-title">{{ $product->product_name }}</a>
                @if((int)$product->sale_price > 0 && (int)$product->regular_price > $product->sale_price)
                <span class="real-price">£{{number_format($product->regular_price,2) }}</span>
                <span class="discounted-price">£{{number_format($product->sale_price,2) }}</span>
                @else

                <span class="discounted-price">£{{number_format($product->regular_price,2) }}</span>

                @endif


            </div>
        </div>

        @endforeach

        @else
        <section>
            <div class="row">
                <div class="col-md-12 text-center" style="margin-top:15%">
                    <p>No products were found matching your selection.</p>
                    <a href="{{route('shop_products')}}" class="back-to-shop no_djax btn btn-primary">Back to
                        shop</a>
                </div>
            </div>
        </section>
        @endif








    </div>







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


    @if(request()->routeIs('shop_products'))
    @endif








</div>






@endsection

















@section('scripts')
<script>
    $(document).ready(function() {

        $("#fil").click(function() {

            var slider1 = document.getElementById('slider-1');
            var slider2 = document.getElementById('slider-2');

            $.ajax({
                url: "{{ route('shop.price') }}",
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    min: slider1.value,
                    max: slider2.value
                },
                success: function(result) {
                    $(".result-count").html("Showing 1–" + result.selected + " of " + result
                        .count + " results");
                    $('.products-wrapper').html(result.html);
                    //console.log(result);
                    //$('.products-wrapper').html(result);
                    //result = JSON.parse(result)
                }
            });
        });


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
                    $(".result-count").html("Showing 1–" + result.selected + " of " + result
                        .count + " results");
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
                    $("#size").append(
                        '<option value="0" selected="">Please Select Size</option>');

                    for (j = 0; j < sz.length; j++) {
                        $("#size").append('<option  value="' + sz[j].id + '">' + sz[j]
                            .size + '</option>');
                    }

                    $(".result-count").html("Showing 1–" + result.selected + " of " + result
                        .count + " results");
                    $('.products-wrapper').html(result.html);


                }
            });
        });

        //product-filters
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
                    $(".result-count").html("Showing 1–" + result.selected + " of " + result
                        .count + " results");
                    $('.products-wrapper').html(result.html);

                    $("#categories").empty();
                    $("#categories").append(
                        '<option value="0" selected="">Select a category</option>');
                    var ca = JSON.parse(result.scat);

                    var sz = JSON.parse(result.sizes);

                    $("#size").empty();
                    $("#size").append(
                        '<option value="0" selected="">Please Select Size</option>');

                    for (j = 0; j < sz.length; j++) {
                        $("#size").append('<option  value="' + sz[j].id + '">' + sz[j]
                            .size + '</option>');
                    }

                    for (i = 0; i < ca.length; i++) {
                        if (ca[i].shop_cat_slug == categories) {
                            $("#categories").append('<option selected value="' + ca[i]
                                .shop_cat_slug + '">' + ca[i].shop_cat_name +
                                '</option>');
                        } else {
                            $("#categories").append('<option  value="' + ca[i]
                                .shop_cat_slug + '">' + ca[i].shop_cat_name +
                                '</option>');
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
                    $(".result-count").html("Showing 1–" + result.selected + " of " + result
                        .count + " results");
                    $('.products-wrapper').html(result.html);

                    $("#categories").empty();
                    $("#categories").append(
                        '<option value="0" selected="">Select a category</option>');
                    var ca = JSON.parse(result.scat);

                    var sz = JSON.parse(result.sizes);

                    $("#size").empty();
                    $("#size").append(
                        '<option value="0" selected="">Please Select Size</option>');

                    for (j = 0; j < sz.length; j++) {
                        $("#size").append('<option  value="' + sz[j].id + '">' + sz[j]
                            .size + '</option>');
                    }

                    for (i = 0; i < ca.length; i++) {

                        if (ca[i].shop_cat_slug == categories) {
                            $("#categories").append('<option selected value="' + ca[i]
                                .shop_cat_slug + '">' + ca[i].shop_cat_name +
                                '</option>');
                        } else {
                            $("#categories").append('<option value="' + ca[i]
                                .shop_cat_slug + '">' + ca[i].shop_cat_name +
                                '</option>');
                        }
                    }
                }
            });
        });

    });
</script>
@endsection