<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Concerns\Flagable;
use App\Models\Product;

class ProductCatShop extends Model
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
    public function product() {
      return $this->hasOne('App\Models\Product', 'id','product_id');
    }

    public function shop_cat() {
      return $this->hasOne('App\Models\ShopCategory', 'id','shop_cat_id');
    }
    public function cat_parent() {
      return $this->hasOne('App\Models\ShopCategory', 'id','parent_cat_id');
    }

    
}
