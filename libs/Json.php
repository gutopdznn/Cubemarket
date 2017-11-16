<?php
Class Json
{
    public static function response($status, $status_message, $data)
    {
        header("HTTP/1.1 $status $status_message");

        $response['status']         =   $status;
        $response['status_message'] =   $status_message;
        $response['data']           =   $data;

        echo json_encode($response, JSON_PRETTY_PRINT);
    }
}