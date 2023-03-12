<?php

namespace App\Http\Controllers;

use App\Models\BuyBook;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function pending()
    {
        $buy_books = BuyBook::where('status', 1)->where('process', 1)->paginate(10);
        return view('products.pending', compact('buy_books'));
    }

    public function acceptPending($id)
    {
        $buy_book = BuyBook::findOrFail($id);
        $buy_book->process = 2;
        $buy_book->save();
        return redirect()->route('pending.list');
    }

    public function rejectPending($id)
    {
        $buy_book = BuyBook::findOrFail($id);
        $buy_book->status = 0;
        $buy_book->save();
        return redirect()->route('pending.list');
    }

    public function delivery()
    {
        $buy_books = BuyBook::where('status', 1)->where('process', 2)->paginate(10);
        return view('products.delivery',compact('buy_books'));
    }

    public function acceptDelivery($id)
    {
        $buy_book = BuyBook::findOrFail($id);
        $buy_book->process = 3;
        $buy_book->save();
        return redirect()->route('delivery.list');
    }

    public function rejectDelivery($id)
    {
        $buy_book = BuyBook::findOrFail($id);
        $buy_book->status = 0;
        $buy_book->save();
        return redirect()->route('delivery.list');
    }

    public function total()
    {
        $buy_books = BuyBook::where('status', 1)->where('process', 3)->paginate(10);
        return view('products.total',compact('buy_books'));
    }
}
