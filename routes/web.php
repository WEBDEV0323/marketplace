<?php

use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ShopCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\AboutusController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ImportProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\IncomeController;
use Illuminate\Support\Facades\Mail;


use App\Http\Controllers\VideoController;

use App\Http\Controllers\AbandonedCartsController;

use App\Mail\SendSignUpMail;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 Route::get('/test123', function () {
   \Artisan::call('config:clear');
   //config:clear

   //return view('welcome');
});




Route::delete('/delete_cartitem_row/{user_id}/{cartItemId}', [CartController::class, 'deleteCartItem'])->name('delete_cartitem_row');


//Route::get('/delete_cartitem_row/{user_id}/{cartItemId}', 'CartController@deleteCartItem')->name('delete_cartitem_row');



Route::get('clear_cache', function () {
    // \DB::connection('mysql')->statement('ALTER TABLE size_guides ADD `guide_size_title` TEXT NULL AFTER `guide_size`');
    // $getProduct_sizess = \App\Models\Product::get();
    //    if(count($getProduct_sizess) > 0){
    //     foreach($getProduct_sizess as $getProduct_sizes)
    //         $getAllExitSize =  \App\Models\Size::where('brand_id',$getProduct_sizes->brand_id)->where('shop_category_id',$getProduct_sizes->shop_category_id)->where('gender',$getProduct_sizes->gender)->pluck('id');
    //         \App\Models\ProductSize::whereNotIn('size_id', $getAllExitSize)->where('product_id',$getProduct_sizes->id)->delete();
    //     }


    \Artisan::call('storage:link');
    \Artisan::call('migrate');
    \Artisan::call('view:clear');
    \Artisan::call('route:clear');
    \Artisan::call('config:clear');
    \Artisan::call('cache:clear');

    return "Migrate, Clear, View, Route, Config, Cache sss";
});

Route::get('send-mail', function () {
    // \DB::connection('mysql')->statement('ALTER TABLE size_guides ADD `guide_size_title` TEXT NULL AFTER `guide_size`');
    // dd('test');

    $email = 'mekka2002@outlook.com';
    $name = 'DEMO';
    $phone = '123456789';
    Mail::to($email)->send(new SendSignUpMail($name, $email, $phone));

    dd(11);
    return "Mail Test";
});

Auth::routes();

//stripe event response
Route::post('stripe-callback', [StripeController::class, 'stripeCallback']);
Route::get('/stripe-payment', [StripeController::class, 'handleGet']);
Route::post('/stripe-payment', [StripeController::class, 'handlePost'])->name('stripe.payment');

Route::get('thankyou/{id}', [FrontController::class, 'thankyou'])->name('faq');
Route::get('coming_soon', [FrontController::class, 'comingSoonPage'])->name('coming_soon');

Route::get('premium-services', [FrontController::class, 'services_list_page'])->name('services_list_page');

Route::get('thankyou/{id}', [FrontController::class, 'thankyou'])->name('thankyou');
Route::get('lost_password', [FrontController::class, 'lost_password'])->name('lost_password');
Route::post('lost_email', [FrontController::class, 'lost_email'])->name('lost.process');
Route::post('change/password', [FrontController::class, 'change_passwords'])->name('change.pass');
Route::get('sizes', [FrontController::class, 'sizes'])->name('sizes');
Route::get('/search_title', [FrontController::class, 'search_title'])->name('search_title');
Route::get('paywithpaypal', [PaypalController::class, 'payWithPaypal'])->name('paywithpaypal');
Route::post('paypal', [PaypalController::class, 'postPaymentWithpaypal'])->name('paypal');
Route::get('paypal', [CheckoutController::class, 'getPaymentStatus'])->name('status');
Route::get('gender', [AdminController::class, 'gender'])->name('gender');
Route::get('category', [AdminController::class, 'category'])->name('category');


/* Route::get('handle-payment', [PayPalPaymentController::class, 'handlePayment'])->name('make.payment');
Route::get('cancel-payment', [PayPalPaymentController::class, 'paymentCancel'])->name('cancel.payment');
Route::get('payment-success', [PayPalPaymentController::class, 'paymentSuccess'])->name('success.payment');
Route::get('/paypal-pement-test', [PayPalPaymentController::class, 'view_payment']);
 */

