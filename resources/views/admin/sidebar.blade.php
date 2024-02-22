<div class="menu-wrapper">
    <div class="menu">
        <!-- Menu Container -->
        <ul>
            <!-- <li class="menu-title">Dashboard</li> -->
            <li class="">
                <a href="{{route('admin.dashboard')}}"><span>Dashboard</span><i class="arrow"></i></a>
            </li>
          
          
          	 
          
          
            <!-- <li class="menu-title">Users Manage</li> -->
            <li class="has-sub {!! request()->route()->getName() == 'vendors' ? 'active': '' !!}">
                <a><span>Users</span><i class="arrow"></i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{route('affiliates')}}"><span>All Affiliates</span></a>
                    </li>
                    <li>
                        <a href="{{route('vendors')}}"><span>All Sellers</span></a>
                    </li>
                    <li>
                        <a href="{{route('users')}}"><span>All Users</span></a>
                    </li>
                    <li>
                        <a href="{{route('show.vendor.request')}}"><span>Seller Requests</span></a>
                    </li>
                </ul>
            </li>
          
          
          
            <!-- <li class="menu-title">Brands</li> -->
            <li>
                <a href="{{route('brand-home')}}"><span>Brands</span><i class="arrow"></i></a>
                {{--  <ul class="sub-menu">
                    <li>
                        <a href="{{route('brand-home')}}"><span>Brands</span></a>
                    </li>

                </ul> --}}
            </li>
            <!-- <li class="menu-title">Product Manage</li> -->
            <li class="has-sub">
                <a><span>Products</span><i class="arrow"></i></a>
                <ul class="sub-menu">

                    <li>
                        <a href="{{route('product.brands')}}"><span>Admin Products</span></a>
                    </li>
                  
                    <li>
                        <a href="{{route('abandoned-carts')}}"><span>Abandoned carts</span></a>
                    </li>
                  
                  
                   
                  
                  
                  
                    <li>
                        <a href="{{route('import.product')}}"><span>Bulk Import Products</span></a>
                    </li>
                    <li>
                        <a href="{{route('dashboard.vendors_products')}}"><span>Seller Product</span></a>
                    </li>
                </ul>
            </li>
            <li class="has-sub">
                <a  href="{{route('shop-category')}}"><span>Categories </span><i class="arrow"></i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{route('filter-category',1)}}"><span>Menswear</span></a>
                    </li>
                    <li>
                        <a href="{{route('filter-category',2)}}"><span>Womenswear</span></a>
                    </li>
                    <li>
                        <a href="{{route('filter-category',3)}}"><span>Children</span></a>
                    </li>

                </ul>
            </li>
            <li class="has-sub">
                <a><span>Accounting </span><i class="arrow"></i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{route('IncomeStatement')}}"><span>Income Statement</span></a>
                    </li>
                    <li>
                        <a href="{{route('FinancialStatement')}}"><span>Statement of Financial Position</span></a>
                    </li>
                </ul>
            </li>
            <li class="has-sub">
                <a><span>Orders </span><i class="arrow"></i></a>
                <ul class="sub-menu">
                    <!-- <li>
                        <a href="{{route('order.today')}}"><span>Today's Order</span></a>
                    </li> -->
                   <li>
                        <a href="{{route('order.index')}}"><span>All Orders</span></a>
                    </li>
                    <li>
                        <a href="{{route('order.AdminOrders')}}"><span>Admin Orders</span></a>
                    </li>
                    <li>
                        <a href="{{route('order.SellerOrders')}}"><span>Seller's Orders</span></a>
                    </li>
                </ul>
            </li>
            <li class="has-sub">
                <a><span>News </span><i class="arrow"></i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{route('news_all')}}"><span>All News</span><i class="arrow"></i></a>
                    </li>                   
                </ul>
            </li>
            <li class="has-sub">
                <a><span>Size</span><i class="arrow"></i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{route('size.brands')}}"><span>Size</span></a>
                    </li>
                    <li>
                        <a href="{{route('size.importSize')}}"><span>Import Size</span></a>
                    </li>
                </ul>
            </li>
            {{-- <li>
                <a href="{{route('size.brands')}}"><span>Size</span> <i class="arrow"></i></a>
            </li> --}}
            <li >
                <a href="{{route('order.today')}}"><span>Wishlist Users</span> <i class="arrow"></i> </a>
            </li>
            {{-- <li class="has-sub">
                    <a><span> Pages </span><i class="arrow"></i></a>
                    <ul class="sub-menu">

                        <li>
                            <a href="{{route('privacy.policy')}}"><span>Privacy Policy</span></a>
                        </li>
                    </ul>
                </li>
            --}}
            <li class="has-sub">
                <a><span>Settings </span><i class="arrow"></i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{route('news_ticker_home')}}"><span>Homepage</span></a>
                    </li>
                  
                  	  

                    <li>
                        <a href="{{ route('videos.index') }}"><span>Home page video</span></a>
                    </li>
                    
             
                  
                  
                  
                 <li>
                        <a href="{{route('setting.store')}}"><span>Home Page Setting</span></a>
                    </li>
                    <li>
                        <a href="{{route('coupon.home')}}"><span>Discount</span></a>
                        <li>
                                <a href="#"><span>Affiliate</span></a>
                            </li>
                    </li>
                    <li>
                        <a href="{{route('setting.weight')}}"><span>commission settings</span></a>
                    </li>
                    <li>
                        <a href="{{route('setting.seller_commission')}}"><span>Seller Payments</span></a>
                    </li>
                   {{--  <li>
                        <a href="{{route('setting.shipping')}}"><span>Fixed Shipping Price</span></a>
                    </li>--}}
                </ul>
            </li>
            <li class="has-sub">
                <a><span>About Us </span><i class="arrow"></i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{route('aboutus.content')}}"><span>About</span></a>
                    </li>
                    <li>
                        <a href="{{route('aboutus.banner')}}"><span>Images Setting</span></a>
                    </li>                    
                    <li>
                        <a href="{{route('aboutus.ourteam')}}"><span>Meet Our Team</span></a>
                    </li>
                    <li>
                        <a href="{{route('aboutus.keymetrics')}}"><span>Key Metrics</span></a>
                    </li>
                    <li>
                        <a href="{{route('aboutus.setting')}}"><span>Settings</span></a>
                    </li>
                </ul>
            </li>
  
  				
  
         
  
  
  
  
            <li><a href="{{ route('logout')}}"><span>Logout</span></a></li>
        </ul>
    </div>
</div>
