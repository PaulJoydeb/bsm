<?php

use App\Models\Cart;
use App\Models\Favourite;
use Illuminate\Support\Facades\Auth;

function totalFavourite()
{
    if (Auth::user()) {
        $totalFavourite = Favourite::where('user_id', Auth::user()->id)->count();
        return $totalFavourite;
    }
    return 0;
}

function totalCart()
{
    if (Auth::user()) {
        $totalCart = Cart::where('user_id', Auth::user()->id)->where('status', 1)->count();
        return $totalCart;
    }
    return 0;
}

function total()
{
    if (Auth::user()) {
        $auth_id = Auth::user()->id;
        $total_carts = Cart::with('book', 'price', 'discount')->where('user_id', $auth_id)->where('status', 1)->get();

        $total_price = 0;
        foreach ($total_carts as $key => $cart) {
            $toal_discount = $cart->discount ? $cart->discount->total_discount : 0;
            $dis_price = $cart->price->price;
            $new_price = ($dis_price / 100) * $toal_discount;
            $current = $dis_price - $new_price;
            $total_price = $total_price + $current;
        }
        return $total_price;
    }
    return 0;
}
