<?php


namespace App\Http\Supports;


trait Helper
{
    public $model = null;

    public function returnData($status_code = null, $result = null, $message = null)
    {
        $data = [];
        if ($status_code) {
            $data['status'] = $status_code;
        }
        if ($result) {
            $data['result'] = $result;
        }
        if ($message) {
            $data['message'] = $message;
        }
        $data['base_url'] = url('/api');

        return $data;
    }

}
