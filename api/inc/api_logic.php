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

    /** VERIFY IF PARAMS IN URL EXIST */
    private function params_exists($param)
    {
        if (key_exists($param, $this->params)) {
            
            if(empty($this->params[$param]))
            {
                return false;
            }
            return true;
        }
        return false;
    }

    public function status()
    {
        return $this->send_data('SUCCESS', 'API IS RUNNING OK');
    }

    /* GET ROUTES */
    public function get_all_clients()
    {
        $result = $this->api_database->get_all_clients();
        return $this->send_data(200, '', $result);
    }

    public function get_client()
    {
        if($this->params_exists('id'))
        {
  
            if($clean_id = filter_var($this->params['id'], FILTER_SANITIZE_NUMBER_INT)){
                $id = filter_var($clean_id, FILTER_VALIDATE_INT);

                $result = $this->api_database->get_client($id);
                return $this->send_data(200, '', $result);
            } 
            
        } else {
            return $this->send_data(415, 'To use this endpoint you need to specify a ID', []);
        }
    }

    public function get_all_users()
    {
        $result = $this->api_database->get_all_users();
        return $this->send_data(200, '', $result);
    }

    public function get_user()
    {
        if ($this->params_exists('id')) {

            if($clean_id = filter_var($this->params['id'], FILTER_SANITIZE_NUMBER_INT))
            {
                $id = filter_var($clean_id, FILTER_VALIDATE_INT);
                if($result = $this->api_database->get_user($id)){
                    return $this->send_data(200, '', $result);
                } else {
                    return $this->send_data(200, 'not found', $result);
                } 
            }
        } else {
            return $this->send_data(415, "Please inform a 'id' to user");
        }
    }

    public function get_all_active_users()
    {
        $result = $this->api_database->get_all_active_users();
        return $this->send_data(200, '', $result);
    }

    public function get_all_inactive_users()
    {
        $result = $this->api_database->get_all_inactive_users();
        return $this->send_data(200, '', $result);
    }

    public function get_all_products()
    {
        $result = $this->api_database->get_all_products();
        return $this->send_data(200, '', $result);
    }

    public function get_product()
    {
        if ($this->params_exists('id')) {
            $clean_id = filter_var($this->params['id'], FILTER_SANITIZE_NUMBER_INT);
            $id = filter_var($clean_id, FILTER_VALIDATE_INT);

            $result = $this->api_database->get_product($id);
            return $this->send_data(200, '', $result);
        } else {
            return $this->send_data(415, "Please inform a 'id'");
        }
    }

    public function get_all_active_products()
    {
        $result = $this->api_database->get_all_active_products();
        return $this->send_data(200, '', $result);
    }

    public function get_all_inactive_products()
    {
        $result = $this->api_database->get_all_inactive_products();
        return $this->send_data(200, '', $result);
    }

}
