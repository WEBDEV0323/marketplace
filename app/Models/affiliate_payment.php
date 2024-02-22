<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class affiliate_payment extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'payment_month_year',
        'commission',
        'payment_status'
    ];
}
