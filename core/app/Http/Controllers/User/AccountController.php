<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    //return profile edit 
    public function profile()
    {

        $page_title = 'My Profile';
        $referreds = User::where('referred_by', user('account_id'))->get();
        $total_referrals = $referreds->count();
        return view('themes.' . websiteInfo('theme') . '.user.account.profile', compact(
            'page_title',
            'total_referrals',
            'referreds'
        ));
    }

    //return edit
    public function edit()
    {
        $page_title = 'Edit Profile';
        $countries = countryList()['countries'] ?? [];

        return view('themes.' . websiteInfo('theme') . '.user.account.edit', compact(
            'page_title',
            'countries'
        ));
    }

    //validate general account setting

    public function general(Request $request)
    {
        if (user('id_verified') == 'verified') {
            $request->validate([
                'phone_no' => 'required',
                'street_address' => 'required',
                'state' => 'required',
                'country' => 'required',
                'profile_picture' => 'mimes:png,jpeg,jpg'
            ]);
        } else {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'dob' => 'required',
                'phone_no' => 'required',
                'street_address' => 'required',
                'state' => 'required',
                'country' => 'required',
                'profile_picture' => 'mimes:png,jpeg,jpg'
            ]);
        }

        //upload imaage
        if ($request->file('profile_picture')) {
            $profile_picture = uploadImage($request->profile_picture, 'profile');
        } else {
            $profile_picture = user('profile_picture');
        }

        //update user
        $user = User::find(user('id'));
        if (user('id_verified') != 'verified') {
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->dob = $request->dob;
        }
        $user->phone_no = $request->phone_no;
        $user->street_address = $request->street_address;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->profile_picture = $profile_picture;

        $save = $user->save();

        if ($save) {
            return back()->with('success', 'Your account has been updated successfully');
        } else {
            return back()->with('fail', 'An Error occured, try again later');
        }
    }

    //password change

    public function password(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
            'old_password' => 'required'
        ]);

        //check if the old password matches
        if (Hash::check($request->old_password, user('password'))) {
            $user = User::find(user('id'));
            $user->password = Hash::make($request->password);
            $save = $user->save();

            if ($save) {
                return back()->with('success', 'Your password has been updated successfully');
            } else {
                return back()->with('fail', 'An error occured! Try again later');
            }
        } else {
            return back()->with('fail', 'Your old password does not match');
        }
    }
}
