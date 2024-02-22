<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\CategorySize;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ShopCategory;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\Size;
use App\Models\Setting;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
// use Illuminate\Contracts\Queue\ShouldQueue;
use DB;

// class ImpProducts implements ToModel, WithChunkReading, WithHeadingRow, WithValidation
// class ImpProducts implements ToModel, WithChunkReading, WithHeadingRow, ShouldQueue
class ImpProducts implements ToModel, WithChunkReading, WithHeadingRow
{
    use Importable;

    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        try {            
            $is_deleted = strtolower($row['is_deleted'] ?? '');
            $gender = ['Mens' => 'Menswear', 'Menswear' => 'Menswear', 'Womens' => 'Womenswear', 'Womenswear' => 'Womenswear', 'Children' => 'Children', 'Nightwear' => 'Nightwear'];
            $product = Product::where('sku', $row['skuproduct'])->first() ?: new Product();
            $is_feature_image = true;

            if($row['skuproduct'] == '' || $row['skuproduct'] == Null || $row['product_name'] == '' || $row['product_name'] == Null || $row['selling_price'] == '' || $row['selling_price'] == Null){
                return null;
            }
            //start delete products if flag is delete
            if ($is_deleted === 'deleted' || $is_deleted === 'delete') {
                if ($id = $product->id ?? '') {

                    //remove files
                    @unlink(storage_path("app/public/product/" . $id . '/' . $product->feature_image));

                    //remove relations and product
                    ProductSize::where('product_id', $id)->delete();
                    ProductColor::where('product_id', $id)->delete();
                    ProductImage::where('product_id', $id)->delete();
                    Product::where('parent_id', $id)->delete();
                    Product::where('id', $id)->delete();
                }

                return null;
            }
            //end delete products if flag is delete

            $brand_id = Brand::where('brand_name', trim($row['brand']))->first()->id ?? 0;
            $gender_id = ShopCategory::where("parent_id", 0)->where('shop_cat_name', $gender[$row['gender']] ?? '')->first()->id ?? 0;
            $shop_category_id = ShopCategory::where("parent_id", $gender_id)->where('shop_cat_name', trim($row['category']))->first()->id ?? 0;
            $categorysize = CategorySize::where('category_id', $shop_category_id)->with('size')->get()->pluck('size.id', 'size.size')->toArray();
           ////// $size_and_qty = $this->addSizeQty($row, $categorysize, $shop_category_id);           
            //if brand category and gender not found product will not be created
            if($brand_id == 0 || $shop_category_id == 0 || $gender_id == 0){
                return null;
            }
            // add new code
            $size_and_qty = $this->addSizeQty($row, $categorysize, $shop_category_id,$brand_id,$gender_id);

            $product->product_name = $row['product_name'];
            $product->product_description = preg_replace('/_x([0-9a-fA-F]{4})_/', '<br/>', $row['product_description']);;
          //  $product->regular_price = $row['price'];
           // $product->sale_price = $row['salesprice'];
            $product->regular_price = $row['selling_price'];
            $product->sale_price = ($row['sale_price'] > 0)?$row['sale_price']:0;
            $product->unit_price = ($row['unit_price'] > 0)?$row['unit_price']:0;
            $product->brand_id = $brand_id;
            $product->gender = $gender_id;
            $product->shop_category_id = $shop_category_id;
            $product->addFlag(Product::FLAG_ACTIVE);

            if ($product->save()) {
                // add new product for home page show
                    if($row['new_in'] == 'Y'){
                        $checkProdut_in_sale_or_not = Product::select('products.*')->where('products.id',$product->id)->where('products.sale_price', '>', 0)->whereColumn('products.regular_price', ">", 'products.sale_price')->first();
                        if($gender_id == 1){
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

                        }elseif($gender_id == 2){
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
                        }elseif($gender_id == 3){
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
                    }
                    // add new product for home page show


                $product->sku = $row['skuproduct'];
                $product->save();

                if (count($size_and_qty) > 0) {

                    //delete old size and qty
                    //ProductSize::where('product_id', $product->id)->delete();
                    DB::table('product_sizes')->where('product_id', $product->id)->delete();

                    foreach ($size_and_qty as $name => $size_qty) {
                        if($size_qty['size_id'] != null){
                            $product_size = new ProductSize();
                            $product_size->size_id = $size_qty['size_id'];
                            $product_size->quantity = $size_qty['quantity'];
                            $product_size->product_id = $product->id;
                            $product_size->addFlag(ProductSize::FLAG_ACTIVE);
                            $product_size->save();
                        }
                    }
                }

                if (empty($product->feature_image)) {
                    if (!file_exists(storage_path("app/public/product/" . $product->id))) {
                        mkdir(storage_path("app/public/product/" . $product->id), 0777, true);
                    }
                    // $images_url = preg_split('/\r\n|\r|\n/', $row['images']);
                     $images_url_get = preg_replace('/\s+/', '', $row['images']);
                     $images_url = explode(',', $images_url_get);
                    foreach ($images_url as $image_url) {
                        if (!empty($image_url)) {
                            if ($is_feature_image) {
                                $product->feature_image = $this->addFile($image_url, storage_path("app/public/product/" . $product->id));
                                $product->save();
                                $is_feature_image = false;
                            } else {
                                $product_image = new ProductImage();
                                $product_image->image = $this->addFile($image_url, storage_path("app/public/product/" . $product->id));
                                $product_image->product_id = $product->id;
                                $product_image->addFlag(ProductColor::FLAG_ACTIVE);
                                $product_image->save();
                            }
                        }
                    }
                }
                if (!$is_feature_image) {
                    $product->save();
                }
            }else {
                //dd($product->errors()->toArray());
            }

            return $product;

        } catch (\Exception $ex) {

            //dd($ex->getMessage());
        }
    }

