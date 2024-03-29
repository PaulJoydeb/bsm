<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Categorie;
use App\Models\Checkout;
use App\Models\Discount;
use App\Models\Favourite;
use App\Models\UserRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::get();
        $books = Book::with('price', 'discount', 'author')->limit(16)->get();
        return view('welcome', compact('categories', 'books'));
    }

    public function home()
    {
        $categories = Categorie::get();
        $books = Book::with('price', 'discount', 'author')->limit(16)->get();
        return view('welcome', compact('categories', 'books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function shopGrid()
    {
        $favourite = Favourite::where('user_id', Auth::user()->id)->count();
        $books = Book::with('author')->latest()->paginate(9);
        $discount_books = Discount::with('book', 'price')->latest()->limit(6)->get();
        $categories = Categorie::limit(15)->get();
        return view('shop.shop_grid', compact('books','favourite', 'discount_books', 'categories'));
    }
    public function checkout()
    {
        $auth_id = Auth::user()->id;
        $checkouts = Checkout::where('user_id', $auth_id)->where('status', 1)->get();
        $subtotal = 0;
        $total = 0;
        foreach ($checkouts as $key => $checkout) {
            $subtotal = $subtotal + $checkout->subtotal;
            $total = $total + $checkout->total;
        }
        $user_record = UserRecord::where('user_id', Auth::user()->id)->first();

        return view('checkout.index', compact('subtotal', 'total', 'user_record'));
    }

    public function contact()
    {
        return view('about.contact');
    }
}
