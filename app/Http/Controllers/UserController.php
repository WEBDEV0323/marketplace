<?php

namespace App\Http\Controllers;

use App\Models\BillingAddresses;
use App\Models\Document;
use App\Models\ShippingAddresses;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vendor;
use App\Models\RequestVendor;
use App\Mail\userBecomeVendorRequest;
use App\Mail\userBecomeVendor;
use App\Mail\productListedByVendor;
use App\Models\affiliate_payment;
use App\Models\Brand;
use App\Models\BrandSubscription;
use App\Models\Order;
use App\Models\Product;
use App\Models\VendorProduct;
use App\Models\ShopCategory;
use App\Models\VendorsProductStock;
use App\Models\CategorySize;
use App\Models\Size;
use App\Models\BankInformation;
use App\Models\Wishlist;
use App\Models\UserAddress;
use App\Models\VendorOrderReciept;
use App\Models\ProductFault;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\Setting;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Card;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Stripe;

class UserController extends Controller
{
    //admin can see users
    public function index()
    {
        $data['data'] = User::where('user_type', 2)->get();
        return view('admin.users.user-index', $data);
    }

    //admin can click the button to edit users
    public function view_user($id)
    {
        $monthDataTable = $last12Months = [];
        $rank = 0;
        for ($i = 0; $i < 12; $i++) {
            $last12Months[] = Carbon::now()->subMonths($i)->format('Y-m');
        }
        $last12Months = array_reverse($last12Months);
        foreach ($last12Months as $key => $data) {
            list($searchYear, $searchMonth) = explode('-', $data);
            $monthDataQuantity = OrderDetail::select([
                DB::raw('YEAR(orders.created_at) as year'),
                DB::raw('MONTH(orders.created_at) as month'),
                DB::raw('SUM(order_details.quantity) AS total_quantity'),
                DB::raw('(SELECT SUM(orders.total_price) FROM orders WHERE orders.id = order_details.order_id) AS total_price')
            ])
                ->join("orders", "orders.id", "=", "order_details.order_id")
                ->where("order_details.product_owner_id", $id)
                ->whereMonth('orders.created_at', $searchMonth)
                ->whereYear('orders.created_at', $searchYear)
                ->groupBy('year', 'month', 'order_details.order_id')
                ->get();

            $rankData = OrderDetail::select([
                "order_details.product_owner_id",
                DB::raw('SUM(orders.total_price) As total_price')
            ])
                ->join("orders", "orders.id", "=", "order_details.order_id")
                ->whereMonth('orders.created_at', $searchMonth)
                ->whereYear('orders.created_at', $searchYear)
                ->whereIn('order_details.product_owner_id', function ($query) {
                    $query->select('id')
                        ->from('users')
                        ->where('user_type', 1)
                        ->where('affiliate_status', '1');
                })
                ->groupBy('order_details.product_owner_id')
                ->orderBy('total_price', 'desc')
                ->get();

            foreach ($rankData as $k => $value) {
                if ($value->product_owner_id == $id) {
                    $rank = $k + 1;
                    break;
                }
            }

            $checkPaidStatus = affiliate_payment::where('user_id', $id)
                ->where('payment_month_year', $data)
                ->where('payment_status', '1')
                ->first();

            $totalQuantity = $monthDataQuantity->sum('total_quantity');
            $totalPrice = $monthDataQuantity->sum('total_price');
            $monthDataTable[$key]['total_price'] = $totalPrice;
            $monthDataTable[$key]['rank'] = $rank;
            $monthDataTable[$key]['month_year'] = $data;
            $monthDataTable[$key]['paidStatus'] = $checkPaidStatus != null ? 'checked' : '';
            $monthDataTable[$key]['month'] = Carbon::now()->month($searchMonth)->format('F');
        }
        $dataTableData = array_reverse($monthDataTable);
        $data = User::where('id', $id)->first();
        $bank_detail = Card::where('user_id', $id)->first();
        $payout_email = $bank_detail->selling_paypal_email ?? '';
        return view('admin.users.edit-view', compact('data', 'dataTableData', 'payout_email'));
    }

    public function edit_user($id)
    {
        $monthDataTable = $last12Months = [];
        $rank = 0;
        for ($i = 0; $i < 12; $i++) {
            $last12Months[] = Carbon::now()->subMonths($i)->format('Y-m');
        }
        $last12Months = array_reverse($last12Months);
        foreach ($last12Months as $key => $data) {
            list($searchYear, $searchMonth) = explode('-', $data);
            $monthDataQuantity = OrderDetail::select([
                DB::raw('YEAR(orders.created_at) as year'),
                DB::raw('MONTH(orders.created_at) as month'),
                DB::raw('SUM(order_details.quantity) AS total_quantity'),
                DB::raw('(SELECT SUM(orders.total_price) FROM orders WHERE orders.id = order_details.order_id) AS total_price')
            ])
                ->join("orders", "orders.id", "=", "order_details.order_id")
                ->where("order_details.product_owner_id", $id)
                ->whereMonth('orders.created_at', $searchMonth)
                ->whereYear('orders.created_at', $searchYear)
                ->groupBy('year', 'month', 'order_details.order_id')
                ->get();

            $rankData = OrderDetail::select([
                "order_details.product_owner_id",
                DB::raw('SUM(orders.total_price) As total_price')
            ])
                ->join("orders", "orders.id", "=", "order_details.order_id")
                ->whereMonth('orders.created_at', $searchMonth)
                ->whereYear('orders.created_at', $searchYear)
                ->whereIn('order_details.product_owner_id', function ($query) {
                    $query->select('id')
                        ->from('users')
                        ->where('user_type', 1)
                        ->where('affiliate_status', '1');
                })
                ->groupBy('order_details.product_owner_id')
                ->orderBy('total_price', 'desc')
                ->get();

            foreach ($rankData as $k => $value) {
                if ($value->product_owner_id == $id) {
                    $rank = $k + 1;
                    break;
                }
            }

            $checkPaidStatus = affiliate_payment::where('user_id', $id)
                ->where('payment_month_year', $data)
                ->where('payment_status', '1')
                ->first();

            $totalQuantity = $monthDataQuantity->sum('total_quantity');
            $totalPrice = $monthDataQuantity->sum('total_price');
            $monthDataTable[$key]['total_price'] = $totalPrice;
            $monthDataTable[$key]['rank'] = $rank;
            $monthDataTable[$key]['month_year'] = $data;
            $monthDataTable[$key]['paidStatus'] = $checkPaidStatus != null ? 'checked' : '';
            $monthDataTable[$key]['month'] = Carbon::now()->month($searchMonth)->format('F');
        }
        $dataTableData = array_reverse($monthDataTable);
        $data = User::where('id', $id)->first();
        $bank_detail = Card::where('user_id', $id)->first();
        $payout_email = $bank_detail->selling_paypal_email ?? '';
        return view('admin.users.edit-index', compact('data', 'dataTableData', 'payout_email'));
    }

