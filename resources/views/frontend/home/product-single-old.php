@extends('layouts.frontend.master')
@section('title')
{{ $products->product_name }} - The Marketplace
@endsection
@section('banner')
@endsection
@section('content')
<main class="product-page product-page-new pb-0">
    <h1>test</h1>
    <div class="container pt-5">
        <div class="single-product">
            <div class="column column-img">
                <div class="owl-carousel owl-theme single-img-slider">
                    <div class="item">
                            <div class="img-wrapper">
                                <img src="{{ $products->image_url }}"
                                    class="img-fluid">
                            </div>
                        </div>    
                        @if(isset($products->multi_images))
                            @foreach($products->multi_images as $multi_images)
                            <div class="item">
                                <div class="img-wrapper">
                                    <img src="{{ $multi_images->image_multi_url }}"
                                        class="img-fluid">
                                </div>
                            </div>
                            @endforeach
                        @endif
                </div>
            </div>
            <div class="column column-details">
                <div class="inner-wrapper">
                    <h3 class="product-title">{{$products->product_name}}</h3>
                    <div class="product-price">
                        <h3 class="discounted-price">£{{$products->regular_price}}</h3>
                        <h3 class="actual-price">£{{$products->sale_price}}</h3>
                    </div>
                    <div class="product-slider-wrapper">
                        <div class="owl-carousel owl-theme product-pills-slider">
                            @foreach($products->prod_size as $sizes)    
                                    <div class="item">
                                        <div class="item-wrapper">
                                            <button class="pills-link-admin pills-link <?php echo ($sizes->quantity > 0 ? '' : 'quantity-disabled' );?>" <?php echo ($sizes->quantity > 0 ? '' : 'disabled' );?> data-size_id = '{{$sizes->size->id}}' data-toggle="pill" type="button">
                                                {{$sizes->size->size}}
                                                <span class="pill-price">${{$products->sale_price}}</span>
                                            </button>
                                        </div>
                                    </div>
                            @endforeach        
                        </div>
                    </div>
                    <form action="">
                        <h4 class="size-guide"><a type="button"  data-toggle="modal" data-target="#sizeGuide_Modal">View Size Guide</a></h4>
                        <div class="product-quantity">
                            <div class="quantity">
                                <input type="number" id="number" value="1" readonly/>
                                <div class="button-wrapper">
                                    <div class="value-button" id="increase" onclick="increaseValue()"
                                        value="Increase Value">+</div>
                                    <div class="value-button" id="decrease" onclick="decreaseValue()"
                                        value="Decrease Value">-</div>
                                </div>
                            </div>
                            <input type="hidden" name="product_id" id = "product_id" value = "{{$products->id}}">
                          

                            <button class="btn add-to-cart-button" id = "addToCart" disabled type="button">Add to Cart</button>
                        </div>
                    </form>
                    <div class="action-buttons">
                        <a type="button" class="btn Add-to-Wishlist" id = "addWishlist"><i class="fa fa-heart"></i> Add to Wishlist</a>
                        <a href="#" class="btn"><i class="fas fa-sync-alt"></i> Compare</a>
                    </div>
                </div>
                <div style = "display:none" class="column product-details-column">
                    <a href="javascript:void(0)" class="cross-times">
                        &times;
                    </a>
                    <div class="heading-area">
                        <h3 class="product-title"></h3>
                        <div class="product-price">
                    
                    </div>
                    <h4>{{$products->product_name}}</h4>
                    <a type="button" data-toggle="modal" data-target="#sizeGuide_Modal">US Men sizes</a>
                </div>
                    <ul class="nav nav-pills nav-pills-product" id="pills-products" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="new-product" data-toggle="pill" href="#pills-new-product">New</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="used-product" data-toggle="pill" href="#pills-used-product">Used</a>
                        </li>
                    </ul>
                    <div class="tab-content product-pills-content">
                      
                        
                   @if(!$vendor_products->isEmpty())
                             <div class="tab-pane fade show active" id="pills-new-product">
                                <div class="product-size-content">
                        
                                <div class="product-slider-wrapper">
                                        <div class="owl-carousel owl-theme product-pills-slider">
                                        @foreach($vendor_products as $vendor_product)                  
                                            @foreach($vendor_product->prod_size as $vendor_product)
                                                
                                            <div class="item">
                                                    <div class="item-wrapper">
                                                        <button class="pills-link-new-product pills-link" data-product_id = "{{$products->id}}"  data-size_id = "{{$vendor_product->size_id}}" data-toggle="pill" type="button">
                                                             {{$vendor_product->size->size}}
                                                    
                                                         {{--<span class="pill-price">£{{$vendor_product->price}}</span>--}}
                                                         </button>
                                                    </div>
                                                </div>
                                             @endforeach 
                                        @endforeach
                                            
                                        </div>
                                    </div>
                                    <div class="new-product-size-content">
                                        <div class="tab-pane" id="product-size-1">        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        @else
                             <div class = "out-of-stock">Out of Stock</div>
                        @endif

                        <div class="tab-pane fade " id="pills-used-product">
                            
                        @if(!$used_products->isEmpty())
                      
                                <div class="product-slider-wrapper">
                                    <div class="owl-carousel owl-theme product-pills-slider">
                                    @foreach($used_products as $used_product)
                                           @foreach($used_product->prod_size as $vendor_product)
                                                <div class="item">
                                                    <div class="item-wrapper">
                                               
                                                        <button class="pills-link-used-product pills-link" data-product_id = "{{$products->id}}"  data-size_id = "{{$vendor_product->size_id}}" data-toggle="pill" type="button">
                                                        {{$vendor_product->size->size}}
                                                    
                                                        {{--<span class="pill-price">£{{$vendor_product->price}}</span>--}}
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                    @endforeach        
                                    </div>
                                </div>
                               
                                    <div class="used-product-size-content">
                                        <div class="tab-pane" id="used-product-size-1">        
                                        </div>
                                    </div>
                            @else
                                <div class = "out-of-stock">Out of Stock</div>
                           @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        --}}
        <!-- Modal -->
        <div class="modal fade" id="sizeGuide_Modal" tabindex="-1" role="dialog" aria-labelledby="sizeGuide_ModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="sizeGuide_ModalLabel">Size Guide</h5>
                <button id = "close_button_model" type="button" class="close"  data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <div id="accordionlvl1">
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
                                
                                </h5>
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
                                
                                </h5>
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
                                
                                </h5>
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
                                
                                </h5>
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
                                
                                </h5>
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
                </div>
                </div>
            </div>
            </div>
        </div>
        <!-- Modal End -->
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
                <p><span>Category:</span>
                    <a href="{{route('product.category',['slug'=>$products->shop_category->shop_cat_slug])}}">
                    {{ $products->shop_category->shop_cat_name }}</a>
                </p>
                </div>

            <div class="">
                <p><span>Sold By: </span><a href="#">The Marketplace</a></p>
            </div>
            <div class="">
                <p><span>SKU: </span> <?php if(is_null($products->sku)) echo ''; else echo $products->sku;?> </p>
            </div>
        </div>

        <div class="product-description">
            <h6>Product Description</h6>
            <p>{!! $products->product_description !!}</p>
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
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="product-category">
                                
                                <a href="{{route('product.category',['slug'=>$man_product->shop_category->shop_cat_slug])}}">
                        {{ $man_product->shop_category->shop_cat_name }}</a>

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

            <div class="owl-carousel owl-theme product-slider" id="slider-men-new">
        
        <div class="item">
          <div class="card product-card">
            <div class="card-header">
              <a href="single-product.html" class="d-block">
                <div class="img-box">
                  <img src="assets/images/men-product-1.png" class="img-fluid">
                </div>
                <div class="tags">
                  <span class="discount-tag">-30%</span>
                  <span class="new-tag">New</span>
                </div>
                <span class="out-of-stock">Out of Stock</span>
              </a>
            </div>
            <div class="card-body">
              <div class="product-category">
                <a href="#">UNCATEGORIZED</a>
              </div>
              <a href="single-product.html" class="product-title">T-Shirt</a>
              <span class="discounted-price">£98.00</span>
              <span class="real-price">£180.00</span>
            </div>
          </div>
        </div>
        
        <div class="item">
          <div class="card product-card">
            <div class="card-header">
              <a href="single-product.html" class="d-block">
                <div class="img-box">
                  <img src="assets/images/men-product-2.jpg" class="img-fluid">
                </div>
                <div class="tags">
                  <span class="discount-tag">-30%</span>
                  <span class="new-tag">New</span>
                </div>
                <span class="out-of-stock">Out of Stock</span>
              </a>
            </div>
            <div class="card-body">
              <div class="product-category">
                <a href="#">UNCATEGORIZED</a>
              </div>
              <a href="single-product.html" class="product-title">Sneakers</a>
              <span class="discounted-price">£98.00</span>
              <span class="real-price">£180.00</span>
            </div>
          </div>
        </div>
        
        <div class="item">
          <div class="card product-card">
            <div class="card-header">
              <a href="single-product.html" class="d-block">
                <div class="img-box">
                  <img src="assets/images/men-product-3.jpg" class="img-fluid">
                </div>
                <div class="tags">
                  <span class="discount-tag">-30%</span>
                  <span class="new-tag">New</span>
                </div>
                <span class="out-of-stock">Out of Stock</span>
              </a>
            </div>
            <div class="card-body">
              <div class="product-category">
                <a href="#">UNCATEGORIZED</a>
              </div>
              <a href="single-product.html" class="product-title">24522</a>
              <span class="discounted-price">£98.00</span>
              <span class="real-price">£180.00</span>
            </div>
          </div>
        </div>
        
        <div class="item">
          <div class="card product-card">
            <div class="card-header">
              <a href="single-product.html" class="d-block">
                <div class="img-box">
                  <img src="assets/images/men-product-4.jpg" class="img-fluid">
                </div>
                <div class="tags">
                  <span class="discount-tag">-30%</span>
                  <span class="new-tag">New</span>
                </div>
                <span class="out-of-stock">Out of Stock</span>
              </a>
            </div>
            <div class="card-body">
              <div class="product-category">
                <a href="#">UNCATEGORIZED</a>
              </div>
              <a href="single-product.html" class="product-title">Sneakers</a>
              <span class="discounted-price">£98.00</span>
              <span class="real-price">£180.00</span>
            </div>
          </div>
        </div>
        
        <div class="item">
          <div class="card product-card">
            <div class="card-header">
              <a href="single-product.html" class="d-block">
                <div class="img-box">
                  <img src="assets/images/men-product-5.jpg" class="img-fluid">
                </div>
                <div class="tags">
                  <span class="discount-tag">-30%</span>
                  <span class="new-tag">New</span>
                </div>
                <span class="out-of-stock">Out of Stock</span>
              </a>
            </div>
            <div class="card-body">
              <div class="product-category">
                <a href="#">UNCATEGORIZED</a>
              </div>
              <a href="single-product.html" class="product-title">Sneakers</a>
              <span class="discounted-price">£98.00</span>
              <span class="real-price">£180.00</span>
            </div>
          </div>
        </div>
        
        
      </div>
          
        </div>
    </div>
