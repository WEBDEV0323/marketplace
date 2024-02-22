<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\ShopCategory;
use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Setting;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\User;
use App\Models\ProductCatShop;
use App\Models\OrderDetail;
use App\Models\CategorySize;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;
use DB;
use Intervention\Image\Facades\Image as Image;
use Session;
use Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class   ProductController extends Controller
{
  //all products which display in admin panel
  public function index()
  {
    $data['products'] = Product::orderBy('id', 'DESC')->where('parent_id', 0)->get()->toArray();
    return view('admin.product.productHome', $data);
  }

  //add products form
  public function addProduct()
  {
    $brand_id = $_GET['brand_id'];
    $category_id = $_GET['category_id'];
    $gender = $_GET['gender'];

    $data["brand_id"] = $brand_id;
    $data["category_id"] = $category_id;
    $data["gender"] = $gender;
    $data["list_gender"] = ShopCategory::where("parent_id", 0)->get();

    //$data['brands'] = Brand::where('id', $brand_id)->get()->sortBy('brand_name')->toArray();
    $data['brands'] = Brand::orderBy("brand_name", "ASC")->get()->toArray();
  //  $data['categories'] = ShopCategory::where('id', $category_id)->get();
    
  $data['categories1'] = ShopCategory::where("parent_id", $data["category_id"])
        ->orderBy("shop_cat_name", "asc")
        ->get();
    
  // $data['categories1'] = ShopCategory::orderBy("shop_cat_name", "asc")->get(); 
    
    
    
    
    
    $gen = ShopCategory::where('shop_cat_name', $gender)->first();
    $data['sizes'] = Size::where('brand_id', $brand_id)->where('shop_category_id', '=', $category_id)->where('gender', '=', $gen->id)->get();
    //$data['sizes'] = Size::get();
    $data['colors'] = Color::get();

    return view('admin.product.addProduct', $data);
  }

  //product edit form
  public function productById(Request $request, $id)
  {
    $data['product'] = Product::where('id', $id)->with('shop_category', 'multi_images', 'prod_size.size', 'shop_category.cat_parent', 'brand', 'prod_color.color')->first()->toArray();

    $data["re"] = $request->all();
    $data['id'] = $id;

    $data['brands'] = Brand::orderBy("brand_name", "ASC")->get()->toArray();

    $data['sizes'] = Size::get();

    $data["gender"] = 0;
    $data["list_gender"] = ShopCategory::where("parent_id", 0)->get();

    if (isset($data['product']["shop_category_id"])  &&   (int)$data['product']["shop_category_id"] > 0) {
      $data['categories1'] = ShopCategory::where("id", $data['product']["shop_category_id"])->first();
      $data['categories'] = ShopCategory::where("parent_id", $data['categories1']->parent_id)
        ->orderBy("shop_cat_name", "asc")
        ->get();
      $data["gender"] = $data['categories1']->parent_id;
    } else {
      $data['categories'] = ShopCategory::orderBy("shop_cat_name", "asc")->get();
    }

    $data['colors'] = Color::get();
    $data['categorysize'] =  Size::where('brand_id', $data['product']['brand_id'])->where('shop_category_id', '=', $data['product']['shop_category_id'])->where('gender', '=', $data['product']['gender'])->get();
   // dd($data['categorysize']);
    // $data['categorysize'] =  CategorySize::where('category_id',$data['product']['shop_category_id'])->with('size')->get();
    
    return view('admin.product.editProductEdit', $data);
  }
  
  
  
  //product edit process
  public function product_edit(Request $request)
  { 
    // dd($request->all());
    if ($request->regular_price >= $request->sale_price) {
      $product = Product::where('id', $request->id)->first();
      $product->brand_id = $request->input('brand', $product->brand_id);
      $product->product_name = $request->input('product_name', $product->product_name);


      $product->pid = $request->input('pid', $product->pid);
      $product->unit_price = $request->input('unit_price', $product->unit_price);
      $product->product_name = $request->input('product_name', $product->product_name);

      $product->product_description = $request->input('description', $product->product_description);
      $product->shop_category_id = $request->input('shop_category', $product->shop_category);

      if ($request->input('sale_price', $product->sale_price)) {
        $discount = (($request->regular_price - $request->sale_price) * 100) / $request->regular_price;
        $product->discount =  $discount;
        $product->sale_price = $request->sale_price;
      } else {
        $product->sale_price = $request->sale_price;
      }
      $product->regular_price = $request->input('regular_price', $product->regular_price);
      $product->weight = $request->input('weight', $product->weight);
      if (\File::exists($request->feature_image)) {
        $file_name = ProductaddFile($request->feature_image, storage_path("app/public/product/" . $product->id));

        if ($file_name) {
          @unlink(storage_path("app/public/product/" . $product->id . '/' . $product->feature_image));
          $product->feature_image = $file_name;
        }
      }
      $product->removeFlag(Product::FLAG_ACTIVE);

      if ($request->status == 1) {
        $product->addFlag(Product::FLAG_ACTIVE);
      }
      if ($product->save()) {
        


        $checkProdut_in_sale_or_not = Product::select('products.*')->where('products.id',$request->id)->where('products.sale_price', '>', 0)->whereColumn('products.regular_price', ">", 'products.sale_price')->first();
        if($checkProdut_in_sale_or_not){
            if($checkProdut_in_sale_or_not->gender == 1){
                $check_mans_in_sale =  Setting::where('key', 'mans_in_sale')->first();
                if ($check_mans_in_sale) {  
                  if($check_mans_in_sale->value =='' || $check_mans_in_sale->value == "null"){
                    $check_mans_in_sale->value = json_encode(array((string)$request->id));
                    $check_mans_in_sale->save();
                  }else{
                    $mans_in_sale_decode = json_decode($check_mans_in_sale->value, true);
                    array_push($mans_in_sale_decode,(string)$request->id);
                    $check_mans_in_sale->value = json_encode($mans_in_sale_decode);
                    $check_mans_in_sale->save();
                  }     
                } else {
                    $setting = new Setting();
                    $setting->key = "mans_in_sale";
                    $setting->value = json_encode(array((string)$request->id));
                    $setting->save();
                }
            }
            if($checkProdut_in_sale_or_not->gender == 2){
              $check_womans_in_sale =  Setting::where('key', 'woman_in_sale')->first();
              if ($check_womans_in_sale) {  
                if($check_womans_in_sale->value =='' || $check_womans_in_sale->value == "null"){
                  $check_womans_in_sale->value = json_encode(array((string)$request->id));
                  $check_womans_in_sale->save();
                }else{
                  $womans_in_sale_decode = json_decode($check_womans_in_sale->value, true);
                  array_push($womans_in_sale_decode,(string)$request->id);
                  $check_womans_in_sale->value = json_encode($womans_in_sale_decode);
                  $check_womans_in_sale->save();
                }     
              } else {
                  $setting = new Setting();
                  $setting->key = "woman_in_sale";
                  $setting->value = json_encode(array((string)$request->id));
                  $setting->save();
              }
            }
            if($checkProdut_in_sale_or_not->gender == 3){
                $check_children_in_sale =  Setting::where('key', 'children_in_sale')->first();
                if ($check_children_in_sale) {  
                  if($check_children_in_sale->value =='' || $check_children_in_sale->value == "null"){
                    $check_children_in_sale->value = json_encode(array((string)$request->id));
                    $check_children_in_sale->save();
                  }else{
                    $childeren_in_sale_decode = json_decode($check_children_in_sale->value, true);
                    array_push($childeren_in_sale_decode,(string)$request->id);
                    $check_children_in_sale->value = json_encode($childeren_in_sale_decode);
                    $check_children_in_sale->save();
                  }     
                } else {
                    $setting = new Setting();
                    $setting->key = "children_in_sale";
                    $setting->value = json_encode(array((string)$request->id));
                    $setting->save();
                }
            } 
        }
       
        // if(is_null($product->sale_price) || $product->regular_price == $product->sale_price){
        //   $gender = $request->categories;
        //   if($gender == 1){
        //     $saleKey = 'mans_in_sale';
        //   } else if($gender == 2){
        //     $saleKey = 'woman_in_sale';
        //   } else if($gender == 3){
        //     $saleKey = 'children_in_sale';
        //   }
        //   $checkSaleKey =  Setting::where('key', $saleKey)->first();          
        //   if ($checkSaleKey) {  
        //     if($checkSaleKey->value !='' || $checkSaleKey->value != "null"){
        //       $value = json_decode($checkSaleKey->value, true);              
        //       if (($key = array_search($product->id, $value)) !== false) {
        //           unset($value[$key]);
        //       }
        //       $checkSaleKey->value = json_encode($value);
        //       $checkSaleKey->save();
        //     }
        //   }
        // }

        if (is_array($request->size_id)) {
          foreach ($request->size_id as $sizes) {
            $product_size = ProductSize::where('product_id', $request->id)->delete();
          }
          foreach ($request->size_id as $sizes) {

            $product_size = new ProductSize();
            $product_size->size_id = $sizes;
            $quantity = 0;

            if ($request->category_size_quantity[$sizes]) {
              $quantity = $request->category_size_quantity[$sizes];
            }

            $product_size->quantity = $quantity;
            $product_size->product_id = $product->id;
            $product_size->addFlag(ProductSize::FLAG_ACTIVE);
            $save =  $product_size->save();
          }
        }else{
          ProductSize::where('product_id', $request->id)->delete();
        }


        return redirect()->back()->with(["message" => "Product Update Successfully"]);
      }
    } else {

      return redirect(route("product-home"))->with(["error" => "Sales Price Always Greater Than Regular Price"]);
    }
  }
  //admin stock update form
  public function stockUpdate($id)
  {
    $data['id'] = $id;
    return view('admin.product.update-stock', $data);
  }
  //vendor stock update form
  public function vendor_stock($id)
  {
    $data['id'] = $id;
    $data['sizes'] = Size::get();
    return view('admin.product.update-stock-vendor', $data);
  }
  //stock update process
  public function stockUpdateProcess(Request $request)
  {
    $product = Product::where('id', $request->id)->first();



    if ($request->stock > 0) {
      $quantity = $product->quantity + $request->stock;

      $affected = DB::table('products')
        ->where('id', $request->id)
        ->update(['quantity' => $quantity]);

      if ($affected) {
        return redirect(route('product-home'))->with(['message' => 'stock increases successful']);
      } else {
        return redirect(route("product-home"))->with(["error" => "Somthing Wrong"]);
      }
    }
  }
  // vendor stock update
  public function vendor_stock_update_process(Request $request)
  {
    $product = Product::where('id', $request->id)->first();
    $vendor_id = Auth::guard('vendor')->user()->id;
    $vendor_product = new VendorProduct();
    $vendor_product->vendor_id = $vendor_id;
    $vendor_product->product_id = $product->id;
    $vendor_product->old_quantity = $product->quantity;
    $vendor_product->quantity = $request->stock;
    $vendor_product->price = $request->price;
    $vendor_product->size = json_encode($request->size);
    if ($vendor_product->save()) {
      return \Redirect::back()->with(["message" => " Your Stock Has Been Added Successfully"]);
    }
  }


  public function vendors_product()
  {

    $data['data'] = Product::where('parent_id', '!=', 0)->with('user', 'product_parent', 'prod_size.size')->get();
    return view('admin.vendor.vendors-product', $data);
  }

  public function vendor_product_detail($id)
  {


    $data['id'] = $id;
    $data['data'] = ProductSize::select("product_sizes.*")
      ->where("product_sizes.id", $id)
      ->first();

    $data["product"] = product::where("id", $data['data']->product_id)->first();

    $data["parent"] = product::where("id", $data["product"]->parent_id)->first();
    return view('admin.vendor.permission-product', $data);
  }

  public function purchased(Request $request)
  {



    $product = Product::where('id', $request->vendor_product_id)->first();

    $product->flags = $request->val;
    $product->save();






    // if($product->active == 0){
    //     $product->addFlag(Product::FLAG_ACTIVE);

    //     $product->save(); 
    //   echo json_encode(['message' => 'Product Has Been Added']);
    // }else{
    //   echo json_encode(['Error' => 'Something Error, Kindly Try Again']);
    // }


  }



  public function test($data)
  {
    echo '<pre>';
    print_r($data);
    die;
  }

  //shop_categories return to html with ajax
  public function shopCategoryValue(Request $request)
  {



    if ($request->flags == 1) {
      $data['data'] =  ShopCategory::whereRaw("flags & ? = ?", [ShopCategory::FLAG_ACTIVE, ShopCategory::FLAG_ACTIVE])->where('parent_id', $request->id)->orderBy('shop_cat_name', 'asc')->get();
    }
    if ($request->flags == 2) {
      $data['data'] =  CategorySize::where('category_id', $request->id)->with('size')->get();
    }

    // for admin size get 
    $admin_size_get = "No";
    if ($request->has('admin_size_get')) {
      $admin_size_get = "Yes";
    }
    // for admin size get 

    $category = ShopCategory::where("id", $request->id)->first();
    $data["ct"] = $category;
    $data['flags'] = $request->flags;
    $data['admin_size_get'] = $admin_size_get;
    return view('admin.product.shop-categories', $data);
    //return response()->json($data);
  }
  //product add process
  public function productProcess(Request $request)
  {
    $request->validate([
      'sku'  => 'required|string|unique:products',
    ]);


    if (empty($request->size_id)) {
      return \Redirect::back()->with(["error" => "You Have To Select Size and Quantity of Product"]);
    }
    // new gender adde
      $getGenderId = ShopCategory::where("parent_id", 0)->where('shop_cat_name',$request->gender)->first();    
      if(!$getGenderId){
        return \Redirect::back()->with(["error" => "Gender Field is required"]);
      }
    // gender added



    $product = new Product();
    if ($request->regular_price < $request->sale_price) {
      return \Redirect::back()->with(["error" => "  Unit Price Always Greater Than Sales Price"]);
    } else {
      $product->gender = $getGenderId->id;
      $product->brand_id = $request->brand;
      $product->product_name = $request->product_name;
      $product->product_description = $request->description;
      $product->unit_price = $request->unit_price;
      $product->pid = $request->pid;
      if (Auth::guard('admin')->check()) {
        $product->added_by = Auth::guard('admin')->user()->id;
      }
      if ($request->sale_price) {
        $discount = (($request->regular_price - $request->sale_price) * 100) / $request->regular_price;
        $product->discount =  $discount;
        $product->sale_price = $request->sale_price;
      } else {
        // $product->sale_price = $request->regular_price;  
        $product->sale_price = $request->sale_price;
      }

      $product->regular_price = $request->regular_price;
      $product->shop_category_id = $request->shop_category;

      $product->addFlag(Product::FLAG_ACTIVE);
      if (!is_dir(storage_path("app/public/product/"))) {
        mkdir(storage_path("app/public/product/"), 0777, true);
      }
      $product->save();
      $product->sku = $request->sku;

      if (!file_exists(storage_path("app/public/product/" . $product->id))) {


        mkdir(storage_path("app/public/product/" . $product->id), 0777, true);
      }
      $file_name = ProductaddFile($request->feature_image, storage_path("app/public/product/" . $product->id));
      $product->feature_image = $file_name;
      $artisan_call_to_make_files_public = Artisan::call("storage:link", []);
      if ($artisan_call_to_make_files_public) {
        DB::rollBack();
      }
      if ($product->save()) {
        //end of product table

        //shop_categories start 
        if (is_array($request->size_id)) {
          $save = false;

          foreach ($request->size_id as $size) {
            $product_size = new ProductSize();
            $product_size->size_id = $size;
            $quanitity = 0;
            if ($request->category_size_quantity[$size]) {
              $quanitity = $request->category_size_quantity[$size];
            }
            $product_size->quantity = $quanitity;
            $product_size->product_id = $product->id;
            $product_size->addFlag(ProductSize::FLAG_ACTIVE);
            $save =  $product_size->save();
          }
        }
        if (is_array($request->colors)) {
          $save = false;
          foreach ($request->colors as $color) {
            $product_color = new ProductColor();
            $product_color->color_id = $color;
            $product_color->product_id = $product->id;
            $product_color->addFlag(ProductColor::FLAG_ACTIVE);
            $save = $product_color->save();
          }
        }
        if (is_array($request->multi_images)) {
          $save = false;
          foreach ($request->multi_images as $image) {
            $product_image = new ProductImage();
            $product_image->image = ProductaddFile($image, storage_path("app/public/product/" . $product->id));;
            $product_image->product_id = $product->id;
            $product_image->addFlag(ProductColor::FLAG_ACTIVE);
            $save =  $product_image->save();
          }
        }

        // add new product for home page show
       $checkProdut_in_sale_or_not = Product::select('products.*')->where('products.id',$product->id)->where('products.sale_price', '>', 0)->whereColumn('products.regular_price', ">", 'products.sale_price')->first();
        if($getGenderId->id == 1){
            $check_man_in_new =  Setting::where('key', 'mans_in_new')->first();
            if ($check_man_in_new) {  
              if($check_man_in_new->value =='' || $check_man_in_new->value == "null"){
                $check_man_in_new->value = json_encode(array((string)$product->id));
                $check_man_in_new->save();
              }else{
                $mains_new_decode = json_decode($check_man_in_new->value, true);
                array_push($mains_new_decode,(string)$product->id);
                $check_man_in_new->value = json_encode($mains_new_decode);
                $check_man_in_new->save();
              }     
            } else {
                $setting = new Setting();
                $setting->key = "mans_in_new";
                $setting->value = json_encode(array((string)$product->id));
                $setting->save();
            }

            // if(!is_null($product->sale_price) && !empty($product->sale_price)){
            if($checkProdut_in_sale_or_not){
              $check_mans_in_sale =  Setting::where('key', 'mans_in_sale')->first();
              if ($check_mans_in_sale) {  
                if($check_mans_in_sale->value =='' || $check_mans_in_sale->value == "null"){
                  $check_mans_in_sale->value = json_encode(array((string)$product->id));
                  $check_mans_in_sale->save();
                }else{
                  $mans_in_sale_decode = json_decode($check_mans_in_sale->value, true);
                  array_push($mans_in_sale_decode,(string)$product->id);
                  $check_mans_in_sale->value = json_encode($mans_in_sale_decode);
                  $check_mans_in_sale->save();
                }     
              } else {
                  $setting = new Setting();
                  $setting->key = "mans_in_sale";
                  $setting->value = json_encode(array((string)$product->id));
                  $setting->save();
              }
            }
        }elseif($getGenderId->id == 2){
            $check_woman_in_new = Setting::where('key', 'woman_in_new')->first();
            if ($check_woman_in_new) {
              if($check_woman_in_new->value =='' || $check_woman_in_new->value == "null"){
                $check_woman_in_new->value = json_encode(array((string)$product->id));
                $check_woman_in_new->save();
              }else{
                $woman_new_decode = json_decode($check_woman_in_new->value, true);
                array_push($woman_new_decode,(string)$product->id);
                $check_woman_in_new->value = json_encode($woman_new_decode);
                $check_woman_in_new->save();
              }  
            } else {
                $setting = new Setting();
                $setting->key = "woman_in_new";
                $setting->value = json_encode(array((string)$product->id));
                $setting->save();
            }
            //if(!is_null($product->sale_price) && !empty($product->sale_price)){
              if($checkProdut_in_sale_or_not){
              $check_womans_in_sale =  Setting::where('key', 'woman_in_sale')->first();
              if ($check_womans_in_sale) {  
                if($check_womans_in_sale->value =='' || $check_womans_in_sale->value == "null"){
                  $check_womans_in_sale->value = json_encode(array((string)$product->id));
                  $check_womans_in_sale->save();
                }else{
                  $womans_in_sale_decode = json_decode($check_womans_in_sale->value, true);
                  array_push($womans_in_sale_decode,(string)$product->id);
                  $check_womans_in_sale->value = json_encode($womans_in_sale_decode);
                  $check_womans_in_sale->save();
                }     
              } else {
                  $setting = new Setting();
                  $setting->key = "woman_in_sale";
                  $setting->value = json_encode(array((string)$product->id));
                  $setting->save();
              }
            }
        }elseif($getGenderId->id == 3){
            $check_children_in_new = Setting::where('key', 'children_in_new')->first();
            if ($check_children_in_new) {
              if($check_children_in_new->value =='' || $check_children_in_new->value == "null"){
                $check_children_in_new->value = json_encode(array((string)$product->id));
                $check_children_in_new->save();
              }else{
                $child_new_decode = json_decode($check_children_in_new->value, true);
                array_push($child_new_decode,(string)$product->id);
                $check_children_in_new->value = json_encode($child_new_decode);
                $check_children_in_new->save();
              }  
            } else {
                $setting = new Setting();
                $setting->key = "children_in_new";
                $setting->value = json_encode(array((string)$product->id));
                $setting->save();
            }
            // if(!is_null($product->sale_price) && !empty($product->sale_price)){
            if($checkProdut_in_sale_or_not){
              $check_children_in_sale =  Setting::where('key', 'children_in_sale')->first();
              if ($check_children_in_sale) {  
                if($check_children_in_sale->value =='' || $check_children_in_sale->value == "null"){
                  $check_children_in_sale->value = json_encode(array((string)$product->id));
                  $check_children_in_sale->save();
                }else{
                  $childeren_in_sale_decode = json_decode($check_children_in_sale->value, true);
                  array_push($childeren_in_sale_decode,(string)$product->id);
                  $check_children_in_sale->value = json_encode($childeren_in_sale_decode);
                  $check_children_in_sale->save();
                }     
              } else {
                  $setting = new Setting();
                  $setting->key = "children_in_sale";
                  $setting->value = json_encode(array((string)$product->id));
                  $setting->save();
              }
            }
        }
        // add new product for home page show

        $url = route('product-catgory', [$request->shop_category]) . "?brand_slug=" . $request->brand . "&gender=" . $request->gender;
        return redirect($url);

        //add.product


        //return \Redirect::back()->with(['message'=>'Product Added Successfully']);     
      }
    }
  }
  //product soft delete    
  public function product_delete($id)
  {
    //ProductCatShop::where('product_id',$id)->delete();
    ProductSize::where('product_id', $id)->delete();
    ProductColor::where('product_id', $id)->delete();
    ProductImage::where('product_id', $id)->delete();
    $product = Product::where('parent_id', $id)->delete();
    $product = Product::where('id', $id)->delete();
    return redirect()->back()->with(["message" => "Product Delete Successfully"]);
  }


  public function product_catgory($slug)
  {
    $data["products"] = Product::select(['products.*', 'product_sizes.regular_price as rp', 'product_sizes.sale_price as sp', DB::raw('SUM(product_sizes.quantity) as quantity')])
      ->leftjoin('product_sizes', 'product_sizes.product_id', '=', 'products.id')
      ->groupBy("products.id")
      ->where('products.parent_id',0)
      ->where("brand_id", $_GET["brand_slug"])
      ->with('prod_size.size')
      ->where("shop_category_id",  $slug)->get()->toArray();


    foreach ($data["products"] as $i => $dp) {

      $quantity = 0;

      foreach ($dp["prod_size"] as $p) {
        $quantity = $quantity + $p["quantity"];
      }

      $data["products"][$i]["quantity"] = $quantity;
    }


    $data['brand_id'] = $_GET["brand_slug"];
    $data['gender'] = $_GET["gender"];
    $data['category_id'] = $slug;


    // $category_i = ShopCategory::whereIn("id", $product)->get()->toArray();
    // $data['shop_categories'] = ShopCategory::whereIn("id", $product)->get()->toArray();

    return view('admin.product.product-with-categories', $data);
  }

  public function change(Request $request)
  {
    $status = "";
    if ($request->status == "Active") {
      $status = 1;
    } else {

      $status = 0;
    }

    $product = Product::find((int)$request->id);
    $product->flags = (int)$status;
    $product->save();
  }
  public function vendor_product_delete(Request $request)
  {

    $id = $request->id;
    $product = Product::where('id', $id)->delete();
    return redirect()->back();
  }

  /**
   * vendor_product_extend_expiry_date
   */
  public function vendor_product_extend_expiry_date(Request $request)
  {
    $product = Product::where('id', $request->product_id)->where('vendor_id', auth()->user()->id)->first();
    if($product->expiry_date == null){
      $expiryDate = Carbon::now();
    }else{
      $expiryDate =  Carbon::parse($product->expiry_date);
    }
   // $currentDate = Carbon::now();
    // if ($product && $expiryDate->diffInDays($currentDate) <= 14 && !$product->expiry_extended) {
      // $product->expiry_date = $product->created_at->addDays(config('constants.seller.maximum_product_listing_days'));
     if($product && ($request->extend_day == 14 || $request->extend_day == 30)){
        $floagstatus = 1;
      if($product->product_type == 2){
        $floagstatus = 5;
      }
      // $newDateTime = Carbon::now()->addDays($request->extend_day);
      $newDateTime = $expiryDate->addDays($request->extend_day);
      $product->expiry_date = $newDateTime;
      $product->flags = $floagstatus;
      $product->expiry_extended = 1;
      $product->save();
      return redirect()->back()->with(["message" => "Product's expiry date is extended successfully"]);
    } else {
      return redirect()->back()->with(["message" => "Something went wrong with your product"]);
    }
  }


  public function ord(Request $request)
  {

    $cat = ShopCategory::where("parent_id", $request->id)
      ->orderBy("shop_cat_name", "asc")
      ->get();

    echo json_encode($cat);
  }
  public function my_list()
  { 
    $getorder_product = OrderDetail::where('product_owner_id', auth()->user()->id)->pluck('product_id')->toArray(); 
    if(count($getorder_product) == 0){
      $getorder_product = array(0);
    }
    $data['vendor_products'] = Product::select(["products.*", "shop_categories.shop_cat_name", "shop_categories.shipping", "shop_categories.parent_id as pid"])
      ->join("shop_categories", "shop_categories.id", "=", "products.shop_category_id")
      ->where('vendor_id', auth()->user()->id)->whereNotIn('products.id',$getorder_product)->with('brand', 'shop_category', 'user', 'product_parent', 'prod_size')->get();
    return view('frontend.user.my-list', $data);
  }
}
