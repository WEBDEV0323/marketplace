<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;
use DB;
use Illuminate\Support\Str;
use Artisan;

class BrandController extends Controller
{
    //


    public function index(){
      // echo 'sdasd';
          $data['data'] = Brand::orderBy('brand_name','ASC')->get()->toArray();
         return view('admin.brand.brandHome',$data);
    }
    public function brands()
    {
    

      //$brand_ids = Product::distinct()->pluck("brand_id");
      //$data["data"] = Brand::whereIn("id",$brand_ids)->get()->toArray();
      $data["data"] = Brand::all()->toArray();
      
      return view('admin.brand.brandProducts',$data);
    } 

     public function addBrand(){
           return view('admin.brand.addBrand');
      }

      public function brandProcess(Request $request){

        $brand = new Brand();

        $request->validate([
            'name'  => 'required|unique:brands,brand_name',
        ]); 
        $brand->brand_name = $request->name;
        $brand->brand_slug =  Str::slug($request->name);
        $brand->addFlag(Brand::FLAG_ACTIVE);
        $brand->save();

        if (!is_dir(storage_path("app/public/brands/"))) {
          mkdir(storage_path("app/public/brands/"), 0777, true);
      }
      
      mkdir(storage_path("app/public/brands/" .$brand->id), 0777, true);
      
      if(\File::exists($request->image)){
       
        $file_name = addFile($request->image, storage_path("app/public/brands/" . $brand->id));
        $brand->image = $file_name;
        $artisan_call_to_make_files_public = \Artisan::call("storage:link", []);
        if ($artisan_call_to_make_files_public) {
          DB::rollBack();
        }
        
    }

        if($brand->save()){
            return redirect(route('brand-home'))->with(["message" => "brand Added Successfully"]);
        }else{
            return redirect(route('brand-home'))->with(["error" => "Something Wrong, Please Try Again"]);
        }

      }

       public function brandWithId($id){
       //echo $id;
        $data['brand'] = Brand::whereId($id)->get()->toArray();
        return view('admin.brand.brandEdit',$data);
       }


    public function brandEditProcess(Request $request){

          $brand = Brand::where('id',$request->id)->first(); 
          $brand->brand_name = $request->input('name', $brand->brand_name);
          $brand->brand_slug =  Str::slug($request->input('name', $brand->brand_name));
          $brand->removeFlag(Brand::FLAG_ACTIVE);

          if($request->all_remove=="1")
          {

            $bb=Brand::find($request->id);
            $bb->image="";
            $bb->save();

          }
          
 
          if($request->status == 1)
          {
            $brand->addFlag(Brand::FLAG_ACTIVE);          
          }
          

          if (!is_dir(storage_path("app/public/brands/"))) {
            mkdir(storage_path("app/public/brands/"), 0777, true);
        
        }

        if (!is_dir(storage_path("app/public/brands/".$brand->id))) {
        mkdir(storage_path("app/public/brands/" .$brand->id), 0777, true);
        }

           if(\File::exists($request->image)){
            $file_name = addFile($request->image, storage_path("app/public/brands/".$brand->id));
            if($file_name){
                //unlink(storage_path("app/public/brands/" . $brand->id . '/' . $brand->image));
                $brand->image = $file_name;
            }    
        } 
        /* if(\File::exists($request->image)){
       
          if (!is_dir(storage_path("app/public/brands/"))) {
              mkdir(storage_path("app/public/brands/"), 0777, true);
          
          }
          
         
          mkdir(storage_path("app/public/brands/" .$brand->id), 0777, true);
          $file_name = addFile($request->image, storage_path("app/public/brands/" . $brand->id));
          $brand->image = $file_name;
          $artisan_call_to_make_files_public = \Artisan::call("storage:link", []);
          if ($artisan_call_to_make_files_public) {
            DB::rollBack();
          }
          
      } */

          if($brand->save()){
            return redirect(route('brand-home'))->with(["message" => "Brand Updated Successfully"]);
          }else{
            return redirect(route('brand-home'))->with(["error" => "Something Wrong, Please Try Again"]);
          }


       }

  public function brandDelete($id){
    $brand = Brand::find($id)->delete();
    
    if($brand){
      return redirect(route('brand-home'))->with(["message" => "Brand Deleted Successfully"]);
    }
    else{
      return redirect(route('brand-home'))->with(["error" => "Something Wrong, Please Try Again"]);
    }
  }
  public function removeImage($id)
  {
    $brand=Brand::find($id);
    $brand->image="";
    $brand->save();

    return redirect()->back();


  }

}
