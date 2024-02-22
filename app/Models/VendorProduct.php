<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Concerns\Flagable;

class VendorProduct extends Model
{
    use  HasFactory,Flagable;

    protected $appends = [
        'active','image_url','draft'
      ];
  
      public const STATUS_ACTIVE = 'active';
      public const STATUS_NOT_ACTIVE = 'not-active';
      public const FLAG_ACTIVE = 1;
      public const FLAG_DRAFT = 2;
      public const FLAG_PURCHASED = 4;
  
      public function getActiveAttribute() {
          return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;
  
      }
      public function getDraftAttribute() {
        return ($this->flags & self::FLAG_DRAFT) == self::FLAG_DRAFT;
      }
      public function getPurchasedAttribute() {
        return ($this->flags & self::FLAG_PURCHASED) == self::FLAG_PURCHASED;
      }
      public function getImageUrlAttribute()
      {
          return url('/').'/storage/seller-product/'.$this->id.'/'.$this->image;
      }
      public function user() {
         return $this->hasOne('App\Models\User','id','vendor_id');
      }
      public function product() {
        return $this->hasOne('App\Models\Product','id','product_id');
      }
     public function category() {
        return $this->hasOne('App\Models\ShopCategory','id','category_id');
      }
      public function brand() {
        return $this->hasOne('App\Models\Brand','id','brand_id');
      }
      public function size_name() {
        return $this->hasOne('App\Models\Size','id','size');
      }
    public function vendor_stock() {
        return $this->hasOne('App\Models\VendorsProductStock','vendor_product_id','id');
    }
    public function admin_paid_to_vendor() {
      return $this->hasOne('App\Models\VendorOrderReciept','vendor_product_id','id');
    }
    
}