Route::get('/user-verifiy-mail', [RegisterController::class, 'userVerifyMail'])->name('user.verify');
Route::get('user-verifiy-message', [RegisterController::class, 'userVerifyMailMessage'])->name('userverifyMessage.email');
Route::get('user-resend-verification-email', [RegisterController::class, 'userResendVerifyMailpage'])->name('resend_verification_page.email');
Route::post('/user-resend-verification', [RegisterController::class, 'userResendVerifyMail'])->name('resend_verification.email');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/register-process', [RegisterController::class, 'registerProcess'])->name('register.process');
Route::get('login',  [LoginController::class, 'login'])->name('login.login');
Route::get('verifyemail', [RegisterController::class, 'verifyemail'])->name('verifyemail');
Route::get('/verification/{code}', [RegisterController::class, 'verification'])->name('verification');
Route::post('/login-process', [LoginController::class, 'loginProcess'])->name('login.process');
Route::get('/dashboard/login', [AdminController::class, 'dashboard_login'])->name('login.dashboard');
Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

Route::get('product/{id}', [FrontController::class, 'single_page'])->name('single-products');

#Route::get('product/{id}/{brand}/{category}/{product_slug}', [FrontController::class, 'single_page'])->name('single-product');
Route::get('product/{id}/{brand}/{category}/{product_slug}', [FrontController::class, 'single_page'])->name('single-product')->where(['id' => '[0-9]+', 'cancel' => '[0-9]+', 'variation' => '[0-9]+']);

Route::get('product/preloved/page', function () {
    return view('frontend.home.product-single-preloved-page');
})->name('product.preloved');

Route::get('products/{id}/{var}', [FrontController::class, 'back'])->name('back');

Route::get('variation/{id}', [FrontController::class, 'single_product_variation'])->name('single-product-variation');

Route::get('product-new/{id}', [FrontController::class, 'single_page_new'])->name('single-product-new');
Route::get('product-used/{id}', [FrontController::class, 'single_page_used'])->name('single-product-used');


Route::post('product-seller-ajax', [FrontController::class, 'seller_product_ajax'])->name('seller-product-ajax');
Route::post('product/new', [FrontController::class, 'product_new_used'])->name('ProductNew');
Route::post('product/cart', [FrontController::class, 'add_cart'])->name('add_cart');
Route::post('admin/cart', [FrontController::class, 'admin_cart'])->name('admin_cart');

//shop routes with filters
Route::get('shop', [FrontController::class, 'shop_products'])->name('shop_products');
Route::post('shop/gender', [FrontController::class, 'shop_gender'])->name('shop.gender');
Route::post('shop/price', [FrontController::class, 'shop_price'])->name('shop.price');



#Route::get('category/{slug}', [FrontController::class, 'product_category'])->name('product.category');

Route::get('shop/{gender_slug}/{category_slug?}', [FrontController::class, 'product_category'])->name('product.category');

Route::get('product_category_load_more', [FrontController::class, 'product_category_load_more'])->name('product_category_load_more');

Route::get('category1/{slug}', [FrontController::class, 'product_category1'])->name('product.category1');

#Route::get('brand/{id}', [FrontController::class, 'product_brand'])->name('product.brand');
Route::get('brand/{brandName}', [FrontController::class, 'product_brand'])->name('product.brand');
Route::post('/load-more-brand-products', [FrontController::class, 'loadMoreBrandProducts'])->name('load.moreproduct.brand');



//end shop routes
Route::post('cart-data', [CartController::class, 'store'])->name('cart');
Route::post('remove-cart-item', [CartController::class, 'remove_cart_item'])->name('remove.cart');
Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('checkout-process', [CheckoutController::class, 'store'])->name('checkout.process');

Route::get('news', [FrontController::class, 'news'])->name('news');

Route::get('news_top_trending_load_more', [FrontController::class, 'news_top_trending_load_more'])->name('news_top_trending_load_more');
Route::get('news_other_articles_load_more', [FrontController::class, 'news_other_articles_load_more'])->name('news_other_articles_load_more');


#Route::get('news-brand/{id}', [FrontController::class, 'newsBrand'])->name('news.brand');

Route::get('news/{brandSlug}', [FrontController::class, 'newsBrand1'])->name('news.brand');

Route::get(
    'brand_news_articles_load_more',
    [FrontController::class, 'brand_news_articles_load_more']
)->name('brand_news_articles_load_more');




