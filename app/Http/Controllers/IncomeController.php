<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\ProductSize;
use App\Models\Finantial;
use App\Models\Setting;
use App\Models\Accounting;
use App\Models\AccountingDetail;
use DB;
use Carbon\Carbon;
use Redirect;

class IncomeController extends Controller
{
    //

    public function income_statement() {

        //$data['data'] = Order::where("status", "processing")->where("paid", 1)->with('user', 'order_detail', 'order_detail.product')->get()->toArray();     
        $data['paid']=Order::where('paid',1)->sum('total_price');
       // $data['expenses']=Order::where('paid',1)->sum('shipping');
        // $data['purchases']=Order::where("paid",1)
        // ->join("order_details","order_details.order_id","=","orders.id")
        // ->sum("order_details.quantity");
        $data['returns_in']=Order::where(['paid'=>1,"status"=>"refunded"])->sum('total_price');
        $data["opening_inventory"]=Accounting::where("title","opening_inventory")->sum("amount");
        $data["purchases"]=Accounting::where("title","purchases")->sum("amount");
        $data["closing_inventory"]=Accounting::where("title","closing_inventory")->sum("amount");
        $data["carrige_in"]=Accounting::where("title","carrige_in")
        ->sum("amount");
        $data["returns_out"]=Accounting::where("title","returns_out")->sum("amount");
        $data["incomes"]=Accounting::where("title","incomes")->sum("amount");
        $data["expenses"]=Accounting::where("title","expenses")->sum("amount");
        $data["total_revenue"]=   $data['paid'];
        $data['returns_in']=$data['returns_in'];
        $data["cost"]=$data["opening_inventory"] + $data['purchases'] +  $data["carrige_in"] -  $data["returns_out"] -  $data["closing_inventory"] ;
        $data["gross_profit"]=$data["total_revenue"]-$data['returns_in']-$data["cost"];
        $data["net_profit"]=$data["gross_profit"] + $data["incomes"] -$data["expenses"];

        $data["all"]=$data["cost"]  + $data["purchases"] + $data["opening_inventory"] + $data["carrige_in"]  -( $data["returns_out"] + $data["closing_inventory"]);

        return view("admin.accounting.income-statement", ["data" => $data ]);
    }

    public function financial_statment() {

        $data["returns_out"]=Accounting::where("title","returns_out")->sum("amount");
        $data["non_current_assets"]=ProductSize::where("quantity","<=",0)->sum("sale_price");
        $data["current_assets"]=ProductSize::where("quantity",">",0)->sum(DB::raw('sale_price * quantity'));
        $data["carrige_in"]=Accounting::where("title","carrige_in")
        ->sum("amount");
        $data["incomes"]=Accounting::where("title","incomes")->sum("amount");
        $data['returns_in']=Order::where(['paid'=>1,"status"=>"refunded"])->sum('total_price');

        $data["non_current_liablities"]=Accounting::where("title","non_current_liablities")->sum("amount");
        $data["opening_inventory"]=Accounting::where("title","opening_inventory")->sum("amount");
      
        
        $data["closing_inventory"]=Accounting::where("title","closing_inventory")->sum("amount");
        

        $data["non_current_assets"]=Accounting::where("title","non_current_assets")->sum("amount");
        $data["current_assets"]=Accounting::where("title","current_assets")->sum("amount");
        $data["current_liablities"]=Accounting::where("title","current_liablities")->sum("amount");
        $data["long_term_liablities"]=Accounting::where("title","long_term_liablities")->sum("amount");
        $data["capital"]=Accounting::where("title","capital")->sum("amount");
        $data["drawings"]=Accounting::where("title","drawings")->sum("amount");
        $data["expenses"]=Accounting::where("title","expenses")->sum("amount");
        $data["purchases"]=Accounting::where("title","purchases")->sum("amount");
        
        $data['total_revenue']=Order::where('paid',1)->sum('total_price');

        $data["cost"]=$data["opening_inventory"] + $data['purchases'] +  $data["carrige_in"] -  $data["returns_out"] -  $data["closing_inventory"] ;
        $data["gross_profit"]=$data["total_revenue"]-$data['returns_in']-$data["cost"];
        $data["net_profit"]=$data["gross_profit"] + $data["incomes"] -$data["expenses"];

    

        $data["value1"]=$data["non_current_assets"] +  $data["current_assets"] - $data["current_liablities"] - $data["non_current_liablities"];
        $data["value2"]=$data["capital"] + $data["net_profit"]  -$data["drawings"];

        

        return view("admin.accounting.statement-of-financial-position",["data"=>$data]);
    }
    public function finantial_form(Request $request)
    {
        $data=$request->all();

     
        $accountings=Accounting::where("title",$data["id"])
        ->get();

       return view('finantial',["val"=>$data["id"],"records"=>$accountings]);
    }
    public function delete_finantial_form(Request $request)
    {
        $data=$request->all();
        


        Accounting::where('accountings.id', $data["id"] )
        ->delete();
        return redirect()->back();
    }
    public function view_finantial_form(Request $request)
    {
        $finantial=Finantial::first();
        return view('finantial_form',["data"=> $finantial,"val"=>$request["val"]]);
    }


    public function finantialEdit(Request $request)
    {
        $data=$request->all();
        $accounting=new Accounting();
        $accounting->name=$data["name"];
        $accounting->amount= (float) $data["amount"];
        $accounting->note=$data["note"];
        $accounting->title=$data["val"];
        $accounting->save();

        $url=url('/').'/dashboard/finantial_form?id='.$accounting->title;
       
        return Redirect::to($url);
          
       

    }


    public function finantialEditall(Request $request)
    {
        

        $data=$request->all();
        
        $accounting= Accounting::find($data["id"]);
        $accounting->name=$data["name"];
        $accounting->amount=$data["amount"];
        $accounting->note=$data["note"];
        $accounting->title=$data["val"];
        $accounting->save();

        $url=url('/').'/dashboard/finantial_form?id='.$accounting->title;
        return Redirect::to($url);
    

    }




    public function edit_finantial_form(Request $request)
    {
        $data=$request->all();
        $finantial=Accounting::where("accountings.id",$data["id"])->first();

       
        return view('admin.accounting.edit',["data"=> $finantial,"val"=>$request["val"]]);
    }
}
