<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Concerns\Flagable;

class Coupon extends Model
{
    use HasFactory,Flagable;
    
    protected $appends = [
        'Active'
    ];
  
    public const STATUS_ACTIVE = 'Active';
    public const STATUS_NOT_ACTIVE = 'Not-active';
    public const FLAG_ACTIVE = 1;
  
    public function getActiveAttribute() {
        return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;
      }

      protected $casts = [
        'discount' => 'integer',
    ];
}
