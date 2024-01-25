<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Nwidart\Modules\Facades\Module;
use App\Http\Controllers\Controller;

class AddonInstaller extends Controller
{
    //return addon installtion view
    public function index() 
    {
        $page_title = 'Addons';
        $addons = [];

        $enabled = Module::allEnabled();
        foreach ($enabled as $addon) {
            array_push($addons, [
                'name' => $addon->getName(),
                'status' => 'enabled',
                'path' => $addon->getPath(),
            ]);
        }

        $disabled = Module::allDisabled();
        foreach ($disabled as $addon) {
            array_push($addons, [
                'name' => $addon->getName(),
                'status' => 'disabled',
                'path' => $addon->getPath(),
            ]);
        }

        return view('admin.addons.index', compact(
            'page_title',
            'addons'
        ));
    }


    //perform action operation
    public function action(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'action' => 'required',
        ]);



        $module = Module::find($request->name);

        if (!$module) {
            return back()->with('fail', 'Addon not found');
        }
       

        if ($request->action == 'enable'){
            $module->enable();

        } elseif ($request->action == 'disable') {
           $module->disable();

        }  elseif ($request->action == 'delete') {
            $module->delete();
        } else {
            return back()->with('fail', 'Action not recognized');
        }

        return back()->with('success', $request->name . ' ' . $request->action . ' successful');
    }


    //upload Module
    public function upload(Request $request)
    {
        $request->validate([
            'addon' => 'required|mimes:zip|max:20000'
        ]);

        
        //check if ioncube loader is enabled
        if(!extension_loaded('ionCube Loader')) {
            return back()->with('fail', 'Please install ioncube loader php extension');
        }

        $addon = $request->file('addon');
        $temp_name = $addon->getClientOriginalName();
        $extension = $addon->extension();


        $name =  str_replace('.zip', '', $temp_name);
        //store in the addon folder
        $upload = $addon->storeAs('public/addons', $temp_name);

        //extract to the addon folder
        // get the absolute path to $file
        $file = storage_path('app/' . $upload);  
            
        $path = Module::getPath() . '/' . $name;
            
        $zip = new \ZipArchive;
        if ($zip->open($file) === TRUE) {
            $zip->extractTo($path);
            $zip->close();

            //make inactive
            $module = Module::find($name);
            $module->enable();
            
            //delete the upload archive
            \Illuminate\Support\Facades\File::delete($file);

            //run addon specific actions 
            if ($request->action == 'update') {
                $url = route('admin.addons.index');
                return redirect($url)->with('success', 'Addon Updated successfully'); 
            }
            
            $url = url('/')  . '/admin/' . strtolower($name) . '/install';
            return redirect($url);           
            
        } else {
            //delete the temp file
            \Illuminate\Support\Facades\File::delete($file);
            return back()->with('fail', 'An error occured');
        }

    }
}
