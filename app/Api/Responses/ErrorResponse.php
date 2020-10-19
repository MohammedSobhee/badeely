<?php

namespace App\Api\Responses;

use App\Api\Controller;

class ErrorResponse extends Controller
{
    private $message;

    protected function responseError()
    {
        return $this->respond(false, $this->message);
    }

    public function NotFound($message = 'not_found')
    {
        $this->message = $message;
        return $this->setStatusCode(404)->responseError();
    }

    public function unauthorized($message = 'unauthorized')
    {
        $this->message = $message;
        return $this->setStatusCode(401)->responseError();
    }

    public function BadRequest($message = 'bad_request')
    {
        $this->message = $message;
        return $this->setStatusCode(400)->responseError();
    }

    public function server($message = 'server_error')
    {
        $this->message = $message;
        return $this->setStatusCode(500)->responseError();
    }

    public function validation($message)
    {
        $this->message = $message;
        return $this->setStatusCode(422)->responseError();
    }

    public function UnsupportedMedia($message = 'unsupported_media')
    {
        $this->message = $message;
        return $this->setStatusCode(415)->responseError();
    }

    public function forbidden($message = 'forbidden')
    {
        $this->message = $message;
        return $this->setStatusCode(403)->responseError();
    }

}