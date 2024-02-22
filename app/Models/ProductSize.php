<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Concerns\Flagable;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductSize extends Model
{
       use  HasFactory,Flagable, SoftDeletes;

    protected $appends = [
      'active'
    ];

    public const STATUS_ACTIVE = 'active';
    public const STATUS_NOT_ACTIVE = 'not-active';
    public const FLAG_ACTIVE = 1;

    public function getActiveAttribute() {
        return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;

    }

    public function size() {
      return $this->hasOne('App\Models\Size','id','size_id');
    }

    public function products() {
      return $this->hasOne('App\Models\Product','id','product_id');
    }
}
