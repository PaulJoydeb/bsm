<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('discount.index');
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
        $request->validate([
            'book_aid' => 'required',
            'total_discount' => 'required',
        ]);
        $discount_exists = Discount::where('book_aid', $request->book_aid)->exists();
        if ($discount_exists != true) {
            $book_id = intval(preg_replace('/[^0-9]+/', '', $request->book_aid), 10);
            $discount = new Discount();
            $discount->book_id = $book_id;
            $discount->book_aid = $request->book_aid;
            $discount->total_discount = $request->total_discount;
            $discount->save();
        }
        return redirect()->route('show.discount');
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

    public function showDiscount()
    {
        $discounts = Discount::with('book', 'price')->paginate(10);
        return view('discount.show_discount', compact('discounts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discount = Discount::findOrFail($id);
        return view('discount.edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'book_aid' => 'required',
            'total_discount' => 'required',
        ]);
        $book_id = intval(preg_replace('/[^0-9]+/', '', $request->book_aid), 10);
        $discount = Discount::findOrFail($request->id);
        $discount->book_id = $book_id;
        $discount->book_aid = $request->book_aid;
        $discount->total_discount = $request->total_discount;
        $discount->save();
        return redirect()->route('show.discount');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Discount::findOrFail($id)->delete();
        return redirect()->route('show.discount');
    }
}
