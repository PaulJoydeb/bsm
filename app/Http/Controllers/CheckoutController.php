<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function placeOrder(Request $request)
    {
        dd('here');
        $billing_details = json_encode($request->except('_token'));
        $auth_id = Auth::user()->id;
        $checkouts = Checkout::where('user_id', $auth_id)->where('status', 1)->get();
        $subtotal = 0;
        $total = 0;
        foreach ($checkouts as $key => $checkout) {
            $subtotal = $subtotal + $checkout->subtotal;
            $total = $total + $checkout->total;
        }
    }
}
