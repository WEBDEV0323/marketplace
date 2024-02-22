<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\ShopCategory;
use App\Models\CategorySize;
use App\Models\ProductSize;
use App\Models\Brand;
use App\Models\SizeGuide;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Artisan;
use App\Imports\impSizes;

class SizeController extends Controller
{
    public function index($slug)
    {
        $data['data'] = Size::where('brand_id', '=', $_GET["brand_slug"])
            ->where('shop_category_id', '=',  $slug)
            // ->orderBy('size_id', 'DESC')->get()->toArray();
            ->orderBy('id', 'ASC')->get()->toArray();

        $data['brand_id'] = $_GET["brand_slug"];
        $data['gender'] = $_GET['gender'];
        $data['category_id'] = $slug;

        return view('admin.size.sizeHome', $data);
    }

    public function sizeBrand()
    {
        $data["data"] = Brand::all()->toArray();

        return view('admin.size.sizeProducts', $data);
    }

    public function category_sizebrand($slug)
    {
        $brand = Brand::where("brand_slug", $slug)->pluck("id");

        $data['shop_categories'] = ShopCategory::select(["shop_categories.*", "sc.shop_cat_name as gender"])
            ->join("shop_categories as sc", "shop_categories.parent_id", "=", "sc.id")->get()->toArray();

        $data['gender'] = ShopCategory::where("parent_id", 0)->get();

        $data["brand_slug"] = $slug;

        return view('admin.size.catSizeBrand', $data);
    }

    public function addSize()
    {
        $brand_id = $_GET['brand_id'];
        $category_id = $_GET['category_id'];
        $gender = $_GET['gender'];

        $data["brand_id"] = $brand_id;
        $data["category_id"] = $category_id;
        $data["gender"] = $gender;

        $data['brands'] = Brand::where('id', $brand_id)->get()->sortBy('brand_name')->toArray();
        $data['categories'] = ShopCategory::where('id', $category_id)->get();
        $data['genders'] = ShopCategory::where('shop_cat_name', $gender)->get();

        // dd($data['genders']);
        return view('admin.size.addSize', $data);
    }

    public function sizeProcess(Request $request)
    {
        $gender = $request->gender;
        $genderName = ShopCategory::where('id', $request->gender)->value('shop_cat_name');
        if ($genderName !=  '') {
            $gender = $genderName;
        }

        if ($request->id) {
            $size = Size::where('id', $request->id)->get()->first();
            $size->size = $request->name;
            $size->brand_id = $request->brand;
            $size->shop_category_id = $request->categories;
            $size->gender = $request->gender;
            $size->size_id = $request->size_id;
            if ($size->save()) {
                // delete sizes 
                    if($request->size_all_old){
                        $oldsizeGuideArrayKey = array_keys($request->size_all_old);
                    }else{
                        $oldsizeGuideArrayKey = [0];
                    }
                    SizeGuide::where('brand_id',$request->brand)->where('shop_category_id',$request->categories)->where('gender',$request->gender)->where('size_id',$size->id)->whereNotIN('id',$oldsizeGuideArrayKey)->delete();
                // delete sizes 
                if($request->size_all_old){
                    $oldSize = $request->size_all_old;
                    foreach($oldSize as $key => $row){
                        $size_guide = SizeGuide::find($key); 
                        $size_guide->guide_size = $row;  
                        $size_guide->save(); 
                    }
                }   
                if($request->size_all){
                    $allGuideSize = $request->size_all;
                    foreach($allGuideSize as $row){
                        $size_guide = new SizeGuide(); 
                        $size_guide->brand_id =  $request->brand; 
                        $size_guide->shop_category_id = $request->categories;  
                        $size_guide->gender = $request->gender; 
                        $size_guide->size_id = $size->id; 
                        $size_guide->guide_size = $row;  
                        $size_guide->save(); 
                    }
                }
                return redirect(route('size-home', $request->categories . '?brand_slug=' . $request->brand . '&gender=' . $gender))->with(["message" => "Size Update Successfully"]);
            } else {
                return redirect(route('size-home', $request->categories . '?brand_slug=' . $request->brand . '&gender=' . $gender))->with(["error" => "Something Wrong, Please Try Again"]);
            }
        } else {
            $size = new Size();
            $size->size = $request->name;
            $size->brand_id = $request->brand_id;
            $size->shop_category_id = $request->shop_category_id;
            $size->gender = $request->gender;
            $size->addFlag(Size::FLAG_ACTIVE);

            if ($size->save()) {
                $sc = Size::find($size->id);
                $sc->size_id = $size->id;
                $sc->save();

                if($request->size_all){
                    $allGuideSize = $request->size_all;
                    foreach($allGuideSize as $row){
                        $size_guide = new SizeGuide(); 
                        $size_guide->brand_id =  $request->brand_id; 
                        $size_guide->shop_category_id = $request->shop_category_id;  
                        $size_guide->gender = $request->gender; 
                        $size_guide->size_id = $size->id; 
                        $size_guide->guide_size = $row;  
                        $size_guide->save(); 
                    }
                }
                return redirect(route('size-home', $request->shop_category_id . '?brand_slug=' . $request->brand_id . '&gender=' . $gender))->with(["message" => "Size Added Successfully"]);
            } else {
                return redirect(route('size-home', $request->shop_category_id . '?brand_slug=' . $request->brand_id . '&gender=' .  $gender))->with(["error" => "Something Wrong, Please Try Again"]);
            }
        }
    }

