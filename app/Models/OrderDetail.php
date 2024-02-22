<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Concerns\Flagable;

class OrderDetail extends Model
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

    public function product()
    {
        return $this->hasMany('App\Models\Product','id','product_id');
    }

    public function size_detail()
    {
        return $this->hasOne('App\Models\Size','id','size_id');
    }

    public function prod_size() {
        return $this->hasOne('App\Models\ProductSize','id','size_id');
    }

    

}
