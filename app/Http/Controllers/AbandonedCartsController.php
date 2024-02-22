<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use Carbon\Carbon;

class AbandonedCartsController extends Controller
{
    public function index()
    {
        
        $abandonedThreshold = Carbon::now()->subHours(0);

        // Query abandoned carts with associated cart items
     $abandonedCarts = CartItem::where('updated_at', '<', $abandonedThreshold)
    ->with('carts') // Eager load the 'cart' relationship
    ->get();
      
     
      
 

        

         return view('admin.abandonedcarts.abandoned_carts', compact('abandonedCarts'));
      
       
    }
  
  
  
  
    public function abandonedCartDetail(Request $request, $id)
    {
        // Retrieve a specific CartItem by ID
        $cartItem = CartItem::with('carts')->find($id);

        if (!$cartItem) {
            // Handle case where CartItem with given ID is not found
            return response()->json(['error' => 'CartItem not found'], 404);
        }

        return view('admin.abandonedcarts.abandoned_cart_detail', compact('cartItem'));
    }
  
  

        
       

       
    
}