    public function category_size()
    {
        return view('admin.size.view-category-size');
    }

    public function add_category_size()
    {
        $data['shop_cats'] = ShopCategory::where('parent_id', '<>', '0')->get();
        $data['sizes'] = Size::get();
        return view('admin.size.add-category-size', $data);
    }

    public function category_size_process(Request $request)
    {
        foreach ($request->sizes as $size) {
            $category_size = new CategorySize();
            $category_size->category_id = $request->category;
            $category_size->size_id = $size;
            $category_size->save();
        }
    }

    public function editSize($id)
    {
        $data['brands'] = Brand::orderBy("brand_name", "ASC")->get()->toArray();
        $data['list_gender'] = ShopCategory::where("parent_id", 0)->get();
        $data["gender"] = 0;
        $data['gen'] = Size::where('id', $id)->first()->toArray();
        $data['size'] = Size::where('id', $id)->with('shop_category', 'shop_category.cat_parent', 'brand')->first()->toArray();
        //$data['size'] = Size::where('id', $id)->get()->first()->toArray();
        if (isset($data['product']["shop_category_id"])  &&   (int)$data['product']["shop_category_id"] > 0) {
            $data['categories1'] = ShopCategory::where("id", $data['product']["shop_category_id"])->first();
            $data['categories'] = ShopCategory::where("parent_id", $data['categories1']->parent_id)
                ->orderBy("shop_cat_name", "asc")
                ->get();
            $data["gender"] = $data['categories1']->parent_id;
        } else {
            $data['categories'] = ShopCategory::orderBy("shop_cat_name", "asc")->get();
        }
        $data['size_guide'] = SizeGuide::where('size_id',$id)->get();
        // print_r($data['size']);
        // die;
        return view('admin.size.edit', $data);
    }

    public function deleteSize($id)
    {   
        $size = ProductSize::where('size_id', $id)->delete();
        $size = Size::where('id', $id)->delete();
        if ($size) {
            return redirect()->back()->with(["message" => "Size Deleted Successfully"]);
            //return redirect(route('size-home'))->with(["message" => "Size Deleted Successfully"]);
        } else {
            return redirect()->back()->with(["error" => "Something Wrong, Please Try Again"]);
            //return redirect(route('size-home'))->with(["error" => "Something Wrong, Please Try Again"]);
        }
    }

    public function importSize()
    {
        /*$brand_id = $_GET['brand_id'];
        $category_id = $_GET['category_id'];

        $data["brand_id"]=$brand_id;
        $data["category_id"]=$category_id;

        $data['brands'] = Brand::where('id', $brand_id)->get()->sortBy('brand_name')->toArray();
        $data['categories'] = ShopCategory::where('id', $category_id)->get();*/

        return view('admin.size.importSize'); //,$data);
    }

    public function sizeImportProcess999(Request $request)
    {
        $input = $request->all();

        if (isset($input["import_file_name"])) {
            $imagePath = $input["import_file_name"];
            $extension  = pathinfo($imagePath->getClientOriginalName(), PATHINFO_EXTENSION);
        }

        if (($handle = fopen($imagePath, 'r')) !== FALSE) {
            $flag = true;
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                if ($flag) {
                    $flag = false;
                    continue;
                }
                echo "<br>" . $brand_id = $data[0];
                echo "<br>" . $category_id = $data[1];
                echo "<br>" . $gender = $data[2];
                echo "<br>" . $size = $data[3];

                $brand = Brand::query()->where('brand_name', '=', $brand_id)->first();

                $cat = ShopCategory::query()->where('shop_cat_name', '=', $category_id)->first();

                $addSize['brand_id'] = $brand->id;
                $addSize['shop_category_id'] = $cat->id;
                $addSize['size'] = $size;
                $addSize['flags'] = 1;

                $size = Size::create($addSize);

                $updateSize['size_id'] = $size->id;

                Size::query()->where('id', '=', $size->id)->update($updateSize);
            }
            fclose($handle);
        }
        return Redirect::back()->with(["message" => "Data has been imported!"]);

