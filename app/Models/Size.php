<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Concerns\Flagable;
//use Illuminate\Database\Eloquent\SoftDeletes;


class Size extends Model
{
    use  HasFactory, Flagable;//, SoftDeletes;

    protected $appends = [
      'active'
    ];

    protected $fillable = [
        'brand_id',
        'shop_category_id',
        'size',
        'flags',
        'size_id',
        'gender'
    ];

    public const STATUS_ACTIVE = 'active';
    public const STATUS_NOT_ACTIVE = 'not-active';
    public const FLAG_ACTIVE = 1;

    public function getActiveAttribute() {
        return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;

    }

    public function product_size() {
      return $this->hasMany('App\Models\ProductSize','size_id','id');
    }

    public function product_size_one() {
      return $this->hasOne('App\Models\ProductSize','size_id','id');
    }

    public function shop_category(){
        return $this->hasOne('App\Models\ShopCategory','id','shop_category_id');
    }

    public function brand() {
        return $this->hasOne('App\Models\Brand','id','brand_id');
    }
    
}
