<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function jsonResponse($status, $data = null, $errors = null)
    {
        
        $response = [
            'status' => $status,
        ];
        if (!empty($data)) {
            $response['data'] = $data;
        }
        if (!empty($errors)) {
            $response['errors'] = $errors;
        }
        return response(
            json_encode($response),
            200,
            [ 'Content-Type' => 'application/json' ]
        );
    }

    public function jsonError($errors)
    {
        return $this->jsonResponse(false, null, $errors);
    }

    public function jsonSuccess($data = null)
    {
        return $this->jsonResponse(true, $data);
    }



}
