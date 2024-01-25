<?php

namespace App\Http\Controllers\Admin\Theme;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    //upload theme
    public function uploadTheme(Request $request)
    {
        //validate input
        $request->validate([
            'theme' => 'required|max:50000|mimes:zip',
        ]);

        $theme = $request->file('theme');
        $temp_name = $theme->getClientOriginalName();
        $extension = $theme->extension();

        //format the name
        $name_format = explode('-date-', $temp_name);
        $name = $name_format[0];
        $name = str_replace('-', '_', $name);
        $name = str_replace(' ', '_', $name);
        $folder_name = 'temp-themes/' . $name;
        $name = $name . '.' . $extension;

        //store in the theme folder
        $upload = $theme->storeAs('public/temp-themes', $name);

        //extract to theme temp folder
        // get the absolute path to $file
        $file = storage_path('app/' . $upload);        
        $path = str_replace('.zip', '', $file);
        
                
        $zip = new \ZipArchive;
        if ($zip->open($file) === TRUE) {
            $zip->extractTo($path);
            $zip->close();
            
        } else {
            //delete the temp file
            \Illuminate\Support\Facades\File::delete($file);
            return back()->with('fail', 'An error occured');
        }

        $upload_errors = [];

        //check if theme valid;
        $required_folders = ['assets', 'blades'];

        foreach ($required_folders as $folder){            
           $folder_check =  \Illuminate\Support\Facades\File::isDirectory(storage_path('app/public/' . $folder_name .'/'. $folder));
           if(!$folder_check) {
            $log = $folder. ' folder is Missing';
            array_push($upload_errors, $log);
           }           
        }

        //check is config
        if(!file_exists(storage_path('app/public/' . $folder_name . '/config/config.php'))){
            $log = 'Config.php is Missing';
            array_push($upload_errors, $log);
            //delete temp directory
            \Illuminate\Support\Facades\File::deleteDirectory(storage_path('app/public/temp-themes'));
            return back()->with('fail', 'An error occur, check error log for details')->with('upload_errors', $upload_errors);
        }

        //check if the theme exist before
        $uploaded_theme_name = str_replace('.zip', '', $name);
        $to_theme_path = base_path('resources/views/themes/'. $uploaded_theme_name);
        $theme_exists = \Illuminate\Support\Facades\File::isDirectory($to_theme_path);

        $theme_view_path = $to_theme_path;
        $theme_assset_path = root_path() . '/public/assets/themes/' .$uploaded_theme_name;

        if ($theme_exists) {
            //check the theme version
            $old_theme_version  = themeConfig('version', $uploaded_theme_name);
            $old_theme_version_to_no =  str_replace('.','',$old_theme_version);

            $new_theme_version = themeConfig('version', $uploaded_theme_name, true);
            $new_theme_version_to_no = str_replace('.', '', $new_theme_version);

            if( $old_theme_version_to_no >= $new_theme_version_to_no ) {
                //delete the directory
                \Illuminate\Support\Facades\File::deleteDirectory(storage_path('app/public/temp-themes'));
                $logs = [
                    'Theme Version Error: '. ucwords(str_replace('_', ' ', $uploaded_theme_name)) . ' Exists',
                    'Current theme version: ' .$old_theme_version,
                    'New Theme Version: ' . $new_theme_version,
                    'Additional Info: Delete existing theme to restall or downgrade to older versions'
                ];

                foreach($logs as $log){
                    array_push($upload_errors, $log);
                }

                return back()->with('fail', 'An error occured, check error log for details')
                    ->with('upload_errors', $upload_errors);
            }         
        }

        //restore default
        websiteInfoUpdate('theme', 'cryptic');

        //everything checks out, install
        //copy blades files        
        $blades_storage_path = storage_path('app/public/temp-themes/' . $uploaded_theme_name . '/blades');
        $copy_blade_files = \Illuminate\Support\Facades\File::copyDirectory($blades_storage_path, $theme_view_path); 
       
        //copy asset files        
        $assets_storage_path = storage_path('app/public/temp-themes/' . $uploaded_theme_name . '/assets');
        $copy_asset_files = \Illuminate\Support\Facades\File::copyDirectory($assets_storage_path, $theme_assset_path );  

        //copy config file
        $config_path = root_path() . 'public/assets/themes/' . $uploaded_theme_name . '/config';
        $config_storage_path = storage_path('app/public/temp-themes/' . $uploaded_theme_name . '/config');
        $copy_config_files = \Illuminate\Support\Facades\File::copyDirectory($config_storage_path, $config_path); 
        
        if(!$copy_asset_files || !$copy_blade_files || !$copy_config_files) {
            array_push($upload_errors, 'Failed Dispatch directories');
            //delete the directories
            \Illuminate\Support\Facades\File::deleteDirectory(storage_path('app/public/temp-themes'));

            return back()->with('fail', 'An error occured, check the error log for details')
                    ->with('upload_errors', $upload_errors);
        }else {
            //change the theme to new one
            websiteInfoUpdate('theme', $uploaded_theme_name);
            //delete the directories
            \Illuminate\Support\Facades\File::deleteDirectory(storage_path('app/public/temp-themes'));
            return back()->with('success', ucwords(str_replace('_', ' ', $uploaded_theme_name)) . ' Installed Successfully');
        }       

        
    }
}
