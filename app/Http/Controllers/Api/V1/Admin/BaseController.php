<?php
namespace App\Http\Controllers\Api\V1\Admin;
use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{

    public function sendResponse($result, $message, $code = 200)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message
        ];
        return response()->json($response, $code);
    }

    public function sendError($error, $errorMessages = [], $code = 400)
    {
    	$response = [
            'success' => false,
            'message' => $error
        ];

        if(!empty($errorMessages)){
            $response['errors'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    public function sendInfo($message)
    {
        return response()->json($message, 200);
    }
}
