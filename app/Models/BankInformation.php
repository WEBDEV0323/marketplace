<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankInformation extends Model
{
    use HasFactory;

    protected $table = 'banking_information';
    protected $fillable = [
        'vendor_id',
        'order_id',
        'card_number',
        'expire_year',
        'expire_month',
        'CCV',
        'type',
        'flags'
    ];

    
}
