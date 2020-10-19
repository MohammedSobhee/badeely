<?php

namespace App\Api;

class ValidationException extends \Exception
{
    protected $errors;

    public function __construct($errors)
    {
        $this->errors = $errors;
    }

    public function render($request)
    {
        return api()->error()->validation(['message' => 'validation_error' ,
            'error_list' => $this->errors]);
    }
}