Route::get('news/{id}', [FrontController::class, 'newsBrand'])->name('news.brand');


Route::get('newses', [FrontController::class, 'newses'])->name('newses');


Route::get('news/{slug}', [FrontController::class, 'single_news'])->name('single.news');

Route::get('news/{brandSlug}/{slug}', [FrontController::class, 'single_news1'])->name('single.news');



Route::post('checkout/coupon', [CouponController::class, 'coupon_user'])->name('coupon.user');
Route::post('checkout/coupon/distroy', [CouponController::class, 'coupon_remove'])->name('coupon.remove');
Route::get('wishlist', [FrontController::class, 'wishlist'])->name('wishlist');
Route::post('user-wishlist', [WishlistController::class, 'wishlist'])->name('user-wishlist');
Route::post('user-wishlists', [WishlistController::class, 'wishlists'])->name('user-wishlists');
Route::post('user-add-compare-product', [WishlistController::class, 'addComperProduct'])->name('user-add-compare-product');
Route::post('user-remove-compare-product', [WishlistController::class, 'RemoveComperProduct'])->name('user-remove-compare-product');

Route::get('start-selling', [FrontController::class, 'start_selling_home'])->name('start_selling_home');
Route::get('contact-us', [FrontController::class, 'contact_us'])->name('contactus');
// by bbz developer
Route::post('contact-us', [FrontController::class, 'ContactUsStore'])->name('contactus_post');
Route::get('privacy-policy', [FrontController::class, 'privacy_policy'])->name('privacy_policy');
Route::get('vendor-agreement-policy', [FrontController::class, 'vendor_agreement_policy'])->name('vendor-agreement-policy');
Route::get('shipping-policy', [FrontController::class, 'shipping_policy'])->name('shipping-policy');
Route::get('return-refund', [FrontController::class, 'return_refund'])->name('return-refund');
Route::get('disclaimer', [FrontController::class, 'disclaimer'])->name('disclaimer');
Route::get('copyright-policy', [FrontController::class, 'copyright_policy'])->name('copyright-policy');
Route::get('term-and-condition', [FrontController::class, 'terms_condition'])->name('terms_condition');
Route::get('frequently-asked-questions', [FrontController::class, 'faq'])->name('faq');
Route::get('about-us', [FrontController::class, 'about_us'])->name('about_us');
Route::get('buying', [FrontController::class, 'buying'])->name('Buying');
Route::get('view-all-brands', [FrontController::class, 'view_all_brands'])->name('view-all-brands');
Route::post('user-register', [FrontController::class, 'register_user'])->name('register_user');
Route::post('user-registers', [FrontController::class, 'register_users'])->name('register_users');

Route::get('news/brand/{slug}', [FrontController::class, 'brand_with_slug'])->name('brands-news');

Route::get('/down-document/{id}', [DocumentController::class, 'download'])->name('down.document');



//Route::delete('/dashboard/delete_cartitem_row',[CartController::class, 'deleteCartItem'])->name('delete_cartitem_row');


