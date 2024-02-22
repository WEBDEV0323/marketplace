<?php

namespace App\Http\Controllers;

use App\Models\BillingAddresses;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ShippingAddresses;
use  Carbon\Carbon;
use App\Models\Tracking;
use PayPal\Api\ShippingAddress;

class OrderController extends Controller
{

    public function orders()
    {
        $data['data'] = Order::select("orders.*", "order_details.*", "products.*", "product_sizes.*", "sizes.*", "orders.created_at as orderCreatedDate", "orders.id as id")
            ->with('user', 'order_detail', 'order_detail.product')
            ->leftjoin("order_details", "order_details.order_id", "=", "orders.id")
            ->leftjoin("products", "products.id", "=", "order_details.product_id")
            ->leftjoin("product_sizes", "product_sizes.id", "=", "order_details.size_id")
            ->join("sizes", "sizes.id", "=", "product_sizes.size_id")
            ->where('orders.paid', 1)
            ->groupBy("orders.id")
            ->orderBy('orders.id', 'DESC')->get();

        foreach ($data['data'] as $i => $d) {

            $order_detail = OrderDetail::where("order_id", $d->id)->get();
            $data["data"][$i]->count = count($order_detail);
            $price = 0;

            foreach ($order_detail as $od) {

                $price = $price + $od->price;
            }

            $data["data"][$i]->final_price = $price;
        }

        return view('admin.order.order-index', $data);
    }

    public function order_delete($id)
    {
        Order::find($id)->delete();

        return redirect()->back()->with('message', 'Order has been Deleted');
    }

    public function admin_orders()
    {

        $data['data'] = Order::select("orders.*", "order_details.*", "products.*", "product_sizes.*", "sizes.*", "orders.id as id")
            ->with('user', 'order_detail', 'order_detail.product')
            ->join("order_details", "order_details.order_id", "=", "orders.id")
            ->join("products", "products.id", "=", "order_details.product_id")
            ->join("product_sizes", "product_sizes.id", "=", "order_details.size_id")
            ->join("sizes", "sizes.id", "=", "product_sizes.size_id")
            ->where(['orders.paid' => 1, "products.parent_id" => 0])
            ->groupBy("orders.id")
            ->orderBy('orders.id', 'DESC')->get();

        foreach ($data['data'] as $i => $d) {
            $order_detail = OrderDetail::where("order_id", $d->id)
                ->join("products", "products.id", "=", "order_details.product_id")
                ->where("products.parent_id", 0)
                ->get();

            $data["data"][$i]->count = count($order_detail);
            $price = (float)0;

            foreach ($order_detail as $od) {
                $price = $price + $od->price;
            }

            $data["data"][$i]->final_price = $price;
        }

        return view('admin.order.admin-orders', $data);
    }

    public function seller_orders()
    {
        $data['data'] = Order::select("orders.*", "order_details.*", "products.*", "product_sizes.*", "sizes.*", "orders.id as id", 'orders.created_at', 'product_sizes.id as var_id')
            ->with('user', 'order_detail', 'order_detail.product')
            ->join("order_details", "order_details.order_id", "=", "orders.id")
            ->join("products", "products.id", "=", "order_details.product_id")
            ->join("product_sizes", "product_sizes.id", "=", "order_details.size_id")
            ->join("sizes", "sizes.id", "=", "product_sizes.size_id")
            ->where('orders.paid', 1)
            ->where('products.parent_id', '>', 0)
            ->groupBy('orders.id')
            ->orderBy('orders.id', 'DESC')->get();

        foreach ($data['data'] as $i => $d) {
            $order_detail = OrderDetail::where("order_details.order_id", $d->id)
                ->join("products", "products.id", "=", "order_details.product_id")
                ->where("products.parent_id", ">", 0)
                ->get();

            $data["data"][$i]->count = count($order_detail);
            $price = (float)0;

            foreach ($order_detail as $od) {
                $price = (float)$price + (float)$od->price;
            }

            $data["data"][$i]->final_price = $price;
        }

        return view('admin.order.seller-orders', $data);
    }

    public function order_detail($id)
    {
        $data['data'] = Order::where('id', $id)->with('user', 'order_detail', 'order_detail.product', 'order_detail.product.product_user', 'order_detail.product.product_parent', 'order_detail.product.brand', 'order_detail.size_detail', "shipping_addresses", "order_detail.product.prod_size_one")->first();
        $data["billing"] = BillingAddresses::where("order_id", $id)->first();
        $data["shipping"] = ShippingAddresses::where("order_id", $id)->first();
        $data["documents"] = Document::where("order_id", $id)->get();

        return view('admin.order.order-detail', $data);
    }

    public function allorder_detail_buyer($id)
    {

        $data['data'] = Order::where('id', $id)->first();
        $data["billing"] = BillingAddresses::where("order_id", $id)->first();
        $data["shipping"] = ShippingAddresses::where("order_id", $id)->first();

        return view('admin.order.allorder-detail-buyer', $data);
    }

    public function order_detail_buyer($id)
    {

        $data['data'] = Order::where('id', $id)->first();
        $data["billing"] = BillingAddresses::where("order_id", $id)->first();
        $data["shipping"] = ShippingAddresses::where("order_id", $id)->first();

        return view('admin.order.order-detail-buyer', $data);
    }


    public function order_status(Request $request)
    {

        if (isset($request->orderStatus) && isset($request->orderId)) {

            $status = $request->orderStatus == 0 ? 1 : 0;
            $order = OrderDetail::where('id', $request->orderId)->update(['refund' => $status]);

            if ($order) {

                return api_success1('success');

            } else {

                return api_error('Something error, kindly contact developer');
            }
        }

        return api_error('You Do Not Have Order ID and Status');
    }

    public function order_tracking(Request $request)
    {

        // print_r($request->all());
        if (isset($request->tracking) && isset($request->orderId)) {
            $order = Order::where('id', $request->orderId)->update(['tracking_number' => $request->tracking]);
            // $tracking=new Tracking;
            // $tracking->orderId=(int) $request->orderId;
            // $tracking->tracking_number=$request->tracking;
            // $tracking->save();
            if ($order) {
                return api_success1('success');

            } else {
                return api_error('Something error, kindly contact developer');
            }
        } else {
            return api_error('You Do Not Have Order ID and Status');
        }
    }

    public function order_commission(Request $request)
    {
        $order = Order::where('id', $request->orderid)->update(['commission_paid' => (int)$request->val]);

        if ($order) {

            return api_success1('success');
        }

        return api_error('Something error, kindly contact developer');
    }

    public function daily_orders()
    {

        $data['data'] = Order::with('user')->whereDate('created_at', Carbon::today())->get();

        return view('admin.order.order-index', $data);
    }
}
