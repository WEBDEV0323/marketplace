@extends('frontend.shop.product-master')
@php  $brandssa  = $brand->brand_name; @endphp
@section('title')
{{$brand->brand_name}} - The Marketplace
@endsection
@section('banner')

<div class="inner-banner">
    <h1 class="dark-heading">The Marketplace</h1>
    <h1 class="page-title">{{$brand->brand_name}}</h1>
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
@section('products-content')        
        @if(!$products->isEmpty())   
            <section>
                <div class="container">
                    <div class="products-wrapper">
                        @foreach($products as $product)
                            @php $productOutOfStock = checkProductIsOutOfStok($product->id); @endphp
                            <div class="card product-card {{ $productOutOfStock < 1 ?'out_of_stock_product':''}}">

                                <div class="card-header">

                                    <a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                                    $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}"
                                        class="d-block">
                                        <div class="img-box">
                                            <img data-src="{{ $product->image_url }}" class="img-fluid lazy ">
                                        </div>
                                        <div class="tags">
                                            <span class="discount-tag">-{{ $product->discount }}%</span>
                                            <span class="new-tag">New</span>
                                        </div>
                                        {{-- <span class="out-of-stock">Out of Stock</span> --}}
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="product-category">
                                    {{--   @forelse($product->prod_shop_cat as $cat)
                                            <a href="{{ $cat->shop_cat->shop_cat_slug }}">
                                                {{ $cat->shop_cat->shop_cat_name }}</a>
                                        @empty
                                            <a href="">No Categories</a>
                                        @endforelse --}}
                                    </div>
                                    <div class="brand-name">@if(isset($product->brand)) {{ $product->brand->brand_name }} @endif</div>
                                    <a href="{{ route('single-product', ['id' => $product->id,'brand' =>
                                    $product->brand->brand_slug,'category'=> $product->shop_category->shop_cat_slug,'product_slug'=>$product->product_slug]) }}"
                                        class="product-title">{{ $product->product_name }}</a>
                                    {{-- <span class="discounted-price">£{{ $product->sale_price }}</span>
                                    <span class="real-price">£{{ $product->regular_price }}</span> --}}
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
            <section>
                <div class="container">
                    <div id="product-list" class="products-wrapper mt-5">

                    </div>
                    <div class="load-more-section text-center">
                        <p id="end" style="margin-top: 50px; color:#00a9ec;"></p>
                        <button id="load-more-brand-btn" class="load-more-btn" style="background: #00a9ec;border:none; outline:none; margin: auto;color: white;padding: 5px 10px; display: block;width: 150px;text-align: center;margin-top: 30px;cursor: pointer;" data-offset="{{ count($products) }}">Load More</button>
                    </div>
                </div>
            </section>
        @else
            <section>
                <div class = "row">
                    <div class="col-md-12 text-center" style = "margin-top:15%">
                        <p>No products were found matching your selection.</p>
                        
                        <a href="{{route('shop_products')}}" class="back-to-shop no_djax btn btn-primary">Back to shop</a>
                    </div>
                </div>
            </section>
        @endif
</main>
@php
    $getSlug = collect(explode('/', request()->path()))->last();
@endphp
<script>
    $(document).ready(function () {
        $('.total_record_count').text({{$count}});
        $('#end').hide();
        var totalShowingRecord = 50;
        $('#load-more-brand-btn').on('click', function (e) {
            
            totalShowingRecord += 50;
            $('.total_showing_record').text(totalShowingRecord);

            e.preventDefault();
            var offset = $(this).data('offset');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{url('/load-more-brand-products')}}",
                type: 'POST',
                data: { brandSlug: '{{ $getSlug }}', offset: offset },
                dataType: 'json',
                success: function (response) {
                    if (response.products.length > 0) {
                        var productList = $('#product-list');
                        $.each(response.products, function (index, product) {
                        console.log(product);
                        var datetime1 = new Date(product.created_at);
                        var datetime2 = new Date();
                        var diffInMilliseconds = Math.abs(datetime2 - datetime1);
                        var diffInDays = Math.ceil(diffInMilliseconds / (1000 * 60 * 60 * 24));
                        var productOutOfStock = checkProductIsOutOfStock(product.id);

                        var productlinkHref = "/product/" + product.id + "/" + product.brand.brand_slug + "/" + product.shop_category.shop_cat_slug  + "/" + product.product_slug;

                            var productHtml = '<div class="card product-card ' + '">' +
                                '<div class="card-header">' +
                                '<a href="'+ productlinkHref +'" class="d-block">' +
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
                                '<div class="brand-name">' + product.brand.brand_name + '</div>' +
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
                                    }) + '</span>'
                                ) +
                                '</div>' +
                                '</div>';

                            productList.append(productHtml);
                        });

                        $('#load-more-brand-btn').data('offset', offset + response.products.length);
                    } else {
                        $('#load-more-brand-btn').hide();
                        $('#end').show();
                        $('#end').text("No more products.");
                    }
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
@endsection

