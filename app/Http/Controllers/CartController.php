<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function cartSave($id)
    {
        try {
            $auth = Auth::user();
            $cart = new Cart();
            $cart->user_id = $auth->id;
            $cart->book_id = $id;
            $cart->quantity = 1;
            $cart->status = 1;
            $cart->save();
        } catch (\Exception $ex) {
            return Redirect::back()->withErrors(['status' => 'error', 'msg' => 'Somethin wrong!']);
        }
        return redirect()->route('dashboard');
    }

    public function cartShow()
    {
        $auth_id = Auth::user()->id;
        $cart_table = Cart::with('book','price','discount')->where('user_id', $auth_id);
        $carts = $cart_table->paginate(5);
        $total_carts = $cart_table->get();

        $subtotal_price = 0;
        $total_price = 0;
        foreach ($total_carts as $key => $cart) {
            $toal_discount = $cart->discount ? $cart->discount->total_discount : 0;
            $dis_price = $cart->price->price;
            $new_price = ($dis_price / 100) * $toal_discount;
            $current = $dis_price - $new_price;
            $total_price = $total_price + $current;

            $subtotal_price = $subtotal_price + $cart->price->price;
        }

        return view('cart.index', compact('carts', 'total_price', 'subtotal_price'));
    }

    public function delete($id)
    {
        Cart::findOrFail($id)->delete();
        return redirect()->route('show.cart');
    }

    public function processCheckout(Request $request)
    {
        $auth_id = Auth::user()->id;
        $total_carts = Cart::with('book','price','discount')->where('user_id', $auth_id)->get();
        $subtotal_price = 0;
        $total_price = 0;
        foreach ($total_carts as $key => $cart) {
            $toal_discount = $cart->discount ? $cart->discount->total_discount : 0;
            $dis_price = $cart->price->price;
            $new_price = ($dis_price / 100) * $toal_discount;
            $current = $dis_price - $new_price;
            $total_price = $total_price + $current;

            $subtotal_price = $subtotal_price + $cart->price->price;
        }
        $price['subtotal'] = $subtotal_price;
        $price['total'] = $total_price;
        $price['discount'] = $price['subtotal'] - $price['total'];
        dd($price);
    }
}
