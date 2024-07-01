<?php

class api_logic
{

    private $endpoint;
    private $params;

    // ===============================================
    public function __construct($endpoint, $params = null)
    {
        // define the object/class properties
        $this->endpoint = $endpoint;
        $this->params = $params;
    }

    // check if the endpoint is a valid class
    public function endpoint_exists()
    {
        return method_exists($this, $this->endpoint);
    }

    public function status()
    {
        return ['status' => "SUCCESS"];
    }

    public function get_all_clients()
    {

    }

    public function get_all_products()
    {

    }

}