</div>
        <div class="alert alert-dismissible fade" role="alert">
            <button id="error_model" type="button buttonAlert" class="close buttonAlert" data-dismiss="alert" aria-label="Close">
                <i class="uil uil-multiply"></i>
            </button>
            <p class="displayContent"></p>
        </div>
</main>
@endsection

@section('extra-css')
<div class="fixed-buttons">
    <a href="#header" class="btn white-btn go-top"><i class="fas fa-caret-up"></i></a>
    
    <a href="javascript:void(0)" class="btn blue-btn buy_used"
        style="border-left: 1px solid #25252d;">buy used</a>
    <a href="javascript:void(0)" class="btn blue-btn buy_new">buy
        new</a>
</div>
@endsection
@section('scripts')

<script>
    $(document).ready(function () {

        
        $('.buy_new').on('click', function (e) {
           $('.inner-wrapper').hide();
           $('.product-details-column').show();
           $('.column-details').addClass('column-details-fixed');
           $('#new-product').addClass('active');
           $('#used-product').removeClass('active');
           $('#pills-new-product').addClass('show active');
           $('#pills-used-product').removeClass('show active');
           
        });


        $('#close_button_model').click(function() {
            $('#sizeGuide_Modal').modal('hide');
        });

        $('.buy_used').on('click', function (e) {
            
            $('.inner-wrapper').hide();
            $('.product-details-column').show();
            $('.column-details').addClass('column-details-fixed');
            $('#new-product').removeClass('active');
            $('#used-product').addClass('active');
            $('#pills-new-product').removeClass('show active');
            $('#pills-used-product').addClass('show active');
            
        });

        $('.product-details-column .cross-times').on('click', function(){
            $('.product-details-column').hide();
            $('.inner-wrapper').show();
            $('.column-details').removeClass('column-details-fixed');
        });

        $('#error_model').click(function() {
            $('.alert-dismissible').modal('hide');
        });
        
        $('.pills-link-admin').on('click', function(){
            $('.pills-link-admin').removeClass('active');
            $(this).addClass('active');
            $('#product_size').val($(this).data('size_id'));
            $('#addToCart').prop('disabled', false);
          
        });

        $('#addToCart').on('click', function (e) {
            quantity = $('#number').val();
            product_id = $('#product_id').val();
            size_id = $('#product_size').val();

             $.ajax({
                url: "{{ route('cart') }}",
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    quantity: quantity,
                    product_id: product_id,
                    size_id: size_id,
                },
                success: function (result) {
                    var obj = jQuery.parseJSON(result);
                    location.reload();

                }
            }); 

        });

        $('.pills-link-new-product').on('click', function(){
            $('.pills-link-new-product').removeClass('active');
            $(this).addClass('active');
            size_id = $(this).data('size_id');
            product_id = $(this).data('product_id');
           console.log(product_id);
           console.log(size_id);
            $.ajax({
                url: "{{ route('product-size-vendor') }}",
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    product_id: product_id,
                    size_id: size_id,
                    flags: 1,
                },
                success: function (result) {
                  //$('#product-size-1').html(result);
                  console.log(result);
                }
            });
        });
        $('.pills-link-used-product').on('click', function(){
            $('.pills-link-used-product').removeClass('active');
            $(this).addClass('active');
            size_id = $(this).data('size_id');
            product_id = $(this).data('product_id');
            $.ajax({
                url: "{{ route('product-size-vendor') }}",
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
            product_id = $('#product_id').val();

            //console.log(quantity+'p_id '+product_id);
            $.ajax({
                url: "{{ route('user-wishlist') }}",
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    product_id: product_id,
                },
                success: function (result) {
                    obj = JSON.parse(result);
                    console.log(obj);

                    if (obj.error) {
                        $('.alert-dismissible').addClass('error-alert');
                        $('.alert-dismissible').addClass('show').find('p').html(obj.error);

                    }
                    if (obj.message) {
                        $('.alert-dismissible').addClass('success-alert');
                        $('.alert-dismissible').addClass('show').find('p').html(obj
                        .message);
                        $('.nav-item .nav-button .wishlist-btn ').find('a').html(
                            '<span class = "badge">' + obj.message + '<span>');
                    }


                }
            });

        });


    });

</script>
@endsection
