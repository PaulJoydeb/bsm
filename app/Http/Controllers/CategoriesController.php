<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index');
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
                'name' => 'required',
            ]);

            $category = new Categorie();
            $category->name = $request->name;
            $category->type = $request->type;
            $category->description = $request->description;
            $category->save();
            session()->flash('message', 'Successfully Saved.');
        } catch (\Exception $ex) {
            return Redirect::back()->withErrors('Something Went Wrong!');
        }
        return redirect()->route('show.category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Categorie::paginate(5);
        $books = Book::with('author', 'cateogry', 'price', 'discount')->where('category_id', $id)->paginate(10);
        return view('category.category_wise', compact('books', 'categories'));
    }

    public function showCategory()
    {
        $categories = Categorie::paginate(5);
        return view('category.show_category', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Categorie::find($id);
        return view('category.edit', compact('category'));
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
                'name' => 'required',
            ]);
            
            $category = Categorie::findOrFail($request->id);
            $category->name = $request->name;
            $category->type = $request->type;
            $category->description = $request->description;
            $category->save();
            session()->flash('message', 'Successfully Updated.');
        } catch (\Exception $ex) {
            return Redirect::back()->withErrors('Something Went Wrong!');
        }
        return redirect()->route('show.category' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exists = Book::where('category_id', $id)->exists();
        if ($exists == false) {
            Categorie::findOrFail($id)->delete();
        }
        return redirect()->route('show.category');
    }
}
