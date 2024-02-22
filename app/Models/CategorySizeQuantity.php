<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySizeQuantity extends Model
{
    use HasFactory;

    public function category(){
        return $this->hasOne('App\Models\ShopCategory','id','shop_category_id');
    }
    public function category_size_id(){
        return $this->hasOne('App\Models\Size','id','size_id');
    }
}
