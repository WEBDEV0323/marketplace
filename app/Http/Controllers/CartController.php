<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;
use Str;
use App\Models\Cart;

use auth;
use Carbon\Carbon;

class CartController extends Controller
{ 
    public function __construct()
    {
        $this->currentDate = Carbon::now()->format('Y-m-d');
    }


     public function store(Request $request)
    {
        $set_cookies = \Cookie::get('cartitem');
        $user_record_found = CartItem::where('cookies_id', $set_cookies)->where('product_id', $request->product_id)->first();

        try {
            if (!empty($request->product_id) && !empty($request->quantity)) {
                $user_id = 0;
                if (auth()->user()) {
                    $user_id = auth()->user()->id;
                }

                $product = Product::where('id', $request->product_id)->where('flags', 1)->where(function ($query) {
                    $query->whereNull('products.expiry_date')
                        ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
                })->first()->toArray();

                //cookie check
                if ($set_cookies) {
                    $user_record_found = CartItem::where('cookies_id', $set_cookies)->where('product_id', $request->product_id)->first();

                    if ($user_record_found) {
                        // Existing product, update logic
                        $result = \Cart::update($user_record_found->row_id, [
                            'name' => $product['product_name'],
                            'qty' => $request->quantity,
                            'price' => $product['sale_price'],
                            'options' => [
                                'image' => $product['image_url'],
                                'size' => $request->size_id,
                            ],
                        ]);

                        if ($result) {
                            return response()->json(['message' => "Product Has Been Updated Successfully", 'result' => Cart::content()]);
                        } else {
                            return response()->json(['error' => "Something Wrong, Try Again"]);
                        }
                    } else {
                        // New product added in cart
                        if (!empty($request->product_id) && !empty($request->quantity)) {
                            $cart = Cart::add([
                                'id' => $product['id'],
                                'name' => $product['product_name'],
                                'qty' => $request->quantity,
                                'price' => $product['sale_price'],
                                'options' => [
                                    'image' => $product['image_url'],
                                    'size' => $request->size_id,
                                ]
                            ]);

                            $cart_items = new CartItem();
                            $cart_items->row_id = $cart->rowId;
                            $cart_items->product_id = $product['id'];
                            $cart_items->cookies_id = $set_cookies;
                            $cart_items->user_id = $user_id;

                            if ($cart_items->save()) {
                                return response()->json(['message' => "Product Has Been Added Successfully", 'result' => Cart::content()]);
                            } else {
                                return response()->json(['error' => "Something Wrong, Try Again"]);
                            }
                        }
                    }
                } else {
                    if (!empty($request->product_id) && !empty($request->quantity)) {
                        // First time added in cart
                        $id = (string) Str::uuid();
                        $cookie_cart_item = \Cookie::queue('cartitem', $id, 36800);

                        $cart = Cart::add([
                            'id' => $product['id'],
                            'name' => $product['product_name'],
                            'qty' => $request->quantity,
                            'price' => $product['sale_price'],
                            'options' => [
                                'image' => $product['image_url'],
                                'size' => $request->size_id,
                            ]
                        ]);

                        $cart_items = new CartItem();
                        $cart_items->row_id = $cart->rowId;
                        $cart_items->product_id = $product['id'];
                        $cart_items->cookies_id = $id;
                        $cart_items->user_id = $user_id;

                        if ($cart_items->save()) {
                            return response()->json(['message' => "Product Has Been Added Successfully", 'result' => Cart::content()]);
                        } else {
                            return response()->json(['error' => "Something Wrong, Try Again"]);
                        }
                    }
                }
            } else {
                return response()->json(['error' => 'Product is not in cart']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Please try again.']);
        }
    }

    public function remove_cart_item(Request $request){
        
        
        if(!empty($request->cart_id)){
          
          
        
          
             $product = Product::find(
              Cart::where('id', $request->cart_id)
                  ->where('user_id', auth()->user()->id)
                  ->first()
                  ->product_id
             );
          
          
      
      		if ($product) {
          
              if($product->sale_price!==null){

                $price = $product->sale_price;

              }else{

                $price = $product->regular_price;

              }
          
          
      		} else {
     
          		$price = 0;
          
            }
          
          
         $quantity  = Cart::where('id',$request->cart_id)->where('user_id',auth::user()->id)->first()->quantity;
          
          
        
            $cartItem = CartItem::where([
              "user_id" => auth()->user()->id,
          ])->first(); 
 
         
          
        
          
           if ($cartItem) {
            CartItem::where([
                "user_id" => auth()->user()->id,
            ])->update([
                'total_price' => $cartItem->total_price - ($quantity * $price)
            ]);
           }

          
          
           
            
          $delete_cart =  Cart::where('id',$request->cart_id)->where('user_id',auth::user()->id)->delete(); 
          
         
          $numberOfItems = Cart::where('user_id', auth()->user()->id)->count();

 
          if ($numberOfItems < 1) {
              // The result is empty
              CartItem::where("user_id", auth()->user()->id)->delete();
          }
            
         
            
           
          
          
         
          
            return  json_encode(['message' =>'Delete item from cart']);

        }
        else
        {

            return json_encode(['error' =>'Some Error in Delete Record, Please Try Again']);

        }
      
      
      }  

        // if(!empty($request->product_id) && !empty($request->row_id)){
        //     $user_record_found =  CartItem::where('product_id',$request->product_id)->where('cookies_id',\Cookie::get('cartitem'))->first();
        //     if($user_record_found){
        //        // $user_record_cart = Cart::remove($user_record_found->row_id);
        //         //$delete_cart =  CartItem::where('product_id',$request->product_id)->where('row_id',$user_record_found->row_id)->delete();
        //         $delete_cart =  Cart::where('id',$request->product_id)->where('user_id',$auth::user()->id)->delete();   

        //           if($delete_cart){
        //             return  json_encode(['message' =>'Delete item from cart']);
        //           }else{
        //             return json_encode(['error' =>'Something Error in Delete Record, Please Try Again']);
        //           }  
        //     }else{
        //         return json_encode(['error' =>'Something Error in Cart, Please Try Again']);
        //     }
        // }else{
        //     return json_encode(['error' =>'No Values, Try Again']);
        // }
  
  
  
  
  
  
  
  
  
  

    public function delete_cart(Request $request)
    {
        $d=$request->id;
        Cart::where("id",$d)->delete();
        return redirect()->back();

    }
  
  
  
  
    public function deleteCartItem(Request $request, $userId, $cartItemId)
{
    // Validate the request if needed
    $request->validate([
        'cartItemId' => 'required|numeric',
    ]);

    // Perform the deletion
    CartItem::where([
        "user_id" => $userId,
        "id" => $request->cartItemId,
    ])->delete();
      
      
    Cart::where([
        "cart_id" => $request->cartItemId,
    ])->delete();  
      

    // You can return a response if needed, e.g., JSON response
    return response()->json(['message' => 'Cart item deleted successfully']);
}


    
  
  
  

}
