@if(!$products->isEmpty()) 
        @foreach($products as $product)
            <div class="card product-card">
                <div class="card-header">

                    <a href="{{ route('single-product', ['id' => $product->id]) }}"
                        class="d-block">
                        <div class="img-box">
                            <img src="{{ $product->image_url }}" class="img-fluid"> 
                        </div>
                        <div class="tags">
                            <span class="discount-tag">-{{ $product->discount }}%</span> 
                            <span class="new-tag">New</span>
                        </div>
                    </a>
                </div>
                <div class="card-body">
                    <div class="product-category"></div>
                    <a href="{{ route('single-product', ['id' => $product->id]) }}"
                        class="product-title">{{ $product->product_name }}</a>
                        <span class="real-price">£{{ $product->regular_price }}</span>  
                    <span class="discounted-price">£{{ $product->sale_price }}</span>
                </div>
            </div>
        @endforeach
@else
    <div class="col-md-12 text-center" style = "margin-top:15%">
        <p>No products were found matching your selection.</p>
        <a href="{{route('shop_products')}}" class="back-to-shop no_djax btn btn-primary">Back to shop</a>
    </div>
@endif