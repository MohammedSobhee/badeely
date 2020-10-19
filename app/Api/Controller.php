<?php

namespace App\Api;

use App\Api\Responses\Response;
use App\Api\Transformer\Load;
use App\Http\Controllers\Controller as MainController;
use JWTAuth;

class Controller extends MainController
{
    use Response;

    /**
     * @param $rules
     * @throws ValidationException
     */
    public function validator($rules)
    {
        $validation = \Validator::make(request()->all(),$rules);

        $errors = $validation->errors()->messages();

        $errors = array_map( function ($k, $v) {
               return ['field_name' => $k,'message' => $v[0]];}
               , array_keys($errors), $errors);

        if($errors) throw new ValidationException($errors);
    }

    public function user()
    {
        return jwtauth::parsetoken()->authenticate();
    }

    public function transformer($object,$data)
    {
        return new Load($object,$data);
    }
}