        /*$file = $request->file('import_file_name');
        Excel::import(new impSizes(), $file);
             
        return back();*/
        /* try {
            
            if ($request->hasFile('import_file_name')) {
    
                $file = $request->file('import_file_name');
                $extension = $file->getClientOriginalExtension();
                $path = $file->getRealPath();
    
                if (!in_array($extension, ['csv', 'xls', 'xlsx'])) 
                {
                    return Redirect::back()->with(["error" => "The only acceptable formats are CSV, XLS, XLSX"]);
                }

                Excel::import(new impSizes(), $file);
                //Excel::import(new impSizes, $request->file);
                $artisan_call_to_make_files_public = Artisan::call("storage:link", []);
                if ($artisan_call_to_make_files_public) {
                
                    //error return
                }
                    
                return Redirect::back()->with(["message" => "Data has been imported!"]);
            }
    
            return Redirect::back()->with(["error" => "Something Wrong, Please Try Again"]);
            
        } catch (\Exception $e) {
    
            return Redirect::back()->with(["error" => $e->getMessage()]);
        }*/
    }

    public function sizeImportProcess(Request $request)
    {
        $input = $request->all();

        if (isset($input["import_file_name"])) {
            $imagePath = $input["import_file_name"];
            $extension  = pathinfo($imagePath->getClientOriginalName(), PATHINFO_EXTENSION);
        }

        if (($handle = fopen($imagePath, 'r')) !== FALSE) {
            $flag = true;
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                // print_r($data);

                if ($flag) {
                    $flag = false;
                    continue;
                }
                echo "<br>" . $brand_id = $data[0];
                echo "<br>" . $category_id = $data[1];
                echo "<br>" . $gender = $data[2];
                echo "<br>" . $size1 = $data[3];
                echo "<br>" . $size2 = $data[4];
                echo "<br>" . $size3 = $data[5];
                echo "<br>" . $size4 = $data[6];
                echo "<br>" . $size5 = $data[7];
                echo "<br>" . $size6 = $data[8];
                echo "<br>" . $size7 = $data[9];
                echo "<br>" . $size8 = $data[10];
                echo "<br>" . $size9 = $data[11];
                echo "<br>" . $size10 = $data[12];
                echo "<br>" . $size11 = $data[13];
                echo "<br>" . $size12 = $data[14];
                echo "<br>" . $size13 = $data[15];
                echo "<br>" . $size14 = $data[16];
                echo "<br>" . $size15 = $data[17];
                echo "<br>" . $size16 = $data[18];
                echo "<br>" . $size17 = $data[19];
                echo "<br>" . $size18 = $data[20];
                echo "<br>" . $size19 = $data[21];

                $brand = Brand::query()->where('brand_name', '=', $brand_id)->first();

                $subgen = ShopCategory::query()->where('shop_cat_name', '=', $gender)->first();
                $cat = ShopCategory::query()->where('shop_cat_name', '=', $category_id)->where('parent_id', '=', $subgen->id)->first();

                $gen = ShopCategory::query()->where('shop_cat_name', '=', $gender)->first();

                if ($brand && $cat && $gen) {
                    if ($size1 == 'NA') {

                        $brandsize = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->get();

                        if (count($brandsize) > 0) {
                            $deletdProductsize = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->pluck('id');
                            $deleteSize = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->delete();
                            ProductSize::whereIn('size_id', $deletdProductsize)->delete();
                        }
                    }

                    if ($size1 && $size1 != 'NA') {
                        $brandsize1 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size1)->get();

                        if (count($brandsize1) > 0) {
                            $deletdProductsize1 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size1)->pluck('id');
                            $deleteSize1 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size1)->delete();
                            ProductSize::whereIn('size_id', $deletdProductsize1)->delete();
                        }
                        $addSize['brand_id'] = $brand->id;
                        $addSize['shop_category_id'] = $cat->id;
                        $addSize['gender'] = $gen->id;
                        $addSize['size'] = $size1;
                        $addSize['flags'] = 1;

                        $size = Size::create($addSize);

                        $updateSize['size_id'] = $size->id;

                        Size::query()->where('id', '=', $size->id)->update($updateSize);
                    }
                    if ($size2) {
                        $brandsize2 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size2)->get();
                        
                        if (count($brandsize2) > 0) {
                            $deletdProductsize2 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size2)->pluck('id');
                            $deleteSize2 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size2)->delete();
                            ProductSize::whereIn('size_id', $deletdProductsize2)->delete();
                        }
                        $addSize['brand_id'] = $brand->id;
                        $addSize['shop_category_id'] = $cat->id;
                        $addSize['gender'] = $gen->id;
                        $addSize['size'] = $size2;
                        $addSize['flags'] = 1;

                        $size = Size::create($addSize);

                        $updateSize['size_id'] = $size->id;

                        Size::query()->where('id', '=', $size->id)->update($updateSize);
                    }
                    if ($size3) {
                        $brandsize3 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size3)->get();

                        if (count($brandsize3) > 0) {
                            $deletdProductsize3 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size3)->pluck('id');
                            $deleteSize3 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size3)->delete();
                            ProductSize::whereIn('size_id', $deletdProductsize3)->delete();
                        }
                        $addSize['brand_id'] = $brand->id;
                        $addSize['shop_category_id'] = $cat->id;
                        $addSize['gender'] = $gen->id;
                        $addSize['size'] = $size3;
                        $addSize['flags'] = 1;

                        $size = Size::create($addSize);

                        $updateSize['size_id'] = $size->id;

                        Size::query()->where('id', '=', $size->id)->update($updateSize);
                    }
                    if ($size4) {
                        $brandsize4 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size4)->get();

                        if (count($brandsize4) > 0) {
                            $deletdProductsize4 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size4)->pluck('id');
                            $deleteSize4 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size4)->delete();
                            ProductSize::whereIn('size_id', $deletdProductsize4)->delete();
                        }
                        $addSize['brand_id'] = $brand->id;
                        $addSize['shop_category_id'] = $cat->id;
                        $addSize['gender'] = $gen->id;
                        $addSize['size'] = $size4;
                        $addSize['flags'] = 1;

                        $size = Size::create($addSize);

                        $updateSize['size_id'] = $size->id;

                        Size::query()->where('id', '=', $size->id)->update($updateSize);
                    }
                    if ($size5) {
                        $brandsize5 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size5)->get();

                        if (count($brandsize5) > 0) {
                            $deletdProductsize5 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size5)->pluck('id');
                            $deleteSize5 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size5)->delete();
                            ProductSize::whereIn('size_id', $deletdProductsize5)->delete();
                        }
                        $addSize['brand_id'] = $brand->id;
                        $addSize['shop_category_id'] = $cat->id;
                        $addSize['gender'] = $gen->id;
                        $addSize['size'] = $size5;
                        $addSize['flags'] = 1;

                        $size = Size::create($addSize);

                        $updateSize['size_id'] = $size->id;

                        Size::query()->where('id', '=', $size->id)->update($updateSize);
                    }
                    if ($size6) {
                        $brandsize6 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size6)->get();

                        if (count($brandsize6) > 0) {
                            $deletdProductsize6 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size6)->pluck('id');
                            $deleteSize6 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size6)->delete();
                            ProductSize::whereIn('size_id', $deletdProductsize6)->delete();
                        }

                        $addSize['brand_id'] = $brand->id;
                        $addSize['shop_category_id'] = $cat->id;
                        $addSize['gender'] = $gen->id;
                        $addSize['size'] = $size6;
                        $addSize['flags'] = 1;

                        $size = Size::create($addSize);

                        $updateSize['size_id'] = $size->id;

                        Size::query()->where('id', '=', $size->id)->update($updateSize);
                    }
                    if ($size7) {
                        $brandsize7 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size7)->get();

                        if (count($brandsize7) > 0) {
                            $deletdProductsize7 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size7)->pluck('id');
                            $deleteSize7 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size7)->delete();
                            ProductSize::whereIn('size_id', $deletdProductsize7)->delete();
                        }

                        $addSize['brand_id'] = $brand->id;
                        $addSize['shop_category_id'] = $cat->id;
                        $addSize['gender'] = $gen->id;
                        $addSize['size'] = $size7;
                        $addSize['flags'] = 1;

                        $size = Size::create($addSize);

                        $updateSize['size_id'] = $size->id;

                        Size::query()->where('id', '=', $size->id)->update($updateSize);
                    }
                    if ($size8) {
                        $brandsize8 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size8)->get();

                        if (count($brandsize8) > 0) {
                            $deletdProductsize8 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size8)->pluck('id');
                            $deleteSize8 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size8)->delete();
                            ProductSize::whereIn('size_id', $deletdProductsize8)->delete();
                        }
                        $addSize['brand_id'] = $brand->id;
                        $addSize['shop_category_id'] = $cat->id;
                        $addSize['gender'] = $gen->id;
                        $addSize['size'] = $size8;
                        $addSize['flags'] = 1;

                        $size = Size::create($addSize);

                        $updateSize['size_id'] = $size->id;

                        Size::query()->where('id', '=', $size->id)->update($updateSize);
                    }
                    if ($size9) {
                        $brandsize9 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size9)->get();

                        if (count($brandsize9) > 0) {
                            $deletdProductsize9 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size9)->pluck('id');
                            $deleteSize9 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size9)->delete();
                            ProductSize::whereIn('size_id', $deletdProductsize9)->delete();
                        }
                        $addSize['brand_id'] = $brand->id;
                        $addSize['shop_category_id'] = $cat->id;
                        $addSize['gender'] = $gen->id;
                        $addSize['size'] = $size9;
                        $addSize['flags'] = 1;

                        $size = Size::create($addSize);

                        $updateSize['size_id'] = $size->id;

                        Size::query()->where('id', '=', $size->id)->update($updateSize);
                    }
                    if ($size10) {
                        $brandsize10 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size10)->get();

                        if (count($brandsize10) > 0) {
                            $deletdProductsize10 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size10)->pluck('id');
                            $deleteSize10 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size10)->delete();
                            ProductSize::whereIn('size_id', $deletdProductsize10)->delete();
                        }
                        $addSize['brand_id'] = $brand->id;
                        $addSize['shop_category_id'] = $cat->id;
                        $addSize['gender'] = $gen->id;
                        $addSize['size'] = $size10;
                        $addSize['flags'] = 1;

                        $size = Size::create($addSize);

                        $updateSize['size_id'] = $size->id;

                        Size::query()->where('id', '=', $size->id)->update($updateSize);
                    }
                    if ($size11) {
                        $brandsize11 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size11)->get();

                        if (count($brandsize11) > 0) {
                            $deletdProductsize11 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size11)->pluck('id');
                            $deleteSize11 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size11)->delete();
                            ProductSize::whereIn('size_id', $deletdProductsize11)->delete();
                        }
                        $addSize['brand_id'] = $brand->id;
                        $addSize['shop_category_id'] = $cat->id;
                        $addSize['gender'] = $gen->id;
                        $addSize['size'] = $size11;
                        $addSize['flags'] = 1;

                        $size = Size::create($addSize);

                        $updateSize['size_id'] = $size->id;

                        Size::query()->where('id', '=', $size->id)->update($updateSize);
                    }
                    if ($size12) {
                        $brandsize12 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size12)->get();

                        if (count($brandsize12) > 0) {
                            $deletdProductsize12 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size12)->pluck('id');
                            $deleteSize12 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size12)->delete();
                            ProductSize::whereIn('size_id', $deletdProductsize12)->delete();
                        }
                        $addSize['brand_id'] = $brand->id;
                        $addSize['shop_category_id'] = $cat->id;
                        $addSize['gender'] = $gen->id;
                        $addSize['size'] = $size12;
                        $addSize['flags'] = 1;

                        $size = Size::create($addSize);

                        $updateSize['size_id'] = $size->id;

                        Size::query()->where('id', '=', $size->id)->update($updateSize);
                    }
                    if ($size13) {
                        $brandsize13 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size13)->get();

                        if (count($brandsize13) > 0) {
                            $deletdProductsize13 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size13)->pluck('id');
                            $deleteSize13 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size13)->delete();
                            ProductSize::whereIn('size_id', $deletdProductsize13)->delete();
                        }
                        $addSize['brand_id'] = $brand->id;
                        $addSize['shop_category_id'] = $cat->id;
                        $addSize['gender'] = $gen->id;
                        $addSize['size'] = $size13;
                        $addSize['flags'] = 1;

                        $size = Size::create($addSize);

                        $updateSize['size_id'] = $size->id;

                        Size::query()->where('id', '=', $size->id)->update($updateSize);
                    }
                    if ($size14) {
                        $brandsize14 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size14)->get();

                        if (count($brandsize14) > 0) {
                            $deletdProductsize14 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size14)->pluck('id');
                            $deleteSize14 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size14)->delete();
                            ProductSize::whereIn('size_id', $deletdProductsize14)->delete();
                        }
                        $addSize['brand_id'] = $brand->id;
                        $addSize['shop_category_id'] = $cat->id;
                        $addSize['gender'] = $gen->id;
                        $addSize['size'] = $size14;
                        $addSize['flags'] = 1;

                        $size = Size::create($addSize);

                        $updateSize['size_id'] = $size->id;

                        Size::query()->where('id', '=', $size->id)->update($updateSize);
                    }
                    if ($size15) {
                        $brandsize15 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size15)->get();

                        if (count($brandsize15) > 0) {
                            $deletdProductsize15 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size15)->pluck('id');
                            $deleteSize15 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size15)->delete();
                            ProductSize::whereIn('size_id', $deletdProductsize15)->delete();
                        }
                        $addSize['brand_id'] = $brand->id;
                        $addSize['shop_category_id'] = $cat->id;
                        $addSize['gender'] = $gen->id;
                        $addSize['size'] = $size15;
                        $addSize['flags'] = 1;

                        $size = Size::create($addSize);

                        $updateSize['size_id'] = $size->id;

                        Size::query()->where('id', '=', $size->id)->update($updateSize);
                    }
                    if ($size16) {
                        $brandsize16 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size16)->get();

                        if (count($brandsize16) > 0) {
                            $deletdProductsize16 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size16)->pluck('id');
                            $deleteSize16 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size16)->delete();
                            ProductSize::whereIn('size_id', $deletdProductsize16)->delete();
                        }
                        $addSize['brand_id'] = $brand->id;
                        $addSize['shop_category_id'] = $cat->id;
                        $addSize['gender'] = $gen->id;
                        $addSize['size'] = $size16;
                        $addSize['flags'] = 1;

                        $size = Size::create($addSize);

                        $updateSize['size_id'] = $size->id;

                        Size::query()->where('id', '=', $size->id)->update($updateSize);
                    }
                    if ($size17) {
                        $brandsize17 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size17)->get();

                        if (count($brandsize17) > 0) {
                            $deletdProductsize17 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size17)->pluck('id');
                            $deleteSize17 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size17)->delete();
                            ProductSize::whereIn('size_id', $deletdProductsize17)->delete();
                        }
                        $addSize['brand_id'] = $brand->id;
                        $addSize['shop_category_id'] = $cat->id;
                        $addSize['gender'] = $gen->id;
                        $addSize['size'] = $size17;
                        $addSize['flags'] = 1;

                        $size = Size::create($addSize);

                        $updateSize['size_id'] = $size->id;

                        Size::query()->where('id', '=', $size->id)->update($updateSize);
                    }
                    if ($size18) {
                        $brandsize18 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size18)->get();

                        if (count($brandsize18) > 0) {
                            $deletdProductsize18 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size18)->pluck('id');
                            $deleteSize18 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size18)->delete();
                            ProductSize::whereIn('size_id', $deletdProductsize18)->delete();
                        }
                        $addSize['brand_id'] = $brand->id;
                        $addSize['shop_category_id'] = $cat->id;
                        $addSize['gender'] = $gen->id;
                        $addSize['size'] = $size18;
                        $addSize['flags'] = 1;

                        $size = Size::create($addSize);

                        $updateSize['size_id'] = $size->id;

                        Size::query()->where('id', '=', $size->id)->update($updateSize);
                    }
                    if ($size19) {
                        $brandsize19 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size19)->get();

                        if (count($brandsize19) > 0) {
                            $deletdProductsize19 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size19)->pluck('id');
                            $deleteSize19 = Size::query()->where('brand_id', '=', $brand->id)->where('shop_category_id', '=', $cat->id)->where('gender', '=', $gen->id)->where('size', '=', $size19)->delete();
                            ProductSize::whereIn('size_id', $deletdProductsize19)->delete();
                        }
                        $addSize['brand_id'] = $brand->id;
                        $addSize['shop_category_id'] = $cat->id;
                        $addSize['gender'] = $gen->id;
                        $addSize['size'] = $size19;
                        $addSize['flags'] = 1;

                        $size = Size::create($addSize);

                        $updateSize['size_id'] = $size->id;

                        Size::query()->where('id', '=', $size->id)->update($updateSize);
                    }
                }
            }
            //exit();
            fclose($handle);
        }
        return Redirect::back()->with(["message" => "Data has been imported!"]);
    }
}
