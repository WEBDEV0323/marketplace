<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ShopCategory;
use App\Models\ProductCatShop;
use App\Models\Setting;
use App\Models\User;
use App\Models\RequestVendor;
use App\Models\Wishlist;
use App\Models\ProductCompayr;
use App\Models\News;
use App\Models\VendorProduct;
use App\Models\ProductSize;
use App\Models\CategorySize;
use App\Models\Size;
use App\Models\ProductImage;
use App\Models\ProductFault;
use Illuminate\Support\Str;
use Hash;
use Auth;
use App\Models\Cart;
use App\Models\Traffic;
use App\Models\shop_categories;
use DB;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\BillingAddresses;
use App\Models\ShippingAddresses;
use App\Models\Aboutus;
use App\Models\Video;
use App\Models\Contact;
use Mail;
use App\Mail\SendContactMail;


use App\Models\CartItem; // Import the CartItem model
use Mpdf\PsrHttpMessageShim\Request as PsrHttpMessageShimRequest;

class FrontController extends Controller
{
    public $currentDate;
    public function __construct()
    {
        $this->currentDate = Carbon::now()->format('Y-m-d');
    }

    public function index()
    {

        $video = Video::first(); // Assuming there is only one video
        $video_path = $video ? asset('storage/' . $video->video_path) : null;

        // Assuming $brands is an array of brand IDs
        $data['video_path'] = $video_path;


        $traffic = new Traffic;
        $traffic->visit = "visit";
        $traffic->save();
        $brands = Setting::where('key', 'home_brands')->first();

        //brand display on home
        if (!empty($brands) && $brands['value'] != 'null') {
            $brands = $brands->toArray();

            $brands = json_decode($brands['value']);
            $data['brands'] = Brand::whereIn('id', $brands)
                //->limit(5)
                ->get();
        }
        //START MAN'S SECTION
        //man's in new display on home


        // $man_products = Setting::where('key', 'mans_in_new')->first();
        // if (!empty($brands)) {
        //     $man_products = $data['man_products'] =  Product::where('created_at', '>', now()->subDays(30))->where('flags', 1)->where(function ($query) {
        //         $query->whereNull('products.expiry_date')
        //             ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
        //     })->whereHas('shop_category', function ($query) {
        //         $query->where('shop_cat_name', 'Menswear');
        //     })->limit(5)->get();
        // }


        $man_products = Setting::where('key', 'mans_in_new')->first();
        if (!empty($brands) && $man_products['value']) {
            $man_products = $man_products->toArray();
            $man_products = json_decode($man_products['value']);
            if (gettype($man_products) == "array") {
                $data['man_products'] = Product::select('products.*')->whereIn('products.id', $man_products)->where('products.flags', 1)
                    ->where("products.parent_id", 0)
                    ->where('products.gender', 1)
                    ->where(function ($query) {
                        $query->whereNull('products.expiry_date')
                            ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                    })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags', 1)->orderBy('products.id', 'DESC')->take(25)->get();
            }
        }








        //man's in sale display on home


        // $data['man_in_sales'] = Product::select('products.*')->where('products.flags', 1)->where('products.sale_price', '>', 0)
        //     ->whereColumn('products.regular_price', ">", 'products.sale_price')
        //     ->where('products.gender', 1)
        //     ->where('products.parent_id', 0)
        //     ->where(function ($query) {
        //     $query->whereNull('products.expiry_date')
        //         ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
        // })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags',1)->orderBy('products.id', 'DESC')->take(25)->get();

        $man_in_sale = Setting::where('key', 'mans_in_sale')->first();

        if (!empty($brands) && $man_in_sale['value']) {
            $man_in_sale = $man_in_sale->toArray();
            $man_in_sale = json_decode($man_in_sale['value']);
            if (gettype($man_in_sale) == "array") {
                $data['man_in_sales'] = Product::select('products.*')->whereIn('products.id', $man_in_sale)->where('products.flags', 1)
                    ->where("products.parent_id", 0)
                    ->where('products.gender', 1)
                    ->where('products.sale_price', '>', 0)
                    ->whereColumn('products.regular_price', ">", 'products.sale_price')
                    ->where(function ($query) {
                        $query->whereNull('products.expiry_date')
                            ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                    })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags', 1)->orderBy('products.id', 'DESC')->take(25)->get();
                //  $man_in_sale = Product::where('sale_price', '>', 0)->take(5)->get();
            }
        }


        //man's in POPULAR display on home
        $man_in_popular = Setting::where('key', 'mans_in_popular')->first();
        if (!empty($brands) && $man_in_popular['value']) {
            $man_in_popular = $man_in_popular->toArray();
            $man_in_popular = json_decode($man_in_popular['value']);
            if (gettype($man_in_popular) == "array") {
                $data['man_in_populars'] = Product::select('products.*')->whereIn('products.id', $man_in_popular)->where('products.flags', 1)
                    ->where("products.parent_id", 0)
                    ->where('products.gender', 1)
                    ->where(function ($query) {
                        $query->whereNull('products.expiry_date')
                            ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                    })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags', 1)->orderBy('products.id', 'DESC')->take(25)->get();
            }
        }
        //END OF MAN'S SECTION
        //START WOMAN'S SECTION

        //WOMAN'S IN NEW display on home
        $woman_products = Setting::where('key', 'woman_in_new')->first();
        if (!empty($brands) && $woman_products['value']) {
            $woman_products = $woman_products->toArray();
            $woman_products = json_decode($woman_products['value']);
            if (gettype($woman_products) == "array") {
                $data['woman_products'] = Product::select('products.*')->whereIn('products.id', $woman_products)->where('products.flags', 1)
                    ->where("products.parent_id", 0)
                    ->where('products.gender', 2)
                    ->where(function ($query) {
                        $query->whereNull('products.expiry_date')
                            ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                    })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags', 1)->orderBy('products.id', 'DESC')->take(25)->get();
            }
        }

        //WOMAN'S IN SALE display on home
        // $data['woman_in_sales'] = Product::select('products.*')->where('products.flags', 1)->where('products.sale_price', '>', 0)
        // ->whereColumn('products.regular_price', ">", 'products.sale_price') 
        // ->where('products.gender', 2)
        // ->where('products.parent_id', 0)       
        // ->where(function ($query) {
        //     $query->whereNull('products.expiry_date')
        //         ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
        // })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags',1)->orderBy('products.id', 'DESC')->take(25)->get();

        $woman_in_sale = Setting::where('key', 'woman_in_sale')->first();
        if (!empty($brands) && $woman_in_sale['value']) {
            $woman_in_sale = $woman_in_sale->toArray();
            $woman_in_sale = json_decode($woman_in_sale['value']);
            if (gettype($woman_in_sale) == "array") {
                $data['woman_in_sales'] = Product::select('products.*')->whereIn('products.id', $woman_in_sale)
                    ->where("products.parent_id", 0)
                    ->where('products.gender', 2)
                    ->where('products.sale_price', '>', 0)
                    ->whereColumn('products.regular_price', ">", 'products.sale_price')
                    ->where('products.flags', 1)->where(function ($query) {
                        $query->whereNull('products.expiry_date')
                            ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                    })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags', 1)->orderBy('products.id', 'DESC')->take(25)->get();
            }
        }


        //WOMAN'S IN POPULAR display on home
        $woman_in_popular = Setting::where('key', 'woman_in_popular')->first();
        if (!empty($brands) && $woman_in_popular['value']) {
            $woman_in_popular = $woman_in_popular->toArray();
            $woman_in_popular = json_decode($woman_in_popular['value']);
            if (gettype($woman_in_popular) == "array") {
                $data['woman_in_populars'] = Product::select('products.*')->whereIn('products.id', $woman_in_popular)->where('products.flags', 1)
                    ->where("products.parent_id", 0)
                    ->where('products.gender', 2)
                    ->where(function ($query) {
                        $query->whereNull('products.expiry_date')
                            ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                    })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags', 1)->orderBy('products.id', 'DESC')->take(25)->get();
            }
        }

        //END OF WOMAN'S SECTION
        //START CHILDERN'S SECTION

        //CHILDERN'S IN NEW display on home
        $children_products = Setting::where('key', 'children_in_new')->first();
        if (!empty($brands) && $children_products['value']) {
            $children_products = $children_products->toArray();
            $children_products = json_decode($children_products['value']);
            if (gettype($children_products) == "array") {
                $data['children_products'] = Product::select('products.*')->whereIn('products.id', $children_products)->where('products.flags', 1)
                    ->where("products.parent_id", 0)
                    ->where('products.gender', 3)
                    ->where(function ($query) {
                        $query->whereNull('products.expiry_date')
                            ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                    })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags', 1)->orderBy('products.id', 'DESC')->take(25)->get();
            }
        }
        //CHILDERN'S IN SALES display on home

        // $data['children_in_sales'] = Product::select('products.*')->where('products.flags', 1)->where('products.sale_price', '>', 0)
        // ->whereColumn('products.regular_price', ">", 'products.sale_price') 
        // ->where('products.gender', 3)
        // ->where('products.parent_id', 0)           
        // ->where(function ($query) {
        //     $query->whereNull('products.expiry_date')
        //         ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
        // })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags',1)->orderBy('products.id', 'DESC')->take(25)->get();


        $children_in_sale = Setting::where('key', 'children_in_sale')->first();
        if (!empty($brands) && $children_in_sale['value']) {
            $children_in_sale = $children_in_sale->toArray();
            $children_in_sale = json_decode($children_in_sale['value']);
            if (gettype($children_in_sale) == "array") {
                $data['children_in_sales'] = Product::select('products.*')->whereIn('products.id', $children_in_sale)
                    ->where("products.parent_id", 0)
                    ->where('products.gender', 3)
                    ->where('products.sale_price', '>', 0)
                    ->whereColumn('products.regular_price', ">", 'products.sale_price')
                    ->where('products.flags', 1)->where(function ($query) {
                        $query->whereNull('products.expiry_date')
                            ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                    })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags', 1)->orderBy('products.id', 'DESC')->take(25)->get();
            }
        }

        //CHILDERN'S IN POPULAR display on home
        $children_in_popular = Setting::where('key', 'children_in_popular')->first();

        if (!empty($brands) && $children_in_popular['value']) {
            $children_in_popular = $children_in_popular->toArray();

            $children_in_popular = json_decode($children_in_popular['value']);

            if (gettype($children_in_popular) == "array") {
                $data['children_in_populars'] = Product::select('products.*')->whereIn('products.id', $children_in_popular)->where('products.flags', 1)
                    ->where("products.parent_id", 0)
                    ->where('products.gender', 3)
                    ->where(function ($query) {
                        $query->whereNull('products.expiry_date')
                            ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                    })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags', 1)->orderBy('products.id', 'DESC')->take(25)->get();
            }
        }
        //END OF CHIDLERN'S SECTION

        //top trend
        $getlatestSoldProduct = Order::where('orders.created_at', '>', Carbon::now()->startOfMonth())
            ->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')
            ->groupBy('order_details.product_id')->pluck('order_details.product_id');

        // $data['top_mans_trend_products'] = Product::select('products.*')->whereIn('products.id', $getlatestSoldProduct)
        // ->where('products.gender', 1)
        // ->where('products.parent_id', 0)
        // ->where('products.flags', 1)->where(function ($query) {
        //     $query->whereNull('products.expiry_date')
        //         ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
        // })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags',1)->orderBy('products.id', 'DESC')->take(25)->get();

        $top_mans_trend_product = Setting::where('key', 'top_mans_trend_product')->first();
        $beforMonthSoldProduct = Order::where('orders.created_at', '<', Carbon::now()->startOfMonth())
            ->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')
            ->groupBy('order_details.product_id')->pluck('order_details.product_id');

        if (!empty($brands) && $top_mans_trend_product['value']) {
            $top_mans_trend_product = $top_mans_trend_product->toArray();
            $top_mans_trend_product = json_decode($top_mans_trend_product['value']);
            if (gettype($top_mans_trend_product) == "array") {
                $data['top_mans_trend_products'] = Product::select('products.*')->whereIn('products.id', $top_mans_trend_product)
                    ->whereNotIn('products.id', $beforMonthSoldProduct)
                    ->where('products.flags', 1)
                    ->where('products.gender', 1)->where('products.parent_id', 0)
                    ->where(function ($query) {
                        $query->whereNull('products.expiry_date')
                            ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                    })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags', 1)->orderBy('products.id', 'DESC')->take(25)->get();
            }
        }

        // $data['top_womans_trend_products'] = Product::select('products.*')
        // ->where('products.gender', 2)
        // ->where('products.parent_id', 0)
        // ->whereIn('products.id', $getlatestSoldProduct)->where('products.flags', 1)->where(function ($query) {
        //     $query->whereNull('products.expiry_date')
        //         ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
        // })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags',1)->orderBy('products.id', 'DESC')->take(25)->get();

        $top_womans_trend_product = Setting::where('key', 'top_womans_trend_product')->first();
        if (!empty($brands) && $top_womans_trend_product['value']) {
            $top_womans_trend_product = $top_womans_trend_product->toArray();
            $top_womans_trend_product = json_decode($top_womans_trend_product['value']);
            if (gettype($top_womans_trend_product) == "array") {
                $data['top_womans_trend_products'] = Product::select('products.*')->whereIn('products.id', $top_womans_trend_product)
                    ->whereNotIn('products.id', $beforMonthSoldProduct)
                    ->where('products.flags', 1)
                    ->where('products.gender', 2)->where('products.parent_id', 0)
                    ->where(function ($query) {
                        $query->whereNull('products.expiry_date')
                            ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                    })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags', 1)->orderBy('products.id', 'DESC')->take(25)->get();
            }
        }

        // $data['top_children_trend_products'] = Product::select('products.*')
        //      ->where('products.gender', 3)
        //     ->where('products.parent_id', 0)
        // ->whereIn('products.id', $getlatestSoldProduct)->where('products.flags', 1)->where(function ($query) {
        //     $query->whereNull('products.expiry_date')
        //         ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
        // })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags',1)->orderBy('products.id', 'DESC')->take(25)->get();

        $top_children_trend_product = Setting::where('key', 'top_children_trend_product')->first();
        if (!empty($brands) && $top_children_trend_product['value']) {
            $top_children_trend_product = $top_children_trend_product->toArray();
            $top_children_trend_product = json_decode($top_children_trend_product['value']);
            if (gettype($top_children_trend_product) == "array") {
                $data['top_children_trend_products'] = Product::select('products.*')->whereIn('products.id', $top_children_trend_product)
                    ->whereNotIn('products.id', $beforMonthSoldProduct)
                    ->where('products.gender', 3)->where('products.parent_id', 0)
                    ->where('products.flags', 1)->where(function ($query) {
                        $query->whereNull('products.expiry_date')
                            ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                    })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags', 1)->orderBy('products.id', 'DESC')->take(25)->get();
            }
        }

        if (empty($data)) {
            $data['message'] = 'No products';
        }

        // return view('frontend.front-index',$data);
        return view('frontend.home.frontend-home', $data);
    }

