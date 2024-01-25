<?php

namespace App\Http\Controllers\Installer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class InstallationController extends Controller
{

    //installation index
    public function index()
    {
        $page_title = 'Intallation Wizard by CredCrypto';

        return view('install.index', compact(
            'page_title',
        ));
    }

    public function server()
    {
        $page_title = 'Server Requirements';
        //check php
        $php_version = str_replace('.', '', phpversion());
        if ($php_version < 802) {
            $php_version = false;
        } else {
            $php_version = true;
        }

        //check if required extensions are loaded

        $extensions = [
            'bcmath' => extension_loaded('bcmath'),
            'ctype' => extension_loaded('ctype'),
            'curl' => extension_loaded('curl'),
            'fileinfo' => extension_loaded('fileinfo'),
            'gd' => extension_loaded('gd'),
            'gmp' => extension_loaded('gmp'),
            'json' => extension_loaded('json'),
            'mbstring' => extension_loaded('mbstring'),
            'openssl' => extension_loaded('openssl'),
            'pdo' => extension_loaded('pdo'),
            'pdo_mysql' => extension_loaded('pdo_mysql'),
            'tokenizer' => extension_loaded('tokenizer'),
            'xml' => extension_loaded('xml'),
            'zip' => extension_loaded('zip'),
        ];

        if (in_array(false, $extensions)) {
            $server = false;
        } else {
            $server = true;
            session()->put('server', true);
        }

        function asBytes($ini_v)
        {
            $ini_v = trim($ini_v);
            $s = ['g' => 1 << 30, 'm' => 1 << 20, 'k' => 1 << 10];
            return intval($ini_v) * ($s[strtolower(substr($ini_v, -1))] ?: 1);
        }


        $execution_sizes = [
            'post_max_size' => [
                'recommended' => '750M',
                'current' => ini_get("post_max_size"),
                'status' => (asBytes(ini_get("post_max_size")) >= asBytes('750M'))
            ],
            'upload_max_filesize' => [
                'recommended' => '750M',
                'current' => ini_get("upload_max_filesize"),
                'status' => (asBytes(ini_get("upload_max_filesize")) >= asBytes('750M'))
            ],
            'max_execution_time' => [
                'recommended' => 5000,
                'current' => ini_get("max_execution_time"),
                'status' => (ini_get("max_execution_time") >= 5000)
            ],
            'max_input_time' => [
                'recommended' => 5000,
                'current' => ini_get("max_input_time"),
                'status' => (ini_get("max_input_time") >= 5000)
            ],

            'memory_limit' => [
                'recommended' => '1000M',
                'current' => ini_get("memory_limit"),
                'status' => (asBytes(ini_get("memory_limit")) >= asBytes('1000M')),
            ],

            'max_allowed_packet' => [
                'recommended' => '200M',
                'current' => 'not checked',
                'status' => 'not checked',
            ],
        ];

        return view('install.server', compact(
            'page_title',
            'php_version',
            'extensions',
            'server',
            'execution_sizes',
        ));
    }

    //public function install
    public function permissions(Request $request)
    {
        //check if the serrver requirements were met

        if (!session()->has('server')) {
            return redirect(route('install.server'))->with('fail', 'Server requirements not met');
        }

        $page_title = 'Folder Permission Check';
        //check if .env is available

        //check if required file are available
        $path = root_path() . 'public/installation/database.sql';

        $required_files = [
            'database.sql' => \file_exists($path),
            '.env' => \file_exists(base_path('.env')),
            '.htaccess' => \file_exists(root_path() . '.htaccess'),
        ];

        $permissions  = [
            checkFolderPermission('core/bootstrap/cache'),
            checkFolderPermission('core/storage'),
            checkFolderPermission('core/storage/app'),
            checkFolderPermission('core/storage/framework'),
            checkFolderPermission('core/storage/logs'),
        ];
        
        $temp_perm = [];
        
        foreach ($permissions as $perm) {
            if (in_array(false, $perm)) {
                array_push($temp_perm, false);
            }
        }

        if (in_array(false, $temp_perm) || in_array(false, $required_files)) {
            $permission_check = false;
        } else {
            $permission_check = true;
            session()->put('permission_check', true);
        }

        return view('install.permissions', compact(
            'page_title',
            'permissions',
            'permission_check',
            'required_files',
        ));
    }

