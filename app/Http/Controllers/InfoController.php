<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class InfoController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = [
            'OS' => php_uname('v'),
            'Environnement' => config('app.env'),
            'URL' => config('app.url'),
            'Debug mode' => config('app.debug') ? 'True' : 'False',
            'PHP' => phpversion(),
            'Laravel' => App::version(),
            'Database' => $this->getDatabaseInfo(),
        ];

        return view('admin.info', ['info' => $info]);
    }

    private function getDatabaseInfo()
    {
        if (config('database.default') === 'mysql') {
            $results = DB::select(DB::raw("select version()"));
            $dbVersion =  $results[0]->{'version()'};
            $db = 'MySQL';

            if (strpos($dbVersion, 'Maria') !== false) {
                $db = 'MariaDB';
            };

            $dbInfo = $db . ' ' . $dbVersion;
        } else {
            $dbInfo = config('datbase.default');
        }

        return $dbInfo;
    }
}
