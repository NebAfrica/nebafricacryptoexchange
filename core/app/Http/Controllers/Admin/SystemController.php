<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SystemController extends Controller
{
    //return index
    public function index()
    {
        //list of modules
        $page_title = 'System Manager';
        //check php
        $php_version = str_replace('.', '', phpversion());
        if ($php_version < 802) {
            $php_version = false;
        } else {
            $php_version = true;
        }

        if (array_key_exists('HTTPS', $_SERVER)) {
            $is_https = true;
        } else {
            $is_https = false;
        }

        $file_permissions  = [
            checkFolderPermission('core/bootstrap/cache'),
            checkFolderPermission('core/storage'),
            checkFolderPermission('core/storage/app'),
            checkFolderPermission('core/storage/framework'),
            checkFolderPermission('core/storage/logs'),
        ];

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
            'ionCubeLoader' => extension_loaded('ionCube Loader'),
        ];

        function asBytes($ini_v)
        {
            $ini_v = trim($ini_v);
            $s = ['g' => 1 << 30, 'm' => 1 << 20, 'k' => 1 << 10];
            return intval($ini_v) * ($s[strtolower(substr($ini_v, -1))] ?: 1);
        }

        $max_allowed_packet = DB::select('SELECT @@global.max_allowed_packet limit 1');
        $max_allowed_packet = collect($max_allowed_packet[0]);
        $packet = '';
        foreach($max_allowed_packet as $pack) {
            $packet .= $pack;
        }

        $packet = floor($packet / 1e+6) . 'M';

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
                'current' => $packet,
                'status' => (asBytes($packet) >= asBytes('200M')),
            ],
        ];



        return view('admin.system-manager.index', compact(
            'page_title',
            'php_version',
            'file_permissions',
            'extensions',
            'is_https',
            'execution_sizes'
        ));
    }


    //change the enviroment
    public function changeEnv(Request $request)
    {
        $request->validate([
            'action' => 'required',
        ]);

        $path = base_path('.env');

        if ($request->action == 'disable') {
            if (file_exists($path)) {
                file_put_contents($path, str_replace(
                    'APP_DEBUG=true',
                    'APP_DEBUG=false',
                    file_get_contents($path)
                ));
            }
        } else {
            if (file_exists($path)) {
                file_put_contents($path, str_replace(
                    'APP_DEBUG=false',
                    'APP_DEBUG=true',
                    file_get_contents($path)
                ));
            }
        }

        return back()->with('success', 'Debug mode ' . $request->action . 'd');
    }


    //verify
    public function verify(Request $request)
    {
        //check for archives are extract
        $file = base_path() . '/resources/views/themes/' . websiteInfo('theme') . '/layout.zip';
        $path = base_path() . '/resources/views/themes/' . websiteInfo('theme') . '/layout';
        if (file_exists($file)) {
            $extract = unzipArchive($file, $path);
            if ($extract) {
                //delete and clear cache
                \Illuminate\Support\Facades\File::delete($file);
                \Illuminate\Support\Facades\Artisan::call('optimize:clear');
            }
        }

        return back()->with('success', 'Purchase Code Verified Successfully');
    }
}
