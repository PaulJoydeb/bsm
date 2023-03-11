<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BuyBook;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $total_books = Book::count();
        $buy_book = new BuyBook();
        $buy_books = $buy_book->where('process', 3)->count();;
        $deliver_pending = $buy_book->where('process', 2)->count();;
        $pending_request = $buy_book->where('process', 1)->count();
        return view('admin', compact('total_books', 'buy_books', 'deliver_pending', 'pending_request'));
    }
}
