<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Concerns\Flagable;

class Wishlist extends Model
{
    use  HasFactory,Flagable;

    protected $appends = [
      'Active'
    ];

    public const STATUS_ACTIVE = 'Active';
    public const STATUS_NOT_ACTIVE = 'Not-active';
    public const FLAG_ACTIVE = 1;

    public function getActiveAttribute() {
        return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;

    }
    public function user(){
        return $this->hasOne('App\Models\User','id','user_id');
    } 

    public function product(){
        return $this->hasOne('App\Models\Product','id','product_id');
    } 
}
