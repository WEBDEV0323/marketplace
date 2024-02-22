<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded=[];
    use HasFactory;

   
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


    
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
   
  

}