    // when user will login directly open this page
    public function update_account()
    {
        $data['user'] = User::where('id', auth()->user()->id)->first();
        return view('frontend.user.update-account', $data);
    }
    public function remove_image(Request $request)
    {
        $user = user::find($request->id);
        $user->image_url = "";
        $user->save();

        return redirect()->back();
    }

    //when a user hit the update this code will work
    public function self_update(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        if ($request->currentPassword) {
            $request->validate([

                'password' => [
                    'required',
                    'string',
                ],
                'confirm_password' => 'required|same:password',

            ]);
        }
        $user->first_name = $request->input('first_name', $user->first_name);
        $user->last_name = $request->input('last_name', $user->last_name);
        $user->phone = $request->input('phone', $user->phone);

        //check his pervoius password or we can say current password
        if (\Hash::check($request->currentPassword, $user->password)) {

            $user->password = \Hash::make($request->password);
            $user->save();
        }

        if ($user->save()) {
            return redirect()->back()->with('message', 'Your Information Has Been Updated');
        } else {
            return redirect()->back()->with('error', 'Not Any thing Updated');
        }
    }

    public function imageUpdate(Request $request)
    {
        if (\File::exists($request->image_url)) {
            // $file_name = addFileOrignal($request->image_url, public_path("/storage/user/"));         
            //  $user['image_url'] = $file_name;
            // $artisan_call_to_make_files_public = \Artisan::call("storage:link", []);
            // if ($artisan_call_to_make_files_public) {
            //     DB::rollBack();
            // }

            if (!is_dir(public_path("/storage/user/" . auth()->user()->id))) {
                mkdir(public_path("/storage/user/" . auth()->user()->id), 0777, true);
            }
            // mkdir(storage_path("/storage/user/" . $product->id), 0777, true);
            $file_name = addFile($request->image_url, public_path("/storage/user/" . auth()->user()->id));
            User::where('id', auth()->user()->id)
                ->update(['image_url' => $file_name]);
            //User::query()->where('id','=',auth()->user()->id)->update($user);
        }
        // if(\File::exists($request->image_url))
        // {
        //     $file_name = addFile($request->image_url, storage_path("app/public/brands/" . $brand->id));
        //     $brand->image = $file_name;
        //     $artisan_call_to_make_files_public = \Artisan::call("storage:link", []);
        //     if ($artisan_call_to_make_files_public) {
        //       DB::rollBack();
        //     }
        // }
        //     User::query()->where('id','=',auth()->user()->id)->update($user);
        return redirect()->back();
    }

    //blade become a vendor page
    public function user_request_for_vendor()
    {
        $data['user'] = User::where('id', auth()->user()->id)->first();
        $data['request_become_vendor'] = $useraSeller = RequestVendor::where('user_id', auth()->user()->id)->first();
        if ($useraSeller) {
            if ($useraSeller->flags == 0) {
                return \Redirect::route('sale_your_product');
            }
        }
        return view('frontend.user.become-vendor', $data);
    }

    //process become a vendor process page
    public function request_become_a_vendor_process(Request $request)
    {
        $check_user = RequestVendor::where('user_id', $request->user_id)->first();
        if ($check_user) {
            $check_user->flags = 2;
            $check_user->save();
            Mail::to(config('constants.admin_email'))->send(new userBecomeVendorRequest(auth()->user()));
            return json_encode(['message' => "Your account has not yet been approved to become a seller. When it is, you will receive an email telling you that your account is approved!"]);
            // return json_encode(['error' => "Your account has not yet been approved to become a seller. When it is, you will receive an email telling you that your account is approved! "]);
        } else {
            $request_vendor =  new RequestVendor();
            $request_vendor->request_become_a_vendor = true;
            $request_vendor->user_id = \Auth::user()->id;
            $request_vendor->flags = 2;
            $request_vendor->save();
            Mail::to(config('constants.admin_email'))->send(new userBecomeVendorRequest(auth()->user()));
            return json_encode(['message' => "Your account has not yet been approved to become a seller. When it is, you will receive an email telling you that your account is approved!"]);
        }
    }

    public function show_vendor_requests()
    {
        $data['data'] = RequestVendor::with('users')
            ->where("flags", 2)->get();
        return view('admin.users.show-request-to-be-vendor', $data);
    }

