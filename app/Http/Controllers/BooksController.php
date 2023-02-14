<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Categorie;
use Illuminate\Http\Request;
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
        $book = Book::findOrFail($id);
        $path_thumb = public_path()."/storage/".$book->image;
        $org_path = str_replace('book_thumbnail', 'book', $book->image);
        $path_org = public_path()."/storage/".$org_path;
        if (!empty($path_thumb) && !empty($path_org)) {
            unlink($path_thumb);
            unlink($path_org);
        }
        $book->delete();
        return redirect()->route('show.book');
    }
}
