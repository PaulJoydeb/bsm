<?php
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