    public function admin_permission_become_a_vendor(Request $request)
    {
        $user_request = RequestVendor::where('id', $request->user_request_id)->first();
        $user_request->flags = $request->userStatus;
        $user_record = User::where('id', $user_request->user_id)->first();
        if ($user_request->flags == 0) {
            $user_record->flags = 1;
            $user_record->user_type = 1;
            $user_record->affiliate_status = '0';
            $user_record->save();

            if ($user_request->save()) {


                $this->send_mail_vendor($user_request->user_id, "Congratulation!! You are become a vendor", 'emails.become-a-vendor');

                echo json_encode(['message' => 'User Become A Vendor Is Active, This User Can Sell thier Product']);
            }
        } else if ($user_request->flags == 1) {
            // $user_request->addFlag(RequestVendor::FLAG_ACTIVE);
            $user_record->flags = 1;
            $user_record->user_type = 2;
            $user_record->affiliate_status = '0';
            $user_record->save();

            if ($user_request->save()) {


                $this->send_mail_vendor($user_request->user_id, "Congratulation!! You are become a vendor", 'emails.become-a-vendor');

                echo json_encode(['message' => 'User Become A Vendor Is Active, This User Can Sell thier Product']);
            }
        } else if ($user_request->flags == 3) {
            $user_record->user_type = 1;
            $user_record->flags = 1;
            $user_record->affiliate_status = '1';
            $user_record->save();

            if ($user_request->save()) {
                $this->send_mail_vendor($user_request->user_id, "Congratulation!! You are become a affiliate", 'emails.become-a-vendor');

                echo json_encode(['message' => 'User Become A Affiliate Is Active, This User Can Sell thier Product']);
            }
        } else {
            $user_record->user_type = 0;
            $user_record->flags = 2;
            $user_record->affiliate_status = '0';
            $user_record->save();
            RequestVendor::where('id', $request->user_request_id)->update(['flags' => 2]);
            if ($user_request->save()) {
                $this->send_mail_vendor($user_request->user_id, "Your request goes to pending", 'emails.become-a-vendor');

                echo json_encode(['message' => 'User Request is pending']);
            }
        }


        //    else{
        //         //$user_request->removeFlag(RequestVendor::FLAG_ACTIVE);
        //         $user_record = User::where('id',$user_request->user_id)->first();
        //         $user_record->user_type = 2;
        //         $user_record->save();
        //         if($user_request->save()){
        //             $this->send_mail_vendor($user_request->user_id,"You are a become a user now",'emails.vendor-become-user');
        //             echo json_encode(['message'=> 'This Seller Become a User Now']);
        //         }
        //    }

    }

    public function send_mail_vendor($user_id, $subject, $view)
    {
        $user_record = User::where('id', $user_id)->first();
        Mail::to($user_record->email)->send(new userBecomeVendor($user_record, $subject, $view));

        if (count(Mail::failures()) > 0) {
            return 'error';
        }
    }

    public function test($data)
    {
        echo '<pre>';
        print_r($data);
        die;
    }

    public function email_test_view()
    {
        return view('emails.order-invoice');
    }

    //user check his orders
    public function user_orders()
    {
        $data['user'] = User::where('id', auth()->user()->id)->first();

        $data['orders'] = Order::select(["orders.*"])
            ->where('user_id', auth()->user()->id)
            ->where("paid", 1)
            ->orderBy("id", 'desc')
            ->with('user', 'details')
            ->paginate(8);
        return view('frontend.user.orders', $data);
    }

    public function user_order_detail($id)
    {

        $data['user'] = User::where('id', auth()->user()->id)->first();
        $data['data'] = Order::where('id', $id)->with('user', 'order_detail', 'order_detail.product', 'order_detail.product.product_parent', 'order_detail.product.brand', 'order_detail.size_detail', 'user.user_address')->first();
        $data["documents"] = Document::where("order_id", $id)->get();
        $data["shipping"] = ShippingAddresses::where("order_id", $id)->first();
        $data["billing"] = BillingAddresses::where("order_id", $id)->first();

        return view('frontend.user.order-detail', $data , compact('id'));
    }

    //user can add address if he wants
    public function edit_address()
    {
        $data['user'] = User::where('id', auth()->user()->id)->first();

        $billing = UserAddress::where(["user_id" => auth()->user()->id, "flags" => 1])->count();
        $shipping = UserAddress::where(["user_id" => auth()->user()->id, "flags" => 2])->count();

        return view('frontend.user.edit-address', ["data" => $data, "billing" => $billing, "shipping" => $shipping]);
    }

    public function get_affiliate()
    {
        if (Auth::user()->user_type == 1 && Auth::user()->affiliate_status == 1) {
            $monthName = $monthDataTable = $monthDataGraph = $last12Months = [];
            $rank = $currentMonth = 0;
            $rankData = OrderDetail::select([
                "order_details.product_owner_id",
                DB::raw('SUM(orders.total_price) As total_price')
            ])
                ->join("orders", "orders.id", "=", "order_details.order_id")
                ->whereMonth('orders.created_at', Carbon::now()->month)
                ->whereYear('orders.created_at', Carbon::now()->year)
                ->whereIn('order_details.product_owner_id', function ($query) {
                    $query->select('id')
                        ->from('users')
                        ->where('user_type', 1)
                        ->where('affiliate_status', '1');
                })
                ->groupBy('order_details.product_owner_id')
                ->orderBy('total_price', 'desc')
                ->get();

            foreach ($rankData as $key => $data) {
                if ($data->product_owner_id == Auth::id()) {
                    $currentMonth = $data->total_price;
                    $rank = $key + 1;
                    break;
                }
            }
            for ($i = 0; $i < 12; $i++) {
                $last12Months[] = Carbon::now()->subMonths($i)->format('Y-m');
            }
            $last12Months = array_reverse($last12Months);
            foreach ($last12Months as $key => $data) {
                list($searchYear, $searchMonth) = explode('-', $data);
                // $monthData =  OrderDetail::select(["orders.total_price",
                //         DB::raw('YEAR(orders.created_at) as year'),
                //         DB::raw('MONTH(orders.created_at) as month')])
                //     ->join("orders", "orders.id", "=", "order_details.order_id")
                //     ->where("order_details.product_owner_id", auth()->user()->id)
                //     ->whereMonth('orders.created_at', $searchMonth)
                //     ->whereYear('orders.created_at', $searchYear)
                //     ->groupBy('year', 'month','order_details.order_id')
                //     ->get();

                // $monthDataQuantity =  OrderDetail::select([
                //         DB::raw('YEAR(orders.created_at) as year'),
                //         DB::raw('MONTH(orders.created_at) as month'), 
                //         DB::raw('SUM(order_details.quantity) As quantity')])
                //     ->join("orders", "orders.id", "=", "order_details.order_id")
                //     ->where("order_details.product_owner_id", auth()->user()->id)
                //     ->whereMonth('orders.created_at', $searchMonth)
                //     ->whereYear('orders.created_at', $searchYear)
                //     ->groupBy('year', 'month')
                //     ->first();

                // if(count($monthData)>0 && $monthDataQuantity){ 
                //     $monthDataTable[$key]['quantity']=  $monthDataQuantity->quantity;
                //     foreach($monthData as $data){
                //         $monthDataTable[$key]['total_price'] += $data->total_price;
                //         $monthDataGraph[$key] += $data->total_price; 
                //     }
                // }
                // $monthName[]= Carbon::now()->month($searchMonth)->format('M');
                // $monthDataTable[$key]['month'] = Carbon::now()->month($searchMonth)->format('F');

                $monthDataQuantity = OrderDetail::select([
                    DB::raw('YEAR(orders.created_at) as year'),
                    DB::raw('MONTH(orders.created_at) as month'),
                    DB::raw('SUM(order_details.quantity) AS total_quantity'),
                    DB::raw('(SELECT SUM(orders.total_price) FROM orders WHERE orders.id = order_details.order_id) AS total_price')
                ])
                    ->join("orders", "orders.id", "=", "order_details.order_id")
                    ->where("order_details.product_owner_id", auth()->user()->id)
                    ->whereMonth('orders.created_at', $searchMonth)
                    ->whereYear('orders.created_at', $searchYear)
                    ->groupBy('year', 'month', 'order_details.order_id')
                    ->get();

                $totalQuantity = $monthDataQuantity->sum('total_quantity');
                $totalPrice = $monthDataQuantity->sum('total_price');
                $monthDataTable[$key]['quantity'] = $totalQuantity;
                $monthDataTable[$key]['total_price'] = $monthDataGraph[$key] =  $totalPrice;
                $monthName[] = Carbon::now()->month($searchMonth)->format('M');
                $monthDataTable[$key]['month'] = Carbon::now()->month($searchMonth)->format('F');
            }
            $dataTableData = array_reverse($monthDataTable);
            return view('frontend.user.get_affiliate', compact('currentMonth', 'dataTableData', 'monthDataGraph', 'monthName', 'rank'));
        }
        return redirect()->route('update_account');
    }

