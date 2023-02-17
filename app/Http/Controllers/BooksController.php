<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Categorie;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as Image;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::get();
        $categories = Categorie::get();
        return view('book.index', compact('authors', 'categories'));
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
        try {
            $request->validate([
                'title' => 'required',
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);

            $image = $request->file('image');
            $input['image'] = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('storage/image/book_thumbnail');
            $imgFile = Image::make($image->getRealPath());
            $imgFile->resize(270, 270)->save($destinationPath . '/' . $input['image']);
            $destinationPath = public_path('storage/image/book');
            $image->move($destinationPath, $input['image']);

            $image_path = 'image/book_thumbnail/' . $input['image'];

            $book = new Book();
            $book->title = $request->title;
            $book->description = $request->description;
            $book->image = $image_path;
            $book->category_id = $request->category_id;
            $book->author_id = $request->author_id;
            $book->total_books = $request->total_books;
            $book->save();

            $price = new Price();
            $price->book_id = $book->id;
            $price->price = $request->price;
            $price->currency = 'BDT';
            $price->save();

        } catch (\Throwable $ex) {
            return Redirect::back()->withErrors(['status' => 'error', 'msg' => 'Somethin wrong!']);
        }
        return redirect()->route('show.book');
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

    public function showBook()
    {
        $books = Book::with('author', 'cateogry')->paginate(5);
        return view('book.show_books', compact('books'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::with('cateogry', 'author', 'price')->findOrFail($id);
        $categories = Categorie::get();
        $authors = Author::get();
        return view('book.edit_book', compact('book', 'categories', 'authors'));
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
        try {
            $request->validate([
                'title' => 'required',
            ]);

            if ($request->image) {

                $book = Book::findOrFail($request->id);
                $path_thumb = public_path() . "/storage/" . $book->image;
                $org_path = str_replace('book_thumbnail', 'book', $book->image);
                $path_org = public_path() . "/storage/" . $org_path;
                if (!empty($path_thumb) && !empty($path_org)) {
                    unlink($path_thumb);
                    unlink($path_org);
                }

                $image = $request->file('image');
                $input['image'] = time() . '.' . $image->getClientOriginalExtension();

                $destinationPath = public_path('storage/image/book_thumbnail');
                $imgFile = Image::make($image->getRealPath());
                $imgFile->resize(270, 270)->save($destinationPath . '/' . $input['image']);
                $destinationPath = public_path('storage/image/book');
                $image->move($destinationPath, $input['image']);

                $image_path = 'image/book_thumbnail/' . $input['image'];
            }

            $book = Book::findOrFail($request->id);
            $book->title = $request->title;
            $book->description = $request->description;
            if ($request->image) {
                $book->image = $image_path;
            }
            $book->category_id = $request->category_id;
            $book->author_id = $request->author_id;
            $book->total_books = $request->total_books;
            $book->save();

            $price = Price::findOrFail($request->price_id);
            $price->book_id = $request->id;
            $price->price = $request->price;
            $price->currency = 'BDT';
            $price->save();

        } catch (\Throwable $ex) {
            return Redirect::back()->withErrors(['status' => 'error', 'msg' => 'Somethin wrong!']);
        }
        return redirect()->route('show.book');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $path_thumb = public_path() . "/storage/" . $book->image;
        $org_path = str_replace('book_thumbnail', 'book', $book->image);
        $path_org = public_path() . "/storage/" . $org_path;
        if (!empty($path_thumb) && !empty($path_org)) {
            unlink($path_thumb);
            unlink($path_org);
        }
        $book->delete();
        Price::where('book_id', $id)->delete();
        return redirect()->route('show.book');
    }
}
