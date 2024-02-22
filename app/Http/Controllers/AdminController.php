<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Brand;
use App\Models\Setting;
use App\Models\ShopCategory;
use App\Models\ProductCatShop;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Traffic;
use Carbon\Carbon;
use App\Models\RequestVendor;
use App\Models\Cart;
use App\Models\OrderDetail;
use App\Models\shop_categories;

class AdminController extends Controller
{

    public function seller_commission(Request $request)
    {



        $data['data'] = Order::with('user', 'order_detail', 'order_detail.product')
            ->where('paid', 1)
            ->orderBy('id', 'DESC')->get();

           

           
        return view('admin.weight.seller_commission', $data);
    }
    public function dashboard()
    {




        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last sunday midnight", $previous_week);
        $end_week = strtotime("next saturday", $start_week);
        $start_week = date("Y-m-d", $start_week);
        $end_week = date("Y-m-d", $end_week);
        $data["yesterday"] = Traffic::whereDate('created_at', '=', Carbon::yesterday()->toDateTimeString())
        
        ->count();

       
        
        $data["week"] = Traffic::whereBetween('created_at', [$start_week, $end_week])->count();
        $data["month"] = Traffic::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->count();
        $all_price = Order::where('paid', 1)->sum('total_price');
        //$data["total_revenue"] = ($all_price * 7.5) / 100;
        $data["total_revenue"] = $all_price;
        //$data["total_orders"] = Order::count("paid",1);
        $data["total_orders1"] =Order::select("orders.*","order_details.*","products.*","product_sizes.*","sizes.*","orders.created_at as orderCreatedDate","orders.id as id")
        ->leftjoin("order_details","order_details.order_id","=","orders.id")
        ->leftjoin("products","products.id","=","order_details.product_id")
        ->leftjoin("product_sizes","product_sizes.id","=","order_details.size_id")
        ->join("sizes","sizes.id","=","product_sizes.size_id")
        ->where('orders.paid',1)
        ->groupBy("orders.id")
        ->get();

        $data["total_orders"]=count($data["total_orders1"]);


        

        



        $data["seller"] = User::where('user_type', 1)->count();

       
        $data["user"] =  User::where(['user_type' => 2])->count();
        $data['unverified_users'] = User::where(['user_type' => 2])->count();

        $data["pending_orders"] = Order::where('paid', 0)->count();
        $data["waiting"] = RequestVendor::where('flags', 2)->count();
        $data['data'] = User::where('user_type', 2)->get();
        $data['cart'] = Cart::all()->count();
        $data['shipped'] = Order::where(["paid" => 1, "status" => "completed"])->count();
        $data['not_shipped'] = Order::where(["paid" => 1, "status" => "processing"])->count();
        $data['categories'] = ShopCategory::where("parent_id", ">", 0)->get();

        $data["menswear"] = ShopCategory::where("parent_id", 1)->get();
        $data["womenswear"] = ShopCategory::where("parent_id", 2)->get();
        $data["children"] = ShopCategory::where("parent_id", 3)->get();


        $cat = Order::where(["orders.paid" => 1])
            ->join("order_details", "order_details.order_id", "=", "orders.id")
            ->join("products", "products.id", "=", "order_details.product_id")
            //->groupBy('orders.id')
            ->sum('order_details.price');
        $data["total_category"] = $cat * 7.5 / 100;
        $data["total_category"] = number_format((float)$data["total_category"], 2, '.', '');
        return view('dashboard', ["data" => $data]);
    }

