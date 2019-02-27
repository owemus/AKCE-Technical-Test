<?php

namespace Infrastructure\Utils;

class ResponseUtil
{
    function __construct()
    {
    }

    public function GenerateResponse($status, $data, $pagination, $error_message)
    {
        $response = array(
            "success" => $status,
            "data" => $data,
            "pagination" => $pagination,
            "error" => $error_message
        );
        
        return response(json_encode($response))->header('Content-Type', 'application/json');
    }
}