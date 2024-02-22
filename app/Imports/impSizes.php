<?php

namespace App\Imports;

use App\Models\Size;
use App\Models\Brand;
use App\Models\ShopCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;

class impSizes implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable;

    public function model(array $row)
    {
        
            $gender = ['Mens' => 'Menswear', 'Menswear' => 'Menswear', 'Womens' => 'Womenswear', 'Womenswear' => 'Womenswear', 'Children' => 'Children', 'Nightwear' => 'Nightwear'];
            
            $brand_id = Brand::where('brand_name', $row[0])->get();
            print_r($brand_id);
            exit();
            $gender_id = ShopCategory::where("parent_id", 0)->where('shop_cat_name', $gender[$row['Gender']] ?? '')->first()->id ?? 0;
            $shop_category_id = ShopCategory::where("parent_id", $gender_id)->where('shop_cat_name', trim($row['Category']))->first()->id ?? 0;
            
            //if brand category and gender not found product will not be created
            if($brand_id == 0 || $shop_category_id == 0 || $gender_id == 0){
                return null;
            }

            $addSize['brand_id'] = $brand_id;
            $addSize['shop_category_id'] = $shop_category_id;
            $addSize['size'] = $row['size'];
            $addSize['flags'] = 1;
            
            $size = Size::create($addSize);

//            return $addSize;

        
    }
}