    public function dashboard_login()
    {
        return view('admin.login.login');
    }
    public function setting()
    {   
        $data['brands'] = Brand::whereRaw("flags & ? = ?", [Brand::FLAG_ACTIVE, Brand::FLAG_ACTIVE])->get()->toArray();

        // //brands
        $brands = Setting::where('key','home_brands')->first();

        if(!empty($brands) && $brands['value'] != 'null') { 
            $brands = $brands->toArray();
            $brands = json_decode($brands['value']);
            $data['brand_selected'] = array_combine(range(1, count($brands)), array_values($brands ));
        }
        

        $shop_cat_man = ShopCategory::whereRaw("flags & ? = ?", [ShopCategory::FLAG_ACTIVE, ShopCategory::FLAG_ACTIVE])->where('shop_cat_slug','man')->first();
        // $product_cat_shop = ShopCategory::all()->toArray();
        $product_cat_shop = ShopCategory::pluck('id')->toArray();
         $product_man = Product::select('products.id', 'products.product_name')->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
         ->where("products.parent_id",0)
         ->where('products.gender', 1)
         ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags',1)
         ->get()->toArray();         
         $data['product_mans'] = $product_man;

         $product_man_new = Product::select('products.id', 'products.product_name')->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
         ->where("products.parent_id",0)
         ->where('products.gender', 1)
         ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags',1)
         ->orderBy('products.id', 'desc')
         ->get()->toArray();
         $data['product_mans_new'] = $product_man_new;

         $product_man_sale = Product::select('products.id', 'products.product_name')->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
         ->where("products.parent_id",0)
         ->where('products.gender', 1)
         ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags',1)
         //->whereNotnull('products.sale_price')
         ->where('products.sale_price', '>', 0)
         ->whereColumn('products.regular_price', ">", 'products.sale_price')
         ->get()->toArray();
         $data['product_mans_sale'] = $product_man_sale;

         $date = \Carbon\Carbon::today()->subDays(30);
         $data['mans_product_last_months'] = Product::select('id', 'product_name')->whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where('created_at','>=',$date)->whereIn('id', $product_cat_shop)->get()->toArray();
         
        //  print_r($data['mans_product_last_months']);
        //  die;



        //mans new
        $man_in_new=array();
        $man_in_new = Setting::where('key','mans_in_new')->first();
        
        if(!empty($man_in_new) && $man_in_new['value'] != 'null'){
            $man_in_new = $man_in_new->toArray();
            $man_in_new = json_decode($man_in_new['value']);
            if(gettype($man_in_new)=="array" && array_values($man_in_new) != []) {
                $data['man_in_new_selected'] = array_combine(range(1, count($man_in_new)), array_values($man_in_new ));
            }    
        }
        // top man's trend product
        $top_mans_trend_product = Setting::where('key','top_mans_trend_product')->first();

        if(!empty($top_mans_trend_product)  && $top_mans_trend_product['value'] != 'null'){
            $top_mans_trend_product = $top_mans_trend_product->toArray();
            $top_mans_trend_product = json_decode($top_mans_trend_product['value']);
            if(gettype($top_mans_trend_product)=="array" && array_values($top_mans_trend_product) != [])
            {
                $data['top_mans_trend_product_selected'] = array_combine(range(1, count($top_mans_trend_product)), array_values($top_mans_trend_product ));
            }   
        }
        // man in sale
        $man_in_sale = Setting::where('key','mans_in_sale')->first();
        if(!empty($man_in_sale) && $man_in_sale['value'] != 'null'){
            $man_in_sale = $man_in_sale->toArray();
            $man_in_sale = json_decode($man_in_sale['value']);
            if(gettype($man_in_sale)=="array" && array_values($man_in_sale) != [])
            {
            $data['man_in_sale_selected'] = array_combine(range(1, count($man_in_sale)), array_values($man_in_sale ));
            }   
        }
        //man in popular
        $man_in_popular = Setting::where('key','mans_in_popular')->first();
        if(!empty($man_in_popular) && $man_in_popular['value'] != 'null'){
            $man_in_popular = $man_in_popular->toArray();
            $man_in_popular = json_decode($man_in_popular['value']);
            if(gettype($man_in_popular)=="array" && array_values($man_in_popular) != [])
            {
                $data['man_in_popular_selected'] = array_combine(range(1, count($man_in_popular)), array_values($man_in_popular ));
            }   
        }

          $shop_cat_woman = ShopCategory::whereRaw("flags & ? = ?", [ShopCategory::FLAG_ACTIVE, ShopCategory::FLAG_ACTIVE])->where('shop_cat_slug','woman')->first();
        //  $product_cat_shop = ProductCatShop::where('parent_cat_id',$shop_cat_woman->id)->pluck('product_id')->toArray();
          /* $product_woman = Product::select('id', 'product_name')->whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
          ->whereIn('id', $product_cat_shop)->where('gender', 2)->get()->toArray();
          $data['woman_products'] = $product_woman;

          $product_woman = Product::select('id', 'product_name')->whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
          ->whereIn('id', $product_cat_shop)->where('gender', 2)->get()->toArray();
          $data['woman_products'] = $product_woman;


          $product_woman = Product::select('id', 'product_name')->whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
          ->whereIn('id', $product_cat_shop)->where('gender', 2)->get()->toArray();
          $data['woman_products'] = $product_woman; */

        $product_woman = Product::select('products.id', 'products.product_name')->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
        ->where("products.parent_id",0)
        ->where('products.gender', 2)
        ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags',1)
        ->get()->toArray();         
        $data['woman_products'] = $product_woman;

         $product_woman_new = Product::select('products.id', 'products.product_name')->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
         ->where("products.parent_id",0)
         ->where('products.gender', 2)
         ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags',1)
         ->orderBy('products.id', 'desc')
         ->get()->toArray();
         $data['woman_products_new'] = $product_woman_new;

         $product_woman_sale = Product::select('products.id', 'products.product_name')->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
         ->where("products.parent_id",0)
         ->where('products.gender', 2)
         //->whereNotnull('products.sale_price')
         ->where('products.sale_price', '>', 0)
         ->whereColumn('products.regular_price', ">", 'products.sale_price')
         ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags',1)
         ->get()->toArray();
         $data['woman_products_sale'] = $product_woman_sale;


        //  $data['woman_product_last_months'] = Product::select('id', 'product_name')->whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where('created_at','>=',$date)->whereIn('id', $product_cat_shop)->get()->toArray();

         //woman top trends product
         $top_womans_trend_product = Setting::where('key','top_womans_trend_product')->first();

      

         if(!empty($top_womans_trend_product)  && $top_womans_trend_product['value'] != 'null'){
             $top_womans_trend_product = $top_womans_trend_product->toArray();
             $top_womans_trend_product = json_decode($top_womans_trend_product['value']);

          
             
            if(gettype($top_womans_trend_product)=="array" && array_values($top_womans_trend_product) != [])
            {
                

             $data['top_womans_trend_product_selected'] = array_combine(range(1, count($top_womans_trend_product)), array_values($top_womans_trend_product ));
            }    
            }

           
         //woman in new
         $woman_in_new = Setting::where('key','woman_in_new')->first();
        
         if(!empty($woman_in_new) && $woman_in_new['value'] != 'null'){
            
            $woman_in_new = $woman_in_new->toArray();
        
            $woman_in_new = json_decode($woman_in_new['value']);
            
            if(gettype($woman_in_new)=="array" && array_values($woman_in_new) != [])
            {
                
                $data['woman_in_new_selected'] = array_combine(range(1, count($woman_in_new)), array_values($woman_in_new ));
            }    
        }
        
        $woman_in_sale = Setting::where('key','woman_in_sale')->first();
        if(!empty($woman_in_sale) && $woman_in_sale['value'] != 'null'){
            $woman_in_sale = $woman_in_sale->toArray();
            $woman_in_sale = json_decode($woman_in_sale['value']);
            if(gettype($woman_in_sale)=="array" && array_values($woman_in_sale) != [])
            {
                $data['woman_in_sale_selected'] = array_combine(range(1, count($woman_in_sale)), array_values($woman_in_sale ));
            }    
        }
        $woman_in_popular = Setting::where('key','woman_in_popular')->first();
        if(!empty($woman_in_popular) && $woman_in_popular['value'] != 'null'){
            $woman_in_popular = $woman_in_popular->toArray();
            $woman_in_popular = json_decode($woman_in_popular['value']);
            if(gettype($woman_in_popular)=="array" && array_values($woman_in_popular) != [])
            {
                $data['woman_in_popular_selected'] = array_combine(range(1, count($woman_in_popular)), array_values($woman_in_popular ));
            }   
        }
        // //children
         $shop_cat_children = ShopCategory::whereRaw("flags & ? = ?", [ShopCategory::FLAG_ACTIVE, ShopCategory::FLAG_ACTIVE])->where('shop_cat_slug','children')->first();
         //$product_cat_shop = ProductCatShop::get()->toArray();
        //  $data['children_products'] = Product::select('id', 'product_name')->whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->get()->toArray();

         $product_children = Product::select('products.id', 'products.product_name')->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
         ->where("products.parent_id",0)
         ->where('products.gender', 3)
         ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags',1)
         ->get()->toArray();         
         $data['children_products'] = $product_children;
 
          $product_children_new = Product::select('products.id', 'products.product_name')->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
          ->where("products.parent_id",0)
          ->where('products.gender', 3)
          ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags',1)
          ->orderBy('products.id', 'desc')
          ->get()->toArray();
          $data['children_products_new'] = $product_children_new;
 
          $product_children_sale = Product::select('products.id', 'products.product_name')->whereRaw("products.flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
          ->where("products.parent_id",0)
          ->where('products.gender', 3)
          //->whereNotnull('products.sale_price')
          ->where('products.sale_price', '>', 0)
          ->whereColumn('products.regular_price', ">", 'products.sale_price')
          ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags',1)
          ->get()->toArray();
          $data['children_products_sale'] = $product_children_sale;


         $data['children_product_last_months'] = Product::select('id', 'product_name')->whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])->where('created_at','>=',$date)->whereIn('id', $product_cat_shop)->get()->toArray();

