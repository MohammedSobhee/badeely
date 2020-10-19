<?php

namespace App\Api\Responses;

use App\Api\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class SuccessResponse extends Controller
{
    private $message;
    private $data;
    private $paginate;

    public function __construct($data = null, $paginate = null)
    {
        $this->data = $data;
        $this->paginate = $paginate;
    }

    private function responseSuccess()
    {
        return $this->respond(true,$this->message,$this->data,$this->paginate);
    }

    public function created($message = 'created')
    {
        $this->message = $message;
        return $this->setStatusCode(201)->responseSuccess();
    }

    public function updated($message = 'updated')
    {
        $this->message = $message;
        return $this->responseSuccess();
    }

    public function deleted($message = 'deleted')
    {
        $this->message = $message;
        return $this->setStatusCode(204)->responseSuccess();
    }

    public function custom($message)
    {
        $this->message = $message;
        return $this->responseSuccess();
    }

    public function data($message = 'success')
    {
        $this->message = $message;
        return $this->responseSuccess();
    }

    public function pagination(LengthAwarePaginator $items, $message ='success')
    {
        $pagination = [
            'total' => $items->total(),
            'per_page' => $items->perPage(),
            'next_page_url' => $items->nextPageUrl(),
            'prev_page_url' => $items->previousPageUrl(),
            'current_page' => $items->currentPage(),
            'last_page' => $items->lastPage(),
            'from' => $items->firstItem(),
            'to' => $items->lastItem(),
        ];

        $this->message = $message;
        $this->paginate = $pagination;

        return $this->responseSuccess();
    }

}