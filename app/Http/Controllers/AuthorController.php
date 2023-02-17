<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('author.index');
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
                'surname' => 'nullable',
                'name' => 'required|string',
                'about' => 'nullable|string',
            ]);
            
            $author = new Author();
            $author->name = $request->name;
            $author->surname = $request->surname;
            $author->about = $request->about;
            $author->save();
        } catch (\Exception $ex) {
            return Redirect::back()->withErrors(['status' => 'error', 'msg' => 'Somethin wrong!']);
        }
        return redirect()->route('show.author' );
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
    
    public function showAuthor()
    {
        $authors = Author::paginate(5);
        return view('author.show_authors', compact('authors'));
    }

    public function editAuthor($id)
    {
        $author = Author::find($id);
        return view('author.edit', compact('author'));
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
    public function update(Request $request)
    {
        try {
            $request->validate([
                'surname' => 'nullable',
                'name' => 'required|string',
                'about' => 'nullable|string',
            ]);
            
            $author = Author::findOrFail($request->id);
            $author->name = $request->name;
            $author->surname = $request->surname;
            $author->about = $request->about;
            $author->save();
        } catch (\Exception $ex) {
            return Redirect::back()->withErrors(['status' => 'error', 'msg' => 'Somethin wrong!']);
        }
        return redirect()->route('show.author' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exists = Book::where('author_id', $id)->exists();
        if ($exists == false) {
            Author::findOrFail($id)->delete();
        }        
        return redirect()->route('show.author');
    }
}
