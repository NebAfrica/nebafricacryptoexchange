<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomFunctionController extends Controller
{
    //return view
    public function customPhp()
    {
        $page_title = 'Custom PHP Functions';
        
        //get the function content
        $path = app_path('Helpers/customFunction.php');
        $custom_php_codes = \file_get_contents($path);

        return view('admin.settings.custom-php', compact(
            'page_title',
            'custom_php_codes'
        ));


    }

    //validate 
    public function customPhpValidate(Request $request)
    {
        $path = app_path('Helpers/customFunction.php');
        $custom_php_codes = \file_put_contents($path, $request->custom_php);

        return \response('success', 200);

    }
}
