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

    public function get_all_users()
    {
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
