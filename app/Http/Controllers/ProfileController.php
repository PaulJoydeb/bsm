<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\UserRecord;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user_record = UserRecord::where('user_id', Auth::user()->id)->first();
        return view('profile.edit', [
            'user' => $request->user(),
            'user_record' => $user_record
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        if ($request->billing_address == 1) {
            $exists = UserRecord::where('user_id', Auth::user()->id)->exists();
            if ($exists) {
                $user_record = UserRecord::where('user_id', Auth::user()->id)->first();
                $user_record->country = $request->country;
                $user_record->primary_address = $request->primary_address;
                $user_record->secondary_address = $request->secondary_address;
                $user_record->town_or_city = $request->town_or_city;
                $user_record->country_or_state = $request->country_or_state;
                $user_record->postcode_or_zip = $request->postcode_or_zip;
                $user_record->phone = $request->phone;
                $user_record->save();
            } else {
                $user_record =  new UserRecord();
                $user_record->user_id = Auth::user()->id;
                $user_record->country = $request->country;
                $user_record->primary_address = $request->primary_address;
                $user_record->secondary_address = $request->secondary_address;
                $user_record->town_or_city = $request->town_or_city;
                $user_record->country_or_state = $request->country_or_state;
                $user_record->postcode_or_zip = $request->postcode_or_zip;
                $user_record->phone = $request->phone;
                $user_record->save();
            }
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
