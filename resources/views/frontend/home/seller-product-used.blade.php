@extends('layouts.frontend.master')
@section('title')
{{$products->product_name}} - The Marketplace
@endsection
@section('banner')
@endsection
@section('content')
<main class="product-page pb-0">
    <div class="container pt-5">

      <div class="product-layout used-product-layout">
        <div class="column images-column">
          <div class="inner-wrapper">
            <div class="img-box">
              <img src="{{asset('')}}assets/images/used-product-1a.jpeg" class="-img-fluid">
            </div>
            <div class="img-box">
              <img src="{{asset('')}}assets/images/used-product-2.jpeg" class="-img-fluid">
            </div>
            <div class="img-box">
              <img src="{{asset('')}}assets/images/used-product-3.jpeg" class="-img-fluid">
            </div>
          </div>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Brand</a></li>
              <li class="breadcrumb-item"><a href="#">Sub Brand</a></li>
              <li class="breadcrumb-item active" aria-current="page">Wmns Air Jordan 4 Retro 'Shimmer'</li>
            </ol>
          </nav>
        </div>
        <div class="column product-details-column">
          <div class="heading-area">
            <h4>Wmns Air Jordan 4 Retro 'Shimmer'</h4>
            <a href="#">2021</a>
          </div>
          <div class="used-product-details">
            <div class="table-responsive">
              <table class="table">
                <tr>
                  <td>Price</td>
                  <td>$300</td>
                </tr>
                <tr>
                  <td>Size</td>
                  <td>US Men's 7.5</td>
                </tr>
                <tr>
                  <td>Color</td>
                  <td>Tan</td>
                </tr>
                <tr>
                  <td>Condition</td>
                  <td>Used, Markings</td>
                </tr>
                <tr>
                  <td>Box</td>
                  <td>Good Condition</td>
                </tr>
              </table>
            </div>

            <div class="buttons-wrapper">
              <a href="product.html" class="btn">Cancel</a>
              <a href="#" class="btn cart-btn">Add To Cart</a>
            </div>
          </div>


        </div>
      </div>


      <div class="social">
        <p class="mr-3">Share</p>
        <p>
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fas fa-envelope"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-pinterest"></i></a>
        </p>
      </div>

      <div class="product-info">
        <div class="">
          <p><span>Sold By: </span><a href="#">The Marketplace</a></p>
        </div>
        <div class="">
          <p><span>SKU: </span> 96584</p>
        </div>
        <div class="">
          <p><span>Category:</span> <a href="#">Uncategorized</a></p>
        </div>
        <div class="">
          <p><span>Tag:</span> <a href="#">Sneakers</a></p>
        </div>
      </div>

      <div class="product-description">
        <h6>Product Description</h6>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni natus perspiciatis atque animi necessitatibus
          corrupti amet labore corporis consequatur dolorem saepe cum quas eius, molestiae rerum? Incidunt quaerat animi
          eum.</p>
      </div>

      <div class="related-products">
            <h5 class="heading-5">Related Products</h5>


            <div class="owl-carousel owl-theme product-slider" id="slider-men-new">


                @forelse($related_products as $man_product)

                    <div class="item">
                        <div class="card product-card">
                            <div class="card-header">
                                <a href="{{ route('single-product', ['id' => $man_product->id]) }}"
                                    class="d-block">
                                    <div class="img-box">
                                        <img data-src="{{ $man_product->image_url }}" class="img-fluid lazy ">
                                    </div>
                                    <div class="tags">
                                        <span class="discount-tag">- {{ $man_product->discount }}%</span>
                                        <span class="new-tag">New</span>
                                    </div>
                                    @if($man_product->quantity == 0)
                                        <span class="out-of-stock">Out of Stock</span>
                                    @endif

                                </a>
                            </div>
                            <div class="card-body">
                                <div class="product-category">
                                    @forelse($man_product->prod_shop_cat as $cat)

                                        <a
                                            href="{{ route('product.category',['slug'=>$cat->shop_cat->shop_cat_slug]) }}">
                                            {{ $cat->shop_cat->shop_cat_name }}</a>
                                    @empty
                                        <a href="">No Categories</a>
                                    @endforelse

                                </div>
                                <a href="{{ route('single-product', ['id' => $man_product->id]) }}"
                                    class="product-title">{{ $man_product->product_name }}</a>
                                <span class="discounted-price">£{{ $man_product->sale_price }}</span>
                                <span class="real-price">£{{ $man_product->regular_price }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="item">
                        <div class="card product-card">
                            <div class="card-header">
                                <p>No Man's Product</p>
                            </div>
                        </div>
                    </div>
                @endforelse



            </div>




        </div>

    </div>

    <div class="recently-viewed-products">
        <div class="container">
            <h5 class="heading-5">recently viewed products</h5>

            <div class="owl-carousel owl-theme recent-product-slider">
                <div class="item">
                    <div class="img-wrapper">
                        <a href="#"><img src="{{ asset('') }}assets/images/men-product-2.jpg"
                                class="img-fluid"></a>
                    </div>
                </div>
                <div class="item">
                    <div class="img-wrapper">
                        <a href="#"><img src="{{ asset('') }}assets/images/women-product-3.jpg"
                                class="img-fluid"></a>
                    </div>
                </div>
                <div class="item">
                    <div class="img-wrapper">
                        <a href="#"><img src="{{ asset('') }}assets/images/women-product-2.png"
                                class="img-fluid"></a>
                    </div>
                </div>
                <div class="item">
                    <div class="img-wrapper">
                        <a href="#"><img src="{{ asset('') }}assets/images/women-product-2.png"
                                class="img-fluid"></a>
                    </div>
                </div>
                <div class="item">
                    <div class="img-wrapper">
                        <a href="#"><img src="{{ asset('') }}assets/images/men-product-2.jpg"
                                class="img-fluid"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </main>
@endsection