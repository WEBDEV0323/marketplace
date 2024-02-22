<?php
$my_id=0;

if(isset(auth::user()->id))
{
    $my_id=auth::user()->id;
    $p = \App\Models\Cart::select(["products.*","carts.*","product_sizes.sale_price as sale_price_sizes","products.delivery_charges as delivery_charges","sizes.size","shop_categories.shipping as ship"])
        ->leftjoin("products","products.id","=","carts.product_id")
        ->leftjoin("product_sizes","product_sizes.product_id","=","products.id");
    $p->leftjoin("sizes","sizes.id","=","product_sizes.size_id");
    $p->leftjoin("shop_categories","shop_categories.id","=","products.shop_category_id");
    $p->where("user_id",$my_id)->groupBy("carts.id");
    
    $cart_data=$p->get();

    $ship=\App\Models\Setting::where("key","fixed_shipping")->first();

    if(isset($ship->value))
    {
        $val=$ship->value;
        preg_match('!\d+!', $ship->value, $matches);
        $shipping=(int) $matches[0];
    } else {

        $shipping= 15;
    }
}
?>

<header id="header">

    @section('banner')

        <div class="video-container">
            <video autoplay muted loop id="myVideo">
              <!--  <source src="{{route('home')}}/tmp-homepage2.mp4" type="video/mp4"> -->
                @if(isset($video_path))
                  <source src="{{$video_path}}" type="video/mp4">
                @else

                @endif
            </video> 

            <div id="banner-slider" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner" style="display: none;">
                    <div class="carousel-item active">
                        {{-- <h1>The Market place</h1>
                         <div class="form-group">
                             <div class="input-group">
                                 <div class="input-group-prepend">
                                     <span class="input-group-text" id="basic-addon1"><i class="uil uil-search"></i></span>
                                 </div>
                                 <input type="text" autofocus onkeypress="handleKeyPress(event)" class="form-control search_result_all1" placeholder="Search.." aria-label="Username"
                                     aria-describedby="basic-addon1" id="search" >
                             </div>
                         </div> --}}
                    </div>
                    <div class="carousel-item">
                        {{--  <h1>The Market place</h1>
                          <div class="form-group">
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1"><i class="uil uil-search"></i></span>
                                  </div>
                                  <input type="text" autofocus onkeypress="handleKeyPress(event)" class="form-control search_result_all2" placeholder="Search.." aria-label="Username"
                                      aria-describedby="basic-addon1">
                              </div>
                          </div> --}}
                    </div>
                    <div class="carousel-item">
                        {{--  <h1>The Market place</h1>
                          <div class="form-group">
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon1"><i class="uil uil-search"></i></span>
                                  </div>
                                  <input type="text" autofocus onkeypress="handleKeyPress(event)" class="form-control search_result_all3" placeholder="Search.." aria-label="Username"
                                      aria-describedby="basic-addon1">
                              </div>
                          </div>  --}}
                    </div>
                </div>
                <div style="  position: absolute; top: 24%; width: 100%;">
                    <h1 style="font-size:clamp(2rem, 4vw, 5.5rem); text-transform: uppercase; color: #000; font-weight: 700; font-family: roboto; margin: 70px auto 40px; text-align:center; letter-spacing: 1px;">The Market place</h1>
                    <div class="form-group " style="margin:auto 5%;">
                        <div class="input-group">

                            <input type="text" autofocus onkeypress="handleKeyPress(event)" class="form-control search_result_all1" placeholder="Search.." aria-label="Username"
                                   aria-describedby="basic-addon1" id="search" >
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="uil uil-search home-first"></i></span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
                 id="search-popup">
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
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="uil uil-search"></i></span>
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
            @show
        </div>

        <nav class="navbar navbar-expand-xl">

            <a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('assets/images/logo-black.png')}}" class="img-fluid"></a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="uil uil-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @if(Route::currentRouteName()=="news")
                    <div class="navbar-page-title-dropdown">
                        News
                    </div>

                @elseif(Route::currentRouteName()=="start_selling_home")
                    <div class="navbar-page-title-dropdown">
                        Start Selling
                    </div>
                @elseif(Route::currentRouteName()=="shop_products")
                    <div class="navbar-page-title-dropdown">
                        Shop
                    </div>
                @elseif(Route::currentRouteName()=="login.login")
                    <div class="navbar-page-title-dropdown">
                        Sign In
                    </div>
                @elseif(Route::currentRouteName()=="update_account")
                <div class="navbar-page-title-dropdown">
                    Account Details
                </div>
                @elseif(Route::currentRouteName()=="edit_address")
                <div class="navbar-page-title-dropdown">
                    Addresses
                </div>
                @elseif(Route::currentRouteName()=="bank_detail")
                <div class="navbar-page-title-dropdown">
                    Bank Information
                </div>
                @elseif(Route::currentRouteName()=="my_list")
                <div class="navbar-page-title-dropdown">
                    My Listings
                </div>
                @elseif(Route::currentRouteName()=="user_subscribe")
                <div class="navbar-page-title-dropdown">
                    My Subscriptions
                </div>
                @elseif(Route::currentRouteName()=="user_orders")
                <div class="navbar-page-title-dropdown">
                    Orders
                </div>
                @elseif(Route::currentRouteName()=="sale_your_product")
                <div class="navbar-page-title-dropdown">
                    Sell a product
                </div>
                @elseif(Route::currentRouteName()=="seller_sold_item")
                <div class="navbar-page-title-dropdown">
                    Sold Items
                </div>
                @elseif(Route::currentRouteName()=="wishlist")
                <div class="navbar-page-title-dropdown">
                    Wishlist
                </div>
                @elseif(Route::currentRouteName()=="checkout")
                <div class="navbar-page-title-dropdown">
                    Checkout
                </div>
                @elseif(Route::currentRouteName()=="contactus")
                <div class="navbar-page-title-dropdown">
                    Contact Us
                </div>
                @elseif(Route::currentRouteName()=="copyright-policy")
                <div class="navbar-page-title-dropdown">
                    Copyright
                </div>
                @elseif(Route::currentRouteName()=="disclaimer")
                <div class="navbar-page-title-dropdown">
                    Disclaimer
                </div>
                @elseif(Route::currentRouteName()=="privacy_policy")
                <div class="navbar-page-title-dropdown">
                    Privacy
                </div>
                @elseif(Route::currentRouteName()=="return-refund")
                <div class="navbar-page-title-dropdown">
                    Return & Refund
                </div>
                @elseif(Route::currentRouteName()=="shipping-policy")
                <div class="navbar-page-title-dropdown">
                    Shipping
                </div>
                @elseif(Route::currentRouteName()=="terms_condition")
                <div class="navbar-page-title-dropdown">
                    Terms & Conditions
                </div>
                @elseif(Route::currentRouteName()=="vendor-agreement-policy")
                <div class="navbar-page-title-dropdown">
                    Seller Agreement
                </div>
                @elseif(Route::currentRouteName()=="faq")
                <div class="navbar-page-title-dropdown">
                    FAQ Plan
                </div>
                @elseif(Route::currentRouteName()=="services_list_page")
                <div class="navbar-page-title-dropdown">
                    Our Services
                </div>
                @elseif(Route::currentRouteName()=="about_us")
                <div class="navbar-page-title-dropdown">
                    About Us
                </div>

                @endif

                <ul class="navbar-nav ml-auto">

                    <li class="nav-item {!! request()->route()->getName() == 'home' ? 'active': '' !!}">
                    <!-- <a class="nav-link"   @if(Route::currentRouteName()=="news")  style="color:#fff;"  @endif  href="{{route('home')}}">Home <span class="sr-only">(current)</span></a> -->
                        <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item {!! request()->route()->getName() == 'shop_products' ? 'active': '' !!} dropdown">
                        <a class="nav-link"  href="{{route('shop_products')}}" id="navbarDropdown">
                            Shop
                        </a>
                        <div class="dropdown-menu  shop-dropdown-menu <?php if(Auth::check()) echo 'account';?>" aria-labelledby="navbarDropdown">
                            <div class="wrapper">
                                <?php $shop_cats = App\Models\ShopCategory::whereRaw("flags & ? = ?", [App\Models\ShopCategory::FLAG_ACTIVE, App\Models\ShopCategory::FLAG_ACTIVE])->where('parent_id',0)->get()->toArray();
                                foreach ($shop_cats as $key => $shop_cat) {

                                    $child_cats = App\Models\ShopCategory::whereRaw("flags & ? = ?", [App\Models\ShopCategory::FLAG_ACTIVE, App\Models\ShopCategory::FLAG_ACTIVE])->where('parent_id',$shop_cat['id'])->orderBy('shop_cat_name', 'ASC')->get()->toArray()
                                ?>

                         <?php if(!empty($child_cats)) { ?>
                               <div class="category">
                                <h6 class="sub-heading">
                                 
                                 <?php
                                 $gendor_type ="";
                                  
                                 $shop_cat_slug = $shop_cat['shop_cat_slug'];

                                  if ($shop_cat_slug == 'man') {
                                      $gendor_type = 'menswear';
                                  } elseif ($shop_cat_slug == 'woman') {
                                      $gendor_type = 'womenswear';
                                  } elseif ($shop_cat_slug == 'children') {
                                      $gendor_type = 'children';
                                  } else {
                                      // Default value if $shop_cat_slug doesn't match any of the specified conditions
                                      $gendor_type = 'unknown';
                                  }
                                  
                                   ?>
                                  
                                  <a href="{{route('product.category', [$gendor_type])}}">
                                        <?php echo $shop_cat['shop_cat_name'];?></a>
                               </h6> 
                          
                                 
                             
                             
                              <?php foreach ($child_cats as $key => $child_cat) { ?>

                                  <?php   

                                      $gender_name="";

                                      if ($child_cat[ 'parent_id'] == 1) {
                                          $gender_name = "man";
                                      } elseif ($child_cat['parent_id'] == 2) {
                                          $gender_name = "woman";
                                      } elseif ($child_cat['parent_id'] == 3) {
                                          $gender_name = "children";
                                      }else{
 
                                      }       
                                  ?>


                               <a href="{{ route('product.category', ['gender_slug' => $gender_name, 'category_slug' => $child_cat['shop_cat_slug']]) }}" class="dropdown-item">
                                  <?php if($child_cat['shop_cat_name'] == "Trouser") { 
                                      echo $child_cat['shop_cat_name'] . "s"; 
                                  } else {  
                                      echo $child_cat['shop_cat_name'];
                                  } ?>
                              </a>

                              <?php } ?>
                              
                              
                                    </div>
                                    <?php } ?>
                                <?php } ?>

                                <div class="category">
                                    <h6 class="sub-heading"><a href="{{route('view-all-brands')}}">BRANDS</a></h6>
                                    <?php $brands = App\Models\Brand::whereRaw("flags & ? = ?", [App\Models\Brand::FLAG_ACTIVE, App\Models\Brand::FLAG_ACTIVE])->orderBy('brand_name','asc')->take(18)->get()->toArray();
                                    foreach ($brands as $key => $brand) {
                                    ?>
                                    <a href="{{route('product.brand',[$brand['brand_slug']])}}" class="dropdown-item"><?php echo $brand['brand_name']; ?></a>
                                    <?php }?>
                                    <a href="{{route('view-all-brands')}}" class="dropdown-item">View All Brands</a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item  {!! request()->route()->getName() == 'news' ? 'active': '' !!}">
                        <a class="nav-link"  href="{{route('news')}}">News</a>
                    </li>
                    <li class="nav-item  {!! request()->route()->getName() == 'services' ? 'active': '' !!}">
                        <a class="nav-link"  href="{{route('services_list_page')}}">Services</a>
                    </li>
                    {{-- <li class="nav-item dropdown {!! request()->route()->getName() == 'services' ? 'active': '' !!}" >
                        <a class="nav-link"  href="{{route('services_list_page')}}" id="navbarServiceDropdown">Services</a>
                        <div class="dropdown-menu" aria-labelledby="navbarServiceDropdown">
                           <a class="dropdown-item " href="{{route('services_list_page')}}">Personal Shopping</a>
                           <a class="dropdown-item " href="{{route('services_list_page')}}">Sourcing</a>
                           <a class="dropdown-item " href="{{route('services_list_page')}}">Styling </a>
                        </div>
                    </li> --}}

                    @if(Auth::check())
                        <li
                            class="nav-item  dropdown  {!! request()->route()->getName() == 'update_account' ? 'active': '' !!} ">
                            <a class="nav-link" href="{{route('update_account')}}" id="navbarDropownd">
                                Dashboard
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                @if(auth()->user()->user_type == 1)
                                    <a class="dropdown-item  " href="{{route('update_account')}}">Account Details</a>
                                    <a class="dropdown-item  " href="{{route('edit_address')}}">Addresses</a>
                                    @if(Auth::user()->affiliate_status == 1)
                                        <a class="dropdown-item" href="{{route('get_affiliate')}}">Affiliate</a>
                                    @endif
                                    <a class="dropdown-item  " href="{{route('bank_detail')}}">Bank Information</a>
                                    <a class="dropdown-item" href="{{route('my_list')}}"> My Listings</a>
                                    <a class="dropdown-item  " href="{{route('user_subscribe')}}">My Subscriptions</a>
                                    <a class="dropdown-item  " href="{{route('user_orders')}}">Orders</a>

                                @else
                                    <a class="dropdown-item  " href="{{route('update_account')}}">Account details</a>
                                    <a class="dropdown-item  " href="{{route('edit_address')}}">Addresses</a>
                                    <a class="dropdown-item  " href="{{route('bank_detail')}}">Bank Information</a>
                                    <a class="dropdown-item  " href="{{route('user_subscribe')}}">My Subscriptions</a>
                                    <a class="dropdown-item  " href="{{route('user_orders')}}">Orders</a>
                                    @if(auth()->user()->user_type != 1)
                                        <a class="dropdown-item  " href="{{route('become.vendor')}}">Start Selling</a>
                                    @endif

                                @endif
                                <a class="dropdown-item " href="{{route('logout')}}">Logout</a>
                            </div>
                        </li>

                        @if(auth()->user()->user_type==1)
                            <li class="nav-item {!! request()->route()->getName() == 'start_selling_home' ? 'active': '' !!}">
                                <a class="nav-link" href="{{route('sale_your_product')}}">Sell</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item {!! request()->route()->getName() == 'start_selling_home' ? 'active': '' !!}">
                            <a class="nav-link" href="{{route('start_selling_home')}}">Start Selling</a>
                        </li>

                        @if(isset(auth::user()->id))


                            <li class="nav-item ">
                                <a class="nav-link"  href="{{route('login.login')}}">Dashboard</a>
                            </li>

                        @endif
                        <li class="nav-item {!! request()->route()->getName() == 'login.login' ? 'active': '' !!}">
                            <a class="nav-link" href="{{route('login.login')}}">Sign In</a>
                        </li>
                    @endif

                </ul>
            </div>
            <ul class="navbar-nav action-list">
                <li class="nav-item nav-search">
                    <a class="nav-link"    href="#" data-toggle="modal" data-target="#search-popup1"><i
                            class="uil uil-search" ></i></a>
                </li>
                <li class="nav-item nav-button wishlist-btn">
                    <a class="nav-link"  href="{{route('wishlist')}}"><i class="uil uil-heart"></i>
                        <?php
                        if(auth()->check()){
                        $wishlist = App\Models\Wishlist::where('user_id',auth()->user()->id)->get();
                        ?>
                        <span class="badge wish"><?php echo count($wishlist);?></span>
                        <?php
                        }
                        ?>


                    </a>

                </li>
                <li class="nav-item nav-button cart-btn">
                    <a class="nav-link" href="#"><i class="uil uil-shopping-cart-alt"></i><span
                            class="badge">@if(isset($cart_data[0])) {{count($cart_data ?? 0)}} @else 0 @endif</span></a>
                </li>
            </ul>
            <a href="#" class="btn mob-sidebar-trigger"><i class="fas fa-ellipsis-v"></i></a>
        </nav>


        <div class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
             id="search-popup1">
            <div class="modal-dialog  modal-dialog-centered" role="document">
                <div class="modal-content" >
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="search-wrapper">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control sea" onkeypress="handleKeyPress1(event)" placeholder="Search.." >
                                    <div class="input-group-append">

                                        <span class="input-group-text ut-a" ><i
                                                class="uil uil-search"></i></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Banner code was here-->

