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

    public function generateResponse($msg, $type = null)
    {
        if ($type === 'error'){
            return response()->json([
                'code' => 401,
                'msg' => $msg
            ]);
        }

        return response()->json([
            'code' => 200,
            'msg' => $msg
        ]);
    }


    public function logInfo($channel, $title, $message)
    {
        Log::channel($channel)->info($title, ['message' => $message]);
    }
}
