<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\ShopCategory;
use App\Models\Size;
use App\Models\Brand;
use App\Models\CategorySize;
use App\Models\Product;
use Illuminate\Support\Str;

class ShopCategoryController extends Controller
{
    //

    public function index()
    {
        //
        $data['shop_categories'] = ShopCategory::with("cat_parent")->get()->toArray();
        $data['all']="0";
        return view('admin.category.shopCategory',$data);
    }
    public function filter_category($id)
    {
        if($id==1)
        {
            $title="Menswear";

        }
        if($id==2)
        {
            $title="Womenswear";

        }
        if($id==3)
        {
            $title="Children";

        }
       
       
        $data['shop_categories'] = ShopCategory::where('parent_id', '!=', 0)->where("parent_id",$id)->with("cat_parent")->orderBy('shop_cat_name','ASC')->get()->toArray();
       
        $data['all']=$id;
        $data["title"]=$title;
        return view('admin.category.shopCategory',$data);

    }
    public function category_brand($slug)
    {
       
        $brand = Brand::where("brand_slug", $slug)->pluck("id");
        $data['shop_categories'] = ShopCategory::select(["shop_categories.*","sc.shop_cat_name as gender"])
        ->join("shop_categories as sc","shop_categories.parent_id","=","sc.id")
        ->get()
        ->toArray();
        $data["brand_slug"] = $slug;
        return view('admin.category.catBrand',$data);
    }

    public function addShopCategory()
    {
        $data['main_categories'] = ShopCategory::where('parent_id','0')->get()->toArray();
        $data['sizes'] = Size::get();
        //print_r($data);
        return view('admin.category.addShopCategory',$data);
    }


    public function addShopProcess(Request $request){

        $category = new ShopCategory();
       
        $category->shop_cat_name = $request->shop_cat_name;
        $category->shop_cat_slug =  Str::slug($request->shop_cat_name);
        //$category->addFlag(ShopCategory::FLAG_ACTIVE);
        $category->flags = (int) $request->status;
        if($request->parent_id > 0){
            $category->parent_id = $request->parent_id;
        }else{
            $category->parent_id = 0;
        }
        $category->parent_id ;
        
        
        if($category->save()){
            foreach($request->sizes as $size){
                $category_size = new CategorySize();
                $category_size->category_id =  $category->id;
                $category_size->size_id = $size;
                $category_size->save();
            }
            
            return redirect(route('add.shop.category'))->with(['message'=> "Categroies Added Successfully"]);
        }
        else{
            return redirect(route('add.shop.category'))->with(['error'=> "Something Wrong, Please Try Again"]);
        }
        
    }

    public function edit_category($id){

        $data['category'] = ShopCategory::where('id',$id)->first();
        $data['category_sizes'] = CategorySize::where('category_id',$id)->get();
        $data['id'] = $id;
        $data['main_categories'] = ShopCategory::where('parent_id','0')->get();
        if($data['category']->parent_id > 0){
            $parent_id = $data['category']->parent_id;

            $data['parent'] = ShopCategory::where('id',$parent_id)->first();
        }

        $data['sizes'] = Size::get();

        return view('admin.category.edit-index',$data);
    }

    public function delete_category($id){

       $category=ShopCategory::find($id)->delete();
       return redirect()->back();


    }


    public function edit_process(Request $request){
        $category = ShopCategory::where('id',$request->id)->first();
       
        $category->shop_cat_name = $request->input('shop_cat_name', $category->shop_cat_name); ;
        $category->shop_cat_slug =  Str::slug($request->shop_cat_name);
        $category->removeFlag(ShopCategory::FLAG_ACTIVE);
 
          if($request->status == 1)
          {
            $category->addFlag(ShopCategory::FLAG_ACTIVE);          
          }
        if($request->parent_id > 0){
            $category->parent_id = $request->parent_id;
        }else{
            $category->parent_id = 0;
        }
        
        $category_size = CategorySize::where('category_id',$category->id)->delete();
        
        foreach($request->sizes as $size){
            $category_size = new CategorySize();
            $category_size->category_id =  $category->id;
            $category_size->size_id = $size;
            $category_size->save();
        }

        if($category->save()){
            return redirect()->back()->with(['message'=> "Categroies Updated Successfully"]);
        }
        else{
            return redirect()->back()->with(['error'=> "Something Wrong, Please Try Again"]);
        }
    }
    
    

}
