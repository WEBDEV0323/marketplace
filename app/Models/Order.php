<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Concerns\Flagable;

class Order extends Model
{
    use  HasFactory, Flagable;

    protected $appends = [
        'active', 'process', 'reject', 'success'
    ];

    public const STATUS_ACTIVE = 'active';
    public const STATUS_PROCESS = 'process';
    public const STATUS_SUCCESS = 'success';
    public const STATUS_REJECT = 'reject';
    public const STATUS_NOT_ACTIVE = 'not-active';
    public const FLAG_PROCESS = 1;
    public const FLAG_SUCCESS = 2;
    public const FLAG_REJECT = 4;
    public const FLAG_CANCELED = 8;
    public const FLAG_ONHOLD = 16;
    public const FLAG_ACTIVE = 32;
    public const PAYMENT_TYPES = [
        1 => 'Cash Payment',
        2 => 'PayPal Card Payment',
        3 => 'Stripe Card Payment'
    ];

    public function getPaymentType()
    {
        if($this->attributes['payment_type'] == 1){
            return 'Cash Payment';
        }
        if($this->attributes['payment_type'] == 2){
            return 'PayPal Card Payment';
        }
        if($this->attributes['payment_type'] == 3){
            return 'Stripe Card Payment';
        }
    }

    public function getActiveAttribute()
    {
        return ($this->flags & self::FLAG_ACTIVE) == self::FLAG_ACTIVE;
    }

    public function getProcessAttribute()
    {
        return ($this->flags & self::FLAG_PROCESS) == self::FLAG_PROCESS;
    }

    public function getSuccessAttribute()
    {
        return ($this->flags & self::FLAG_SUCCESS) == self::FLAG_SUCCESS;
    }

    public function getRejectAttribute()
    {
        return ($this->flags & self::FLAG_REJECT) == self::FLAG_REJECT;
    }

    public function getCanceledAttribute()
    {
        return ($this->flags & self::FLAG_CANCELED) == self::FLAG_CANCELED;
    }

    public function getOnholdAttribute()
    {
        return ($this->flags & self::FLAG_ONHOLD) == self::FLAG_ONHOLD;
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function order_detail()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id', 'id')
            ->select(["order_details.*", "product_sizes.*", "order_details.quantity as quantity", "order_details.id as odd"])
            ->join("products", "products.id", "=", "order_details.product_id")
            ->join("product_sizes", "product_sizes.id", "=", "order_details.size_id")
            ->join("sizes", "sizes.id", "=", "product_sizes.size_id");
    }

    public function order_detail_new()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id', 'id');
    }

    public function order_details_child()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id', 'id')
            ->select(["order_details.*", "product_sizes.*", "order_details.quantity as quantity"])
            ->join("products", "products.id", "=", "order_details.product_id")
            ->join("product_sizes", "product_sizes.id", "=", "order_details.size_id")
            ->join("sizes", "sizes.id", "=", "product_sizes.size_id")
            ->where("products.parent_id", ">", 0);
    }

    public function order_details()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id', 'id')
            ->select(["order_details.*", "product_sizes.*", "order_details.quantity as quantity", "order_details.id as odd"])
            ->join("products", "products.id", "=", "order_details.product_id")
            ->join("product_sizes", "product_sizes.id", "=", "order_details.size_id")
            ->join("sizes", "sizes.id", "=", "product_sizes.size_id")
            ->where("products.parent_id", 0);
    }

    public function allorder_details()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id', 'id')
            ->select(["order_details.*", "product_sizes.*", "order_details.quantity as quantity", 'order_details.id as odd'])
            ->join("products", "products.id", "=", "order_details.product_id")
            ->join("product_sizes", "product_sizes.id", "=", "order_details.size_id")
            ->join("sizes", "sizes.id", "=", "product_sizes.size_id");
    }

    public function details()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id', 'id')
            ->select(["order_details.*", "product_sizes.*", "order_details.quantity as quantity", 'order_details.id as odd', 'products.product_name', 'products.parent_id'])
            ->join("products", "products.id", "=", "order_details.product_id")
            ->join("product_sizes", "product_sizes.id", "=", "order_details.size_id")
            ->join("sizes", "sizes.id", "=", "product_sizes.size_id");
    }

    public function shipping_addresses()
    {
        return $this->hasOne('App\Models\ShippingAddresses', 'order_id', 'id');
    }
}
