<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Product;
use Auth;
use Carbon;
class CouponController extends Controller
{
    public function home(){
        $data['coupons'] = Coupon::get();
        return view('admin.coupon.coupon',$data);
    }
    public function coupon_add(){
        return view('admin.coupon.add');  
    }

    public function delete_coupon($id)
    {

       $coupon=Coupon::find($id)->delete();
       return redirect()->back();

    }
    public function edit_coupon($id)
    {
        $coupon=Coupon::where("id",$id)->first();
        return view('admin.coupon.edit',["data"=>$coupon]);

    }
    public function coupon_process(Request $request){
        // dd($request->all());
       
        $check_coupon = Coupon::where('coupon_code',$request->name)->get();
        if(count($check_coupon) > 0){
            return redirect()->back()->with('error', 'You have already add coupon kindly Change your coupon code');
        }
        if(Auth::guard('admin')->check()){
            $added_by = Auth::guard('admin')->user()->id;
        }else{
            $added_by = Auth::user()->id;
        }
        $coupon =  new Coupon();
        $coupon->coupon_code =  htmlspecialchars( $request->name);
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->discount =  htmlspecialchars( $request->discount);   
        $coupon->total_coupon =  htmlspecialchars( $request->total_coupon);
        $coupon->added_by = $added_by;
        $coupon->free_shiping = $request->free_shiping??'no';
        $coupon->addFlag(Coupon::FLAG_ACTIVE);
        if($coupon->save()){
            return redirect()->back()->with('message', 'Coupon Add Success'); 
        }else{
            return redirect()->back()->with('error', 'Try Again'); 
        } 

    }

    public function coupon_user(Request $request){
        //print_r($request->all());
        $coupon = Coupon::where('coupon_code',$request->coupon_code)->first();
        
        if(!$coupon){
            //echo json_encode(['error'=>'Invalid coupon code']);
            return response()->json([
                "data"=>"",
                "flag"=>false,
                "message"=>"Invalid coupon code"   


               ]);

        }else{
            $start_date = $coupon->start_date;
            $end_date = $coupon->end_date;
            $mytime = Carbon\Carbon::now();
            if ($end_date >= $mytime) {
           
            
            // $str = \Cart::subtotal();
            // $newStr = str_replace(',', '', $str); // If you want it to be "185345321"
            // $total = filter_var($newStr, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

            $total=$request->total;
            
            $my_id=auth::user()->id;
            $carts = \App\Models\Cart::select(["products.*","carts.*","product_sizes.sale_price as sale_price_sizes","products.delivery_charges as delivery_charges"])
            ->join("products","products.id","=","carts.product_id")
            ->leftjoin("product_sizes","product_sizes.product_id","=","products.id")
            ->where("user_id",$my_id)
            ->groupBy("carts.id")
            ->get();


            foreach($carts as $i=>$c)
            {

               // if(isset($c->product_name))
                //{

                   // $carts->parent_id;
                    //exit;

                    $carts[$i]->parent="";
                    $p=Product::where("id",$c->parent_id)->first();

                  if(isset($p->product_name))
                  {  
                    $carts[$i]->parent=$p->product_name;
                  }  


                //}

            }

            $data["total"]=$total;
            $data["coupon"]=$request->coupon_code;            
            $data['ship']=$request->ship;
            $data['pro']=$request->pro;
            
            if($coupon->free_shiping=='yes'){
                $data["total"]=number_format((int)$total-(int)$request->ship, 2, '.', '');
                $data['ship']='0.00';
            } 
            $discount = ($coupon->discount / 100) * ($data["total"]);
            $discount=number_format($discount, 2, '.', '');
            $data["discount"]=$discount;

            session()->put('coupon',[
                'name' => $coupon->coupon_code,
                'discount' => $discount,
                'id' => $coupon->id,
            ]);
            
            //echo json_encode(['success'=>'Congratulation You Got Coupon']);
            
            //return view('frontend.checkout.coupon_ajax',compact('data','carts'))->render();
                $view=view('frontend.checkout.coupon_ajax',compact('data','carts'))->render();

                return response()->json([
                 "data"=>$view,
                 "flag"=>true   


                ]);

          } else {

            return response()->json([
                "data"=>"",
                "flag"=>false,
                "message"=>"Discount code has expired"   


               ]);

            //echo json_encode(['error'=>'Coupon code has expired']);
          }
        }
           
    }
    public function coupon_remove(){
        session()->forget('coupon');
        echo json_encode(['remove'=>'Coupon has removed']);
    }
    public function edit_process(Request $request)
    {
        
        $check_coupon = Coupon::where('coupon_code',$request->name)->where('id','!=',$request->id)->get();
        if(count($check_coupon) > 0){
            return redirect()->back()->with('error', 'You have already add coupon kindly Change your coupon code');
        }
        if(Auth::guard('admin')->check()){
            $added_by = Auth::guard('admin')->user()->id;
        }else{
            $added_by = Auth::user()->id;
        }

    
        $coupon =Coupon::find((int)$request->id);
        $coupon->coupon_code =  htmlspecialchars($request->name);
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->discount =  htmlspecialchars( $request->discount);   
        $coupon->total_coupon =  htmlspecialchars( $request->total_coupon);
        $coupon->free_shiping = $request->free_shiping??'no';
        //$coupon->added_by = $added_by;
        $coupon->addFlag(Coupon::FLAG_ACTIVE);
         if($coupon->save()){
             return redirect()->back()->with('message', 'Coupon Add Success'); 
         }else{
             return redirect()->back()->with('error', 'Try Again'); 
         } 


    }
}
