<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const NO_IMAGE_PATH = "images/no_image.png";

    /**
     * Add new log entry in app/logs/debug.log file
     */
    public static function debug($message)
    {
        Log::channel('debug')->debug($message);
    }
}
