<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $total_books = Book::count();
        $buy_books = 0;
        $deliver_pending = 0;
        $pending_request = 0;
        return view('admin', compact('total_books', 'buy_books', 'deliver_pending', 'pending_request'));
    }
}
