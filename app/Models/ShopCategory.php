<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Concerns\Flagable;
//use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProductCatShop;

class ShopCategory extends Model
{
    use  HasFactory,Flagable;

    protected $appends = [
      'active'
    ];

    public const STATUS_ACTIVE = 'active';
    public const STATUS_NOT_ACTIVE = 'not-active';
    public const FLAG_ACTIVE = 1;

    public function getActiveAttribute() {
        return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;

    }

    public function cat_parent() {
      return $this->hasOne('App\Models\ShopCategory', 'id','parent_id');
    }

    public function category_size(){
      return $this->hasMany('App\Models\CategorySize', 'id','category_id');
    }

  public function Product(){
    return $this->hasMany('App\Models\Product', 'id','shop_category_id');
  }
  
}
