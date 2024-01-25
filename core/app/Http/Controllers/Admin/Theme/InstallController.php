<?php

namespace App\Http\Controllers\Admin\Theme;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstallController extends Controller
{
    //installer 
    public function installTheme(Request $request){
        $request->validate([
            'theme_name' => 'required',
            'action' => 'required'
        ]);
        
        if ($request->action == 'install'){
            $theme_to_install = $request->theme_name;
            $theme_path = storage_path('app/public/themes/' . $theme_to_install);
            $theme_name = explode('-date-', $theme_to_install);
            $theme_name = $theme_name[0];

            $install_errors = [];
            //check if the file exist
            if (!file_exists($theme_path)) {
                array_push($install_errors, $theme_to_install . 'files missing');
                session()->flash('upload_errors', $install_errors);
                return back()->with('fail', $theme_to_install . 'files missing');
            }

            
            //extract to theme temp folder
            // get the absolute path to $file
            $file = $theme_path;      
            //$path = str_replace('.zip', '', $file); 
            $path = storage_path('app/public/temp-themes/' . $theme_name);       
                    
            $zip = new \ZipArchive;
            if ($zip->open($file) === TRUE) {
                $zip->extractTo($path);
                $zip->close();
                
            } else {
                //delete the temp file
                array_push($install_errors, 'Failed to extract' . $theme_to_install);
                session()->flash('upload_errors', $install_errors);
                return back()->with('fail', 'An error occured');
            }

            //check files and folders
            $required_folders = ['assets', 'blades'];

            foreach ($required_folders as $folder){            
                $folder_check =  \Illuminate\Support\Facades\File::isDirectory(storage_path('app/public/temp-themes/' . $theme_name . '/' . $folder));
                if(!$folder_check) {
                    $log = $folder. ' folder is Missing';
                    array_push($install_errors, $log);
                }           
            }

            
            //check is config
            if(!file_exists(storage_path('app/public/temp-themes/' . $theme_name . '/config/config.php'))){
                $log = 'Config.php is Missing';
                array_push($install_errors, $log);
                //delete temp directory
                \Illuminate\Support\Facades\File::deleteDirectory(storage_path('app/public/temp-themes'));
                session()->flash('upload_errors', $install_errors);
                return back()->with('fail', 'An error occured, check error log for details');
            }


            //check if the theme exist before        
            $to_theme_path = base_path('resources/views/themes/'. $theme_name);
            $theme_exists = \Illuminate\Support\Facades\File::isDirectory($to_theme_path);

            $theme_view_path = $to_theme_path;
            $theme_assset_path = root_path() . '/public/assets/themes/' .$theme_name;

            if ($theme_exists) {
                //check the theme version
                $old_theme_version  = themeConfig('version', $theme_name);
                $old_theme_version_to_no =  str_replace('.','',$old_theme_version);

                $new_theme_version = themeConfig('version', $theme_name, true);
                $new_theme_version_to_no = str_replace('.', '', $new_theme_version);

                if( $old_theme_version_to_no >= $new_theme_version_to_no ) {
                    //delete the directory
                    \Illuminate\Support\Facades\File::deleteDirectory(storage_path('app/public/temp-themes'));
                    $logs = [
                        'Theme Version Error: '. ucwords(str_replace('_', ' ', $theme_name)) . ' Exists',
                        'Current theme version: ' .$old_theme_version,
                        'New Theme Version: ' . $new_theme_version,
                        'Additional Info: Delete existing theme to restall or downgrade to older versions'
                    ];

                    foreach($logs as $log){
                        array_push($install_errors, $log);
                    }
                    session()->flash('upload_errors', $install_errors);
                    return back()->with('fail', 'An error occured, check error log for details');
                }         
            }

            //restore default
            websiteInfoUpdate('theme', 'cryptic');

            //everything checks out, install
            //copy blades files        
            $blades_storage_path = storage_path('app/public/temp-themes/' . $theme_name . '/blades');
            $copy_blade_files = \Illuminate\Support\Facades\File::copyDirectory($blades_storage_path, $theme_view_path); 
        
            //copy asset files        
            $assets_storage_path = storage_path('app/public/temp-themes/' . $theme_name . '/assets');
            $copy_asset_files = \Illuminate\Support\Facades\File::copyDirectory($assets_storage_path, $theme_assset_path );  

            //copy config file
            $config_path = root_path() . 'public/assets/themes/' . $theme_name . '/config';
            $config_storage_path = storage_path('app/public/temp-themes/' . $theme_name . '/config');
            $copy_config_files = \Illuminate\Support\Facades\File::copyDirectory($config_storage_path, $config_path); 
            
            if(!$copy_asset_files || !$copy_blade_files || !$copy_config_files) {
                array_push($install_errors, 'Failed Dispatch directories');
                //delete the directories
                \Illuminate\Support\Facades\File::deleteDirectory(storage_path('app/public/temp-themes'));
                session()->flash('upload_errors', $install_errors);
                return back()->with('fail', 'An error occured, check the error log for details');
            }else {
                //change the theme to new one
                websiteInfoUpdate('theme', $theme_name);
                //delete the directories
                \Illuminate\Support\Facades\File::deleteDirectory(storage_path('app/public/temp-themes'));
                \Illuminate\Support\Facades\File::delete(storage_path('app/public/themes/' . $theme_to_install));
                return back()->with('success', ucwords(str_replace('_', ' ', $theme_name)) . ' Installed Successfully');
            }

        } elseif($request->action == 'delete') {
            $theme_to_delete = $request->theme_name;
            $theme_path = storage_path('app/public/themes/' . $theme_to_delete);
            //check if the file exist
            if(file_exists($theme_path)){
                $delete = \Illuminate\Support\Facades\File::delete($theme_path);
                if($delete){
                    return back()->with('success', 'Theme deleted successfully');
                }else {
                    return back()->with('fail', 'Something went wrong');
                }
            }else {
                return back()->with('fail', 'Theme files not found');
            }
        } else {
            return back()->with('fail', 'recognized operation');
        }

               

    }
}
