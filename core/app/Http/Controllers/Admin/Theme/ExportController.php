<?php

namespace App\Http\Controllers\Admin\Theme;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExportController extends Controller
{
    //Exxport a theme that created by the user;
    public function exportTheme(Request $request) 
    {
        $request->validate([
            'theme_name' => 'required',
        ]);

        //check that the theme exist
        $theme_name = $request->theme_name;
        $themes = getThemes();
        if (!in_array($theme_name, $themes)){
            return redirect(route('admin.settings.theme-manager.themes'))->with('fail', 'This theme does not exist or invalid');
        }

        //create a temp folder in the storage
        $temp_folder = 'public/themes/' . $theme_name;
        $temp_assets_folder = $temp_folder . '/assets'; 
        $temp_blades_folder = $temp_folder . '/blades'; 
        if (\Illuminate\Support\Facades\File::isDirectory($temp_folder)){
            Storage::deleteDirectory($temp_folder);
        }
        
        $theme_folder = Storage::makeDirectory($temp_folder);

        if(!$theme_folder) {
            return redirect(route('admin.settings.theme-manager.themes'))->with('fail', 'Something went wrong, we could not create your export');
        }

        //create asset folder
        $assets_folder = Storage::makeDirectory($temp_assets_folder);
        $blades_folder = Storage::makeDirectory($temp_blades_folder);
        if (!$assets_folder || !$blades_folder){
            return redirect(route('admin.settings.theme-manager.themes'))->with('fail', 'Something went wrong, we could not complete theme export');
        } 

        //copy blades files
        $blades_path = base_path('resources/views/themes/' . $theme_name);
        $blades_storage_path = storage_path('app/public/themes/' . $theme_name . '/blades');
        $copy_blade_files = \Illuminate\Support\Facades\File::copyDirectory($blades_path, $blades_storage_path); 
       
        //copy asset files
        $assets_path = root_path() . 'public/assets/themes/' . $theme_name;
        $assets_storage_path = storage_path('app/public/themes/' . $theme_name . '/assets');
        $copy_asset_files = \Illuminate\Support\Facades\File::copyDirectory($assets_path, $assets_storage_path);  

        //copy config file
        $config_path = root_path() . 'public/assets/themes/' . $theme_name . '/config';
        $config_storage_path = storage_path('app/public/themes/' . $theme_name . '/config');
        $copy_config_files = \Illuminate\Support\Facades\File::copyDirectory($config_path, $config_storage_path);       

        if (!$copy_asset_files || !$copy_blade_files || !$copy_config_files) {
            //delete the directory
            Storage::deleteDirectory($temp_folder);
            return redirect(route('admin.settings.theme-manager.themes'))->with('fail', 'Something went wrong, we could not complete theme export');
        } 

        //zip the files        
        $zipPath = storage_path('app/public/themes/' . $theme_name);
        $time  = '-date-'. date('d-m-Y_H-i-s', time()) . '.zip';

        // Initialize archive object
        $zip = new \ZipArchive();
        $zip->open($zipPath . $time, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        // Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($zipPath),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );
        

        foreach ($files as $name => $file)
        {
            // Skip directories (they would be added automatically)
            if (!$file->isDir())
            {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($zipPath) + 1);

                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }

        // Zip archive will be created only after closing object
        $zip->close();

        //delete the directory
        Storage::deleteDirectory($temp_folder);
        return back()->with('success', 'Your Theme has been exported successfully, go to themes page to download or delete it');
    }

    //return view of theme exports
    public function exports()
    {
        $page_title = 'Theme Exports and Upload';
        $theme_folders = Storage::allFiles('public/themes');        
        $themes = [];
        foreach ($theme_folders as $theme_folder) {
            $theme = explode('/themes', $theme_folder);
            $theme = $theme[1];
            $theme = str_replace("\\", '', $theme); //remove backslash
            $theme = str_replace("/", '', $theme); //remove forwardslash
            array_push($themes, $theme);
        }

        return view ('admin.settings.themes.export', compact(
            'page_title',
            'themes'
        ));
        
    }

    
}
