<div class="page-hdr">
    <div class="row align-items-center h-100">
        <div class="page-hdr-left h-100">
            <!-- Logo Container -->
            <div  id="logo">
                <!-- <div class="tbl-cell logo-icon">
                                <a href="{{route('admin.dashboard')}}"><img src="{{asset('admin/images/icon.png')}}" alt=""></a>
                            </div> -->
                <div class="logo">
                    <a href="{{route('admin.dashboard')}}"><img src="{{asset('admin/images/market-place-logo.png')}}"></a>
                </div>
            </div>
        </div>

        <div class="page-hdr-right">
            <div class="page-hdr-desktop ">
                <div>
                    @if(Route::currentRouteName()=="vendors") <h5 class="heading-size">All Sellers</h5>
                    @elseif(Route::currentRouteName()=="add.product") <h5 class="heading-size">Add Product</h5>
                    @elseif(Route::currentRouteName()=="setting.seller_commission") <h5 class="heading-size">Seller Payments</h5>
                    @elseif(Route::currentRouteName()=="product.by.id") <h5 class="heading-size">Update Product</h5>
                    @elseif(Route::currentRouteName()=="product-catgory") <h5 class="heading-size">All Products</h5>
                    @elseif(Route::currentRouteName()=="add.brand") <h5 class="heading-size">Add a Brand</h5>
                    @elseif(Route::currentRouteName()=="news-edit") <h5 class="heading-size">Add News</h5>
                    @elseif(Route::currentRouteName()=="cate_brand") <h5 class="heading-size">Admin Products</h5>
                    @elseif(Route::currentRouteName()=="size-home") <h5 class="heading-size">All Size</h5>
                    @elseif(Route::currentRouteName()=="add.size") <h5 class="heading-size">Add Size</h5>
                    @elseif(Route::currentRouteName()=="add.news") <h5 class="heading-size">Add News</h5>
                    @elseif(Route::currentRouteName()=="edit.category") <h5 class="heading-size">Category Details</h5>
                    @elseif(Route::currentRouteName()=="add.shop.category") <h5 class="heading-size">Add a Category</h5>
                    @elseif(Route::currentRouteName()=="news_all") <h5 class="heading-size">All News</h5>
                    @elseif(Route::currentRouteName()=="news_ticker_home") <h5 class="heading-size">News Ticker</h5>
                    @elseif(Route::currentRouteName()=="brand.with.id") <h5 class="heading-size" >Edit Brand Details</h5>
                    @elseif(Route::currentRouteName()=="show.vendor.request") <h5 class="heading-size">Seller Requests</h5>
                    @elseif(Route::currentRouteName()=="vendor_product_detail") <h5 class="heading-size">Product Details</h5>
                    @elseif(Route::currentRouteName()=="setting.weight") <h5 class="heading-size">Commission Fee</h5>
                    @elseif(Route::currentRouteName()=="order.SellerOrders") <h5 class="heading-size">Seller Orders</h5>
                    @elseif(Route::currentRouteName()=="order.AdminOrders") <h5 class="heading-size">Admin Orders</h5>
                    @elseif(Route::currentRouteName()=="order.index") <h5 class="heading-size">All Orders</h5>
                    @elseif(Route::currentRouteName()=="FinancialStatement") <h5 class="heading-size">Statement of Financial Position</h5>
                    @elseif(Route::currentRouteName()=="admin.dashboard") <h5 class="heading-size">Dashboard</h5>
                    @elseif(Route::currentRouteName()=="users") <h5 class="heading-size"> All Users</h5>
                    @elseif(Route::currentRouteName()=="dashboard.vendors_products") <h5 class="heading-size">Seller’s Products</h5>
                    @elseif(Route::currentRouteName()=="IncomeStatement") <h5 class="heading-size">Income Statement</h5>
                    @elseif(Route::currentRouteName()=="filter-category") <h5 class="heading-size">{{$title}}</h5>
                    @elseif(Route::currentRouteName()=="brand-home") <h5 class="heading-size">All Brands</h5>
                    @elseif(Route::currentRouteName()=="product.brands") <h5 class="heading-size">Admin Products</h5>
                    @elseif(Route::currentRouteName()=="edit.user") <h5 class="heading-size">Sellers Details</h5> @endif
                </div>
                <div>
                    <div class="page-menu menu-dropdown-wrapper menu-user">
                        <a class="user-link">
                            <span class="tbl-cell user-name pr-3">Hello <span class="pl-2">Administration</span></span>
                            <span class="tbl-cell avatar"><img src="{{asset('admin/images/market-place-logo.png')}}" alt=""></span>
                        </a>
                        <div class="menu-dropdown menu-dropdown-right menu-dropdown-push-right">
                            <div class="arrow arrow-right"></div>
                            <div class="menu-dropdown-inner">
                                <div class="menu-dropdown-head pb-3">
                                    <div class="tbl-cell">
                                        <img src="{{asset('admin/images/market-place-logo.png')}}" alt="">
                                        <!-- <i class="fa fa-user-circle"></i> -->
                                    </div>
                                    <div class="tbl-cell pl-2 text-left">
                                        <p class="m-0 font-18">
                                        <p class="m-0 font-14">Administration</p>
                                    </div>
                                </div>
                                <div class="menu-dropdown-body">
                                    <ul class="menu-nav">
                                        <li><a href="#"><i class="icon-event"></i><span>My Events</span></a></li>
                                        <li><a href="#"><i class="icon-notebook"></i><span>My Notes</span></a></li>
                                        <li><a href="#"><i class="icon-user"></i><span>My Profile</span></a></li>
                                        <li><a href="#"><i class="icon-globe-alt"></i><span>Client Portal</span></a></li>
                                    </ul>
                                </div>
                                <div class="menu-dropdown-footer text-right">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();" class="btn btn-outline btn-primary btn-pill btn-outline-2x font-12 btn-sm" style="color: #ffffff;">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="page-menu menu-dropdown-wrapper menu-notification">
                        <a><i class="icon-bell"></i><span class="notification">20</span></a>
                        <div class="menu-dropdown menu-dropdown-right menu-dropdown-push-right">
                            <div class="arrow arrow-right"></div>
                            <div class="menu-dropdown-inner">
                                <div class="menu-dropdown-head">Notification</div>
                                <div class="menu-dropdown-body">
                                    <ul class="timeline m-0">
                                        <li>
                                            <a href="#" target="_blank" class="timeline-container">
                                                <div class="arrow"></div>
                                                <div class="description">Wallet Adddes </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" class="timeline-container">
                                                <div class="arrow"></div>
                                                <div class="description">Coin Transferred from BTC<span class="badge badge-danger badge-pill badge-sm">Unpaid</span></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" class="timeline-container">
                                                <div class="arrow"></div>
                                                <div class="description">BTC bought</div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" class="timeline-container">
                                                <div class="arrow"></div>
                                                <div class="description">Server Restarted <span class="badge badge-success badge-pill badge-sm">Resolved</span></div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" class="timeline-container">
                                                <div class="arrow"></div>
                                                <div class="description">New order received</div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-menu menu-dropdown-wrapper menu-quick-links">
                        <a><i class="icon-grid"></i></a>
                        <div class="menu-dropdown menu-dropdown-right menu-dropdown-push-right">
                            <div class="arrow arrow-right"></div>
                            <div class="menu-dropdown-inner">
                                <div class="menu-dropdown-head">Quick Links</div>
                                <div class="menu-dropdown-body p-0">
                                    <div class="row m-0 box">
                                        <div class="col-6 p-0 box">
                                            <a href="#">
                                                <i class="icon-emotsmile"></i>
                                                <span>New Contact</span>
                                            </a>
                                        </div>
                                        <div class="col-6 p-0 box">
                                            <a href="#">
                                                <i class="icon-docs"></i>
                                                <span>New Invoice</span>
                                            </a>
                                        </div>
                                        <div class="col-6 p-0 box">
                                            <a href="#">
                                                <i class="icon-calculator"></i>
                                                <span>New Quote</span>
                                            </a>
                                        </div>
                                        <div class="col-6 p-0 box">
                                            <a href="#">
                                                <i class="icon-rocket"></i>
                                                <span>New Expense</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-menu">
                        <a class="open-sidebar-right"><i class="icon-settings"></i><span></span></a>
                    </div>
                </div>
            </div>
            <div class="page-hdr-mobile">
                <div class="page-menu open-mobile-search">
                    <a href="#"><i class="icon-magnifier"></i></a>
                </div>
                <div class="page-menu open-left-menu">
                    <a href="#"><i class="icon-menu"></i></a>
                </div>
                <div class="page-menu oepn-page-menu-desktop">
                    <a href="#"><i class="icon-options-vertical"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
