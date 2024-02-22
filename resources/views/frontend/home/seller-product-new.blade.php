@extends('layouts.frontend.master')
@section('title')
{{$products->product_name}} - The Marketplace
@endsection
@section('banner')
@endsection
@section('content')

<main class="product-page pb-0">
    <div class="container pt-5">

      <div class="product-layout">
        <div class="column images-column">
          <div class="inner-wrapper">
            <div class="img-box">
              <img src="{{asset('assets/images/new-p1.jpeg')}}" class="-img-fluid">
            </div>
            <div class="img-box">
              <img src="{{asset('assets/images/new-p2.jpeg')}}" class="-img-fluid">
            </div>
            <div class="img-box">
              <img src="{{asset('assets/images/new-p3.jpeg')}}" class="-img-fluid">
            </div>
            <div class="img-box">
              <img src="{{asset('assets/images/new-p4.jpeg')}}" class="-img-fluid">
            </div>
            <div class="img-box">
              <img src="{{asset('assets/images/new-p5.jpeg')}}" class="-img-fluid">
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
            <a href="#">US Men sizes</a>
          </div>

          <ul class="nav nav-pills nav-pills-product" id="pills-products" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="pill" href="#pills-new-product">New</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="pill" href="#pills-used-product">Used</a>
            </li>
          </ul>

          <div class="tab-content product-pills-content">
            <div class="tab-pane fade  show active" id="pills-new-product">

              <div class="product-size-wrapper">
                <div class="inner product-sizes" id="product-sizes">
                  <ul class="nav nav-pills nav-pills-product-size " id="pills-products-size" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="pill" href="#product-size-1">
                        3.5M
                        <span class="price">$150</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="pill" href="#product-size-2">
                        4M
                        <span class="price">$270</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="pill" href="#product-size-3">
                        4.5M
                        <span class="price">$310</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="pill" href="#product-size-4">
                        5M
                        <span class="price">$256</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="pill" href="#product-size-5">
                        5.5M
                        <span class="price">$287</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="pill" href="#product-size-6">
                        6M
                        <span class="price">$301</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="pill" href="#product-size-7">
                        6.5M
                        <span class="price">$235</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="pill" href="#product-size-8">
                        7M
                        <span class="price">$300</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="pill" href="#product-size-9">
                        7.5M
                        <span class="price">$256</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="pill" href="#product-size-10">
                        8M
                        <span class="price">$267</span>
                      </a>
                    </li>
                  </ul>

                </div>
                <button class="btn p-size-btn-left" id="p-size-btn-left"><i class="uil uil-arrow-left"></i></button>
                <button class="btn p-size-btn-right" id="p-size-btn-right"><i class="uil uil-arrow-right"></i></button>
              </div>

              <div class="tab-content product-size-content">
                <div class="tab-pane fade show active" id="product-size-1">
                  <ul>
                    <li>
                      <div class="top">
                        <h5 class="price-value">$312</h5>
                        <a href="#" class="btn blue-button cart-btn">Add to Cart</a>
                      </div>
                      <p><span>Best Price</span> / New in Box</p>
                      <p>Lorem ipsum dolor, sit amet consectetur <a href="#">adipisicing</a> elit</p>
                    </li>
                    <li>
                      <div class="top">
                        <h5 class="price-value">$312</h5>
                        <a href="#" class="btn blue-button cart-btn">Add to Cart</a>
                      </div>
                      <p><span>Best Price</span> / New in Box</p>
                      <p>Lorem ipsum dolor, sit amet consectetur <a href="#">adipisicing</a> elit</p>
                    </li>
                    <li>
                      <div class="top">
                        <h5 class="price-value">$312</h5>
                        <a href="#" class="btn blue-button cart-btn">Add to Cart</a>
                      </div>
                      <p><span>Best Price</span> / New in Box</p>
                      <p>Lorem ipsum dolor, sit amet consectetur <a href="#">adipisicing</a> elit</p>
                    </li>
                  </ul>
                </div>
                <div class="tab-pane fade" id="product-size-2">
                  <ul>
                    <li>
                      <div class="top">
                        <h5 class="price-value">$312</h5>
                        <a href="#" class="btn blue-button cart-btn">Add to Cart</a>
                      </div>
                      <p><span>Best Price</span> / New in Box</p>
                      <p>Lorem ipsum dolor, sit amet consectetur <a href="#">adipisicing</a> elit</p>
                    </li>
                    <li>
                      <div class="top">
                        <h5 class="price-value">$312</h5>
                        <a href="#" class="btn blue-button cart-btn">Add to Cart</a>
                      </div>
                      <p><span>Best Price</span> / New in Box</p>
                      <p>Lorem ipsum dolor, sit amet consectetur <a href="#">adipisicing</a> elit</p>
                    </li>
                  </ul>
                </div>
                <div class="tab-pane fade" id="product-size-3">
                  <ul>
                    <li>
                      <div class="top">
                        <h5 class="price-value">$312</h5>
                        <a href="#" class="btn blue-button cart-btn">Add to Cart</a>
                      </div>
                      <p><span>Best Price</span> / New in Box</p>
                      <p>Lorem ipsum dolor, sit amet consectetur <a href="#">adipisicing</a> elit</p>
                    </li>
                  </ul>
                </div>
                <div class="tab-pane fade" id="product-size-4">
                  <ul>
                    <li>
                      <div class="top">
                        <h5 class="price-value">$312</h5>
                        <a href="#" class="btn blue-button cart-btn">Add to Cart</a>
                      </div>
                      <p><span>Best Price</span> / New in Box</p>
                      <p>Lorem ipsum dolor, sit amet consectetur <a href="#">adipisicing</a> elit</p>
                    </li>
                    <li>
                      <div class="top">
                        <h5 class="price-value">$312</h5>
                        <a href="#" class="btn blue-button cart-btn">Add to Cart</a>
                      </div>
                      <p><span>Best Price</span> / New in Box</p>
                      <p>Lorem ipsum dolor, sit amet consectetur <a href="#">adipisicing</a> elit</p>
                    </li>
                  </ul>
                </div>
                <div class="tab-pane fade" id="product-size-5">
                  <ul>
                    <li>
                      <div class="top">
                        <h5 class="price-value">$312</h5>
                        <a href="#" class="btn blue-button cart-btn">Add to Cart</a>
                      </div>
                      <p><span>Best Price</span> / New in Box</p>
                      <p>Lorem ipsum dolor, sit amet consectetur <a href="#">adipisicing</a> elit</p>
                    </li>
                  </ul>
                </div>
                <div class="tab-pane fade" id="product-size-6">
                  <ul>
                    <li>
                      <div class="top">
                        <h5 class="price-value">$312</h5>
                        <a href="#" class="btn blue-button cart-btn">Add to Cart</a>
                      </div>
                      <p><span>Best Price</span> / New in Box</p>
                      <p>Lorem ipsum dolor, sit amet consectetur <a href="#">adipisicing</a> elit</p>
                    </li>
                    <li>
                      <div class="top">
                        <h5 class="price-value">$312</h5>
                        <a href="#" class="btn blue-button cart-btn">Add to Cart</a>
                      </div>
                      <p><span>Best Price</span> / New in Box</p>
                      <p>Lorem ipsum dolor, sit amet consectetur <a href="#">adipisicing</a> elit</p>
                    </li>
                    <li>
                      <div class="top">
                        <h5 class="price-value">$312</h5>
                        <a href="#" class="btn blue-button cart-btn">Add to Cart</a>
                      </div>
                      <p><span>Best Price</span> / New in Box</p>
                      <p>Lorem ipsum dolor, sit amet consectetur <a href="#">adipisicing</a> elit</p>
                    </li>
                  </ul>
                </div>
                <div class="tab-pane fade" id="product-size-7">
                  <ul>
                    <li></li>
                    <div class="top">
                      <h5 class="price-value">$312</h5>
                      <a href="#" class="btn blue-button cart-btn">Add to Cart</a>
                    </div>
                    <p><span>Best Price</span> / New in Box</p>
                    <p>Lorem ipsum dolor, sit amet consectetur <a href="#">adipisicing</a> elit</p>
                    </li>
                    <li>
                      <div class="top">
                        <h5 class="price-value">$312</h5>
                        <a href="#" class="btn blue-button cart-btn">Add to Cart</a>
                      </div>
                      <p><span>Best Price</span> / New in Box</p>
                      <p>Lorem ipsum dolor, sit amet consectetur <a href="#">adipisicing</a> elit</p>
                    </li>
                  </ul>
                </div>
                <div class="tab-pane fade" id="product-size-8">
                  <ul>
                    <li>
                      <div class="top">
                        <h5 class="price-value">$312</h5>
                        <a href="#" class="btn blue-button cart-btn">Add to Cart</a>
                      </div>
                      <p><span>Best Price</span> / New in Box</p>
                      <p>Lorem ipsum dolor, sit amet consectetur <a href="#">adipisicing</a> elit</p>
                    </li>
                  </ul>
                </div>
                <div class="tab-pane fade" id="product-size-9">
                  <ul>
                    <li>
                      <div class="top">
                        <h5 class="price-value">$312</h5>
                        <a href="#" class="btn blue-button cart-btn">Add to Cart</a>
                      </div>
                      <p><span>Best Price</span> / New in Box</p>
                      <p>Lorem ipsum dolor, sit amet consectetur <a href="#">adipisicing</a> elit</p>
                    </li>
                    <li>
                      <div class="top">
                        <h5 class="price-value">$312</h5>
                        <a href="#" class="btn blue-button cart-btn">Add to Cart</a>
                      </div>
                      <p><span>Best Price</span> / New in Box</p>
                      <p>Lorem ipsum dolor, sit amet consectetur <a href="#">adipisicing</a> elit</p>
                    </li>
                  </ul>
                </div>
                <div class="tab-pane fade" id="product-size-10">
                  <ul>
                    <li>
                      <div class="top">
                        <h5 class="price-value">$312</h5>
                        <a href="#" class="btn blue-button cart-btn">Add to Cart</a>
                      </div>
                      <p><span>Best Price</span> / New in Box</p>
                      <p>Lorem ipsum dolor, sit amet consectetur <a href="#">adipisicing</a> elit</p>
                    </li>
                    <li>
                      <div class="top">
                        <h5 class="price-value">$312</h5>
                        <a href="#" class="btn blue-button cart-btn">Add to Cart</a>
                      </div>
                      <p><span>Best Price</span> / New in Box</p>
                      <p>Lorem ipsum dolor, sit amet consectetur <a href="#">adipisicing</a> elit</p>
                    </li>
                    <li>
                      <div class="top">
                        <h5 class="price-value">$312</h5>
                        <a href="#" class="btn blue-button cart-btn">Add to Cart</a>
                      </div>
                      <p><span>Best Price</span> / New in Box</p>
                      <p>Lorem ipsum dolor, sit amet consectetur <a href="#">adipisicing</a> elit</p>
                    </li>
                  </ul>
                </div>
              </div>

            </div>

            <div class="tab-pane fade" id="pills-used-product">
              <div class="product-size-wrapper">
                <div class="inner product-sizes" id="used-product-sizes">
                  <ul class="nav nav-pills nav-pills-product-size " id="pills-used-products-size" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="pill" href="#used-product-size-1">
                        6M
                        <span class="price">$300</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="pill" href="#used-product-size-2">
                        6.5M
                        <span class="price">$304</span>
                      </a>
                    </li>
                  </ul>

                </div>
                <button class="btn p-size-btn-left" id="used-size-btn-left"><i class="uil uil-arrow-left"></i></button>
                <button class="btn p-size-btn-right" id="used-size-btn-left"><i
                    class="uil uil-arrow-right"></i></button>
              </div>

              <div class="tab-content used-product-size-content">
                <div class="tab-pane fade show active" id="used-product-size-1">
                  <h6>Authenticity Assured</h6>
                  <a href="{{route('single-product-used',[$products->id])}}" class="btn used-product">
                    <div class="img-wrapper">
                      <img src="{{asset('assets/images/used-product-1.jpeg')}}" class="img-fluid">
                    </div>
                    <span class="about-used-product">Original Box (Good)</span>
                    <span class="price">$300</span>
                  </a>
                </div>
                <div class="tab-pane fade" id="used-product-size-2">
                  <h6>Authenticity Assured</h6>
                  <a href="{{route('single-product-used',[$products->id])}}" class="btn used-product">
                    <div class="img-wrapper">
                      <img src="{{asset('assets/images/used-product-damaged-1.jpeg')}}" class="img-fluid">
                    </div>
                    <span class="about-used-product">Original Box (Damaged)</span>
                    <span class="price">$300</span>
                  </a>
                </div>
              </div>

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