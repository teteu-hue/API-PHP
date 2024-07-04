<?php

require_once(dirname(__FILE__) . '/api_database.php');

class api_logic
{

    private $endpoint;
    private $params;
    private api_database $api_database;

    // ===============================================
    public function __construct($endpoint, $params = null)
    {
        // define the object/class properties
        $this->endpoint = $endpoint;
        $this->params = $params;
        $this->api_database = new api_database();
    }

    // check if the endpoint is a valid class
    public function endpoint_exists()
    {
        return method_exists($this, $this->endpoint);
    }

    public function status()
    {
        return $this->send_data('SUCCESS', 'API IS RUNNING OK');
    }

    public function get_all_clients()
    {
    }

    public function params_exists(){
        if(key_exists('active', $this->params) || key_exists('email', $this->params)){
            return true;
        } 
        return false;
    }

    public function get_all_users()
    {
        // check param 'active'
        if ($this->params_exists()) {

            if (!$result = $this->api_database->get_all_users($this->params)) {
                return $this->send_data(415, "param 'active' accepts only 'true' or 'false' values");
            }
            return $this->send_data(200, '', $result);

        }

        $result = $this->api_database->get_all_users();
        return $this->send_data(200, '', $result);
    }

    public function get_all_products()
    {
        $result = $this->api_database->get_all_products();
        return $this->send_data(200, '', $result);
    }

    // this is a standard response 
    private function send_data($status = '', $message = '', $body = null)
    {
        $data = [
            'status' => $status,
            'message' => $message,
            'body' => $body
        ];
        return $data;
    }
}