Route::middleware(['admin'])->group(function () {
    Route::group(['prefix' => 'dashboard'], function () {

        Route::resource('videos', VideoController::class);
        Route::get('abandoned-carts', [AbandonedCartsController::class, 'index'])->name('abandoned-carts');
        Route::get('abandoned-cart/{id}', [AbandonedCartsController::class, 'abandonedCartDetail'])->name('abandoned-cart-detail');

        // Route::delete('/delete_cartitem_row/{user_id}', 'CartController@deleteCartItem')->name('delete_cartitem_row');





        Route::post('/send-document', [DocumentController::class, 'send_mail'])->name('send.documents');
        Route::post('/add-documents', [DocumentController::class, 'store'])->name('add.documents');
        Route::get('/delete-document/{id}', [DocumentController::class, 'delete'])->name('delete.document');

        Route::get('/product-brands', [BrandController::class, 'brands'])->name('product.brands');

        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/add-category', [ProductCategoryController::class, 'add_category'])->name('add.category');
        Route::resource('category', ProductCategoryController::class, ['category.index' => 'category.index', 'category.store' => 'category.store']);

        //import products
        Route::get('/import-products', [ImportProductController::class, 'index'])->name('import.product');
        Route::post('/import-process', [ImportProductController::class, 'process'])->name('import.process');

        //Shop Categories
        Route::get('shop-category', [ShopCategoryController::class, 'index'])->name('shop-category');
        Route::get('filter-category/{id}', [ShopCategoryController::class, 'filter_category'])->name('filter-category');
        Route::get('shop-brand/{slug}', [ShopCategoryController::class, 'category_brand'])->name('cate_brand');
        Route::get('add-shop-category', [ShopCategoryController::class, 'addShopCategory'])->name('add.shop.category');
        Route::get('edit-category/{id}', [ShopCategoryController::class, 'edit_category'])->name('edit.category');
        Route::get('delete-category/{id}', [ShopCategoryController::class, 'delete_category'])->name('delete.category');
        Route::post('edit-process', [ShopCategoryController::class, 'edit_process'])->name('edit.shop.cat');
        Route::post('add-shop-category', [ShopCategoryController::class, 'addShopProcess'])->name('add.shop.process');

        // brands
        Route::get('brands', [BrandController::class, 'index'])->name('brand-home');
        Route::get('add-brand', [BrandController::class, 'addBrand'])->name('add.brand');
        Route::post('brand-process', [BrandController::class, 'brandProcess'])->name('brand.process');
        Route::get('brand/{id}', [BrandController::class, 'brandWithId'])->name('brand.with.id');
        Route::get('remove_brand_image/{id}', [BrandController::class, 'removeImage'])->name('remove_brand_image');
        Route::post('brand/edit-process', [BrandController::class, 'brandEditProcess'])->name('brand.edit.process');
        Route::post('brand/edit-finantial', [IncomeController::class, 'finantialEdit'])->name('finantial.edit.process');
        Route::post('edited/edit-finantial', [IncomeController::class, 'finantialEditall'])->name('finantial.edit.process.yes');
        Route::get('brand/delete/{id}', [BrandController::class, 'brandDelete'])->name('brand.delete');
        //size
        Route::get('/size-brands', [SizeController::class, 'sizeBrand'])->name('size.brands');
        Route::get('shop-sizebrand/{slug}', [SizeController::class, 'category_sizebrand'])->name('cate_sizebrand');
        Route::get('size/{slug}', [SizeController::class, 'index'])->name('size-home');
        Route::get('add-size', [SizeController::class, 'addSize'])->name('add.size');
        Route::get('edit/{id}', [SizeController::class, 'editSize'])->name('sizeEdit');
        Route::get('delete/{id}', [SizeController::class, 'deleteSize'])->name('sizeDelete');
        Route::post('size-process', [SizeController::class, 'sizeProcess'])->name('size.process');
        Route::get('view-category-sizes', [SizeController::class, 'category_size'])->name('category-sizes');
        Route::get('add-category-size', [SizeController::class, 'add_category_size'])->name('add-category-size');
        Route::post('add-size-category-process', [SizeController::class, 'category_size_process'])->name('add-size-category-process');
        Route::get('import-size', [SizeController::class, 'importSize'])->name('size.importSize');
        Route::post('/sizeimport-process', [SizeController::class, 'sizeImportProcess'])->name('size.sizeImportProcess');

        //about product
        Route::get('product', [ProductController::class, 'index'])->name('product-home');
        Route::get('add-product', [ProductController::class, 'addProduct'])->name('add.product');
        Route::post('shop/cat/value', [ProductController::class, 'shopCategoryValue'])->name('shop-cat.value');
        Route::post('product-process', [ProductController::class, 'productProcess'])->name('product.process');
        Route::post('product-edit', [ProductController::class, 'product_edit'])->name('product.edit.process');
        Route::get('product/delete/{id}', [ProductController::class, 'product_delete'])->name('product.delete');
        Route::get('product/{id}', [ProductController::class, 'productById'])->name('product.by.id');
        Route::get('qauntity-update/{id}', [ProductController::class, 'stockUpdate'])->name('product.stock.update');
        Route::post('qauntity-update', [ProductController::class, 'stockUpdateProcess'])->name('product.stock.update.process');
        Route::get('product-catgory/{slug}', [ProductController::class, 'product_catgory'])->name('product-catgory');

        //about orders
        Route::get('order', [OrderController::class, 'orders'])->name('order.index');
        Route::get('today-orders', [OrderController::class, 'daily_orders'])->name('order.today');
        Route::post('order-status', [OrderController::class, 'order_status'])->name('order.status');
        Route::post('order-tracking', [OrderController::class, 'order_tracking'])->name('order.tracking');

        Route::get('ord', [ProductController::class, 'ord'])->name('ord');
        Route::post('order-commission', [OrderController::class, 'order_commission'])->name('order.compaid');

        Route::get('order-detail/{id}', [OrderController::class, 'order_detail'])->name('order.detail');
        Route::get('allorder-details/{id}', [OrderController::class, 'allorder_detail_buyer'])->name('allorder.detail.buyer');
        Route::get('order-details/{id}', [OrderController::class, 'order_detail_buyer'])->name('order.detail.buyer');
        Route::get('order-delete/{id}', [OrderController::class, 'order_delete'])->name('order.delete');
        Route::get('admin-orders', [OrderController::class, 'admin_orders'])->name('order.AdminOrders');
        Route::get('seller-orders', [OrderController::class, 'seller_orders'])->name('order.SellerOrders');

        //news
        Route::get('view-all-news', [NewsController::class, 'news_all'])->name('news_all');
        Route::get('news/add', [NewsController::class, 'add_news'])->name('add.news');
        Route::post('news/add', [NewsController::class, 'add_news_process'])->name('add_news_process');
        Route::get('news/edit/{id}', [NewsController::class, 'edit_news'])->name('news-edit');
        Route::get('news/delete/{id}', [NewsController::class, 'news_delete'])->name('news-delete');
        Route::post('news/edit', [NewsController::class, 'edit_news_process'])->name('edit-news-process');

        //news ticker
        Route::get('news_ticker', [NewsController::class, 'news_ticker_home'])->name('news_ticker_home');
        Route::post('save_news_ticker', [NewsController::class, 'save_news_ticker'])->name('save_news_ticker');

        //accounting
        Route::get('income-statement', [IncomeController::class, 'income_statement'])->name('IncomeStatement');
        Route::get('statement-of-financial-position', [IncomeController::class, 'financial_statment'])->name('FinancialStatement');
        Route::get('finantial_form', [IncomeController::class, 'finantial_form'])->name('finantial_form');
        Route::get('delete_form', [IncomeController::class, 'delete_finantial_form'])->name('delete_finantial_form');
        Route::get('view_fiantial_form', [IncomeController::class, 'view_finantial_form'])->name('view_finantial_form');
        Route::get('edit_fiantial_form', [IncomeController::class, 'edit_finantial_form'])->name('edit_finantial_form');


        //users and vendors
        Route::get('sellers', [VendorController::class, 'index'])->name('vendors');
        Route::get('affiliates', [VendorController::class, 'affiliatesIndex'])->name('affiliates');
        Route::post('payout_amount', [VendorController::class, 'payoutAmount'])->name('payout.amount');
        Route::get('vendors/product', [ProductController::class, 'vendors_product'])->name('dashboard.vendors_products');

        Route::post('vendors/productsss', [UserController::class, 'seller_edit'])->name('seller.edit');

        Route::post('vendors/prod', [ProductController::class, 'change'])->name('product.chgStatus');
        Route::get('users', [UserController::class, 'index'])->name('users');
        Route::get('user_view/{id}', [UserController::class, 'view_user'])->name('edit.view');
        Route::get('user/{id}', [UserController::class, 'edit_user'])->name('edit.user');
        Route::post('user/image', [UserController::class, 'user_image'])->name('user.image');

        Route::get('edit_commission/{id}', [AdminController::class, 'edit_commission'])->name('edit_commission');

        Route::post('user/edit', [UserController::class, 'edit_process'])->name('user.edit');
        Route::get('remove_image_all/{id}', [UserController::class, 'remove_image'])->name('user.image.remove.all');
        Route::post('user/editimage', [UserController::class, 'edit_process_image'])->name('user.editimage');
        Route::get('user/delete/{id}', [UserController::class, 'delete_user'])->name('delete-user');
        Route::get('users/add', [UserController::class, 'add_user'])->name('add.user');
        Route::post('user/add', [UserController::class, 'add_process'])->name('add.user.process');
        Route::get('wants-to-be-seller', [UserController::class, 'show_vendor_requests'])->name('show.vendor.request');
        Route::post('user-request-vendor-process', [UserController::class, 'admin_permission_become_a_vendor'])->name('user_request.status');
        Route::get('email-view', [UserController::class, 'email_test_view'])->name('email_test_view');
        Route::get('seller-sells', [UserController::class, 'seller_sells'])->name('seller_sells');
        Route::get('seller-sells/{id}', [UserController::class, 'vendor_amount_paid'])->name('vendor_amount_paid');
        Route::post('admin-pay', [UserController::class, 'admin_paid_amount'])->name('admin_paid_amount');
        Route::get('paid/reports', [UserController::class, 'admin_paid_reports'])->name('admin_paid_reports');

        //admin home page setting
        Route::get('setting', [AdminController::class, 'setting'])->name('setting');
        Route::post('setting', [AdminController::class, 'home_page_store'])->name('setting.store');
        //coupon
        Route::get('coupon', [CouponController::class, 'home'])->name('coupon.home');


        // Deleting a coupon
        Route::get('delete_coupon/{id}', [CouponController::class, 'delete_coupon'])->name('delete_coupon');
        Route::get('edit_coupon/{id}', [CouponController::class, 'edit_coupon'])->name('edit_coupon');
        Route::get('add-coupon', [CouponController::class, 'coupon_add'])->name('coupon-add');
        Route::post('add-coupon', [CouponController::class, 'coupon_process'])->name('coupon.process');
        Route::post('edit_process', [CouponController::class, 'edit_process'])->name('edit_process');

        Route::get('setting/weight', [AdminController::class, 'weight'])->name('setting.weight');
        Route::get('setting/commission', [AdminController::class, 'seller_commission'])->name('setting.seller_commission');
        Route::post('setting/weight', [AdminController::class, 'weight_process'])->name('setting.weight.process');
        Route::get('setting/shipping', [AdminController::class, 'shipping_home'])->name('setting.shipping');

        Route::post('setting/update_commission', [AdminController::class, 'update_commission'])->name('commission.edit.process');

        Route::get('privacy-policy', [PageController::class, 'privacy_policy'])->name('privacy.policy');
        Route::post('privacy-policy', [PageController::class, 'policy_process'])->name('privacy.process');
        Route::post('vendors/product/', [ProductController::class, 'purchased'])->name('admin_stock_purchased');
        Route::get('vendors/product/{id}', [ProductController::class, 'vendor_product_detail'])->name('vendor_product_detail');

        // About us
        Route::get('about-us-banner', [AboutusController::class, 'index'])->name('aboutus.banner');
        Route::get('about-us-banner-create', [AboutusController::class, 'create'])->name('aboutus.banner.create');
        Route::post('about-us-banner-store', [AboutusController::class, 'store'])->name('aboutus.banner.store');
        Route::get('about-us-banner-edit/{id}', [AboutusController::class, 'edit'])->name('aboutus.banner.edit');
        Route::post('about-us-banner-update/{id}', [AboutusController::class, 'update'])->name('aboutus.banner.update');
        Route::get('about-us-banner-delete/{id}', [AboutusController::class, 'destroy']);
        Route::get('about-us-content', [AboutusController::class, 'contentShow'])->name('aboutus.content');
        Route::post('about-us-content-store', [AboutusController::class, 'contentStore'])->name('aboutus.content.store');

        Route::get('about-us-setting', [AboutusController::class, 'settingShow'])->name('aboutus.setting');
        Route::post('about-us-setting-store', [AboutusController::class, 'settingStore'])->name('aboutus.setting.store');


        Route::get('about-our-team', [AboutusController::class, 'ourTeamIndex'])->name('aboutus.ourteam');
        Route::get('about-our-team-create', [AboutusController::class, 'ourTeamCreate'])->name('aboutus.ourteam.create');
        Route::post('about-our-team-store', [AboutusController::class, 'ourTeamStore'])->name('aboutus.ourteam.store');
        Route::get('about-our-team-edit/{id}', [AboutusController::class, 'ourTeamCreatedit'])->name('aboutus.ourteam.edit');
        Route::post('about-our-team-update/{id}', [AboutusController::class, 'ourTeamupdate'])->name('aboutus.ourteam.update');
        Route::get('about-our-team-delete/{id}', [AboutusController::class, 'ourTeamdestroy'])->name('aboutus.ourteam.delete');

        Route::get('about-keymetrics', [AboutusController::class, 'keyMetricsIndex'])->name('aboutus.keymetrics');
        Route::get('about-keymetrics-create', [AboutusController::class, 'keyMetricsCreate'])->name('aboutus.keymetrics.create');
        Route::post('about-keymetrics-store', [AboutusController::class, 'keyMetricsStore'])->name('aboutus.keymetrics.store');
        Route::get('about-keymetrics-edit/{id}', [AboutusController::class, 'keyMetricsCreatedit'])->name('aboutus.keymetrics.edit');
        Route::post('about-keymetrics-update/{id}', [AboutusController::class, 'keyMetricsupdate'])->name('aboutus.keymetrics.update');
        Route::get('about-keymetrics-delete/{id}', [AboutusController::class, 'keyMetricsdestroy'])->name('aboutus.keymetrics.delete');
    });
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('delete_cart', [CartController::class, 'delete_cart'])->name('deletecart');

    // by bbt developers
    Route::post('vendors/product/delete', [ProductController::class, 'vendor_product_delete'])->name('vendor-product-delete');

    Route::group(['prefix' => 'dashboard'], function () {

        Route::post('/card', [UserController::class, 'card'])->name('card');
        Route::get('vendor/product/extend-expiry-date', [ProductController::class, 'vendor_product_extend_expiry_date'])->name('vendor-product-extend-expiry-date');

        Route::get('account-details', [UserController::class, 'update_account'])->name('update_account');
        Route::post('selft-update', [UserController::class, 'self_update'])->name('self_update');
        Route::post('imageUpdate', [UserController::class, 'imageUpdate'])->name('imageUpdate');
        Route::get('become-a-vendor', [UserController::class, 'user_request_for_vendor'])->name('become.vendor');
        Route::get('orders', [UserController::class, 'user_orders'])->name('user_orders');
        Route::get('order-detail/{id}', [UserController::class, 'user_order_detail'])->name('user_order_detail');
        Route::get('order-payment/{id}', [CheckoutController::class, 'user_payment'])->name('user_payment');
        Route::post('process/vendor', [UserController::class, 'request_become_a_vendor_process'])->name('request_become_a_vendor_process');
        Route::get('addresses', [UserController::class, 'edit_address'])->name('edit_address');
        Route::get('affiliate', [UserController::class, 'get_affiliate'])->name('get_affiliate');
        Route::get('my-subscriptions', [UserController::class, 'user_subscribe'])->name('user_subscribe');
        Route::get('bank-information', [UserController::class, 'bank_detail'])->name('bank_detail');
        Route::get('billing-address', [UserController::class, 'billing_address'])->name('billing_address');
        Route::get('shipping-address', [UserController::class, 'shipping_address'])->name('shipping_address');
        Route::get('sale-your-product', [UserController::class, 'sale_your_product'])->name('sale_your_product');
        Route::get('my-listings', [ProductController::class, 'my_list'])->name('my_list');
        Route::get('my-sold-items', [UserController::class, 'seller_sold_item'])->name('seller_sold_item');
        Route::get('products', [UserController::class, 'products'])->name('products');
        Route::post('user-subscribe', [UserController::class, 'user_subscribe_process'])->name('user_subscribe_process');
        Route::post('user-unsubscribe', [UserController::class, 'user_unsubscribe_process'])->name('user_unsubscribe_process');
        Route::post('remove-wishlist', [WishlistController::class, 'remove_wishlist'])->name('remove-wishlist');
        Route::post('add-seller-product', [UserController::class, 'add_seller_product'])->name('vendor-products');
        Route::get('delete/product/{id}', [UserController::class, 'delete_product'])->name('delete-vendor-product');
        Route::get('vendor-detail/{id}', [UserController::class, 'details_vendor_product'])->name('details_vendor_product');
        Route::post('size/ajax', [UserController::class, 'size_ajax'])->name('size-ajax');
        Route::post('size-list-ajax', [UserController::class, 'size_list_ajax'])->name('size-list-ajax');
        Route::post('shipping/ajax', [UserController::class, 'shipping'])->name('shipping');
        Route::post('billing-address-process', [UserController::class, 'billing_address_process'])->name('billing-address-process');
        Route::post('shipping-address-process', [UserController::class, 'shipping_address_process'])->name('shipping-address-process');

        Route::post('user_notification_process', [UserController::class, 'user_notification_process'])->name('user_notification_process');
    });
});


//Clear Cache Route
Route::get('clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:cache');

    return "Cleared!";
});
