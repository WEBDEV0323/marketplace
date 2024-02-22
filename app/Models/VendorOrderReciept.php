<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorOrderReciept extends Model
{
    use HasFactory;
    
    public function vendor_product() {
        return $this->hasOne('App\Models\VendorProduct','id','vendor_product_id');
    }
}
