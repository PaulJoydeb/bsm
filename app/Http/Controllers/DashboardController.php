<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Categorie;
use Illuminate\Http\Request;

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
        $books = Book::with('price', 'discount')->limit(4)->get();
        $latest_books = Book::with('price', 'discount')->limit(4)->latest()->get();
        return view('welcome', compact('categories', 'books', 'latest_books'));
    }

    public function home()
    {
        $categories = Categorie::get();
        $books = Book::with('price', 'discount')->limit(4)->get();
        $latest_books = Book::with('price', 'discount')->limit(4)->latest()->get();
        return view('welcome', compact('categories', 'books', 'latest_books'));
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
        $books = Book::latest()->paginate(9);
        return view('shop.shop_grid', compact('books'));
    }

    public function shopCart()
    {
        return view('cart.index');
    }

    public function checkout()
    {
        return view('checkout.index');
    }

    public function contact()
    {
        return view('about.contact');
    }
}