</header>

<?php $news_ticker = App\Models\NewsTicker::where('flags', 1)->first(); ?>
@if(Route::currentRouteName() == "home" && $news_ticker)
    <div class="message-bar" style="background: {{$news_ticker->bg_color}}; color: {{$news_ticker->text_color}}">
        <marquee onmouseover="this.stop();" onmouseout="this.start();">
            <strong>{{$news_ticker->title}}</strong>&nbsp;{{trim($news_ticker->content)}}
        </marquee>
    </div>
@endif

<aside class="mobile-nav">
    <div class="heading">
        <h5>Navigations</h5>
        <a href="javascript:void(0)" class="btn close-mobile-nav"><i class="uil uil-times"></i></a>
    </div>
    <div class="nav-list">
        <ul class="main-list">
            <li><a href="{{route('home')}}">Home</a></li>

            <li>
                <a data-toggle="collapse" href="#shopMainCollapse" class="icon-wrapper"><i class="fas fa-chevron-down"></i> Shop </a>

                <div class="collapse" id="shopMainCollapse">
                    <ul class="inner-list">
                        <li><a class="  {!! request()->route()->getName() == 'shop_products' ? 'active': '' !!}"
                            href="{{route('shop_products')}}">All Products</a></li>
                        <li>
                            <?php $parent_categories = App\Models\ShopCategory::whereRaw("flags & ? = ?", [App\Models\ShopCategory::FLAG_ACTIVE, App\Models\ShopCategory::FLAG_ACTIVE])->where('parent_id',0)->get()->toArray();
                            foreach ($parent_categories as $key => $parent_category) { ?>

                            <?php $child_cats = App\Models\ShopCategory::whereRaw("flags & ? = ?", [App\Models\ShopCategory::FLAG_ACTIVE, App\Models\ShopCategory::FLAG_ACTIVE])->where('parent_id',$parent_category['id'])->get()->toArray(); ?>
                            <?php if(count($child_cats)>0){ ?>
                            <a data-toggle="collapse" href="#<?php echo $parent_category['shop_cat_name'];?>"
                               class="icon-wrapper"><i class="fas fa-chevron-down"></i>
                                <?php echo $parent_category['shop_cat_name'];?></a>
                                <div class="collapse" id="<?php echo $parent_category['shop_cat_name'];?>">
                                    <ul class="inner-list">
                                        <?php foreach ($child_cats as $key => $child_cat) { ?>
                                     
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php } ?>
                            <?php } ?>
                        </li>
                        <li>
                            <a data-toggle="collapse" href="#brands" class="icon-wrapper"><i
                                    class="fas fa-chevron-down"></i> Brands</a>
                            <div class="collapse" id="brands">
                                <ul class="inner-list">
                                    <?php $brands = App\Models\Brand::whereRaw("flags & ? = ?", [App\Models\Brand::FLAG_ACTIVE, App\Models\Brand::FLAG_ACTIVE])->get()->toArray();
                                    foreach ($brands as $key => $brand) {
                                    ?>
                                    <li> <a href="#" class="dropdown-item"><?php echo $brand['brand_name']; ?></a></li>
                                    <?php }?>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </li>
            <li><a href="{{route('news')}}">News</a></li>
            <li><a href="{{route('services_list_page')}}">Services</a></li>

            {{-- <li class="nav-item dropdown {!! request()->route()->getName() == 'services' ? 'active': '' !!}" >
                <a data-toggle="collapse" href="#navbarServiceMobDropdown" class="icon-wrapper"><i
                    class="fas fa-chevron-down"></i> Services </a>
                    <div class="collapse" id="navbarServiceMobDropdown">
                        <ul class="inner-list">
                            <li><a class="" href="{{route('services_list_page')}}">Personal Shopping</a></li>
                            <li><a class="" href="{{route('services_list_page')}}">Sourcing</a></li>
                            <li><a class="" href="{{route('services_list_page')}}">Styling</a></li>    
                        </ul>
                    </div>
            </li> --}}

            <li>
                <a data-toggle="collapse" href="#dashboardCollapse" class="icon-wrapper"><i
                        class="fas fa-chevron-down"></i> Dashboard </a>
                <div class="collapse" id="dashboardCollapse">
                    <ul class="inner-list">
                        <li> <a class="  {!! request()->route()->getName() == 'update_account' ? 'active': '' !!}"
                                href="{{route('update_account')}}">Account details</a></li>
                        <li><a class="  {!! request()->route()->getName() == 'edit_address' ? 'active': '' !!}"
                               href="{{route('edit_address')}}">Addresses</a></li>
                        @if(Auth::check())
                            @if(Auth::user()->affiliate_status == 1)
                            <li><a class="dropdown-item {!! request()->route()->getName() == 'get_affiliate' ? 'active': '' !!}" href="{{route('get_affiliate')}}">Affiliate</a></li>
                           @endif
                        @endif

                        <li><a class="  {!! request()->route()->getName() == 'shop_products' ? 'active': '' !!}"
                               href="bank-information.html">Bank Information</a></li>
                        <li><a class="  {!! request()->route()->getName() == 'shop_products' ? 'active': '' !!}"
                               href="subscriptions.html">My Subscriptions</a></li>
                        <li><a class="  {!! request()->route()->getName() == 'user_orders' ? 'active': '' !!}"
                               href="{{route('user_orders')}}">Orders</a></li>
                        <li><a class="  {!! request()->route()->getName() == 'become.vendor' ? 'active': '' !!}"
                               href="{{route('become.vendor')}}">Start Selling</a></li>
                        <li class="nav-item {!! request()->route()->getName() == 'login.login' ? 'active': '' !!}">
                            <a class="nav-link" href="{{route('login.login')}}">Sign In</a>
                        </li>
                        <li><a class="" href="{{route('logout')}}">Logout</a></li>

                    </ul>

                </div>
            </li>
        </ul>
    </div>
</aside>

<aside class="sidebar-cart">
    <div class="heading">
        <h5>Shopping Bag <span class="badge">@if(isset($cart_data[0])) {{count($cart_data ?? 0)}} @else 0 @endif</span></h5>
        <a href="javascript:void(0)" class="btn close-sidebar-cart"><i class="uil uil-times"></i></a>
    </div>


    {{-- <div class="cart-body"> --}}
    <div class="empty-cart">
        <?php if(isset($cart_data) && count($cart_data)==0){?>
        <img src="{{asset('assets/images/empty-cart.png')}}" class="img-fluid">
        <h6>no products in the cart</h6>
        <?php }?>
    </div>

    <?php $sub_total = 0; $delivery_charges = 0; $ship = 0; ?>

    <div class="cart-items-wrapper">
        @if(isset($cart_data[0]))
            @foreach($cart_data as $carts)
                @if((float)$carts->sale_price > 0)
                    <?php $sub_total = $sub_total + $carts->sale_price * (int)$carts->quantity ;
                    $ship = $ship + $carts->ship; ?>
                @elseif((float)$carts->sale_price_sizes > 0)
                    <?php $sub_total= $sub_total + $carts->sale_price_sizes * (int)$carts->quantity; ?>
                @else
                    <?php $sub_total= $sub_total + $carts->regular_price * (int)$carts->quantity; ?>
                @endif

                <?php  $delivery_charges = $delivery_charges + (int)$carts->delivery_charges;  ?>

                <div class="cart-item card_delete_remove_{{$carts->id}}">
                    <div class="img-box">

                        <?php  $p = ""; ?>
                        @if($carts->parent_id>0)

                            <?php $p=\App\Models\Product::where("id",$carts->parent_id)->first(); ?>
                            <?php $product_type =\App\Models\Product::where("id",$carts->product_id)->first();
                            if($product_type != null){
                      		if($product_type->product_type == 2){
                            ?>
                                <a href="#"><img src="{{ url('/').'/storage/seller-product/'.$carts->product_id.'/'.$carts->feature_image;}}" height="10px" width="90px" class="img-fluid"></a>
                            <?php }else{ ?>
                                <a href="#"><img src="{{ url('/').'/storage/product/'.$p->id.'/'.$p->feature_image;}}" height="10px" width="90px" class="img-fluid"></a>
                            <?php }
                            }                  
	                      ?>
                           
                        @else
                            <a href="#"><img src="{{ url('/').'/storage/product/'.$carts->product_id.'/'.$carts->feature_image;}}" height="10px" width="90px" class="img-fluid"></a>
                        @endif
                    </div>

                    <div class="details">
                       <h6 class="product-title">
    @if(isset($carts))
        {{ gettype($carts) }} {{-- Add this line to check the type of $carts --}}
        {{ $carts->product_name }}
    @elseif(isset($p))
        {{ gettype($p) }} {{-- Add this line to check the type of $p --}}
        {{ $p->product_name }}
    @else
        No product available
    @endif
</h6>


                        <span class="price-heading">
                               <b>
                                   <span class="quantity">{{$carts->quantity}}</span> x
                                   <span class="price">
                                       @if((float)$carts->sale_price > 0)
                                           £{{ number_format($carts->sale_price, 2) ?? ""}}
                                       @elseif((float)$carts->sale_price_sizes > 0)
                                           £{{ number_format($carts->sale_price_sizes, 2) ?? ""}}
                                       @else
                                           £{{ number_format($carts->regular_price, 2) ?? ""}}
                                       @endif
                                   </span>
                               </b>
                           </span>

                        <br>

                        <span class="price-heading">
                            <b><span class="quantity">Size :</span> </b>

                            @if($carts->parent_id > 0)
                                <span class="price-heading">
                                        <span class="quantity">{{$carts->size ?? ""}}</span>
                                </span>
                            @else
                                <?php $p = \App\Models\Size::where("id", $carts->size_id)->first(); ?>

                                <span class="price-heading">
                                        <b><span class="quantity">{{$p->size ?? ""}}</span> </b>
                                </span>
                            @endif
                         </span>
                    </div>

                    <a href="javascript:void(0)" data-cart_id="{{$carts->id}}" class="btn cancel-btn remove_cart_item"><i class="uil uil-times"></i></a>
                </div>

            @endforeach
        @endif
    </div>
    </div>

    @if(isset($cart_data[0]))
        <div class="cart-footer">
            {{-- <div class="price">
                <h5>Delivery Charges :</h5>
                <h5 class="total-price">£{{ $ship ??"" }}</h5>
            </div> --}}

            <div class="price">
                <h5>subtotal :</h5>
                <h5 class="total-price">£{{ number_format($sub_total,2) ?? ""}}</h5>
            </div>

            {{-- <div class="price">
                <h5>Total :</h5>
                <h5 class="total-price">£{{ number_format($sub_total+ $ship,2) ?? ""}}</h5>
            </div> --}}

            <a href="{{route('checkout')}}" class="btn checkout-btn">checkout</a>

        </div>
    @endif
</aside>


<script>

    function handleKeyPress(e)
    {
        var key=e.keyCode || e.which;
        if (key==13)
        {
            var search = $("#search").val();
            var url='{{route("search_title")}}'+'?sort=default&&search='+search;
            window.location=url;
        }
    }

    function handleKeyPress1(e)
    {
        var key=e.keyCode || e.which;
        if (key==13)
        {
            const sea=$(".sea").val();
            var url='{{route("search_title")}}'+'?sort=default&&search='+sea;
            window.location=url;
        }
    }

    $(document).ready(function(){

        $('.home-first').click(function(){

            var search = $("#search").val();
            var url='{{route("search_title")}}'+'?sort=default&&search='+search;
            window.location=url;

        });

        $(".ut-a").click(function(){

            const sea=$(".sea").val();
            var url='{{route("search_title")}}'+'?sort=default&&search='+sea;
            window.location=url;

        });
    });






    // var input = document.getElementById("search");

    // // Execute a function when the user presses a key on the keyboard
    // input.addEventListener("keypress", function(event) {
    //   // If the user presses the "Enter" key on the keyboard
    //   if (event.key === "Enter") {

    //     alert('Ana');
    //         var search = $("#search").val();
    //         var url='{{route("search_title")}}'+'?sort=default&&search='+search;
    //         window.location=url;


    //     // event.preventDefault();
    //     // // Trigger the button element with a click
    //     // document.getElementById("myBtn").click();
    //   }
    // });


    // $(".search_result_all1").change(function(){
    //     var val= $(".search_result_all1").val();
    //     $(".search_result_all2").val(val);
    //     $(".search_result_all3").val(val);
    // });
    // $(".search_result_all2").change(function(){
    // var val= $(".search_result_all2").val();
    // $(".search_result_all1").val(val);
    // $(".search_result_all3").val(val);
    // });
    // $(".search_result_all3").change(function(){
    // var val= $(".search_result_all3").val();
    // $(".search_result_all1").val(val);
    // $(".search_result_all2").val(val);
    // });





</script>
