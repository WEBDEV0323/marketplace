<?php

namespace App\Http\Controllers;

use App\Models\BrandSubscription;
use Illuminate\Http\Request;
use App\Models\UserAddress;
use App\Models\User;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Setting;
use App\Models\VendorsProductStock;
use App\Models\VendorProduct;
use Auth;
use App\Models\Cart;
use App\Models\ProductSize;
use Illuminate\Support\Str;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use App\Models\BillingAddresses;
use App\Models\Card;
use App\Models\ShippingAddresses;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderInvoice;
use App\Mail\OrderInvoiceAdmin;
use App\Models\BankInformation;
use Stripe;
use Hash;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class CheckoutController extends Controller
{
    private $_api_context;

    public function __construct()
    {
        $this->middleware('auth');
        $this->currentDate = Carbon::now()->format('Y-m-d');
        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }

    public function index()
    {
        // $user_id=auth::user()->id;
        // $product_ids = $this->cart_product_ids();
        // $products = $this->get_products($product_ids);
        // $data['weight'] = $this->product_weight_randers($products);
        // $total_weight_price =  $this->price_with_weight($data['weight']);
        // $fixed_shipping_price = $this->get_fixed_shipping();
        // $data['total_shipping'] =  $total_weight_price + $fixed_shipping_price;

        $shipping = 15;

        $user_id = auth::user()->id;

        $bank = Card::where("user_id", $user_id)->first();

        $ship = Setting::where("key", "fixed_shipping")->first();

        $billing_address = UserAddress::where(["user_id" => $user_id, "flags" => 1])->first();

        $shipping_address = UserAddress::where(["user_id" => $user_id, "flags" => 2])->first();

        if (isset($ship->value)) {

            preg_match('!\d+!', $ship->value, $matches);
            $shipping = (int)$matches[0];
        }

        $data = \App\Models\Cart::select(["products.*", "carts.*", "product_sizes.sale_price as sale_price_sizes", "products.delivery_charges as delivery_charges", "shop_categories.shipping"])
            ->leftjoin("products", "products.id", "=", "carts.product_id")
            ->leftjoin("shop_categories", "shop_categories.id", "=", "products.shop_category_id")
            ->leftjoin("product_sizes", "product_sizes.product_id", "=", "products.id")
            ->where("user_id", $user_id)
            ->groupBy("carts.id")
            ->get();

        foreach ($data as $i => $d) {

            if ($product_name = Product::where("id", $d->parent_id)->first()->product_name ?? '') {

                $data[$i]->product_parent_name = $product_name;
            }
        }

        return view('frontend.checkout.checkout-index', compact(['data', 'billing_address', 'shipping_address', 'shipping', 'bank']));
    }

    //total cost of weight shipping
    public function price_with_weight($checkout_weights)
    {
        $setting_weight = $this->setting_weight();
        $total_cost = null;
        foreach ($checkout_weights as $checkout_weight) {
            $total_cost += $checkout_weight * $setting_weight->price;
        }
        return $total_cost;
    }

    //weight which admin set per unit price
    public function setting_weight()
    {
        $check_weight = Setting::where('key', 'weight')->first();

        if (!empty($check_weight)  && $check_weight['value'] != 'null') {
            $check_weight = $check_weight->toArray();
            $data['weights'] = json_decode($check_weight['value']);
            return $data['weights'];
        }
    }

    //fixed which admin have allowed
    public function get_fixed_shipping()
    {
        $fixed_shipping = Setting::where('key', 'fixed_shipping')->first();

        if (!empty($fixed_shipping) && $fixed_shipping['value'] != 'null') {

            $fixed_shipping = $fixed_shipping->toArray();

            return json_decode($fixed_shipping['value']);
        }
    }

    // product and weight rander with loop and get all weight of product which present in cart
    public function product_weight_randers($products)
    {
        $weight = [];
        foreach ($products as $product) {
            $weight[] = $product->weight;
        }
        return $weight;
    }

    //get all products of thier parents according
    public function get_products($products)
    {
        return Product::whereRaw("flags & ? = ?", [Product::FLAG_ACTIVE, Product::FLAG_ACTIVE])
            ->where(function ($query) {
                $query->whereNull('products.expiry_date')
                    ->orWhereDate('products.expiry_date', '>=', $this->currentDate);
            })
            ->whereIn('id', $products)->with('prod_shop_cat', 'prod_shop_cat.shop_cat', 'prod_shop_cat.shop_cat.cat_parent')
            ->get();
    }

    // cart which have products
    public function cart_product_ids()
    {
        $carts = [];
        foreach (\Cart::content() as $cart) {
            $carts[] = $cart->id;
        }
        return $carts;
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();
            // $abc = $request->all();
            // $name = $request->input('billing_first_name');
            $coupon_code = strlen($request->coupon_code) > 0 ? $request->coupon_code : $request->coupon;
            $date = date("Y-m-d");
            $my_id = auth::user()->id;
            $delivery_charges = 0;
            $sub_total = 0;
            $shipping = 15;
            $data = $subscribe_data = $subscribe_brand_ids = [];

            $cart_data = Cart::select(["shop_categories.shipping", "products.*", "carts.*", "product_sizes.sale_price as sale_price_sizes", "products.delivery_charges as delivery_charges", "carts.id as cart_id"])
                ->leftjoin("products", "products.id", "=", "carts.product_id")
                ->leftjoin("shop_categories", "shop_categories.id", "=", "products.shop_category_id")
                ->leftjoin("product_sizes", "product_sizes.product_id", "=", "products.id")
                ->where("user_id", $my_id)
                ->groupBy("carts.id")
                ->get();

            $order = new Order();
            $order->user_id = $my_id;
            $order->coupon_id = $coupon_code;
            $order->payment_type = 3;
            $order->reference = 'TMP-' . random_int(100000, 999999);
            $order->save();

            $code = Coupon::where("coupon_code", $coupon_code)
                ->where('start_date', '<=', $date)
                ->where('end_date', '>=', $date)
                ->get();

            foreach ($cart_data as $key => $cart) {

                //update qty
                ProductSize::where(["product_id" => $cart->product_id, "size_id" => $cart->size_id])
                    ->update(["quantity" => DB::raw('quantity-' . $cart->quantity)]);

                if ((float)$cart->sale_price > 0) {
                    $sub_total = $sub_total + $cart->sale_price * (int)$cart->quantity;
                    $single_price = $cart->sale_price * (int)$cart->quantity;
                } elseif ((float)$cart->sale_price_sizes > 0) {
                    $sub_total = $sub_total + $cart->sale_price_sizes * (int)$cart->quantity;
                    $single_price = $cart->sale_price_sizes * (int)$cart->quantity;
                } else {
                    $sub_total = $sub_total + $cart->regular_price * (int)$cart->quantity;
                    $single_price = $cart->regular_price * (int)$cart->quantity;
                }

                $delivery_charges = $delivery_charges + $cart->shipping;

                $product = Product::where("id", $cart->product_id)->first();

                $sp = $single_price * 7.5 / 100;

                $discount_amount = 0;

                if (isset($code[0]->coupon_code) && (int)$code[0]->total_coupon > 0) {

                    $atm = ($cart->shipping + $sp + $single_price);
                    $discount_percentage = $code[0]->discount;

                    $discount_amount = ($discount_percentage * $atm) / 100;
                }

                $data[$key] = [
                    "order_id" => $order->id,
                    "product_id" => $cart->product_id,
                    "size_id" => $cart->variation_id,
                    "quantity" => $cart->quantity,
                    "flags" => 1,
                    "product_owner_id" => $product->vendor_id,
                    "price" => $single_price,
                    "product_shipping" => $cart->shipping,
                    "product_processing" => number_format((float)$sp, 2, '.', ''),
                    "product_discount" => $discount_amount
                ];

                if (!in_array($cart->brand_id, $subscribe_brand_ids)) {
                    $subscribe_data[$key] = [
                        "brand_id" => $cart->brand_id,
                        "user_id" => $my_id,
                        "flags" => BrandSubscription::FLAG_ACTIVE,
                    ];
                    array_push($subscribe_brand_ids, $cart->brand_id);
                }

                // add Top Trending Of September
                    $getProductGenger = Product::where('id',$cart->product_id)->first();
                    if($getProductGenger){
                        if($getProductGenger->gender == 1){
                            $check_man_in_new =  Setting::where('key', 'top_mans_trend_product')->first();
                            if ($check_man_in_new) {  
                                if($check_man_in_new->value =='' || $check_man_in_new->value == "null"){
                                    $check_man_in_new->value = json_encode(array((string)$cart->product_id));
                                    $check_man_in_new->save();
                                }else{
                                    $mains_new_decode = json_decode($check_man_in_new->value, true);
                                    array_push($mains_new_decode,(string)$cart->product_id);
                                    $check_man_in_new->value = json_encode($mains_new_decode);
                                    $check_man_in_new->save();
                                }     
                            } else {
                                $setting = new Setting();
                                $setting->key = "top_mans_trend_product";
                                $setting->value = json_encode(array((string)$cart->product_id));
                                $setting->save();
                            }
                        }elseif($getProductGenger->gender == 2){
                            $check_woman_in_new = Setting::where('key', 'top_womans_trend_product')->first();
                            if ($check_woman_in_new) {
                                if($check_woman_in_new->value =='' || $check_woman_in_new->value == "null"){
                                    $check_woman_in_new->value = json_encode(array((string)$cart->product_id));
                                    $check_woman_in_new->save();
                                }else{
                                    $woman_new_decode = json_decode($check_woman_in_new->value, true);
                                    array_push($woman_new_decode,(string)$cart->product_id);
                                    $check_woman_in_new->value = json_encode($woman_new_decode);
                                    $check_woman_in_new->save();
                                }  
                            } else {
                                $setting = new Setting();
                                $setting->key = "top_womans_trend_product";
                                $setting->value = json_encode(array((string)$cart->product_id));
                                $setting->save();
                            }
                        }elseif($getProductGenger->gender == 3){
                            $check_children_in_new = Setting::where('key', 'top_children_trend_product')->first();
                            if ($check_children_in_new) {
                                if($check_children_in_new->value =='' || $check_children_in_new->value == "null"){
                                    $check_children_in_new->value = json_encode(array((string)$cart->product_id));
                                    $check_children_in_new->save();
                                }else{
                                    $child_new_decode = json_decode($check_children_in_new->value, true);
                                    array_push($child_new_decode,(string)$cart->product_id);
                                    $check_children_in_new->value = json_encode($child_new_decode);
                                    $check_children_in_new->save();
                                }  
                            } else {
                                $setting = new Setting();
                                $setting->key = "top_children_trend_product";
                                $setting->value = json_encode(array((string)$cart->product_id));
                                $setting->save();
                            }
                        }
                    }
                // add Top Trending Of September

                //delete old subcription
                if ($request->accept && $brand_subscribed = BrandSubscription::where('user_id', $my_id)->where('brand_id', $cart->brand_id)) {
                    $brand_subscribed->delete();
                }
            }

            if ($ship = Setting::where("key", "fixed_shipping")->first()->value ?? 0) {
                preg_match('!\d+!', $ship, $matches);
                $shipping = (int)$matches[0];
            }

           // $processing = (float)number_format((float)(($shipping * count($data) + $sub_total) * 7.5 / 100), 2, '.', '');
            if(isset($code[0]->coupon_code) && (int)$code[0]->total_coupon > 0 && $code[0]->free_shiping == 'yes'){
                $delivery_charges = 0;
            }
            $processing = ProcessingFeeCalculate($sub_total); 
            // $total = $sub_total + $delivery_charges + $processing;
            $total = $sub_total + $processing;
            $discount_amount = 0;
            if (isset($code[0]->coupon_code) && (int)$code[0]->total_coupon > 0) {

                $coupon = Coupon::find($code[0]->id);
                $coupon->decrement('total_coupon', 1);
                $coupon->save();
                $discount_percentage = $code[0]->discount;
                $discount_amount =  (float)number_format((float)($discount_percentage / 100 * ($total)), 2, '.', '');
            }
            
            $order->total_price = $total - $discount_amount;
            $order->shipping = $delivery_charges;
            $order->processing = $processing;
            // dd($order->total_price);
            $order->save();

            orderDetail::insert($data);

            if ($request->accept && count($subscribe_data) > 0) {
                BrandSubscription::insert($subscribe_data);
            }

            $shipping = new ShippingAddresses();
            $billing = new BillingAddresses();

            $shipping->user_id = $billing->user_id = $my_id;
            $shipping->order_id = $billing->order_id = $order->id;
            $shipping->first_name = $billing->first_name = $request->billing_first_name;
            $shipping->last_name = $billing->last_name = $request->billing_last_name;
            $shipping->email = $billing->email = $request->billing_email;
            $shipping->country = $billing->country = "United Kingdom";
            $shipping->street_address = $billing->street_address = $request->billing_address_1;
            $shipping->appartment_address = $billing->appartment_address = $request->billing_address_2;
            $shipping->city = $billing->city = $request->billing_city;
            $shipping->state = $billing->state = $request->billing_state;
            $shipping->post_code = $billing->post_code = $request->billing_postcode;
            $shipping->phone = $billing->phone = $request->billing_phone;

            $billing->save();

            //if shipping is different
            if ($request->ship_to_different_address == 2) {
                $shipping->first_name = $request->fName2;
                $shipping->last_name = $request->lName2;
                $shipping->company = $request->companyName;
                $shipping->street_address = $request->streetAddres2;
                $shipping->appartment_address = $request->appartmentSuit2;
                $shipping->city = $request->city2;
                $shipping->state = $request->shipping_state;
                $shipping->post_code = $request->postCode2;
                $shipping->phone = $request->shipping_phone;
                $shipping->email = $request->shipping_email;
            }

            $shipping->save();

            // updated by bbt developer 
            $storePaymentInformtion = BankInformation::create([
                'vendor_id' => FacadesAuth::user()->id,
                "order_id" => $order->id,
                'card_number' => $request->buying_card_no,
                'expire_year' => $request->buying_expiry_year,
                'expire_month' => $request->buying_expiry_month,
                'CCV' => $request->buying_cvc,
                'type' => 'Card Payment',
                'flags' => 1
            ]);

            $order = Order::where('id', $order->id)->with('user', 'order_detail', 'order_detail.product', 'order_detail.product.product_user', 'order_detail.product.product_parent', 'order_detail.product.brand', 'order_detail.size_detail', "shipping_addresses", "order_detail.product.prod_size_one")->first();
            $token = $request->input('token_id');

            // Stripe\Stripe::setApiKey('sk_test_51JFfTBBSH6f3eK6wQE3aWZn9CQ6NBsLXEEDmvOzIhqRFWBJSITOYOLRfKeOd2SUnALJhtr54DZHOvTapcNzkGiLb009Nk0LAje');//config('services.stripe.secret'));
            Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            $abc = number_format((float)$order->total_price, 2, '.', '') * 100;
            try {
                $created_payment = Stripe\Charge::create([
                    "amount" => number_format((float)$order->total_price, 2, '.', '') * 100,
                    "currency" => "gbp",
                    "source" => $token,
                    "description" => "Payment for The Marketplace",
                    'metadata' => [
                        'order_id' => $order->id,
                        'reference_number' => $order->reference,
                        'billing_name' => $request->billing_first_name . ' ' . $request->billing_last_name,
                        'billing_email' => $request->billing_email
                    ]
                ]);
                // Handle successful payment
                Cart::where("user_id", $my_id)->delete();

                $order->paid = 1;
                $order->save();

                DB::commit();

                Mail::to(auth()->user()->email)->send(new OrderInvoice(auth()->user(), $order, $billing, $shipping));
                Mail::to('deepakyadav.hipl@gmail.com')->send(new OrderInvoiceAdmin(auth()->user(), $order, $billing, $shipping));
                return response()->json(['success'=> true, 'url' => 'thankyou', 'reference' => $order->reference]);
            } catch (\Exception $e) {
                // Handle payment failure
                return response()->json(['success' => false, 'error' => $e->getMessage()]);
            }

        } catch (\Exception $e) {

            DB::rollback();

            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function postPaymentWithpaypal($order)
    {
        $my_id = auth::user()->id;

        $p = $order->total_price;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        settype($amount, "double");
        $item_1 = new Item();

        $item_1->setName('Product 1')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($p);

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($p);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription($order->user_id);

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('status'))
            ->setCancelUrl(URL::route('status'));

        $payment = new Payment();

        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {

            Cart::where("user_id", $my_id)->delete();


            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
                return Redirect::route('paywithpaypal');
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::route('paywithpaypal');
            }
        }
        foreach ($payment->getLinks() as $link) {

            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        Session::put('paypal_payment_id', $payment->getId());
        Session::put('order_id', $order->id);

        if (isset($redirect_url)) {

            return Redirect::away($redirect_url);
        }

        //Session::put('error','Unknown error occurred');


        return redirect(route('home'))->with(['message' => "Your Order Is Placed, Thank you so much"]);
    }

    public function getPaymentStatus(Request $request)
    {
        $payment_id = Session::get('paypal_payment_id');
        $order_id = Session::get('order_id');

        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::put('error', 'Payment failed');
            return Redirect::route('paywithpaypal');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);

        $order = Order::find($order_id);
        $order->paid = 1;
        $order->payment_response = $result->getTransactions()[0]->toJson();
        $order->save();
        Session::forget('order_id');

        //return redirect()->route("user_orders");

        if ($result->getState() == 'approved') {
            \Session::put('success', 'Payment success !!');
            return redirect()->route("user_orders");
        }

        \Session::put('error', 'Payment failed !!');
        return Redirect::route('paywithpaypal');
    }

    public function user_payment($id)
    {
        $order = Order::where('id', $id)->first();

        return $this->postPaymentWithpaypal($order);
    }
}