    public function single_product_variation($id)
    {
        // $data=Product::select("products.id as id","products.product_name","shop_categories.shop_cat_name","sizes.size","product_sizes.sale_price","products.flags","products.product_description","products.condition","products.sku","feature_image")
        // ->join("product_sizes","products.id","=","product_sizes.product_id")
        // ->leftjoin("shop_categories","shop_categories.id","=","products.shop_category_id")
        // ->leftjoin("sizes","sizes.id","=","product_sizes.size_id")
        // ->where('product_sizes.id',$id)
        // ->first();


        $a = ProductSize::where("id", $id)->first();

        //$category = Product::where('id', $a->product_id);


        $data = Product::select("products.*", "product_sizes.sale_price", "sizes.size")
            ->leftjoin("product_sizes", "product_sizes.product_id", "=", "products.id")
            ->leftjoin("sizes", "sizes.id", "=", "product_sizes.size_id")
            ->where('products.id', $a->product_id)
            // ->where('products.flags', 1)
            // ->where(function ($query) {
            //     $query->whereNull('products.expiry_date')
            //         ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
            // })
            ->with('product_parent.shop_category', 'product_user')->first();


        $faults = ProductFault::where('product_id', $a->product_id)->get();
        $all_faults = "";
        foreach ($faults as $fault) {

            $all_faults .= $fault->fault . ' , ';
        }

        $all_faults = chop($all_faults, " ,");
        $multiimages = ProductImage::where('product_id', $data->id)->get();
        $related = Product::select('products.*')->where('products.id', '!=', $data->product_id)->where('products.flags', 1)->where('products.parent_id', 0)->where(function ($query) {
            $query->whereNull('products.expiry_date')
                ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
        })
            ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
            ->where('brands.flags', 1)
            ->with('shop_category', 'prod_size.size')->limit(5)->get();

        // select("products.id as product_id","products.product_name","shop_categories.shop_cat_name","sizes.size","product_sizes.sale_price","products.flags","products.products_description")
        return view('frontend.home.variation_page', compact('data', 'id', 'related', 'multiimages', 'all_faults'));
    }

    public function single_page($product_id = 0, $brand = 0, $category = 0, $product_slug = 0)
    {
        $cancel = 0;
        $variation = 0;
        delete_size_not_exits();
        $getProduct_sizes = Product::where('id', $product_id)->first();
        if ($getProduct_sizes) {
            $getAllExitSize =  Size::where('brand_id', $getProduct_sizes->brand_id)->where('shop_category_id', $getProduct_sizes->shop_category_id)->where('gender', $getProduct_sizes->gender)->pluck('id');
            ProductSize::whereNotIn('size_id', $getAllExitSize)->where('product_id', $product_id)->delete();
        }

        $data['product'] = Product::select('products.*')->where([['products.id', $product_id]])
            ->where(function ($query) {
                $query->where('products.flags', 1)
                    ->orWhere('products.flags', 5);
            })
            ->where(function ($query) {
                $query->whereNull('products.expiry_date')
                    ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
            })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
            ->where('brands.flags', 1)
            ->with('shop_category', 'multi_images', 'prod_size', 'prod_size.size', 'getBrand')->first();

        if ($data['product'] != null) {
            $category_id = $data['product']->shop_category_id;
            $category_sizes = CategorySize::where('category_id', $category_id)->pluck('size_id');

            // $data['new_products'] = Size::whereIn('sizes.id', $category_sizes)
            //     ->with(['product_size' => function ($q) use ($product_id) {
            //         $q->where('product_id', '!=', $product_id)->where('sale_price', '>', 0)->orderBy('sale_price', 'ASC');
            //     }, 'product_size.products' => function ($j) use ($product_id) {
            //         $j->where('product_type', 1)->where('parent_id', $product_id)->where(function ($query) {
            //             $query->whereNull('products.expiry_date')
            //                 ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
            //         })->whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE]);
            //     }])->get()->toArray();

            /// Removing the bug ex the new_products are also including the value sof old_products so again cross cheacking
            // foreach ($data['new_products'] as $i => $p) {
            //     foreach ($p["product_size"] as $j => $size) {
            //         if (isset($size["products"]["product_type"]) && $size["products"]["product_type"] == 1) {
            //         } else {

            //             $data['new_products'][$i]["product_size"];
            //             unset($data['new_products'][$i]["product_size"][$j]);
            //         }
            //     }
            // }
            // new functionality
            $buyNewProducts = $data['buyNewProducts'] = Product::where('parent_id', $product_id)->where('product_type', 1)->where(function ($query) {
                $query->where('flags', 1)
                    ->orWhere('flags', 5);
            })->where(function ($query) {
                $query->whereNull('products.expiry_date')
                    ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
            })->pluck('id');
            $data['new_products'] = ProductSize::select('product_sizes.size_id', 'sizes.size', DB::raw("SUM(product_sizes.quantity) as product_sizes_quantity"))->whereIN('product_id', $buyNewProducts)
                ->leftJoin('sizes', 'sizes.id', '=', 'product_sizes.size_id')->groupBy("product_sizes.size_id")->get();
            // new functionality


            // $data['used_products'] = Size::whereIn('id', $category_sizes)
            //     ->with(['product_size' => function ($q) use ($product_id) {
            //         $q->where('product_id', '!=', $product_id)->where('sale_price', '>', 0)->orderBy('sale_price', 'ASC');
            //     }, 'product_size.products' => function ($j) use ($product_id) {
            //         $j->where('product_type', 2)->where('parent_id', $product_id)->where(function ($query) {
            //             $query->whereNull('products.expiry_date')
            //                 ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
            //         })->whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE]);
            //     }])->get()->toArray();
            // new functionality
            $preLovedProducts = $data['preLovedProducts'] = Product::where('parent_id', $product_id)->where('product_type', 2)->where(function ($query) {
                $query->where('flags', 1)
                    ->orWhere('flags', 5);
            })->where(function ($query) {
                $query->whereNull('products.expiry_date')
                    ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
            })->pluck('id');
            $data['used_products'] = ProductSize::select('product_sizes.size_id', 'sizes.size', DB::raw("SUM(product_sizes.quantity) as product_sizes_quantity"))->whereIN('product_id', $preLovedProducts)
                ->leftJoin('sizes', 'sizes.id', '=', 'product_sizes.size_id')->groupBy("product_sizes.size_id")->get();
            // new functionality

            $data['related_products'] = Product::select('products.*')->where('products.id', '!=', $product_id)->where('products.parent_id', 0)->where('products.flags', 1)->where(function ($query) {
                $query->whereNull('products.expiry_date')
                    ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
            })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
                ->where('brands.flags', 1)
                ->with('shop_category', 'prod_size.size')->limit(5)->get();
            $data['cancel'] = $cancel;
            $data['variation'] = $variation;

            return view('frontend.home.product-single-page', $data);
        } else {
            return redirect(route('shop_products'));
            abort(404, 'Sorry, the page you are looking for could not be found.');
        }
    }

