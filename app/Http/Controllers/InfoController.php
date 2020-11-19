<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

/**
 * Give miscellaneous server informations.
 */
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
            'OS' => php_uname('s') . ' ' . php_uname('r'),
            'Environnement' => config('app.env'),
            'URL' => config('app.url'),
            'Debug mode' => config('app.debug') ? 'True' : 'False',
            'PHP' => phpversion(),
            'Laravel' => App::version(),
            'Database' => $this->getDatabaseInfo(),
        ];

        // shell cmd
        $nodeVersion = exec('node -v', $out, $code);
        Controller::debug($code . ' : ' . $nodeVersion);
        Controller::debug($out);

        if ($code === 0)
            $info['NodeJS'] = $nodeVersion;
        
        $npmVersion = exec('npm -v', $out, $code);
        if ($code === 0)
            $info['NPM'] = $npmVersion;

        return view('admin.info', ['info' => $info]);
    }

    /**
     * Get database info based on the Database Management System and the version.
     * At least, get the current database driver base on the database.default config value. 
     */
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
