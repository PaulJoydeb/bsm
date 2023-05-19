<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FavoriteController extends Controller
{
    public function heartSave($id)
    {
        try {
            $auth = Auth::user();

            $exists = Favourite::where('book_id', $id)->where('user_id', $auth->id)->exists();
            if ($exists != true) {
                $session_ip = $_SERVER['REMOTE_ADDR'];
                $favourite = new Favourite();
                $favourite->user_id = $auth->id;
                $favourite->book_id = $id;
                $favourite->status = 1;
                $favourite->session = $session_ip;
                $favourite->save();
                session()->flash('message', 'Successfully Saved.');
            }
        } catch (\Exception $ex) {
            return Redirect::back()->withErrors('Something Went Wrong!');
        }
        return redirect()->route('dashboard');
    }

    public function heartShow()
    {
        $auth_id = Auth::user()->id;
        $favourites = Favourite::with('book','price','discount')->where('user_id', $auth_id)->paginate(5);
        return view('favourite.index', compact('favourites'));
    }

    public function delete($id)
    {
        Favourite::findOrFail($id)->delete();
        session()->flash('message', 'Successfully Favorite Deleted.');
        return redirect()->route('show.favourite');
    }
}