    public function database(Request $request)
    {
        //check if file permission was met in the previous check. This is to avoid skipping 
        if (!session()->has('permission_check')) {
            return redirect(route('install.permissions'))->with('fail', 'Check file permission before proceeding');
        }

        $page_title = 'Database Configuration';

        return view('install.database', compact('page_title'));
    }

    //validate database connection
    public function databaseValidate(Request $request)
    {
        $request->validate([
            'db_connection' => 'required',
            'db_host' => 'required',
            'db_port' => 'required|numeric',
            'db_database' => 'required',
            'db_username' => 'required',
            //'db_password' => 'required'
        ]);

        //update env
        setEnv('DB_CONNECTION', $request->db_connection);
        setEnv('DB_HOST', $request->db_host);
        setEnv('DB_PORT', $request->db_port);
        setEnv('DB_DATABASE', $request->db_database);
        setEnv('DB_USERNAME', $request->db_username);
        //local installation may not require password
        if ($request->db_password) {
            setEnv('DB_PASSWORD', $request->db_password);
        }

        //test database connection

        try {
            $connection = mysqli_connect($request->db_host, $request->db_username, $request->db_password, $request->db_database, $request->db_port);
            if (mysqli_connect_errno() == 0) {
                return redirect(route('install.database-import'));
            } else {
                return back()->withInput()->with('fail', 'Databse connection failed, check your credentials and try again');
            }
        } catch (\Exception $e) {
            return back()->withInput()->with('fail', 'Databse connection failed, check your credentials and try again');
        }
    }

    //import database
    public function databaseImport()
    {
        //import datable
        Artisan::call('db:wipe');
        $path = root_path() . 'public/installation/database.sql';
        $import = DB::unprepared(file_get_contents($path));

        //check if table exists after importing: This is to abort the installatio process if database import failed
        if (\Illuminate\Support\Facades\Schema::hasTable('withdrawal_wallets')) {
            session()->put('database', 'success');
            return redirect(route('install.setting'))->with('success', 'database.sql imported successfully');
        } else {
            return back()->with('fail', 'database.sql could not be import completed, try again on contact developer if the error persist');
        }
    }

    public function setting()
    {
        //check if the database was successfully imported previously
        if (!session()->has('database')) {
            return redirect(route('install.database'))->with('fail', 'Database not configured properly');
        }

        $page_title = 'Admin Setting';

        return view('install.setting', compact('page_title'));
    }

    //validate setting
    public function settingValidate(Request $request)
    {
        $request->validate([
            'website_name' => 'required',
            'website_url' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed'


        ]);

        //update website name
        websiteInfoUpdate('website_name', $request->website_name);
        setEnv('APP_URL', $request->website_url);


        //update admin
        //truncate admin table 

        $truncate = Admin::truncate();

        //create admin account
        $admin = new Admin();
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->role = 'admin';
        $admin->profile_photo = 'user.png';
        $save = $admin->save();

        //update website setting
        websiteInfoUpdate('website_email', $request->email);

        if ($save) {
            session()->put('setting', 'success');
            return redirect(route('install.complete'))->with('success', 'Admin saved successfully');
        } else {
            return back()->with('fail', 'Something went wrong, try again!');
        }
    }


    ///complete installation
    public function complete()
    {
        //check if admin was saved in the last step
        if (!session()->has('setting')) {
            return redirect(route('install.setting'))->with('fail', 'Check setting to proceed');
        }

        $page_title = 'Final Step';
        return view('install.complete', compact('page_title'));
    }

    //validate and take final step
    public function completeValidate(Request $request)
    {
        //create installation log

        $app_version = env('APP_VERSION') ?? '1.0.0';
        $date = date('d-m-Y H:i:s') . ' [' . time() . ']';

        //log
        $log = 'Installed on ' . $date;


        //Move the databse.sql to a new folder for added security
        $old_db_path  = root_path() . 'public/installation/database.sql';
        $new_db_path = root_path() . 'public/installation/installed/database.sql';


        $move = File::move($old_db_path, $new_db_path);

        //regenerate app key 
        $new_key = Artisan::call('key:generate');

        //clear all caches
        $clear_cache = Artisan::call('optimize:clear');


        //save log
        $filename = app_path('installed.txt');
        File::put($filename, $log);

        //clear all session variables
        $request->session()->flush();

        return redirect(route('admin.login'))->with('success', 'installation completed successfully');
    }

}
