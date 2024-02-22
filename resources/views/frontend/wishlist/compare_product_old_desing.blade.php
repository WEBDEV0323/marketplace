<main class="compare_product">
    <section class="compare_product-sec1">
            <div class="table-responsive">
              <table class="table table-bordered">
                <tbody>
                  @if(count($compareProduct) > 0)
                  @php $i = 1; @endphp
                  <tr>
                  @foreach($compareProduct as $row)                    
                      @if($i == 1) <th></th>@endif
                      <td class="remove_compare_{{$row->id}}">
                        <a href="javascript:void(0)" class="link-text remove_campare_product" data-compare_id="{{$row->id}}">Remove <i class="uil uil-times"></i></a>
                        <div class="product-thumb">
                            @if($row->parent_id > 0)
                                <?php $p=\App\Models\Product::where("id",$row->parent_id)->first(); ?>
                                <?php $product_type =\App\Models\Product::where("id",$row->product_id)->first();
                                if($product_type->product_type == 2){  ?>
                                <img src="{{ url('/').'/storage/seller-product/'.$row->product_id.'/'.$row->feature_image;}}" alt="">
                                <?php }else{ ?>
                                  <img src="{{ url('/').'/storage/product/'.$p->id.'/'.$p->feature_image;}}" alt="">
                              <?php } ?>
                            @else
                            <img src="{{ url('/').'/storage/product/'.$row->product_id.'/'.$row->feature_image}}" alt="">
                            @endif 
                        </div>
                      </td>
                     
                    @php $i++; @endphp
                    @endforeach
                  </tr>

                  <tr>
                  @php $i = 1; @endphp
                    @foreach($compareProduct as $row)             
                      @if($i == 1) <th>Title</th> @endif                   
                        <td class="remove_compare_{{$row->id}} title_compare_product">{{$row->product_name}}</td>                      
                      @php $i++; @endphp
                    @endforeach
                  </tr>

                  <tr>
                    @php $i = 1; @endphp
                      @foreach($compareProduct as $row)   
                        @if($i == 1)
                        <th>Price</th>
                        @endif
                        <td class="remove_compare_{{$row->id}}"><a href="javascript:void(0)" class="link-text"><u>£{{$row->sale_price}}</u></a></td>
                        @php $i++; @endphp
                     @endforeach
                  </tr>


                  <tr>
                    @php $i = 1; @endphp
                    @foreach($compareProduct as $row) 
                      @if($i == 1) <th>Add To Cart</th> @endif

                      <?php 
                        $get_product_sizes_id = \App\Models\ProductSize::where("product_id",$row->product_id)->where("size_id",$row->size_id)->first();
                        $isWishlist = \App\Models\Wishlist::where("product_id",$row->product_id)->where('user_id', Auth::id())->where("size_id",$row->size_id)->first();
                      $product_created_type_and_admin_or_user = "USER"; ?>
                        @if($row->parent_id > 0)                           
                          <?php if($row->product_type == 2){ 
                                $product_created_type_and_admin_or_user = "VenderPrelove";
                              }else{ 
                                  $product_created_type_and_admin_or_user = "VenderNew";
                               } ?>
                        @endif

                      <td class="remove_compare_{{$row->id}}">
                        <div class="btn-set">

                          <button type="button" class="btn td-button compare_add_to_wishlist {{$isWishlist?'btn_wishlist_color product_in_wishlist':''}}" data-product_id="{{$row->product_id}}" data-size_id="{{$row->size_id}}">
                            @if($isWishlist) 
                              <i class="fa fa-heart"></i>
                            @else
                             <i class="uil uil-heart"></i>
                            @endif
                          </button>
                         
                          @if($product_created_type_and_admin_or_user == "USER")
                          <button type="button" class="btn td-button compare_add_to_cart_btn"  data-product_id="{{$row->product_id}}" data-size_id="{{$row->size_id}}" data-variation_id="{{$get_product_sizes_id->id}}"><i class="uil uil-shopping-cart-alt"></i></button>
                            <a href="{{ route('single-product', ['id' => $row->product_id]) }}?wishlist_size={{$row->size_name ?? ""}}"  class="btn td-button"><i class="uil uil-eye"></i></a> 
                          @elseif($product_created_type_and_admin_or_user == "VenderPrelove")                   
                            
                            <button type="button" class="btn td-button" onclick="cart({{$get_product_sizes_id->id}})"><i class="uil uil-shopping-cart-alt"></i></button>
                                <a href="{{route('single-product-variation',[$get_product_sizes_id->id ?? ""])}}"  class="btn td-button"><i class="uil uil-eye"></i></a> 
                              {{-- <?php //} ?> --}}
                          @elseif($product_created_type_and_admin_or_user == "VenderNew")
                          <button type="button" class="btn td-button" onclick="cart({{$get_product_sizes_id->id}})"><i class="uil uil-shopping-cart-alt"></i></button>
                              <a href="{{route('back',[$row->parent_id, $row->product_id])}}?wishlist_new={{$row->size_name ?? ""}}" class="btn td-button"><i class="uil uil-eye"></i></a>
                            @endif
                        </div>
                      </td>  
                      @php $i++; @endphp
                    @endforeach          
                  </tr>


                  <tr> 
                    @php $i = 1; @endphp
                      @foreach($compareProduct as $row)  
                       @if($i == 1) <th>Description</th> @endif
                       <td class="remove_compare_{{$row->id}}"><div class="compare_product_description">{!! $row->product_description !!}</div></td>
                       @php $i++; @endphp
                      @endforeach
                 </tr>


                  <tr>  
                    @php $i = 1; @endphp
                    @foreach($compareProduct as $row)  
                      @if($i == 1)  <th>SKU</th> @endif
                      <td class="remove_compare_{{$row->id}}">{{$row->sku}}</td>
                      @php $i++; @endphp
                    @endforeach
                  </tr>
                  
                  @endif
                  
                </tbody>
              </table>
            </div>
    </section>
</main>


