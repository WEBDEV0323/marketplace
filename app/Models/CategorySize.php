<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Concerns\Flagable;

class CategorySize extends Model
{
    use  HasFactory,Flagable;

    protected $appends = [
      'active',''
    ];

    public const STATUS_ACTIVE = 'active';
    public const STATUS_NOT_ACTIVE = 'not-active';
    public const FLAG_ACTIVE = 1;

    public function getActiveAttribute() {
        return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;

    }

    public function category()
    {
        return $this->hasOne('App\Models\ShopCategory','id','category_id');
    }

    public function size()
    {
        return $this->hasOne('App\Models\Size','id','size_id');
    }

    public function sizes()
    {
        return $this->hasMany('App\Models\Size','id','size_id');
    }
    
}
