<?php

namespace Infrastructure\Utils;

use Validator as Validator;

class ValidationUtil
{
    function __construct()
    {
    }

    public function Validate($data, $rules)
    {
        $validator = Validator::make($data, $rules);
        return array(
            "success" => !($validator->fails()),
            "errors" => $validator->errors()
        );
    }
}