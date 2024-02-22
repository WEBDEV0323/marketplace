<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_items'; // Specify the correct table name

    
  
  	public function carts()
    {
        return $this->hasMany(Cart::class, 'cart_id');
    }
    
   
  
   public function user()
  {
      return $this->belongsTo(User::class, 'user_id');
  }
  
  
  
  
  
     
}