         //child in new
         $children_in_new = Setting::where('key','children_in_new')->first();
         if(!empty($children_in_new) && $children_in_new['value'] != 'null'){
            $children_in_new = $children_in_new->toArray();
            $children_in_new = json_decode($children_in_new['value']);
            if(gettype($children_in_new)=="array" && array_values($children_in_new) != [])
            {
            $data['children_in_new_selected'] = array_combine(range(1, count($children_in_new)), array_values($children_in_new ));
            }   
        }
        $children_in_sale = Setting::where('key','children_in_sale')->first();
        if(!empty($children_in_sale) && $children_in_sale['value'] != 'null'){
            $children_in_sale = $children_in_sale->toArray();
            $children_in_sale = json_decode($children_in_sale['value']);
            if(gettype($children_in_sale)=="array" && array_values($children_in_sale) != [])
            {
            $data['children_in_sale_selected'] = array_combine(range(1, count($children_in_sale)), array_values($children_in_sale ));
            }   
        }
        $children_in_popular = Setting::where('key','children_in_popular')->first();
        if(!empty($children_in_popular) && $children_in_popular['value'] != 'null'){
            $children_in_popular = $children_in_popular->toArray();
            $children_in_popular = json_decode($children_in_popular['value']);

            if(gettype($children_in_popular)=="array" && array_values($children_in_popular) != [])
            {
                $data['children_in_popular_selected'] = array_combine(range(1, count($children_in_popular)), array_values($children_in_popular ));
            }    
            }
         //children top trends product
          $top_children_trend_product = Setting::where('key','top_children_trend_product')->first();

