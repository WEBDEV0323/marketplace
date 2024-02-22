<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Concerns\Flagable;
use BinaryCats\Sku\HasSku;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Product extends Model
{
   
    use  HasFactory, Flagable, HasSku, SoftDeletes;

    protected $appends = [
      'active','image_url','image_url_vendor' ,'draft', 'fault','product_slug'
    ];
   
    public const STATUS_ACTIVE = 'active';
    public const STATUS_NOT_ACTIVE = 'not-active';
    public const FLAG_ACTIVE = 1;
    public const FLAG_DRAFT = 2;
    public const FLAG_FAULT = 4;

    protected $guarded=[];
  
  	 

    

    public function getActiveAttribute() {
        return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;

    }
    public function getDraftAttribute() {
        return ($this->flags & self::FLAG_DRAFT) == self::FLAG_DRAFT;
    }
    public function getFaultAttribute() {
        return ($this->flags & self::FLAG_FAULT) == self::FLAG_FAULT;
    }

    public function getImageUrlAttribute()
    {
        return url('/').'/storage/product/'.$this->id.'/'.$this->feature_image;
    }

    public function getImageUrlVendorAttribute()
    {
        return url('/').'/storage/seller-product/'.$this->id.'/'.$this->feature_image;
    }

    public function brand() {
        return $this->hasOne('App\Models\Brand','id','brand_id');
    }

   

    public function prod_size() {
        return $this->hasMany('App\Models\ProductSize','product_id','id');
    }

    public function prod_color() {
        return $this->hasMany('App\Models\ProductColor','product_id','id');
    }

    public function admin() {
        return $this->hasOne('App\Models\Admin','id','added_by');
    }

    public function user() {
        return $this->hasOne('App\Models\User','id','vendor_id');
    }

    public function product_parent() {
        return $this->hasOne('App\Models\Product','id','parent_id');
    }
   
    public function shop_category(){
        return $this->hasOne('App\Models\ShopCategory','id','shop_category_id');
    }
    
    public function multi_images() {
        return $this->hasMany('App\Models\ProductImage','product_id','id');
    }

    public function product_faults(){
        return $this->hasMany('App\Models\ProductFault','product_id','id');
    }
    public function product_user()
    {
        return $this->hasOne('App\Models\User','id','vendor_id');

    }

    public function prod_size_one() {
        return $this->hasOne('App\Models\ProductSize','product_id','id');
    }

    public function getBrand() {
        return $this->hasOne('App\Models\Brand','id','brand_id');
    }
  
  
  
  
  
 
      public function setProductSlugAttribute($value)
    {
        $slug = Str::slug($value);
        $uniqueSlug = $slug;

        // Check if the slug is already taken
        $count = 1;
        while (static::where('product_slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $count++;
        }

        $this->attributes['product_slug'] = $uniqueSlug;
    }
  
  	public function getProductSlugAttribute()
    {
        return $this->attributes['product_slug'] ?? null;
    }


  
  

    // Eloquent event to automatically set the slug before saving
    public static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->product_slug = $product->product_name;
        });
    }

   

   
}