    // New Function added by 'BBT'
    // public function preloved_page()
    // {
    //     dd('yes');
    //     return view('frontend.home.product-single-pre-loved-page');
    // }

    public function product_new_used(Request $request)
    {

        $product_id = $request->product_id;
        $size_id = $request->size_id;
        $fault = "";

        if ($request->flags == 1) {

            $data['vendor_products'] = Size::where('id', $size_id)
                ->with(['product_size' => function ($q) use ($product_id) {
                    $q->where('product_id', '!=', $product_id)->where('sale_price', '>', 0)->orderBy('sale_price', 'ASC');
                }, 'product_size.products' => function ($j) use ($product_id) {
                    $j->where('product_type', 1)->where('parent_id', $product_id)->where(function ($query) {
                        $query->whereNull('products.expiry_date')
                            ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                    })->whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE]);
                }])
                ->paginate(10);
        }

        //$this->test(  $data['vendor_products']);
        if ($request->flags == 2) {
            //  $data['vendor_products'] = Product::select(["products.*","product_sizes.*","products.id as id","product_sizes.id as sizes_id_orignal"])
            //  ->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
            //  ->join("product_sizes","product_sizes.product_id","=","products.id")
            //  ->join("sizes","sizes.id","=","product_sizes.size_id")
            //  ->where("sizes.id",$size_id)
            //  ->where('product_type',2)
            //  ->where('parent_id',$request->product_id)
            //  ->paginate(10);

            $data['vendor_products'] = Size::where('id', $size_id)
                ->with(['product_size' => function ($q) use ($product_id) {
                    $q->where('product_id', '!=', $product_id)->where('sale_price', '>', 0)->orderBy('sale_price', 'ASC');
                }, 'product_size.products' => function ($j) use ($product_id) {
                    $j->where('product_type', 2)->where('parent_id', $product_id)->where(function ($query) {
                        $query->whereNull('products.expiry_date')
                            ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                    })->whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE]);
                }])
                ->paginate(10);


            foreach ($data['vendor_products'] as $key => $all) {
                foreach ($all->product_size as $i => $pz) {
                    $faults = ProductFault::where('product_id', $data['vendor_products'][$key]->product_size[$i]->product_id)->get();
                    $fault = "";
                    foreach ($faults as $f) {


                        $fault = $fault . $f->fault . ", ";
                    }


                    $fault = chop($fault, " ,");


                    $data['vendor_products'][$key]->product_size[$i]->fault = $fault;
                }
            }
        }
        $data['flags'] = $request->flags;
        //dd($data['vendor_products'][0]->product_size);
        // $this->test($data['vendor_products']);


        return view('frontend.home.vendor-size-product-ajax', $data);
    }

    public function single_page_new($product_id)
    {
        $data['products'] = Product::where('id', $product_id)->where('flags', 1)->where(function ($query) {
            $query->whereNull('products.expiry_date')
                ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
        })->with('prod_shop_cat', 'prod_shop_cat.shop_cat', 'prod_shop_cat.shop_cat.cat_parent', 'prod_size', 'prod_size.size')->first();
        $data['related_products'] = Product::where('id', '!=', $product_id)->where('flags', 1)->where(function ($query) {
            $query->whereNull('products.expiry_date')
                ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
        })->with('prod_shop_cat', 'prod_shop_cat.shop_cat')->limit(5)->get();
        return view('frontend.home.seller-product-new', $data);
    }

    public function seller_product_ajax(Request $request)
    {

        $data['products'] = Product::where('id', $request->product_id)->where('flags', 1)->where(function ($query) {
            $query->whereNull('products.expiry_date')
                ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
        })->with('prod_shop_cat', 'prod_shop_cat.shop_cat', 'prod_shop_cat.shop_cat.cat_parent', 'prod_size', 'prod_size.size')->first();
        $data['flags'] = $request->flags;
        return view('frontend.home.seller-product-ajax', $data);
    }

    public function single_page_used($product_id)
    {
        $data['products'] = Product::where('id', $product_id)->where('flags', 1)->where(function ($query) {
            $query->whereNull('products.expiry_date')
                ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
        })->with('prod_shop_cat', 'prod_shop_cat.shop_cat', 'prod_shop_cat.shop_cat.cat_parent', 'prod_size', 'prod_size.size')->first();
        $data['related_products'] = Product::where('id', '!=', $product_id)->where('flags', 1)->where(function ($query) {
            $query->whereNull('products.expiry_date')
                ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
        })->with('prod_shop_cat', 'prod_shop_cat.shop_cat')->limit(5)->get();
        return view('frontend.home.seller-product-used', $data);
    }






    //news
    public function news(Request $request)
    {

        $perPage = 45; // Number of products per page






        $data['featured'] = News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->with('brand')->where('section', 'Featured')->orderBy('id', 'DESC')->limit(5)->get();



        $data['most-recent'] = News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->with('brand')->where('section', 'Most Recent')->orderBy('id', 'DESC')->limit(5)->get();

        $data['other-article'] = News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])
            ->with('brand')->where('section', 'Other Article')->orderBy('id', 'DESC')->limit($perPage)->get();

        $data['slider_news'] = News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->with('brand')->orderBy('id', 'DESC')->limit(3)->get();









        $pageNumber = $request->input('page', 1); // Get the page number from the request, default to 1
        $offset = ($pageNumber - 1) * $perPage;





        $totalProducts = News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->with('brand')
            ->where('section', 'Top Trending')->orderBy('id', 'DESC')
            ->get()->count();



        $data['top-trending'] = News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->with('brand')
            ->where('section', 'Top Trending')->orderBy('id', 'DESC')->offset($offset)
            ->limit($perPage)
            ->get();








        $data['currentPage'] = $pageNumber;
        $data['hasMorePages'] = ($offset + $perPage) < $totalProducts;
        $data['totalProducts'] = $totalProducts;







        $brands = Setting::where('key', 'home_brands')->first();

        //brand display on home
        if (!empty($brands) && $brands['value'] != 'null') {
            $brands = $brands->toArray();
            $brands = json_decode($brands['value']);
            $data['brands'] = Brand::whereIn('id', $brands)->get();
        } else {
            $data['brands'] = Brand::whereRaw("flags & ? = ?", [Brand::FLAG_ACTIVE, Brand::FLAG_ACTIVE])->inRandomOrder()->take(10)->get();
        }

        // dd($data);
        // return view('frontend.home.news', compact('data'));


        if ($request->ajax()) {
            return response()->json($data);
        } else {

            return view('frontend.home.news', compact('data'));
        }
    }




    public function news_top_trending_load_more(Request $request)
    {

        //  $data['other-article'] = News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->with('brand')->where('section', 'Other Article')->orderBy('id', 'DESC')->limit(9)->get(); 


        $perPage = 45; // Number of products per page


        $pageNumber = $request->input('page', 1); // Get the page number from the request, default to 1
        $offset = ($pageNumber - 1) * $perPage;



        $totalProducts = News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->with('brand')
            ->where('section', 'Top Trending')->orderBy('id', 'DESC')
            ->get()->count();



        $data['top-trending'] = News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->with('brand')
            ->where('section', 'Top Trending')->orderBy('id', 'DESC')->offset($offset)
            ->limit($perPage)
            ->get();



        $data['currentPage'] = $pageNumber;
        $data['hasMorePages'] = ($offset + $perPage) < $totalProducts;
        $data['totalProducts'] = $totalProducts;



        if ($request->ajax()) {
            return response()->json($data);



            return view('frontend.home.news', compact('data'));
        }
    }




    public function news_other_articles_load_more(Request $request)
    {

        //  $data['other-article'] = News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->with('brand')->where('section', 'Other Article')->orderBy('id', 'DESC')->limit(9)->get(); 


        $perPage = 45; // Number of products per page
        $pageNumber = $request->input('otherpage', 1); // Get the page number from the request, default to 1
        $offset = ($pageNumber - 1) * $perPage;



        $totalProducts = News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->with('brand')
            ->where('section', 'Other Article')->orderBy('id', 'DESC')
            ->get()->count();



        $data['other-article'] = News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->with('brand')
            ->where('section', 'Other Article')->orderBy('id', 'DESC')->offset($offset)
            ->limit($perPage)
            ->get();



        $data['currentPage'] = $pageNumber;
        $data['hasMorePages'] = ($offset + $perPage) < $totalProducts;
        $data['totalProducts'] = $totalProducts;



        if ($request->ajax()) {
            return response()->json($data);



            return view('frontend.home.news', compact('data'));
        }
    }








    public function newsBrand(Request $request, $id)
    {

        $data['brand_news'] = News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->with('brand')->where('brand_id', $id)->orderBy('id', 'DESC')->get();
        $data['brands'] = Brand::whereRaw("flags & ? = ?", [Brand::FLAG_ACTIVE, Brand::FLAG_ACTIVE])->where('id', $id)->first();

        return view('frontend.home.news_brand', compact('data'));
    }



    public function newsBrand1(Request $request, $brandSlug)
    {

        $perPage = 45;
        $data['brand_news'] = News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])
            ->with('brand')
            ->whereHas('brand', function ($query) use ($brandSlug) {
                $query->where('brand_slug', $brandSlug);
            })
            ->orderBy('id', 'DESC')
            ->limit($perPage)
            ->get();

        $data['brands'] = Brand::whereRaw("flags & ? = ?", [Brand::FLAG_ACTIVE, Brand::FLAG_ACTIVE])
            ->where('brand_slug', $brandSlug)
            ->first();




        $pageNumber = $request->input('page', 1); // Get the page number from the request, default to 1
        $offset = ($pageNumber - 1) * $perPage;





        $totalProducts =   News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])
            ->with('brand')
            ->whereHas('brand', function ($query) use ($brandSlug) {
                $query->where('brand_slug', $brandSlug);
            })
            ->orderBy('id', 'DESC')
            ->get()->count();


        $data['currentPage'] = $pageNumber;
        $data['hasMorePages'] = ($offset + $perPage) < $totalProducts;
        $data['totalProducts'] = $totalProducts;
        $data['brandSlug'] = $brandSlug;


        if ($request->ajax()) {
            return response()->json($data);
        } else {

            return view('frontend.home.news_brand', compact('data'));
        }
    }




    public function brand_news_articles_load_more(Request $request)
    {

        //  $data['other-article'] = News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->with('brand')->where('section', 'Other Article')->orderBy('id', 'DESC')->limit(9)->get(); 

        $brandSlug = $request->input('brandSlug');
        $perPage = 45; // Number of products per page
        $pageNumber = $request->input('otherpage', 1); // Get the page number from the request, default to 1
        $offset = ($pageNumber - 1) * $perPage;



        $totalProducts = News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])
            ->with('brand')
            ->whereHas('brand', function ($query) use ($brandSlug) {
                $query->where('brand_slug', $brandSlug);
            })
            ->orderBy('id', 'DESC')
            ->get()->count();



        $data['other-article'] = News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])
            ->with('brand')
            ->whereHas('brand', function ($query) use ($brandSlug) {
                $query->where('brand_slug', $brandSlug);
            })
            ->orderBy('id', 'DESC')->offset($offset)
            ->limit($perPage)
            ->get();




        $data['currentPage'] = $pageNumber;
        $data['hasMorePages'] = ($offset + $perPage) < $totalProducts;
        $data['totalProducts'] = $totalProducts;
        $data['offset'] = $offset;



        return response()->json($data);
    }











    public function single_news($brandSlug, $slug)
    {
        $news = News::where('news_slug', $slug)->whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->with('brand')->first();
        // $all_data = News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->with('brand')->get();

        $news->visit = $news->visit + 1;
        $news->save();
        // $previous = News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->where('id', '<', $news->id)->orderBy('id', 'desc')->first();
        // $next = News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->where('id', '>', $news->id)->orderBy('id')->first();

        // if (!isset($next)) {

        //     $next = $all_data->first();
        // }
        // if (!isset($previous)) {
        //     $previous = $all_data->last();
        // }

        $related_news = News::where('section', $news->section)->where('id', '!=', $news->id)->whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->with('brand')->inRandomOrder()->take(10)->get();
        $ogUrl = url('/') . '/news/' . $news->news_slug;
        $ogImage = asset('storage/news/' . $news->id . '/' . $news->news_image);
        $ogDescription = strip_tags($news->description);
        // dd($ogUrl);
        return view('frontend.home.single-news', compact('news', 'related_news', 'ogUrl', 'ogImage', 'ogDescription'));
    }





    public function single_news1($brandSlug, $slug)
    {
        $news = News::where('news_slug', $slug)->whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->with('brand')->first();
        // $all_data = News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->with('brand')->get();

        $news->visit = $news->visit + 1;
        $news->save();
        // $previous = News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->where('id', '<', $news->id)->orderBy('id', 'desc')->first();
        // $next = News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->where('id', '>', $news->id)->orderBy('id')->first();

        // if (!isset($next)) {

        //     $next = $all_data->first();
        // }
        // if (!isset($previous)) {
        //     $previous = $all_data->last();
        // }

        $related_news = News::where('section', $news->section)->where('id', '!=', $news->id)
            ->whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->with('brand')->inRandomOrder()->take(10)->get();
        $ogUrl = url('/') . '/news/' . $news->news_slug;
        $ogImage = asset('storage/news/' . $news->id . '/' . $news->news_image);
        $ogDescription = strip_tags($news->description);
        // dd($ogUrl);
        return view('frontend.home.single-news', compact('news', 'related_news', 'ogUrl', 'ogImage', 'ogDescription'));
    }















    public function brand_with_slug($slug)
    {
        $data['brand'] = Brand::where('brand_slug', $slug)->whereRaw("flags & ? = ?", [Brand::FLAG_ACTIVE, Brand::FLAG_ACTIVE])->first();
        $data['all_news'] = News::where('brand_id', $data['brand']->id)->whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->with('brand')->orderBy('id', 'DESC')->paginate(10);


        //  $data['related_news'] = News::whereIn('brand_id',$data['news']->brand->id)->whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->with('brand')->get();
        return view('frontend.home.single-brand-news', $data);
    }


    //end news






    #public function product_category_old(Request $request, $slug)



    public function product_category(Request $request, $gender_slug, $category_slug = null)
    {

        $pageNumber = $request->input('page', 1); // Get the page number from the request, default to 1
        $perPage = 50; // Number of products per page

        $offset = ($pageNumber - 1) * $perPage;

        $gender = 0;
        $slug = "";

        # $data = $request->all();

        if ($gender_slug == 'man') {
            $gender = 1;
        } elseif ($gender_slug == 'woman') {
            $gender = 2;
        } elseif ($gender_slug == 'children') {
            $gender = 3;
        } else {
        }

        $data = [
            'gender' => $gender,
            'slug' => $category_slug,
        ];

        $slug = $data["slug"];

        if ($slug === null) {
            if ($gender_slug == 'menswear') {
                $slug = 'man';
            } elseif ($gender_slug == 'womenswear') {
                $slug = 'woman';
            } elseif ($gender_slug == 'children') {
                $slug = 'children';
            } else {
            }
        }

        if ($category_slug != null) {
            $categories = ShopCategory::where(["shop_cat_slug" => $slug, "parent_id" => $data["gender"]])->first();
            $gender = $data["gender"];

            $data["gender"] = $data["gender"];
        } else {

            $categories = ShopCategory::where(["shop_cat_slug" => $slug])
                // ->Where("parent_id", 0)
                ->first();
        }



        $data['category_name'] = $categories->shop_cat_name;
        $category_id = array($categories->id);


        //$product_shop_cat = $this->get_product_cat_shop($category->id);
        //return $data['products'] = $this->get_products($category->id);


        $data["category"] = $categories->id;


        $genderid = 0;
        if ($gender_slug == 'man') {
            $genderid = 1;
        }
        if ($gender_slug == 'woman') {
            $genderid = 2;
        }
        if ($gender_slug == 'children') {
            $genderid = 3;
        }
        if ($genderid == 0) {
            $data['products'] = Product::select('products.*')->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where('products.parent_id', 0)
                ->where(function ($query) {
                    $query->whereNull('products.expiry_date')
                        ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
                ->where('brands.flags', 1)
                ->whereIn('shop_category_id', $category_id)
                ->with('shop_category', 'multi_images', 'prod_size.size')->limit($perPage)->get();
        } else {
            $data['products'] = Product::select('products.*')->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
                ->where('products.parent_id', 0)
                ->where('products.gender', $genderid)
                ->where(function ($query) {
                    $query->whereNull('products.expiry_date')
                        ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
                ->where('brands.flags', 1)
                ->whereIn('shop_category_id', $category_id)
                ->with('shop_category', 'multi_images', 'prod_size.size')->limit($perPage)->get();
        }

        $data['parent_categories'] = ShopCategory::whereRaw("flags & ? = ?", [ShopCategory::FLAG_ACTIVE, ShopCategory::FLAG_ACTIVE])->where('parent_id', 0)->get();
        //$this->test($products);

        $totalProducts =  Product::select('products.*')->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
            ->where('products.parent_id', 0)
            ->where('products.gender', $genderid)
            ->where(function ($query) {
                $query->whereNull('products.expiry_date')
                    ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
            })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
            ->where('brands.flags', 1)
            ->whereIn('shop_category_id', $category_id)
            ->with('shop_category', 'multi_images', 'prod_size.size')->get()->count();

        $data['currentPage'] = $pageNumber;
        $data['hasMorePages'] = ($offset + $perPage) < $totalProducts;
        $data['totalProducts'] = $totalProducts;

        return view('frontend.category.category', $data);
    }


    public function product_category_load_more(Request $request)
    {
        //  $data['other-article'] = News::whereRaw("flags & ? = ?", [News::FLAG_ACTIVE, News::FLAG_ACTIVE])->with('brand')->where('section', 'Other Article')->orderBy('id', 'DESC')->limit(9)->get(); 

        $gender_slug = $request->input('gender', "man");
        $category_slug = $request->input('category', "accessories");

        $perPage = 50; // Number of products per page
        $pageNumber = $request->input('page', 1); // Get the page number from the request, default to 1
        $offset = ($pageNumber - 1) * $perPage;

        $gender = 0;
        $slug = "";

        # $data = $request->all();

        if ($gender_slug == 'man') {
            $gender = 1;
        } elseif ($gender_slug == 'woman') {
            $gender = 2;
        } elseif ($gender_slug == 'children') {
            $gender = 3;
        } else {
        }

        $data = [
            'gender' => $gender,
            'slug' => $category_slug,
        ];



        $slug = $data["slug"];


        if ($slug === null) {
            if ($gender_slug == 'menswear') {
                $slug = 'man';
            } elseif ($gender_slug == 'womenswear') {
                $slug = 'woman';
            } elseif ($gender_slug == 'children') {
                $slug = 'children';
            } else {
            }
        }

        if ($category_slug != null) {
            $categories = ShopCategory::where(["shop_cat_slug" => $slug, "parent_id" => $data["gender"]])->first();
            $gender = $data["gender"];

            $data["gender"] = $data["gender"];
        } else {

            $categories = ShopCategory::where(["shop_cat_slug" => $slug])
                // ->Where("parent_id", 0)
                ->first();
        }

        $data['category_name'] = $categories->shop_cat_name;
        $category_id = array($categories->id);


        //$product_shop_cat = $this->get_product_cat_shop($category->id);
        //return $data['products'] = $this->get_products($category->id);


        $data["category"] = $categories->id;


        $genderid = 0;
        if ($gender_slug == 'man') {
            $genderid = 1;
        }
        if ($gender_slug == 'woman') {
            $genderid = 2;
        }
        if ($gender_slug == 'children') {
            $genderid = 3;
        }
        if ($genderid == 0) {
            $data['products'] = Product::select('products.*')->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where('products.parent_id', 0)
                ->where(function ($query) {
                    $query->whereNull('products.expiry_date')
                        ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
                ->where('brands.flags', 1)
                ->whereIn('shop_category_id', $category_id)
                ->with('shop_category', 'multi_images', 'prod_size.size')->limit($perPage)->get();
        } else {
            $data['products'] = Product::select('products.*')->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
                ->where('products.parent_id', 0)
                ->where('products.gender', $genderid)
                ->where(function ($query) {
                    $query->whereNull('products.expiry_date')
                        ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
                ->where('brands.flags', 1)
                ->whereIn('shop_category_id', $category_id)
                ->with('shop_category', 'multi_images', 'prod_size.size')->limit($perPage)->get();
        }

        $data['parent_categories'] = ShopCategory::whereRaw("flags & ? = ?", [ShopCategory::FLAG_ACTIVE, ShopCategory::FLAG_ACTIVE])->where('parent_id', 0)->get();
        //$this->test($products);

        $totalProducts =  Product::select('products.*')->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
            ->where('products.parent_id', 0)
            ->where('products.gender', $genderid)
            ->where(function ($query) {
                $query->whereNull('products.expiry_date')
                    ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
            })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
            ->where('brands.flags', 1)
            ->whereIn('shop_category_id', $category_id)
            ->with('shop_category', 'multi_images', 'prod_size.size')->get()->count();



        $data['currentPage'] = $pageNumber;
        $data['hasMorePages'] = ($offset + $perPage) < $totalProducts;
        $data['totalProducts'] = $totalProducts;


        $products = $data['products'];



        if ($request->ajax()) {
            $brandNames = Brand::whereIn('id', $products->pluck('brand_id')->unique())->pluck('brand_name', 'id');
            $data['brandNames'] = $brandNames;
            return response()->json($data);
        }
    }



















    public function product_category_old(Request $request, $slug)
    {

        $data = $request->all();


        $gender = 0;

        if (isset($data["gender"])) {
            $categories = ShopCategory::where(["shop_cat_slug" => $slug, "parent_id" => $data["gender"]])->first();
            $gender = $data["gender"];

            $data["gender"] = $data["gender"];
        } else {

            $categories = ShopCategory::where(["shop_cat_slug" => $slug])
                // ->Where("parent_id", 0)
                ->first();
        }


        $data['category_name'] = $categories->shop_cat_name;
        $category_id = array($categories->id);


        //$product_shop_cat = $this->get_product_cat_shop($category->id);
        //return $data['products'] = $this->get_products($category->id);


        $data["category"] = $categories->id;

        $genderid = 0;
        if ($request->slug == 'man') {
            $genderid = 1;
        }
        if ($request->slug == 'woman') {
            $genderid = 2;
        }
        if ($request->slug == 'children') {
            $genderid = 3;
        }
        if ($genderid == 0) {
            $data['products'] = Product::select('products.*')->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where('products.parent_id', 0)
                ->where(function ($query) {
                    $query->whereNull('products.expiry_date')
                        ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
                ->where('brands.flags', 1)
                ->whereIn('shop_category_id', $category_id)
                ->with('shop_category', 'multi_images', 'prod_size.size')->get();
        } else {
            $data['products'] = Product::select('products.*')->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
                ->where('products.parent_id', 0)
                ->where('products.gender', $genderid)
                ->where(function ($query) {
                    $query->whereNull('products.expiry_date')
                        ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
                ->where('brands.flags', 1)
                //->whereIn('shop_category_id', $category_id)
                ->with('shop_category', 'multi_images', 'prod_size.size')->get();
        }


        $data['parent_categories'] = ShopCategory::whereRaw("flags & ? = ?", [ShopCategory::FLAG_ACTIVE, ShopCategory::FLAG_ACTIVE])->where('parent_id', 0)->get();
        //$this->test($products);
        return view('frontend.category.category', $data);
    }























    public function shop_products(Request $request)
    {
        delete_size_not_exits();

        $pageNumber = $request->input('page', 1); // Get the page number from the request, default to 1
        $perPage = 50; // Number of products per page

        $offset = ($pageNumber - 1) * $perPage;

        $products = Product::select('products.*')
            ->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
            ->where('products.parent_id', 0)
            ->where(function ($query) {
                $query->whereNull('products.expiry_date')
                    ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
            })
            ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
            ->where('brands.flags', 1)
            ->with('shop_category')
            ->with('brand')
            // ->inRandomOrder()
            ->offset($offset)
            ->limit($perPage)
            ->get();

        $totalProducts = Product::select('products.*')
            ->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
            ->where('products.parent_id', 0)
            ->where(function ($query) {
                $query->whereNull('products.expiry_date')
                    ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
            })
            ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
            ->where('brands.flags', 1)
            ->count();

        $parentCategories = ShopCategory::whereRaw("flags & ? = ?", [ShopCategory::FLAG_ACTIVE, ShopCategory::FLAG_ACTIVE])
            ->where('parent_id', 0)
            ->get();

        $shopCategories = $this->get_shop_categories();

        $data = [
            'products' => $products,
            'parent_categories' => $parentCategories,
            'shop_categories' => $shopCategories,
            'currentPage' => $pageNumber,
            'hasMorePages' => ($offset + $perPage) < $totalProducts,
            'totalProducts' => $totalProducts,
            'pageNumber' => $pageNumber,
        ];

        if ($request->ajax()) {

            $brandNames = Brand::whereIn('id', $products->pluck('brand_id')->unique())->pluck('brand_name', 'id');
            $data['brandNames'] = $brandNames;

            // If it's an AJAX request, return a JSON response
            return response()->json($data);
        }

        // If not an AJAX request, return the view
        return view('frontend.shop.shop-product', $data);
    }













    public function shop_products_1a()
    {
        delete_size_not_exits();

        $products = Product::select('products.*')
            ->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
            ->where('products.parent_id', 0)
            ->where(function ($query) {
                $query->whereNull('products.expiry_date')
                    ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
            })
            ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
            ->where('brands.flags', 1)
            ->with('shop_category')
            ->limit(5)
            ->get();

        $parentCategories = ShopCategory::whereRaw("flags & ? = ?", [ShopCategory::FLAG_ACTIVE, ShopCategory::FLAG_ACTIVE])
            ->where('parent_id', 0)
            ->get();

        $shopCategories = $this->get_shop_categories();

        $data = [
            'products' => $products,
            'parent_categories' => $parentCategories,
            'shop_categories' => $shopCategories,
        ];

        if (request()->ajax()) {
            // If it's an AJAX request, return a JSON response
            return response()->json($data);
        }

        // If not an AJAX request, return the view
        return view('frontend.shop.shop-product', $data);
    }













    public function child_categiries($id)
    {
        $cat = [];
        $categories = shop_categories::where("parent_id", $id)->get();
        foreach ($categories as $key => $c) {
            $cat[$key] = $c->id;
        }

        return $cat;
    }

    public function shop_price(Request $request)
    {
        $data['products'] = Product::whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
            ->where('parent_id', 0)
            ->where(function ($query) {
                $query->whereNull('products.expiry_date')
                    ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
            })
            ->whereBetween('sale_price', [$request->min, $request->max])
            ->with('shop_category')
            ->get();

        $data['count'] = Product::whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where('parent_id', 0)->where(function ($query) {
            $query->whereNull('products.expiry_date')
                ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
        })->with('shop_category')->count();
        $data['selected'] = count($data['products']);
        $data["html"] = view('frontend.shop.product-filter-ajax', $data)->render();
        return $data;

        //return view('frontend.shop.product-filter-ajax', $data);
    }

    public function shop_gender(Request $request)
    {
        $sizes = array();


        if ((int)$request->gender > 0) {

            $cd = $this->child_categiries($request->gender);
            $scat = ShopCategory::where("parent_id", (int)$request->gender)
                ->groupBy("shop_cat_slug")
                ->get();
            $sizes = Size::select(["sizes.*"])
                ->join("category_sizes", "category_sizes.size_id", "=", "sizes.id")
                ->whereIn("category_sizes.category_id", $cd)
                ->groupBy("sizes.id")
                ->get();
        }
        if (strlen($request->categories) > 1) {

            $ar = [];
            $shop_cats = ShopCategory::where("shop_cat_slug", $request->categories)->get();

            foreach ($shop_cats as $i => $sc) {
                $a[$i] = $sc->id;
            }

            $sizes = Size::select(["sizes.*"])
                ->join("category_sizes", "category_sizes.size_id", "=", "sizes.id")
                ->whereIn("category_sizes.category_id", $a)
                ->groupBy("sizes.id", "sizes.size")
                ->get();

            $scat = ShopCategory::where("parent_id", ">", 0)
                ->groupBy("shop_cat_slug")
                ->get();
        } else {

            // $sizes=Size::select(["sizes.*"])->get();
            // $sizes=Size::all();

            $scat = ShopCategory::where("parent_id", ">", 0)
                ->groupBy("shop_cat_slug")
                ->get();
        }
        $data["sizes"] = json_encode($sizes);
        $data["scat"] = json_encode($scat);


        if ((int)$request->gender > 0 && strlen($request->categories) > 1 && (int)$request->brand > 0) {

            $products = $this->child_categiries($request->gender);
            if ($products) {
                $p = Product::select(["products.*", "shop_categories.*", "products.id as id"])
                    ->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
                    ->join("shop_categories", "shop_categories.id", "=", "products.shop_category_id")
                    ->where("shop_categories.shop_cat_slug", $request->categories)
                    ->where("products.parent_id", 0)
                    ->where(function ($query) {
                        $query->whereNull('products.expiry_date')
                            ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                    })
                    ->whereIn("products.shop_category_id", $products)
                    //->where("products.shop_category_id", $request->categories)
                    ->where('products.brand_id', $request->brand);

                if (isset($request->sizes) && (int)$request->sizes > 0) {
                    $p->join("product_sizes", "product_sizes.product_id", "=", "products.id");
                    $p->where("product_sizes.size_id", (int)$request->sizes);
                }


                $p->groupBy("products.id");
                $p->with('shop_category');


                $data['products'] = $p->get();
                // $data['count'] = Product::whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where('parent_id', 0)->with('shop_category')->get();
                // return view('frontend.shop.product-filter-ajax', $data);
                $data['count'] = Product::whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where('parent_id', 0)->where(function ($query) {
                    $query->whereNull('products.expiry_date')
                        ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                })->with('shop_category')->count();
                $data['selected'] = count($data['products']);
                $data["html"] = view('frontend.shop.product-filter-ajax', $data)->render();
                return $data;
            }
        }


        if ((int)$request->gender > 0 && strlen($request->categories) > 1) {

            $products = $this->child_categiries($request->gender);

            $p = Product::select(["products.*", "shop_categories.*", "products.id as id"])
                ->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
                ->join("shop_categories", "shop_categories.id", "=", "products.shop_category_id")
                ->where("shop_categories.shop_cat_slug", $request->categories)
                ->where(function ($query) {
                    $query->whereNull('products.expiry_date')
                        ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                })
                ->where("products.parent_id", 0)
                ->whereIn("products.shop_category_id", $products);
            if (isset($request->sizes) && (int)$request->sizes > 0) {
                $p->join("product_sizes", "product_sizes.product_id", "=", "products.id");
                $p->where("product_sizes.size_id", (int)$request->sizes);
            }

            $p->with('shop_category');
            $p->groupBy("products.id");
            $data['products'] = $p->get();
            // $data['count'] = Product::whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where('parent_id', 0)->with('shop_category')->get();
            // return view('frontend.shop.product-filter-ajax', $data);
            $data['count'] = Product::whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where('parent_id', 0)->where(function ($query) {
                $query->whereNull('products.expiry_date')
                    ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
            })->with('shop_category')->count();
            $data['selected'] = count($data['products']);
            $data["html"] = view('frontend.shop.product-filter-ajax', $data)->render();
            return $data;
        } elseif (strlen($request->categories) > 1 && (int)$request->brand > 0) {


            $p = Product::select(["products.*", "shop_categories.*", "products.id as id"])
                ->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
                ->join("shop_categories", "shop_categories.id", "=", "products.shop_category_id")
                ->where("shop_categories.shop_cat_slug", $request->categories)
                ->where(function ($query) {
                    $query->whereNull('products.expiry_date')
                        ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                })
                ->where('products.parent_id', 0)
                // ->where("products.shop_category_id", $request->categories)
                ->where('products.brand_id', $request->brand);

            if (isset($request->sizes) && (int)$request->sizes > 0) {
                $p->join("product_sizes", "product_sizes.product_id", "=", "products.id");
                $p->where("product_sizes.size_id", (int)$request->sizes);
            }

            $p->with('shop_category');
            $p->groupBy("products.id");
            $data['products'] = $p->get();
            //   $data['count'] = Product::whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where('parent_id', 0)->with('shop_category')->get();
            // return view('frontend.shop.product-filter-ajax', $data);
            $data['count'] = Product::whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where('parent_id', 0)->where(function ($query) {
                $query->whereNull('products.expiry_date')
                    ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
            })->with('shop_category')->count();
            $data['selected'] = count($data['products']);
            $data["html"] = view('frontend.shop.product-filter-ajax', $data)->render();
            return $data;
        } elseif (strlen($request->categories) > 1) {

            $p = Product::select(["products.*", "shop_categories.*", "products.id as id"])
                ->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
                ->join("shop_categories", "shop_categories.id", "=", "products.shop_category_id")
                ->where("shop_categories.shop_cat_slug", $request->categories)
                ->where(function ($query) {
                    $query->whereNull('products.expiry_date')
                        ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                })
                ->where('products.parent_id', 0);
            // ->where("products.shop_category_id", $request->categories)
            if (isset($request->sizes) && (int)$request->sizes > 0) {
                $p->join("product_sizes", "product_sizes.product_id", "=", "products.id");
                $p->where("product_sizes.size_id", (int)$request->sizes);
            }


            $p->with('shop_category');
            $p->groupBy("products.id");
            $data['products'] = $p->get();
            $data['count'] = Product::whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where('parent_id', 0)->where(function ($query) {
                $query->whereNull('products.expiry_date')
                    ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
            })->with('shop_category')->count();
            $data['selected'] = count($data['products']);
            $data["html"] = view('frontend.shop.product-filter-ajax', $data)->render();
            return $data;
        } elseif ((int)$request->brand > 0) {
            $p = Product::select(["products.*", "shop_categories.*", "products.id as id"])
                ->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
                ->join("shop_categories", "shop_categories.id", "=", "products.shop_category_id")
                ->where('products.parent_id', 0)
                ->where(function ($query) {
                    $query->whereNull('products.expiry_date')
                        ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                })
                ->where('products.brand_id', $request->brand);
            if (isset($request->sizes) && (int)$request->sizes > 0) {
                $p->join("product_sizes", "product_sizes.product_id", "=", "products.id");
                $p->where("product_sizes.size_id", (int)$request->sizes);
            }

            $p->with('shop_category');
            $p->groupBy("products.id");


            $data['products'] = $p->get();
            //   $data['count'] = Product::whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where('parent_id', 0)->with('shop_category')->get();
            // return view('frontend.shop.product-filter-ajax', $data);
            $data['count'] = Product::whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where('parent_id', 0)->where(function ($query) {
                $query->whereNull('products.expiry_date')
                    ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
            })->with('shop_category')->count();
            $data['selected'] = count($data['products']);
            $data["html"] = view('frontend.shop.product-filter-ajax', $data)->render();
            return $data;
        } elseif ((int)$request->gender > 0) {


            $products = $this->child_categiries($request->gender);
            if ($products) {
                $p = Product::select(["products.*", "shop_categories.*", "products.id as id"])
                    ->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
                    ->join("shop_categories", "shop_categories.id", "=", "products.shop_category_id")
                    ->where('products.parent_id', 0)
                    ->where(function ($query) {
                        $query->whereNull('products.expiry_date')
                            ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                    })
                    ->whereIn("products.shop_category_id", $products);

                if (isset($request->sizes) && (int)$request->sizes > 0) {
                    $p->join("product_sizes", "product_sizes.product_id", "=", "products.id");
                    $p->where("product_sizes.size_id", (int)$request->sizes);
                }

                $p->with('shop_category');
                $p->groupBy("products.id");
                $data['products'] = $p->get();
                //   $data['count'] = Product::whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where('parent_id', 0)->with('shop_category')->get();
                // return view('frontend.shop.product-filter-ajax', $data);
                $data['count'] = Product::whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where('parent_id', 0)->where(function ($query) {
                    $query->whereNull('products.expiry_date')
                        ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                })->with('shop_category')->count();
                $data['selected'] = count($data['products']);
                $data["html"] = view('frontend.shop.product-filter-ajax', $data)->render();
                return $data;
            }
        } else {
            $p = Product::whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
                ->where('parent_id', 0)
                ->where(function ($query) {
                    $query->whereNull('products.expiry_date')
                        ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                })
                ->groupBy("products.id");

            if (isset($request->sizes) && (int)$request->sizes > 0) {
                $p->join("product_sizes", "product_sizes.product_id", "=", "products.id");
                $p->where("product_sizes.size_id", (int)$request->sizes);
            }


            $p->with('shop_category');
            $p->groupBy("products.id");
            $data['products'] = $p->get();
            //   $data['count'] = Product::whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where('parent_id', 0)->with('shop_category')->get();
            // return view('frontend.shop.product-filter-ajax', $data);
            $data['count'] = Product::whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where('parent_id', 0)->where(function ($query) {
                $query->whereNull('products.expiry_date')
                    ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
            })->with('shop_category')->count();
            $data['selected'] = count($data['products']);
            $data["html"] = view('frontend.shop.product-filter-ajax', $data)->render();
            return $data;
        }
    }

    //tester alwyas test
    public function test($data)
    {
        echo "<pre>";
        print_r($data);
        die;
    }

    //products-parent id
    public function get_parent_id_for_products($parent_id, $category)
    {
        $product_ids = \DB::table('product_cat_shops')->distinct()->where($category, $parent_id)->pluck('product_id')->toArray();
        //$this->test($parent_id);
        return $product_ids;
    }

    //get all products of thier parents according
    public function get_products($category_id)
    {

        $products = Product::whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where('parent_id', 0)->where(function ($query) {
            $query->whereNull('products.expiry_date')
                ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
        })->whereIn('shop_category_id', $category_id)->with('shop_category', 'multi_images', 'prod_size.size')->get();
        return $products;
    }

    public function start_selling_home()
    {
        return view('frontend.home.start-selling');
    }

    //get all parents
    public function get_parent()
    {
        $parents_data = \DB::table('shop_categories')->whereRaw("flags & ? = ?", [ShopCategory::FLAG_ACTIVE, ShopCategory::FLAG_ACTIVE])->where('parent_id', 0)->pluck('id')->toArray();
        return $parents_data;
    }

    // this will provide all shop categories
    public function get_shop_categories($genderVal = null)
    {
        // $this->test($parents);
        // $shop_categery = \DB::table('shop_categories')->whereRaw("flags & ? = ?", [ShopCategory::FLAG_ACTIVE, ShopCategory::FLAG_ACTIVE])->get();
        // return $shop_categery;

        $query = \DB::table('shop_categories')->whereRaw("flags & ? = ?", [ShopCategory::FLAG_ACTIVE, ShopCategory::FLAG_ACTIVE]);

        if ($genderVal !== null) {

            $query->where('parent_id', $genderVal);
        }

        $shop_categery = $query->get();

        // dd($shop_categery);
        return $shop_categery;
    }

    //this funtion for shop category id and it will provide all products ids
    public function get_product_cat_shop($id)
    {

        $product_ids = \DB::table('product_cat_shops')->distinct()->where('shop_cat_id', $id)->pluck('product_id')->toArray();
        return $product_ids;
    }

    //you need shop category and this will give full data
    public function get_slug($slug)
    {
        $child_category = \DB::table('shop_categories')->where('shop_cat_slug', $slug)->whereRaw("flags & ? = ?", [ShopCategory::FLAG_ACTIVE, ShopCategory::FLAG_ACTIVE])->first();

        return $child_category;
    }

    public function wishlist()
    {
        $data['wishlists'] = array();
        if (auth()->check()) {
            $data['wishlists'] = Wishlist::select(["wishlists.*", "size"])
                ->where('user_id', auth()->user()->id)
                ->join("sizes", "sizes.id", "=", "wishlists.size_id")
                ->with('user', 'product')->get();
        }
        return view('frontend.wishlist.wishlist', $data);
    }


    public function view_all_brands()
    {
        $data['brands'] = Brand::whereRaw("flags & ? = ?", [Brand::FLAG_ACTIVE, Brand::FLAG_ACTIVE])->orderBy('brand_name')->get();
        return view('frontend.brand.view-all-brands', $data);
    }

    public function register_user(Request $request)
    {

        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'string',
            ],
            'confirm_password' => 'required|same:password',

        ]);
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = (!empty($request->phone) ? $request->phone : null);
        $user->gender = (!empty($request->gender) ? $request->gender : null);
        $user->addFlag(User::FLAG_ACTIVE);
        $user->user_type = 2;
        $user->save();
        $request_vendor = new RequestVendor();
        $request_vendor->request_become_a_vendor = true;
        $request_vendor->user_id = $user->id;
        $request_vendor->flags = 2;
        if ($request_vendor->save()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'flags' => 1])) {

                return redirect(route('update_account'));
            }

            //return back()->with(['message' => "User Register Successfully And Become A Vendor Request Is Successful"]);
        } else {
            return back()->with(['error' => "User Is not Valid Please Try Again"]);
        }
    }

    public function register_users(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'string',
            ],
            'confirm_password' => 'required|same:password',

        ]);
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = (!empty($request->phone) ? $request->phone : null);
        $user->gender = (!empty($request->gender) ? $request->gender : null);
        $user->addFlag(User::FLAG_ACTIVE);
        $user->user_type = 0;
        $user->save();
        $request_vendor = new RequestVendor();
        $request_vendor->request_become_a_vendor = true;
        $request_vendor->user_id = $user->id;
        $request_vendor->flags = 2;
        if ($request_vendor->save()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'flags' => 1])) {

                return redirect(route('update_account'));
            }

            //return back()->with(['message' => "User Register Successfully And Become A Vendor Request Is Successful"]);
        } else {
            return back()->with(['error' => "User Is not Valid Please Try Again"]);
        }
    }




    public function product_brand($brandSlug)
    {
        $data["brand_slug"] = $brandSlug;
        $data['brand'] = Brand::whereRaw("flags & ? = ?", [Brand::FLAG_ACTIVE, Brand::FLAG_ACTIVE])->where('brand_slug', $brandSlug)->first();
        $data['products'] = Product::whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where('parent_id', 0)->where(function ($query) {
            $query->whereNull('products.expiry_date')
                ->orWhereDate('products.expiry_date', '>=', now());
        })->whereHas('brand', function ($query) use ($brandSlug) {
            $query->where('brand_slug', $brandSlug);
        })->with('brand')->get();

        $data['parent_categories'] = ShopCategory::whereRaw("flags & ? = ?", [ShopCategory::FLAG_ACTIVE, ShopCategory::FLAG_ACTIVE])->where('parent_id', 0)->get();
        return view('frontend.brand.brand', $data);
    }






    public function product_brand_old($id)
    {
        $data["brand_id"] = $id;
        $data['brand'] = Brand::whereRaw("flags & ? = ?", [Brand::FLAG_ACTIVE, Brand::FLAG_ACTIVE])->where('id', $id)->first();
        $data['products'] = Product::whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where('parent_id', 0)->where(function ($query) {
            $query->whereNull('products.expiry_date')
                ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
        })->where('brand_id', $id)->with('brand')->get();
        $data['parent_categories'] = ShopCategory::whereRaw("flags & ? = ?", [ShopCategory::FLAG_ACTIVE, ShopCategory::FLAG_ACTIVE])->where('parent_id', 0)->get();

        return view('frontend.brand.brand', $data);
    }

    public function privacy_policy()
    {
        return view('frontend.home.privacy-policy');
    }

    public function buying()
    {
        return view('frontend.home.buying');
    }



    public function add_cart(Request $request)
    {
        $status = "true";

        $product = ProductSize::where("product_sizes.id", $request->product_id)
            ->join("products", "products.id", "=", "product_sizes.product_id")
            ->first();

        if (isset(auth::user()->id)) {


            $cart = Cart::where(["product_id" => $product->product_id, "variation_id" => $request->product_id, "user_id" => auth::user()->id])->get();

            if (count($cart) > 0) {
                Cart::where('id', $cart[0]->id)
                    ->update(['quantity' => \DB::raw('quantity + 1'), "size_id" => $product->size_id]);
            } else {

                $cart = new Cart();
                $cart->product_id = $product->product_id;
                $cart->variation_id = $request->product_id;
                $cart->user_id = auth::user()->id;
                $cart->quantity = 1;
                $cart->size_id = $request->size_id;
                $cart->save();
            }
        } else {

            $status = "false";
        }


        return response()->json([

            "status" => $status


        ]);
    }



    public function admin_cart(Request $request)
    {
        $status = "true";

        $userId = auth()->user();


        if (isset($userId->id)) {

            $cartItem = CartItem::where([
                "user_id" => $userId->id
            ])->first();

            $product = Product::find($request->product_id);

            if ($product) {

                if ($product->sale_price !== null) {

                    $price = $product->sale_price;
                } else {

                    $price = $product->regular_price;
                }
            } else {

                $price = 0;
            }

            if ($cartItem) {
                CartItem::where([
                    "user_id" => $userId->id
                ])->update([
                    'total_price' => $cartItem->total_price + ($request->quantity * $price)

                ]);
            } else {
                // Create a new entry in the cartitem table
                $cartItem = new CartItem();
                $cartItem->user_id = $userId->id;

                $cartItem->total_price = $request->quantity * $price;
                // Adjust this based on your actual pricing logic
                $cartItem->save();
            }




            // Add the cartitem ID to the cart table

            // Find the existing cart item for the same product and user
            $existingCartItem = Cart::where('product_id', $request->product_id)
                ->where('user_id', $userId->id)
                ->where('size_id', $request->size_id)
                ->where('variation_id', $request->variation)
                ->first();

            if ($existingCartItem) {
                // If the product already exists in the cart, update the quantity
                $existingCartItem->update([
                    'quantity' => $existingCartItem->quantity + $request->quantity,
                ]);
            } else {
                // If the product doesn't exist, create a new cart item
                $cart = new Cart();
                $cart->product_id = $request->product_id;
                $cart->user_id = $userId->id;
                $cart->quantity = $request->quantity;
                $cart->size_id = $request->size_id;
                $cart->variation_id = $request->variation;
                $cart->cart_id = $cartItem->id; // Assuming cart_id is used to store the cartitem ID
                $cart->save();
            }
        } else {
            $status = "false";
        }

        return response()->json([
            "status" => $status
        ]);
    }



    public function admin_cart_old(Request $request)
    {
        $status = "true";


        if (isset(auth::user()->id)) {


            $cart = Cart::where(["product_id" => $request->product_id, "size_id" => $request->size_id, "user_id" => auth::user()->id])->get();
            if (count($cart) > 0) {


                Cart::where('id', $cart[0]->id)
                    ->update(['quantity' => \DB::raw('quantity + ' . $request->quantity), "size_id" => $request->size_id, "variation_id" => $request->variation]);
            } else {
                $cart = new Cart();
                $cart->product_id = $request->product_id;
                $cart->user_id = auth::user()->id;
                $cart->quantity = $request->quantity;
                $cart->size_id = $request->size_id;
                $cart->variation_id = $request->variation;
                $cart->save();
            }
        } else {


            $status = "false";
        }

        return response()->json([

            "status" => $status


        ]);
    }

    public function back($product_id = 0, $variation_id, $cancel = 1)
    {

        return $this->single_page($product_id, $cancel, $variation_id);
    }


    public function search_title(Request $request)
    {
        // DB::enableQueryLog();
        // $records = Product::whereColumn('regular_price', '=', 'sale_price')->where('id',  76)->first();
        // dd($records);
        // dd(DB::getQueryLog());

        $values = $request->all();
        $records = Product::select('products.*')->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where(function ($query) {
            $query->whereNull('products.expiry_date')
                ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
        });
        $records->leftJoin('brands', 'brands.id', '=', 'products.brand_id')
            ->select('products.*', 'brands.brand_name') // Select the brand name
            ->with('brand')
            ->where('brands.flags', 1);


        if (strlen($values["search"]) > 0) {
            $records->where('products.product_name', 'like', '%' . $values["search"] . '%');
        }

        $records->where('parent_id', 0);

        if (strlen($values["sort"]) > 0) {
            if ($values["sort"] == "newness") {
                $records->orderBy('products.id', 'desc');
            } elseif ($values["sort"] == "popularity") {
                $records->leftjoin("order_details", "order_details.product_id", "=", "products.id");
                $records->groupBy("products.id");
                $records->select("products.*", DB::raw('COUNT(order_details.product_id) as count'));
                $records->orderBy(DB::raw('COUNT(order_details.product_id)'), 'asc');
            } elseif ($values["sort"] == "low_to_high") {
                $records->where('products.sale_price', '>', 0);
                $records->orderBy('products.sale_price', 'asc');
            } elseif ($values["sort"] == "high_to_low") {
                $records->orderBy('products.regular_price', 'desc');
                $records->orderBy('products.sale_price', 'desc');
            }
        } else {
            $values["sort"] = "default";
        }
        $gender_filter = array();
        // new filter added
        // min max price filter
        if (isset($_GET['min'])) {
            $records->where(function ($query) {
                $query->where('products.sale_price', '>=', $_GET['min'])
                    ->orWhere('products.regular_price', '>=', $_GET['min']);
            });
        }
        if (isset($_GET['max'])) {
            $records->where(function ($query) {
                $query->where('products.sale_price', '<=', $_GET['max'])
                    ->orWhere('products.regular_price', '<=', $_GET['max']);
            });
        }
        if (isset($_GET['new_product'])) {
            $records->where('products.created_at', '>', Carbon::now()->subDays(14));
        }
        if (isset($_GET['on_sale'])) {
            $records->where('products.sale_price', '>', 0);
            $records->whereColumn('products.regular_price', ">", 'products.sale_price');
        }
        // min max price filter
        if (isset($_GET['menswear'])) {
            array_push($gender_filter, 1);
        }
        if (isset($_GET['womenswear'])) {
            array_push($gender_filter, 2);
        }
        if (isset($_GET['childern'])) {
            array_push($gender_filter, 3);
        }
        if (count($gender_filter) > 0) {
            $records->whereIn('products.gender', $gender_filter);
        }
        // category filter 
        $shopCategoryId = array();
        if (isset($_GET['categories'])) {
            if (count($_GET['categories']) > 0) {
                $categoryList = $_GET['categories'];
                foreach ($categoryList as $row) {
                    $child_cats = ShopCategory::whereRaw("flags & ? = ?", [ShopCategory::FLAG_ACTIVE, ShopCategory::FLAG_ACTIVE])
                        ->where('parent_id', '>', 0)
                        ->where('shop_cat_slug', $row)
                        ->pluck('id')->toArray();
                    if ($child_cats) {
                        array_push($shopCategoryId, $child_cats);
                    }
                }
            }
        }
        $shop_category_id = array();
        if (count($shopCategoryId) > 0) {
            foreach ($shopCategoryId as $row) {
                if (count($row) > 0) {
                    foreach ($row as $innerarray) {
                        array_push($shop_category_id, $innerarray);
                    }
                }
            }
        }
        if (count($shop_category_id) > 0) {
            $records->whereIn('products.shop_category_id', $shop_category_id);
        }
        // category filter 
        // brand filter 
        $brandIds = array();
        if (isset($_GET['brands'])) {
            if (count($_GET['brands']) > 0) {
                $brandList = $_GET['brands'];
                foreach ($brandList as $row) {
                    array_push($brandIds, $row);
                }
            }
        }
        if (count($brandIds) > 0) {
            $records->whereIn('products.brand_id', $brandIds);
        }
        // dd($gender_filter , $brandIds, $shopCategoryId);

        // brand filter 
        // size filter 
        $sizeArray = array();
        if (isset($_GET['size'])) {
            if (count($_GET['size']) > 0) {
                $sizeList = $_GET['size'];
                foreach ($sizeList as $row) {
                    $all_sizes = Size::where('flags', 1)->where('size', $row)
                        ->pluck('id')->toArray();
                    if ($all_sizes) {
                        array_push($sizeArray, $all_sizes);
                    }
                }
            }
        }
        $size_id_array = array();
        if (count($sizeArray) > 0) {
            foreach ($sizeArray as $row) {
                if (count($row) > 0) {
                    foreach ($row as $innerarray) {
                        array_push($size_id_array, $innerarray);
                    }
                }
            }
        }
        if (count($size_id_array) > 0) {
            $records->leftJoin('product_sizes', 'product_sizes.product_id', '=', 'products.id')->whereNull('product_sizes.deleted_at')
                ->whereIN('product_sizes.size_id', $size_id_array)->where('product_sizes.flags', 1)->groupBy('products.id');
        }
        //size filter 


        // new filter added

        $records->with('shop_category');


        $pageNumber = $request->input('page', 1); // Get the page number from the request, default to 1
        $perPage = 50; // Number of products per page

        $offset = ($pageNumber - 1) * $perPage;

        $totalProducts = $records->get()->count();

        //$data['products'] = $records->paginate($perPage);
        //$data['products'] = $records->get();

        $totalPages = ceil($totalProducts / $perPage);


        $data['products'] = $records->offset($offset)->limit($perPage)->get();

        $data['totalProducts'] = $totalProducts;
        $data['currentPage'] = $pageNumber;

        if ($totalPages > $pageNumber) {
            $data['hasMorePages'] = 1;
        } else {
            $data['hasMorePages'] = 0;
        }
        if($gender_filter == null){
            $gender_filter[0] = 1;
        }
        $genderVal = $gender_filter[0];

        $data['parent_categories'] = ShopCategory::whereRaw("flags & ? = ?", [ShopCategory::FLAG_ACTIVE, ShopCategory::FLAG_ACTIVE])->where('parent_id', 0)->get();
        $data['shop_categories'] = $this->get_shop_categories($genderVal);
        $data['search'] = $values["search"];

        $data["sort"] = $values["sort"];

        
        if ($request->ajax()) {
            return response()->json($data);
        } else {
            return view('frontend.shop.search-product-filter', $data , compact('data'));
        }
    }







































    public function sizes()
    {

        $sizes = Size::all();

        foreach ($sizes as $size) {
            $s = Size::find($size->id);
            $s->size_id = $size->id;
            $s->save();
        }

        echo "Done";
    }

    public function lost_password()
    {
        return view("lost_password");
    }

    public function lost_email(Request $request)
    {
        $user = User::where("email", $request->email)->get();


        if (count($user) == 0) {


            return redirect()->back()->with('error', 'Email Does not exist');
        }
        $da = rand(100, 100000);


        $details = [

            'title' => 'Mail from Market-place',

            'body' => 'Changing password market-place',
            'da' => $da


        ];


        $user = User::find($user[0]->id);
        //$user->password = Hash::make($request->password);
        $user->otp = $da;
        $user->save();


        //\Mail::to($request->email)->send(new \App\Mail\MyTestMail($details));

        return view('change_password', ["user" => $user]);

        //return redirect()->back()->with('message', 'Password changed successfully');
    }

    public function change_passwords(Request $request)
    {
        $data = $request->all();

        $users = User::where(["id" => $data["id"], "otp" => $data["otp"]])->get();

        if (count($users) > 0) {


            $user = User::find($data["id"]);
            $user->password = Hash::make($data["password"]);
            $user->save();

            return redirect()->route("login.login")->with('message', 'Password changed successfully');
        }

        return redirect()->route("login.login")->with('error', 'OTP does not match');
    }

    public function comingSoonPage()
    {
        return view('frontend.home.coming-soon');
    }
    public function services_list_page()
    {
        return view('frontend.home.services_list_page');
    }

    public function terms_condition()
    {
        return view('frontend.home.terms-condition');
    }

    public function faq()
    {
        return view('frontend.home.faq');
    }

    public function about_us()
    {
        $data['banner_images'] = Aboutus::where('about_type_key', 'banner_images')->where('flags', 1)->whereNotNull('image')->orderBy('id', 'DESC')->get();
        $data['influencer_images'] = Aboutus::where('about_type_key', ['influencer_images'])->where('flags', 1)->whereNotNull('image')->orderBy('id', 'DESC')->get();
        $data['testimonial_images'] = Aboutus::where('about_type_key', ['testimonial_images'])->where('flags', 1)->whereNotNull('image')->orderBy('id', 'DESC')->get();
        $data['industry_data'] = Aboutus::where('about_type_key', ['industry_data'])->where('flags', 1)->whereNotNull('image')->orderBy('id', 'DESC')->get();
        $data['statistics'] = Aboutus::where('about_type_key', ['statistics'])->where('flags', 1)->whereNotNull('image')->orderBy('id', 'DESC')->get();

        $data['our_story'] = Aboutus::where('about_type_key', 'our_story')->where('flags', 1)->first();
        $data['our_mission'] = Aboutus::where('about_type_key', 'our_mission')->where('flags', 1)->first();
        $data['our_vision'] = Aboutus::where('about_type_key', 'our_vision')->where('flags', 1)->first();

        $data['our_team'] = Aboutus::where('about_type_key', 'our_team')->where('flags', 1)->orderBy('id', 'DESC')->get();
        $data['key_metrics'] = Aboutus::where('about_type_key', 'key_metrics')->where('flags', 1)->orderBy('id', 'asc')->get();

        $data['total_brands'] = Brand::where('flags', 1)->get()->count();
        //$data['total_product'] = Product::where('flags',1)->get()->count();
        // $data['total_user'] = User::where('emailVerify',1)->get()->count();

        $data['total_users'] = User::where('user_type', '!=', 0)->get()->count();
        // $data['total_users'] = User::where('user_type', 2)->get()->count();
        $data['total_seller'] = User::where('user_type', 1)->where('affiliate_status', '0')->get()->count();

        $data['total_product'] = Product::select('products.*')->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where('products.parent_id', 0)->where(function ($query) {
            $query->whereNull('products.expiry_date')
                ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
        })->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags', 1)->with('shop_category')->get()->count();


        $data['contact_us_url'] =  Aboutus::where('about_type_key', 'contact_us_url')->where('flags', 1)->first();
        $data['instagram_url']  = Aboutus::where('about_type_key', 'instagram_url')->where('flags', 1)->first();

        return view('frontend.home.about-us', $data);
    }

    public function contact_us()
    {
        return view('frontend.home.contact-us');
    }

    // by bbz developer
    public function ContactUsStore(Request $request)
    {
        // Validate the request data
        $validate = $request->validate([
            'email' => 'required',
            'subject' => 'required',
            'description' => 'required',
            'reason' => 'required',
            'phone' => 'required',
        ]);

        if ($validate) {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $filename = rand('11111', '99999') . '.' . $extension;
                $file->move('uploads/', $filename);
                $request->file = $filename;
            } else {
                $filename = '';
            }

            // Create a new Contact record
            $insert = Contact::create([
                'email' => $request->email,
                'subject' => $request->subject,
                'description' => $request->description,
                'phone' => $request->phone,
                'order_no' => $request->order_no,
                'reason' => $request->reason,
                'file' => $filename,
            ]);

            // Pass the data, attachment path, and dynamic subject to the Mailable class and send the email
            $attachmentPath = public_path('uploads/' . $filename);
            Mail::to('h.wynne12@hotmail.com')->send(new SendContactMail($request->all(), $attachmentPath));
        }
        return redirect()->back();
    }

    public function thankyou($id)
    {
        // $order = Order::where('reference', $id)->with('user', 'order_detail', 'order_detail.product', 'order_detail.product.product_user', 'order_detail.product.product_parent', 'order_detail.product.brand', 'order_detail.size_detail', "shipping_addresses", "order_detail.product.prod_size_one")->first();
        // $billing  = BillingAddresses::where('order_id', $order->id)->first();
        // $shipping = ShippingAddresses::where('order_id', $order->id)->first();
        // return view('thankyou', compact('order', 'billing', 'shipping'));

        return view('thankyou', ["reference" => $id]);
    }

    public function vendor_agreement_policy()
    {
        return view('frontend.home.vendor-agreement-policy');
    }

    public function copyright_policy()
    {
        return view('frontend.home.copyright-policy');
    }

    public function shipping_policy()
    {
        return view('frontend.home.shipping-policy');
    }

    public function return_refund()
    {
        return view('frontend.home.return-refund');
    }

    public function disclaimer()
    {
        return view('frontend.home.disclaimer');
    }
}
