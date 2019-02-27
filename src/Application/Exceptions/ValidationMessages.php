<?php

namespace App\Exceptions;

class ValidationMessages
{
    const InvalidInput = array("message" => "The data entered was not correct", "code" => 1001);
    const CouldNotFindInitialObject =  array("message" => "A model with that id could not be found", "code" => 1002);
}