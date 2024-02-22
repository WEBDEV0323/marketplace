<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;
use Auth;
use App\Models\Wishlist;
use App\Models\ProductCompayr;

class WishlistController extends Controller
{
    public function wishlist(Request $request){
        //$set_cookies = \Cookie::get('wishlist_item');
        
        $log=route('login.login');
        

        if(!Auth::check()){
            echo json_encode(['error'=>'User must be logged in. Click <a href="'.$log.'" style="color:#00A9EC !important;" > here </a> to sign in.','status'=>'login']);
        }else{


            if(isset($request->size))
            {

                $user_id = Auth::id();
                $check_user = Wishlist::where('user_id',$user_id)
                ->where('product_id',$request->product_id)
                ->where("size_id",$request->size)
                ->first();
                if($check_user){
                    $check_user->product_id = $request->product_id;
                    $check_user->save();


                    $wishlist=Wishlist::where("id",$check_user->id)->delete();


                    echo json_encode(['error'=>'Item deleted from wishlist','status'=>'deleted']);
                }
                else if($user_id){
                    $check_user =  new Wishlist();
                    $check_user->user_id = $user_id;
                    $check_user->product_id = $request->product_id;
                $check_user->size_id = $request->size;
                    if($check_user->save()){
                        echo json_encode(['message'=>'Added Item In Wishlist','wishlist_items'=>5,'status'=>'added']);
                    }
                }else{
                    
                    $user_id = Auth::id();
                    
                    $wishlist =  new Wishlist();
                    $wishlist->user_id = $user_id;
                    $wishlist->product_id = $request->product_id;
                    if($wishlist->save()){
                        echo json_encode(['message'=>'Added Item In Wishlist','wishlist_items'=>5,'status'=>'added']);
                        //echo json_encode(['message'=>'Added Item In Wishlist']);    
                    }
                }
            }
            else
            {

                echo json_encode(['error'=>'Please select size','status'=>'login']);


            }    
        }
        
        

    }



    public function wishlists(Request $request){
        if(!Auth::check()){
            $log=route('login.login');
            echo json_encode(['error'=>'User must be logged in. Click <a href="'.$log.'" style="color:#00A9EC !important;" > here </a> to sign in.',"value"=>0]);
        }else{
            $user_id = Auth::id();
            $check_user = Wishlist::where('user_id',$user_id)
            ->where('product_id',$request->product_id)
            ->where("size_id",$request->size)
            ->first();
            if($check_user){
                $check_user->product_id = $request->product_id;
                $check_user->save();
                echo json_encode(['error'=>'Already In Wishlist',"value"=>1]);
            }else{
                echo json_encode(['error'=>'Not in the wishlist',"value"=>2]);
                
            }
        }
    }

     public function remove_wishlist(Request $request){
        $delete =  Wishlist::where('user_id',auth()->user()->id)->where('id',$request->wishlist_id)->delete();
        if($delete)
            echo json_encode(['message'=>'deleted']);
    }
    public function addComperProduct(Request $request){           
        $log=route('login.login');       
        if(!Auth::check()){
            echo json_encode(['error'=>'User must be logged in. Click <a href="'.$log.'" style="color:#00A9EC !important;" > here </a> to sign in.','status'=>'login']);
        }else{
            if(isset($request->size))
            {
                $user_id = Auth::id();
                $check_user = ProductCompayr::where('user_id',$user_id)
                            ->where('product_id',$request->product_id)
                            ->where("size_id",$request->size)
                            ->first();
                if(!$check_user){
                    $check_user =  new ProductCompayr();
                    $check_user->user_id = $user_id;
                    $check_user->product_id = $request->product_id;
                    $check_user->size_id = $request->size;
                    $check_user->flags = 1;
                    $check_user->save();
                }
                $data['compareProduct'] = array();
                if (auth()->check()) {
                    $data['compareProduct'] = ProductCompayr::select(["product_compayrs.*", "products.brand_id","products.product_name","products.product_description","products.sku","products.sale_price","products.regular_price","products.feature_image","products.parent_id","products.product_type","sizes.size as size_name","product_sizes.id as variation_id"])
                        ->where('product_compayrs.user_id', auth()->user()->id)
                        ->join("products", "products.id", "=", "product_compayrs.product_id")
                        ->join("sizes", "sizes.id", "=", "product_compayrs.size_id")
                        ->leftJoin("product_sizes",function($join){
                            $join->on("product_sizes.product_id", "=", "product_compayrs.product_id")
                                ->whereNull('product_sizes.deleted_at')
                                ->where('product_sizes.size_id', "=", "product_compayrs.size_id");
                        })
                        ->leftJoin('brands', 'brands.id', '=', 'products.brand_id') 
                        ->where('brands.flags',1)  
                        ->whereNull('product_compayrs.deleted_at')  
                        ->whereNull('products.deleted_at')  
                        ->whereNull('sizes.deleted_at')  
                        ->whereNull('product_sizes.deleted_at')  
                        ->get();
                } 
                $htmlCompare = view('frontend.wishlist.compare_product', $data)->render();
                echo json_encode(['message'=>'Added Item In Compare','status'=>'added','compare_html'=>$htmlCompare]);
            }
            else
            {
                echo json_encode(['error'=>'Please select size','status'=>'login']);
            }    
        }     
     }
     public function RemoveComperProduct(Request $request){
        $log=route('login.login');       
        if(!Auth::check()){
            echo json_encode(['error'=>'User must be logged in. Click <a href="'.$log.'" style="color:#00A9EC !important;" > here </a> to sign in.','status'=>'login']);
        }else{
            if(isset($request->id))
            {
                $user_id = Auth::id();
                $check_user = ProductCompayr::where('id',$request->id)
                            ->where('user_id',$user_id)->first();
                if($check_user){
                    ProductCompayr::where("id",$request->id)->delete();
                }
            }   
        } 

     }

}
