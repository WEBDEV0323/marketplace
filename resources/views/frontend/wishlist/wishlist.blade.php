
@extends('layouts.frontend.master')
@section('title', ' Wishlist ')
@section('banner')
<div class="inner-banner shop4">
   
    <h1 class="page-title" style="color: #ffff;">Wishlist</h1>
    <br><br><br>
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
@section('content')
<main class="wishlist-page">

    <section class="wishlist-sec1">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="wishlist-products">
              <div class="wishlist-product-remove" id="showDIV">
                <p><i class="fas fa-check"></i>Product successfully removed. </p>
              </div>
              <h3><b>my wishlist</b></h3>
             <div class="table-responsive">
              <table >
                <tr>
                  <th>Image</th>
                  <th>Product name</th>
                 <th>Size</th>
                  <th>Action</th>
                </tr>
                @if(isset($wishlists))
                @foreach($wishlists as $wishlist)
                @if(isset($wishlist->product))
                <tr class="myt{{$wishlist->id}}">
                  <!-- <td class="wishlist-cross-btn" data-wishlist_id = "{{$wishlist->id}}"><a type="button"><i class="fas fa-times"></i></a>
                  </td> -->
                  <td class="wishlist-image">    
                    <?php 
                        $product_created_type_and_admin_or_user = "USER";
                    ?>
                      @if($wishlist->product->parent_id > 0)
                          <?php $p=\App\Models\Product::where("id",$wishlist->product->parent_id)->first(); ?>
                          <?php $product_type =\App\Models\Product::where("id",$wishlist->product_id)->first();
                          if($product_type->product_type == 2){ 
                              $product_created_type_and_admin_or_user = "VenderPrelove";
                            ?>
                            <div><img src="{{ url('/').'/storage/seller-product/'.$wishlist->product_id.'/'.$wishlist->product->feature_image;}}" alt=""></div>
                          <?php }else{ 
                                $product_created_type_and_admin_or_user = "VenderNew";
                            ?>
                            <div><img src="{{ url('/').'/storage/product/'.$p->id.'/'.$p->feature_image;}}" alt=""></div>
                        <?php } ?>
                      @else
                        <div><img src="{{$wishlist->product->image_url}}" alt=""></div>
                      @endif                   
                  </td>
                  <td>
                    <p>{{$wishlist->product->product_name}}</p>
                  </td>


                 <td>
                    <p>{{$wishlist->size ?? ""}}</p> 
                  </td>



                  <td  class="wishlist-cart-btn1">
                    
                    @if($product_created_type_and_admin_or_user == "USER")
                    <a href="{{ route('single-product', ['id' => $wishlist->product->id]) }}?wishlist_size={{$wishlist->size ?? ""}}">View Product</a> 
                    @elseif($product_created_type_and_admin_or_user == "VenderPrelove")                   
                      <?php $get_product_sizes_id = \App\Models\ProductSize::where("product_id",$wishlist->product_id)->where("size_id",$wishlist->size_id)->first();
                     if($get_product_sizes_id){ ?>
                        <a href="{{route('single-product-variation',[$get_product_sizes_id->id ?? ""])}}">View Product</a> 
                      <?php } ?>
                    @elseif($product_created_type_and_admin_or_user == "VenderNew")
                      {{-- <a href="{{ route('single-product', ['id' => $wishlist->product->id]) }}?wishlist_size={{$wishlist->size ?? ""}}">View Product</a>  --}}
                      <a href="{{route('back',[$wishlist->product->parent_id, $wishlist->product_id])}}?wishlist_new={{$wishlist->size ?? ""}}" class="btn cancel">View Product</a>
                    @endif
                    <a class="wishlist-cross-btn" data-wishlist_id="{{$wishlist->id}}"  >Delete</a>
                  </td>
                </tr>
                @endif
                @endforeach
                @endif
               
              </table>
            </div>
              <script>
                //const clickfunc = () => {
                 // document.getElementById("showDIV").classList.add("wishlist-product-show");
               // }
              </script>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="wishlist-page-links">
              <h5>Share on:</h5>
              <ul>
                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main>

  @endsection

  @section('scripts')
  <script>
    $(document).ready(function(){
      $('.wishlist-cross-btn').on('click',function(){
        wishlist_id =  $(this).data('wishlist_id');
        $.ajax({
        url: "{{ route('remove-wishlist') }}",
        method: 'post',
        data: {
          "_token": "{{ csrf_token() }}",
          wishlist_id:wishlist_id,
        },
        success: function(result){
          obj = JSON.parse(result);
          $(".myt"+wishlist_id).hide();

          var b=parseInt($(".wish").text());
          
          $(".wish").text(b-1);

          
          if(obj.message){
            document.getElementById("showDIV").classList.add("wishlist-product-show");
                    
          }

                  /* if(obj.error){
                      $('.alert-dismissible').addClass('error-alert');
                      $('.alert-dismissible').addClass('show').find('p').html(obj.error);
                      
                  }
                  if(obj.message){
                      $('.alert-dismissible').addClass('success-alert');
                      $('.alert-dismissible').addClass('show').find('p').html(obj.message);
                    
                  } */
                  
                  
        }});
      });
    });
     
  </script>

  @endsection