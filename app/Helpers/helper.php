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
        $totalCart = Cart::where('user_id', Auth::user()->id)->count();
        return $totalCart;
    }
    return 0;
}