    //user can subscribe the brands
    public function user_subscribe()
    {
        $user_subscribes = BrandSubscription::whereRaw("flags & ? = ?", [BrandSubscription::FLAG_ACTIVE, BrandSubscription::FLAG_ACTIVE])->where('user_id', auth()->user()->id)->with('brand')->pluck('brand_id')->toArray();
        $data['brands'] =  Brand::whereRaw("flags & ? = ?", [Brand::FLAG_ACTIVE, Brand::FLAG_ACTIVE])->whereNotIn('id', $user_subscribes)->orderBy('brand_name', 'ASC')->get();
        $data['user'] = User::where('id', auth()->user()->id)->first();
        $data['user_subscribes'] = BrandSubscription::whereRaw("flags & ? = ?", [BrandSubscription::FLAG_ACTIVE, BrandSubscription::FLAG_ACTIVE])->where('user_id', auth()->user()->id)->with('brand')->get();
        return view('frontend.user.subscribe', $data);
    }

    //user can subscribe the brands
    public function user_subscribe_process(Request $request)
    {
        //$check =  BrandSubscription::where('user_id',auth()->user()->id)->where('brand_id',$request->brand_id)->first();
        $subscribe = new BrandSubscription();
        $subscribe->user_id = auth()->user()->id;
        $subscribe->brand_id = $request->brand_id;
        $subscribe->addFlag(BrandSubscription::FLAG_ACTIVE);
        if ($subscribe->save()) {
            echo json_encode(['message' => 'yes']);
        }
    }

    public function user_unsubscribe_process(Request $request)
    {
        $check =  BrandSubscription::where('user_id', auth()->user()->id)->where('brand_id', $request->brand_id)->delete();
        if ($check) {
            echo json_encode(['message' => 'yes']);
        }
    }

    public function user_notification_process(Request $request)
    {
        $check =  User::where('id', auth()->user()->id)->update([
            'newsletter_notification_status' => $request->newsletter_notification,
            'promotions_notification_status' => $request->promotions_notification,
            'discounts_notification_status' => $request->discounts_notification
        ]);
        if ($check) {
            echo json_encode(['message' => 'yes']);
        }
    }

    //user can bank detail
    public function bank_detail()
    {

        $data['details'] = Card::where('user_id', auth()->user()->id)->first();
        return view('frontend.user.bank-detail', $data);
    }

    //user can billing address
    public function sale_your_product(Request $request)
    {
        // By bbt developer pass SKU  
        $sku = $request->sku;
        $data['user'] = User::where('id', auth()->user()->id)->first();
        $getUserDetails = Card::where('user_id', auth()->user()->id)->first();
        $bank_and_paypal_email = "Yes";
        if (!$getUserDetails) {
            $bank_and_paypal_email = "No";
        } else {
            if ($getUserDetails->selling_card_no == "" || $getUserDetails->selling_paypal_email == "") {
                $bank_and_paypal_email = "No";
            }
        }
        if ($bank_and_paypal_email == "No") {
            return \Redirect::route('bank_detail')->with('selling_before_add_bank_details', 'You must fill this part out before you can sell a product.');
        }
        if($sku == null){
            $sku = '';
        }
        return view('frontend.user.user-sell-its-products', $data  , compact('sku'));
    }

