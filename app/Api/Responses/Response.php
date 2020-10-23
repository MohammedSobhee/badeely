<?php

namespace App\Api\Responses;

trait Response {

    protected $status_code = 200;

    protected function getStatusCode()
    {
        return $this->status_code;
    }

    protected function setStatusCode($status_code)
    {
        $this->status_code = $status_code;
        return $this;
    }

    protected function respond($isSuccess, $msg, $data = null, $paginate = null, $header = [])
    {
        $errorList = isset($msg['error_list']) ? $msg['error_list'] : null;
        $msg = isset($msg['error_list']) ? $msg['message'] : $msg;

        $return = $this->getResponse($isSuccess, $msg, $errorList, $data, $paginate);

        return response()->json($return,$this->getStatusCode(),$header);

    }

    private function getResponse($isSuccess, $msg, $errorList, $data, $paginate)
    {
        $status = [
            'code' =>  $this->getStatusCode(),
            'success' => $isSuccess,
            'message' => __('api.'.$msg),
        ];

        // edit for tareq delete message if there is error list
        if($errorList){
            $errorList = array_column($errorList,'message');

            if(count($errorList) > 1){
                $status['message'] = implode(' \n ',$errorList);
            }else{
                $status['message'] = array_first($errorList);
            }
        }
        $return = ['status' => $status,'data' => $data ? $data : []];

        if ($paginate){
            $return['pagination'] = $paginate;
        }

        return $return;
    }

    public function success($data = null, $paginate = null){

        return new SuccessResponse($data,$paginate);
    }

    public function error(){
        return new ErrorResponse();
    }

}