         if(!empty($top_children_trend_product)  && $top_children_trend_product['value'] != 'null'){
             $top_children_trend_product = $top_children_trend_product->toArray();
             $top_children_trend_product = json_decode($top_children_trend_product['value']);
             $data['top_children_trend_product_selected'] = array_combine(range(1, count($top_children_trend_product)), array_values($top_children_trend_product ));
         }


         // Trend Product
        $getlatestSoldProduct = Order::where('orders.created_at', '>', Carbon::now()->startOfMonth())
        //  $getlatestSoldProduct = Order::where('orders.created_at', '<', \Carbon\Carbon::today()->subDays(30))
            ->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')
            ->groupBy('order_details.product_id')->pluck('order_details.product_id'); 

         $data['top_mans_trend_products'] = Product::select('products.id', 'products.product_name')->whereIn('products.id', $getlatestSoldProduct)
         ->where('products.gender', 1)->where('products.parent_id', 0)->where('products.flags', 1)
         ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags',1)->orderBy('products.id', 'DESC')->get()->toArray();
 
         $data['top_womans_trend_products'] = Product::select('products.id', 'products.product_name')
         ->where('products.gender', 2)->where('products.parent_id', 0)
         ->whereIn('products.id', $getlatestSoldProduct)->where('products.flags', 1)
         ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags',1)->orderBy('products.id', 'DESC')->get()->toArray();

         $data['top_children_trend_products'] = Product::select('products.id', 'products.product_name')
         ->where('products.gender', 3)->where('products.parent_id', 0)
        ->whereIn('products.id', $getlatestSoldProduct)->where('products.flags', 1)
        ->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags',1)->orderBy('products.id', 'DESC')->get()->toArray();

