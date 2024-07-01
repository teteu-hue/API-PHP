<?php

class api_response
{
    private $data;
    private $available_methods = ['GET', 'POST'];

    public function __construct()
    {
        $this->data = [];
    }

    // CHECK IF THE METHOD REQUEST IS CONFIGURED IN API
    public function check_method($method)
    {
        // check if method is available in API
        foreach($this->available_methods AS $key){
            if($key === $method){
                return true;
            } 
        }
        return false;
    }

    // SET METHOD TO USE IN A REQUEST
    public function set_method($method)
    {
        $this->data['method'] = $method;
    }

    // GET METHOD USE IN A REQUEST
    public function get_method()
    {
        return $this->data['method'];
    }

    // SET ENDPOINT IN DATA
    public function set_endpoint($endpoint)
    {
        $this->data['endpoint'] = $endpoint;
    }

    // GET ENDPOINT
    public function get_endpoint(){
        return $this->data['endpoint'];
    }

    // SEND A MESSAGE ERROR
    public function api_request_error($message = '', $status = 404)
    {
        $data = [
            "status" => 'ERROR',
            "error_message" => $message
        ];

        // output if generate some error
        $this->data['data'] = $data;
        $this->send_response();
    }

    // SEND A MESSAGE WITH SUCCESS
    public function send_api_status()
    {
        // SEND API status
        $this->data['data'] = ['status' => 'SUCCESS!'];
        $this->data['message'] = 'API IS RUNNING';
        $this->send_response();
    }

    // SEND RESPONSE
    public function send_response()
    {
        header('Content-Type:application/json');
        echo json_encode($this->data);
        die(1);
    }

    public function add_to_data($key, $value)
    {
        // add new key to data
        $this->data[$key] = $value;
    }
}