    public function add_seller_product(Request $request)
    {
        $check_product = Product::where('sku', $request->sku)->first();

        $delivery_charges = 0;
        $charges = Setting::where("key", "fixed_shipping")->first();
        $commission = Setting::where("key", "commission")->first();
        $commission = json_decode($commission->value);
        if (isset($charges->value)) {

            //$val=json_decode($charges->value);
            $val = preg_replace('/[^0-9.]/', '', $charges->value);

            $delivery_charges = (int) $val;
        }
        $product_type = 1;

        if (strlen($request->product_type) > 0) {

            $product_type = $request->product_type;
        }

        if (!empty($check_product)) {
            $vendor_id = auth()->user()->id;
            $product = new Product();

            $setting = Setting::where('key', 'fixed_shipping')->first();
            $fixed_shiffting_price = $setting->value;
            $product->shop_category_id =  $check_product->shop_category_id;
            $product->gender =  $check_product->gender;
            $total_price = $request->price;
            $parsentage_price  = ($total_price * $commission) / 100;

            $payout = ($total_price - $parsentage_price - json_decode($fixed_shiffting_price));

            $product->delivery_charges = $delivery_charges;
            $product->brand_id = $check_product->brand_id; // 
            $product->product_description = $check_product->product_description;
            $product->feature_image = $check_product->feature_image;

            $product->vendor_id = $vendor_id;
            $product->product_name = (isset($request->product_name) ? $request->product_name : $check_product->product_name);
            $product->product_type = $product_type;
            $product->condition = $request->condition;
            $product->parent_id =  $check_product->id;
            $product->sale_price = $payout;
            $product->regular_price = $total_price;
          	$product->shipping_payer = $request->input('shipping_payer');
            if (!$request->has('draft')) {
                $product->flags = 1;
            }

            $product->save();

            $product->expiry_date = $product->created_at->addDays(config('constants.seller.default_product_listing_days'));
            $product->save();

            if (\File::exists($request->feature_image)) {
                if (!is_dir(storage_path("app/public/seller-product/"))) {
                    mkdir(storage_path("app/public/seller-product/"), 0777, true);
                }
                mkdir(storage_path("app/public/seller-product/" . $product->id), 0777, true);
                $file_name = ProductaddFile($request->feature_image, storage_path("app/public/seller-product/" . $product->id));
                $product->feature_image = $file_name;
                $product->save();
            }

            if ($request->draft == 'draft') {
                $product->addFlag(Product::FLAG_DRAFT);
            }
            if ($product->save()) {
                if (isset($request->product['faults']) && $request->product['faults'] != null) {
                    $product->addFlag(Product::FLAG_FAULT);
                    //  $this->test($request->product['faults']);
                    foreach ($request->product['faults'] as $faults) {
                        $product_faults = new ProductFault();
                        $product_faults->product_id = $product->id;
                        $product_faults->user_id = auth()->user()->id;
                        $product_faults->fault = $faults;
                        $product_faults->save();
                    }
                }

                if ($request->size_id) {
                    $save = false;
                    $product_size = new ProductSize();
                    $product_size->size_id = $request->size_id;
                    $product_size->quantity = 1;
                    $product_size->product_id = $product->id;
                    $product_size->regular_price = $total_price;
                    $product_size->sale_price = $payout;

                    $product_size->addFlag(ProductSize::FLAG_ACTIVE);
                    $save =  $product_size->save();
                }


                if (is_array($request->multi_images)) {
                    $save = false;
                    foreach ($request->multi_images as $image) {
                        $save_path = storage_path("app/public/seller-product/" . $product->id);
                        if (!file_exists($save_path)) {
                            mkdir($save_path, 666, true);
                        }
                        $product_image = new ProductImage();
                        $product_image->image = ProductaddFile($image, storage_path("app/public/seller-product/" . $product->id));
                        $product_image->product_id = $product->id;
                        $save =  $product_image->save();
                    }
                }

                if ($product->save()) {
                    Mail::to(config('constants.admin_email'))->send(new productListedByVendor(auth()->user(), $product));
                    return \Redirect::back()->with(["message" => "Product added successfully"]);
                }
            }
        } else
            return \Redirect::back()->with('error', 'SKU does not match with any of our products. Please try again');
    }

    public function delete_product($id)
    {

        $vendor_product = VendorProduct::where('id', $id)->with('product')->first();
        $product = Product::where('id', $vendor_product->product_id)->first();

        if ($vendor_product->flags == 1) {
            $quantity_product = $product->quantity - $vendor_product->quantity;
            $product->quantity = $quantity_product;
            $product->save();
        }
        if ($vendor_product->delete()) {
            return \Redirect::back()->with(["message" => " Deleted Successfully "]);
        }
    }

    public function products()
    {
        $data['user'] = User::where('id', auth()->user()->id)->first();
        return view('frontend.user.products', $data);
    }

    //from admin can change the image of users
    public function user_image(Request $request)
    {
        // print_r($request->all());
        $user = User::where('id', $request->id)->first();
        if (\File::exists($request->image)) {

            $file_name = addFile($request->image, storage_path("app/public/user/" . $user->id));

            $user->image_url = $file_name;
            $user->save();
            return \Redirect::back()->with('message', 'Image Changed Successful !');
        } else {
            return \Redirect::back()->with('error', 'Operation Fail !');
        }
    }

    public function edit_process_image(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if ($request->image == null) {

            //$file_name = addFile($request->image, storage_path("app/public/user/" . $request->id));
            $user->image_url = "";
            $user->save();

            return \Redirect::back()->with('message', 'Image Removed Successful !');
        }
        if (isset($request->image)) {




            if (\File::exists($request->image)) {



                storage::makeDirectory("public/user/" . $request->id, 0755, true, true);

                $file_name = addFile($request->image, storage_path("app/public/user/" . $request->id));
                $user->image_url = $file_name;
                $user->save();
                return \Redirect::back()->with('message', 'Image Changed Successful !');
            }
        }
    }

