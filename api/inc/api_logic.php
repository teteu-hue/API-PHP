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

    private function params_exists(){
        if(key_exists('active', $this->params) || key_exists('email', $this->params)){
            return true;
        } else if(key_exists('status', $this->params)){
            return true;
        }
        return false;
    }

    public function get_all_users()
    {
        // check param 'active'
        if ($this->params_exists()) {

            $result = $this->api_database->get_all_users($this->params);

            switch($result){
                case 'active':
                    return $this->send_data(404, "param 'active' only accepts true or false");
                    break;
                case 'email':
                    return $this->send_data(404, "param 'email' only accepts true or false");
                    break;
                default:
                    return $this->send_data(200, '', $result);
                    break;
            }
        }

        $result = $this->api_database->get_all_users();
        return $this->send_data(200, '', $result);
    }

    public function get_all_products()
    {
        if($this->params_exists()){
            $result = $this->api_database->get_all_products($this->params);

            switch($result){
                case 'status':
                    return $this->send_data(404, "param 'status' only accepts true or false");
                    break;

                default:
                    return $this->send_data(200, '', $result);
                    break; 
            }
        }

        $result = $this->api_database->get_all_products();
        return $this->send_data(200, '', $result);
    }
    // standard response 
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
