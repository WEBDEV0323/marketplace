<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>




@if(isset($flags) && $flags == 1)

@foreach($vendor_products as $vendor_product)
@if($vendor_product['product_size'] != NULL)
@foreach($vendor_product['product_size'] as $product)
@if($product['products'] != NULL)
<ul>
    <li>
        <div class="top new_product_main_seciton">
            <div class="new_product_first_seciton">
                <h5 class="price-value">£{{number_format($product['sale_price'],2) ?? "None"}} </h5>



                @if($product->products->shipping_payer == 'seller')
                <span> Free shipping </span>
                @endif

            </div>
            <div class="new_product_second_seciton">
                <a href="#" class="btn blue-button cart-btn add_cart" onclick="cart({{$product->id}});">Add to cart <i
                        class="ml-1 fa fa-shopping-cart"></i></a>
                <div class="new_product_inner_seciton">
                    @php
                    $isWishlist = \App\Models\Wishlist::where("product_id",$product['products']->id)->where('user_id',
                    Auth::id())->where("size_id",$product['size_id'])->first();
                    @endphp
                    <a href="javascript:void(0)"
                        class="btn blue-button addwishlistNewPreLoved {{$isWishlist?'product_in_wishlist':''}}"
                        data-product_id="{{$product['products']->id}}" data-size_id="{{$product['size_id']}}">
                        @if($isWishlist)
                        <i class="fa fa-heart"></i>
                        @else
                        <i class="uil uil-heart"></i>
                        @endif
                    </a>
                    <a href="javascript:void(0)" class="btn new_product_compayr_btn"
                        data-product_id="{{$product['products']->id}}" data-size_id="{{$product['size_id']}}">
                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M13.5761 10.208C13.902 9.90722 14.431 9.90722 14.7526 10.2041L14.7568 10.208L19.7547 14.8218C20.0806 15.1226 20.0806 15.607 19.7547 15.9078L14.7568 20.5254C14.431 20.8263 13.902 20.8263 13.5761 20.5254C13.2503 20.2246 13.2503 19.7363 13.5761 19.4355L17.9858 15.3648L13.5761 11.2941C13.2503 10.9972 13.2503 10.5088 13.5761 10.208Z"
                                fill="#212121"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.10352e-05 15.3648C6.10352e-05 14.939 0.372469 14.5952 0.833747 14.5952H18.3327C18.794 14.5952 19.1664 14.939 19.1664 15.3648C19.1664 15.7906 18.794 16.1344 18.3327 16.1344H0.833747C0.372469 16.1344 6.10352e-05 15.7906 6.10352e-05 15.3648ZM6.4241 0.976691C6.74996 1.2775 6.74996 1.76192 6.4241 2.06273L2.01022 6.13735L6.41987 10.2081C6.74572 10.5089 6.74572 10.9972 6.41987 11.298C6.09401 11.5988 5.56502 11.5988 5.23916 11.298L0.245512 6.68037C-0.0803453 6.37956 -0.0803453 5.89123 0.245512 5.59433L5.2434 0.976691C5.56925 0.675881 6.09824 0.675881 6.4241 0.976691Z"
                                fill="#212121"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M0.833679 6.13733C0.833679 5.71151 1.20609 5.36772 1.66737 5.36772H19.1663C19.6276 5.36772 20 5.71151 20 6.13733C20 6.56315 19.6276 6.90694 19.1663 6.90694H1.66737C1.20609 6.90303 0.833679 6.55924 0.833679 6.13733Z"
                                fill="#212121"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </li>
</ul>
<div
    style="border-bottom: 1px solid #E6E6E6;display: flex;align-items: center;justify-content: space-between;column-gap: 20px;">
</div>


@endif
@endforeach
@endif
@endforeach

@endif
@if(isset($flags) && $flags == 2)
@foreach($vendor_products as $vendor_product)


@if($vendor_product['product_size'] != NULL)


@foreach($vendor_product['product_size'] as $product)




@if($product['products'] != NULL)

