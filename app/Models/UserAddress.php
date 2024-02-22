<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Concerns\Flagable;

class UserAddress extends Model
{
    use  HasFactory,Flagable;
    protected $guarded=[];

    protected $appends = [
      'active','shipping_address','billing_address'
    ];

    public const STATUS_ACTIVE = 'active';
    public const STATUS_NOT_ACTIVE = 'not-active';
    public const FLAG_ACTIVE = 1;
    public const FLAG_SHIPPING_ADDRESS = 2;
    public const FLAG_BILLING_ADDRESS = 4;

    public function getActiveAttribute() {
        return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;
    }
    public function getShippingAddressAttribute() {
      return ($this->flags & self::FLAG_SHIPPING_ADDRESS) == self::FLAG_SHIPPING_ADDRESS;
    }
  public function getBillingAddressAttribute() {
    return ($this->flags & self::FLAG_BILLING_ADDRESS) == self::FLAG_BILLING_ADDRESS;
  }

    
}
