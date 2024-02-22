<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Carbon\Carbon;

class AbandonedCartsController extends Controller
{
    public function index()
    {
        $abandonedCarts = Cart::whereNull('checkout_time')
            ->where('created_at', '<', Carbon::now()->subHours(24)) // Adjust the time threshold as needed
            ->get();

        return view('abandoned_carts.index', ['abandonedCarts' => $abandonedCarts]);
    }

    // You can add more methods as needed for abandoned carts functionality
}

