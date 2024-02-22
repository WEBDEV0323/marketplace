<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SizeGuide extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['brand_id','shop_category_id','gender','size_id','guide_size'];
}