        return view('admin.setting.setting', $data);
    }
    public function home_page_store(Request $request)
    {       
            

        // $check_brand = Setting::where('key', 'home_brands')->first();
        // if (!empty($request->home_brands) && $check_brand) {
        //     $check_brand->value = json_encode($request->home_brands);
        //     $check_brand->save();
        // }
        
        $check_brand = Setting::where('key', 'home_brands')->first();
        if ($check_brand) {
            $check_brand->value = json_encode($request->home_brands);
            $check_brand->save();
        } else {
            $setting = new Setting();
            $setting->key = "home_brands";
            $setting->value = json_encode($request->home_brands);
            $setting->save();
        }

       

        $check_man_in_new =  Setting::where('key', 'mans_in_new')->first();
        if ($check_man_in_new) {
            $check_man_in_new->value = json_encode($request->mans_in_new);
            $check_man_in_new->save();
        } else {
            $setting = new Setting();
            $setting->key = "mans_in_new";
            $setting->value = json_encode($request->mans_in_new);
            $setting->save();
        }

        $check_mans_in_sale = Setting::where('key', 'mans_in_sale')->first();
        if ($check_mans_in_sale) {
            $check_mans_in_sale->value = json_encode($request->mans_in_sale);
            $check_mans_in_sale->save();
        } else {
            $setting = new Setting();
            $setting->key = "mans_in_sale";
            $setting->value = json_encode($request->mans_in_sale);
            $setting->save();
        }

        $check_mans_in_popular = Setting::where('key', 'mans_in_popular')->first();
        if ($check_mans_in_popular) {
            $check_mans_in_popular->value = json_encode($request->mans_in_popular);
            $check_mans_in_popular->save();
        } else {
            $setting = new Setting();
            $setting->key = "mans_in_popular";
            $setting->value = json_encode($request->mans_in_popular);
            $setting->save();
        }


        //woman in new

        $check_woman_in_new = Setting::where('key', 'woman_in_new')->first();
        if ($check_woman_in_new) {
            $check_woman_in_new->value = json_encode($request->woman_in_new);
            $check_woman_in_new->save();
        } else {
            $setting = new Setting();
            $setting->key = "woman_in_new";
            $setting->value = json_encode($request->woman_in_new);
            $setting->save();
        }

        $check_woman_in_sale = Setting::where('key', 'woman_in_sale')->first();
        if ($check_woman_in_sale) {
            $check_woman_in_sale->value = json_encode($request->woman_in_sale);
            $check_woman_in_sale->save();
        } else {
            $setting = new Setting();
            $setting->key = "woman_in_sale";
            $setting->value = json_encode($request->woman_in_sale);
            $setting->save();
        }


        $check_woman_in_popular = Setting::where('key', 'woman_in_popular')->first();
        if ($check_woman_in_popular) {
            $check_woman_in_popular->value = json_encode($request->woman_in_popular);
            $check_woman_in_popular->save();
        } else {
            $setting = new Setting();
            $setting->key = "woman_in_popular";
            $setting->value = json_encode($request->woman_in_popular);
            $setting->save();
        }

        //children in new
        $check_children_in_new = Setting::where('key', 'children_in_new')->first();
        if ($check_children_in_new) {
            $check_children_in_new->value = json_encode($request->children_in_new);
            $check_children_in_new->save();
        } else {
            $setting = new Setting();
            $setting->key = "children_in_new";
            $setting->value = json_encode($request->children_in_new);
            $setting->save();
        }

        $check_children_in_sale = Setting::where('key', 'children_in_sale')->first();
        if ($check_children_in_sale) {
            $check_children_in_sale->value = json_encode($request->children_in_sale);
            $check_children_in_sale->save();
        } else {
            $setting = new Setting();
            $setting->key = "children_in_sale";
            $setting->value = json_encode($request->children_in_sale);
            $setting->save();
        }


        $check_children_in_popular = Setting::where('key', 'children_in_popular')->first();
        if ($check_children_in_popular) {
            $check_children_in_popular->value = json_encode($request->children_in_popular);
            $check_children_in_popular->save();
        } else {
            $setting = new Setting();
            $setting->key = "children_in_popular";
            $setting->value = json_encode($request->children_in_popular);
            $setting->save();
        }

        //top trends

        $check_top_mans_trend_product =  Setting::where('key', 'top_mans_trend_product')->first();
        if ($check_top_mans_trend_product) {
            $check_top_mans_trend_product->value = json_encode($request->top_mans_trend_product);
            $check_top_mans_trend_product->save();
        } else {
            $setting = new Setting();
            $setting->key = "top_mans_trend_product";
            $setting->value = json_encode($request->top_mans_trend_product);
            $setting->save();
        }
        //woman

        
        $check_top_womans_trend_product =  Setting::where('key', 'top_womans_trend_product')->first();
        if ($check_top_womans_trend_product) {
            $check_top_womans_trend_product->value = json_encode($request->top_womans_trend_product);
            $check_top_womans_trend_product->save();
        } else {
            $setting = new Setting();
            $setting->key = "top_womans_trend_product";
            $setting->value = json_encode($request->top_womans_trend_product);
            $setting->save();
        }
        $check_top_children_trend_product =  Setting::where('key', 'top_children_trend_product')->first();
        if ($check_top_children_trend_product) {
            $check_top_children_trend_product->value = json_encode($request->top_children_trend_product);
            $check_top_children_trend_product->save();
        } else {
            $setting = new Setting();
            $setting->key = "top_children_trend_product";
            $setting->value = json_encode($request->top_children_trend_product);
            $setting->save();
        }
        return redirect()->back()->with('message', 'List Updated Successfully');
    }

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            return redirect(route('home'));
        }
        if (Auth::check()) {
            Auth::logout();
            return redirect(route('login.login'));
        }
    }

    public function weight()
    {
        $check_weight = Setting::where('key', 'weight')->first();
        $data['fixed_shipping'] = $data['weights'] = array();
        if ($check_weight) {
            $check_weight = $check_weight->toArray();
            $data['weights'] = json_decode($check_weight['value']);
            //$data['weights'] = array_combine(range(1, count($check_weight)), array_values($check_weight ));
            //$this->test($ );
        }
        $fixed_shipping = Setting::where('key', 'fixed_shipping')->first();

        if (!empty($fixed_shipping)  && $fixed_shipping['value'] != 'null') {
            $fixed_shipping = $fixed_shipping->toArray();
            $data['fixed_shipping'] = json_decode($fixed_shipping['value']);
            //$data['weights'] = array_combine(range(1, count($check_weight)), array_values($check_weight ));
            //$this->test($ );
        }

        $commission = Setting::where('key', 'commission')->first();

        if (!empty($commission)  && $commission['value'] != 'null') {
            $commission = $commission->toArray();
            $data['commission'] = json_decode($commission['value']);
            

        }
        $data["categories"]= shop_categories::where('parent_id', '>', 0)->get();
        return view('admin.weight.home', $data);
    }


    public function test($data)
    {
        echo '<pre>';
        print_r($data);
        die;
    }

    public function weight_process(Request $request)
    {
        $check_weight =  Setting::where('key', 'weight')->first();
        if ($check_weight) {
            $check_weight->value = json_encode(['pound' => $request->pound, 'price' => $request->price]);
            $check_weight->save();
        } else {
            $setting = new Setting();
            $setting->key = "weight";
            $setting->value = json_encode(['pound' => $request->pound, 'price' => $request->price]);
            $setting->save();
        }
        $check_fixed_shipping =  Setting::where('key', 'fixed_shipping')->first();
        if ($check_fixed_shipping) {
            $check_fixed_shipping->value = json_encode($request->fixed_price);
            $check_fixed_shipping->save();
        } else {
            $setting = new Setting();
            $setting->key = "fixed_shipping";
            $setting->value = json_encode($request->fixed_price);
            $setting->save();
        }

        $check_commission =  Setting::where('key', 'commission')->first();
        if ($check_commission) {
            $check_commission->value = json_encode($request->commission);
            $check_commission->save();
        } else {
            $setting = new Setting();
            $setting->key = "commission";
            $setting->value = json_encode($request->commission);
            $setting->save();
        }
        return redirect()->back()->with('message', 'List Updated Successfully');
    }
    public function gender(Request $request)
    {

     

        $order = OrderDetail::select(["order_details.*"])
            ->join("orders","orders.id","=","order_details.order_id")
            ->join("products", "products.id", "=", "order_details.product_id")
            ->join("shop_categories", "shop_categories.id", "=", "products.shop_category_id")
            ->where("shop_categories.parent_id", $_GET["gender"])
            ->where("order_details.price", ">", 0)
           ->get();

        
           echo json_encode($order);
    }
    public function category(Request $request)
    {



        $total_price = 0;
        $rev = Order::select(["order_details.*","shop_categories.shop_cat_name"])
            ->where(["orders.paid" => 1])
            ->join("order_details", "order_details.order_id", "=", "orders.id")
            ->join("products", "products.id", "=", "order_details.product_id")
            ->join("shop_categories", "shop_categories.id", "=", "products.shop_category_id");
       
            if ((int)$_GET["category"] > 0) {
                
                $rev->where("shop_categories.id",(int)$_GET["category"]);

              
            
            }
        


        $revenue = $rev->get();
            
        echo json_encode($revenue);

    }
    public function edit_commission($id)
    {
        $commission= ShopCategory::where("id",$id)->first();
        return view('commission',["commission"=>$commission]);
    }
    public function update_commission(Request $request)
    {
    
        $shop=ShopCategory::find($request->id);
        $shop->shipping=$request->name;
        $shop->save();
        return redirect()->route("setting.weight");
        //return setting.weight;

    }



}
