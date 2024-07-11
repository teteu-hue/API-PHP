<?php

require_once(dirname(__DIR__) . "/config.php");
require_once(dirname(__DIR__) . "/Dao.php");


class Client extends Dao
{

    // GET FUNCTIONS
    public function get_all_clients()
    {
        $this->sql = BASE_SELECT_QUERY_CLIENTS;
        $result = $this->runQuery($this->sql);
        return $result;
    }

    public function get_client($id)
    {
        $this->sql = BASE_SELECT_QUERY_CLIENTS . " WHERE id_client = $id";
        $result = $this->runQuery($this->sql);
        return $result;
    }

    public function get_all_active_clients()
    {
        $this->sql = BASE_SELECT_QUERY_CLIENTS . " WHERE status is TRUE";
        $result = $this->runQuery($this->sql);
        return $result;
    }

    public function get_all_inactive_clients()
    {
        $this->sql = BASE_SELECT_QUERY_CLIENTS . " WHERE status is FALSE";
        $result = $this->runQuery($this->sql);
        return $result;
    }

    // INSERT FUNCTION
    public function create_client(string $name, string $phone = null, string $address = null)
    {
        $this->sql = "CALL insert_customer('$name', '$phone', '$address')";
        
        $result = $this->runQuery($this->sql);
        return $result;
    }
}