    //edit process from the admin dashboard
    public function edit_process(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->first_name = $request->input('first_name', $user->first_name);
        $user->last_name = $request->input('last_name', $user->last_name);
        $user->gender = $request->input('gender', $user->gender);
        $user->phone = $request->input('phone', $user->phone);
        if ($request->status != "3") {
            $user->user_type = $request->status;
            $user->affiliate_status = '0';
            $user->coupon_code = null;
            $user->tier_type = null;
        } else {
            $user->user_type = 1;
            $user->affiliate_status = '1';
            $user->coupon_code = $request->coupon_code ?? null;
            $user->tier_type = $request->commission_setting;
        }
        if ($request->status == 0) {
            $user->flags = 2;
            RequestVendor::where('user_id', $request->id)->update(['flags' => 2]);
        } else {
            $user->flags = 1;
        }
        //$user->removeFlag(User::FLAG_ACTIVE);
        // if($request->status == 1) {
        //     $user->addFlag(User::FLAG_ACTIVE);
        // }

        // if($request->user_type == 1){
        //     $user->user_type = 1;
        // }else{
        //     $user->user_type = 2;
        // }

        // elseif(isset($request->image1))
        // {

        storage::makeDirectory("public/user/" . $request->id, 0755, true, true);

        if (\File::exists($request->image)) {

            $file_name = addFile($request->image, storage_path("app/public/user/" . $request->id));
            echo $file_name;


            $user->image_url = $file_name;
            $user->save();
            //return \Redirect::back()->with('message','Image Changed Successful !');
        }

        // }
        if ($request->status == "3") {
            if (isset($request->month_year)) {
                foreach ($request->month_year as $k => $v) {
                    $checkExist = affiliate_payment::where('user_id', $request->id)
                        ->where('payment_month_year', $v)
                        ->first();
                    if (isset($request->commission_paid[$k])) {
                        if ($checkExist == null) {
                            affiliate_payment::create([
                                'user_id' => $request->id,
                                'commission' => $request->commission[$k],
                                'payment_month_year' => $v,
                                'payment_status' => '1'
                            ]);
                        } else {
                            affiliate_payment::where('id', $checkExist->id)->update([
                                'payment_status' => '1',
                                'commission' => $request->commission[$k]
                            ]);
                        }
                    }
                    if (!isset($request->commission_paid[$k]) && $checkExist != null) {
                        affiliate_payment::where('id', $checkExist->id)->update([
                            'payment_status' => '0',
                            'commission' => $request->commission[$k]
                        ]);
                    }
                }
            }
        }

        if ($user->save()) {
            $message = "User Updated Successfully";
        }
        return back()->with(['message' => $message]);
    }

    public function delete_user($id)
    {


        //BankInformation::where('vendor_id',$id->id)->delete();
        //BrandSubscription::where('user_id',$id->id)->delete();
        //Product::where('vendor_id',$id->id)->delete();
        //Wishlist::where('user_id',$id->id)->delete();
        //UserAddress::where('user_id',$id->id)->delete();
        //RequestVendor::where('user_id',$id->id)->delete();

        //$id->delete();
        User::where('id', $id)->delete();
        return \Redirect::back()->with('message', 'User Has been Deleted');
    }

    public function add_user(Request $request)
    {
        $param = $request->all();
        if ($param == null) {
            $param['user'] = 'user';
        }
        return view('admin.users.add-users', ["data" => $param['user']]);
    }

    public function add_process(Request $request)
    {
        echo '<pre>';
        print_r($request->all());
    }

    public function seller_sells()
    {
        $data['data'] = VendorProduct::with('user', 'vendor_stock', 'brand', 'product', 'category')->get();
        return view('admin.users.seller-sells', $data);
    }

    public function vendor_amount_paid($id)
    {
        $data['data'] = VendorProduct::where('id', $id)->with('user', 'vendor_stock', 'brand', 'product', 'category')->first();
        return view('admin.users.admin-paid-amount', $data);
    }

    public function admin_paid_amount(Request $request)
    {
        $paid_price = $request->pay;

        if ($paid_price > 0) {
            $id =  $request->vendor_product_id;
            $check_vendor_product = VendorProduct::where('id', $id)->with('user', 'vendor_stock', 'brand', 'product', 'category')->first();

            if ($paid_price > $check_vendor_product->price) {
                return \Redirect::back()->with('error', 'Your Price is greater than Seller Price');
            } else {

                if ($paid_price <= $check_vendor_product->price) {

                    $due_amount = $check_vendor_product->price - $paid_price;
                    $vendor_reciept  = new VendorOrderReciept();
                    $vendor_reciept->vendor_id = $check_vendor_product->vendor_id;
                    $vendor_reciept->vendor_product_id =  $id;
                    $vendor_reciept->paid_amount =  $paid_price;
                    $vendor_reciept->due_amount =  $due_amount;
                    $vendor_reciept->save();
                    $check_vendor_product->price = $check_vendor_product->price - $paid_price;
                    if ($check_vendor_product->save())
                        return \Redirect::back()->with('message', 'Your amount has been added');
                }
            }
        } else {
            return \Redirect::back()->with('error', 'Amount Will be Greater than Zero');
        }
    }

    public function admin_paid_reports()
    {
        $data['data'] = VendorOrderReciept::with('vendor_product', 'vendor_product.product', 'vendor_product.user')->get();
        //$this->test($data['data']);
        return view('admin.users.paid-reports', $data);
    }

    public function seller_sold_item()
    {
        $data['user'] = User::where('id', auth()->user()->id)->first();
        $data['vendor_products'] = Order::select(["products.*", "orders.created_at as order_date", "order_details.price as selling_price", "orders.status as status", "sizes.size"])
            ->join("order_details", "order_details.order_id", "=", "orders.id")
            ->join("products", "products.id", "=", "order_details.product_id")
            ->leftjoin("product_sizes", "product_sizes.id", "order_details.size_id")
            ->leftjoin("sizes", "sizes.id", "product_sizes.size_id")
            ->where("products.vendor_id", auth()->user()->id)
            ->groupBy("order_details.id")
            ->orderBy("id", 'desc')
            ->get();

        foreach ($data['vendor_products'] as $i => $product) {

            if (strlen($product->product_name) > 0) {
            } else {
                if ((int)$product->parent_id > 0) {

                    $data1 = Product::where('id', $product->parent_id)->first();

                    if (isset($data1->product_name)) {

                        $data['vendor_products'][$i]->product_name = $data1->product_name;
                    }
                }
            }
        }



        $id = Auth::user()->id;

        $data['count'] = Product::where('vendor_id', $id)->count();









        $data['user'] = User::where('id', auth()->user()->id)->first();
        //$data['vendor_products'] = VendorProduct::where('vendor_id',auth()->user()->id)->with('brand','category','product','user','vendor_stock')->get();

        return view('frontend.user.sold-items', $data);
    }