    // public function rules(): array
    // {
    //     return [
    //         '*.skuproduct' => 'required',
    //         '*.product_name' => 'required',
    //          '*.selling_price' => 'required',
    //     ];
    // }

    private function addFile($url, $dest): string
    {
        if ($url) {
            $feature_image = file_get_contents($url);
            $extension = pathinfo($url, PATHINFO_EXTENSION);
            $extension = str_replace(strstr($extension, "?"), '', $extension);
            $name = rand(9999, 99999) . '.' . $extension;
            file_put_contents($dest . '/' . $name, $feature_image);
            return $name;
        }
        return '';
    }
    public function chunkSize(): int
    {
        return 500;
    }

    // public function addSizeQty($row, $categorysize, $shop_category_id): array
    public function addSizeQty($row, $categorysize, $shop_category_id,$brand_id,$gender_id): array
    {
        //make qty by size and by product
        $size_and_qty = [];
        //add a new size
        for ($i = 1; $i <= 19; $i++) {
            if (!empty($row["size_$i"]) && !(isset($categorysize[$row["size_$i"]]))) {

                //create a new size which is not in DB
                //////$size = Size::where('size', $row["size_$i"])->first() ?: new Size();
                $size = Size::where('size',$row["size_$i"])->where('brand_id',$brand_id)->where('shop_category_id',$shop_category_id)->where('gender',$gender_id)->first() ?: new Size();
                $size->size_id = $size->size = $row["size_$i"];
                $size->flags = Size::FLAG_ACTIVE;
                $size->brand_id = $brand_id;
                $size->shop_category_id = $shop_category_id;
                $size->gender = $gender_id;
                if ($size->save()) {
                    $category_size = CategorySize::where('category_id', $shop_category_id)->where('size_id', $size->id)->first() ?: new CategorySize();
                    $category_size->category_id = $shop_category_id;
                    $category_size->size_id = $size->id;
                    $category_size->flags = ShopCategory::FLAG_ACTIVE;
                    $category_size->save();
                }
            }
        }
        ////// $categorysize = CategorySize::where('category_id', $shop_category_id)->with('size')->get()->pluck('size.id', 'size.size')->toArray();
        ////// foreach ($categorysize as $name => $size_id) {
        //////     for ($i = 1; $i <= 19; $i++) {
        //////         //if size defined in the sheet add qty 100 else 0
        //////         if (trim($name) == trim($row["size_$i"])) {
        //////             $size_and_qty[$name] = ['size_id' => $size_id, 'quantity' => 100];
        //////             break;
        //////         } else {
        //////             $size_and_qty[$name] = ['size_id' => $size_id, 'quantity' => 0];
        //////         }
        //////     }
        ////// }
        $categorysize = Size::where('brand_id',$brand_id)->where('shop_category_id',$shop_category_id)->where('gender',$gender_id)->get()->pluck('size','id')->toArray();
        // foreach ($categorysize as $name => $size_id) {
        foreach ($categorysize as $size_id => $name) {
                 for ($i = 1; $i <= 19; $i++) {
                     //if size defined in the sheet add qty 100 else 0
                     if (trim($name) == trim($row["size_$i"])) {
                         //$size_and_qty[$name] = ['size_id' => $size_id, 'quantity' => 100];
                         $size_quantity = 0;
                         if($row["quantity_$i"] != ''){
                            $size_quantity = $row["quantity_$i"];
                         }
                         $size_and_qty[$name] = ['size_id' => $size_id, 'quantity' =>  $size_quantity];
                         break;
                     } else {
                       //////  $size_and_qty[$name] = ['size_id' => $size_id, 'quantity' => 0];
                     }
                 }
             }
          
        return $size_and_qty;
    }
}
