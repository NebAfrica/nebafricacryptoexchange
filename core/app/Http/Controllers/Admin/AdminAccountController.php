<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminAccountController extends Controller
{
    //return account profile index
    public function profile()
    {
        $page_title = 'My Profile';

        return view('admin.profile', compact(
            'page_title'
        ));
    }
    //validate account edit
    public function general(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'profile_photo' => 'mimes:png,jpg,jpeg|max:10240'
        ]);

        $profile_photo = admin('profile_photo');


        //check if the request has profile photo
        if ($request->file('profile_photo')) {
            //upload the profile image
            $profile_photo = uploadImage($request->profile_photo, 'admin');
        }

        $admin = Admin::find(admin('id'));
        $admin->profile_photo = $profile_photo;
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $save = $admin->save();

        if ($save) {
            return back()->with('success', 'Profile updated successfully');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    public function password(Request $request)
    {
        //validate input field
        $request->validate([
            'password' => 'required|confirmed'
        ]);

        //update the admin's password
        $password = Admin::find(admin('id'));
        $password->password = Hash::make($request->password);
        $update_password = $password->save();

        if ($update_password) {
            return back()->with('success', 'Password has been updated successfully');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }
}
