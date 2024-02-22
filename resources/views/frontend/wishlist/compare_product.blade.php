

<section class="compare_grid">
  @if(count($compareProduct) > 0)
  @php $i = 1; @endphp
    @foreach($compareProduct as $row)  
      <div class="compare_col remove_compare_{{$row->id}}">
        <button type="button" class="cross_btn remove_campare_product"  data-compare_id="{{$row->id}}"><i class="uil uil-times"></i></button>
        <div class="card product-card">
          <div class="card-header">
            <div class="owl-carousel owl-theme compare-slider">
              @php $product_created_type_and_admin_or_user = "USER"; @endphp
              @if($row->parent_id > 0)
                <?php $p=\App\Models\Product::where("id",$row->parent_id)->first(); ?>
                <?php $product_type =\App\Models\Product::where("id",$row->product_id)->first();
                    if($product_type->product_type == 2){  
                        $product_created_type_and_admin_or_user = "VenderPrelove";
                      ?>
                      <div class="item">
                        <div class="img-box">
                          <img src="{{ url('/').'/storage/seller-product/'.$row->product_id.'/'.$row->feature_image;}}" alt="">
                        </div>
                      </div>
                    <?php
                    $product_m_images = \App\Models\ProductImage::where("product_id",$row->product_id)->get();
                      if(count($product_m_images) > 0){
                        foreach($product_m_images as $row_images){?>
                              <div class="item">
                                <div class="img-box">
                                  <img src="{{ url('/').'/storage/seller-product/'.$row->product_id.'/'.$row_images->image}}" alt="">
                                </div>
                              </div>
                        <?php }
                      }              
                  }else{
                    $product_created_type_and_admin_or_user = "VenderNew";
                    ?>
                    <div class="item">
                      <div class="img-box">
                      <img src="{{ url('/').'/storage/product/'.$p->id.'/'.$p->feature_image;}}" alt="">
                    </div>
                  </div>
              <?php } ?>
              @else
              {{-- admin images --}}
                <div class="item">
                  <div class="img-box">
                    <img src="{{ url('/').'/storage/product/'.$row->product_id.'/'.$row->feature_image}}" alt="">
                  </div>
                </div>
                <?php  $product_m_images = \App\Models\ProductImage::where("product_id",$row->product_id)->get();
                  if(count($product_m_images) > 0){
                     foreach($product_m_images as $row_images){?>
                          <div class="item">
                            <div class="img-box">
                              <img src="{{ url('/').'/storage/product/'.$row->product_id.'/'.$row_images->image}}" alt="">
                            </div>
                          </div>
                    <?php }
                  }
                ?>
              {{-- admin images --}}
              @endif 

            </div>    
          </div>
          <div class="card-body">
            
              <div class="brand-name">
                @if($row->brand_id > 0)
                  @php  $brandget = \App\Models\Brand::where("id",$row->brand_id)->first(); @endphp
                  {{(isset($brandget->brand_name))?$brandget->brand_name:''}}
                @endif
              </div>
              <a href="javascript:void(0)" class="product-title" style="cursor: auto;">{{$row->product_name}}</a>
              @if((int)$row->sale_price > 0 && (int)$row->regular_price > $row->sale_price)
                <span class="real-price">£{{number_format($row->regular_price,2) }}</span> 
                <span class="discounted-price">£{{number_format($row->sale_price,2) }}</span> 
              @else
              <span class="discounted-price">£{{number_format($row->regular_price,2) }}</span> 
              @endif
              <!-- <span class="discounted-price">£{{number_format($row->sale_price,2) }}</span>             -->
              @if($product_created_type_and_admin_or_user == "USER")
                <a href="{{ route('single-product', ['id' => $row->product_id]) }}?wishlist_size={{$row->size_name ?? ""}}" class="blue-button view-mid">View Product</a>
              @elseif($product_created_type_and_admin_or_user == "VenderPrelove") 
                  @php $get_product_sizes_id = \App\Models\ProductSize::where("product_id",$row->product_id)->where("size_id",$row->size_id)->first(); @endphp                  
                <a href="{{route('single-product-variation',[$get_product_sizes_id->id ?? ""])}}" class="blue-button view-mid">View Product</a> 
              @elseif($product_created_type_and_admin_or_user == "VenderNew")
                <a href="{{route('back',[$row->parent_id, $row->product_id])}}?wishlist_new={{$row->size_name ?? ""}}" class="blue-button view-mid">View Product</a>
              @endif
              <span class="sku_text">SKU: {{$row->sku}}</span>
          </div>
        </div>
      </div>
    @php $i++; @endphp
  @endforeach

  @endif
  {{-- @if(count($compareProduct) < 2) --}}
  <div class="compare_col">
    <div class="card product-card justify-content-center">
      <a href="{{route('shop_products')}}" class="blue-button view-mid">Add Product</a>
    </div>
  </div>
  {{-- @endif --}}
</section>


<script>
  $('.compare-slider').owlCarousel({
    loop: false,
    margin: 0,
    nav: true,
    dots: false,
    items: 1,
    navText: ["<i class='fas fa-long-arrow-alt-left'></i>", "<i class='fas fa-long-arrow-alt-right'></i>"],
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
});
</script>
