<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Concerns\Flagable;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductImage extends Model
{
     use  HasFactory,Flagable, SoftDeletes;

    protected $appends = [
      'active','image_multi_url', 'image_multi_vendor_url'
    ];

    public const STATUS_ACTIVE = 'active';
    public const STATUS_NOT_ACTIVE = 'not-active';
    public const FLAG_ACTIVE = 1;

    public function getActiveAttribute() {
        return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;

    }

    public function getImageMultiUrlAttribute()
    {
        return url('/').'/storage/product/'.$this->product_id.'/'.$this->image;
    }

    public function getImageMultiVendorUrlAttribute()
    {
        return url('/').'/storage/seller-product/'.$this->product_id.'/'.$this->image;
    }
}
