<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BuyBook;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'country' => 'required',
            'primary_address' => 'required',
            'town_or_city' => 'required',
            'postcode_or_zip' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ]);

        $billing_details = json_encode($request->except('_token'));
        $auth_id = Auth::user()->id;
        $checkouts = Checkout::where('user_id', $auth_id)->where('status', 1)->get();
        $checkout_ids = Checkout::select('id')->where('user_id', $auth_id)->where('status', 1)->get();
        $subtotal = 0;
        $total = 0;
        foreach ($checkouts as $key => $checkout) {
            $subtotal = $subtotal + $checkout->subtotal;
            $total = $total + $checkout->total;
            $book_ids[] = $checkout->book_ids;

            $cart = Checkout::findOrFail($checkout->id);
            $cart->status = 0;
            $cart->save();
        }

        $json_book_ids = [];
        if (!empty($book_ids)) {
            foreach ($book_ids as $key => $book_id) {
                $decode_book_ids = json_decode($book_id);
                $book_id = array_column($decode_book_ids, 'book_id');
                $explode[] = implode(',', $book_id);
            }

            $newArray = [];
            foreach ($explode as $value) {
                $newArray = array_merge($newArray, explode(",", $value));
            }
            $json_book_ids = json_encode($newArray);
        }

        $book_name_list = Book::select('title')->whereIn('id', $newArray)->get();

        try {
            $buy = new BuyBook();
            $buy->subtotal = $subtotal;
            $buy->user_id =  Auth::user()->id;
            $buy->checkout_ids = json_encode($checkout_ids);
            $buy->total = $total;
            $buy->process = 1;
            $buy->status = 1;
            $buy->json_book_ids = $json_book_ids;
            $buy->json_book_names = json_encode($book_name_list);
            $buy->billing_details = $billing_details;
            $buy->save();
        } catch (\Exception $ex) {
            dd($ex);
            return Redirect::back()->withErrors(['status' => 'error', 'msg' => 'Somethin wrong!']);
        }
        return redirect()->route('dashboard');
    }

    public function productDetails($id)
    {
        $book = Book::with('author', 'cateogry', 'price', 'discount')->findOrFail($id);
        $releated_books = Book::with('author', 'cateogry', 'price', 'discount')->where('category_id', $book->category_id)->latest()->limit(4)->get();
        return view('shop.product_details', compact('book','releated_books'));
    }

    public function orderList()
    {
        $auth_id = Auth::user()->id;
        $order_lists = BuyBook::where('user_id', $auth_id)->paginate(5);
        return view('shop.order_list', compact('order_lists'));
    }
}