    public function details_vendor_product(Request $request)
    {
        $data['user'] = User::where('id', auth()->user()->id)->first();
        $data['vendor_products'] = VendorOrderReciept::where('vendor_id', auth()->user()->id)->with('vendor_product', 'vendor_product.brand', 'vendor_product.category', 'vendor_product.product', 'vendor_product.user', 'vendor_product.vendor_stock')->get();
        return view('frontend.user.detail-vendor-product', $data);
    }

    public function size_ajax(Request $request)
    {
        if ($request->flags == 1) {
            $data['cat_name'] = ShopCategory::where('parent_id', $request->category_id)->get();
            $data['flags'] = $request->flags;
        }
        if ($request->flags == 2) {
            $data['cat_name'] = ShopCategory::where('id', $request->category_id)->first();
            $data['sizes'] = CategorySize::where('category_id', $request->category_id)->with('size')->get();
            $data['flags'] = $request->flags;
        }
        if ($request->flags == 3) {

            delete_size_not_exits();
            $getProduct_sizes = Product::where('products.sku', $request->sku)->first();
            if ($getProduct_sizes) {
                $getAllExitSize =  Size::where('brand_id', $getProduct_sizes->brand_id)->where('shop_category_id', $getProduct_sizes->shop_category_id)->where('gender', $getProduct_sizes->gender)->pluck('id');
                ProductSize::whereNotIn('size_id', $getAllExitSize)->where('product_id', $getProduct_sizes->id)->delete();
            }

            //where('id', $request->product_id)->
            $product = Product::select('products.*')->where('products.sku', $request->sku)->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags', 1)->first();
            if ($product) {
                //////$data['sizes'] = CategorySize::where('category_id', $product->shop_category_id)->with('size')->get();
                // new code
                $data['flags'] = 3;
                // $data['sizes'] = Size::where('brand_id',$product->brand_id)->where('shop_category_id', '=', $product->shop_category_id)->where('gender','=',$product->gender)->get();
                $data['sizes'] = ProductSize::select('product_sizes.size_id', 'sizes.size')->where('product_id', $product->id)
                    ->leftJoin('sizes', 'sizes.id', '=', 'product_sizes.size_id')
                    ->get();
                // new code
            } else {
                return response()->json(['message' => 'SKU does not match with any of our products. Please try again']);
            }
        }

        // dd($data['sizes']);
        return view('frontend.user.size-ajax', $data)->render();
    }

    public function size_list_ajax(Request $request)
    {
        $product = Product::select('products.*')->where('products.sku', $request->sku)->leftJoin('brands', 'brands.id', '=', 'products.brand_id')->where('brands.flags', 1)->first();
        $product_name = "";
        if ($product) {
            if ($product->product_name != "") {
                $product_name = $product->product_name;
            }
        }
        return response()->json(['message' => '', 'product_name' => $product_name]);
    }

    public function shipping(Request $request)
    {

        $product = Product::select(["shop_categories.shipping"])
            ->join("shop_categories", "shop_categories.id", "=", "products.shop_category_id")
            ->where('products.sku', $request->sku)->first();
        echo json_encode($product);
    }

    //user billing address
    public function billing_address()
    {
        $data['user'] = User::where(['id' => auth()->user()->id, "flags" => 1])->first();
        $data['user_address'] = UserAddress::where('user_id', auth()->user()->id)->first();
        return view('frontend.user.billing-address', $data);
    }

    public function billing_address_process(Request $request)
    {
        $check_user_address =  UserAddress::where('user_id', $request->user_id)->first();
        if ($check_user_address) {
            $user_address = $check_user_address;
        } else {
            $user_address = new UserAddress();
        }
        $user_address->firstname = $request->fName;
        $user_address->lastname = $request->lName;
        $user_address->company = $request->companyName;
        $user_address->street_address = $request->streetAddres;
        $user_address->appartment_address = $request->appartmentSuit;
        $user_address->city = $request->city;
        $user_address->country = $request->country;
        $user_address->pastcode = $request->postCode;
        $user_address->phone = $request->phone;
        $user_address->email = $request->email;
        $user_address->user_id = auth()->user()->id;
        $user_address->flags = 1;
        //$user_address->addFlag(UserAddress::FLAG_BILLING_ADDRESS);
        //$user_address->addFlag(UserAddress::FLAG_ACTIVE);
        if ($user_address->save()) {
            return redirect()->back()->with('message', 'User Billing Address Added Successfully');
        } else {
            return redirect()->back()->with('error', 'Something Error, Please Try Again');
        }
    }

    //user can Shipping address
    public function shipping_address()
    {
        $data['user'] = User::where('id', auth()->user()->id)->first();
        $data['user_address'] = UserAddress::whereRaw("flags & ? = ?", [UserAddress::FLAG_SHIPPING_ADDRESS, UserAddress::FLAG_SHIPPING_ADDRESS])->where('user_id', auth()->user()->id)->first();
        return view('frontend.user.shipping-address', $data);
    }

    public function shipping_address_process(Request $request)
    {

        $check_user_address =  UserAddress::whereRaw("flags & ? = ?", [UserAddress::FLAG_SHIPPING_ADDRESS, UserAddress::FLAG_SHIPPING_ADDRESS])->where('user_id', $request->user_id)->first();
        if ($check_user_address) {
            $user_address = $check_user_address;
        } else {
            $user_address = new UserAddress();
        }
        $user_address->firstname = $request->fName;
        $user_address->lastname = $request->lName;
        $user_address->company = $request->companyName;
        $user_address->street_address = $request->streetAddres;
        $user_address->appartment_address = $request->appartmentSuit;
        $user_address->city = $request->city;
        $user_address->country = $request->country;
        $user_address->pastcode = $request->postCode;
        $user_address->phone = $request->phone;
        $user_address->email = $request->email;
        $user_address->user_id = auth()->user()->id;
        $user_address->flags = 2;
        // $user_address->addFlag(UserAddress::FLAG_SHIPPING_ADDRESS);
        // $user_address->addFlag(UserAddress::FLAG_ACTIVE);
        if ($user_address->save()) {
            return redirect()->back()->with('message', 'User Shipping Address Added Successfully');
        }

        return redirect()->back()->with('error', 'Something Error, Please Try Again');
    }

