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
        $carts = Cart::with('book','price','discount')->where('user_id', $auth_id)->paginate(5);
        return view('cart.index', compact('carts'));
    }

    public function delete($id)
    {
        Cart::findOrFail($id)->delete();
        return redirect()->route('show.cart');
    }

    public function processCheckout(Request $request)
    {
        dd($request->all());
    }
}
