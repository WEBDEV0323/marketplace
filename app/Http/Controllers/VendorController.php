<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Card;
use App\Models\OrderDetail;
use App\Models\affiliate_payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VendorController extends Controller
{
    //

    public function index(){

      
        $data['data'] = User::where('user_type',1)->where('affiliate_status', '0')->get();
       // return "<pre>".$data['data'];
        return view('admin.vendor.vendor-index',$data);
    }

    public function affiliatesIndex(){
        $data['data'] = User::where('user_type',1)->where('affiliate_status', '1')->get();


        $last12Months = [];
        foreach($data['data'] as $v){
            $id=$v->id;
            for ($i = 0; $i < 12; $i++) {
                $last12Months[] = Carbon::now()->subMonths($i)->format('Y-m');
            }
            $last12Months = array_reverse($last12Months); 
            $totalPrice = $totalCommission = $totalPayoutAmount = 0;
            foreach($last12Months as $dataVal){
                list($searchYear,$searchMonth) = explode('-', $dataVal);
                $monthDataQuantity = OrderDetail::select([
                        DB::raw('YEAR(orders.created_at) as year'),
                        DB::raw('MONTH(orders.created_at) as month'), 
                        DB::raw('(SELECT SUM(orders.total_price) FROM orders WHERE orders.id = order_details.order_id) AS total_price')
                    ])
                    ->join("orders", "orders.id", "=", "order_details.order_id")
                    ->where("order_details.product_owner_id", $id)
                    ->whereMonth('orders.created_at', $searchMonth)
                    ->whereYear('orders.created_at', $searchYear)
                    ->groupBy('year', 'month', 'order_details.order_id')
                    ->get();
                
                $totalPrice += $price = $monthDataQuantity->sum('total_price');
                if($price > 10000 && $price < 20000){
                    $totalCommission += ($price * 2.5) / 100;
                }elseif($price > 20000 && $price < 50000){
                    $totalCommission += ($price * 3) / 100;
                }elseif($price > 50000){
                    $totalCommission += ($price * 5) / 100;
                }elseif($price < 1){
                    $totalCommission += 0;
                }else{
                    $totalCommission += ($price * 2) / 100;
                } 
            } 
            
            $checkPaidStatus = affiliate_payment::where('user_id',$id)
                ->where('payment_status','0')
                ->get();
                
            if($checkPaidStatus!=null){
                $totalPayoutAmount = $totalCommission - $checkPaidStatus->sum('commission');
            }

            $bank_detail = Card::where('user_id', $id)->first();
            $v->selling_paypal_email = $bank_detail->selling_paypal_email ?? "";
            $v->totalPrice = $totalPrice;
            $v->commission = $totalCommission;
            $v->payoutAmount = $totalPayoutAmount;
            // $monthDataQuantity = OrderDetail::select([
            //     DB::raw('(SELECT SUM(orders.total_price) FROM orders WHERE orders.id = order_details.order_id) AS total_price')
            // ])
            // ->join("orders", "orders.id", "=", "order_details.order_id")
            // ->where("order_details.product_owner_id", $id)
            // ->groupBy('order_details.order_id')
            // ->get(); 
            // $totalPrice = $v->totalPrice = $monthDataQuantity->sum('total_price');
            // if($totalPrice > 10000 && $totalPrice < 20000){
            //     $v->commission = ($totalPrice * 2.5) / 100;
            // }elseif($totalPrice > 20000 && $totalPrice < 50000){
            //     $v->commission = ($totalPrice * 3) / 100;
            // }elseif($totalPrice > 50000){
            //     $v->commission = ($totalPrice * 5) / 100;
            // }elseif($totalPrice < 1){
            //     $v->commission = 0;
            // }else{
            //     $v->commission = ($totalPrice * 2) / 100;
            // } 
            // $bank_detail = Card::where('user_id', $id)->first();
            // $v->selling_paypal_email = $bank_detail->selling_paypal_email ?? "";
        } 
        return view('admin.vendor.vendor-index',$data);
    }

    public function payoutAmount(Request $request)
    {
        $checkExist = affiliate_payment::where('user_id',$request->user_id)
                                ->where('payment_month_year',$request->payment_month_year)
                                ->first();
        if($checkExist == null){
            $input = $request->all();
            affiliate_payment::create($input);
        }else{
            affiliate_payment::where('id',$checkExist->id)->update(['payment_status'=>$request->payment_status]);
        }
        return response()->json();
    }
}
