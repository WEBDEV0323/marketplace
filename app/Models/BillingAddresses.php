<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingAddresses extends Model
{
    use HasFactory;
    protected $table="billing_addresses";
    protected $guarded=[];
}
