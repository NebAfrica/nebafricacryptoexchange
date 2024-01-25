<?php

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Transaction;


//get logged in admin details;
if (!function_exists('admin')) {
    function admin($info)
    {
        if ($info == NULL) {
            return 'no info matches';
        }
        //get the logged in admin id from session;

        $admin = Admin::where('id', session()->get('adminLoginId'))->first();
        return $admin->$info;
    }
}


//get User details by user id
if (!function_exists('adminUser')) {
    function adminUser($user_id, $info)
    {
        if (!$info  || !$user_id) {
            return 'no info matches';
        }
        //get the logged in admin id from session;

        $user = User::where('id', $user_id)->first();
        return $user->$info;
    }
}

//get user details by account id;
if (!function_exists('account')) {
    function account($account_id, $info)
    {
        if (!$info  || !$account_id) {
            return 'no info matches';
        }
        //n;

        $user = User::where('account_id', $account_id)->first();
        return $user->$info ?? 'NULL';
    }
}

//update ENV values
function setEnv($name, $value)
{
    //add quotes during update for single or multiple words
    $value = '"' .$value . '"';
    
    $path = base_path('.env');
    if (file_exists($path)) {
        //without quote
        file_put_contents($path, str_replace(
            $name . '=' . env($name),
            $name . '=' . $value,
            file_get_contents($path)
        ));
        //with quotes
        file_put_contents($path, str_replace(
            $name . '="' . env($name) .'"',
            $name . '=' . $value,
            file_get_contents($path)
        ));
    }
}

//get themes
if(!function_exists('getThemes')){
    function getThemes()
    {
        $theme_folders = \Illuminate\Support\Facades\File::directories(base_path('resources/views/themes'));
        
        $themes = [];
        foreach ($theme_folders as $theme_folder) {
            $theme = explode('/themes', $theme_folder);
            $theme = $theme[1];
            $theme = str_replace("\\", '', $theme); //remove backslash
            $theme = str_replace("/", '', $theme); //remove forwardslash
            array_push($themes, $theme);
        }        
        return $themes;
    }
}

//theme types
if(!function_exists('getThemeType')){
    function getThemeType($theme)
    {
        $theme = explode('-date-', $theme);
        if(count($theme) > 1){
            return 'export';
        }else {
            return 'upload';
        }        
    }
}

//theme config
if (!function_exists('themeConfig')){
    function themeConfig($config_name, $theme_name, $path = NULL)
    {
        //get the config file
        if(!$path){
            $config = file_get_contents(root_path().'public/assets/themes/' . $theme_name . '/config.php'); 
             
        }else {
            $config = file_get_contents(storage_path().'/app/public/temp-themes/' . $theme_name . '/config.php');
            
        }        
              
        $regex = '/"' . $config_name . '" => "(.+?)"/s';
        //$regex = '/"author_name" => "(.+?)"/s';
        \preg_match($regex, $config, $matches);
        if(!$matches) {
            return false;
        }
        return $matches[1];
        
    }
}


