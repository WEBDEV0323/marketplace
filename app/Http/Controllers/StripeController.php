<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Stripe;
use Session;

class StripeController extends Controller
{
    /**
     * payment view
     */
    public function handleGet()
    {

        return view('frontend.stripe.stripe');
    }

    /**
     * handling payment with POST
     */
    public function handlePost(Request $request)
    {
        Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        Stripe\Charge::create([
            "amount" => 100 * 150,
            "currency" => "inr",
            "source" => $request->stripeToken,
            "description" => "Making test payment."
        ]);

        Session::flash('success', 'Payment has been successfully processed.');

        return back();
    }

    public function stripeCallback(Request $request)
    {
        try {

            $payload = @file_get_contents('php://input');
            $event = \Stripe\Event::constructFrom(json_decode($payload, true));

        } catch (\UnexpectedValueException $e) {

            // Invalid payload
            http_response_code(400);
            exit();
        }

        $order = Order::find($event->data->object->metadata->order_id ?? 0);

        if ($order) {

            if (empty($order->stripe_response)) {

                $order->stripe_response = json_encode([$event->type => $event->data->object]);
            } else {

                $old_response = json_decode($order->stripe_response, true);

                $order->stripe_response = json_encode(array_merge($old_response, [$event->type => $event->data->object]));
            }

            $order->paid = 1;
            $order->save();
        }

        //success respond to request
        http_response_code(200);
    }

}