{{-- <h6>
    <?php //echo ($product['products']['product_name']);?>
</h6> --}}
<div class="pro_upper_box preloved_main_secotion_seller">
    <div class="pro_box">
        <a href="{{route('single-product-variation',[$product['id']])}}" class="btn used-product">
            <div class="img-wrapper">
                <img src="{{$product['products']['image_url_vendor']}}" class="img-fluid">
            </div>
        </a>
        <div class="pro_detail">
            <font>Price: <span class="price user_product_heilight">£{{number_format($product['sale_price'],2) ??
                    "None"}}</span></font>
            <span class="about-used-product">Condition: <span
                    class="user_product_heilight">{{$product['products']['condition']}}</span></span>
            <span class="about-used-product">Faults: <span
                    class="user_product_heilight">{{$product["fault"]}}</span></span>

        </div>
    </div>
    <div class="pre_loved_product_section">

        <a href="{{url('variation/'.$product['id'])}}" class="btn blue-button cart-btn">View</a>
        <div class="pre_loved_product_section_inside">

            @php
            $isWishlist = \App\Models\Wishlist::where("product_id",$product['products']->id)->where('user_id',
            Auth::id())->where("size_id",$product['size_id'])->first();
            @endphp
            <a href="javascript:void(0)"
                class="btn blue-button addwishlistNewPreLoved {{$isWishlist?'product_in_wishlist':''}}"
                data-product_id="{{$product['products']->id}}" data-size_id="{{$product['size_id']}}">
                @if($isWishlist)
                <i class="fa fa-heart"></i>
                @else
                <i class="uil uil-heart"></i>
                @endif
            </a>

            <a href="javascript:void(0)" class="btn new_product_compayr_btn"
                data-product_id="{{$product['products']->id}}" data-size_id="{{$product['size_id']}}">
                <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M13.5761 10.208C13.902 9.90722 14.431 9.90722 14.7526 10.2041L14.7568 10.208L19.7547 14.8218C20.0806 15.1226 20.0806 15.607 19.7547 15.9078L14.7568 20.5254C14.431 20.8263 13.902 20.8263 13.5761 20.5254C13.2503 20.2246 13.2503 19.7363 13.5761 19.4355L17.9858 15.3648L13.5761 11.2941C13.2503 10.9972 13.2503 10.5088 13.5761 10.208Z"
                        fill="#212121"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M6.10352e-05 15.3648C6.10352e-05 14.939 0.372469 14.5952 0.833747 14.5952H18.3327C18.794 14.5952 19.1664 14.939 19.1664 15.3648C19.1664 15.7906 18.794 16.1344 18.3327 16.1344H0.833747C0.372469 16.1344 6.10352e-05 15.7906 6.10352e-05 15.3648ZM6.4241 0.976691C6.74996 1.2775 6.74996 1.76192 6.4241 2.06273L2.01022 6.13735L6.41987 10.2081C6.74572 10.5089 6.74572 10.9972 6.41987 11.298C6.09401 11.5988 5.56502 11.5988 5.23916 11.298L0.245512 6.68037C-0.0803453 6.37956 -0.0803453 5.89123 0.245512 5.59433L5.2434 0.976691C5.56925 0.675881 6.09824 0.675881 6.4241 0.976691Z"
                        fill="#212121"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.833679 6.13733C0.833679 5.71151 1.20609 5.36772 1.66737 5.36772H19.1663C19.6276 5.36772 20 5.71151 20 6.13733C20 6.56315 19.6276 6.90694 19.1663 6.90694H1.66737C1.20609 6.90303 0.833679 6.55924 0.833679 6.13733Z"
                        fill="#212121"></path>
                </svg>
            </a>
        </div>
    </div>
</div>
@endif
@endforeach
@endif
@endforeach
@endif













<script>
    function cart(id)
 {
        $.ajax({
            url: "{{ route('add_cart') }}",
            method: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                product_id: id,
               
            },
            success: function (result) {

                 if(result.status=="true")
                 {   

                    // swal({
                    // title: "Product Successfully added to the cart",
                    // type: "success",
                    // confirmButtonClass: "btn-success",
                    // confirmButtonText: "OK",

                    // },
                    // function() {

                    //     parent.location.reload();

                    // });

                    $('.alert-dismissible').addClass('success-alert');
                    $('.alert-dismissible').addClass('show').find('p').html("Product added to the cart");


                    parent.location.reload();
                 }
                 else
                 {
                    // swal({
                    // title: "Please login first",
                    // type: "error",
                    // confirmButtonClass: "btn-success",
                    // confirmButtonText: "OK",

                    // },
                    // function() {

                        

                    // });
                    var lo="<?php echo route('login.login'); ?>";
                    $('.alert-dismissible').addClass('success-alert');
                        $('.alert-dismissible').addClass('show').find('p').html('User must be logged in. Click <a style="color:#00A9EC !important;" href="'+lo+'">here </a> to sign in');



                 }    
                
                

            
            }
        });
    

 }


   

</script>