<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/*
| The controller manages access to protected files such as themes, id documents, etc.
| The only error code used here is 404. This is as to no give guessers the ability to know
| which image exist or not.
| If you are making modification, feel free to use other error codes.
*/


class AssetController extends Controller
{
    //verify the permission level and grant access to file

    public function filePermission(Request $request)
    {
        $admin_only_folders = [
            'id',
            'admin',
            'themes',
        ];

        $user_and_admin = [
            'profile',
            'tickets',
            'deposits',
        ];

        $anyone = [
            'deposit-methods',
            'teams',
            'testimonials',
            'blogs',
            'nfts'
        ];

        $folder = $request->route('folder');
        $file = $request->route('file');
        $path = 'public/'. $folder . '/' . $file;
        //dd(session()->all());

        //allow only admin access
        if (in_array($folder, $admin_only_folders) && session()->has('adminLoginId')) {
            //return the file if exist
            if (Storage::exists($path)){
                return response()->download(storage_path('app/' . $path)); 
            }else {
                return response()->download(root_path() . 'public/assets/imgs/fallback.png');
            }
                       
        }elseif (in_array($folder, $user_and_admin) && session()->has('adminLoginId') || session()->has('loginId')) {
            //return the file if exist
            if (Storage::exists($path)){
                return response()->download(storage_path('app/' . $path)); 
            }else {
                return response()->download(root_path() . 'public/assets/imgs/fallback.png'); //fallback file
            }
        }elseif (in_array($folder, $anyone) && Storage::exists($path)) {
            return response()->download(storage_path('app/' . $path)); 
        }else {
            return response()->download(root_path() . 'public/assets/imgs/fallback.png'); //fallback file
        }
    }

    //image viewer
    public function imageViewer(Request $request) {
        $admin_only_folders = [
            'id',
            'admin',
            'themes',
        ];

        $user_and_admin = [
            'profile',
            'tickets',
        ];

        $anyone = [
            'deposit-methods',
            'teams',
            'testimonials',
            'blogs'
        ];

        //admin user true
        $admin_and_user_true = false;
        if (session()->has('adminLoginId') || session()->has('loginId')){
            $admin_and_user_true = true;
        }

        $folder = $request->route('folder');
        $file = $request->route('file');
        $path = 'public/'. $folder . '/' . $file;
        //dd(session()->all());

        //prevent access if not admin
        if (in_array($folder, $admin_only_folders) && !session()->has('adminLoginId')) {
            abort(404);            
        
        }

        //prevent access if not admin or user        
        if (in_array($folder, $user_and_admin) && !$admin_and_user_true) {
            //dd($admin_and_user_true);
            abort(401);
            
        }

        //check if the image exist
        if (!Storage::exists($path)) {
            abort(404);
        }

        //check if the file is an image
        $allowed_extensions = [
            'png',
            'jpg',
            'jpeg',
            'gif',
            'svg'
        ];

        $extension = explode('.', $file);
        $extension = $extension[1];

        if (!in_array($extension, $allowed_extensions)) {
            abort(404);
        }

        //return view with image and file
        $page_title = $file;
        return view('image-viewer', compact(
            'page_title',
            'file',
            'folder'
        ));
    }
}
