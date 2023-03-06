<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
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
        $cart_table = Cart::with('book','price','discount')->where('user_id', $auth_id)->where('status', 1);
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

    public function processCheckout()
    {
        $auth_id = Auth::user()->id;
        $total_carts = Cart::with('book','price','discount')->where('user_id', $auth_id, )
        ->where('status', 1)->get();
        $subtotal_price = 0;
        $total_price = 0;
        foreach ($total_carts as $key => $cart) {
            $toal_discount = $cart->discount ? $cart->discount->total_discount : 0;
            $dis_price = $cart->price->price;
            $new_price = ($dis_price / 100) * $toal_discount;
            $current = $dis_price - $new_price;
            $total_price = $total_price + $current;

            $subtotal_price = $subtotal_price + $cart->price->price;

            $cart = Cart::findOrFail($cart->id);
            $cart->status = 0;
            $cart->save();
        }
        $subtotal = $subtotal_price;
        $total = $total_price;
        $discount = ($subtotal - $total);
        try {
            $checkout = new Checkout();
            $checkout->user_id = $auth_id;
            $checkout->meta_data = json_encode($total_carts);
            $checkout->subtotal = $subtotal;
            $checkout->total = $total;
            $checkout->discount = $discount;
            $checkout->status = 1;
            $checkout->save();
        } catch (\Exception $ex) {
            dd($ex);
            return Redirect::back()->withErrors(['status' => 'error', 'msg' => 'Somethin wrong!']);
        }
        return redirect()->route('dashboard');
    }
}