    public function card(Request $request)
    {
        $request->validate([
            'buying_card_no' => 'numeric|digits:16',
            'buying_expiry_year' => 'numeric|digits:2',
            'selling_card_no' => 'numeric|digits:16',
            'selling_expiry_year' => 'numeric|digits:2',
        ]);

        $user_id = Auth::user()->id;
        $paypal = $request->selling_paypal_email ?? '';

        Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        // Stripe\Stripe::setApiKey('sk_test_51JFfTBBSH6f3eK6wQE3aWZn9CQ6NBsLXEEDmvOzIhqRFWBJSITOYOLRfKeOd2SUnALJhtr54DZHOvTapcNzkGiLb009Nk0LAje');
        
        // $sellingCardData = null;
        // if ($request->selling_card_no != null) {
        //     try {
        //         $sellingCardDetails = Stripe\PaymentMethod::create([
        //             'type' => 'card',
        //             'card' => [
        //                 'number' => $request->selling_card_no,
        //                 'exp_month' => $request->selling_expiry_month ?? 01,
        //                 'exp_year' => $request->selling_expiry_year ?? 20,
        //                 'cvc' => $request->selling_cvc ?? 123,
        //             ],
        //         ]);
        //         $sellingCardData  = $sellingCardDetails->toArray();
        //     } catch (\Exception $e) {
        //         return redirect()->back()->with(['message' => 'Selling details, ' . $e->getMessage()]);
        //     }
        // }

        $card = Card::where("user_id", $user_id)->get();

        if (count($card) > 0) {
            $data = Card::find($card[0]->id);
        } else {
            $data = new Card;
        }

        $data->user_id = $user_id;
        $data->buying_card_no = $request->buying_card_no;
        $data->buying_expiry_year = $request->buying_expiry_year;
        $data->buying_expiry_month = $request->buying_expiry_month;
        $data->buying_cvc = $request->buying_cvc;

        $data->selling_card_no = $request->selling_card_no;
        $data->selling_expiry_year = $request->selling_expiry_year;
        $data->selling_expiry_month = $request->selling_expiry_month;
        $data->selling_cvc = $request->selling_cvc;
        $data->selling_paypal_email = $paypal;
        $data->save();
        return redirect()->back()->with(['message' => 'Card updated successfully!']);
    }

    public function seller_edit(Request $request)
    {
        $data = $request->all();


        $product = ProductSize::where("id", $data["id"])->first();

        $sizes = ProductSize::find($data["id"]);
        $sizes->sale_price = $data["sale_price"];
        $sizes->save();
        if (isset($request->image)) {
            if (\File::exists($request->image)) {

                if (!is_dir(storage_path("app/public/seller-product/" . $product->product_id))) {
                    mkdir(storage_path("app/public/seller-product/" . $product->product_id), 0777, true);
                }
                // mkdir(storage_path("app/public/seller-product/" . $product->id), 0777, true);
                $file_name = addFile($request->image, storage_path("app/public/seller-product/" . $product->product_id));
                Product::where('id', $product->product_id)
                    ->update(['feature_image' => $file_name]);

                return \Redirect::back()->with('message', 'Product updated successfully!');
            }
        }

        Product::where('id', $product->product_id)
            ->update(['flags' => $request["status"]]);

        return \Redirect::back()->with('message', 'Product updated successfully!');
    }


    /**
     * buyingDetails
     */
    public function buyingDetails(Request $request)
    {
        $request->validate([
            'buying_card_no' => 'numeric|digits:16',
            'buying_expiry_year' => 'numeric|digits:2',
        ]);

        Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $buyingCard = Stripe\PaymentMethod::create([
                'type' => 'card',
                'card' => [
                    'number' => $request->buying_card_no,
                    'exp_month' => $request->buying_expiry_month,
                    'exp_year' => $request->buying_expiry_year,
                    'cvc' => $request->buying_cvc,
                ],
            ]);

            $buyingCardData  = $buyingCard->toArray();
            $card = Card::where("user_id", Auth::user()->id)->get();

            if (count($card) > 0) {
                $data = Card::find($card[0]->id);
            } else {
                $data = new Card;
            }

            $data->user_id = Auth::user()->id;
            $data->buying_card_no = $request->buying_card_no;
            $data->buying_expiry_month = $request->buying_expiry_month;
            $data->buying_expiry_year = $request->buying_expiry_year;
            $data->buying_cvc = $request->buying_cvc;
            $data->save();

            return redirect()->back()->with(['message' => 'buying details are updated successfully!']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }

    /**
     * sellingDetails
     */
    public function sellingDetails(Request $request)
    {
        $request->validate([
            'selling_card_no' => 'numeric|digits:16',
            'selling_expiry_year'  => 'numeric|digits:2',
            'selling_paypal_email' => 'required|email',
        ]);

        Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $sellingCard = Stripe\PaymentMethod::create([
                'type' => 'card',
                'card' => [
                    'number' => $request->selling_card_no,
                    'exp_month' => $request->selling_expiry_month,
                    'exp_year' => $request->selling_expiry_year,
                    'cvc' => $request->selling_cvc,
                ],
            ]);

            $sellingCardData  = $sellingCard->toArray();
            $card = Card::where("user_id", Auth::user()->id)->get();

            if (count($card) > 0) {
                $data = Card::find($card[0]->id);
            } else {
                $data = new Card;
            }

            $data->user_id = Auth::user()->id;
            $data->selling_card_no = $request->selling_card_no;
            $data->selling_expiry_year = $request->selling_expiry_year;
            $data->selling_expiry_month = $request->selling_expiry_month;
            $data->selling_cvc = $request->selling_cvc;
            $data->selling_paypal_email = $request->selling_paypal_email;
            $data->save();

            return redirect()->back()->with(['message' => 'Selling details are updated successfully!']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }
}
